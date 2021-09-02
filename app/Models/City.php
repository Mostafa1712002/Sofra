<?php

namespace App\Models;


use App\Models\District;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{

    protected $table = 'cities';
    public $timestamps = true;
    protected $fillable = array('name',"id");

    public function districts()
    {
        return $this->hasMany(District::class);
    }

}
