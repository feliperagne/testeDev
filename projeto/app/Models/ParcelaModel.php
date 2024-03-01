<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParcelaModel extends Model
{
    use HasFactory;

    protected $table = 'parcela';
    protected $fillable = ['venda_id', 'valor', 'data_vencimento'];

    public function venda()
    {
        return $this->belongsTo(VendaModel::class);
    }
}
