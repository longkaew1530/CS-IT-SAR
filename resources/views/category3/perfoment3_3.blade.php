@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
<div class="box-header">
            <div class="box-body">
            <b><ins>ผลการดำเนินงาน</ins></b>
            <a href="/getindicator3_3" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไขข้อมูล</a>
              <table class="table table-bordered mt-3" >
                <tbody><tr>
                  <th width="60%" class="text-center">ประเด็นอธิบาย</th>
                  <th width="15%" class="text-center">หลักฐานอ้างอิง</th>
                </tr>
                @foreach($in3_3 as $value)
              <tr>
                <td><b>{{$value['category_retention_rate']}}</b><br>
                {!!$value['retention_rate']!!}
                
                </td>
                <td>
                @foreach($value->doc_performance3_3 as $row)
                {!!$row['doc_name']!!}
                @endforeach
                </td>
              </tr>
              @endforeach
              </tbody></table>
</div></div>
<style>
   .b{
     background-color:black;
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
