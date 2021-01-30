@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
  <div class="box-header">
    <div class="box-body">
      <div class="col-sm-2" align="right"></div>
      <div class="col-sm-8" align="center">
        <h3><i class=""></i>การปฐมนิเทศอาจารย์ใหม่</h3>
        <hr>
      </div>
    </div>
    <form id="adddata" method="POST" action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data">
    @csrf

    <div class="row">
  <div class="column"><div class="col-md-12">
          <div class="box-header col-md-12 col-sm-9 col-xs-12">
            <h3 class="box-title">การปฐมนิเทศเพื่อชี้แจ้งหลักสูตร</h3>
          </div>
            <div class="col-md-12 col-sm-9 col-xs-12">
            <label>
                      <input type="radio" name="point_out" id="optionsRadios1" value="1" onclick="openTxt()" checked>
                      มี
                    </label>
                    &nbsp;&nbsp;&nbsp;<label>
                      <input type="radio" name="point_out" id="optionsRadios1" value="0" onclick="EnableTxt()">
                      ไม่มี
                    </label>
            </div>
        </div></div>
        <div class="column"><div class="col-md-12">
          <div class="box-header col-md-12 col-sm-9 col-xs-12">
            <h3 class="box-title">จำนวนอาจารย์ใหม่</h3>
          </div>
            <div class="col-md-12 col-sm-9 col-xs-12">
            <input type="text" class="form-control" id="new_teacher_qty" name="new_teacher_qty" />
            </div>
        </div></div>
        <div class="column"><div class="col-md-12">
          <div class="box-header col-md-12 col-sm-9 col-xs-12">
            <h3 class="box-title">จำนวนอาจารย์ที่เข้าร่วมปฐมนิเทศ</h3>
          </div>
            <div class="col-md-12 col-sm-9 col-xs-12">
            <input type="text" class="form-control" id="teacher_point_out_qty" name="teacher_point_out_qty" />
            </div>
        </div></div>
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
  .column {
  float: left;
  width: 30%;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
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
      $.ajax({
        type: 'POST',
        url: "/addteacher_orientation",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: (data) => {
          swal({
          title: "เพิ่มข้อมูลเรียบร้อยแล้ว",
          text: "",
          icon: "success",
          button: "ตกลง",
        }).then(function() {
          window.location = "/category4/newteacher";
        });
        },
        error: function(data) {
          alert(data.responseJSON.errors.files1[0]);
          console.log(data.responseJSON.errors);
        }
      });
    });
  });
  
  function EnableTxt() {
       document.getElementById("new_teacher_qty").disabled = true;
       document.getElementById("teacher_point_out_qty").disabled = true;
   }
   function openTxt() {
       document.getElementById("new_teacher_qty").disabled = false;
       document.getElementById("teacher_point_out_qty").disabled = false;
   }
</script>
@endsection