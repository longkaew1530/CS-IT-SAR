@extends('layout.admid_layout')

@section('content')
<div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="{{asset('public/user/' . Auth::user()->image)}}" alt="User profile picture">

              <h3 class="profile-username text-center">{{ Auth::user()->user_fullname }}</h3>

              <p class="text-muted text-center">Software Engineer</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>ชื่อสกุล :</b> {{ Auth::user()->user_fullname }}
                </li>
                <li class="list-group-item">
                  <b>อีเมลล์ :</b> {{ Auth::user()->email }}
                </li>
                <li class="list-group-item">
                  <b>ตำแหน่งทางวิชาการ:</b> {{ Auth::user()->academic_position }}
                </li>
                <li class="list-group-item">
                  <b>หมวดหมู่ผู้ใช้งาน:</b>
                </li>
                <li class="list-group-item">
                  <b>หลักสูตร</b>
                </li>
              </ul>

              <a href="#" class="btn btn-primary btn-block"><b>แก้ไขข้อมูลส่วนตัว</b></a>
              <a href="#" class="btn btn-primary btn-block"><b>เปลี่ยนรหัสผ่าน</b></a>
              <a href="#" class="btn btn-primary btn-block"><b>ประวัติการเข้าใช้งาน</b></a>
            </div>
            <!-- /.box-body -->
          </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
  $(function () {
    $('#example3').DataTable({
      lengthMenu: [ 5, 10, 50, 100]
    })
  })
</script>

<script>
$(document).ready(function() {
$('#modal-edit').on('show.bs.modal', function (event) {
var button = $(event.relatedTarget);
var id= button.data('id');
var modal = $(this);
modal.find('#emp_id').val(id);
var url = "/getcourse";
        $.get(url + '/' + id, function (data) {
            //success data
            console.log(data)
            $("#courseid").val(data[0].course_id);
            $("#coursename").val(data[0].course_name);
            $("#branch1").val(data[0].branch);
            $("#facultyid").val(data[0].faculty_id);
            $("#coursecode").val(data[0].course_code);
            $("#updatecourse").val(data[0].update_course);
            $("#place1").val(data[0].place);
        }) 
});
});
</script>
@endsection