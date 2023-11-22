<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'client_type',
        'name',
        'company',
        'giro',
        'address',
        'department',
        'municipality',
        'nit',
        'iva',
        'dui',
        'phone',
        'phone_call',
        'phone_whatsapp',
        'email',
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }

    public function format()
    {
        return [
            'id' => $this->id,
            'client_type' => $this->client_type == 1 ? 'Contribuyente' : 'No contribuyente',
            'name' => $this->name,
            'company' => $this->company,
            'giro' => $this->giro,
            'address' => $this->address,
            'department' => $this->department,
            'municipality' => $this->municipality,
            'nit' => $this->nit,
            'iva' => $this->iva,
            'dui' => $this->dui,
            'phone' => $this->phone,
            'phone_call' => $this->phone_call,
            'phone_whatsapp' => $this->phone_whatsapp,
            'email' => $this->email,
            'role' => $this->role?->name,
        ];
    }

    public static function allDataSearched($search, $sortBy, $sort, $skip, $itemsPerPage)
    {
        return User::select('users.*', 'users.id as id')

            ->where('users.name', 'like', $search)
            ->orWhere('users.company', 'like', $search)
            ->orWhere('users.dui', 'like', $search)
            ->orWhere('users.nit', 'like', $search)
            ->orWhere('users.email', 'like', $search)

            ->skip($skip)
            ->take($itemsPerPage)
            ->orderBy("users.$sortBy", $sort)
            ->get()
            ->map(fn ($users) => $users->format());
    }

    public static function counterPagination($search)
    {
        return User::select('users.*', 'users.id as id')

            ->where('users.name', 'like', $search)
            ->orWhere('users.company', 'like', $search)
            ->orWhere('users.dui', 'like', $search)
            ->orWhere('users.nit', 'like', $search)
            ->orWhere('users.email', 'like', $search)

            ->count();
    }
}
