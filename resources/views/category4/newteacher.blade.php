@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
<div class="box-header">
            <div class="box-body">
            <h4>การปฐมนิเทศอาจารย์ใหม่</h4></b>
            @foreach($th as $row)
            การปฐมนิเทศเพื่อชี้แจงหลักสูตร <label>มี</label>  
                      <input type="checkbox"  @if($checkpass) checked @endif>
                      <label>ไม่มี</label>  
                      <input type="checkbox"  @if(!$checkpass) checked @endif>
            <br>จำนวนอาจารย์ใหม่................ จำนวนอาจารย์ที่เข้าร่วมปฐมนิเทศ............
            @endforeach
          
</div></div>
              @endsection
