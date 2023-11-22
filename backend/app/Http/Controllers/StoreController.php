<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Localization;
use App\Models\Order;
use Illuminate\Http\Request;
use Encrypt;

class StoreController extends Controller
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
            $itemsPerPage =  Store::count();
            $skip = 0;
        }

        $sortBy = (isset($request->sortBy[0])) ? $request->sortBy[0] : 'id';
        $sort = (isset($request->sortDesc[0])) ? "asc" : 'desc';

        $search = (isset($request->search)) ? "%$request->search%" : '%%';

        $store = Store::allDataSearched($search, $sortBy, $sort, $skip, $itemsPerPage);
        // $store = Encrypt::encryptObject($store, "id");

        $total = Store::counterPagination($search);

        return response()->json([
            "message" => "Registros obtenidos correctamente.",
            "data" => $store,
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
        $localization->longitude = $request->location['longitude'];
        $localization->latitude = $request->location['latitude'];
        $localization->address = $request->address;

        $localization->save();

        $store = new Store;

        $store->name = $request->name;
        $store->localization_id = $localization->id;
        $store->save();

        return response()->json([
            "message" => "Registro creado correctamente.",
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Store  store
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = Encrypt::decryptValue($request->id, 'id');

        $store = Store::where('id', $id)->first();
        $store->name = $request->name;

        $localization = Localization::where('name', $request->name)->first();
        // return respo
        if (is_null($localization)) {
            $localization = new Localization();
            $localization->name = $request->name;
            $localization->address = $request->address;
            $localization->longitude = $request->location['longitude'];
            $localization->latitude = $request->location['latitude'];
            $localization->save();
            $store->localization_id = $localization->id;
        } else {
            $localization->name = $request->name;
            $localization->address = $request->address;
            $localization->longitude = $request->location['longitude'];
            $localization->latitude = $request->location['latitude'];
            $localization->save();
            $store->localization_id = $localization->id;
        }

        $store->save();

        return response()->json([
            "message" => "Registro modificado correctamente.",
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = Encrypt::decryptValue($request->id);

        Store::where('id', $id)->delete();

        return response()->json([
            "message" => "Registro eliminado correctamente.",
        ]);
    }
}
