<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendaModel extends Model
{
    use HasFactory;

    protected $table = 'vendas';


    protected $fillable = ['cliente_id', 'vendedor_id',
    'forma_pagamento', 'valor_parcela', 'numero_parcelas',
    'data_vencimento_parcela' ];

    public function cliente()
    {
        return $this->belongsTo(ClienteModel::class, 'cliente_id');
    }

    public function vendedor()
    {
        return $this->belongsTo(VendedorModel::class,'vendedor_id');
    }

    public function itens()
    {
        return $this->hasMany(ItemVendaModel::class, "venda_id");
    }

}
