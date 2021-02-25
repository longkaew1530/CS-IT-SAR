@extends('layout.admid_layout')

@section('content')
<div class="row">
<div class="col-md-4">

</div>
<div class="col-md-4">
<div class="box box-primary">
    
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="{{asset('public/user/' . Auth::user()->image)}}" alt="User profile picture">

              <h3 class="profile-username text-center">{{ Auth::user()->user_fullname }}</h3>

              <p class="text-muted text-center">Software Engineer</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>ชื่อ-สกุล :</b> {{ Auth::user()->user_fullname }}
                </li>
                <li class="list-group-item">
                  <b>อีเมลล์ :</b> {{ Auth::user()->email }}
                </li>
                <li class="list-group-item">
                  <b>ตำแหน่งทางวิชาการ:</b> {{ Auth::user()->academic_position }}
                </li>
                <li class="list-group-item">
                  <b>หมวดหมู่ผู้ใช้งาน:</b> {{$data[0]['user_group_name']}}
                </li>
                <li class="list-group-item">
                  <b>หลักสูตร:</b> {{$data[0]['course_name']}}
                </li>
              </ul>

              <a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal-edit" data-id="{{$data[0]['id']}}"><b>แก้ไขข้อมูลส่วนตัว</b></a>
              <a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal-edit2" data-id="{{$data[0]['id']}}"><b>เปลี่ยนรหัสผ่าน</b></a>
              <a href="#" class="btn btn-primary btn-block"><b>ประวัติการเข้าใช้งาน</b></a>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <div class="modal  fade" id="modal-edit">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">แก้ไขข้อมูลส่วนตัว</h4>
              </div>
              <form  id="adddata" method="POST" action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data">
              @csrf
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">ชื่อ-สกุล</label>
                  <input type="text" class="form-control" id="fullname" name="user_fullname" placeholder="ชื่อ-สกุล">
                </div>
                <!--  -->
                <div class="form-group">
                  <label for="exampleInputPassword1">อีเมลล์</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="อีเมลล์">
                </div>
                <div class="form-group">
                <label for="exampleInputPassword1">ตำแหน่งทางวิชาการ</label>
                                  <select class="form-control"  id="academic_position"  class="form-control @error('role') is-invalid @enderror" name="academic_position">
                                    <option value="ศาสตราจารย์">ศาสตราจารย์</option>
                                    <option value="รองศาสตราจารย์">รองศาสตราจารย์</option>
                                    <option value="ผู้ช่วยศาสตราจารย์">ผู้ช่วยศาสตราจารย์</option>
                                  </select>
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

        <div class="modal  fade" id="modal-edit2">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">เปลี่ยนรหัสผ่าน</h4>
              </div>
              <form  id="adddata2" method="POST" action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data">
              @csrf
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">รหัสผ่านใหม่</label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="รหัสผ่านใหม่">
                </div>
                <!--  -->
                <div class="form-group">
                  <label for="exampleInputPassword1">ยืนยันรหัสผ่าน</label>
                  <input type="password" class="form-control" id="password2" name="password2" placeholder="ยืนยันรหัสผ่าน">
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
          <style>
.swal-title{
  margin:30px;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
  $(function () {
    $('#example3').DataTable({
      lengthMenu: [ 5, 10, 50, 100]
    })
  })
</script>
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
        url: "/updateprofile",
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
          window.location = "/profile";
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
<script type="text/javascript">
  $(document).ready(function(e) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $('#adddata2').submit(function(e) {
      e.preventDefault();
      var formData = new FormData(this);
      var pass1 = document.getElementById("password").value;
      var pass2 = document.getElementById("password2").value;
      if(pass1==""&&pass2==""){
         swal({
          title: "กรุณาป้อนรหัสผ่านทั้ง 2 ช่อง",
          text: "",
          icon: "warning",
          button: false,
          showConfirmButton: false,
          timer: 1500
        });
      }
      else if(pass1!=pass2){
        swal({
          title: "รหัสผ่านไม่ตรงกัน",
          text: "",
          icon: "warning",
          button: false,
          showConfirmButton: false,
          timer: 1500
        });
      }
      else if(pass1==pass2){
        $.ajax({
        type: 'POST',
        url: "/updatepassword",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: (data) => {
          swal({
          title: "เปลี่ยนรหัสผ่านเรียบร้อยแล้ว",
          text: "",
          icon: "success",
          button: "ตกลง",
        }).then(function() {
          window.location = "/profile";
        });
        },
        error: function(data) {
          alert(data.responseJSON.errors.files1[0]);
          console.log(data.responseJSON.errors);
        }
      });
      }
      
    });
  });
  
</script>
<script>
$(document).ready(function() {
$('#modal-edit').on('show.bs.modal', function (event) {
var button = $(event.relatedTarget);
var id= button.data('id');
var modal = $(this);
modal.find('#emp_id').val(id);
var url = "/getprofile";
        $.get(url + '/' + id, function (data) {
            //success data
            console.log(data)
            $("#courseid").val(data[0].course_id);
            $("#fullname").val(data[0].user_fullname);
            $("#email").val(data[0].email);
            $("#academic_position").val(data[0].academic_position);
        }) 
});
});
</script>
@endsection