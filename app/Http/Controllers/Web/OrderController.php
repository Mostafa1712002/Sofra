<?php

namespace App\Http\Controllers\Web;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class OrderController extends Controller
{

    public function index(Request $request)
    {
        $records = Order::where(function ($q) use ($request) {
            if ($request->has("address")) :
                $q->where("address", "LIKE", "%" . $request->name . "%");
            endif;
            if ($request->has("state")) :
                $q->where("state", $request->state);
            endif;

            if ($request->has("payment_method")) :
                $q->where("payment_method", $request->payment_method);
            endif;


            if ($request->client) :
                $q->whereHas("client", function ($q) use ($request) {
                    $q->where("name", "LIKE", "%" . $request->client . "%");
                });
            endif;

            if ($request->restaurant) :
                $q->whereHas("restaurant", function ($q) use ($request) {
                    $q->where("name", "LIKE", "%" . $request->restaurant . "%");
                });
            endif;
        })->get();
        return view("orders.index", compact("records"));
    }




    public function show($id)
    {
        $record = Order::findOrFail($id);
        return view("orders.show", compact("record"));
    }



    public function destroy($id)
    {
        $record = Order::findOrFail($id);
        $record->delete();
        return response()->json([
            "status" => 1,
            "message" => "تم حذف الطلب بنجاح",
        ]);
    }
}
