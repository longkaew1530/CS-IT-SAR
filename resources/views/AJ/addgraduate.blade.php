@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
  <div class="box-header">
    <div class="box-body">
      <div class="col-sm-2" align="right"></div>
      <div class="col-sm-8" align="center">
        <h3><i class=""></i>จำนวนผู้สำเร็จการศึกษา</h3>
        <hr>
      </div>
    </div>
    <div class="box-body">
    <form id="adddata1" method="POST" action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data">
            @csrf
            ปีการศึกษาที่เริ่มใช้หลักสูตร
            <input type="text" name="year_add" >
            ถึงปีการศึกษาที่ต้องรายงาน
            <input type="text" name="reported_year">
            <button type="submit" >บันทึกข้อมูลใหม่</button>
            </form>
    </div>
            <div class="box-body">
            
            <form id="adddata" method="POST" action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data">
            @csrf
            @if($get!="")
              <table class="table table-bordered text-center">
                <tbody><tr>
                  <th width="5%" rowspan="3" style="background-color:#9ddfd3">ปีการศึกษาที่รับเข้า</th>
                  @for($i =$get[0]['year_add'];$i<=$get[0]['reported_year']; $i++)
                  <th width="5%" colspan="2" style="background-color:#9ddfd3">{{$i}}</th>
                  @endfor
                  </tr>
                  <tr>
                  @for($i =$get[0]['year_add'];$i<=$get[0]['reported_year']; $i++)
                  <th width="5%" rowspan="2" style="background-color:#9ddfd3">จำนวนผู้สำเร็จการศึกษา</th>
                  <th width="5%" rowspan="2" style="background-color:#9ddfd3">ร้อยละ</th>
                  @endfor
                  </tr>
                  <tr></tr>
                  <tr>
                  <?php $n=0 ?>
                  @for($y=$get[0]['year_add'];$y<=$get[0]['reported_year']; $y++)
                  <?php $data=$getinfo->where('year_add',$y); ?>
                
                            <td style="background-color:#9ddfd3">{{$y}}</td>
                            @for($x =$get[0]['year_add'];$x<=$get[0]['reported_year']; $x++)
                            <?php $data2=[] ?>
                            <?php $data2=$data->where('reported_year',$x)->where('year_add',$y); ?>
                            @if($data2!='[]')
                                @foreach($data2 as $key=>$value)                 
                                  <td><input type="text" class="form-control text-center" name="y{{$y}}[]" value="{{$value['reported_year_qty']}}"></td>
                                  <td><input type="text" class="form-control text-center" ></td>
                                @endforeach  
                            @else
                                <td ><input type="text" class="form-control text-center" name="y{{$y}}[]" value="0"></td>
                                <td><input type="text" class="form-control text-center" ></td>
                            @endif    
                            <?php $n++ ?>                        
                            @endfor

                </tr>
                @endfor
                
              </tbody></table>
            @endif
      <div class="col-md-12">
        <div id="body">
          <div class="col-md-12 col-sm-9 col-xs-12">
            <hr>
            <button type="submit" class="btn btn-info pull-right">บันทึกข้อมูล</button>
            </textarea>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
</div>

<style>
  hr {
    display: block;
    height: 1px;
    border: 0;
    border-top: 1px solid #ccc;
    margin: 1em 0;
    padding: 0;
  }
  .wid10{
    width:50px;
  }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(e) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $('#adddata').submit(function(e) {
      e.preventDefault();
      var formData = new FormData(this);
      $.ajax({
        type: 'POST',
        url: "/addgraduate",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: (data) => {
          if(data){
            swal({
          title: "เพิ่มข้อมูลเรียบร้อยแล้ว",
          text: "",
          icon: "success",
          button: "ตกลง",
        }).then(function() {
          window.location = "/category3/graduatesqty";
        });
          }
        },
        error: function(data) {
          alert(data.responseJSON.errors.files1[0]);
          console.log(data.responseJSON.errors);
        }
      });
    });

    $('#adddata1').submit(function(e) {
      e.preventDefault();
      var formData = new FormData(this);
      $.ajax({
        type: 'POST',
        url: "/addyear_graduate",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: (data) => {
          if(data){
            swal({
          title: "เพิ่มข้อมูลเรียบร้อยแล้ว",
          text: "",
          icon: "success",
          button: "ตกลง",
        }).then(function() {
          window.location = "/addinfostudent";
        });
          }
        },
        error: function(data) {
          alert(data.responseJSON.errors.files1[0]);
          console.log(data.responseJSON.errors);
        }
      });
    });
  });
  
</script>
@endsection