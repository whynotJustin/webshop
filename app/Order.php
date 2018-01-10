<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $connection = 'mysql';
    protected $primaryKey = 'id';
    protected $table = 'orders';
    protected $fillable = [
        'order_date', 'quantity', 'total_price', 'user_id', 'product_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
