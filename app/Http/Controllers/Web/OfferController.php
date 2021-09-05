<?php

namespace App\Http\Controllers\Web;

use App\Models\City;
use App\Models\Offer;
use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Validator;
use function PHPUnit\Framework\returnSelf;

class OfferController extends Controller
{

    public function index(Request $request)
    {



        $records = Offer::where(function ($q) use ($request) {
            if ($request->has("name")) :
                $q->where("name", "LIKE", "%" . $request->name . "%");
            endif;

            if ($request->has("description")) {
                $q->where("description", "LIKE", "%" . $request->description . "%");
            }

            if ($request->date_to) {
                $q->whereDate('date_to',"=", $request->date_to) ;
            }
            if ($request->date_from) {
                $q->whereDate("date_from","=", $request->date_from) ;
            }

            if ($request->has("restaurant")) {
                $q->wherehas("restaurant",function($q) use ($request){
                    $q->where("name", "LIKE", "%" . $request->restaurant . "%");
                });
            }

        })->get();
        return view("offers.index", compact("records"));
    }


    // Delete user
    public function destroy($id)
    {



        $record = Offer::findOrFail($id);
        $record->delete();
        return response()->json([
            "status" => 1,
            "message" => "تم حذف العرض بنجاح",
        ]);
    }
}
