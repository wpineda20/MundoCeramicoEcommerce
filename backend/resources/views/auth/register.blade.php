@extends('layouts.app')

@section('headers')
    <script src="{{ asset('js/validations.js') }}" type="text/javascript"></script>
    <link rel="stylesheet" href="{{ asset('css/password.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow" style="border: solid 1px #f1f1f1; font-family: 'Roboto', sans-serif;">
                    <div class="card-header p-4 bg-white" style="border-bottom: solid 1px #f1f1f1;">
                        <div class="row">
                            <div class="cols-6 col-md-6 col-sm-6 d-flex align-items-center">
                                <h2 class="mb-0 fw-bold" style="font-size:15px">
                                    {{ __('REGISTRO') }}
                                </h2>
                            </div>
                            <div class="cols-6 col-md-6 col-sm-6">
                                <img src="/logos/logo_azul_negro_rombo_rojo.png" alt="logo lobotech" height="50" align="right">
                            </div>
                        </div>
                    </div>

                    <div class="card-body px-5 bg-white">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <!-- type -->
                            <div class="row pt-2 mb-3">
                                <p class="">Tipo de cliente:<span class="text-danger">*</span></p>
                                <div class="col-md-12 text-center mb-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input shadow-none" type="radio" name="radio"
                                            value="nocontribuyente" @if (old('radio') == 'nocontribuyente') checked @endif>
                                        <label class="form-check-label" for="nocontribuyente">No contribuyente</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input shadow-none" type="radio" name="radio"
                                            value="contribuyente" @if (old('radio') == 'contribuyente') checked @endif>
                                        <label class="form-check-label" for="contribuyente">Contribuyente</label>
                                    </div>
                                </div>
                            </div>
                            <!-- type -->

                            <!-- general -->
                            <div class="row mb-3">
                                <div class="col-md-12 mb-2" id="general" style="display: none;">
                                    <h5 style="font-size:15px" class="fw-bold mb-0">DATOS GENERALES</h5>
                                    <hr>
                                </div>
                                <!-- name -->
                                <div class="col-md-12 mb-2" id="name" style="display: none;">
                                    <label for="name" class="col-form-label text-md-start">{{ __('Nombre') }}<span
                                            class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control shadow-none @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <!-- name -->
                                <!-- company -->
                                <div class="col-md-12 mb-2" id="company" style="display: none;">
                                    <label for="company" class="col-form-label text-md-start">{{ __('Empresa') }}<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control shadow-none" name="company"
                                        value="{{ old('company') }}" autocomplete="company" autofocus>
                                </div>
                                <!-- company -->
                                <!-- giro -->
                                <div class="col-md-12 mb-2" id="giro" style="display: none;">
                                    <label for="giro" class="col-form-label text-md-start">{{ __('Giro') }}<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control shadow-none" name="giro"
                                        value="{{ old('giro') }}" autocomplete="giro" autofocus>
                                </div>
                                <!-- giro -->
                                <!-- Address -->
                                <div class="col-md-12 mb-2" id="address" style="display: none;">
                                    <label for="address" class="col-form-label text-md-start">{{ __('Dirección') }}<span
                                            class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control shadow-none @error('address') is-invalid @enderror"
                                        name="address" value="{{ old('address') }}" autocomplete="address" autofocus>

                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <!-- Address -->
                                <!-- Department -->
                                <div class="col-md-6 mb-2" id="department" style="display: none;">
                                    <label for="department"
                                        class="col-form-label text-md-start">{{ __('Departamento') }}<span
                                            class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control shadow-none @error('address') is-invalid @enderror"
                                        name="department" value="{{ old('department') }}" autocomplete="department"
                                        autofocus>

                                    @error('department')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <!-- Department -->
                                <!-- Municipality -->
                                <div class="col-md-6 mb-2" id="municipality" style="display: none;">
                                    <label for="municipality"
                                        class="col-form-label text-md-start">{{ __('Municipio') }}<span
                                            class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control shadow-none @error('address') is-invalid @enderror"
                                        name="municipality" value="{{ old('municipality') }}"
                                        autocomplete="municipality" autofocus>

                                    @error('municipality')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <!-- Municipality -->
                                <!-- NIT -->
                                <div class="col-md-6 mb-2" id="nit" style="display: none;">
                                    <label for="nit"
                                        class="col-form-label text-md-start">{{ __('NIT') }}</label>
                                    <input type="text" class="form-control shadow-none nit" name="nit"
                                        value="{{ old('nit') }}" autocomplete="nit" autofocus
                                        pattern="\d{4}-\d{6}-\d{3}-\d" title="Debe tener el formato 0000-000000-000-0"
                                        placeholder="0000-000000-000-0">
                                </div>
                                <!-- NIT -->
                                <!-- IVA -->
                                <div class="col-md-6 mb-2" id="iva" style="display: none;">
                                    <label for="iva"
                                        class="col-form-label text-md-start">{{ __('Registro I.V.A') }}<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control shadow-none" name="iva"
                                        value="{{ old('iva') }}" autocomplete="iva" autofocus>
                                </div>
                                <!-- IVA -->
                                <!-- DUI -->
                                <div class="col-md-6 mb-2" id="dui" style="display: none;">
                                    <label for="dui" class="col-form-label text-md-start">{{ __('DUI') }}<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control shadow-none dui" name="dui"
                                        value="{{ old('dui') }}" autocomplete="dui" autofocus pattern="\d{8}-\d"
                                        title="Debe tener el formato 00000000-0" placeholder="00000000-0">
                                </div>
                                <!-- DUI -->
                                <!-- Phone -->
                                <div class="col-md-6 mb-2" id="phone" style="display: none;">
                                    <label for="phone"
                                        class="col-form-label text-md-start">{{ __('Teléfono
                                                                            fijo') }}</label>
                                    <input type="text"
                                        class="form-control phone shadow-none @error('phone') is-invalid @enderror"
                                        name="phone" value="{{ old('phone') }}" autocomplete="phone"
                                        pattern="\d{4}-\d{4}" title="Debe tener el formato 0000-0000"
                                        placeholder="0000-0000">

                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <!-- Phone -->
                                <!-- Phone Call -->
                                <div class="col-md-6 mb-2" id="phone_call" style="display: none;">
                                    <label for="phone_call"
                                        class="col-form-label text-md-start">{{ __('Celular llamadas') }}<span
                                            class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control shadow-none phone_call @error('phone_call') is-invalid @enderror"
                                        name="phone_call" value="{{ old('phone_call') }}" autocomplete="phone_call"
                                        pattern="\d{4}-\d{4}" title="Debe tener el formato 0000-0000"
                                        placeholder="0000-0000">

                                    @error('phone_call')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <!-- Phone Call -->
                                <!-- Phone Whatsapp -->
                                <div class="col-md-6 mb-2" id="phone_whatsapp" style="display: none;">
                                    <label for="phone_whatsapp"
                                        class="col-form-label text-md-start">{{ __('Celular
                                                                            whatsapp') }}</label>
                                    <input type="text" class="form-control shadow-none phone_whatsapp"
                                        name="phone_whatsapp" value="{{ old('phone_whatsapp') }}"
                                        autocomplete="phone_whatsapp" placeholder="0000-0000" pattern="\d{4}-\d{4}"
                                        title="Debe tener el formato ####-####">
                                </div>
                                <!-- general -->

                                <!-- account -->
                                <div class="row mb-3">
                                    <div class="col-md-12 mb-2" id="account" style="display: none;">
                                        <h5 style="font-size:15px" class="fw-bold mb-0">CUENTA</h5>
                                        <hr>
                                    </div>
                                    <!-- Email -->
                                    <div class="col-md-12 mb-2" id="email" style="display: none;">
                                        <label for="email"
                                            class="col-form-label text-md-start">{{ __('Correo
                                                                                    electrónico') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="email"
                                            class="form-control shadow-none @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email') }}" autocomplete="email">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <!-- Email -->
                                    <!-- Password -->
                                    <div class="col-md-6 mb-2" id="password" style="display: none;">
                                        <label for="password"
                                            class="col-form-label text-md-start">{{ __('Contraseña') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="password" id="contrasenha"
                                            class="form-control shadow-none @error('password') is-invalid @enderror"
                                            name="password" autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <!-- Password -->
                                    <!-- Confirm Password -->
                                    <div class="col-md-6 mb-2" id="password-confirm" style="display: none;">
                                        <label for="password-confirm"
                                            class="col-form-label text-md-start">{{ __('Confirmar
                                                                                    Contraseña') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="password" class="form-control shadow-none"
                                            name="password_confirmation" autocomplete="new-password">
                                    </div>
                                    <!-- Confirm Password -->
                                </div>
                                <!-- account -->

                                <!-- button -->
                                <div class="row mb-0">
                                    <div class="col-md-12 d-grid">
                                        <button type="submit" class="btn btn-primary" style="background-color: #000C27; border-color: #000C27">
                                            {{ __('REGISTRARME') }}
                                        </button>
                                    </div>
                                </div>
                                <!-- button -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
    integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"
    integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('js/password.js') }}" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $(".dui").mask("00000000-0");
        $(".nit").mask("0000-000000-000-0");
        $(".phone").mask("0000-0000");
        $(".phone_call").mask("0000-0000");
        $(".phone_whatsapp").mask("0000-0000");

        $("#contrasenha").password({
            // custom messages
            enterPass: "Escriba su contraseña",
            shortPass: "La contraseña es demasiado corta",
            containsField: "La contraseña contiene tu nombre de usuario",
            steps: {
                13: "Contraseña muy insegura",
                33: "Débil; intenta combinar letras y números",
                67: "Media; intente utilizar caracteres especiales",
                94: "Contraseña segura",
            },

            // show percent
            showPercent: true,

            // show text
            showText: true,

            // enable animation
            animate: true,
            animateSpeed: "fast",

            // select the match field for better password checks
            field: false,

            // whether to check for partials in field
            fieldPartialMatch: true,

            // minimum length
            minimumLength: 4,

            // closest selector
            closestSelector: "div",

            // use the old colorbar image
            useColorBarImage: false,

            // set custom rgb color ranges for colorbar
            customColorBarRGB: {
                red: [0, 240],
                green: [0, 240],
                blue: 10,
            },
        });
    });
</script>
