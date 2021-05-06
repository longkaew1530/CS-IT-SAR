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
              <span class="info-box-text"><font size="3">ตัวบ่งชี้ที่อยู่ระหว่างดำเนินการ</font></span>
              <span class="info-box-number"><font size="5" id="not"></font></span>
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
              <span class="info-box-text"><font size="3">ตัวบ่งชี้ที่เสร็จสิ้น</font></span>
              <span class="info-box-number"><font size="5" id="success"></font></span>
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
            <h3 class="box-title">ความคืบหน้าตัวบ่งชี้ที่ได้รับมอบหมาย</h3>
            </div>
              <table id="myTable" class="table table-condensed" style="width:100%">
        <thead>
            <tr>
            <th width="5%">ที่</th>
                  <th width="50%">ตัวบ่งชี้</th>
                  <th width="30%">ความคืบหน้า</th>
                  <th ></th>
                  <th ></th>
            </tr>
        </thead>
    </table>
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
td.details-control {
    background: url('images1/Untitled-2.png') no-repeat center center;
    cursor: pointer;
    
}
 
tr.shown td.details-control {
    background: url('images1/Untitled-1.png') no-repeat center center;
}
 
div.slider {
  display: none;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"></script>
<script src="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css"></script>
<script>
$(document).ready(function(){
  $.ajax({  //create an ajax request to display.php
          type: "GET",
          url: "/getsuccess",       
          success: function (data) {
           var success=0;
           var not=0;
            for (index = 0; index < data.length; ++index) {
              if(data[index].score==100){
              success=success+1;
             }
             else{
              not=not+1;
             }
            }
            $("#not").html(not);
            $("#success").html(success);
 
          }
        });

  var table = $('#myTable').DataTable( {
    ajax: {url:"/getsuccess",dataSrc:""},
    columns: [
        { data: "getid" },
        {"data" : function(data) {
          if(data.Indicator_id!=null){
            return 'ตัวบ่งชี้ '+data.Indicator_id+' '+data.Indicator_name
          }
          else{
            return data.Indicator_name
          }
        }},
        {"data" : function(data) {
          return '<div class="progress progress-xs"><div class="progress-bar progress-bar-'+data.color+'" style="width: '+data.score+'%"></div></div>'
       }},
       {"data" : function(data) {
          return '<span class="badge bg-'+data.color2+'">'+data.score+'%</span>'
       }},
       {"data" : function(data) {
        if(data.Indicator_id!=null){
          return '<a href="/showindicator/'+data.Indicator_id+'">ดูรายละเอียด</a>'
        }
        else{
          return '<a href="/showindicator/'+data.Indicator_name+'">ดูรายละเอียด</a>'
        }
       }}
    ],
} );
});
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