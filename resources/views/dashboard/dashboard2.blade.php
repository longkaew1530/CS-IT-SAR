@extends('layout.admid_layout')

@section('content')
      <h3>
      
      </h3>         
            <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa  fa-file-text-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"><font size="3">ตัวบ่งชี้ที่ได้รับมอบหมาย</font></span>
              <span class="info-box-number"><font size="5">{{$getwork}}</font></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-spinner"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"><font size="3">อยู่ระหว่างดำเนินการ</font></span>
              <span class="info-box-number"><font size="5">5</font></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-check"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"><font size="3">เสร็จสิ้น</font></span>
              <span class="info-box-number"><font size="5">5</font></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- /.col -->
      </div> 

      <div class="box box-warning marginl">
<div class="box-header">
  <div id="exportContent">
            <div class="box-header" >
            <h3 class="box-title">ความคืบหน้าแต่ละตัวบ่งชี้</h3>
            </div>
              <table class="table table-condensed">
                <tbody><tr>
                  <th>ที่</th>
                  <th>ตัวบ่งชี้</th>
                  <th>ความคืบหน้า</th>
                  <th></th>
                </tr>
                
                <div >
                <tr>
                  <td>1</td>
                  <td>5.4</td>
                  <td>
                    <div class="progress progress-xs">
                      <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                    </div>
                  </td>
                  <td><span class="badge bg-red">55%</span>&nbsp&nbsp&nbsp&nbsp<a href=""  id="add" >ดูรายละเอียด</a></td>
                </tr>
                </div>
                
              </tbody></table>
</div></div></div> 
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
.wid90{
  width:50%;
}
.cnt{
  margin-left:100px;
}
.mt20{
  margin-top:50px
}
.ml-1{
  margin-left:10px
}
.mr-1{
  margin-right:10px
}
.ml{
  float:left;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
  $(function () {
    $('#example3').DataTable({
      lengthMenu: [ 5, 10, 15, 100]
    })
  })
</script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }); 
    $("#next").click(function(e){
      var token = $('meta[name="csrf-token"]').attr('content');
        e.preventDefault();
        $.ajax({
           type:'PUT',
           url:'/nextyear',
           data: {
          _token : token 
        },
           success:function(data){
            swal({
              title: "เพิ่มข้อมูลเรียบร้อยแล้ว",
            text: "",
            icon: "success",
            button: "ตกลง",
           }).then(function() {
              window.location = "/";
           });
           }
        });
	});
  

  $('.aaa').click(function(e){
    var token = $('meta[name="csrf-token"]').attr('content');
    var id = $(this).attr('id');
        e.preventDefault();
        console.log(id);
        $.ajax({
           type:'PUT',
           url:'/backyear',
           data: {
          _token : token,
          id:id 
        },
           success:function(data){
            swal({
              title: "เปิดใช้งานปีการศึกษาเรียบร้อยแล้ว",
            text: "",
            icon: "success",
            button: "ตกลง",
           }).then(function() {
              window.location = "/";
           });
           }
        });
  });
</script>

@endsection