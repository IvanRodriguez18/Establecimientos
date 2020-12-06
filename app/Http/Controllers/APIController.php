<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Establecimiento;
use App\Imagen;
use Illuminate\Http\Request;

class APIController extends Controller
{
    //Metodo para obtener todos los establecimientos
    public function index()
    {
        $establecimientos = Establecimiento::with('categoria')->get();

        //devolviendo la respuesta del servidor en formato json
        return response()->json($establecimientos);
    }
    //Metodo para obtener todas las categorias registradas en la base de datos
    public function categorias()
    {
        //Obteniendo las catagorias de la bd
        $categorias = Categoria::all();
        //enviando la respuesta del servidor mendiante JSON a la vista
        return response()->json($categorias);
    }
    //Metodo que devuelve los establecimientos que pertenecen a una categoria especifica
    public function categoria(Categoria $categoria)
    {
        $establecimiento = Establecimiento::where('categoria_id', $categoria->id)->with('categoria')->take(3)->get();
        return response()->json($establecimiento);
    }
    //Metodo que devuelve todos los establecimientos por categoria
    public function categoriaestablecimiento(Categoria $categoria)
    {
        $establecimiento = Establecimiento::where('categoria_id', $categoria->id)->with('categoria')->get();
        return response()->json($establecimiento);
    }
    //Muestra un establecimiento en especifico
    public function show(Establecimiento $establecimiento)
    {
        //Obteniendo todas las imagenes del establecimiento
        $imagenes = Imagen::where('id_establecimiento', $establecimiento->uuid)->get();
        $establecimiento->imagenes = $imagenes;
        # Devolviendo la respuesta del servidor mediante JSON
        return response()->json($establecimiento);
    }
}
