<?php

namespace App\Http\Controllers;

use App\Establecimiento;
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
        //Validación del policy
        $uuid = $request->get('uuid');
        $establecimiento = Establecimiento::where('uuid', $uuid)->first();
        $this->authorize('delete', $establecimiento);
        //Imagen que se va a eliminar de la BD
        $imagen = $request->get('imagen');

        if (File::exists('storage/' . $imagen)) {
            //Elimina imagen del servidor
            File::delete('storage/' . $imagen);
            //Elimina imagen de la base de datos
            Imagen::where('ruta_imagen', $imagen)->delete();

            $respuesta = [
                'message' => 'success',
                'imagen' => $imagen,
                'uuid' => $uuid
            ];
        }

        //Eliminando la imagen de la base de datos
        //Imagen::where('ruta_imagen', '=', $imagen)->delete();

        return response()->json($respuesta);
    }
}
