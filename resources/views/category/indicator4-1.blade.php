@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
            <div class="box-header">
              <h1 class="box-title">การบริหารและพัฒนาอาจารย์ (ตัวบ่งชี้ที่ 4.1)</h1>
              <br>
              <ins>เกณฑ์การประเมิน</ins>
              <ul>-มีระบบ มีกลไกล</ul>
              <ul>-มีการนำระบบกลไกสู่การปฏิบัติ/ดำเนินงาน</ul>
              <ul>-มีการประเมินกระบวนการ</ul>
              <ul>-มีการปรับปรุง/พัฒนากระบวนการจากผลการประเมิน</ul>
              <ul>-มีผลจากการปรับปรุงเห็นชัดเจนเป็นรูปธรรม</ul>
              <ul>-มีแนวทางปฏิบัติที่ดี โดยมีหลักฐานเชิงประจักษ์ยืนยัน และกรรมการผู้ตรวจประเมินสามารถให้เหตุผลอธิบายการเป็นแนวปฏิบัติที่ดีได้ชัดเจน</ul>
            <ins>ผลการดำเนินงาน</ins>
            
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th width="60%">ประเด็นอธิบาย</th>
                  <th width="30%">หลักฐานอ้างอิง</th>
                </tr>
                @foreach($pdca as $key =>$row )
                <tr>
                  <td><b>{{$row['category_pdca']}}</b><br>
                  <ins><b>ขั้นตอนการวางแผน (P)</b></ins><br>
                  {{$row['p']}}<br>
                  <ins><b>การดำเนินงานตามแผน (D)</b></ins><br>
                  {{$row['d']}}</b><br>
                  <ins><b>การประเมินกระบวนการ (C)</b></ins><br>
                  {{$row['c']}}</b><br>
                  <ins><b>การปรับปรุง/พัฒนา/บูรณาการกระบวนการจากผลการประเมิน (A)</b></ins><br>
                  {{$row['a']}}</b><br>
                  </td>        
                  <td>
                  @foreach($row->docpdca as $key =>$row)
                  -{{$row['doc_name']}}<br>
                  @endforeach
                  </td>
                </tr>
                <tr>
                @endforeach
              </tbody></table>
            </div>

            <ins>ผลการประเมินตนเอง</ins>
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th width="30%">ตัวบ่งชี้</th>
                  <th width="20%">เป้าหมาย</th>
                  <th width="20%">ผลการดำเนินงาน</th>
                  <th width="20%">คะแนนอิงเกณฑ์ สกอ.</th>
                </tr>
                @foreach($pdca as $key =>$row )
                <tr>
                  @if($row['target']!="") 
                  <td>ตัวบ่งชี้ที่{{$row['Indicator_id']." ".$row['Indicator_name']}}</td>           
                  <td>{{$row['target']}}</td>
                  <td>{{$row['performance']}}</td>
                  <td>{{$row['score']}}</td>
                  @endif
                </tr>
                <tr>
                @endforeach
              </tbody></table>
            </div>
          </div>
          
          </div>
          </div>
<style>
.marginl{
  padding:10px;
}
.wid10{
  width:10%;
}
.wid20{
  width:20%;
}
.wid30{
  width:30%;
}
.wid40{
  width:40%;
}
.wid50{
  width:50%;
}
.mt20{
  margin-top:50px
}
.ml-1{
  margin-left:10px
}
.ml-2{
  margin-left:20px
}
.mt-3{
  margin-top:30px;
}
</style>
@endsection