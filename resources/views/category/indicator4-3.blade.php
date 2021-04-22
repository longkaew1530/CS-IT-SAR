@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
            <div class="box-header">
              <h1 class="box-title"><li>ผลที่เกิดกับอาจารย์ (ตัวบ่งชี้ที่ 4.3)</li></h1>
              @if($in4_3!="[]"&&$checkedit!="")<a href="/getindicator4_3/{{$inc[0]['Indicator_id']}}" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไขข้อมูล</a>@endif
              <br><br><br>
            <ins>เกณฑ์การประเมิน</ins><br>
              - มีการรายงานผลการดำเนินงานครบทุกเรื่องตามคำอธิบายในตัวบ่งชี้ (อัตราการคงอยู่ของอาจารย์, ความพึงพอใจของอาจารย์ต่อการบริหารหลักสูตร)<br>
              - มีแนวโน้มผลการดำเนินงานที่ดีขึ้นในทุกเรื่อง (อัตราการคงอยู่ของอาจารย์, ความพึงพอใจของอาจารย์ต่อการบริหารหลักสูตร)<br>
              - มีผลการดำเนินงานที่โด่ดเด่น เทียบเคียงกับหลักสูตรนั้นในสถาบันกลุ่มเดียวกัน โดยมีหลักฐานเชิงประจักษ์ยืนยัน และกรรมการผู้ตรวจประเมินสามารถให้เหตุผลอธิบายว่าเป็นผลการดำเนินงานที่โดดเด่นอย่างแท้จริง<br>

              
            <div class="box-body">
            <br><br><b><ins>ผลการดำเนินงาน</ins></b>
              <table class="table table-bordered" >
                <tbody><tr>
                  <th width="60%" class="text-center">ประเด็นอธิบาย</th>
                  <th width="15%" class="text-center">หลักฐานอ้างอิง</th>
                </tr>
                @if($in4_3!="")
                @foreach($in4_3 as $value)
              <tr>
                <td><b>{{$value['category_retention_rate']}}</b><br>
                {!!$value['retention_rate']!!}
                
                </td>
                <td>
                @foreach($value->docindicator4_3 as $row)
                -{!!$row['doc_file']!!}<br>
                @endforeach
                </td>
              </tr>
              @endforeach
              @endif
              </tbody></table>
            </div> 
         
          <div class="box-body">
         <br><b><ins>ผลการประเมินตนเอง</ins></b>
              <table class="table table-bordered">
                <tbody><tr>
                  <th width="30%">ตัวบ่งชี้</th>
                  <th width="20%">เป้าหมาย</th>
                  <th width="20%">ผลการดำเนินงาน</th>
                  <th width="20%">คะแนนอิงเกณฑ์ สกอ.</th>
                </tr>
                @if($inc!="")
                @foreach($inc as $key =>$row )
                <tr>
                  <td>ตัวบ่งชี้ที่{{$row['Indicator_id']." ".$row['Indicator_name']}}</td>             
                  <td>{{$row['target']}}</td>
                  <td>{{$row['performance3']}}</td>
                  <td>            
                  
                  {{$row['score']}}</td>
                </tr>
                <tr>
                @endforeach
                @else
                <tr>
                  <td>ตัวบ่งชี้ที่ {{$id}} {{$name}} </td>             
                  <td></td>
                  <td></td>
                  <td>            
                  
                  </td>
                </tr>
                <tr>
                @endif
              </tbody></table>
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