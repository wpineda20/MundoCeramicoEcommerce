<?php

namespace App\Http\Middleware;

use App\Models\ApplicationPermission;
use Closure;
use Illuminate\Http\Request;
use Laravel\Passport\Client;

class HasAccessUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // $appsFound = ApplicationPermission::where([
        //     'user_id' => auth()->user()->id,
        //     'client_id' => $request->client_id,
        // ])->count();

        $client = Client::where('id', $request->client_id)->first();

        // // try {

        // //     $url = explode('/', $client->redirect);
        // //     $urlReturn = "$url[0]//$url[2]";
        // // } catch (\Throwable $th) {

        // //     return response()->json([
        // //         'error' => 'client_not_found',
        // //         'error_description' => 'Client id was not found on the server',
        // //         'hint' => 'Verify the client exists on the server',
        // //         'message' => 'The client doesn\'t exists',
        // //     ], 404);
        // // }
        // dd($client, $request->all());
        if (auth()->user()->role?->name != 'Administrador' && $client->name != 'Mundo Cerámico Auth') {
            return response()->view('vendor.passport.no-access');
        }

        return $next($request);
    }
}
