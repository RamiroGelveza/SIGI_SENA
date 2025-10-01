<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    protected  $table='ingresos';
    protected $fillable = [
        'fecha',
        'descripcion',
        'cantidadVendida',
        'precioUnitario',
        'idCosecha'
    ];

    public function Cosecha(){
        return $this->belongsTo(Cosecha::class,'idCosecha');
    }
}
