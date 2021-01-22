@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
  <div class="box-header">
    <div class="box-body">
      <div class="col-sm-2" align="right"></div>
      <div class="col-sm-8" align="center">
        <h3><i class=""></i>เพิ่มผลการดำเนินงาน</h3>
        <hr>
      </div>
    </div>
    <form id="adddata" method="POST" action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data">
    @csrf
         <input type="hidden" class="form-control" id="id" name="id" value="{{$editdata[0]['id']}}">
        <input type="hidden" class="form-control" id="id2" name="id2" value="{{$editdata[1]['id']}}">
        @foreach($editdata as $key=>$row)
        <div class="col-md-12">
          <div class="box-header col-md-12 col-sm-9 col-xs-12">
            <h3 class="box-title">{{$row['category_retention_rate']}}</h3>
          </div>
          
            <div class="col-md-12 col-sm-9 col-xs-12">
              <textarea  id="editor{{$key+4}}" name="retention_rate{{$key+1}}" rows="10" cols="80" >
              {{$row['retention_rate']}}
              </textarea>
            </div>
        </div>
      <div class="data">
        <div class="col-md-12">
          <div class="box-header col-md-12 col-sm-9 col-xs-12">
            <h3 class="box-title">หลักฐานอ้างอิง</h3>
          </div>
          <div id="body">
            <div class="col-md-12 col-sm-9 col-xs-12">
            <input multiple="true"  type="file" id="doc_file{{$key+1}}" name="doc_file{{$key+1}}[]" >
            </div>
          </div>

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
      let TotalFiles1 = $('#doc_file1')[0].files.length; //Total files
      let files1 = $('#doc_file1')[0];
      for (let i = 0; i < TotalFiles1; i++) {
        formData.append('files1' + i, files1.files[i]);
      }
      formData.append('TotalFiles1', TotalFiles1);


      let TotalFiles2 = $('#doc_file2')[0].files.length; //Total files
      let files2 = $('#doc_file2')[0];
      for (let i2 = 0; i2 < TotalFiles2; i2++) {
        formData.append('files2' + i2, files2.files[i2]);
      }
      formData.append('TotalFiles2', TotalFiles2);
      $.ajax({
        type: 'POST',
        url: "/updateindicator4_3",
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
          window.location = "/category/indicator4-3";
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