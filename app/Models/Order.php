<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'merchant_id',
        'order_date',
        'delivery_date',
        'total_price',
        'status'
    ];

    protected $casts = [
        'order_date' => 'date',
        'delivery_date' => 'date',
    ];


    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function merchant()
    {
        return $this->belongsTo(User::class, 'merchant_id');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }

    public function menu()
    {
        return $this->hasManyThrough(
            Menu::class,      
            OrderItem::class, 
            'order_id',       
            'id',             
            'id',             
            'menu_id'         
        );
    }
}