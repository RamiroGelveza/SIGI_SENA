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
}
