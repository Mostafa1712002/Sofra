<?php

namespace App\Http\Controllers\Api\Auth;


use App\Mail\ClientMail;
use App\Traits\ApiTraits;
use App\Models\Restaurant;
use App\Traits\HelperTrait;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Resources\ClientResource;
use App\Http\Resources\RestaurantResource;

class RestaurantController extends Controller
{


    use ApiTraits, HelperTrait;


    ###################  Restaurant Auth      ###############################


    public function register(Request $request)
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
            "category_id" => "required|array|min:1|exists:categories,id",
            'image_restaurant' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        if ($validator->fails()) {
            return $this->responseJson((string)"0", $validator->errors()->first(), $validator->errors());
        }

        $img = $request->file("image");
        $img = $this->uploadImages($img, "images/restaurant/app/restaurant");

        $image_restaurant = $request->file("image_restaurant");
        $image_restaurant = $this->uploadImages($image_restaurant, "images/restaurant/app/restaurant");

        $restaurant = Restaurant::create($request->all());
        $restaurant->categories()->attach($request->category_id);

        $restaurant->update([
            "image" =>  $img,
            "image_restaurant" =>   $image_restaurant
        ]);

        $accessToken = $restaurant->createToken('authToken')->accessToken;

        return $this->responseJson(1, "تم التسجيل بنجاح", [
            "api_token" => $accessToken,
            "data" => new RestaurantResource($restaurant)
        ]);


    }




    public function update(Request $request)
    {


        $id = $request->user()->id;
        $validator = validator()->make($request->all(), [
            "name" => "nullable|max:80|unique:restaurants,name," . $id,
            "email" => "nullable|email|unique:restaurants,email," . $id,
            "phone" => "nullable|max:17|unique:restaurants,phone," . $id . "|min:11",
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

        $restaurant = Restaurant::where("id", $id)->first();
        $restaurant->update($request->all());

        if ($request->category_id) :
            $restaurant->categories()->sync($request->category_id);
        endif;

        //  show image is exists or not
        if ($request->image) :
            $img = $request->file("image");
            $img = $this->uploadImages($img, "images/restaurant/app/restaurant");
            $restaurant->update(["image" => $img]);
        endif;

        if ($request->image_restaurant) :
            $image_restaurant = $request->file("image_restaurant");
            $image_restaurant = $this->uploadImages($image_restaurant, "images/restaurant/app/restaurant");
            $restaurant->update(["image_restaurant" => $image_restaurant]);
        endif;

        return $this->responseJson(
            1,
            "تم التعديل بنجاح",
            new RestaurantResource($restaurant)
        );
    }



    public function login(Request $request)
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



    public function resetPassword(Request $request)
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


    public function newPassword(Request $request)
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
}
