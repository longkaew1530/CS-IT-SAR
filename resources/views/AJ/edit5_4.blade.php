@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
  <div class="box-header">
    <div class="box-body">
      <div class="col-sm-2" align="right"></div>
      <div class="col-sm-8" align="center">
        <h3><i class=""></i>ผลการดำเนินงานตามกรอบมาตรฐานคุณวุติ</h3>
        <hr>
      </div>
    </div>
    <form id="adddata" method="POST" action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data">
    @csrf
    <input type="hidden" class="form-control" id="id" name="id" value="{{$query[0]['id']}}">

        <div class="col-md-12">
          <div class="box-header col-md-12 col-sm-9 col-xs-12">
            <h3 class="box-title">ผลการดำเนินงาน</h3>
          </div>
            <div class="col-md-12 col-sm-9 col-xs-12">
              <textarea  id="editor5" name="performance" rows="10" cols="80">
              {{$query[0]['performance']}}
              </textarea>
            </div>
        </div>

        <div class="col-md-12">
          <div class="box-header col-md-12 col-sm-9 col-xs-12">
          </div>
            <div class="col-md-12 col-sm-9 col-xs-12">
                    <label>
                      <input type="radio" name="status" id="optionsRadios1" value="1" @if($status1) checked @endif>
                      เป็นไปตามเกณฑ์
                    </label>
                    <label>
                      <input type="radio" name="status" id="optionsRadios1" value="0" @if($status2) checked @endif>
                      ไม่เป็นไปตามเกณฑ์
                    </label>
            </div>
        </div>

                   
      <div class="data">
        <div class="col-md-12">
          <div class="box-header col-md-12 col-sm-9 col-xs-12">
            <h3 class="box-title">หลักฐานอ้างอิง</h3>
          </div>
          <div id="body">
            <div class="col-md-12 col-sm-9 col-xs-12">
            <input multiple="true"  type="file" id="doc_file" name="doc_file[]">
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
      for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
        }
      var formData = new FormData(this);
      let TotalFiles = $('#doc_file')[0].files.length; //Total files
      let files1 = $('#doc_file')[0];
      for (let i = 0; i < TotalFiles; i++) {
        formData.append('files1' + i, files1.files[i]);
      }
      formData.append('TotalFiles', TotalFiles);
      $.ajax({
        type: 'POST',
        url: "/updateindicator5_4",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: (data) => {
          swal({
          title: "แก้ไขข้อมูลเรียบร้อยแล้ว",
          text: "",
          icon: "success",
          button: "ตกลง",
        }).then(function() {
          window.location = "/category4/indicator5_4";
        });
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