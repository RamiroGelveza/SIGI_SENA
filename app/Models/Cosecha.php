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
    public function invernadero(){
        return $this->belongsTo(Invernadero::class,'idInvernadero');
    }
      public function tiposCultivo(){
        return $this->belongsTo(TiposCultivo::class,'idCultivo');
    }

  public function estadosCosecha(){
        return $this->belongsTo(EstadosCosecha::class,'idEstado');
    }
}

