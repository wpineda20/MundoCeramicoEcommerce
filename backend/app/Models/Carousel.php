<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Carousel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'carousel';

    protected $data = ['deleted_at'];

    protected $fillable = [
        'id',
        'title',
        'status',
        'image_url',
        'created_at',
        'updated_at',
    ];

    public $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public $timestamps = true;

    public function format()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'status' => $this->status == 1 ? true : false,
            // 'image_url' => $this->image_url,
            'image_url' => getenv('APP_URL') . "$this->image_url",
        ];
    }

    public static function allDataSearched($search, $sortBy, $sort, $skip, $itemsPerPage)
    {
        return Carousel::select('carousel.*', 'carousel.id as id')

            ->where('carousel.title', 'like', $search)

            ->skip($skip)
            ->take($itemsPerPage)
            ->orderBy("carousel.$sortBy", $sort)
            ->get()
            ->map(fn ($carousel) => $carousel->format());
    }

    public static function counterPagination($search)
    {
        return Carousel::select('carousel.*', 'carousel.id as id')

            ->where('carousel.title', 'like', $search)

            ->count();
    }
}
