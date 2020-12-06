<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    //Leyendo las rutas mediante el slug
    public function getRouteKeyName()
    {
        return 'slug';
    }
    //Relación 1:N de la tabla de categorias y establecimientos
    public function establecimientos()
    {
        return $this->hasMany(Establecimiento::class);
    }
}
