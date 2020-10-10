@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
    <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder/dist/esri-leaflet-geocoder.css"/>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <div class="card-login">
                    <div class="titulo"><span>Registra un establecimiento</span></div>
                    <div class="card-body">
                        <form action="#" method="POST" enctype="multipart/form-data" novalidate>
                            @csrf
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <span class="seccion-form">Nombre, Categoría e Imagen Principal</span>
                                </div>
                            </div>
                            <div class="form-group row justify-content-between">
                                <div class="col-12 col-md-4 mb-2 mb-md-0">
                                    <input type="text" class="input form-control @error('nombre') is-invalid @enderror" name="nombre" id="nombre" placeholder="Nombre del establecimiento" value="{{ old('nombre') }}">
                                    @error('nombre')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-4 mb-2 mb-md-0">
                                    <select name="categoria_id" id="categoria" class="input form-control @error('categoria_id') is-invalid @enderror">
                                        <option value="" selected disabled>---Selecciona Categoria---</option>
                                        @foreach ($categorias as $categoria)
                                            <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                                {{ $categoria->categoria }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-md-4 mb-2 mb-md-0">
                                    <input type="file" name="img" class="input form-control @error('img') is-invalid @enderror" id="img" value="{{ old('img') }}">
                                    @error('img')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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
                                    <input type="text" name="direccion" class="input form-control @error('direccion') is-invalid @enderror" id="direccion" value="{{ old('direccion') }}" placeholder="Dirección">
                                    @error('direccion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6 mb-2 mb-md-0">
                                    <input type="text" name="colonia" class="input form-control @error('colonia') is-invalid @enderror" id="colonia" value="{{ old('colonia') }}" placeholder="Colonia">
                                    @error('colonia')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <input type="hidden" name="lat" id="lat" value="{{ old('lat') }}">
                                <input type="hidden" name="lng" id="lng" value="{{ old('lng') }}">
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
@endsection
