<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Client;
use App\Mail\ClientMail;
use App\Traits\ApiTraits;
use App\Models\Restaurant;
use App\Traits\helperTrait;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Resources\ClientResource;
use App\Http\Resources\RestaurantResource;

class AuthController extends Controller
{

    use ApiTraits, helperTrait;




    // Admin Api
    public function loginAdmin(Request $request)
    {


        $validator = validator()->make($request->all(), [
            "email" => "email|required",
            "password" => "required|min:8",
        ]);


        if ($validator->fails()) {
            return $this->responseJson(0, $validator->errors()->first(), $validator->errors());
        }

        if ($request->email != "admin@admingmail.com") {
            return $this->responseJson("0", "هذا الايمبل غير صالح لتعديل في التطبيق");
        }

        $auth = Auth::guard("web")->attempt(['email' => $request->email, 'password' => $request->password]);

        if (!$auth) {
            return $this->responseJson("0", "راجع بياناتك هناك خطأ");
        }

        $user = User::where("email", $request->email)->first();
        $accessToken = $user->createToken('authToken')->accessToken;
        return $this->responseJson(1, "تم التسجيل بنجاح", ["api_token" => $accessToken]);
    }


    //  Update admin Api info
    public function updateAdmin(Request $request)
    {


        $validator = validator()->make($request->all(), [
            "email" => "email|nullable",
            "password" => "confirmed|nullable|min:8",
        ]);

        if ($validator->fails()) {
            return $this->responseJson(0, $validator->errors()->first(), $validator->errors());
        }
        $adminArr = [];

        if ($request->password) {
            $adminArr["password"] = $request->password;
        }
        if ($request->email) {
            $adminArr["email"] = $request->email;
        }

        if ($request->user()->id != "1") {
            return $this->responseJson("0", "هذا الايمبل غير صالح لتعديل في التطبيق");
        }

        if (isset($adminArr["email"]) || isset($adminArr["password"])) {

            User::where("id", "1")->update($adminArr);
            $user = User::where("email", $request->email)->first();
            $accessToken = $user->createToken('authToken')->accessToken;
            return $this->responseJson(1, "تم التسجيل بنجاح", ["api_token" => $accessToken]);
        }

        return $this->responseJson("0", "انت لم تقم بأي تعديل");
    }




    ###################  Client Auth      ###############################

    public function clientRegister(Request $request)
    {


        $validator = validator()->make($request->all(), [
            "name" => "required|max:80",
            // 'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            "email" => "required|email|unique:clients,email",
            "phone" => "required|max:17|unique:clients,phone|min:11",
            "district_id" => "required|max:30|exists:districts,id",
            "password" => "required|confirmed|min:8",
        ]);

        if ($validator->fails()) {
            return $this->responseJson((string)"0", $validator->errors()->first(), $validator->errors());
        }

        // $img = $request->file("image");
        // $img = $this->uploadImages($img, "images/client/profile");

        $client = Client::create($request->all());
        // $client->update(["image" => "/images/client/profile" . $img]);
        $accessToken = $client->createToken('authToken')->accessToken;


        return $this->responseJson(1, "تم التسجيل بنجاح", [
            "api_token" => $accessToken,
            "data" => new ClientResource($client)
        ]);
    }



    public function clientLogin(Request $request)
    {

        $validator = validator()->make($request->all(), [
            "email" => "email|required",
            "password" => "required|min:8",
        ]);

        if ($validator->fails()) {
            return $this->responseJson(0, $validator->errors()->first(), $validator->errors());
        }


        $auth = Auth::guard("client")->attempt(['email' => $request->email, 'password' => $request->password]);

        if (!$auth) {
            return $this->responseJson("0", "راجع بياناتك هناك خطأ");
        }

        $client = Client::where("email", $request->email)->first();
        $accessToken = $client->createToken('authToken')->accessToken;
        return $this->responseJson(1, "تم التسجيل بنجاح", [
            "api_token" => $accessToken,
            "data" => new ClientResource($client),

        ]);
    }



    public function clientResetPassword(Request $request)
    {
        $validator = validator()->make($request->all(), [
            "email" => "required|exists:Restaurants,email",
        ]);
        if ($validator->fails()) {
            return $this->responseJson("0", $validator->errors()->first(), $validator->errors());
        }

        $pin_code = rand(11111, 99999);
        Client::where("email", $request->email)->update(["pin_code" => $pin_code]);
        $Restaurant = Client::where("pin_code", $pin_code)->first();
        Mail::to($Restaurant->email)->send(new ClientMail($Restaurant));
        // Nexmo::message()->send([
        //     "to" => "201022348224",
        //     "from" => "+20148976476",
        //     "text" => "your pin_code is " . $pin_code]
        // );
        return $this->responseJson("1", "تم ارسال رمز التحقق", [
            "pin_code" => $pin_code,
        ]);
    }


