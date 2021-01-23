@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
            <div class="box-header">
              <h1 class="box-title"><li>ผลที่เกิดกับอาจารย์ (ตัวบ่งชี้ที่ 4.3)</li></h1>
              <a href="/getindicator4_3" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไขข้อมูล</a>
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
                @foreach($in4_3 as $value)
              <tr>
                <td><b>{{$value['category_retention_rate']}}</b><br>
                {!!$value['retention_rate']!!}
                
                </td>
                <td>
                @foreach($value->docindicator4_3 as $row)
                {!!$row['doc_name']!!}
                @endforeach
                </td>
              </tr>
              @endforeach
              </tbody></table>
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