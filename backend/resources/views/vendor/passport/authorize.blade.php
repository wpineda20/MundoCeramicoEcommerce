<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }} - Authorization</title>

    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

        .passport-authorize .container {
            padding: 4rem 1rem 1rem 1rem;
            display: flex;
            justify-content: center;
            align-items: center;
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
            max-width: 400px;
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

        /* Medium devices (landscape tablets, 768px and up) */
        @media (min-width:601px) and (max-width:1024px) {
            .passport-authorize .container {
                padding: 1rem !important;
            }

            .card {
                padding: 1rem !important;
            }

            .card-header {
                font-size: 25px !important;
            }
        }
    </style>
</head>

<body class="passport-authorize">
    <div class="container">
        <div class="card card-default">
            <div class="row justify-content-center">
                <img src="/logos/lobo.png" alt="logo lobotech" height="150">
            </div>
            <div class="card-header mt-5">
                Solicitud de autorización
            </div>
            <div class="card-body">
                <!-- Introduction -->
                <p><strong>{{ $client->name }}</strong> está solicitando permiso para acceder a tu cuenta.</p>

                <!-- Scope List -->
                @if (count($scopes) > 0)
                <div class="scopes">
                    <p><strong>Esta aplicación podrá:</strong></p>

                    <ul>
                        @foreach ($scopes as $scope)
                        <li>{{ $scope->description }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="buttons">
                    <!-- Authorize Button -->
                    <form method="post" action="{{ route('passport.authorizations.approve') }}">
                        @csrf

                        <input type="hidden" name="state" value="{{ $request->state }}">
                        <input type="hidden" name="client_id" value="{{ $client->getKey() }}">
                        <input type="hidden" name="auth_token" value="{{ $authToken }}">
                        <button type="submit" class="btn btn-primary btn-approve">Autorizar</button>
                    </form>

                    <!-- Cancel Button -->
                    <form method="post" action="{{ route('passport.authorizations.deny') }}">
                        @csrf
                        @method('DELETE')

                        <input type="hidden" name="state" value="{{ $request->state }}">
                        <input type="hidden" name="client_id" value="{{ $client->getKey() }}">
                        <input type="hidden" name="auth_token" value="{{ $authToken }}">
                        <button class="btn btn-secondary">Cancelar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>