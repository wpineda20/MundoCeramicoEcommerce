@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow" style="border: solid 1px #f1f1f1; font-family: 'Roboto', sans-serif;">
                <div class="card-header p-4 bg-white" style="border-bottom: solid 1px #f1f1f1;">
                    <div class="row">
                        <div class="cols-6 col-md-6 col-sm-6 d-flex align-items-center">
                            <h2 class="mb-0 fw-bold text-uppercase" style="font-size:15px">
                                {{ __('Reset Password')}}
                            </h2>
                        </div>
                        <div class="cols-6 col-md-6 col-sm-6">
                            <img src="/logos/logo_azul_negro_rombo_rojo.png" alt="logo mundo ceramico" height="50" align="right">
                        </div>
                    </div>
                </div>

                <div class="card-body px-5 bg-white">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">

                            <div class="col-md-12 p-3">
                                <label for="email" class="col-md-12 col-form-label text-md-start">{{ __('Correo
                                    electrónico')
                                    }}</label>
                                <input id="email" type="email"
                                    class="form-control shadow-none @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary" style="background-color: #000C27; border-color: #000C27">
                                    {{ __('Send Password Reset Link') }}
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