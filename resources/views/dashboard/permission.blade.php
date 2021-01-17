@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl ">
            <div class="box-header">
              <h2 class="box-title">กำหนดสิทธิ์ผู้ใช้งาน</h2>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <!-- /.box-header -->
            <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th width="5%">ID</th>
                  <th width="20%">กลุ่มผู้ใช้งาน</th>
                  <th width="60%">สิทธิ์ที่ได้รับ</th>
                  <th width="10%">กำหนดสิทธิ์</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($getusergroup as $row )
                <tr>
                  <td>{{$row['user_group_id']}}</td>
                  <td>{{$row['user_group_name']}}</td>
                  <td>
                    @foreach($getper as $value)
                      @if($value['user_group_id']==$row['user_group_id'])
                        <span class="badge bg-green pd-1">{{$value['m_name']}}</span>
                      @endif
                    @endforeach
                  </td>
                  <td class="text-center"><button class="btn btn-warning" type="button" data-id="{{$row['user_group_id']}}"  data-toggle="modal" data-target="#modal-info" ><i class='fa fas fa-edit'></i></button></td>
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
              <?php $checkrole=false ?>
              <form method="POST" action="/addper">
               @csrf
                @foreach($role as $row )
                <h4><p class="bginfo">{{$row['g_name']}}</p></h4>
                <div class="form-group ml-1">
                @foreach($row->menu as $value)
                    @if(session()->get('data')!=null)
                      @foreach(session()->get('data') as $row2)
                         @if($row2['m_id']==$value['m_id'])
                           <?php $checkrole=true; ?>
                         @endif
                      @endforeach
                     @endif
                  <div class="checkbox">
                    <label>
                      <input type="checkbox"  name="per[]" value="{{$value['m_id']}}" @if($checkrole) checked @endif> 
                      <?php $checkrole=false; ?>      
                      {{$value['m_name']}}
                    </label>
                  </div>
                  @endforeach
          </div>
                 @endforeach
              <div class="modal-footer">
                <button type="button" class="btn btn-info pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-info">บันทึกข้อมูล</button>
              </div>
              <input type="hidden" class="form-control" name="id" id="emp_id" >
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
        }) 
});
});
</script>
<script>
  $(function () {
    $('#example2').DataTable({
      lengthMenu: [ 10, 20, 50, 100]
    })
  })
</script>
@endsection