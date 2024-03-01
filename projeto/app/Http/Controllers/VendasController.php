<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVendaRequest;
use App\Models\ClienteModel;
use App\Models\ItemVendaModel;
use App\Models\ProdutoModel;
use App\Models\VendaModel;
use App\Models\VendedorModel;
use Illuminate\Http\Request;

class VendasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendas = VendaModel::with('itens.produto')->get();
        return view("vendas.index", compact('vendas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = ClienteModel::all();
        $produtos = ProdutoModel::all();
        return view('vendas.create', compact("clientes", "produtos"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVendaRequest $request)
{
    try {
        $venda = VendaModel::create([
            'cliente_id' => $request->input('cliente_id'),
            'vendedor_id' => auth()->user()->id,
            'forma_pagamento' => $request->input('forma_pagamento'),
        ]);

        $itensVenda = $request->input('itens');

        foreach ($itensVenda['produto_id'] as $key => $produtoId) {
            $venda->itens()->create([
                'produto_id' => $produtoId,
                'quantidade' => $itensVenda['quantidade'][$key],
                'preco_unitario' => $itensVenda['preco_unitario'][$key],
                'subtotal' => $itensVenda['subtotal'][$key],
            ]);
        }

        return redirect()->route('vendas.index')->with('success', 'Venda criada com sucesso!');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Erro ao criar a venda. Por favor, tente novamente.');
    }
}



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $vendas = VendaModel::with('itens.produto')->find($id);

        return view('vendas.show', compact('vendas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $venda = VendaModel::with('itens.produto')->find($id);
        return view('vendas.edit', compact('venda'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $venda = VendaModel::with('itens')->find($id);

            if (!$venda) {
                return redirect()->route('vendas.index')->with('error', 'Venda não encontrada.');
            }

            $venda->cliente_id = $request->input('cliente_id');
            $venda->vendedor_id = $request->input('vendedor_id');
            $venda->forma_pagamento = $request->input('forma_pagamento');

            $venda->save();

            foreach ($request->input('itens') as $itemData) {
                $item = $venda->itens->where('id', $itemData['id'])->first();

                if ($item) {
                    $item->quantidade = $itemData['quantidade'];
                    $item->preco_unitario = $itemData['preco_unitario'];
                    $item->subtotal = $itemData['subtotal'];
                    $item->save();
                }
            }

            return redirect()->route('vendas.index')->with('success', 'Venda atualizada com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao atualizar a venda. Por favor, tente novamente.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VendaModel $venda)
    {
        $venda->delete();
        return redirect()->route('vendas.index')->with('success', 'Venda Excluída com sucesso!');
    }
}
