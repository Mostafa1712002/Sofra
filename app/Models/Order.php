<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Client;
use App\Models\Restaurant;
use App\Models\Notification;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $table = 'orders';
    public $timestamps = true;
    protected $fillable = array('name','insert_time', 'address', 'method_payment', 'state', 'price', 'client_id', 'restaurant_id', 'cost', 'delivery_cost', 'total', 'commission', 'net');

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }




}
