<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ข้อมูลรายงานสมาชิก {{Auth::user()->name}}
            <b class="float-end">จำนวนผู้ใช้ระบบ {{count($users)}} คน</b>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Username</th>
                        <th scope="col">ชื่อสมาชิก</th>
                        <th scope="col">เริ่มใช้งาน ระบบ</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        @php ($i=1) @endphp
                        @foreach ($users as $row)
                            <tr>
                                <th>{{$i++}}</th>
                                <th>{{$row->email}}</th>
                                <th>{{$row->name}}</th>
                                <th>{{Carbon\Carbon::parse($row->created_at)->diffForHumans()}}</th>
                            </tr>
                        @endforeach
                      </tr>
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
</x-app-layout>
