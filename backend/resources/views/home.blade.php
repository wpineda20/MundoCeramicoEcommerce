@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- justify-content-center --}}
        <div class="row ">
            <div class="col-12 col-md-4 offset-md-4">
                <div class="card-body p-2 text-center">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <img src="/logos/lobo.png" alt="">
                    <h3 class="mt-3">Bienvenido {{ Auth::user()->name ?: Auth::user()->company }}</h3>

                    <h6 class="mt-3">Has iniciado sesión, ahora puedes volver a nuestra tienda en línea.
                    </h6>

                    <a href="{{ getenv('ECOMMERCE_URL') }}/redirectToProvider" class="btn btn-primary mt-3">
                        <span class="mdi mdi-cart"></span> Ir al tienda</a>

                </div>
            </div>

            <div class="row my-3 mt-5">
                <div class="col-5 p-0">
                    <hr>
                </div>
                <div class="col-2 text-center p-0 m-0">
                    <h5>o</h5>
                </div>
                <div class="col-5 p-0">
                    <hr>
                </div>
            </div>

            {{-- Options --}}
            <div class="container mt-3">
                <div class="row">
                    <div class="col-12 col-md-6 py-0">
                        <div class="card py-4 px-3 my-auto h-100">
                            <div class="d-flex flex-row">
                                <span class="mdi mdi-account-edit fs-2">
                                </span>
                                <h5 class="my-auto ps-2">
                                    Administrar mi cuenta
                                </h5>
                            </div>

                            <p>Encontrarás tu información de perfil y las opciones para administrarla como mejor te guste.
                            </p>
                            <div class="text-end align-bottom">
                                <a href="/edit" class="btn btn-secondary">Editar mi perfil</a>
                            </div>
                        </div>
                    </div>

                    @if (auth()->user()->role->name == 'Administrador')
                        <div class="col-12 col-md-6 py-0 h-100">
                            <div class="card py-4 px-3 my-auto h-100">
                                <div class="d-flex flex-row">
                                    <span class="mdi mdi-security fs-2">
                                    </span>
                                    <h5 class="my-auto ps-2">
                                        Panel administrativo
                                    </h5>
                                </div>

                                <p>Encontrarás información de la gestión de los pedidos y los catálogos de la tienda en
                                    línea.</p>
                                <div class="text-end">
                                    <a href="{{ getenv('URL_ADMIN_PANEL') }}" class="btn btn-secondary">Ir al panel</a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            {{-- Options --}}
        </div>
    </div>
@endsection
