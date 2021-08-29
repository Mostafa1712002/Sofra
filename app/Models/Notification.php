<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    protected $table = 'notifications';
    public $timestamps = true;
    protected $fillable = array('title', 'content', 'order_id', 'notifiable_id', 'notifiable_type');

    public function notifiable()
    {
        return $this->morphTo();
    }


    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}
