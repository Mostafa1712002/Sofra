<?php

namespace App\Http\Controllers\Web;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Validator;
use function PHPUnit\Framework\returnSelf;

class ContactController extends Controller
{

    public function index(Request $request)
    {



        $records = Contact::where(function ($q) use ($request) {
            if ($request->has("name")) :
                $q->where("full_name", "LIKE", "%" . $request->name . "%");
            endif;

            if ($request->has("message")) {
                $q->where("message", "LIKE", "%" . $request->message . "%");
            }
            if ($request->has("phone")) {
                $q->where("phone", "LIKE", "%" . $request->phone . "%");
            }

            if ($request->has("type")) {
                $q->where("type",$request->type);
            }

            if ($request->date) {
                $q->whereDate('created_at', "=", $request->date);
            }
        })->paginate(20);
        return view("contacts.index", compact("records"));
    }


    // Delete user
    public function destroy($id)
    {



        $record = Contact::findOrFail($id);
        $record->delete();
        return response()->json([
            "status" => 1,
            "message" => "تم حذف  الرساله بنجاح",
        ]);
    }
}
