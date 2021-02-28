@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
<div class="box-header" id="exportContent">
              <h1 class="box-title">หมวดที่ 1 ข้อมูลทั่วไป</h1>
              @foreach($course as $key =>$value)
              <br><b>หลักสูตร{{$value['course_name']." สาขา".$value['branch']." หลักสูตรปรับปรุง พ.ศ. ".$value['update_course']}} ระดับปริญญาตรี</b><br>
              <b>รหัสหลักสูตร</b> {{$value['course_code']}}<br>
              <b>สถานที่จัดการเรียนการสอน</b> {{$value['place']}}<br>
              @endforeach
              <br><br><br>
              <b>อาจารย์ผู้รับผิดชอบหลักสูตร</b>
                  <div class="box-body">
                  <table class="table table-bordered">
                    <tbody><tr>
                      <th width="15%">มคอ.2</th>
                      <th width="15%">ปัจจุบัน</th>
                      <th width="15%">หมายเหตุ</th>
                    </tr>
                    @foreach($educ_bg as $key =>$row)
                    <tr>
                      <td>{{($key + 1)}}. {{$row['user_fullname']}}<br>
                      @foreach($row->educational_background as $value) 
                      {{$value['abbreviations']." (".$value['eb_fieldofstudy'].")"}}<br>
                      @endforeach
                      </td>
                      <td>{{($key + 1)}}. {{$row['user_fullname']}}<br>
                      @foreach($row->educational_background as $value) 
                      {{$value['abbreviations']." (".$value['eb_fieldofstudy'].")"}}<br>
                      @endforeach
                      </td>
                      <td></td>
                    </tr>
                    <tr>
                    @endforeach
                  </tbody></table>
                </div>

                <br><br><b>อาจารย์ผู้สอน</b>  
                    <div class="box-body">
                  <table class="table table-bordered">
                    <tbody><tr>
                      <th width="15%">รายชื่ออาจารย์</th>
                      <th width="30%">สาขาวิชาที่จบ</th>
                    </tr>
                    @foreach($instructor as $key =>$row )
                    <tr>
                      <td>{{($key + 1)}}.{{$row['user_fullname']}}</td>             
                      <td>
                      @foreach($row->educational_background as $value) 
                      {{$value['abbreviations']." (".$value['eb_fieldofstudy'].")"}}<br>
                      @endforeach
                      </td>
                    </tr>
                    <tr>
                    @endforeach
                  </tbody></table>  
                </div>

                <br><br>@include('category/indi1-1show',['c','count','nameteacher'
                  ,'educ_bg','y','checkpass','checknotpass','tc_course','instructor','specialinstructor','inc','course'])
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