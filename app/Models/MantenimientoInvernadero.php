<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MantenimientoInvernadero extends Model
{
    protected $table = 'mantenimientoInvernadero';
    protected $fillable = [
        'fechaMantenimiento',
        'costoMantenimiento',
        'descripcion',
        'idInvernadero'
    ];
    public function invernadero(){
        return $this->belongsTo(Invernadero::class,'idInvernadero');
    }
}
