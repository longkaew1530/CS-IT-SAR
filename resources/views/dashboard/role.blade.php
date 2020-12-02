@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl wid50">
            <div class="box-header">
              <h2 class="box-title">กำหนดสิทธิ์ผู้ใช้งาน</h2>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <!-- /.box-header -->
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th width="60%">กลุ่มผู้ใช้งาน</th>
                  <th>กำหนดสิทธิ์</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($Getall as $row )
                <tr>
                  <td>{{$row['id']}}</td>
                  <td>{{$row['name']}}</td>
                  <td><button class="btn btn-warning" type="button" data-id="{{$row['id']}}"  data-toggle="modal" data-target="#modal-info" ><i class='fa fas fa-edit'></i>กำหนดสิทธิ์</button></td>
                </tr>
                @endforeach
                </tbody>
              </table>
            
              <div class="modal  fade" id="modal-info">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">กำหนดสิทธิ์ผู้ใช้งาน</h4>
              </div>
              <form method="POST" action="/addper">
               @csrf
                @foreach($role as $row )
                <h4><p class="bginfo">{{$row['G_Name']}}</p></h4>
                <div class="form-group ml-1">
                @foreach($row->menu as $value)
                  <div class="checkbox">
                    <label>
                      <input type="checkbox"  name="per[]" value="{{$value['M_Name']}}">
                      {{$value['M_Name']}}
                    </label>
                  </div>
                  @endforeach
          </div>
                 @endforeach
              <div class="modal-footer">
                <button type="button" class="btn btn-info pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-info">บันทึกข้อมูล</button>
              </div>
              <input type="text" class="form-control" name="id" id="emp_id" hidden>
              </form>
            </div>
            
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
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
.bginfo{
    background-color:#5bc0de;
    padding:10px;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
$(document).ready(function() {
$('#modal-info').on('show.bs.modal', function (event) {
var button = $(event.relatedTarget);
var id= button.data('id');
var modal = $(this);
modal.find('#emp_id').val(id);
console.log(id)
});
});
</script>
@endsection