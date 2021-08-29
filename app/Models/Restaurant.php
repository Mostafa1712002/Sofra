<?php

namespace App\Models;

use App\Models\Offer;
use App\Models\Order;
use App\Models\Token;
use App\Models\Comment;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Category;
use App\Models\District;
use App\Models\Notification;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User;


class Restaurant extends User
{

    use HasApiTokens;
    protected $table = 'restaurants';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'phone', 'state', "password", 'minimum', 'image_restaurant', 'whats_app', 'phone_restaurant', 'delivery_fee', 'district_id');
    protected $hidden = ["password","pin_code"];
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notifiable');
    }

    public function token()
    {
        return $this->morphOne(Token::class, 'tokable');
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes["password"] = bcrypt($value);
    }
}
