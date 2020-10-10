@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card-login">
                <div class="titulo"><span>{{ __('Login') }} al sistema</span></div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" novalidate>
                        @csrf
                        <div class="form-group row justify-content-center">
                            <div class="col-12 col-md-10">
                                <input id="email" type="email" class="input form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Correo Electrónico">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                           <div class="col-12 col-md-10">
                                <input id="password" type="password" class="input form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Contraseña">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <div class="col-12 col-md-10 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label lbl-check" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row justify-content-center mb-2">
                            <div class="col-12 col-md-10">
                                <button type="submit" class="btn btn-block">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <div class="col-12 col-md-10 text-center">
                                @if (Route::has('password.request'))
                                    <a class="btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
