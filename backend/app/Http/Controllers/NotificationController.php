<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NotificationController extends Controller
{
    public function sendEmail(Request $request)
    {
        try {
            Http::post(getenv('URL_API_NOTIFICATIONS') . "/addEmailToQueue", [
                // "to" => "leonellopez647@gmail.com,guillermo.jandres@gmail.com",
                "to" => "lobotech@cefesp.com",
                "subject" => "Nueva solicitud de contacto",
                "title" => "Solicitud de contacto",
                "text" => "
                <br>Nombre: $request->name
                <br>Celular: $request->phone
                <br>Correo electrónico: $request->email
                <br>Celular: $request->phone
                <br> Empresa: $request->company
                <br> Mensaje: $request->message"
            ]);

            return response()->json([
                'message' => 'El mensaje de contacto ha sido enviado.',
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
