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
        // Query Builder
        // $departmaents = DB::table('departmaents')->get();

        return view('admin.department.index',compact('departmaents'));
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
    // public function edit($id){
    //     $department = Departmaent::find($id);
    //     return view('admin.department.edit',compact('department'));
    // }
    public function edit($id){
        $departmaents = Departmaent::find($id);
        return view('admin.department.edit',compact('departmaents'));
    }
}
