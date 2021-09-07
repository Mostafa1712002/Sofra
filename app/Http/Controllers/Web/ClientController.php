<?php

namespace App\Http\Controllers\Web;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{

    public function index(Request $request)
    {


        $records = Client::where(function ($q) use ($request) {

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
        })->orderBy("created_at")->paginate(20);
        return view("clients.index", compact("records"));
    }


    public function destroy($id)
    {
        $record = Client::findOrFail($id);
        $record->delete();
        return response()->json([
            "status" => 1,
            "message" => "تم حذف العميل بنجاح",
        ]);
    }

    public function active(Request $request)
    {

        Client::findOrFail($request->id);
        if ($request->state == "true") :
            Client::where("id", $request->id)->update(["active" => 1]);
        else :
            Client::where("id", $request->id)->update(["active" => 0]);
        endif;
    }
}
