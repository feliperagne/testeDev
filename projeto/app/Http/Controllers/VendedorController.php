<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVendedorRequest;
use App\Models\User;
use App\Models\VendedorModel;
use Illuminate\Http\Request;

class VendedorController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function criarVendedor(Request $request)
    {
        $user = $this->create($request->all());

        VendedorModel::create([
            'user_id' => $user->id,
            'nome' => $user->name,
        ]);

        return redirect($this->redirectPath());
    }

}
