<?php

namespace App\Models;


use App\Models\Order;
use App\Models\Token;
use Illuminate\Foundation\Auth\User;
use App\Models\Comment;
use App\Models\District;
use App\Models\Notification;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Client  extends User
{

    use HasApiTokens;
    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'password', 'pin_code', 'phone', 'image', 'district_id');
    protected $hidden = ["password"];
    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notifiable');
    }


    public function tokens()
    {
        return $this->morphMany(Token::class, 'tokable');
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes["password"] = bcrypt($value);
    }
}
