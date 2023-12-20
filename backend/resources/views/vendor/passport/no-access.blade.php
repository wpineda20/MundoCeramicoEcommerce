<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <title>{{ config('app.name') }} - Authorization</title>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

        .passport-authorize .container {
            padding: 4rem
        }

        .passport-authorize .scopes {
            margin-top: 20px;
        }

        .passport-authorize .buttons {
            margin-top: 25px;
            text-align: center;
        }

        .passport-authorize .btn {
            width: 125px;
        }

        .passport-authorize .btn-approve {
            margin-right: 15px;
        }

        .passport-authorize form {
            display: inline;
        }

        .justify-content-center {
            display: flex;
            justify-content: center;
        }

        .card {
            border: 1px solid rgb(241, 241, 241);
            box-shadow: 0 .5rem 1rem #00000026;
            border-radius: 10px;
            padding: 2rem;
            width: 100%;
        }

        .card-header {
            font-size: 30px;
            text-align: center;
            font-weight: bold
        }

        .card-body>p {
            text-align: center;
        }

        .btn.btn-primary {
            background-color: #0066EB;
            padding: 0.5rem 1em;
            border-radius: 8px;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .btn.btn-secondary {
            background-color: red;
            padding: 0.5rem 1em;
            border-radius: 8px;
            color: #fff;
            border: none;
            cursor: pointer;
        }
    </style>
</head>

<body class="passport-authorize">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-12 col-md-5">
                <div class="card-body shadow">
                    <div class="row mb-0 mt-0">
                        <div class="col-md-10 offset-md-1 text-center pt-3 pb-3">
                            <img src="/logos/logo_nuevo.jpg" alt="logo mundo ceramico" height="150">
                        </div>
                    </div>
                    <h2 class="text-center pt-2">
                        Usuario no autorizado
                    </h2>

                    <div class=" pt-0">
                        <!-- Introduction -->
                        <div class="container">
                            <p>Lo sentimos, pero no cuentas con los permisos para acceder.</p>

                            <div class="buttons">
                                <a href="/" class="btn btn-primary">
                                    <i class="fa fa-home"></i>
                                    Regresar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
