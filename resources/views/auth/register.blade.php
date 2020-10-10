@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card-login">
                <div class="titulo">
                    <span>Formulario de {{ __('Register') }}</span>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" novalidate>
                        @csrf
                        <div class="form-group row justify-content-between">
                            <div class="col-12 col-md-6">
                                <input id="name" type="text" class="input form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Nombre Completo">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6">
                                <input id="telefono" type="text" class="input form-control @error('telefono') is-invalid @enderror"
                                name="telefono" value="{{ old('telefono') }}"
                                required autocomplete="telefono" placeholder="Teléfono">
                                @error('telefono')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <div class="col-12">
                                <input id="email" type="email" class="input form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Correo Electrónico">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row justify-content-between">
                            <div class="col-12 col-md-6">
                                <input id="password" type="password" class="input form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Contraseña">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6">
                                <input id="password-confirm" type="password" class="input form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirmar Contraseña">
                            </div>
                        </div>
                        <div class="form-group row justify-content-center mb-0">
                            <div class="col-12 col-md-6">
                                <button type="submit" class="btn btn-block">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
