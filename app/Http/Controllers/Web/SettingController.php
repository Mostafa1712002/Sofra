<?php

namespace App\Http\Controllers\Web;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SettingController extends Controller
{

    public function index(Request $request)
    {
        $record = Setting::find(1);
        return view("setting.index", compact("record"));
    }

    public function store(Request $request)
    {

        $record = Setting::find(1);
        $rules = [
            "about_us" => "required",
            "commission" => "required|between:0,1|numeric",
            "num_bank_alahli" => "required|integer",
            "num_bank_alrakhi" => "required|integer",
        ];

        $message = [
            "about_us.required" => "عن التطبيق مطلوب",
            "num_bank_alrakhi.required" => "رقم حساب بنك الراجحي مطلوب",
            "num_bank_alahli.required" => "رقم حساب البنك الأهلي",
            "num_bank_alrakhi.integer" => "رقم حساب بنك الراجحي يجب ان يكون رقم صحيح",
            "num_bank_alahli.integer" => "رقم حساب البنك الأهلي يجب ان يكون رقم صحيح",
            "commission.required" => "رسوم التطبيق مطلوبه",
            "commission.between" => "رسوم التطبيق يجب ان تكون بين 1.00 و 0.00",
            "commission.numeric" => "رسوم التطبيق يجب ان تكون أرقام",


        ];


        $validator = validator()->make($request->all(), $rules, $message);
        if ($validator->fails()) :

            flash($validator->errors()->first())->error();
            return back();
        endif;
        $record->update($request->all());
        flash("تم التعديل بنجاح")->success();
        return back();
    }
}
