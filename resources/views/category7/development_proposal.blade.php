@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
<div class="box-header">
            <div class="box-body">
            <a href="/adddevelopment_proposal" class="btn btn-success fr ml-1"><i class='fa fa-plus'></i> เพิ่มข้อมูล</a>
              <h4>ข้อเสนอในการพัฒนาหลักสูตร</h4></b>
              @foreach($querydevelopment_proposal as $key=>$value)
              <b>{{$key+1}}. {{$value['topic']}}</b>&nbsp&nbsp&nbsp<a href="/getdevelopment_proposal/{{$value['id']}}" class="btn btn-warning "><i class='fa fas fa-edit'></i></a><br>
              @foreach($value->development_proposal_detail as $row)
              - {{$row['detail']}}<br>
              @endforeach
              @endforeach
              </div>
</div></div>
@endsection
