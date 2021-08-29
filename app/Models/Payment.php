<?php

namespace App\Models;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    protected $table = 'payments';
    public $timestamps = true;
    protected $fillable = array('restaurant_id', 'paid', 'payment_date', 'notes');

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

}
