<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use App\Models\ClienteModel;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = ClienteModel::all();
        return view("clientes.index", compact("clientes"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("clientes.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClienteRequest $request)
    {
        $cliente = new ClienteModel($request->all());
        $cliente->save();
       return redirect()->route("clientes.index")->with("success","Cliente criado com sucesso!");
    }

    /**
     * Display the specified resource.
     */
    public function show(ClienteModel $cliente)
    {
        return [
            'status' => true,
            'data' => $cliente
        ];
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cliente = ClienteModel::find($id);
        return view("clientes.edit", compact("cliente"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClienteRequest $request, ClienteModel $cliente)
    {
        $cliente->update($request->all());
        return redirect()->route("clientes.index")->with("success","Cliente alterado com sucesso!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClienteModel $cliente)
    {
        $cliente->delete();
        return redirect()->route("clientes.index");
    }
}
