<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendedorModel extends Model
{
    use HasFactory;

    protected $table = 'vendedores';
    //protected $with = ['users'];

    protected $fillable = ['user_id', 'nome'];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function vendas()
    {
        return $this->hasMany(VendaModel::class);
    }
}
