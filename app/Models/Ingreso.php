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
    protected static function boot()
{
    parent::boot();

    static::creating(function ($model) {
        // Solo si el campo viene vacío
        if (empty($model->fecha)) {
            $model->fecha = now()->toDateString(); // Fecha actual
        }
         if (empty($model->descripcion)) {
            $model->descripcion = 'Sin descripción';
        }
    });
}

}
