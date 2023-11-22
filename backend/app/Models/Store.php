<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Leolopez\Encrypt\Facades\Encrypt;

class Store extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'store';

    protected $data = ['deleted_at'];

    protected $fillable = [
        'id', 'name', 'localization_id', 'created_at', 'updated_at', 'deleted_at',
    ];

    public $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public $timestamps = true;

    public function localization()
    {
        return $this->belongsTo(Localization::class, 'localization_id', 'id');
    }

    public function format()
    {
        return [
            'id' => Encrypt::encryptValue($this->id),
            'name' => $this->name,
            'address' => $this->localization->address,
            'location' => [
                'longitude' => $this->localization->longitude,
                'latitude' => $this->localization->latitude,
            ],
        ];
    }

    public static function allDataSearched($search, $sortBy, $sort, $skip, $itemsPerPage)
    {
        return Store::where('store.name', 'like', $search)
            ->skip($skip)
            ->take($itemsPerPage)
            ->orderBy("store.$sortBy", $sort)
            ->get()
            ->map(fn ($store) => $store->format());
    }

    public static function counterPagination($search)
    {
        return Store::where('store.name', 'like', $search)
            ->count();
    }
}
