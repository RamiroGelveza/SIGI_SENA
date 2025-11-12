<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Finca extends Model
{
    protected $table = 'fincas';
    protected $fillable = [
        'nombre',
        'ubicacion'
    ];

    // Relación con invernaderos
    public function invernaderos()
    {
        return $this->hasMany(Invernadero::class, 'idFinca');
    }

    // Contar invernaderos de esta finca
    public static function contarInvernaderosPorId(int $idFinca): int
    {
        return Invernadero::where('idFinca', $idFinca)->count();
    }

    // Contar todas las cosechas registradas en los invernaderos de esta finca
    public function contarCosechas(): int
    {
        return \App\Models\Cosecha::whereHas('invernadero', function($query) {
            $query->where('idFinca', $this->id);
        })->count();
    }
}
