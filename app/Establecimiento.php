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

    //Relación entre la tabla establecimiento y categoria
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
