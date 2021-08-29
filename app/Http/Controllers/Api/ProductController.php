<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Traits\ApiTraits;
use App\Traits\helperTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller as BaseController;

class ProductController extends BaseController
{

    use ApiTraits, helperTrait;
    //  Create new Product
    public function createProduct(Request $request)
    {
        $rules = [
            "name" => "required|min:8|max:225",
            "description" => "required|min:20",
            "price" => "required|numeric|between:0,9999.99",
            "price_offer" => "required|numeric|between:0,9999.99",
            "price" => "required|numeric|between:0,9999.99",
            // 'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            "request_time" => "required|date_format:H:i:s",
        ];

        $validator = validator()->make($request->all(), $rules);

        if ($validator->fails()) :
            return $this->responseJson(0, $validator->errors()->first(), $validator->errors());
        endif;
        // $img = $request->file("image");
        // $img  = $this->uploadImages($img, "images/restaurant/product");

        $product = Product::create([
            "name" => $request->name,
            "description" => $request->description,
            "price_offer" => $request->price_offer,
            "price" => $request->price,
            // "image" =>  "images/restaurant/product" . $img,
            "request_time" => $request->request_time,
            "restaurant_id" => $request->user()->id
        ]);

        return $this->responseJson(1, "تم إنشاء المنتج بنجاح", new ProductResource($product));
    }

    // Update Product
    public function updateProduct(Request $request)
    {
        $rules = [
            "product_id" => "required|exists:products,id",
            "name" => "nullable|min:8|max:225",
            // 'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            "description" => "nullable|min:20",
            "price" => "nullable|numeric|between:0,9999.99",
            "price_offer" => "nullable|numeric|between:0,9999.99",
            "request_time" => "nullable|date_format:H:i:s",
        ];
        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails()) :
            return $this->responseJson(0, $validator->errors()->first(), $validator->errors());
        endif;

        $product = [];
        if ($request->name) :
            $product["name"] = $request->name;
        endif;

        if ($request->description) :
            $product["description"] = $request->description;
        endif;

        if ($request->price) :
            $product["price"] = $request->price;
        endif;

        if ($request->price_offer) :
            $product["price_offer"] = $request->price_offer;
        endif;
        // if ($request->image) :
        //     $img = $request->file("image");
        //     $img  = $this->uploadImages($img, "images/restaurant/product");
        //     $product["image"] = "images/restaurant/product" . $img;
        // endif;

        if ($request->request_time) :
            $product["request_time"] = $request->request_time;
        endif;


        Product::where("id", $request->product_id)->update($product);
        $product = Product::where("id", $request->product_id)->first();

        return $this->responseJson(1, "تم تعديل المنتج بنجاح", new ProductResource($product));
    }

    // Method to Delete Product
    public function deleteProduct(Request $request)
    {
        $rules = [
            "product_id" => "required|exists:products,id",
        ];
        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails()) :
            return $this->responseJson(0, $validator->errors()->first(), $validator->errors());
        endif;
        $product = Product::where("id", $request->product_id)->delete();


        if ($product) {
            return    $this->responseJson("1", "تم حذف المنتج بنجاح");
        }
    }
}
