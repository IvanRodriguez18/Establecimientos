<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Establecimiento extends Model
{
    //
    protected $fillable = [
        'nombre',
        'direccion',
        'colonia',
        'latitud',
        'longitud',
        'telefono',
        'img',
        'descripcion',
        'apertura',
        'cierre',
        'uuid',
        'categoria_id'
    ];
}
