<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProdutoRequest;
use App\Http\Requests\UpdateClienteRequest;
use App\Http\Requests\UpdateProdutoRequest;
use App\Models\ClienteModel;
use App\Models\ProdutoModel;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produtos = ProdutoModel::all();
        return view("produtos.index", compact("produtos"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("produtos.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProdutoRequest $request)
    {
        $cliente = new ProdutoModel($request->all());
        $cliente->save();
        return redirect()->route('produtos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProdutoModel $produto)
    {
        return [
            'status' => true,
            'data' => $produto
        ];
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $produto = ProdutoModel::find($id);
        return view("produtos.edit", compact("produto"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProdutoRequest $request, ProdutoModel $produto)
    {
        $produto->update($request->all());
        return redirect()->route('produtos.index')->with('success', 'Produto alterado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProdutoModel $produtos)
    {
        $produtos->delete();
        return redirect()->route("produtos.index")->with('success', 'Produto excluído com sucesso.');

    }
}
