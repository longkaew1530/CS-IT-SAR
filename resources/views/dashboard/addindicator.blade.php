@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl ">
            <div class="box-header">
              <h2 class="box-title">มอบหมายตัวบ่งชี้</h2>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <!-- /.box-header -->
            <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th width="5%">ID</th>
                  <th >กลุ่มผู้ใช้งาน</th>
                  <th width="10%">มอบหมายตัวบ่งชี้</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($getusergroup as $key=>$row )
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$row['user_fullname']}}</td>
                  <td class="text-center"><a href="/getindicator/{{$row['id']}}" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> มอบหมายตัวบ่งชี้</a></td>
                </tr>
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
.pd-1{
  padding:5px;
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
var url = "/getrolepermisson";
        $.get(url + '/' + id, function (data) {
          $("#modal-info").trigger("reset");
        }) 
});
});
</script>
<script>
  $(function () {
    $('#example2').DataTable({
      lengthMenu: [ 5, 20, 50, 100]
    })
  })
</script>
@endsection