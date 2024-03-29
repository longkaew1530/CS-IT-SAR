@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl wid50">
  <div class="box-header">
    <div class="box-body">
      <div class="col-sm-2" align="right"></div>
      <div class="col-sm-8" align="center">
      </div>
    </div>
    <form id="adddata" method="POST" action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data">
    @csrf
      <div class="data">
        <div class="col-md-12">
          <div class="box-header col-md-5 col-sm-9 col-xs-5">
            <h3 class="box-title">สรุปผลรายวิชาที่เปิดสอน</h3>
          </div>

         <a href="public/download/ตัวอย่างสรุปผลรายวิชาที่เปิดสอน.xlsx"
                                       download="ตัวอย่างสรุปผลรายวิชาที่เปิดสอน.xlsx"
                                       class="btn btn-outline-info" title="Download"> <i class="fa fa-download"></i> ดาวน์โหลดไฟล์ตัวอย่าง</a>

          
          <div id="body">
            <div class="col-md-12 col-sm-9 col-xs-12">
            <input   type="file" id="infostd" name="infostd">
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
      var formData = new FormData(this);
      var doc_file = document.getElementById("infostd").value;
      if(doc_file==""){
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
        url: "/addcourse_results",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: (data) => {
          if(data){
            swal({
          title: "บันทึกข้อมูลเรียบร้อย",
          text: "",
          icon: "success",
          button: "ตกลง",
        }).then(function() {
          window.location = "/category4/course_summary";
        });
          }
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
<style>
.marginl{
  padding:10px;
}
.wid10{
  width:10%;
}
.wid20{
  width:20%;
}
.wid30{
  width:30%;
}
.wid40{
  width:40%;
}
.wid50{
  width:50%;
}
</style>
@endsection