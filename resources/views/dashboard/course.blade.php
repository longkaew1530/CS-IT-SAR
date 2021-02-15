@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl ">
            <div class="box-header">
              <h2 class="box-title">หลักสูตร</h2>
            </div>
            <button  class="btn btn-success ml-1" type="button"   data-toggle="modal" data-target="#modal-info"><i class="fa fa-plus"></i> เพิ่มข้อมูล</button>
            <!-- /.box-header -->
            <div class="box-body">
            <!-- /.box-header -->
            <table id="example3" class="table table-bordered table-striped ">
                <thead>
                <tr>
                  <th width="5%">ที่</th>
                  <th width="30%">หลักสูตร</th>
                  <th width="30%">คณะ</th>
                  <th width="10%">รหัสหลักสูตร</th>
                  <th width="5%" >แก้ไข</th>
                  <th width="5%">ลบ</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($course as $key=>$row)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$row['course_name']}}</td>  
                  <td>{{$row['faculty_name']}}</td>
                  <td>{{$row['course_code']}}</td>       
                  <td class="text-center"><button class="btn btn-warning" type="button"   data-toggle="modal" data-target="#modal-edit" data-id="{{$row['course_id']}}"><i class='fa fas fa-edit'></i></button></td>
                  <td class="text-center">
                                      <form id="delete-form" method="POST" action="/deletecourse/{{$row['course_id']}}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                      <button type="submit" class="btn btn-danger"><i class='fa fa-trash'></i></button></form>
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
              <form  method="POST" action="/addcourse">
              @csrf
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">หลักสูตร</label>
                  <input type="text" class="form-control" id="course_name" name="course_name" placeholder="หลักสูตร">
                </div>
                <div class="form-group">
                <label for="exampleInputPassword1">คณะ</label>
                                  <select class="form-control"  id="faculty_id"  class="form-control @error('role') is-invalid @enderror" name="faculty_id">
                                    @foreach($faculty as $value)
                                    <option value="{{$value['faculty_id']}}">{{$value['faculty_name']}}</option>
                                    @endforeach
                                  </select>
                                  </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">รหัสหลักสูตร</label>
                  <input type="text" class="form-control" id="course_code" name="course_code" placeholder="รหัสหลักสูตร">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">หลักสูตรปรับปรุง</label>
                  <input type="text" class="form-control" id="update_course" name="update_course" placeholder="หลักสูตรปรับปรุง">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">สถานที่</label>
                  <input type="text" class="form-control" id="place" name="place" placeholder="สถานที่">
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

        <div class="modal  fade" id="modal-edit">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">เพิ่มข้อมูลกลุ่มเมนู</h4>
              </div>
              <form  method="POST" action="/updatecourse">
              @csrf
              {{ method_field('PUT') }}
              <div class="box-body">
              <div class="form-group">
              <input type="hidden" class="form-control" id="courseid" name="course_id" >
                  <label for="exampleInputEmail1">หลักสูตร</label>
                  <input type="text" class="form-control" id="coursename" name="course_name" placeholder="หลักสูตร">
                </div>
                <div class="form-group">
                <label for="exampleInputPassword1">คณะ</label>
                                  <select class="form-control"  id="facultyid"  class="form-control @error('role') is-invalid @enderror" name="faculty_id">
                                    @foreach($faculty as $value)
                                    <option value="{{$value['faculty_id']}}">{{$value['faculty_name']}}</option>
                                    @endforeach
                                  </select>
                                  </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">รหัสหลักสูตร</label>
                  <input type="text" class="form-control" id="coursecode" name="course_code" placeholder="รหัสหลักสูตร">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">หลักสูตรปรับปรุง</label>
                  <input type="text" class="form-control" id="updatecourse" name="update_course" placeholder="หลักสูตรปรับปรุง">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">สถานที่</label>
                  <input type="text" class="form-control" id="place1" name="place" placeholder="สถานที่">
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
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
  $(function () {
    $('#example3').DataTable({
      lengthMenu: [ 8, 20, 50, 100]
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
            $("#facultyid").val(data[0].faculty_id);
            $("#coursecode").val(data[0].course_code);
            $("#updatecourse").val(data[0].update_course);
            $("#place1").val(data[0].place);
        }) 
});
});
</script>
@endsection