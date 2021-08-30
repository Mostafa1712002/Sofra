<?php

namespace App\Http\Controllers\Api\Restaurant;

use App\Models\Token;
use App\Traits\ApiTraits;
use App\Traits\helperTrait;
use Illuminate\Http\Request;
use App\Http\Resources\TokenResource;
use Illuminate\Routing\Controller as BaseController;

class TokenController extends BaseController
{

    use ApiTraits, helperTrait;

    // Add Token
    public function addToken(Request $request)
    {

        $rules = [
            "platform" => "required|in:android,ios",
            "tokens" => "required|array|min:0",
        ];

        $validator = validator()->make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->responseJson("0", $validator->errors()->first(), $validator->errors());
        }

        foreach ($request->tokens as $t) {
            Token::where("token", $t)->delete();
            $request->user()->tokens()->create([
                "platform" => $request->platform,
                "token" => $t
            ]);
        }

        $tokens = Token::where("tokable_id", $request->user()->id)->where("tokable_type", "App\Models\Restaurant")->get();

        return $this->responseJson("1", "  تم الامر", $tokens);
    }




    // Remove Token

    public function removeToken(Request $request)
    {
        $validator = validator()->make($request->all(), [
            "tokens" => "required|array|min:1",
        ]);

        if ($validator->fails()) {
            return $this->responseJson("0", $validator->errors()->first(), $validator->errors());
        }

        foreach ($request->tokens as $t) {
            Token::where("token", $t)->delete();
        }
        return $this->responseJson("0", " تم الحذف");
    }
}
