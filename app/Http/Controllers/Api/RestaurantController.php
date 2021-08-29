<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Token;
use App\Traits\ApiTraits;
use App\Traits\helperTrait;
use Illuminate\Http\Request;
use App\Http\Resources\OrderResource;
use App\Http\Resources\PaymentResource;
use App\Models\Payment;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller as BaseController;

class RestaurantController extends BaseController
{

    use ApiTraits, helperTrait;

    // Add Token
    public function addToken(Request $request)
    {

        $rules = [
            "platform" => ["required", "in:android,ios"],
            "token" => ["required"],
        ];

        $validator = validator()->make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->responseJson("0", $validator->errors()->first(), $validator->errors());
        }

        Token::where("token", $request->token)->delete();
        $token = $request->user()->tokens()->create($request->all());
        return $this->responseJson("1", "  تم الامر", $token);
    }

    // Remove Token

    public function removeToken(Request $request)
    {
        $validator = validator()->make($request->all(), [
            "token" => "required",
        ]);
        if ($validator->fails()) {
            return $this->responseJson("0", $validator->errors()->first(), $validator->errors());
        }

        Token::where("token", $request->token)->delete();

        return $this->responseJson("0", " تم الحذف");
    }

    //  new Orders
    public function newPendingOrders()
    {

        $myTime = (string)Carbon::now()->format("Y-m-d");
        $orders = Order::where("insert_time", $myTime)->where("state", "pending")->paginate(20);
        return  $this->responseJson(1, "تم الأمر", [
            "orders" => OrderResource::collection($orders),
            "pagination" => $this->getPaginates($orders)
        ]);
    }

    //  Current Orders
    public function currentPendingOrders()
    {

        $orders = Order::where("state", "accepted")->paginate(20);
        return  $this->responseJson(1, "تم الأمر", [
            "orders" => OrderResource::collection($orders),
            "pagination" => $this->getPaginates($orders)
        ]);
    }
    // Pervious Orders
    public function restaurantPerviousOrders()
    {


        $orders = Order::where("state", "finished")->orWhere("state", "declined")->paginate(20);
        return  $this->responseJson(1, "تم الأمر", [
            "orders" => OrderResource::collection($orders),
            "pagination" => $this->getPaginates($orders)
        ]);
    }



    //  accepted Order
    public function acceptOrder(Request $request)
    {
        $rules = [
            "order_id" => "required|exists:orders,id"
        ];

        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails()) :
            return $this->responseJson("0", $validator->errors());
        endif;

        $order = Order::find($request->order_id);
        $client = $order->client;


        $times =   $order->products->pluck("request_time")->toArray();
        $time = 0;
        foreach ($times as $t) {
            $time += strtotime($t);
        }
        $time = date("H:i:s", $time);
        $check = Order::where("id", $request->order_id)->update([
            "state" => "accepted"
        ]);


        if ($check) :

            //  Notification
            $notification = $client->notifications()->create([
                "content" => "سوف يصل طلبك خلال " . $time,
                "title" => $client->name . " عملينا العزيز   ",
                "order_id" => $order->id,
            ]);

            // check if there are any token first
            $title = $notification->title;
            $content = $notification->content;

            //  use the notifyByFirebase function
            $token = $client->token->token;
            $this->notifyByFirebase($title, $content, $token);
            return $this->responseJson("1", "تم الموافقه علي  الطلب بنجاح");
        else :
            return $this->responseJson("1", "حدث خظأ غير متوقع ");
        endif;
    }

    //  Delivered Order
    public function deliveredOrder(Request $request)
    {
        $rules = [
            "order_id" => "required|exists:orders,id"
        ];

        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails()) :
            return $this->responseJson("0", $validator->errors());
        endif;

        $order = Order::find($request->order_id);
        $client = $order->client;

        $check = Order::where("id", $request->order_id)->update([
            "state" => "delivered"
        ]);



        if ($check) :
            //  Notification
            $notification = $client->notifications()->create([
                "content" => " سوف يصل طلبك خلال بضع دقائق ",
                "title" => $client->name . " عملينا العزيز   ",
                "order_id" => $order->id,
            ]);

            // check if there are any token first
            $title = $notification->title;
            $content = $notification->content;

            //  use the notifyByFirebase function
            $token = $client->token->token;
            $this->notifyByFirebase($title, $content, $token);
            return $this->responseJson("1", "تم الطلب بنجاح");
        else :
            return $this->responseJson("1", "حدث خظأ غير متوقع ");
        endif;
    }


    // Reject Order
    public function rejectOrder(Request $request)
    {

        $rules = [
            "order_id" => "required|exists:orders,id"
        ];

        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails()) :
            return $this->responseJson("0", $validator->errors());
        endif;

        $order = Order::find($request->order_id);
        $client = $order->client;


        $check = Order::where("id", $request->order_id)->delete();

        if ($check) :

            //  Notification
            $notification = $client->notifications()->create([
                "content" => "نأسف تم حدف طلبك لاسباب خاصه بسياسة المطعم حاول مره آخر",
                "title" => $client->name . "عملينا العزيز   ",
                "order_id" => $order->id,
            ]);

            // check if there are any token first
            $title = $notification->title;
            $content = $notification->content;

            //  use the notifyByFirebase function
            $token = $client->token->token;
            $this->notifyByFirebase($title, $content, $token);
            return $this->responseJson("1", "تم حذف الطلب بنجاح");
        else :
            return $this->responseJson("1", "حدث خظأ غير متوقع ");
        endif;
    }


    //  Method to make restaurant Paid
    public function restaurantPaid(Request $request)
    {

        $rules = [
            "paid" => "required|numeric|between:0,9999.99",
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) :
            return $this->responseJson("0",  $validator->errors()->first(), $validator->errors());
        endif;

        $validator = validator()->make(["restaurant_name" => $request->user()->name], [$request->user()->name => "exists:restaurants,name"]);

        if ($validator->fails()) {
            return $this->responseJson("0", " هذا المطعم غير موجود في قائمة المطاعم");
        }

        $payment =  Payment::create([
            "paid" => $request->paid,
            "restaurant_id" => $request->user()->id,
            "payment_date" => Carbon::now()->format("Y-m-d H-i-s"),
            "notes" => (isset($request->notes)) ? $request->notes : "",
        ]);
        return $this->responseJson("1", "تم الامر", new PaymentResource($payment));
    }


    public function restaurantPaidReport()
    {

        $restaurant = auth("restaurant-api")->user();
        if ($restaurant) {
            $id = $restaurant->id;

            $payments = Payment::where("restaurant_id", $id)->get()->pluck("paid");
            $paid = 0;
            foreach ($payments as $payment) {
                $paid += $payment;
            }
            $orders = Order::where("restaurant_id", $id)->get()->pluck("cost");
            $orderPaid = 0;
            foreach ($orders as $order) {
                $orderPaid += $order;
            }
            $restaurantCommission = $orderPaid * $this->settings()->commission;

            return $this->responseJson("1", "تم الامر", [
                "restaurant_sales" => $orderPaid,
                "app_commissions" => $restaurantCommission,
                "what_is_paid" => $paid,
                "what_is_rest" => $orderPaid - $paid,
            ]);
        } else {

            $this->responseJson("0", "هذا المطعم غير موجود في قائمة المطاعم");
        }
    }
}
