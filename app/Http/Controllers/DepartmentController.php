<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departmaent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    public function index(){
        //Eloquent
        $departmaents = Departmaent::paginate(5);
        $trashDepartment = Departmaent::onlyTrashed()->paginate(3);
        // Query Builder
        // $departmaents = DB::table('departmaents')->get();

        return view('admin.department.index',compact('departmaents','trashDepartment'));
    }
    public function store(Request $request){
        // dd($request->department_name);
        $request->validate([
            'department_name' => 'required|unique:departmaents|max:255'
        ],
        [
            'department_name.required' => "กรุณาป้อนชื่อแผนกด้วยนะคะ",
            'department_name.max' => "ป้อนตัวอักษรเกินจำนวนที่กำหนด",
            'department_name.unique' => "มีข้อมูลอยู่แล้ว"
        ]
    );
        //บันทึกข้อมูล Eloquent
        $department = new Departmaent;
        $department->department_name = $request->department_name;
        $department->user_id = Auth::user()->id;
        $department->save();

        // บักทึกข้อมูลแบบ Query Builder
        // $data = array();
        // $data["department_name"] = $request->department_name;
        // $data["user_id"] = Auth::user()->id;

        // DB::table('departmaents')->insert($data);

        return redirect()->back()->with('success',"บันทึกข้อมูลเรียบร้อย");

    }
    public function edit($id){

        $departmaents = Departmaent::find($id);
        return view('admin.department.edit',compact('departmaents'));
    }
    public function update(Request $request, $id){
        $request->validate([
            'department_name'=>'required|unique:departmaents|max:255'
        ],
        [
            'department_name.required'=>"กรุณาป้อนชื่อแผนกด้วยครับ",
            'department_name.max' => "ป้อนตัวอักษรเกินจำนวนที่กำหนด",
            'department_name.unique'=>"มีข้อมูลอยู่แล้ว"
        ]
    );
    $update = Departmaent::find($id)->update([
        'department_name'=>$request->department_name,
        'user_id'=>Auth::user()->id
    ]);
    return redirect()->route('department')->with('success',"อัพเดตข้อมูลเรียบร้อย");

    }
    public function softdelete($id){
        $delete = Departmaent::find($id)->delete();
        return redirect()->back()->with('success',"ลบข้อมูลเรียบร้อย");
}
    public function restore($id){
        $restore = Departmaent::withTrashed()->find($id)->restore();
        return redirect()->back()->with('success',"กู้คืนข้อมูลเรียบร้อย");
    }
    public function delete($id){
       $deletes = Departmaent::onlyTrashed()->find($id)->forceDelete();
        return redirect()->back()->with('success',"ลบข้อมูลถาวรเรียบร้อย");
    }
}
