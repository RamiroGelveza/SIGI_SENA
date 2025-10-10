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
    public function cosecha(){
        return $this->HasMany(Cosecha::class);

    }

}
