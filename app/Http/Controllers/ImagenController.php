<?php

namespace App\Http\Controllers;

use App\Imagen;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class ImagenController extends Controller
{
    public function store(Request $request)
    {
        //Leer la imagen que envia el usuario
        $ruta_imagen = $request->file('file')->store('establecimientos', 'public');
        //Resize a la imagen cargada por el usuario
        $imagen = Image::make(public_path("storage/{$ruta_imagen}"))->fit(800, 450);
        //Guardando la imagen en el servidor
        $imagen->save();
        //Almacenar la imagen en la BD con el modelo
        $imagenDB = new Imagen();
        $imagenDB->id_establecimiento = $request['uuid'];
        $imagenDB->ruta_imagen = $ruta_imagen;
        $imagenDB->save();
        $respuesta = [
            'archivo' => $ruta_imagen
        ];
        return response()->json($respuesta);
    }

    public function destroy(Request $request)
    {
        $imagen = $request->get('imagen');

        if (File::exists('storage/' . $imagen)) {
            File::delete('storage/' . $imagen);
        }

        $respuesta = [
            'message' => 'success',
            'imagen' => $imagen
        ];

        //Eliminando la imagen de la base de datos
        Imagen::where('ruta_imagen', '=', $imagen)->delete();

        return response()->json($respuesta);
    }
}
