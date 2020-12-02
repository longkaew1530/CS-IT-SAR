@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
            <div class="box-header">
              <h2 class="box-title">การกำกับให้เป็นไปตามมาตรฐาน (เกณฑ์มาตรฐานหลักสูตร พ.ศ.2558)</h2>
              <br>
              <br><li>การบริหารจัดการหลักสูตรตามเกณฑ์มาตรฐานหลักสูตรที่กำหนดโดย สกอ. (ตัวบ่งชี้ที่ 1.1)<br></li>
              <br><br><li>การบริหารจัดการหลักสูตรตามเกณฑ์มาตรฐานหลักสูตรที่กำหนดโดย สกอ. (ตัวบ่งชี้ที่ 1.1)<br></li>
              <br>1.จำนวนอาจารย์ผู้รับผิดชอบหลักสูตร<br> 
              หลักสูตร{{$c}} มีอาจารย์ประจำหลักสูตรจำนวน {{$count}} คน
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