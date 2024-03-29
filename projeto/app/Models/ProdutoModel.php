<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdutoModel extends Model
{
    use HasFactory;

    protected $table = 'produtos';

    protected $fillable = ['nome', 'preco'];


    public function itens()
    {
        return $this->hasMany(ItemVendaModel::class, 'produto_id');
    }
}
