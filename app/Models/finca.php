<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class finca extends Model
{
    protected $table ='fincas';
    protected $fillable=[
        'nombre',
        'ubicacion'
    ];
    public function Invernadero(){
        return $this->hasMany(Invernadero::class);
    }
}
