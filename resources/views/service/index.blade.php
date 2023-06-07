<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ข้อมูลรายงานสมาชิก {{Auth::user()->name}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    @if (session("success"))
                        <div class="alert alert-success">{{session('success')}}</div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            ตารางข้อมูลแผนก
                        </div>

                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">ภาพประกอบ</th>
                                <th scope="col">ชื่อบริการ</th>
                                <th scope="col">เวลาเพิ่มเข้าระบบ</th>
                                <th scope="col">แก้ไขข้อมูล</th>
                                <th scope="col">ลบ</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                {{-- @php ($i=1) @endphp --}}
                                @foreach ($service as $row)
                                    <tr>
                                        <th>{{$service->firstItem()+$loop->index}}</th>
                                        <th>{{$row->service_image}}</th>
                                        <th>{{$row->service_name}}</th>
                                        <th>{{Carbon\Carbon::parse($row->created_at)->diffForHumans()}}</th>
                                        <td>
                                            <a href="{{url('/department/edit/'.$row->id)}}" class="btn btn-outline-warning">แก้ไข</a>
                                        </td>
                                        <td>
                                            <a href="{{url('/department/softdelete/'.$row->id)}}" class="btn btn-outline-danger">ลบ</a>
                                        </td>
                                    </tr>
                                @endforeach
                              </tr>
                            </tbody>
                          </table>
                          {{$service->links()}}
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">แบบฟอร์มบริการ</div>
                        <div class="card-body">
                            <form action="{{route('addDepartment')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="service_name">ชื่อบริการ</label>
                                    <input type="text" class="form-control" name="service_name" >
                                </div>
                                @error('service_name')
                                    <div class="my-2">
                                        <span class="text-danger">{{$message}}</span>
                                    </div>
                                @enderror
                                <div class="form-group">
                                    <label for="service_image">ภาพประกอบ</label>
                                    <input type="file" class="form-control" name="service_image" >
                                </div>
                                @error('service_image')
                                    <div class="my-2">
                                        <span class="text-danger">{{$message}}</span>
                                    </div>
                                @enderror
                                <br>
                                    {{-- <button type="submit" class="btn btn-primary">บันทึก</button> --}}
                                    <input type="submit" value="บันทึก" class="btn btn-outline-primary">
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
