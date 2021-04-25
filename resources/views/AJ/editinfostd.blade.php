@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
  <div class="box-header">
    <div class="box-body">
      <div class="col-sm-2" align="right"></div>
      <div class="col-sm-8" align="center">
        <h3><i class=""></i>ข้อมูลนักศึกษา</h3>
        <hr>
      </div>
    </div>
            <div class="box-body">
            
            <form id="adddata" method="POST" action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data">
            @csrf
            @if($get!="")
              <table class="table table-bordered text-center">
                <tbody><tr>
                <?php $yearname=session()->get('year'); ?>
                  <th width="30%" style="background-color:#9ddfd3">ปีการศึกษาที่รับเข้า</th>
                  @for($i =$get[0]['year_add'];$i<=$yearname; $i++)
                  <th width="5%" style="background-color:#9ddfd3">{{$i}}</th>
                  @endfor
                  <?php $n=0 ?>
                  @for($y=$get[0]['year_add'];$y<=$yearname; $y++)
                  <?php $data=$getinfo->where('year_add',$y); ?>
                 <tr>
                            <td style="background-color:#9ddfd3">{{$y}}</td>
                            @for($x =$get[0]['year_add'];$x<=$yearname; $x++)
                            <?php $data2=[] ?>
                            <?php $data2=$data->where('reported_year',$x)->where('year_add',$y); ?>
                            @if($data2!='[]')
                                @foreach($data2 as $key=>$value)                 
                                  <td><input type="number" class="form-control text-center" name="y{{$y}}[]" value="{{$value['reported_year_qty']}}"></td>
                                @endforeach  
                            @else
                                <td ><input type="number" class="form-control text-center" name="y{{$y}}[]" value="0"></td>
                            @endif    
                            <?php $n++ ?>                        
                            @endfor

                </tr>
                @endfor
                </tr>
              </tbody></table>
              
              
            
            จำนวนนักศึกษาที่รับเข้าตามแผน (ตาม มคอ2 ของปีที่ประเมิน)
            <input type="hidden" class="form-control" id="getid" name="getid" value="{{$getqty[0]['id']}}"/>
            <input type="number" name="qty" value="{{$getqty[0]['qty']}}">
            คน (กรุณาระบุเป็นตัวเลข)
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
     

      swal({
      title: "ยืนยันการบันทึก?",
      icon: "warning",
      buttons: true,
      successMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
        type: 'POST',
        url: "/addinfostudent",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: (data) => {
          if(data){
            swal({
          title: "แก้ไขข้อมูลเรียบร้อย",
          text: "",
          icon: "success",
          button: "ตกลง",
        }).then(function() {
          window.location = "/category3/studentinfomation";
        });
          }
        },
        error: function(data) {
          alert(data.responseJSON.errors.files1[0]);
          console.log(data.responseJSON.errors);
        }
      });
      } else {
        
      }
    });
    });

    $('#adddata1').submit(function(e) {
      e.preventDefault();
      var formData = new FormData(this);
      $.ajax({
        type: 'POST',
        url: "/addyear_acceptance",
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