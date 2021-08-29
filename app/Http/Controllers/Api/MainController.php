<?php

namespace App\Http\Controllers\Api;

use App\Models\City;
use App\Models\Offer;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Category;
use App\Models\District;
use App\Traits\ApiTraits;
use App\Models\Restaurant;
use App\Traits\helperTrait;
use Illuminate\Http\Request;
use App\Http\Resources\CityResource;
use App\Http\Resources\OfferResource;
use App\Http\Resources\CommentResource;
use App\Http\Resources\ContactResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\SettingResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\DistrictResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\AllRestaurantResource;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MainController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, ApiTraits, helperTrait;

    ######################## General Api#######################################

    //  get all restaurants and search by city and the name

    public function restaurants(Request $request)
    {
        $records = Restaurant::with("comments")->where(function ($q) use ($request) {
            // Search By city_id and name of restaurant
            if ($request->has("city_id")) :
                $q->wherehas("district", function ($q) use ($request) {
                    $q->where("city_id", $request->city_id);
                });
            endif;

            if ($request->has("name")) :
                $q->where("name", $request->name);
            endif;
        })->paginate(20);
        //  IF No Data
        if ($records->total() == 0) {
            return $this->responseJsonFalse();
        }
        return $this->responseJson("1", "تم الامر", [
            "restaurants" =>   AllRestaurantResource::collection($records),
            "pagination" => $this->getPaginates($records)
        ]);
    }



    //  get Products by the restaurant id

    public function products(Request $request)
    {

        $records = Product::where("restaurant_id", $request->restaurant_id)->paginate(20);
        if ($records->total() == 0) {
            return $this->responseJsonFalse();
        }
        return $this->responseJson("1", "تم الامر", [
            "products" => ProductResource::collection($records),
            "pagination" => $this->getPaginates($records)
        ]);
    }






    //  get restaurant information by the restaurant id

    public function restaurantInfo(Request $request)
    {

        $validator = validator()->make($request->all(), ["id" => "required|exists:restaurants,id"]);
        if ($validator->fails()) {

            return $this->responseJson("0", $validator->errors()->first(), $validator->errors());
        }
        $records = Restaurant::where("id", $request->id)->first();
        if ($records->state == 0) {
            $state = "مغلق";
        } else {
            $state = "مفتوح";
        }
        $records = [
            "الحاله" => $state,
            "المدينه" => $records->district->city->name,
            "الحي" =>  $records->district->name,
            "الحد الأدني " => $records->minimum,
            "رسوم التوصيل " => $records->delivery_fee,
        ];

        return $this->responseJson("1", "تم الامر", $records);
    }






    //  get the about us

    public function aboutUs()
    {

        $record =  Setting::first();
        if (!$record) {
            return $this->responseJsonFalse();
        }

        return  $this->responseJson("1", "تم الامر", $record->about_us);;
    }







    //  get Comment by the restaurant id

    public function comments(Request $request)
    {
        $validator = Validator::make($request->all(), ["restaurant_id" => "required:exists:restaurants,id"]);
        if ($validator->fails()) : return $this->responseJson(0, $validator->errors()->first(), $validator->errors());
        endif;
        $records = Comment::where("restaurant_id", $request->restaurant_id)->paginate(20);
        if ($records->total() == 0) {
            return $this->responseJsonFalse();
        }
        return $this->responseJson("1", "تم الامر", [
            "comments" =>  CommentResource::collection($records),
            "pagination" => $this->getPaginates($records)
        ]);
    }




    //  get the Categories

    public function categories()
    {
        $record =  Category::all();
        if (!$record) {
            return $this->responseJsonFalse();
        }
        return  $this->responseJson("1", "تم الامر", CategoryResource::collection($record));;
    }
    //  get the cities

    public function cities()
    {

        $records =  City::all();
        if (!$records) {
            return $this->responseJsonFalse();
        }


        return  $this->responseJson("1", "تم الامر", CityResource::collection($records));;
    }
    //  to get districts of city
    public function districts(Request $request)
    {

        $validator = validator()->make($request->all(), ["city_id" => "required|exists:cities,id"]);
        if ($validator->fails()) {
            return $this->responseJson("0", $validator->errors()->first(), $validator->errors());
        }

        $records = District::where("city_id", $request->city_id)->get();

        return  $this->responseJson("1", "تم الامر", DistrictResource::collection($records));;
    }

    //  to get the offers for the restaurant by id
    public function offers(Request $request)
    {
        $rules = [
            "restaurant_id" => "required|exists:restaurants,id"
        ];
        $validator = validator()->make($request->all(), $rules);

        if ($validator->fails()) :
            return $this->responseJson("0", $validator->errors()->first(), $validator->errors());
        endif;

        $records = Offer::where("restaurant_id", $request->restaurant_id)->orderBy("created_at")->paginate(20);
        return $this->responseJson("1", "تم الامر ", [
            "offers" => OfferResource::collection($records),
            "pagination" => $this->getPaginates($records)

        ]);
    }
    //  To create new  message for contact us
    public function contactUs(Request $request)
    {
        $rules = [
            "full_name" => "required",
            "email" => "required|email",
            "phone" => "required",
            "message" => "required",
            "type" => "required|in:complaint,suggest,query",

        ];
        $validator = validator()->make($request->all(), $rules);

        if ($validator->fails()) :
            return $this->responseJson("0", $validator->errors()->first(), $validator->errors());
        endif;

        $record = Contact::create($request->all());

        return $this->responseJson("1", "تم الامر", new ContactResource($record));
    }


    // Get Settings
    public function allSettings()
    {
        return $this->responseJson("1", "تم الامر", new SettingResource($this->settings()));
    }
    //  Update Settings
    public function updateSettings(Request $request)
    {


        $rules = [
            "about_us" => "nullable",
            "commission" => "nullable|numeric|between:0,1",
            "num_bank_alahli" => "integer|nullable",
            "num_bank_alrakhi" => "integer|nullable",
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) :
            return $this->responseJson("0",  $validator->errors()->first(), $validator->errors());
        endif;
        $settingsArr = [];

        if ($request->about_us) {
            $settingsArr["about_us"] = $request->about_us;
        }

        if ($request->commission) {
            $settingsArr["commission"] = $request->commission;
        }
        if ($request->num_bank_alahli) {
            $settingsArr["num_bank_alahli"] = $request->num_bank_alahli;
        }
        if ($request->num_bank_alrakhi) {
            $settingsArr["num_bank_alrakhi"] = $request->num_bank_alrakhi;
        }

        Setting::where("id", "1")->update($settingsArr);

        return $this->responseJson("1", "تم الامر", new SettingResource($this->settings()));
    }




}
