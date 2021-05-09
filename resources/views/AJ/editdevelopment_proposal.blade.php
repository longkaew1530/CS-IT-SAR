@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
  <div class="box-header">
    <div class="box-body">
      <div class="col-sm-2" align="right"></div>
      <div class="col-sm-8" align="center">
        <h3><i class=""></i>ข้อเสนอในการพัฒนาหลักสูตร</h3>
        <hr>
      </div>
    </div>
    <form id="adddata" method="POST" action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data">
    @csrf
    @foreach($editdata as $row)
      <div id="show">
        <div class="col-md-12">
          <div class="box-header col-md-12 col-sm-9 col-xs-12">
            <h3 class="box-title">ข้อเสนอ</h3>
          </div>
            <div class="col-md-12 col-sm-9 col-xs-12" id="hed">
            <input type="hidden" class="form-control" id="getid" name="getid" value="{{$row['id']}}"/>
            <input type="text" class="form-control" id="topic" name="topic" placeholder="ข้อเสนอ" value="{{$row['topic']}}">
            </div>
        </div>
        @foreach($row->development_proposal_detail as $key=>$value)
        <div class="col-md-12 mt">
        @if($key==0)
          <div class="box-header col-md-12 col-sm-9 col-xs-12">
            <h3 class="box-title">รายละเอียด</h3>
          </div>
        @endif
            <div class="col-md-11 col-sm-9 col-xs-12" id="hed">
            <input type="hidden" class="form-control" id="id" name="id[{{$key+1}}]" value="{{$value['id']}}"/>
            <input type="text" class="form-control" id="detail" name="detail[{{$key}}]" placeholder="รายละเอียด" value="{{$value['detail']}}">
            </div>
        </div>
        @endforeach
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
  .mt{
    margin-top:15px;
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
      for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
        }
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
        url: "/updatedevelopment_proposal",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: (data) => {
          swal({
          title: "แก้ไขข้อมูลเรียบร้อย",
          text: "",
          icon: "success",
          button: "ตกลง",
        }).then(function() {
          window.location = "/category7/development_proposal";
        });
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