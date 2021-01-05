@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl wid50">
            <div class="box-header">
              <h2 class="box-title">เมนู</h2>
            </div>
            <a href="{{url('/dashboard/index3')}}">
            <button type="submit" class="btn btn-success ml-1"><i class="glyphicon glyphicon-plus-sign"></i> เพิ่มข้อมูล</button>
            </a>
            <!-- /.box-header -->
            <div class="box-body">
            <!-- /.box-header -->
            <table id="example3" class="table table-bordered table-striped ">
                <thead>
                <tr>
                  <th width="5%">No.</th>
                  <th width="30%">เมนู</th>
                  <th width="5%" >แก้ไข</th>
                  <th width="5%">ลบ</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($getmenu as $row)
                <tr>
                  <td>{{$row['m_id']}}</td>
                  <td>{{$row['m_name']}}</td>             
                  <td class="text-center"><button class="btn btn-warning"><i class='fa fas fa-edit'></i></button></td>
                  <td class="text-center"><button class="btn btn-danger"><i class='fa fa-trash'></i></button></td>
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
@endsection