@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow" style="border: solid 1px #f1f1f1; font-family: 'Roboto', sans-serif;">
                <div class="card-header p-4 bg-white" style="border-bottom: solid 1px #f1f1f1;">
                    <div class="row">
                        <div class="cols-6 col-md-6 col-sm-6 d-flex align-items-center">
                            <h2 class="mb-0 fw-bold" style="font-size:15px">
                                {{ __('INICIAR SESIÓN') }}
                            </h2>
                        </div>
                        <div class="cols-6 col-md-6 col-sm-6">
                            <img src="/logos/logo_azul_negro_rombo_rojo.png" alt="logo lobotech" height="50" align="right">
                        </div>
                    </div>
                </div>

                <div class="card-body px-5 bg-white">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">

                            <div class="col-md-12 mb-2">
                                <label for="email" class="col-form-label text-md-start">{{ __('Correo
                                    electrónico')}}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" autocomplete="email" autofocus>

                                @error('email')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-form-label text-md-start">{{ __('Password')
                                }}</label>

                            <div class="col-md-12">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0 pt-3">
                            <div class="col-md-12 d-grid">
                                <button type="submit" class="btn btn-primary" style="background-color: #000C27; border-color: #000C27">
                                    {{ __('INICIAR SESIÓN') }}
                                </button>

                                @if (Route::has('password.request'))
                                <a class="btn btn-link pt-3" style="color: #000C27" href="{{ route('password.request') }}">
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