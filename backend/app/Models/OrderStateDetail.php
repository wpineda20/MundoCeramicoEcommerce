<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStateDetail extends Model
{
    use HasFactory;

    protected $table = 'order_state_detail';

    protected $data = ['deleted_at'];

    protected $fillable = [
        'id',
        'order_id',
        'state_id',
        'active',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id', 'id');
    }
}
