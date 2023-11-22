<?php

namespace App\Http\Controllers;

use App\Models\Localization;
use App\Models\Store;

use Illuminate\Http\Request;
use Encrypt;

class LocalizationController extends Controller
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
            $itemsPerPage =  Localization::count();
            $skip = 0;
        }

        $sortBy = (isset($request->sortBy[0])) ? $request->sortBy[0] : 'id';
        $sort = (isset($request->sortDesc[0])) ? "asc" : 'desc';

        $search = (isset($request->search)) ? "%$request->search%" : '%%';

        $localization = Localization::allDataSearched($search, $sortBy, $sort, $skip, $itemsPerPage);
        $localization = Encrypt::encryptObject($localization, "id");

        $total = Localization::counterPagination($search);

        return response()->json([
            "message" => "Registros obtenidos correctamente.",
            "data" => $localization,
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
        $localization = new Localization;

        $localization->name = $request->name;
        $localization->longitude = $request->longitude;
        $localization->latitude = $request->latitude;
        $localization->address = $request->address;
        $localization->deleted_at = $request->deleted_at;

        $localization->save();
        
        return response()->json([
            "message" => "Registro creado correctamente.",
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Localization  localization
     * @return \Illuminate\Http\Response
     */
    public function show(Localization $localization)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Localization  $localization
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = Encrypt::decryptArray($request->all(), 'id');

        $localization = Localization::where('id', $data['id'])->first();
        $localization->name = $request->name;
        $localization->longitude = $request->longitude;
        $localization->latitude = $request->latitude;
        $localization->address = $request->address;
        $localization->deleted_at = $request->deleted_at;

        $localization->save();

        $store = Store::where('localization_id', $localization->id)->first();
        $store->name = $request->name;

        $store->save();

        return response()->json([
            "message" => "Registro modificado correctamente.",
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Localization  $localization
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = Encrypt::decryptValue($request->id);

        Localization::where('id', $id)->delete();

        return response()->json([
            "message" => "Registro eliminado correctamente.",
        ]);
    }
}
