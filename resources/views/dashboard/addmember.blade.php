@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl ">
            <div class="box-header">
              <h2 class="box-title">รายชื่อผู้ใช้งาน</h2>
            </div>
            <button  class="btn btn-success ml-1" type="button"   data-toggle="modal" data-target="#modal-info"><i class="fa fa-plus"></i> เพิ่มข้อมูล</button>
            <!-- /.box-header -->
            <div class="box-body">
            <!-- /.box-header -->
            <table id="example3" class="table table-bordered table-striped ">
                <thead>
                <tr>
                  <th width="5%">ที่</th>
                  <th width="10%">รูปภาพ</th>
                  <th width="20%">ชื่อ-สกุล</th>
                  <th width="20%">email</th>
                  <th width="20%">คณะ</th>
                  <th width="15%">หลักสูตร</th>
                  <th width="30%">กลุ่มผู้ใช้งาน</th>
                  <th width="5%" >แก้ไข</th>
                  <th width="5%">ลบ</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($user as $key=>$row)
                <tr>
                  <td>{{$key+1}}</td>
                  <td><img src="{{asset('public/user/' . $row['image'])}}" width="65"></td>
                  <td>{{$row['user_fullname']}}</td>  
                  <td>{{$row['email']}}</td>
                  <td>{{$row['faculty_name']}}</td>
                  <td>{{$row['course_name']}}</td>
                  <td>{{$row['user_group_name']}}</td>                 
                  <td class="text-center"><button class="btn btn-warning" type="button"   data-toggle="modal" data-target="#modal-edit" data-id="{{$row['id']}}"><i class='fa fas fa-edit'></i></button></td>
                  <td class="text-center">
                  <meta name="csrf-token" content="{{ csrf_token() }}">
                  <button  type="button" class="btn btn-danger deletedata" data-id="{{$row['id']}}"><i class='fa fa-trash'></i></button>
                  </td>
                </tr>
                <div class="modal  fade" id="modal-info">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">เพิ่มข้อมูลกลุ่มเมนู</h4>
              </div>
              <form  id="formadd" method="POST" action="/adduser"  enctype="multipart/form-data">
              @csrf
              <div class="box-body">
                <div class="form-group">
                <label for="exampleInputEmail1">รูปภาพ</label><br>
                <img id="image_preview_container" src="http://127.0.0.1:8000/dist/img/user2-160x160.jpg"
                        alt="preview image" style="max-height: 150px;">
                  <input type="file" id="image" name="image" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">ชื่อ-สกุล</label>
                  <input type="text" class="form-control" id="user_fullname" name="user_fullname" placeholder="ชื่อ-สกุล">
                </div>
                <div class="form-group">
                <div class="form-group">
                  <label for="exampleInputPassword1">username</label>
                  <input type="text" class="form-control" id="username" name="username" placeholder="username">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">password</label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="password">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">email</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="email">
                </div>
                <div class="form-group">
                <label for="exampleInputPassword1">คณะ</label>
                                  <select class="form-control"  id="user_faculty"  class="form-control @error('role') is-invalid @enderror" name="user_faculty">
                                    @foreach($faculty as $value)
                                    <option value="{{$value['faculty_id']}}">{{$value['faculty_name']}}</option>
                                    @endforeach
                                  </select>
                                  </div>
                <div class="form-group">
                <label for="exampleInputPassword1">หลักสูตร</label>
                                  <select class="form-control"  id="user_course"  class="form-control @error('role') is-invalid @enderror" name="user_course">
                                    @foreach($course as $value)
                                    <option value="{{$value['course_id']}}">{{$value['course_name']}}</option>
                                    @endforeach
                                  </select>
                                  </div>
                                  <div class="form-group">
                <label for="exampleInputPassword1">กลุ่มผู้ใช้งาน</label>
                                  <select class="form-control"  id="user_group_id"  class="form-control @error('role') is-invalid @enderror" name="user_group_id">
                                    @foreach($groupuser as $value)
                                    <option value="{{$value['user_group_id']}}">{{$value['user_group_name']}}</option>
                                    @endforeach
                                  </select>
                                  </div>
                 <div class="form-group">
                  <label for="exampleInputPassword1">ตำแหน่งทางวิชาการ</label>
                  <input type="text" class="form-control" id="academic_position" name="academic_position" placeholder="ตำแหน่งทางวิชาการ">
                </div>
              </div>
            
              <div class="modal-footer">
                <button type="button" class="btn btn-info pull-left" data-dismiss="modal">Close</button>
                <button type="submit"  class="btn btn-info ">บันทึกข้อมูล</button>
              </div>
              </form>
              <input type="hidden" class="form-control " name="id" id="emp_id" >        
            </div>   
          </div>
          </div>
          <!-- /.modal-dialog -->
        </div>
        <div class="modal  fade" id="modal-edit" >
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">เพิ่มข้อมูลกลุ่มเมนู</h4>
              </div>
              <form  id="updatedata" method="POST" action="/updateuser" enctype="multipart/form-data">
              @csrf
              {{ method_field('PUT') }}
              <div class="box-body">
                <div class="form-group">
                <input type="hidden" class="form-control" id="userid1" name="userid">
                <label for="exampleInputEmail1">รูปภาพ</label><br>
                <img id="image_preview_container1" src="{{asset('public/user/')}}"
                        alt="preview image" style="max-height: 150px;">
                  <input type="file" id="image1" name="image" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">ชื่อ-สกุล</label>
                  <input type="text" class="form-control" id="user_fullname1" name="user_fullname" placeholder="ชื่อ-สกุล">
                </div>
                <div class="form-group">
                <div class="form-group">
                  <label for="exampleInputPassword1">username</label>
                  <input type="text" class="form-control" id="username1" name="username" placeholder="username">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">password</label>
                  <input type="password" class="form-control" id="password1" name="password" placeholder="password">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">email</label>
                  <input type="email" class="form-control" id="email1" name="email" placeholder="email">
                </div>
                <div class="form-group">
                <label for="exampleInputPassword1">คณะ</label>
                                  <select class="form-control"  id="user_faculty1"  class="form-control @error('role') is-invalid @enderror" name="user_faculty">
                                    @foreach($faculty as $value)
                                    <option value="{{$value['faculty_id']}}">{{$value['faculty_name']}}</option>
                                    @endforeach
                                  </select>
                                  </div>
                <div class="form-group">
                <label for="exampleInputPassword1">หลักสูตร</label>
                                  <select class="form-control"  id="user_course1"  class="form-control @error('role') is-invalid @enderror" name="user_course">
                                    @foreach($course as $value)
                                    <option value="{{$value['course_id']}}">{{$value['course_name']}}</option>
                                    @endforeach
                                  </select>
                                  </div>
                                  <div class="form-group">
                <label for="exampleInputPassword1">กลุ่มผู้ใช้งาน</label>
                                  <select class="form-control"  id="user_group_id1"  class="form-control @error('role') is-invalid @enderror" name="user_group_id">
                                    @foreach($groupuser as $value)
                                    <option value="{{$value['user_group_id']}}">{{$value['user_group_name']}}</option>
                                    @endforeach
                                  </select>
                                  </div>
                 <div class="form-group">
                  <label for="exampleInputPassword1">ตำแหน่งทางวิชาการ</label>
                  <input type="text" class="form-control" id="academic_position1" name="academic_position" placeholder="ตำแหน่งทางวิชาการ">
                </div>
                <input type="hidden" class="form-control " name="id" id="user_id" >
                <div class="modal-footer">
                <button type="button" class="btn btn-info pull-left" data-dismiss="modal">Close</button>
                <button type="submit"  class="btn btn-info ">บันทึกข้อมูล</button>
              </div>
              </form>
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
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
  $(function () {
    $('#example3').DataTable({
      lengthMenu: [ 5, 10, 50, 100]
    })
  })
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>

