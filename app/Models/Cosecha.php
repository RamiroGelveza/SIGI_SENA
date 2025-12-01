<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cosecha extends Model
{
    protected $table = 'cosechas';
    protected $fillable = [
        'fechaCreacion',
        'fechaSiembra',
        'fechaCosechaEstimada',
        'fechaCosechaReal',
        'cantidadSembrada',
        'totalGastos',
        'totalIngresos',
        'utilidad',
        'notas',
        'idInvernadero',
        'idCultivo',
        'idEstado'
    ];

        protected static function boot()
{
    parent::boot();

    static::creating(function ($model) {
        if (empty($model->notas)) {
            $model->notas = 'Sin notas';
        }
    });
    parent::boot();

    static::saving(function ($model) {
        if (empty($model->fechaCosechaReal)) {
            $model->fechaCosechaReal = ''; // Fecha fake para 'pendiente'
        }
    });
}
    public function invernadero(){
        return $this->belongsTo(Invernadero::class,'idInvernadero');
    }
      public function tiposCultivo(){
        return $this->belongsTo(TiposCultivo::class,'idCultivo');
    }

  public function estadosCosecha(){
        return $this->belongsTo(EstadosCosecha::class,'idEstado');
    }
public function ingresos()
{
    return $this->hasMany(Ingreso::class, 'idCosecha', 'id');
}

       public function gastos()
    {
        return $this->hasMany(Gastos::class, 'idCosecha', 'id');
    }

}

