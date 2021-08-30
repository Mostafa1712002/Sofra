<?php

namespace App\Http\Controllers\Api\Client;

use App\Models\Order;
use App\Models\Token;
use App\Models\Client;
use App\Models\Comment;
use App\Models\Product;
use App\Traits\ApiTraits;
use App\Models\Restaurant;
use App\Traits\helperTrait;
use Illuminate\Http\Request;
use App\Http\Resources\OrderResource;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller as BaseController;

class OrderController extends BaseController
{

    use ApiTraits, helperTrait;

    // get Current orders
    public function currentOrders(Request $request)
    {

        $paginate = 10;
        if ($request->paginate) :
            $paginate = $request->paginate;
        endif;
        $orders = Order::where("state", "client_delivered")->where("client_id", $request->user()->id)->paginate($paginate);
        return  $this->responseJson(1, "تم الأمر", [
            "orders" => OrderResource::collection($orders),
            "pagination" => $this->getPaginates($orders)
        ]);
    }


    // get pervious orders
    public function perviousOrders(Request $request)
    {

        $paginate = 10;
        if ($request->paginate) :
            $paginate = $request->paginate;
        endif;
        $orders = Order::whereIn("state", ["finished", "declined"])->where("client_id", $request->user()->id)->paginate($paginate);
        return  $this->responseJson(1, "تم الأمر", [
            "orders" => OrderResource::collection($orders),
            "pagination" => $this->getPaginates($orders)
        ]);
    }



    //  Create new order
    public function newOrder(Request $request)
    {


        $rules = [
            "restaurant_id" => "required|exists:restaurants,id",
            "items.*.id" => "required|exists:products,id",
            "quantity.*.quantity" => "required|numeric",
            "address" => "required",
            "payment_method" => "required|in:cash,online"

        ];

        $validator = Validator::make($request->all(), $rules);


        if ($validator->fails()) :
            return $this->responseJson(0, $validator->errors()->first(), $validator->errors());
        endif;
        $restaurant = Restaurant::find($request->restaurant_id);



        if ($restaurant->state == 0) :
            return $this->responseJson("0", "عذرا المطعم غير متاح في الوقت الحالي ");
        endif;



        $order = $request->user()->orders()->create([
            "address" => $request->address,
            "payment_method" => $request->payment_method,
            "client_id" => $request->user()->id,
            "restaurant_id" => $request->restaurant_id,
            "state" => "pending",
            "notes" => (isset($request->notes)) ? $request->notes : null
        ]);
        $cost = 0;
        $delivery_fee = $restaurant->delivery_fee;

        foreach ($request->items as $i) {
            $item = Product::find($i["id"]);
            $readyItem = [
                $i["id"] => [
                    "quantity" => $i["quantity"],
                    "price" => $item->price,
                    "notes" => (isset($i["notes"])) ? $i["notes"] : "",
                ]
            ];

            $order->products()->attach($readyItem);
            //  The cost of order
            $cost += ($item->price * $i["quantity"]);
        }

        //  End For EACH

        if ($cost >= $restaurant->minimum) :
            $total = $cost + $delivery_fee;
            $commission = $this->settings()->commission * $cost;

            $net = $total - $commission;
            $order->update([
                "delivery_cost" => $delivery_fee,
                "cost" => $cost,
                "commission" => $commission,
                "total" => $total,
                "net" => $net,
            ]);

            //  Notification
            $notification = $restaurant->notifications()->create([
                "title" => " لديك اشعار من عميل  ",
                "content" => $request->user()->name . "هناك طلب من  ",
                "order_id" => $order->id,
            ]);

            // check if there are any token first
            $title = $notification->title;
            $content = $notification->content;
            $data = [
                "order" => $order->fresh(),
                "items" => $order->products,
            ];

            //  use the notifyByFirebase function
            $tokens = $restaurant->tokens->pluck("token");
            $this->notifyByFirebase($title, $content, $tokens, $data);
            return $this->responseJson("1", "تم الطلب بنجاح", $order);
        else :
            $order->products()->delete();
            $order->delete();
            return $this->responseJson("0", "الطلب يجب ان يكون اقل" . $restaurant->minimum);
        endif;
    }



    // Decline Order
    public function declineOrder(Request $request)
    {
        $rules = [
            "order_id" => "required|exists:orders,id"
        ];

        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails()) :
            return $this->responseJson("0", $validator->errors());
        endif;

        $client = $request->user();

        $order = Order::where([["id", $request->order_id], ["client_id", $client->id]])->first();

        if (!$order) :
            return $this->responseJson("0", "هذا الطلب لا ينتمي الي هذا العميل راجع بياناتك");
        endif;

        $restaurant = $order->restaurant;

        $order->update([
            "state" => "declined"
        ]);


        //  Notification
        $notification = $restaurant->notifications()->create([
            "content" => "  $order->id  بالغاء الطلب رقم   $client->name قام العميل ",
            "title" => $restaurant->name . " عملينا العزيز   ",
            "order_id" => $order->id,
        ]);
        // check if there are any token first
        $title = $notification->title;
        $content = $notification->content;

        //  use the notifyByFirebase function
        $tokens = $restaurant->tokens->pluck("token");
        $this->notifyByFirebase($title, $content, $tokens);
        return $this->responseJson("1", "تم");
    }

    // Client Take the order
    public function finishOrder(Request $request)
    {
        $rules = [
            "order_id" => "required|exists:orders,id"
        ];

        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails()) :
            return $this->responseJson("0", $validator->errors());
        endif;

        $client = $request->user();
        $order = Order::where([["id", $request->order_id], ["client_id", $client->id]])->first();

        if (!$order) :
            return $this->responseJson("0", "هذا الطلب لا ينتمي الي هذا العميل راجع بياناتك");
        endif;
        $restaurant = $order->restaurant;

        $order->update([
            "state" => "finished"
        ]);


        //  Notification
        $notification = $restaurant->notifications()->create([
            "content" => " $order->id   بأستلام الطلب رقم   $client->name قام العميل ",
            "title" => $restaurant->name . " عملينا العزيز   ",
            "order_id" => $order->id,
        ]);
        // check if there are any token first
        $title = $notification->title;
        $content = $notification->content;

        //  use the notifyByFirebase function
        $tokens = $restaurant->tokens->pluck("token");
        $this->notifyByFirebase($title, $content, $tokens);
        return $this->responseJson("1", "تم");
    }
}
