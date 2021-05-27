@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl ">
            <div class="box-header">
              <h2 class="box-title">รายชื่ออาจารย์ผู้รับผิดชอบหลักสูตร</h2>
            </div>
            
        <div class="modal  fade" id="modal-edit">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">เพิ่มอาจารย์ผู้รับผิดชอบหลักสูตร</h4>
              </div>
              <form  id="adddata" method="POST" action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data">
              @csrf
              <div class="box-body">
              <table id="example11" class="table table-bordered table-striped ">
                <thead>
                <tr>
                  <th width="30px">ที่</th>
                  <th >ชื่อ-สกุล</th>
                  <th width="30px">เลือก</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($tc as $key=>$row)
                <tr>
                <td>{{$key+1}}</td>
                  <td>{{$row['user_fullname']}}</td>
                  <td>
                  <div class="form-check text-center">
                  <input class="form-check-input " value="{{$row['id']}}" name="idall[]" type="checkbox" id="flexCheckChecked" >
                </div>
                  </td>
                </tr>
                @endforeach
                </tbody></table>
              
           
              </div>
             
              <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">ปิด</button>
                <button type="submit" class="btn btn-info">บันทึกข้อมูล</button>
              </div>
              </form>
              <input type="hidden" class="form-control" name="id" id="emp_id" >
              
            </div>
            
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
            <button  class="btn btn-success ml-1" type="button"   data-toggle="modal" data-target="#modal-edit"><i class="fa fa-plus"></i> เพิ่มข้อมูล</button>
            @if($check!="[]")<button  class="btn btn-success ml-1" type="button" onclick="calc()" ><i class="fa fa-save"></i> ดึงข้อมูลปีการศึกษาที่ผ่านมา</button>
            @else
            <button  class="btn btn-success ml-1" type="button" onclick="calc()" disabled><i class="fa fa-save"></i> ดึงข้อมูลปีการศึกษาที่ผ่านมา</button>
            @endif
            <!-- /.box-header -->
            <div class="box-body">
            <!-- /.box-header -->
            <table id="example3" class="table table-bordered table-striped ">
                <thead>
                <tr>
                  <th width="5%">ที่</th>
                  <th>ชื่อ-สกุล</th>
                  <th width="5%">ลบ</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($tc_course as $key=>$row)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$row['user_fullname']}}</td>           
                  <td class="text-center">
                                      
                                      <button  id="{{$row->user_id}}" type="button" class="btn btn-danger ddd"><i class='fa fa-trash'></i></button>
                  </td>
                </tr>
                <div class="modal  fade" id="modal-info">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">เพิ่มหมวด</h4>
              </div>
              <form  method="POST" action="/addcategory">
              @csrf
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputPassword1">ชื่อหมวด</label>
                  <input type="text" class="form-control" id="category_name" name="category_name" placeholder="ชื่อหมวด">
                </div>
              </div>
            
              <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">ปิด</button>
                <button type="submit" class="btn btn-info">บันทึกข้อมูล</button>
              </div>
              </form>
              <input type="hidden" class="form-control" name="id" id="emp_id" >
              
            </div>
            
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

            </div>

                @endforeach
                </tbody>
              </table>
                
            </div>

            
            <!-- /.box-body -->
          </div>
            <!-- /.box-body -->
          </div>
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
.mt20{
  margin-top:50px
}
.ml-1{
  margin-left:10px
}
.ml-2{
  margin-left:20px
}
.mt-3{
  margin-top:30px;
}
.itemcenter{
  align-items: center;
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
        url: "/addcourse_responsible_teacher",
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
          window.location = "/addcourse_responsible_teacher";
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

    $('.ddd').click(function(e) {
      e.preventDefault();
      var id = $(this).attr('id');
      


      swal({
      title: "ยืนยันการลบข้อมูล?",
      icon: "warning",
      buttons: true,
      successMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
        type: 'POST',
        url: "/deletecourse_responsible_teacher/"+id,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: (data) => {
          swal({
          title: "ลบข้อมูลเรียบร้อย",
          text: "",
          icon: "success",
          button: "ตกลง",
        }).then(function() {
          window.location = "/addcourse_responsible_teacher";
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
<script>
  $(function () {
    $('#example3').DataTable({
      lengthMenu: [ 10, 20, 50, 100]
    });
    $('#example11').DataTable({
      lengthMenu: [ 10, 20, 50, 100]
    });
  })
</script>

<script>
$(document).ready(function() {
$('#modal-edit').on('show.bs.modal', function (event) {
var button = $(event.relatedTarget);
var id= button.data('id');
var modal = $(this);
modal.find('#emp_id').val(id);
var url = "/getcategory";
        $.get(url + '/' + id, function (data) {
            //success data
            console.log(data)
            $("#category_id").val(data[0].category_id);
            $("#categoryname").val(data[0].category_name);
        }) 
});
});
</script>
<script>
function calc() {

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
        url: "/addcourse_responsible_teacherback",
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
          window.location = "/addcourse_responsible_teacher";
        });
          }
        },
        error: function(data) {
          swal({
          title: "ข้อมูลเป็นของปีการศึกษาปีก่อนหน้าแล้ว",
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
</script>
@endsection