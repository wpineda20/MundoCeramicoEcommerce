<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    private $baseUrl;
    private $apiUrl;
    private $auth;

    // Client configurations
    private $method;
    private $url;
    private $query;
    private $headers;
    private $body;
    private $request;
    private $client;

    public function __construct()
    {
        $this->baseUrl = getenv('URL_BASE_EPCOM');
        $this->apiUrl = getenv('URL_API_EPCOM');

        $this->client = new \GuzzleHttp\Client();
    }

    public function login()
    {
        $response = Http::post("$this->baseUrl/oauth/token", [
            'grant_type' => 'client_credentials',
            'client_id' => getenv('CLIENT_ID_EPCOM'),
            'client_secret' => getenv('SECRET_CLIENT_EPCOM'),
        ]);

        return $response->json();
    }

    public function call()
    {
        $response = $this->client->request(
            $this->method,
            "$this->apiUrl/" . $this->request->any,
            [
                // "headers" => ['Authorization' => "Bearer " . $this->auth['access_token']],
                "query" => $this->query,
                // "form_params" => $this->body,
            ]
        );

        return $response;
    }

    public function gateway(Request $request)
    {
        // $this->auth = Cache::get('auth');

        // if (!Cache::has('auth')) {
        //     $this->auth = $this->login();

        //     Cache::put('auth', $this->auth, 120);
        // }

        $this->request = $request;

        // Gets the current type method of the request
        $this->method = $request->getMethod();

        // Gets the info depending on the type of the request
        $this->query = $request->all();
        // switch ($this->method) {
        //     case 'GET':
        //         $this->query = $request->all();
        //         $this->body = [];
        //         break;
        //     case 'POST':
        //         $this->query = [];
        //         $this->body = $request->all();
        //         break;
        //     case 'PUT':
        //         $this->query = [];
        //         $this->body = $request->all();
        //         break;
        //     case 'DELETE':
        //         $this->query = [];
        //         $this->body = $request->all();
        //         break;
        // }

        // Making the request
        $response = $this->call($request);

        return response()->json([
            'data' => json_decode($response->getBody()->getContents()),
        ]);
    }
}
