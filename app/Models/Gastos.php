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
    protected static function boot()
{
    parent::boot();

    static::creating(function ($model) {
        if (empty($model->descripcion)) {
            $model->descripcion = 'Sin descripción';
        }
    });
}

       public function categoriaGasto()
    {
        return $this->belongsTo(CategoriaGasto::class, 'idCategoriaGastos', 'id');
    }
      public function cosecha()
    {
        return $this->belongsTo(Cosecha::class, 'idCosecha', 'id');
    }
}
