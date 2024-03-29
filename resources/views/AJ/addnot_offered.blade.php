@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
  <div class="box-header">
    <div class="box-body">
      <div class="col-sm-2" align="right"></div>
      <div class="col-sm-8" align="center">
        <h3><i class=""></i>รายวิชาที่ไม่ได้เปิดสอนในปีการศึกษา</h3>
        <hr>
      </div>
    </div>
    <form id="adddata" method="POST" action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data">
    @csrf
    <div class="row">
            <div class="col">
            <div class="data">
        <div class="col-md-12">
          <div id="body">
            <div class="col-md-12 col-sm-9 col-xs-12">
            <label for="exampleInputPassword1">รหัส ชื่อวิชา</label>
            <input type="text" class="form-control" id="code_name" name="code_name" placeholder="รหัส ชื่อวิชา">
            </div>
          </div>
        </div>
      </div>
            </div>
            <div class="col">
            <div class="data">
        <div class="col-md-12">
          <div id="body">
            <div class="col-md-12 col-sm-9 col-xs-12">
            <label for="exampleInputPassword1">ภาคการศึกษา</label>
            <input type="text" class="form-control" id="term" name="term" placeholder="ภาคการศึกษา">
            </div>
          </div>
        </div>
      </div>
      </div>
    </div>
    <div class="row">
            <div class="col">
            <div class="data">
        <div class="col-md-12">
          <div id="body">
            <div class="col-md-12 col-sm-9 col-xs-12">
            <label for="exampleInputPassword1">เหตุผลที่ไม่เปิดสอน</label>
            <input type="text" class="form-control" id="description" name="description" placeholder="เหตุผลที่ไม่เปิดสอน">
            </div>
          </div>
        </div>
      </div>
            </div>
            <div class="col">
            <div class="data">
        <div class="col-md-12">
          <div id="body">
            <div class="col-md-12 col-sm-9 col-xs-12">
            <label for="exampleInputPassword1">มาตรการที่ดำเนินการ</label>
            <input type="text" class="form-control" id="measure" name="measure" placeholder="มาตรการที่ดำเนินการ">
            </div>
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
  * {
  box-sizing: border-box;
}

.row {
  display: flex;
}

/* Create two equal columns that sits next to each other */
.col {
  flex: 50%;
  padding: 10px;
  height: 80px; /* Should be removed. Only for demonstration */
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
      var code_name = document.getElementById("code_name").value;
      var term = document.getElementById("term").value;
      var description = document.getElementById("description").value;
      var measure = document.getElementById("measure").value;
      if(code_name==""||term==""||description==""||measure==""){
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
        url: "/addnot_offered",
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
          window.location = "/category4/notcourse_summary";
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