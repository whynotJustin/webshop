<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_date', 'quantity', 'total_price', 'user_id', 'product_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
