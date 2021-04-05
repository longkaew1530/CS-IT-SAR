@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
<div class="box-header">
<h3><b><li>คุณภาพบัณฑิตตามกรอบมาตรฐานคุณวุฒิระดับอุดมศึกษาแห่งชาติ (ตัวบ่งชี้ที่ 2.1) <a href="/getindicator2_1/{{$pdca[0]['Indicator_id']}}" class="btn btn-warning fr "><i class='fa fas fa-edit'></i> แก้ไขข้อมูล</a></li></b></h3>

            <div class="box-body">
              <table class="table table-bordered mt-1">
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
              </tbody></table></div>
              <div class="box-body">
            <ins>ผลการประเมินตนเอง</ins>
            <table class="table table-bordered text-center">
                <tbody><tr>
                  <th width="30%" >ตัวบ่งชี้</th>
                  <th width="20%">เป้าหมาย</th>
                  @if($per1!=null)
                      <th colspan="2" width="20%">ผลการดำเนินงาน</th>
                  @else
                      <th  width="20%">ผลการดำเนินงาน</th>
                  @endif
                  <th width="20%">คะแนนอิงเกณฑ์ สกอ.</th>
                </tr>
                @foreach($pdca as $row)
                @if($row['target']!="")
                <tr>
                  <td rowspan="2">ตัวบ่งชี้ที่ {{$row['Indicator_id']." ".$row['Indicator_name']}}</td>           
                  <td rowspan="2">{{$row['target']}}</td>
                  @if($per1!=null)
                    <td >{{$row['performance1']}}</td>
                  @endif  
                  <td rowspan="2">{{$row['performance3']}}</td>
                  <td rowspan="2">{{$row['score']}}</td>
                </tr>
                <tr>
                @if($per1!=null)
                    <td >{{$row['performance2']}}</td>
                  @endif  
                </tr>
                <tr>
                @endif
                @endforeach
              </tbody></table>
            </div>
              </div>
   <style>
   .ml-1{
  margin-left:10px
}
.ml-2{
  margin-left:20px
}
.mt-1{
  margin-top:10px;
}
h3{
  font-size: 15px;
}
   </style>           
              
              
              @endsection