    public function clientNewPassword(Request $request)
    {
        $validator = validator()->make($request->all(), [
            "pin_code" => "required",
            "password" => "required|confirmed|min:8",
        ]);
        if ($validator->fails()) {
            return $this->responseJson("0", $validator->errors()->first(), ["errors" => $validator->errors()]);
        }

        $Restaurant = Client::where("pin_code", $request->pin_code)->where("pin_code", "!=", null)->first();
        if ($Restaurant) :
            // Restaurant::where("pin_code",$request->pin_code)->update(["password" => $request->password]);
            $Restaurant->password = $request->password;
            $Restaurant->pin_code = null;
            if ($Restaurant->save()) :
                return $this->responseJson("1", "تم تحديت كلمه المرور ");

            else :
                return $this->responseJson("0", "حدث خطأ حاول مره أخري !!");
            endif;
        else :
            return $this->responseJson("0", "هذا الكود غير صحيح ");

        endif;
    }


    public function clientUpdate(Request $request)
    {


        $id = $request->user()->id;
        $validator = validator()->make($request->all(), [
            "name" => "nullable|max:80",
            // 'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            "email" => "nullable|email|unique:clients,email," . $id,
            "phone" => "nullable|max:17|unique:clients,phone," . $id . "|min:11",
            "district_id" => "nullable|max:30|exists:districts,id",
            "password" => "nullable|confirmed|min:8",


        ]);

        if ($validator->fails()) {
            return $this->responseJson((string)"0", $validator->errors()->first(), $validator->errors());
        }

        $clientArr = [];

        if ($request->name) :
            $clientArr["name"] = $request->name;
        endif;

        if ($request->email) :
            $clientArr["email"] = $request->email;
        endif;

        if ($request->phone) :
            $clientArr["phone"] = $request->phone;
        endif;

        if ($request->district_id) :
            $clientArr["district_id"] = $request->district_id;
        endif;

        if ($request->password) :
            $clientArr["password"] = $request->password;
        endif;



        // if ($request->image) :
        // $img = $request->file("image");
        // $img = $this->uploadImages($img, "images/restaurant/app");
        // $clientArr["image"] = $img;
        // endif;


        $client = Client::where("id", $id)->update($clientArr);
        $client = Client::where("id", $id)->first();


        return $this->responseJson(
            1,
            "تم التعديل بنجاح",
            new ClientResource($client)
        );
    }




    ###################  Restaurant Auth      ###############################


    public function restaurantRegister(Request $request)
    {


        $validator = validator()->make($request->all(), [
            "name" => "required|max:80|unique:restaurants,name",
            "email" => "required|email|unique:restaurants,email",
            "phone" => "required|max:17|unique:restaurants,phone|min:11",
            "whats_app" => "required|max:17|unique:restaurants,whats_app|min:11",
            "state" => "required|in:0,1",
            "minimum" => 'required|numeric|between:0,999.99',
            "delivery_fee" => 'required|numeric|between:0,1.0',
            "phone_restaurant" => "required|max:17|unique:restaurants,phone_restaurant|min:11",
            "district_id" => "required|max:30|exists:districts,id",
            "password" => "required|confirmed|min:8",
            "category_id" => "required|array|min:1|exists:categories,id"
            // 'image_restaurant' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',


        ]);

        if ($validator->fails()) {
            return $this->responseJson((string)"0", $validator->errors()->first(), $validator->errors());
        }

        // $img = $request->file("image");
        // $img = $this->uploadImages($img, "images/restaurant/app");

        // $image_restaurant = $request->file("image_restaurant");
        // $image_restaurant = $this->uploadImages($image_restaurant, "images/restaurant/app");


        $restaurant = Restaurant::create($request->all());
        $restaurant->categories()->attach($request->category_id);
        // $restaurant->update([
        //     "image" => "/images/restaurant/profile" . $img,
        //     "image_restaurant" => "/images/restaurant/app"  . $image_restaurant
        // ]);
        $accessToken = $restaurant->createToken('authToken')->accessToken;

        return $this->responseJson(1, "تم التسجيل بنجاح", [
            "api_token" => $accessToken,
            "data" => new RestaurantResource($restaurant)
        ]);
    }



    public function restaurantLogin(Request $request)
    {

        $validator = validator()->make($request->all(), [
            "email" => "email|required",
            "password" => "required|min:8",
        ]);

        if ($validator->fails()) {
            return $this->responseJson(0, $validator->errors()->first(), $validator->errors());
        }

        $auth = Auth::guard("restaurant")->attempt(['email' => $request->email, 'password' => $request->password]);

        if (!$auth) {
            return $this->responseJson("0", "راجع بياناتك هناك خطأ");
        }

        $restaurant = Restaurant::where("email", $request->email)->first();
        $accessToken = $restaurant->createToken('authToken')->accessToken;

        return $this->responseJson(1, "تم التسجيل بنجاح", [
            "api_token" => $accessToken,
            "data" => new RestaurantResource($restaurant),

        ]);
    }



