<?php

namespace App\Http\Controllers\Web;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PaymentController extends Controller
{

    public function index(Request $request)
    {
        $records = Payment::where(function ($q) use ($request) {

            if ($request->restaurant) :
                $q->whereHas("restaurant", function ($q) use ($request) {
                    $q->where("name", "LIKE", "%" . $request->restaurant . "%");
                });
            endif;

            if ($request->notes) :
                $q->where("notes", "LIKE", "%" . $request->notes . "%");
            endif;

            if ($request->paid) :
                $q->where("paid", "LIKE", "%" . $request->paid . "%");
            endif;


            if ($request->payment_date) :
                $q->whereDate("payment_date", $request->payment_date);
            endif;
        })->orderBy("created_at")->get();
        return view("payments.index", compact("records"));
    }



    public  function create()
    {
        return view("payments.create");
    }


    public function store(Request $request)
    {
        $request->validate($this->getRules(), $this->getMessage());
        Payment::create($request->all());
        flash("تم الأنشاء بنجاح")->success();
        return redirect()->route("payment.index");
    }

    public function edit($id)
    {
        $record = Payment::find($id);
        return view("payments.edit",compact("record"));
    }

    public function update(Request $request, $id)
    {
        $record = Payment::findOrFail($id);
        $request->validate($this->getRules(), $this->getMessage());
        $record->update($request->all());
        flash("تم التعديل بنجاح")->success();
        return redirect()->route("payment.index");
    }

    public function destroy($id)
    {
        $record = Payment::findOrFail($id);
        $record->delete();
        return response()->json([
            "status" => 1,
            "message" => "تم حذف الدفعه  بنجاح"
        ]);
    }


    public function getMessage()
    {
        $msg = [
            "restaurant_id.required" => "أسم المطعم مطلوب",
            "restaurant_id.exists" => "أسم المطعم غير موجود",
            "notes.required" => " الملاحظات مطلوب",
            "notes.min" => " الحد الادني  من الملاحظات هو  20 حرف",
            "paid.required" => " الدفعه مطلوبه",
            "paid.numeric" => " الدفعه يجب ان تكون أرقام",
            "payment_date.required" => "تاريخ الدفعه مطلوب",
            "payment_date.required" => "تاريخ الدفعه مطلوب",
            "payment_date.date" => "تاريخ الدفعه يجب ان يكون تاريخ",
        ];
        return $msg;
    }
    public function getRules()
    {
        return [
            "restaurant_id" => "required|exists:restaurants,id",
            "notes" => "required|min:20",
            "paid" => "required|numeric",
            "payment_date" => "required|date"
        ];
    }
}
