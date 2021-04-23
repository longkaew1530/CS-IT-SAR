@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
<div class="box-header">
            <div class="box-body">
            @if($th!="[]"&&$checkedit!="")<a href="/getteacher_orientation/{{$th[0]['id']}}" class="btn btn-warning fr"><i class='fa fas fa-edit'></i>แก้ไขข้อมูล</a>@endif
            <h4>การปฐมนิเทศอาจารย์ใหม่</h4></b>
            @foreach($th as $row)
            @if(!$checkpass)
            การปฐมนิเทศเพื่อชี้แจงหลักสูตร <label>มี</label>  
                      <input type="checkbox"  @if($checkpass) checked @endif>
                      <label>ไม่มี</label>  
                      <input type="checkbox"  @if(!$checkpass) checked @endif>
            <br>จำนวนอาจารย์ใหม่................ จำนวนอาจารย์ที่เข้าร่วมปฐมนิเทศ............
            @else
            การปฐมนิเทศเพื่อชี้แจงหลักสูตร <label>มี</label>  
                      <input type="checkbox"  @if($checkpass) checked @endif>
                      <label>ไม่มี</label>  
                      <input type="checkbox"  @if(!$checkpass) checked @endif>
            <br>จำนวนอาจารย์ใหม่ {{$row['new_teacher_qty']}} จำนวนอาจารย์ที่เข้าร่วมปฐมนิเทศ {{$row['teacher_point_out_qty']}}
            @endif
            @endforeach
          
</div></div>
              @endsection
