<?php

namespace App\Http\Controllers\Web;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    // Get all user expected admin
    public function index()
    {
        $records = User::where("is_admin", 0)->paginate(20);
        return view("users.index", compact("records"));
    }

    public function create()
    {
        return view("users.create");
    }


    public function store(Request $request)
    {
        $rules = [
            "name" => "required",
            "listRoles" => "required",
            "email" => "required|email|unique:users,email",
            "password" => "required|confirmed|min:8",
        ];

        $request->validate($rules, $this->getMessage());

        $user = User::create($request->all());
        $user->assignRole($request->listRoles);
        flash("تم إنشاء المستخدم بنجاح")->success();
        return redirect()->route("user.index");
    }


    public function edit($id)
    {

        //  I use the With to get the id of Role With Me to use it in update Route 
        $record = User::with(["roles" => function ($q) {
            $q->select("id");
        }])->findOrFail($id);
        return view("users.edit", compact("record"));
    }

    public function update(Request $request, $id)
    {
        $record = User::findorFail($id);
        $rules = [
            "listRoles" => "required",
            "name" => "required",
            "email" => "required|email|unique:users,email," . $record->id,
            "password" => "confirmed|nullable",
        ];
        $request->validate($rules, $this->getMessage());
        $record->syncRoles($request->listRoles);
        $record->update($request->all());
        //  Check if there password or not 
        if (isset($request->password)) :
            $record->update(["password" => $request->password]);
        endif;

        flash("تم التعديل بنجاح")->success();
        return redirect()->route("user.index");
    }

    // Delete user
    public function destroy($id)
    {
        $record = User::findOrFail($id);
            $record->delete();
            return response()->json([
                "status" => 1,
                "message" => "تم حذف المستخدم بنجاح",
            ]);
    }




    // //   To Edit Password User
    public function editPassword()
    {
        $record = User::findOrFail(auth()->id());
        return view("users.editPassword", compact("record"));
    }

    // // Update the password of User
    public function updatePassword(Request $request)
    {

        $record = User::findOrFail(auth()->id());

        $rules = ["password" => "required|confirmed|min:8"];

        $validator = validator()->make($request->all(), $rules, $this->getMessage());
        
        if ($validator->fails()) {
            flash($validator->errors()->first())->error();
            return back();
        }
        $record->update(["password" => $request->password]);
        flash("تم التعديل بنجاح")->success();
        return back();
    }

    //  Message Validation  Method
    public function getMessage()
    {
        return [
            "name.required" => "اسم المستخدم مطلوب",
            "listRoles.required" => "رتبة المستخدم مطلوبه",
            "password.min" => "الحد الأدني من الحروف هو  8 ",
            "email.required" => "البريد الألكتروني للمستخدم مطلوب",
            "password.min" => "الحد الادني من الحروف 8 ",
            "email.unique" => "البريد الألكتروني للمستخدم مستخدم من قبل",
            "password.required" => " كلمة المرور مطلوبه",
            "password.confirmed" => "لا  تتطابق كملتي المرور ",
            "email.email" => "صيغة البريد الالكتروني غير صالحه",
        ];
    }
}
