<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemVendaModel extends Model
{
    use HasFactory;

    protected $table = 'item_venda';

    protected $fillable = ['produto_id', 'venda_id', 'subtotal', 'quantidade', 'preco_unitario'];

    public function venda()
    {
        return $this->belongsTo(VendaModel::class, 'venda_id');
    }

    public function produto()
    {
        return $this->belongsTo(ProdutoModel::class, 'produto_id');
    }
}
