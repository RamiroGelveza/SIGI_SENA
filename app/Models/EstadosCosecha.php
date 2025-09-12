<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadosCosecha extends Model
{
    protected $table='estadosCosecha';
    protected $fillable=[
        'nombre'
    ];
     public function cosecha(){
        return $this->HasMany(Cosecha::class);

    }

}
