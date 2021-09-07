<?php

namespace App\Http\Controllers\Web;

use App\Models\City;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{

    public function index()
    {
        $records = City::paginate(20);
        return view("cities.index", compact("records"));
    }




    public function store(Request $request)
    {
        $rules = ["name" => "min:8|required|max:50|unique:cities,name"];
        $validator = Validator::make($request->all(), $rules, $this->getMessage());
        if ($validator->fails()) :
            flash($validator->errors()->first())->error();
            return redirect()->back();
        endif;

        city::create($request->all());
        Flash("تم الأنشاء بنجاح")->success();
        return back();
    }



    public function update(Request $request, $id)
    {
        //  The start of validation
        $record = City::findOrFail($id);

        $rules = [
            "name" => "min:8|required|max:50|unique:cities,name," . $record->id,
        ];
        $validator = Validator::make($request->all(), $rules, $this->getMessage());
        if ($validator->fails()) :
            flash($validator->errors()->first())->error();
            return redirect()->back();
        endif;

        $record->update($request->all());
        flash("تم التعديل بنجاح")->success();
        return back();
    }

    public function destroy($id)
    {
        $record = City::find($id);
        try {
            $record->delete();
        } catch (Exception $e) {


            return response()->json([
                "status" => 0,
                "message" => "لا يمكنك حذف هذه المدينه لانها متصله بمناطق آخري يجب عليك اولا نقل المناطق التي بها"
            ]);

        }

        return response()->json([
            "status" => 1,
            "message" => "تم حذف المدينه بنجاح"
        ]);
    }


    public function getMessage()
    {
        $msg = [
            "name.required" => "أسم المدينه مطلوب",
            "name.max" => " الحد الاقصي من الحروف هو 50 ",
            "name.min" => " الحد الادني من الحروف هو 8 ",
            "name.unique" => "هدا الاسم مأخوذ من قبل",
        ];
        return $msg;
    }
}
