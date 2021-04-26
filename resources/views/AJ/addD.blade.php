@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
  <div class="box-header">
    <div class="box-body">
      <div class="col-sm-2" align="right"></div>
      <div class="col-sm-8" align="center">
        <h3><i class=""></i>{{$getindi[0]['category_name']}}</h3>
        <hr>
      </div>
    </div>
    <form id="adddata" method="POST" action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data">
    @csrf
      <div class="data">
        <div class="col-md-12">
          <div class="box-header col-md-12 col-sm-9 col-xs-12">
            <h3 class="box-title">การดำเนินงานตามแผน (D)</h3>
            <input type="hidden" class="form-control" id="Indicator_id" name="Indicator_id" value="{{$getcateid[0]['Indicator_id']}}"/>
            <input type="hidden" class="form-control" id="category_id" name="category_id" value="{{$getindi[0]['id']}}"/>
          </div>
          <div id="body">
            <div class="col-md-12 col-sm-9 col-xs-12">
              <textarea id="editor1" name="editor1" rows="10" cols="80">
              </textarea>
            </div>
          </div>
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


      $('#add').click(function(){  
           i++;  
           $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input multiple="true" type="file" id="doc_file" name="doc_file[]" class="form-control name_list"></td><td width="60%"><input type="text" name="name[]" placeholder="ตั้งชื่อไฟล์" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
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
      for (let i = 0; i < TotalFiles; i++) {
        let files = $('#doc_file')[i];
        formData.append('files' + i, files.files[i]);
      }
      formData.append('TotalFiles', TotalFiles);
      var editor1 = document.getElementById("editor1").value;
      var getdoc_file = $("input[name='doc_file[]']")
              .map(function(){return $(this).val();}).get();
      var getname = $("input[name='name[]']")
              .map(function(){return $(this).val();}).get();
      var doc_file="";
            for (index = 0; index < getdoc_file.length; ++index) {
              if(getdoc_file[index]!=""){
                doc_file="aaaa";
             }
             else{
                doc_file="";
             }
            }
      var name="";
            for (index = 0; index < getname.length; ++index) {
              if(getname[index]!=""){
                name="aaaa";
             }
             else{
              name="";
             }
            }
            console.log(name);
      if(editor1==""&&doc_file==""&&name==""){
         swal({
          title: "กรุณาป้อนข้อมูล",
          text: "",
          icon: "warning",
          showConfirmButton: false,
        });
      }
      else if(doc_file!=""&&name==""){
        swal({
          title: "กรุณาตั้งชื่อไฟล์",
          text: "",
          icon: "warning",
          showConfirmButton: false,
        });
      }
      else if(doc_file==""&&name!=""){
        swal({
          title: "กรุณาแนบหลักฐานอ้างอิง",
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
        url: "/addd",
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
          window.location = "/category3/pdca/{{session()->get('idmenu')}}";
        });
        },
        error: function(data) {
          swal({
          title: "เอกสารอ้างอิงไม่ถูกต้อง",
          text: "",
          icon: "error",
          showConfirmButton: false,
        });
          alert(data.responseJSON.errors.files[0]);
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