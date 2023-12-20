<?php

namespace App\Http\Controllers;

use App\Helpers\Mail;
use App\Models\Localization;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Store;
use App\Models\OrderStateDetail;
use App\Models\State;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Encrypt;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    private $mailHelper;

    public function __construct()
    {
        $this->mailHelper = new Mail();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $itemsPerPage = $request->itemsPerPage ?? 10;
        $skip = ($request->page - 1) * $request->itemsPerPage;

        // Getting all the records
        if (($request->itemsPerPage == -1)) {
            $itemsPerPage =  Order::count();
            $skip = 0;
        }

        $sortBy = (isset($request->sortBy[0])) ? $request->sortBy[0] : 'id';
        $sort = (isset($request->sortDesc[0])) ? "asc" : 'desc';

        $search = (isset($request->search)) ? "%$request->search%" : '%%';

        $order = Order::allDataSearched($search, $sortBy, $sort, $skip, $itemsPerPage, $request->filter);

        $total = Order::counterPagination($search, $request->filter);

        return response()->json([
            "message" => "Registros obtenidos correctamente.",
            "data" => $order,
            "total" => $total,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $order = new Order();
        $order->user_id = auth()->user()->id;

        // dd($request->all());
        $store = Store::find(Encrypt::decryptValue($request->store['id']));

        // Create new location when it's not a store
        if ($request->typeDelivery == 'delivery') {
            $localization = new Localization();
            $localization->name = $request->location['name'];
            $localization->longitude = $request->location['location']['longitude'];
            $localization->latitude = $request->location['location']['latitude'];
            $localization->address = $request->address;
            $localization->save();

            $order->localization_id = $localization->id;
        } else {
            // Gets the localization of the store
            $order->localization_id = $store->localization_id;
        }

        // Getting the store
        $order->store_id = $store->id;
        $order->typeDelivery = $request->typeDelivery;
        $order->save();

        // Inserting every product in the order
        foreach ($request->cart as $key => $item) {
            $orderDetail = new OrderDetail();
            $orderDetail->order_id = $order->id;
            $orderDetail->product_id = $item['product']['producto_id'];
            $orderDetail->price = $item['product']['precios']['final_price'];
            $orderDetail->quantity = $item['quantity'];
            $orderDetail->save();
        }

        $orderStateDetail = new OrderStateDetail();
        $orderStateDetail->order_id = $order->id;
        $orderStateDetail->state_id = State::find(1)->id; //Reserved order state
        $orderStateDetail->active = 1;
        $orderStateDetail->save();

        $mailContent = $this->mailHelper->createMailContent($request->cart, auth()->user(), $order);

        try {
            Http::post(getenv('URL_API_NOTIFICATIONS') . "/addEmailToQueue", [
                "to" => 'leonellopez647@gmail.com',
                "subject" => "Nuevo pedido registrado",
                "title" => "Solicitud de pedido",
                "text" => $mailContent
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }

        return response()->json([
            'message' => 'Orden actualizada correctamente.',
        ]);

        return response()->json([
            'message' => 'Orden realizada correctamente.',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }

    /**
     * Orders by user.
     */
    public function myOrder(Order $order)
    {
        $orders = Order::where('user_id', auth()->user()->id)
            ->get()
            ->map(fn ($order) => $order->format());

        return response()->json([
            'message' => 'Información obtenida correctamente.',
            'status' => 200,
            'success' => true,
            'records' => $orders,
        ]);
    }

    public function changeState(Request $request)
    {
        $orderId = Encrypt::decryptValue($request->id);

        $activeState = OrderStateDetail::where([
            'order_id' => $orderId,
            'active' => 1,
        ])->first();

        $activeState->active = 0;
        $activeState->save();

        $orderStateDetail = new OrderStateDetail();
        $orderStateDetail->order_id = $orderId;
        $orderStateDetail->state_id = State::where('name', $request->state)->first()->id; //Reserved order state
        $orderStateDetail->active = 1;
        $orderStateDetail->save();

        $user = Order::find($orderId)?->user;
        $name = $user->name ?? $user->company;
        $email = $user->email;

        try {
            Http::post(getenv('URL_API_NOTIFICATIONS') . "/addEmailToQueue", [
                "to" => $email,
                "subject" => "Actualización de tu pedido",
                "title" => "Actualización de tu pedido",
                "text" => "
                <div>
                    <div>
                        <h3 style=\"text-align: center; font-family: Roboto,sans-serif;\">Hola, $name</h3>
                        <p style=\"text-align: center; font-family: Roboto,sans-serif;\">El estado de tu pedido ha sido actualizado</p>
                    </div>
                    <div class=\"body\">
                        <p style=\"text-align: center; font-family: Roboto,sans-serif;\" > <strong>N.º</strong> $orderId</p>
                        <p style=\"text-align: center; font-family: Roboto,sans-serif;\"><strong>Estado: </strong> $request->state</p>
                    </div>
                </div>
                "
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }

        return response()->json([
            'message' => 'Orden actualizada correctamente.',
        ]);
    }
}
