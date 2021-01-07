@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl wid50">
            <div class="box-header">
              <h2 class="box-title">กลุ่มผู้ใช้งาน</h2>
            </div>
            <button  class="btn btn-success ml-1" type="button"   data-toggle="modal" data-target="#modal-info"><i class="fa fa-plus"></i> เพิ่มข้อมูล</button>
            <!-- /.box-header -->
            <div class="box-body">
            <!-- /.box-header -->
            <table id="example3" class="table table-bordered table-striped ">
                <thead>
                <tr>
                  <th width="5%">ที่</th>
                  <th width="30%">กลุ่มผู้ใช้งาน</th>
                  <th width="5%" >แก้ไข</th>
                  <th width="5%">ลบ</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($groupuser as $key=>$row)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$row['user_group_name']}}</td>         
                  <td class="text-center"><button class="btn btn-warning" type="button"   data-toggle="modal" data-target="#modal-edit" data-id="{{$row['user_group_id']}}"><i class='fa fas fa-edit'></i></button></td>
                  <td class="text-center">
                                      <form id="delete-form" method="POST" action="/deleteusergroup/{{$row['user_group_id']}}">
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
              <form  method="POST" action="/addusergroup">
              @csrf
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">กลุ่มผู้ใช้งาน</label>
                  <input type="text" class="form-control" id="user_group_name" name="user_group_name" placeholder="กลุ่มผู้ใช้งาน">
                </div>
                
              </div>
            
              <div class="modal-footer">
                <button type="button" class="btn btn-info pull-left" data-dismiss="modal">Close</button>
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
              <form  method="POST" action="/updateusergroup">
              @csrf
              {{ method_field('PUT') }}
              <div class="box-body">
              <div class="form-group">
              <input type="hidden" class="form-control" id="usergroup_id" name="user_group_id" >
                  <label for="exampleInputEmail1">กลุ่มผู้ใช้งาน</label>
                  <input type="text" class="form-control" id="usergroup_name" name="user_group_name" placeholder="กลุ่มผู้ใช้งาน">
                </div>
                
              </div>
            
              <div class="modal-footer">
                <button type="button" class="btn btn-info pull-left" data-dismiss="modal">Close</button>
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
var url = "/getusergroup";
        $.get(url + '/' + id, function (data) {
            //success data
            console.log(data)
            $("#usergroup_id").val(data[0].user_group_id);
            $("#usergroup_name").val(data[0].user_group_name);
        }) 
});
});
</script>
@endsection