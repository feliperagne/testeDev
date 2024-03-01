<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVendaRequest;
use App\Http\Requests\UpdateVendaRequest;
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

            if ($request->input('forma_pagamento') === 'credito') {
                $this->gerarParcelas($venda);
            }

            return redirect()->route('vendas.index')->with('success', 'Venda criada com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao criar a venda. Por favor, tente novamente.');
        }
    }

    private function gerarParcelas($venda)
    {
        $numeroParcelas = $venda->numero_parcelas;
        $valorParcela = $venda->valor_parcela;
        $dataVencimento = \Carbon\Carbon::parse($venda->data_vencimento_parcela);

        for ($i = 1; $i <= $numeroParcelas; $i++) {
            $venda->update([
                'numero_parcelas' => $i,
                'valor_parcela' => $valorParcela,
                'data_vencimento_parcela' => $dataVencimento,
            ]);

            $dataVencimento->addMonth();
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
        $clientes = ClienteModel::all();
        $produtos = ProdutoModel::all();
        $venda = VendaModel::with('itens.produto')->find($id);
        return view('vendas.edit', compact('venda', 'clientes', 'produtos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVendaRequest $request, VendaModel $venda)
    {
        $venda->update($request->all());

        $itensVenda = $request->input('itens');
        $venda->itens()->delete();
        foreach ($itensVenda as $item) {
            $venda->itens()->create([
                'produto_id' => $item['produto_id'],
                'quantidade' => $item['quantidade'],
                'preco_unitario' => $item['preco_unitario'],
                'subtotal' => $item['subtotal'],
            ]);
        }

        if ($request->has('numero_parcelas')) {
            $venda->update([
                'numero_parcelas' => $request->input('numero_parcelas'),
                'valor_parcela' => $request->input('valor_parcela'),
                'data_vencimento_parcela' => $request->input('data_vencimento_parcela'),
                 ]);
        }

        return redirect()->route('vendas.index')->with('success', 'Venda atualizada com sucesso!');
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
