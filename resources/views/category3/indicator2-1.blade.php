@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
<div class="box-header">
<h3><b><li>คุณภาพบัณฑิตตามกรอบมาตรฐานคุณวุฒิระดับอุดมศึกษาแห่งชาติ (ตัวบ่งชี้ที่ 2.1) <a href="/getindicator2_1/{{$factor[0]['id']}}" class="btn btn-warning fr "><i class='fa fas fa-edit'></i> แก้ไขข้อมูล</a></li></b></h3>

            <div class="box-body">
              <table class="table table-bordered mt-3">
                <tbody><tr>
                  <th width="80%" class="text-center">ข้อมูลพื้นฐาน</th>
                  <th width="10%" class="text-center">จำนวน</th>
                  @foreach($factor as $value)
                </tr>
                <td>1. จำนวนบัณฑิตที่สำเร็จการศึกษาในหลักสูตรนี้ทั้งหมด</td>
                <td class="text-center">{{$value['qtyall']}}</td>
                <tr>
                </tr>
                <td>2. จำนวนบัณฑิตในหลักสูตรที่ได้รับการประเมินจากผู้ใช้บัณฑิต</td>
                <td class="text-center">{{$value['qtyrate']}}</td>
                <tr>
                </tr>
                <td>3. ร้อยละของบัณฑิตที่ได้รับจากการประเมินผู้ใช้บัณฑิตต่อจำนวนบัณฑิตที่สำเร็จการศึกษาทั้งหมด</td>
                <td class="text-center">{{$value['persen']}}</td>
                <tr>
                </tr>
                <td>4. ผลรวมของค่าคะแนนที่ได้จากการประเมินบัณฑิต</td>
                <td class="text-center">{{$value['sumscore']}}</td>
                <tr>
                </tr>
                <td>5. ค่าเฉลี่ยของคะแนนประเมินบัณฑิต (คะแนนเต็ม5)</td>
                <td class="text-center">{{$value['resultscore']}}</td>
                <tr>
                </tr>
                @endforeach
              </tbody></table></div></div>
   <style>
   .ml-1{
  margin-left:10px
}
.ml-2{
  margin-left:20px
}
.mt-3{
  margin-top:30px;
}
h3{
  font-size: 15px;
}
   </style>           
              
              
              @endsection
