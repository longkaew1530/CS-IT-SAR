@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
  <div class="box-header">
  <a href="{{ URL::previous() }}" class="btn btn-primary fr"><i class='fa fa-arrow-left'></i> ย้อนกลับ</a>
    <div class="box-body">
    
      <div class="col-sm-2" align="right"></div>
      <div class="col-sm-9" align="center">
        <h3><i class=""></i>ความก้าวหน้าของการดำเนินงานตามแผนที่เสนอในรายงานของปีที่ผ่านมา</h3>
        <hr>
      </div>
    </div>
    <form id="adddata" method="POST" action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data">
    @csrf
    @foreach($editdata as $row)
      <div class="data">
      <input type="hidden" class="form-control" id="id" name="id" value="{{$row['id']}}"/>
        <div class="col-md-12">
          <div class="box-header col-md-12 col-sm-9 col-xs-12">
            <h3 class="box-title">แผนดำเนินการ</h3>
          </div>
          <div id="body">
            <div class="col-md-12 col-sm-9 col-xs-12">
            <textarea class="form-control" rows="3" placeholder="แผนดำเนินการ" id="composition" name="composition">
            {!!$row['composition']!!}
            </textarea>
            </div>
          </div>
        </div>
      </div>
      <div class="data">
        <div class="col-md-12">
          <div class="box-header col-md-12 col-sm-9 col-xs-12">
            <h3 class="box-title">กำหนดเวลาที่แล้วเสร็จ</h3>
          </div>
          <div id="body">
            <div class="col-md-12 col-sm-9 col-xs-12">
            <input type="text" class="form-control" id="strength" name="strength" placeholder="กำหนดเวลาที่แล้วเสร็จ" value="{{$row['strength']}}">
            </div>
          </div>
        </div>
      </div>
      <div class="data">
        <div class="col-md-12">
          <div class="box-header col-md-12 col-sm-9 col-xs-12">
            <h3 class="box-title">ผู้รับผิดชอบ</h3>
          </div>
          <div id="body">
            <div class="col-md-12 col-sm-9 col-xs-12">
            <input type="text" class="form-control" id="should_develop" name="should_develop" placeholder="ผู้รับผิดชอบ" value="{{$row['should_develop']}}">
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div id="body">
          <div class="col-md-12 col-sm-9 col-xs-12">
            <hr>
            <button type="submit" class="btn btn-info pull-right">บันทึกข้อมูล</button>
            </textarea>
          </div>

        </div>
      </div>
      @endforeach
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
        url: "/updatenewstrength",
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
          window.location = "/category7/newstrength";
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
  });
  
</script>
@endsection