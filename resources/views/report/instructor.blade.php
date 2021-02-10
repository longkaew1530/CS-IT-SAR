@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
<div class="box-header">
            <div class="box-header">
              <h3 class="box-title">อาจารย์ผู้สอน</h3>
            </div>
            <table class="table table-bordered">
                    <tbody><tr>
                      <th width="50%" class="text-center">รายชื่ออาจารย์</th>
                      <th width="50%" class="text-center">สาขาวิชาที่จบ</th>
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
</div></div>

              @endsection
