<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departmaent;

class DepartmentController extends Controller
{
    public function index(){
        return view('admin.department.index');
    }
    public function store(Request $request){
        // dd($request->department_name);
        $request->validate([
            'department_name' => 'required|unique:departmaents|max:255'
        ],
        [
            'department_name.required' => "กรุณาป้อนชื่อแผนกด้วยนะคะ",
            'department_name.max' => "ป้อนตัวอักษรเกินจำนวนที่กำหนด"

        ]
    );
    //บันทึกข้อมูล
    $department = new Departmaent;
    }
}
