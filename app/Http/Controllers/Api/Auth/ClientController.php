<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\Client;
use App\Mail\ClientMail;
use App\Traits\ApiTraits;
use App\Traits\HelperTrait;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Resources\ClientResource;

class ClientController extends Controller
{

    use ApiTraits, HelperTrait;





    ###################  Client Auth      ###############################

    public function register(Request $request)
    {

        $validator = validator()->make($request->all(), [
            "name" => "required|max:80",
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            "email" => "required|email|unique:clients,email",
            "phone" => "required|max:17|unique:clients,phone|min:11",
            "district_id" => "required|max:30|exists:districts,id",
            "password" => "required|confirmed|min:8",
        ]);

        if ($validator->fails()) {
            return $this->responseJson("0", $validator->errors()->first(), $validator->errors());
        }

        $img = $request->file("image");
        $img = $this->uploadImages($img, "images/clients/profile");

        $client = Client::create($request->all());
        $client->update(["image" =>  $img]);
        $accessToken = $client->createToken('authToken')->accessToken;


        return $this->responseJson(1, "تم التسجيل بنجاح", [
            "api_token" => $accessToken,
            "client" => new ClientResource($client)
        ]);
    }




    //  update profile
    public function update(Request $request)
    {

        $id = $request->user()->id;
        $validator = validator()->make($request->all(), [
            "name" => "nullable|max:80",
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            "email" => "nullable|email|unique:clients,email," . $id,
            "phone" => "nullable|max:17|unique:clients,phone," . $id . "|min:11",
            "district_id" => "nullable|max:30|exists:districts,id",
            "password" => "nullable|confirmed|min:8",
        ]);

        if ($validator->fails()) {
            return $this->responseJson((string)"0", $validator->errors()->first(), $validator->errors());
        }

        $client = Client::where("id", $id)->first();
        $client->update($request->all());

        if ($request->image) :
            $img = $request->file("image");
            $img = $this->uploadImages($img, "images/restaurant/clients/profile");
            $client->update(["image" => $img]);
        endif;

        return $this->responseJson(
            1,
            "تم التعديل بنجاح",
            new ClientResource($client)
        );
    }







    // login
    public function login(Request $request)
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
            "client" => new ClientResource($client),

        ]);
    }



    public function resetPassword(Request $request)
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


    public function newPassword(Request $request)
    {
        $validator = validator()->make($request->all(), [
            "pin_code" => "required",
            "password" => "required|confirmed|min:8",
        ]);
        if ($validator->fails()) {
            return $this->responseJson("0", $validator->errors()->first(), ["errors" => $validator->errors()]);
        }

        $client = Client::where("pin_code", $request->pin_code)->where("pin_code", "!=", null)->first();
        if ($client) :

            $client->password = $request->password;
            $client->pin_code = null;
            if ($client->save()) :
                return $this->responseJson("1", "تم تحديت كلمه المرور ");

            else :
                return $this->responseJson("0", "حدث خطأ حاول مره أخري !!");
            endif;
        else :
            return $this->responseJson("0", "هذا الكود غير صحيح ");

        endif;
    }
}




































