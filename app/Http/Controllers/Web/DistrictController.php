<?php

namespace App\Http\Controllers\Web;

use App\Models\City;
use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\returnSelf;

class DistrictController extends Controller
{

    public function index()
    {
        $records = District::paginate(20);
        return view("districts.index", compact("records"));
    }



    public function store(Request $request)
    {

        $rules = ["name" => "min:8|required|max:50|unique:districts,name", "city_id" => "required|exists:cities,id"];
        $validator = Validator::make($request->all(), $rules, $this->getMessage());
        if ($validator->fails()) :
            Flash($validator->errors()->first())->error();
            return back();
        endif;

        District::create($request->all());
        Flash("تم الأنشاء بنجاح")->success();
        return back();
    }



    public function update(Request $request, $id)
    {
        $record = District::findorFail($id);
        $rules = [
            "name" => "required|max:50|unique:districts,name," . $record->id,
            "city_id" => "required|exists:cities,id",
        ];
        $validator = Validator::make($request->all(), $rules, $this->getMessage());
        if ($validator->fails()) :
            Flash($validator->errors()->first())->error();
            return back();
        endif;
        $record->update($request->all());
        flash("تم التعديل بنجاح")->success();
        return back();
    }

    public function destroy($id)
    {
        $record = District::findOrFail($id);
            $record->delete();
            return response()->json([
                "status" => 1,
                "message" => "تم حذف المنطقه بنجاح"
            ]);

    }

    public function getMessage()
    {
        $msg = [
            "name.required" => "أسم المنطقه مطلوب",
            "name.max" => " الحد الاقصي من الحروف هو 50 ",
            "name.unique" => "هدا الاسم مأخوذ من قبل",
            "name.min" => " الحد الادني من الحروف هو 8 ",
            "city_id.required" => "اسم المدينه مطلوب",
            "city_id.exists" => "يجب ان تكون المدينه ضمن المدن الموجوده",
        ];
        return $msg;
    }
}
