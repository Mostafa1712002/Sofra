<?php

namespace App\Models;

use App\Models\City;
use App\Models\Client;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{

    protected $table = 'districts';
    public $timestamps = true;
    protected $fillable = array('name', 'city_id');

    public function restaurants()
    {
        return $this->hasMany(Restaurant::class);
    }

    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

}
