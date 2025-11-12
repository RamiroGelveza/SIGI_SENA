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
 protected static function boot()
{
    parent::boot();

    static::creating(function ($model) {
        // Solo si el campo viene vacío
        if (empty($model->fechaMantenimiento)) {
            $model->fechaMantenimiento = now()->toDateString(); // Fecha actual
        }
    });
}


    public function invernadero(){
        return $this->belongsTo(Invernadero::class,'idInvernadero');
    }
}
