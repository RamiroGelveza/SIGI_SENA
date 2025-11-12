<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invernadero extends Model
{
    protected $table='invernaderos';
    protected $fillable = [
        'nombre',
        'tamaño',
        'costoConstruccion',
        #'rendimiento',
        'idFinca'

    ];
    public function finca (){
        return $this->belongsTo(finca::class,'idFinca');
    }
    public function mantenimientoInvernadero(){
        return $this->HasMany(mantenimientoInvernadero::class);

    }
   public function cosechas()
{
    return $this->hasMany(Cosecha::class, 'idInvernadero', 'id');
}
 public static function contarCosechasPorId(int $idInvernadero): int
    {
        return Cosecha::where('idInvernadero', $idInvernadero)->count();
    }
    
    public function tieneCosechas(): bool
{
    return $this->cosechas()->exists();
}


public function totalMantenimientos(): float
{
    return $this->mantenimientos()->sum('costoMantenimiento');
}

// Saldo proyectado (ejemplo: ingresos - gastos - mantenimientos)
public function saldoProyectado(float $totalIngresos, float $totalGastos): float
{
    return $totalIngresos - $totalGastos - $this->totalMantenimientos();
}

    }


