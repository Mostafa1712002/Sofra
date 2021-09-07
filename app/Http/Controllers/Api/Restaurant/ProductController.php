<?php

namespace App\Http\Controllers\Api\Restaurant;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Traits\ApiTraits;
use App\Traits\HelperTrait;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class ProductController extends BaseController
{

    use ApiTraits, HelperTrait;
    //  Create new Product
    public function createProduct(Request $request)
    {
        $rules = [
            "name" => "required|min:8|max:225",
            "description" => "required|min:20",
            "price" => "required|numeric|between:0,9999.99",
            "price_offer" => "required|numeric|between:0,9999.99",
            "price" => "required|numeric|between:0,9999.99",
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            "request_time" => "required|date_format:H:i:s",
        ];

        $validator = validator()->make($request->all(), $rules);

        if ($validator->fails()) :
            return $this->responseJson(0, $validator->errors()->first(), $validator->errors());
        endif;
        $img = $request->file("image");
        $img  = $this->uploadImages($img, "images/restaurant/products");

        $product = Product::create([
            "name" => $request->name,
            "description" => $request->description,
            "price_offer" => $request->price_offer,
            "price" => $request->price,
            "image" =>  $img,
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
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            "description" => "nullable|min:20",
            "price" => "nullable|numeric|between:0,9999.99",
            "price_offer" => "nullable|numeric|between:0,9999.99",
            "request_time" => "nullable|date_format:H:i:s",
        ];
        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails()) :
            return $this->responseJson(0, $validator->errors()->first(), $validator->errors());
        endif;


        $product = Product::where("id", $request->product_id)->first();
        $product->update($request->all());

        if ($request->image) :
            $img = $request->file("image");
            $img  = $this->uploadImages($img, "images/restaurant/products");
            $product->update(["image" =>  $img]);
        endif;


        return $this->responseJson(1, "تم تعديل المنتج بنجاح", new ProductResource($product));
    }

    ##############First Case For Products showing  #############
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

        $product = Product::find($request->product_id);
        if ($product->restaurant) :
            return  $this->responseJson("0", "لا يمكنك حذف هذا المنتج لانه ينتمي إلي مطعم معين");
        endif;
        $product = $product->delete();
        if ($product) {
            return  $this->responseJson("1", "تم حذف المنتج بنجاح");
        }
    }

    #################Second Case For Products showing  #######################

    public function toggleActive(Request $request)
    {
        $rules = [
            "product_id" => "required|exists:products,id",
        ];
        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails()) :
            return $this->responseJson(0, $validator->errors()->first(), $validator->errors());
        endif;

        $product = Product::find($request->product_id);
        $active = $product->active;
        if ($active == 0) :

            $product->update(["active" => 1]);
        else :

            $product->update(["active" => 0]);
        endif;
        return  $this->responseJson("1", "تم التبديل", new ProductResource($product));
    }
}
