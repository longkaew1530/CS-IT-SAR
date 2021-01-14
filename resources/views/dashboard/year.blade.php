@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl wid30">
            <div class="box-header">
              <h2 class="box-title">จัดการปีการศึกษา</h2>
            </div>
            <button type="submit" class="btn btn-danger ml-1" id="back"><i class="fa  fa-minus mr-1"></i>  ปีการศึกษาก่อนหน้า</button>
            
            <button type="button" class="btn btn-success ml-1" id="next"><i class="fa fa-plus mr-1"></i>  ปีการศึกษาถัดไป</button>
            <!-- /.box-header -->
            <div class="box-body">
            <div class=" wid100">
          <!-- small box -->
          <div class="small-box bg-green ">
            <div class="inner">
            @foreach($year as $value)
               <p>ปีการศึกษา</p>
              <h3>{{$value['year_name']}}</h3>   
            @endforeach
            </div>
            <div class="icon">
              <i class="fa fa-calendar"></i>
            </div>
            <a href="#" class="small-box-footer"><i class="fa fa-calendart"></i></a>
          </div>
        </div>
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
  width:80%;
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
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
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
</script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }); 
    $("#back").click(function(e){
      var token = $('meta[name="csrf-token"]').attr('content');
        e.preventDefault();
        $.ajax({
           type:'PUT',
           url:'/backyear',
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
</script>
@endsection