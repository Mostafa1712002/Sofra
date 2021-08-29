<?php

namespace App\Models;


use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $table = 'products';
    public $timestamps = true;
    protected $fillable = array('name', 'description', 'price', 'price_offer', 'request_time', 'restaurant_id');

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }


}
