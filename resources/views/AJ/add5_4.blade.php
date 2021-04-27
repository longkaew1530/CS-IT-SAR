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
        <div class="col-md-12">
        <input type="hidden" class="form-control" id="id" name="id" value="{{$get[0]['id']}}">
          <div class="box-header col-md-12 col-sm-9 col-xs-12">
            <h3 class="box-title">ผลการดำเนินงาน</h3>
          </div>
            <div class="col-md-12 col-sm-9 col-xs-12">
              <textarea  id="editor5" name="performance" rows="10" cols="80">
              </textarea>
            </div>
        </div>

        <div class="col-md-12">
          <div class="box-header col-md-12 col-sm-9 col-xs-12">
          </div>
            <div class="col-md-12 col-sm-9 col-xs-12">
            <label>
                      <input type="radio" name="status" id="optionsRadios1" value="1" checked="">
                      เป็นไปตามเกณฑ์
                    </label>
                    <label>
                      <input type="radio" name="status" id="optionsRadios1" value="0" checked="">
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
            <div class="table-responsive">  
                <table class="table table-bordered" id="dynamic_field">  
                    <tr>  
                        <td ><input multiple="true" type="file" id="doc_file" name="doc_file[]" class="form-control name_list"></td> 
                        <td width="60%"><input type="text" name="name[]" placeholder="ตั้งชื่อไฟล์" class="form-control name_list" /></td>   
                        <td><button type="button" name="add" id="add" class="btn btn-success"><i class="fa fa-plus"></i></button></td>  
                    </tr>  
                </table>  
            </div>
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
    var postURL = "<?php echo url('addmore'); ?>";
      var i=0;  
      var x=0;

      $('#add').click(function(){  
           i++;  
           $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input multiple="true" type="file" id="doc_file" name="doc_file['+i+']" class="form-control name_list"></td><td width="60%"><input type="text" name="name['+i+']" placeholder="ตั้งชื่อไฟล์" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
      });  


      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
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
      var editor5 = document.getElementById("editor5").value;
      var getdoc_file1 = $("input[name='doc_file[]']")
              .map(function(){return $(this).val();}).get();
      var getname1 = $("input[name='name[]']")
              .map(function(){return $(this).val();}).get();

      var doc_file1="";
            for (index = 0; index < getdoc_file1.length; ++index) {
              if(getdoc_file1[index]!=""){
                doc_file1="aaaa";
             }
             else{
              doc_file1="";
             }
            }
      var name1="";
            for (index = 0; index < getname1.length; ++index) {
              if(getname1[index]!=""){
                name1="aaaa";
             }
             else{
              name1="";
             }
            }


      if(editor5==""||doc_file1==""||name1==""){
         swal({
          title: "กรุณาป้อนข้อมูลให้ครบ",
          text: "",
          icon: "warning",
          showConfirmButton: false,
        });
      }
      else{

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
        url: "/addindicator5_4",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: (data) => {
          swal({
          title: "บันทึกข้อมูลเรียบร้อย",
          text: "",
          icon: "success",
          button: "ตกลง",
        }).then(function() {
          window.location = "/category4/indicator5_4";
        });
        },
        error: function(data) {
          swal({
          title: "เอกสารอ้างอิงไม่ถูกต้อง",
          text: "",
          icon: "error",
          showConfirmButton: false,
        });
          alert(data.responseJSON.errors.files1[0]);
          console.log(data.responseJSON.errors);
        }
      });
      } else {
        
      }
    });
  }
    });
  });
  
</script>
@endsection