<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

    protected $table = 'settings';
    public $timestamps = true;
    protected $fillable = array('about_us', 'commission', 'num_bank_alahli', 'num_bank_alrakhi');

}
