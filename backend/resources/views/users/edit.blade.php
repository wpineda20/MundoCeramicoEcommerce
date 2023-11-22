@extends('layouts.app')

@section('content')
<div class="container">
    <a href="/home" class="my-3 btn btn-default"><span class="mdi mdi-chevron-left">Regresar</a>

    {{-- message --}}
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif
    {{-- message --}}
    <div class="card shadow" style="border: solid 1px #f1f1f1; font-family: 'Roboto', sans-serif;">
        <div class="card-header p-4 bg-white" style="border-bottom: solid 1px #f1f1f1;">
            <div class="row">
                <div class="cols-6 col-md-6 col-sm-6 d-flex align-items-center">
                    <h2 class="mb-0 fw-bold text-uppercase" style="font-size:15px">
                        perfil
                    </h2>
                </div>
                <div class="cols-6 col-md-6 col-sm-6">
                    <img src="/logos/lobo.png" alt="logo lobotech" height="50" align="right">
                </div>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('user.update', ['id' => auth()->user()->id]) }}">
                @csrf

                <div class="row mb-3">
                    <!-- name -->
                    <div class="col-md-12 mb-2" id="name" @if ( auth()->user()->client_type == 0)
                        style="display:block;" @else style="display:none;" @endif
                        >
                        <label for="name" class="col-form-label text-md-start">{{ __('Nombre')
                            }}</label>
                        <input type="text" class="form-control shadow-none @error('name') is-invalid @enderror"
                            name="name" value="{{ auth()->user()->name }}" autocomplete="name" autofocus>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <!-- name -->
                    <!-- company -->
                    <div class="col-md-12 mb-2" id="company" @if ( auth()->user()->client_type == 1)
                        style="display:block;" @else style="display:none;" @endif>
                        <label for=" company" class="col-form-label text-md-start">{{ __('Empresa')
                            }}</label>
                        <input type="text" class="form-control shadow-none" name="company"
                            value="{{ auth()->user()->company }}" autocomplete="company" autofocus>
                    </div>
                    <!-- company -->
                    <!-- giro -->
                    <div class="col-md-12 mb-2" id="giro" @if ( auth()->user()->client_type == 1)
                        style="display:block;" @else style="display:none;" @endif>
                        <label for=" giro" class="col-form-label text-md-start">{{ __('Giro')
                            }}</label>
                        <input type="text" class="form-control shadow-none" name="giro"
                            value="{{ auth()->user()->giro }}" autocomplete="giro" autofocus>
                    </div>
                    <!-- giro -->
                    <!-- Address -->
                    <div class="col-md-12 mb-2" id="address" style="display:block;">
                        <label for=" address" class="col-form-label text-md-start">{{ __('Dirección')
                            }}<span class="text-danger">*</span></label>
                        <input type="text" class="form-control shadow-none @error('address') is-invalid @enderror"
                            name="address" value="{{ auth()->user()->address }}" autocomplete="address" autofocus>

                        @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <!-- Address -->
                    <!-- Department -->
                    <div class="col-md-6 mb-2" id="department" style="display:block;">
                        <label for="department" class="col-form-label text-md-start">{{ __('Departamento')
                            }}<span class="text-danger">*</span></label>
                        <input type="text" class="form-control shadow-none @error('address') is-invalid @enderror"
                            name="department" value="{{ auth()->user()->department }}" autocomplete="department"
                            autofocus>

                        @error('department')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <!-- Department -->
                    <!-- Municipality -->
                    <div class="col-md-6 mb-2" id="municipality" style="display:block;">
                        <label for="municipality" class="col-form-label text-md-start">{{ __('Municipio')
                            }}<span class="text-danger">*</span></label>
                        <input type="text" class="form-control shadow-none @error('address') is-invalid @enderror"
                            name="municipality" value="{{ auth()->user()->municipality }}" autocomplete="municipality"
                            autofocus>

                        @error('municipality')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <!-- Municipality -->
                    <!-- NIT -->
                    <div class="col-md-6 mb-2" id="nit" style="display:block;">
                        <label for="nit" class="col-form-label text-md-start">{{ __('NIT')
                            }}</label>
                        <input type="text" class="nit form-control shadow-none" name="nit"
                            value="{{ auth()->user()->nit }}" autocomplete="nit" autofocus
                            pattern="\d{4}-\d{6}-\d{3}-\d" title="Debe tener el formato 0000-000000-000-0"
                            placeholder="0000-000000-000-0">
                    </div>
                    <!-- NIT -->
                    <!-- IVA -->
                    <div class="col-md-6 mb-2" id="iva" @if ( auth()->user()->client_type == 1)
                        style="display:block;" @else style="display:none;" @endif>
                        <label for="iva" class="col-form-label text-md-start">{{ __('Registro I.V.A')
                            }}</label>
                        <input type="text" class="form-control shadow-none" name="iva" value="{{ auth()->user()->iva }}"
                            autocomplete="iva" autofocus>
                    </div>
                    <!-- IVA -->
                    <!-- DUI -->
                    <div class="col-md-6 mb-2" id="dui" @if ( auth()->user()->client_type == 0)
                        style="display:block;" @else style="display:none;" @endif>
                        <label for="dui" class="col-form-label text-md-start">{{ __('DUI')
                            }}</label>
                        <input type="text" class="dui form-control shadow-none" name="dui"
                            value="{{ auth()->user()->dui }}" autocomplete="dui" autofocus pattern="\d{8}-\d"
                            title="Debe tener el formato 00000000-0" placeholder="00000000-0">
                    </div>
                    <!-- DUI -->
                    <!-- Phone -->
                    <div class="col-md-6 mb-2" id="phone" style="display:block;">
                        <label for="phone" class="col-form-label text-md-start">{{ __('Teléfono
                            fijo')
                            }}</label>
                        <input type="text" class="phone form-control shadow-none @error('phone') is-invalid @enderror"
                            name="phone" value="{{ auth()->user()->phone }}" autocomplete="phone" pattern="\d{4}-\d{4}"
                            title="Debe tener el formato 0000-0000" placeholder="0000-0000">

                        @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <!-- Phone -->
                    <!-- Phone Call -->
                    <div class="col-md-6 mb-2" id="phone_call" style="display:block;">
                        <label for="phone_call" class="col-form-label text-md-start">{{ __('Celular llamadas')
                            }}</label>
                        <input type="text"
                            class="phone_call form-control shadow-none @error('phone_call') is-invalid @enderror"
                            name="phone_call" value="{{ auth()->user()->phone_call }}" autocomplete="phone_call"
                            pattern="\d{4}-\d{4}" title="Debe tener el formato 0000-0000" placeholder="0000-0000">

                        @error('phone_call')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <!-- Phone Call -->
                    <!-- Phone Whatsapp -->
                    <div class="col-md-6 mb-2" id="phone_whatsapp" style="display:block;">
                        <label for="phone_whatsapp" class="col-form-label text-md-start">{{ __('Celular
                            whatsapp')
                            }}</label>
                        <input type="text" class="phone_whatsapp form-control shadow-none" name="phone_whatsapp"
                            value="{{ auth()->user()->phone_whatsapp }}" autocomplete="phone_whatsapp"
                            placeholder="0000-0000" pattern="\d{4}-\d{4}" title="Debe tener el formato ####-####">
                    </div>
                    <!-- Phone Whatsapp -->

                    <input type="text" class="form-control shadow-none" name="email" value="{{ auth()->user()->email }}"
                        hidden>
                    <input type="text" class="form-control shadow-none" name="id" value="{{ auth()->user()->id }}"
                        hidden>

                    <div class="row pt-3 mb-0">
                        <div class="col-md-12" align="right">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Actualizar') }}
                            </button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
    @endsection

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"
        integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $(".dui").mask("00000000-0");
            $(".nit").mask("0000-000000-000-0");
            $(".phone").mask("0000-0000");
            $(".phone_call").mask("0000-0000");
            $(".phone_whatsapp").mask("0000-0000");
        });
    </script>