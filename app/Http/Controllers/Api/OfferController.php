<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\OfferResource;
use App\Models\Offer;
use App\Traits\ApiTraits;
use App\Traits\helperTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller as BaseController;

class OfferController extends BaseController
{


    use ApiTraits, helperTrait;
    //  Create new Offer
    public function createOffer(Request $request)
    {
        $rules = [
            "name" => "required|min:8|max:225",
            "description" => "required|min:20",
            "date_to" => "required|date_format:Y-m-d",
            "date_from" => "required|date_format:Y-m-d",
            // 'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        $validator = validator()->make($request->all(), $rules);

        if ($validator->fails()) :
            return $this->responseJson(0, $validator->errors()->first(), $validator->errors());
        endif;
        // $img = $request->file("image");
        // $img  = $this->uploadImages($img, "images/restaurant/Offer");

        $Offer = Offer::create([
            "name" => $request->name,
            "description" => $request->description,
            "date_to" => $request->date_to,
            "date_from" => $request->date_from,
            // "image" =>  "images/restaurant/Offer" . $img,
            "restaurant_id" => $request->user()->id
        ]);

        return $this->responseJson(1, "تم إنشاء العرض بنجاح", new OfferResource($Offer));
    }

    // Update Offer
    public function updateOffer(Request $request)
    {
        $rules = [
            "offer_id" => "required|exists:offers,id",
            "name" => "nullable|min:8|max:225",
            "description" => "nullable|min:20",
            "date_to" => "nullable|date_format:Y-m-d",
            "date_from" => "nullable|date_format:Y-m-d",
            // 'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails()) :
            return $this->responseJson(0, $validator->errors()->first(), $validator->errors());
        endif;

        $offer = [];
        if ($request->name) :
            $offer["name"] = $request->name;
        endif;

        if ($request->description) :
            $offer["description"] = $request->description;
        endif;

        if ($request->date_from) :
            $offer["date_from"] = $request->date_from;
        endif;

        if ($request->date_to) :
            $offer["date_to"] = $request->date_to;
        endif;
        // if ($request->image) :
        //     $img = $request->file("image");
        //     $img  = $this->uploadImages($img, "images/restaurant/offer");
        //     $offer["image"] = "images/restaurant/offer" . $img;
        // endif;




        $offer = Offer::where("id", $request->offer_id)->update($offer);
        $offer = Offer::where("id", $request->offer_id)->first();
        return $this->responseJson(1, "تم تعديل العرض بنجاح", new OfferResource($offer));
    }

    // Method to Delete Offer
    public function deleteOffer(Request $request)
    {
        $rules = [
            "offer_id" => "required|exists:offers,id",
        ];
        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails()) :
            return $this->responseJson(0, $validator->errors()->first(), $validator->errors());
        endif;
        $offer = Offer::where("id", $request->offer_id)->delete();


        if ($offer) {
            return    $this->responseJson("1", "تم حذف العرض بنجاح");
        }
    }
}
