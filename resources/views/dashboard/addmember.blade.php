@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
            <div class="box-header">
              <h2 class="box-title">รายชื่อผู้ใช้งานทั้งหมด</h2>
            </div>
            <a href="{{url('/dashboard/index3')}}">
            <button type="submit" class="btn btn-success ml-1"><i class="glyphicon glyphicon-plus-sign"></i> เพิ่มข้อมูล</button>
            </a>
            <!-- /.box-header -->
            <div class="box-body">
            <!-- /.box-header -->
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>รูปภาพ</th>
                  <th>ชื่อนามสกุล</th>
                  <th>email</th>
                  <th>password</th>
                 
                  <th>แก้ไข</th>
                  <th>ลบ</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($Getall as $row )
                <tr>
                  <td>{{$row['user_id']}}</td>
                  <td><img src="../dist/img/user2-160x160.jpg" width="100"></td>
                  <td>{{$row['user_fullname']}}</td>
                  <td>{{$row['email']}}</td>
                  <td>{{$row['password']}}</td>
                  
                  <td><button class="btn btn-warning"><i class='fa fas fa-edit'></i> แก้ไข</button></td>
                  <td><button class="btn btn-danger"><i class='fa fa-trash'></i> ลบ</button></td>
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
</style>
@endsection