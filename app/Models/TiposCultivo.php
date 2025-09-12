<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TiposCultivo extends Model
{
    protected $table='tiposCultivo';
    protected $fillable=[
        'nombre',
        'cicloDias'
    ];
    public function cosecha(){
        return $this->hasMany(Cosecha::class);
    }
}
