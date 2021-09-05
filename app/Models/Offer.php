<?php

namespace App\Models;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{



    protected $table = 'offers';
    public $timestamps = true;
    protected $fillable = array("id",'name', 'image', 'description', 'date_to', 'date_from', 'restaurant_id');

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

}
