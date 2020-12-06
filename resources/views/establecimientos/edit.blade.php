@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
    <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder/dist/esri-leaflet-geocoder.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.css" integrity="sha512-3g+prZHHfmnvE1HBLwUnVuunaPOob7dpksI7/v6UnF/rnKGwHf/GdEq9K7iEN7qTtW+S0iivTcGpeTBqqB04wA==" crossorigin="anonymous"/>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <div class="card-login">
                    <div class="titulo"><span>Editar mi establecimiento</span></div>
                    <div class="card-body">
                        <form
                        action="{{ route('establecimiento.update', ['establecimiento' => $establecimiento->id]) }}"
                        method="POST"
                        enctype="multipart/form-data" novalidate>
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <span class="seccion-form">Nombre, Categoría e Imagen Principal</span>
                                </div>
                            </div>
                            <div class="form-group row justify-content-between">
                                <div class="col-12 col-md-6 mb-2 mb-md-0">
                                    <input type="text" class="input form-control @error('nombre') is-invalid @enderror" name="nombre" id="nombre" placeholder="Nombre del establecimiento" value="{{ $establecimiento->nombre }}">
                                    @error('nombre')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6 mb-2 mb-md-0">
                                    <select name="categoria_id" id="categoria" class="input form-control @error('categoria_id') is-invalid @enderror">
                                        <option value="" selected disabled>---Selecciona Categoria---</option>
                                        @foreach ($categorias as $categoria)
                                            <option value="{{ $categoria->id }}" {{ $establecimiento->categoria_id == $categoria->id ? 'selected' : '' }}>
                                                {{ $categoria->categoria }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('categoria_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-12 mb-2 mb-md-0">
                                    <input type="file" name="img" class="input form-control @error('img') is-invalid @enderror" id="img" value="{{ old('img') }}">
                                    @error('img')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <img style="width: 150px; margin-top: 10px;" src="/storage/{{ $establecimiento->img }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <span class="seccion-form">Ubicación</span>
                                </div>
                            </div>
                            <div class="form-group row justify-content-between">
                                <div class="col-12">
                                    <input type="text" id="formbuscador" class="input form-control" placeholder="Calle del negocio o Establecimiento">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-10">
                                    <p class="aviso">El asistente colocará una dirección estimada o mueve el <span class="marcador">Pin</span> al lugar correcto</p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <div id="mapa" style="height: 400px;"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-10">
                                    <p class="aviso alerta"><i class="fas fa-exclamation-circle"></i> Confirma que los siguientes campos son correctos</p>
                                </div>
                            </div>
                            <div class="form-group row justify-content-between">
                                <div class="col-12 col-md-6 mb-2 mb-md-0">
                                    <input type="text" name="direccion" class="input form-control @error('direccion') is-invalid @enderror" id="direccion" value="{{ $establecimiento->direccion }}" placeholder="Dirección">
                                    @error('direccion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6 mb-2 mb-md-0">
                                    <input type="text" name="colonia" class="input form-control @error('colonia') is-invalid @enderror" id="colonia" value="{{ $establecimiento->colonia }}" placeholder="Colonia">
                                    @error('colonia')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <input type="hidden" name="lat" id="lat" value="{{ $establecimiento->latitud }}">
                                <input type="hidden" name="lng" id="lng" value="{{ $establecimiento->longitud }}">
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <span class="seccion-form">Información del Establecimiento</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12 mb-2 mb-md-0">
                                    <input type="tel" class="input form-control @error('telefono') is-invalid @enderror" name="telefono" id="telefono" value="{{ $establecimiento->telefono }}" placeholder="Teléfono">
                                    @error('telefono')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12 mb-2 mb-md-0">
                                    <textarea name="descripcion" id="descripcion" class="input form-control @error('descripcion') is-invalid @enderror" placeholder="Escribe una descripción del establecimiento">{{ $establecimiento->descripcion }}</textarea>
                                    @error('descripcion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12 col-md-6 mb-2 mb-md-0">
                                    <div class="row">
                                        <div class="col-12">
                                            <p class="seccion-form text-center">Horario de Apertura</p>
                                        </div>
                                    </div>
                                    <input type="time" name="apertura" class="input form-control @error('apertura') is-invalid @enderror" id="apertura" value="{{ $establecimiento->apertura }}">
                                    @error('apertura')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6 mb-2 mb-md-0">
                                    <div class="row">
                                        <div class="col-12">
                                            <p class="seccion-form text-center">Horario de Cierre</p>
                                        </div>
                                    </div>
                                    <input type="time" name="cierre" class="input form-control @error('cierre') is-invalid @enderror" id="cierre" value="{{ $establecimiento->cierre }}">
                                    @error('cierre')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <span class="seccion-form">Imagenes del Establecimiento</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12 mb-2 mb-md-0">
                                    <div id="dropzone" class="dropzone"></div>
                                </div>
                                @if (count($imagenes) > 0)
                                    @foreach ($imagenes as $imagen)
                                        <input type="hidden" value="{{ $imagen->ruta_imagen }}" class="galeria">
                                    @endforeach
                                @endif
                            </div>
                            <div class="form-group row justify-content-center">
                                <input type="hidden" name="uuid" id="uuid" value="{{ $establecimiento->uuid }}">
                                <div class="col-12 col-md-6">
                                    <input type="submit" class="btn btn-block" value="Guardar Cambios">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
    <script src="https://unpkg.com/esri-leaflet" defer></script>
    <script src="https://unpkg.com/esri-leaflet-geocoder" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.js" integrity="sha512-8l10HpXwk93V4i9Sm38Y1F3H4KJlarwdLndY9S5v+hSAODWMx3QcAVECA23NTMKPtDOi53VFfhIuSsBjjfNGnA==" crossorigin="anonymous" defer></script>
@endsection
