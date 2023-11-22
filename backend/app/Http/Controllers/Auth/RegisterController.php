<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // dd($data);
        return Validator::make($data, [
            'address' => ['required', 'string', 'max:255'],
            'department' => ['required', 'string', 'max:255'],
            'municipality' => ['required', 'string', 'max:255'],
            'phone_call' => ['required', 'string', 'max:9'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'client_type' => ($data['radio'] == "contribuyente") ? 1 : 0,
            'name' => $data['name'],
            'company' => $data['company'],
            'giro' => $data['giro'],
            'address' => $data['address'],
            'department' => $data['department'],
            'municipality' => $data['municipality'],
            'nit' => $data['nit'],
            'iva' => $data['iva'],
            'dui' => $data['dui'],
            'phone' => $data['phone'],
            'phone_call' => $data['phone_call'],
            'phone_whatsapp' => $data['phone_whatsapp'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => 2,
        ]);
    }
}
