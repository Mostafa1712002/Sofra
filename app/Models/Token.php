<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{

    protected $table = 'tokens';
    public $timestamps = true;
    protected $fillable = array("id",'token', 'platform', 'tokable_id', 'tokable_type');
    protected $hidden= ["tokable_id","tokable_type"];
    public function tokable()
    {
        return $this->morphTo();
    }

}
