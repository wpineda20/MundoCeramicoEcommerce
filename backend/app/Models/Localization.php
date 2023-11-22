<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Localization extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'localization';

    protected $data = ['deleted_at'];

    protected $fillable = [
        'id', 'name', 'longitude', 'latitude', 'address', 'created_at', 'updated_at', 'deleted_at',
    ];

    public $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public $timestamps = true;

    public function store()
    {
        return $this->belongsTo(Store::class, 'localization_id', 'id');
    }

    public function format()
    {
        return [
            "distance" => $this->distance ?? 0,
            "location" => [
                "longitude" => $this->longitude,
                "latitude" => $this->latitude,
            ],
            "name" => $this->name,
        ];
    }

    public static function allDataSearched($search, $sortBy, $sort, $skip, $itemsPerPage)
    {
        return Localization::select('localization.*', 'localization.id as id')

            ->where('localization.name', 'like', $search)
            ->orWhere('localization.longitude', 'like', $search)
            ->orWhere('localization.latitude', 'like', $search)
            ->orWhere('localization.address', 'like', $search)

            ->skip($skip)
            ->take($itemsPerPage)
            ->orderBy("localization.$sortBy", $sort)
            ->get();
    }

    public static function counterPagination($search)
    {
        return Localization::select('localization.*', 'localization.id as id')

            ->where('localization.name', 'like', $search)
            ->orWhere('localization.longitude', 'like', $search)
            ->orWhere('localization.latitude', 'like', $search)
            ->orWhere('localization.address', 'like', $search)

            ->count();
    }
}
