<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gastos extends Model
{
    protected $table='gastos';
    protected $fillable=[
        'fecha',
        'descripcion',
        'monto',
        'idCosecha',
        'idCategoriaGastos'
    ];
       public function categoriaGasto()
    {
        return $this->belongsTo(CategoriaGasto::class, 'idCategoriaGastos', 'id');
    }
      public function cosecha()
    {
        return $this->belongsTo(Cosecha::class, 'idCosecha', 'id');
    }
}
