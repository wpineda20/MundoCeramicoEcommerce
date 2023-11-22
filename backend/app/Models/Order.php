<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Encrypt;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';

    public function localization()
    {
        return $this->belongsTo(Localization::class, 'localization_id', 'id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }

    public function orderStateDetail()
    {
        // return $this->hasManyThrough(State::class, OrderStateDetail::class, 'state_id', 'id', 'order_id', 'id');
        return $this->hasMany(OrderStateDetail::class, 'order_id', 'id');
    }

    public function format()
    {
        return [
            'id' => Encrypt::encryptValue($this->id),
            'subtotal' => $this->subtotal($this->orderDetail()->get()),
            'cart' => $this->orderDetail()->get()->map(fn ($order) => $order->format()),
            'store' => $this->store->format(),
            'location' => $this->localization?->format(),
            'typeDelivery' => $this->typeDelivery,
            'address' => $this->localization?->address,
            'infoUser' => $this->user,
            'created_at' => $this->created_at->diffForHumans(),
            'state' => $this->orderStateDetail()->latest('id')->first()?->state->format(),
        ];
    }

    public function subtotal($orderDetails)
    {
        $subtotal = 0.00;

        foreach ($orderDetails as $key => $item) {
            $subtotal += ($item->price + $this->quantity);
        }

        return number_format($subtotal, 2);
        // dd($orderDetails);
    }

    public static function allDataSearched($search, $sortBy, $sort, $skip, $itemsPerPage, $filter)
    {
        // dd($search, $filter);
        return Order::select(
            'order.*',
            'osd.*',
            's.*',
            'order.id as id',
            'osd.created_at as created_at',
        )
            ->join('order_state_detail as osd', 'order.id', '=', 'osd.order_id')
            ->join('state as s', 'osd.state_id', '=', 's.id')
            ->join('users as u', 'order.user_id', '=', 'u.id')

            // ->join('state as s', 'order.state_id', '=', 's.id')
            ->where('u.name', 'like', $search)
            ->where('s.name', $filter)
            ->where('osd.active', true)

            ->skip($skip)
            ->take($itemsPerPage)
            ->orderBy("order.$sortBy", $sort)
            ->get()
            ->map(fn ($order) => $order->format());
    }

    public static function counterPagination($search, $filter)
    {
        return Order::select('order.*', 'order.id as id')
            ->join('order_state_detail as osd', 'order.id', '=', 'osd.order_id')
            ->join('state as s', 'osd.state_id', '=', 's.id')
            ->join('users as u', 'order.user_id', '=', 'u.id')

            ->where('u.name', 'like', $search)
            ->where('s.name', $filter)
            ->where('osd.active', true)

            ->count();
    }
}
