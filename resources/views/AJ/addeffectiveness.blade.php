@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
  <div class="box-header">
  <a href="/category4/effectiveness" class="btn btn-info fr"><i class='fa fa-eye'></i> ดูรายงาน</a>
    <div class="box-body">
      <div class="col-sm-2" align="right"></div>
      <div class="col-sm-8" align="center">
        <h3><i class=""></i>ประสิทธิผลของกลยุทธ์การสอน</h3>
        <hr>
      </div>
    </div>
    <form id="adddata" method="POST" action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data">
    @csrf
      
        <div class="col-md-12">
          <div class="box-header col-md-12 col-sm-9 col-xs-12">
            <h3 class="box-title">มาตรฐานผลการเรียนรู้</h3>
          </div>
          
            <div class="col-md-12 col-sm-9 col-xs-12">
              <textarea  id="editor5" name="learning_standards" rows="10" cols="80">
              </textarea>
            </div>
          

        </div>
      <div class="data">
        <div class="col-md-12">
          <div class="box-header col-md-12 col-sm-9 col-xs-12">
            <h3 class="box-title">สรุปข้อคิดเห็นของผู้สอนและข้อมูลป้อนกลับจากแหล่งต่าง ๆ</h3>
          </div>
          
            <div class="col-md-12 col-sm-9 col-xs-12">
              <textarea  id="editor6" name="comment" rows="10" cols="80">
                           </textarea>
            </div>
          

        </div>
      </div>
      <div class="data">
        <div class="col-md-12">
          <div class="box-header col-md-12 col-sm-9 col-xs-12">
            <h3 class="box-title">แนวทางการแก้ไขปรับปรุง</h3>
          </div>
          
            <div class="col-md-12 col-sm-9 col-xs-12">
              <textarea  id="editor1" name="solution" rows="10" cols="80">
                           </textarea>
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
     var editor5 = document.getElementById("editor5").value;
      var editor6 = document.getElementById("editor6").value;
      var editor1 = document.getElementById("editor1").value;
      if(editor5==""||editor6==""||editor1==""||editor5==''||editor6==''||editor1==''||editor5==null||editor6==null||editor1==null){
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
        url: "/addeffectiveness",
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
          window.location = "/category4/effectiveness";
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
  }
    });
  });
  
</script>
@endsection