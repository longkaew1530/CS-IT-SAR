@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
<div class="box-header">
            <div class="box-body">
            <br><br><b><ins>ผลการดำเนินงาน</ins></b>
              <table class="table table-bordered" >
                <tbody><tr>
                  <th width="60%" class="text-center">ประเด็นอธิบาย</th>
                  <th width="15%" class="text-center">หลักฐานอ้างอิง</th>
                </tr>
                @foreach($in3_3 as $value)
              <tr>
                <td><b>{{$value['retention_rate_category']}}</b><br>
                {{$value['retention_rate']}}
                
                </td>
                <td>
                @foreach($value->doc_performance3_3 as $row)
                {{$row['doc_name']}}
                @endforeach
                </td>
              </tr>
              @endforeach
              </tbody></table>
</div></div>
              @endsection
