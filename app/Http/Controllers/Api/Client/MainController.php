<?php

namespace App\Http\Controllers\Api\Client;

use App\Models\Token;
use App\Models\Comment;
use App\Traits\ApiTraits;
use App\Traits\helperTrait;
use Illuminate\Http\Request;
use App\Http\Resources\CommentResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller as BaseController;

class MainController extends BaseController
{


    use ApiTraits, helperTrait;

    //  Create new Comment
    public function createComment(Request $request)
    {
        $rules = [
            "content" => "required",
            "rating" => "required|in:star1,star2,star3,star4,star5",
            "restaurant_id" => "required|exists:restaurants,id",
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {

            return $this->responseJson("0", $validator->errors()->first(), $validator->errors());
        }

        $comment = Comment::create([
            "content" => $request->content,
            "rating" => $request->rating,
            "restaurant_id" =>  $request->restaurant_id,
            "client_id" => $request->user()->id
        ]);


        return $this->responseJson("1", "تم الامر",  new CommentResource($comment));
    }


    // Add Token
    public function addToken(Request $request)
    {


        $rules = [
            "platform" => "required|in:android,ios",
            "tokens" => "required|array|min:1",
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
        $tokens = Token::where("tokable_id", $request->user()->id)->where("tokable_type", "App\Models\Client")->get();
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
