<?php

namespace App\Models;

use App\Models\Client;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $table = 'comments';
    public $timestamps = true;
    protected $fillable = array('content', 'rating', 'client_id', 'restaurant_id');

    public function clients()
    {
        return $this->belongsTo(Client::class);
    }

    public function restaurants()
    {
        return $this->belongsTo(Restaurant::class);
    }

}
