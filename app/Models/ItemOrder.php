<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ItemOrder extends Model
{

    protected $table = 'order_product';
    public $timestamps = true;
    protected $fillable = array('product_id', 'quantity', 'price', 'notes');

}
