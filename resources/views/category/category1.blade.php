@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
            <div class="box-header">
              <h1 class="box-title">การกำกับให้เป็นไปตามมาตรฐาน (เกณฑ์มาตรฐานหลักสูตร พ.ศ.2558)</h1>
              <br>
              <br><li><h4 class="box-title">การบริหารจัดการหลักสูตรตามเกณฑ์มาตรฐานหลักสูตรที่กำหนดโดย สกอ. (ตัวบ่งชี้ที่ 1.1)</h4><br></li>
              <br><br><li><h4 class="box-title">การบริหารจัดการหลักสูตรตามเกณฑ์มาตรฐานหลักสูตรที่กำหนดโดย สกอ. (ตัวบ่งชี้ที่ 1.1)</h4><br></li>
              <br><h4 class="box-title">1.จำนวนอาจารย์ผู้รับผิดชอบหลักสูตร</h4><br> 
              หลักสูตร{{$c}} มีอาจารย์ประจำหลักสูตรจำนวน {{$count}} คน 
              เป็นอาจารย์ผู้รับผิดชอบหลักสูตรเพียง 1 หลักสูตรเท่านั้น และอยู่ประจำหลักสูตรตลอดระยะเวลาที่จัดการศึกษาตามหลักสูตรดังนี้<br>
              @foreach($nameteacher as $key =>$value)
              
                <ul>{{($key + 1)}}. {{$value['user_fullname']}}</ul>
              
              @endforeach
            </div>
            
          </div>
            <!-- /.box-body -->
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