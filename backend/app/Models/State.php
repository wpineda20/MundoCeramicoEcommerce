<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'state';

    protected $data = ['deleted_at'];

    protected $fillable = [
        'id', 'name', 'created_at', 'updated_at', 'deleted_at',
    ];

    public $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public $timestamps = true;

    public function stateDetail()
    {
        return $this->hasOne(OrderStateDetail::class, 'state_id', 'id');
    }

    public function format()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'created_at' => $this->stateDetail?->created_at?->diffForHumans()
        ];
    }

    public static function allDataSearched($search, $sortBy, $sort, $skip, $itemsPerPage)
    {
        return State::select('state.*', 'state.id as id')

            ->where('state.name', 'like', $search)

            ->skip($skip)
            ->take($itemsPerPage)
            ->orderBy("state.$sortBy", $sort)
            ->get();
    }

    public static function counterPagination($search)
    {
        return State::select('state.*', 'state.id as id')

            ->where('state.name', 'like', $search)

            ->count();
    }
}
