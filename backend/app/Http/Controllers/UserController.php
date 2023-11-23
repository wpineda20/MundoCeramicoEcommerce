<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use App\Models\User;
use App\Models\Role;

use Encrypt;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $itemsPerPage = $request->itemsPerPage ?? 10;
        $skip = ($request->page - 1) * $request->itemsPerPage;

        // Getting all the records
        if (($request->itemsPerPage == -1)) {
            $itemsPerPage =  User::count();
            $skip = 0;
        }

        $sortBy = (isset($request->sortBy[0])) ? $request->sortBy[0] : 'id';
        $sort = (isset($request->sortDesc[0])) ? "asc" : 'desc';

        $search = (isset($request->search)) ? "%$request->search%" : '%%';

        $users = User::allDataSearched($search, $sortBy, $sort, $skip, $itemsPerPage);

        // $users = Encrypt::encryptObject($users, "id");

        $total = User::counterPagination($search);

        return response()->json([
            "message" => "Registros obtenidos correctamente.",
            "data" => $users,
            "total" => $total,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $users = new User;

        $users->name = $request->name;
        $users->company = $request->company;
        $users->giro = $request->giro;
        $users->address = $request->address;
        $users->department = $request->department;
        $users->municipality = $request->municipality;
        $users->nit = $request->nit;
        $users->iva = $request->iva;
        $users->dui = $request->dui;
        $users->phone = $request->phone;
        $users->phone_call = $request->phone_call;
        $users->phone_whatsapp = $request->phone_whatsapp;
        $users->email = $request->email;

        $users->save();

        return response()->json([
            "message" => "Registro creado correctamente.",
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = $request->all();

        $user = User::where('id', $data['id'])->first();

        $user->name = $request->name;
        $user->company = $request->company;
        $user->giro = $request->giro;
        $user->address = $request->address;
        $user->department = $request->department;
        $user->municipality = $request->municipality;
        $user->nit = $request->nit;
        $user->iva = $request->iva;
        $user->dui = $request->dui;
        $user->phone = $request->phone;
        $user->phone_call = $request->phone_call;
        $user->phone_whatsapp = $request->phone_whatsapp;

        $user->save();

        return redirect('/');
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateUser(Request $request)
    {
        $data = $request->all();

        $users = User::where('id', $data['id'])->first();
        $users->name = $request->name;
        $users->company = $request->company;
        $users->giro = $request->giro;
        $users->address = $request->address;
        $users->department = $request->department;
        $users->municipality = $request->municipality;
        $users->nit = $request->nit;
        $users->iva = $request->iva;
        $users->dui = $request->dui;
        $users->phone = $request->phone;
        $users->phone_call = $request->phone_call;
        $users->phone_whatsapp = $request->phone_whatsapp;
        $users->role_id = Role::where('name', $request->role)->first()->id;

        $users->save();

        return response()->json([
            "message" => "Registro modificado correctamente.",
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;

        User::where('id', $id)->delete();

        return response()->json([
            "message" => "Registro eliminado correctamente.",
        ]);
    }
}
