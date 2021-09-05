<?php

namespace App\Http\Controllers\Web;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class RestaurantController extends Controller
{

    public function index(Request $request)
    {
        $records = Restaurant::where(function ($q) use ($request) {
            if ($request->has("name")) :
                $q->where("name", "LIKE", "%" . $request->name . "%");
            endif;
            if ($request->has("phone")) :
                $q->where("phone", "LIKE", "%" . $request->phone . "%");
            endif;

            if ($request->has("active")) :
                $q->where("active", $request->active);
            endif;

            if ($request->has("email")) :
                $q->where("email", "LIKE", "%" . $request->email . "%");
            endif;

            if ($request->district) :
                $q->whereHas("district", function ($q) use ($request) {
                    $q->where("name", "LIKE", "%" . $request->district . "%");
                });
            endif;


            if ($request->city) :
                $q->whereHas("district", function ($q) use ($request) {
                    $q->wherehas("city", function ($q) use ($request) {
                        $q->where("name", "LIKE", "%" . $request->city . "%");
                    });
                });
            endif;
        })->get();
        return view("restaurants.index", compact("records"));
    }




    public function show($id)
    {
        $record = Restaurant::findOrFail($id);
        return view("restaurants.show",compact("record"));
    }



    public function destroy($id)
    {
        $record = Restaurant::findOrFail($id);
        $record->delete();
        return response()->json([
            "status" => 1,
            "message" => "تم حذف المطعم بنجاح",
        ]);
    }



    public function active(Request $request)
    {
        Restaurant::findOrFail($request->id);
        if ($request->state == "true") :
            Restaurant::where("id", $request->id)->update(["active" => 1]);
        else :
            Restaurant::where("id", $request->id)->update(["active" => 0]);
        endif;
    }
}
