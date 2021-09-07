<?php

namespace App\Http\Controllers\Web;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class RoleController extends Controller
{

    public function index()
    {
        $records = Role::paginate(20);
        return view("roles.index", compact("records"));
    }

    public function create()
    {
        $permissions = Permission::orderBy("group")->get();
        return view("roles.create", compact("permissions"));
    }


    public function store(Request $request)
    {
        $rules = [
            "name" => "required|unique:roles,name",
            "permissions" => "required",
            "display_name" => "required|unique:roles,display_name",
            "description" => "nullable|min:20"
        ];
        $request->validate($rules, $this->getMessage());
        $role = Role::create($request->all());
        $role->permissions()->attach($request->permissions);
        flash("تم إنشاء الرتبه بنجاح")->success();
        return redirect()->to(route("role.index"));
    }

    public function edit($id)
    {
        $record = Role::with(["permissions" => function ($q) {
            $q->select("id");
        }])->findOrFail($id);
        $permissions = Permission::orderBy("group")->get();
        return view("roles.edit", compact("record", "permissions"));

    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $rules = [
            "name" => "required|unique:roles,name,$id",
            "permissions" => "required",
            "display_name" => "required|unique:roles,display_name,$id",
            "description" => "nullable|min:20"
        ];
        $request->validate($rules, $this->getMessage());

        $role->update($request->all());
        $role->permissions()->sync($request->permissions);
        flash("تم تعديل الرتبه بنجاح")->success();
        return redirect()->to(route("role.index"));
    }

    public function destroy($id)
    {
        $record = Role::findOrFail($id);
        $record->delete();
        return response()->json([
            "status" => 1,
            "message" =>  "تم حذف الرتبه بنجاح"
        ]);
    }


    public function getMessage()
    {
        return [
            "permissions.required" => " أختيار الصلاحيات مطلوب",
            "name.required" => "اسم رتبه مطلوب",
            "name.unique" => " رتبه موجوده من قبل",
            "display_name.unique" => " الاسم المعروض موجود من قبل",
            "display_name.required" => "الاسم المعروض مطلوب",
            "description.min" => "الوصف يجب ان يكون أكثر من 20 حرف"
        ];
    }
}
