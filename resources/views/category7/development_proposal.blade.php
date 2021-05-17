@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
<div class="box-header">
            @if($checkedit!="")<a href="/adddevelopment_proposal" class="btn btn-success fr"><i class='fa fa-plus'></i> เพิ่มข้อมูล</a>@endif
            <div class="box-body">
              <h4>ข้อเสนอในการพัฒนาหลักสูตร</h4></b>
              @if($querydevelopment_proposal!="[]")
              @foreach($querydevelopment_proposal as $key=>$value)
              <b>{{$key+1}}. {{$value['topic']}}</b>&nbsp&nbsp&nbsp @if($checkedit!="")<a href="/getdevelopment_proposal/{{$value['id']}}" class="btn btn-warning "><i class='fa fas fa-edit'>แก้ไขข้อมูล</i></a>@endif<br>
              {!!$value['detail']!!}<br>
              @endforeach
              @else
              -
              @endif
              </div>
</div></div>
@endsection
