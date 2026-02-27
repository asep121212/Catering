<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // =========================
    // RELASI
    // =========================

    public function merchantProfile()
    {
        return $this->hasOne(MerchantProfile::class);
    }

    public function menus()
    {
        return $this->hasMany(Menu::class, 'merchant_id');
    }

    public function customerOrders()
    {
        return $this->hasMany(Order::class, 'customer_id');
    }

    public function merchantOrders()
    {
        return $this->hasMany(Order::class, 'merchant_id');
    }
}