    public function restaurantResetPassword(Request $request)
    {
        $validator = validator()->make($request->all(), [
            "email" => "required|exists:restaurants,email",
        ]);
        if ($validator->fails()) {
            return $this->responseJson("0", $validator->errors()->first(), $validator->errors());
        }

        $pin_code = rand(11111, 99999);
        Restaurant::where("email", $request->email)->update(["pin_code" => $pin_code]);
        $Restaurant = Restaurant::where("pin_code", $pin_code)->first();
        Mail::to($Restaurant->email)->send(new ClientMail($Restaurant));
        // Nexmo::message()->send([
        //     "to" => "201022348224",
        //     "from" => "+20148976476",
        //     "text" => "your pin_code is " . $pin_code]
        // );
        return $this->responseJson("1", "تم ارسال رمز التحقق", [
            "pin_code" => $pin_code,
        ]);
    }

    public function restaurantNewPassword(Request $request)
    {
        $validator = validator()->make($request->all(), [
            "pin_code" => "required",
            "password" => "required|confirmed|min:8",
        ]);
        if ($validator->fails()) {
            return $this->responseJson("0", $validator->errors()->first(), ["errors" => $validator->errors()]);
        }

        $restaurant = Restaurant::where("pin_code", $request->pin_code)->where("pin_code", "!=", null)->first();
        if ($restaurant) :
            // Restaurant::where("pin_code",$request->pin_code)->update(["password" => $request->password]);
            $restaurant->password = $request->password;
            $restaurant->pin_code = null;
            if ($restaurant->save()) :
                return $this->responseJson("1", "تم تحديت كلمه المرور ");

            else :
                return $this->responseJson("0", "حدث خطأ حاول مره أخري !!");
            endif;
        else :
            return $this->responseJson("0", "هذا الكود غير صحيح ");

        endif;
    }


    public function restaurantUpdate(Request $request)
    {


        $id = $request->user()->id;
        $validator = validator()->make($request->all(), [
            "name" => "nullable|max:80|unique:restaurants,name," . $id,
            "email" => "nullable|email|unique:restaurants,email," . $id,
            "phone" => "nullable|max:17|unique:restaurants,phone ," . $id . "|min:11",
            "whats_app" => "nullable|max:17|unique:restaurants,whats_app," . $id . "|min:11",
            "state" => "nullable|in:0,1",
            "minimum" => 'nullable|numeric|between:0,999.99',
            "delivery_fee" => 'nullable|numeric|between:0,1.0',
            "phone_restaurant" => "nullable|max:17|unique:restaurants,phone_restaurant," . $id . "|min:11",
            "district_id" => "nullable|max:30|exists:districts,id",
            "password" => "nullable|confirmed|min:8",
            "category_id" => "nullable|array|min:1|exists:categories,id",
            'image_restaurant' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',


        ]);

        if ($validator->fails()) {
            return $this->responseJson((string)"0", $validator->errors()->first(), $validator->errors());
        }

        $restaurantArr = [];

        if ($request->name) :
            $restaurantArr["name"] = $request->name;
        endif;

        if ($request->email) :
            $restaurantArr["email"] = $request->email;
        endif;

        if ($request->phone) :
            $restaurantArr["phone"] = $request->phone;
        endif;

        if ($request->whats_app) :
            $restaurantArr["whats_app"] = $request->whats_app;
        endif;
        if ($request->state) :
            $restaurantArr["state"] = $request->state;
        endif;
        if ($request->minimum) :
            $restaurantArr["minimum"] = $request->minimum;
        endif;

        if ($request->delivery_fee) :
            $restaurantArr["delivery_fee"] = $request->delivery_fee;
        endif;
        if ($request->phone_restaurant) :
            $restaurantArr["phone_restaurant"] = $request->phone_restaurant;
        endif;

        if ($request->district_id) :
            $restaurantArr["district_id"] = $request->district_id;
        endif;

        if ($request->password) :
            $restaurantArr["password"] = $request->password;
        endif;



        // if ($request->image) :
        // $img = $request->file("image");
        // $img = $this->uploadImages($img, "images/restaurant/app");
        // $restaurantArr["image"] = $img;
        // endif;

        // if ($request->image_restaurant) :
        // $image_restaurant = $request->file("image_restaurant");
        // $image_restaurant = $this->uploadImages($image_restaurant, "images/restaurant/app");
        // $restaurantArr["image_restaurant"] = $image_restaurant;
        // endif;


        $restaurant = Restaurant::where("id", $id)->update($restaurantArr);
        $restaurant = Restaurant::where("id", $id)->first();
        if ($request->category_id) :
            $restaurant->categories()->sync($request->category_id);
        endif;


        return $this->responseJson(
            1,
            "تم التعديل بنجاح",
            new RestaurantResource($restaurant)
        );
    }
}
