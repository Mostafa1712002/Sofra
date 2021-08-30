<?php

namespace App\Http\Controllers\Api\Restaurant;


use Carbon\Carbon;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Resources\OrderResource;
use App\Http\Resources\PaymentResource;
use App\Traits\ApiTraits;
use App\Traits\helperTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller as BaseController;

class OrderController extends BaseController
{

    use ApiTraits, helperTrait;

    //  new Orders
    public function newOrders(Request $request)
    {
        $paginate = 10;
        if (isset($request->paginate)) {
            $paginate = $request->paginate;
        }

        $orders = Order::where("state", "pending")->paginate($paginate);
        return  $this->responseJson(1, "تم الأمر", [
            "orders" => OrderResource::collection($orders),
            "pagination" => $this->getPaginates($orders)
        ]);
    }


    //  Current Orders
    public function currentOrders(Request $request)
    {

        $paginate = 10;
        if (isset($request->paginate)) {
            $paginate = $request->paginate;
        }

        $orders = Order::where("state", "accepted")->paginate($paginate);
        return  $this->responseJson(1, "تم الأمر", [
            "orders" => OrderResource::collection($orders),
            "pagination" => $this->getPaginates($orders)
        ]);
    }



    // Pervious Orders
    public function PerviousOrders(Request $request)
    {

        $paginate = 10;
        if (isset($request->paginate)) {
            $paginate = $request->paginate;
        }
        $orders = Order::whereIn("state", ["declined", "finished"])->paginate($paginate);
        return  $this->responseJson(1, "تم الأمر", [
            "orders" => OrderResource::collection($orders),
            "pagination" => $this->getPaginates($orders)
        ]);
    }





    //  accept Order
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

        $check = $order->update([
            "state" => "accepted"
        ]);


        if ($check) :

            //  Notification
            $notification = $client->notifications()->create([
                "content" => "تم استلام طلبك  ",
                "title" => $client->name . " عملينا العزيز   ",
                "order_id" => $order->id,
            ]);
            $title = $notification->title;
            $content = $notification->content;

            //  use the notifyByFirebase function
            $tokens = $client->tokens->pluck("token");

            $this->notifyByFirebase($title, $content, $tokens);
            return $this->responseJson("1", "تم الموافقه علي  الطلب بنجاح");
        else :
            return $this->responseJson("1", "حدث خظأ غير متوقع ");
        endif;
    }

    //  Deliver Order
    public function deliveredOrderClient(Request $request)
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

        $check = $order->update([
            "state" => "client_delivered"
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
            $tokens = $client->tokens->pluck("token");

            $this->notifyByFirebase($title, $content, $tokens);
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

        $check = $order->delete();

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
            $tokens = $client->tokens->pluck("token");
            $this->notifyByFirebase($title, $content, $tokens);
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
            "payment_date" => "required|date_format:Y-m-d"
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
            "payment_date" => $request->payment_date ,
            "notes" => (isset($request->notes)) ? $request->notes : "",
        ]);
        return $this->responseJson("1", "تم الامر", new PaymentResource($payment));
    }



    public function restaurantPaidReport()
    {

        $restaurant = auth("restaurant-api")->user();
        if ($restaurant) {
            $id = $restaurant->id;
            $order=Order::where("restaurant_id", $id);
            $payment = Payment::where("restaurant_id", $id)->sum("paid");
            $orderPaid = $order->sum("cost");
            $commission = $order->sum("commission");


            return $this->responseJson("1", "تم الامر", [
                "restaurant_sales" => (integer) $orderPaid,
                "app_commissions" =>(integer) $commission,
                "what_is_paid" => (integer) $payment,
                "what_is_rest" => $orderPaid - $payment,
            ]);
        } else {

            $this->responseJson("0", "هذا المطعم غير موجود في قائمة المطاعم");
        }
    }

}