<script >
$(document).ready(function() {
$('#modal-edit').on('show.bs.modal', function (event) {
var button = $(event.relatedTarget);
var id= button.data('id');
var modal = $(this);
modal.find('#user_id').val(id);
var url = "/getuser";
        $.get(url + '/' + id, function (data) {
            //success data
            $("#userid1").val(data[0].id);
            $("#user_fullname1").val(data[0].user_fullname);
            $("#email1").val(data[0].email);
            $("#username1").val(data[0].username );
            $("#password1").val(data[0].password);
            $("#user_faculty1").val(data[0].user_faculty);
            $("#user_course1").val(data[0].user_course);
            $("#user_group_id1").val(data[0].user_group_id);
            $("#academic_position1").val(data[0].academic_position);
            // $("#image1").val(data[0].image);
            console.log(data);
        }) 
});
});
</script>

<script type="text/javascript">
  $('#formadd').ajaxForm(function()         
         {        
            swal({
              title: "เพิ่มข้อมูลเรียบร้อยแล้ว",
            text: "",
            icon: "success",
            button: "ตกลง",
           }).then(function() {
              window.location = "/dashboard/addmember";
           });        
         }); 
  $('#updatedata').ajaxForm(function()         
         {        
            swal({
              title: "อัปเดตข้อมูลเรียบร้อยแล้ว",
            text: "",
            icon: "success",
            button: "ตกลง",
           }).then(function() {
              window.location = "/dashboard/addmember";
           });        
         });
</script>
<script type="text/javascript">
  $(".deletedata").click(function(){
    var id = $(this).data("id");
    var token = $("meta[name='csrf-token']").attr("content");
   
    $.ajax(
    {
        url: "/deleteuser/"+id,
        type: 'DELETE',
        data: {
            "id": id,
            "_token": token,
        },
        success:function(data){
            swal({
              title: "ลบข้อมูลเรียบร้อยแล้ว",
            text: "",
            icon: "success",
            button: "ตกลง",
           }).then(function() {
              window.location = "/dashboard/addmember";
           });
           }
    });
   
});
$('#image').change(function(){
          let reader = new FileReader();
          reader.onload = (e) => { 
            $('#image_preview_container').attr('src', e.target.result); 
          }
          reader.readAsDataURL(this.files[0]); 

      });
</script>
@endsection