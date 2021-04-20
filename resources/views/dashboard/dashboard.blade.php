@extends('layout.admid_layout')

@section('content')

<div class="box box-warning  wid30 ml">
            <div class="box-header">
              <h4 class="box-title">ความคืบหน้าของผลการดำเนินงานทั้งหมด</h4>
            </div>          
            <!-- /.box-header -->
            <div class="box-body">
                <div class="cnt">
                   
                      <input type="text" class="knob" value="{{$scoreall}}" data-width="90" data-height="90" data-fgColor="#932ab6" disabled>
                      <div class="knob-label"></div>
                  
                 </div>
            </div>
</div>     
<div class="box box-warning marginl wid90 fr">
            <div class="box-header">
            
              <h2 class="box-title">จัดการปีการศึกษา</h2>
            </div>
           
            <!-- /.box-header -->
            <div class="box-body">
            <div class="box-body">
              <div id="bar-chart" style="height: 300px;"></div>
            </div>
            </div>
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