<?php

namespace App\Http\Controllers;

use App\Models\Carousel;

use Illuminate\Http\Request;
use Encrypt;
use Str;

class CarouselController extends Controller
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
            $itemsPerPage =  Carousel::count();
            $skip = 0;
        }

        $sortBy = (isset($request->sortBy[0])) ? $request->sortBy[0] : 'id';
        $sort = (isset($request->sortDesc[0])) ? "asc" : 'desc';

        $search = (isset($request->search)) ? "%$request->search%" : '%%';

        $carousel = Carousel::allDataSearched($search, $sortBy, $sort, $skip, $itemsPerPage);

        // $carousel = Encrypt::encryptObject($carousel, "id");

        $total = Carousel::counterPagination($search);

        return response()->json([
            "message" => "Registros obtenidos correctamente.",
            "data" => $carousel,
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
        if (FileController::verifyTypeImage($request->image_url)) {

            $request->image_url = FileController::base64ToFile($request->image_url, date("Y-m-d") . '-' . Str::random(6), 'banners');

            $banner = $request->image_url;
        }

        $carousel = new Carousel;

        $carousel->title = $request->title;
        $carousel->status = ($request->status == true) ? 1 : 0;
        $carousel->image_url = $banner;

        $carousel->save();

        return response()->json([
            "message" => "Registro creado correctamente.",
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Carousel  carousel
     * @return \Illuminate\Http\Response
     */
    public function show(Carousel $carousel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Carousel  $carousel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $request->all();

        if (FileController::verifyTypeImage($request->image_url)) {

            $request->image_url = FileController::base64ToFile($request->image_url, date("Y-m-d") . '-' . Str::random(6), 'banners');

            $banner = $request->image_url;
        } else {
            $banner = str_replace(getenv('APP_URL'), "", $request->image_url);
        }

        $carousel = Carousel::where('id', $data['id'])->first();

        $carousel->title = $request->title;
        $carousel->status = ($request->status == true) ? 1 : 0;
        $carousel->image_url = $banner;

        $carousel->save();

        return response()->json([
            "message" => "Registro modificado correctamente.",
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Carousel  $carousel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;

        Carousel::where('id', $id)->delete();

        return response()->json([
            "message" => "Registro eliminado correctamente.",
        ]);
    }

    /**
     * get active carousel.
     */
    public function activeCarousel(Carousel $order)
    {
        $carousel = Carousel::where('status', 1)
            ->get()
            ->map(fn ($carousel) => $carousel->format());

        return response()->json([
            'message' => 'Información obtenida correctamente.',
            'status' => 200,
            'success' => true,
            'data' => $carousel,
        ]);
    }
}
