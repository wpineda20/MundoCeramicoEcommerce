<?php

namespace App\Http\Controllers;

use App\Models\State;

use Illuminate\Http\Request;
use Encrypt;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $itemsPerPage = $request->itemsPerPage ?? 10;
        $skip = ($request->page - 1) * $request->itemsPerPage;

        // Getting all the records
        if (($request->itemsPerPage == -1)) {
            $itemsPerPage =  State::count();
            $skip = 0;
        }

        $sortBy = (isset($request->sortBy[0])) ? $request->sortBy[0] : 'id';
        $sort = (isset($request->sortDesc[0])) ? "asc" : 'desc';

        $search = (isset($request->search)) ? "%$request->search%" : '%%';

        $state = State::allDataSearched($search, $sortBy, $sort, $skip, $itemsPerPage);
        $state = Encrypt::encryptObject($state, "id");

        $total = State::counterPagination($search);

        return response()->json([
            "message"=>"Registros obtenidos correctamente.",
            "data" => $state,
            "total" => $total,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $state = new State;

		$state->name = $request->name;
		$state->deleted_at = $request->deleted_at;

        $state->save();

        return response()->json([
            "message"=>"Registro creado correctamente.",
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\State  state
     * @return \Illuminate\Http\Response
     */
    public function show(State $state)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = Encrypt::decryptArray($request->all(), 'id');

        $state = State::where('id', $data['id'])->first();
		$state->name = $request->name;
		$state->deleted_at = $request->deleted_at;

        $state->save();

        return response()->json([
            "message"=>"Registro modificado correctamente.",
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = Encrypt::decryptValue($request->id);

        State::where('id', $id)->delete();

        return response()->json([
            "message"=>"Registro eliminado correctamente.",
        ]);
    }
}
