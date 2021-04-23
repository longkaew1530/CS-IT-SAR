@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
<div class="box-header">
            <div class="box-body">
            <h3 class="box-title">ผลที่เกิดกับนักศึกษา (ตัวบ่งชี้ 3.3)</h3><br><br>
            @if($inc!="[]"&&$checkedit!="")<a href="/getindicator3_3/{{$inc[0]['Indicator_id']}}" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไขข้อมูล</a>@endif
            <ins>ผลการดำเนินงาน</ins>
              <table class="table table-bordered " >
                <tbody><tr>
                  <th width="60%" class="text-center">ประเด็นอธิบาย</th>
                  <th width="15%" class="text-center">หลักฐานอ้างอิง</th>
                </tr>
                @if($in3_3!="[]")
                @foreach($in3_3 as $value)
              <tr>
                <td><b>{{$value['category_retention_rate']}}</b><br>
                {!!$value['retention_rate']!!}
                
                </td>
                <td>
                @foreach($value->doc_performance3_3 as $row)
                -{!!$row['doc_file']!!}<br>
                @endforeach
                </td>
              </tr>
              @endforeach
              @else
              <tr>
                <td>-
                </td>
                <td>-
                </td>
              </tr>
              @endif
              </tbody></table>
              </div>
        <div class="box-body">
            <ins>ผลการประเมินตนเอง</ins>
              <table class="table table-bordered">
                <tbody><tr>
                  <th width="30%" class="text-center">ตัวบ่งชี้</th>
                  <th width="20%" class="text-center">เป้าหมาย</th>
                  <th width="20%" class="text-center">ผลการดำเนินงาน</th>
                  <th width="20%" class="text-center">คะแนนอิงเกณฑ์ สกอ.</th>
                </tr>
                @if($inc!="[]")
                @foreach($inc as $key =>$row )
                <tr>
                  <td>ตัวบ่งชี้ที่{{$row['Indicator_id']." ".$row['Indicator_name']}}</td>             
                  <td class="text-center">{{$row['target']}}</td>
                  <td class="text-center">{{$row['performance3']}}</td>
                  <td class="text-center">{{$row['score']}}</td>
                </tr>
                <tr>
                @endforeach
                @else
                <tr>
                  <td>ตัวบ่งชี้ที่ {{$id}} {{$name}}</td>             
                  <td class="text-center"></td>
                  <td class="text-center"></td>
                  <td class="text-center"></td>
                </tr>
                <tr>
                @endif
              </tbody></table>
            </div>
            </div>
            </div>
</div>
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
