<?php

namespace App\Http\Controllers\Web;

use App\Models\Category;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

    public function index()
    {
        $records = Category::paginate(20);
        return view("catagories.index", compact("records"));
    }



    public function store(Request $request)
    {


        $rules = ["name" => "min:8|required|max:50|unique:categories,name"];
        $validator = Validator::make($request->all(), $rules, $this->getMessage());
        if ($validator->fails()) :
            flash($validator->errors()->first())->error();
            return redirect()->back();
        endif;

        Category::create($request->all());
        Flash("تم الأنشاء بنجاح")->success();
        return back();
    }



    public function update(Request $request, $id)
    {
        //  The start of validation
        $record = Category::findOrFail($id);

        $rules = [
            "name" => "min:8|required|max:50|unique:categories,name," . $record->id,
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


        $record = Category::find($id);
        $restaurants =  $record->restaurants;

        if (count($restaurants)) :
            return response()->json([
                "status" => 0,
                "message" => " لا يمكنك حذف هذا القسم لانها متصل بمطاعم آخري يجب عليك اولا نقل المطاعم التي به إلي قسم آخر"
            ]);
        endif;
        $record->delete();
        return response()->json([
            "status" => 1,
            "message" => "تم حذف القسم بنجاح"
        ]);
    }


    public function getMessage()
    {
        return  [
            "name.required" => "أسم القسم مطلوب",
            "name.max" => " الحد الاقصي من الحروف هو 50 ",
            "name.min" => " الحد الادني من الحروف هو 8 ",
            "name.unique" => "هدا الاسم مأخوذ من قبل",
        ];
    }
}
