<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Carbon\Carbon;
class ServiceController extends Controller
{
    public function index() {
        $services = Service::paginate(5);
        return view('admin.service.index',compact('services'));
    }
    public function edit($id){

        $service = Service::find($id);
        return view('admin.service.edit',compact('service'));
    }
    public function store(Request $request){
        //ตรวจสอบข้อมูล
        $request->validate(
            [
                'service_name'=>'required|unique:services|max:255',
                'service_image'=>'required|mimes:jpg,jpeg,png'
            ],
            [
                'service_name.required'=>"กรุณาป้อนชื่อบริการด้วยครับ",
                'service_name.max' => "ป้อนตัวอักษรเกินจำนวนที่กำหนด",
                'service_name.unique'=>"มีข้อมูลชื่อบริการนี้ในฐานข้อมูลแล้ว",
                'service_image.required'=>"กรุณาใส่ประกอบการบริการ",
            ]
        );

        //การเข้ารหัสรูปภาพ
        $service_image = $request->file('service_image');

        //Generate ชื่อภาพ
        $name_gen=hexdec(uniqid());
        // ดึงนามสกุลไฟล์ภาพ
        $img_ext = strtolower($service_image->getClientOriginalExtension());
        $img_name = $name_gen.'.'.$img_ext;


        //อัพโหลดและบันทึกข้อมูล
        $upload_location = 'image/services/';
        $full_path = $upload_location.$img_name;

        Service::insert([
            'service_name'=>$request->service_name,
            'service_image'=>$full_path,
            'created_at'=>Carbon::now()
        ]);
        $service_image->move($upload_location,$img_name);
        return redirect()->back()->with('success',"บันทึกข้อมูลเรียบร้อย");
    }
    public function update(Request $request, $id){
    //ตรวจสอบข้อมูล
        $request->validate(
            [
                'service_name'=>'required|unique:services|max:255'

            ],
            [
                'service_name.required'=>"กรุณาป้อนชื่อบริการด้วยครับ",
                'service_name.max' => "ป้อนตัวอักษรเกินจำนวนที่กำหนด"
            ]
        );
        //การเข้ารหัสรูปภาพ
        $service_image = $request->file('service_image');
        //update ภาพและชื่อ
        if($service_image){
            //Generate ชื่อภาพ
            $name_gen=hexdec(uniqid());
            // ดึงนามสกุลไฟล์ภาพ
            $img_ext = strtolower($service_image->getClientOriginalExtension());
            $img_name = $name_gen.'.'.$img_ext;


            //อัพโหลดและอัพเดตบันทึกข้อมูล
            $upload_location = 'image/services/';
            $full_path = $upload_location.$img_name;

            //อัพเดตข้อมูล
            Service::find($id)->update([
                'service_name'=>$request->service_name,
                'service_image'=>$full_path,

            ]);
            //ลบภาพเก่าและอัพภาพใหม่แทนที่
            $old_image = $request->old_image;
            unlink($old_image);
            $service_image->move($upload_location,$img_name);
            return redirect()->route('services')->with('success',"อัพเดตภาพเรียบร้อย");
        }else{
            //อัพเดตชื่ออย่างเดียว
            Service::find($id)->update([
                'service_name'=>$request->service_name,
            ]);
            return redirect()->route('services')->with('success',"อัพเดตชื่อบริการเรียบร้อย");
        }
    }
}
