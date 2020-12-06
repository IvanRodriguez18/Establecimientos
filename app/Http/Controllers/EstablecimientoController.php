<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Establecimiento;
use App\Imagen;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class EstablecimientoController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //obteniendo las categorias de la base de datos con el modelo de categoria
        $categorias = Categoria::all();
        return view('establecimientos.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validación del formulario
        $data = $request->validate([
            'nombre' => 'required|string',
            'categoria_id' => 'required|exists:App\Categoria,id',
            'img' => 'required|image',
            'direccion' => 'required',
            'colonia' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'telefono' => 'required|numeric',
            'descripcion' => 'required|min:50',
            'apertura' => 'required|date_format:H:i',
            'cierre' => 'required|date_format:H:i|after:apertura',
            'uuid' => 'required|uuid'
        ]);
        //Guardando la imagen principal del establecimiento
        $ruta_imagen = $request['img']->store('principales', 'public');
        //Resize a la imagen principal del establecimiento cargada por el usuario
        $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(800, 600);
        //Guardando la imagen en el servidor
        $img->save();
        //Guardar el establecimiento en la base de datos
        auth()->user()->establecimiento()->create([
            'nombre' => $data['nombre'],
            'categoria_id' => $data['categoria_id'],
            'img' => $ruta_imagen,
            'direccion' => $data['direccion'],
            'colonia' => $data['colonia'],
            'latitud' => $data['lat'],
            'longitud' => $data['lng'],
            'telefono' => $data['telefono'],
            'descripcion' => $data['descripcion'],
            'apertura' => $data['apertura'],
            'cierre' => $data['cierre'],
            'uuid' => $data['uuid']
        ]);
        //Permaneciendo en la pagina una vez registrado el establecimiento
        return back()->with('estado', 'La información del establecimiento ha sido almacenada correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function show(Establecimiento $establecimiento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function edit(Establecimiento $establecimiento)
    {
        $categorias = Categoria::all();
        //Obtener el establecimiento del usuario autentificado
        $establecimiento = auth()->user()->establecimiento;
        $establecimiento->apertura = date('H:i', strtotime($establecimiento->apertura));
        $establecimiento->cierre = date('H:i', strtotime($establecimiento->cierre));
        //Obtiene las imagenes del establecimiento (Dropzone)
        $imagenes = Imagen::where('id_establecimiento', $establecimiento->uuid)->get();

        return view('establecimientos.edit', compact('categorias', 'establecimiento', 'imagenes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Establecimiento $establecimiento)
    {
        //ejecutando el policy
        $this->authorize('update', $establecimiento);
        //Validación del formulario
        $data = $request->validate([
            'nombre' => 'required|string',
            'categoria_id' => 'required|exists:App\Categoria,id',
            'img' => 'image',
            'direccion' => 'required',
            'colonia' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'telefono' => 'required|numeric',
            'descripcion' => 'required|min:50',
            'apertura' => 'required|date_format:H:i',
            'cierre' => 'required|date_format:H:i|after:apertura',
            'uuid' => 'required|uuid'
        ]);

        $establecimiento->nombre = $data['nombre'];
        $establecimiento->categoria_id = $data['categoria_id'];
        $establecimiento->direccion = $data['direccion'];
        $establecimiento->colonia = $data['colonia'];
        $establecimiento->latitud = $data['lat'];
        $establecimiento->longitud = $data['lng'];
        $establecimiento->telefono = $data['telefono'];
        $establecimiento->descripcion = $data['descripcion'];
        $establecimiento->apertura = $data['apertura'];
        $establecimiento->cierre = $data['cierre'];
        $establecimiento->uuid = $data['uuid'];

        if (request('img'))
        {
            $ruta_imagen = $request['img']->store('principales', 'public');
            //Resize a la imagen principal del establecimiento cargada por el usuario
            $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(800, 600);
            //Guardando la imagen en el servidor
            $img->save();

            $establecimiento->img = $ruta_imagen;
        }

        $establecimiento->save();

        //Enviando un mensaje al usuario cuando la información se actualice
        return back()->with('estado', 'Tu información se actualizó correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Establecimiento $establecimiento)
    {
        //
    }
}
