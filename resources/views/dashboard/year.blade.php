@extends('layout.admid_layout')

@section('content')
<div class="box box-warning  wid30 ml">
            <div class="box-header">
              <h2 class="box-title">ปีการศึกษา</h2>
            </div>          
            <!-- /.box-header -->
            <div class="box-body">
                <div class=" wid100">
          <!-- small box -->
                  <div class="small-box bg-green ">
                      <div class="inner">
                            @foreach($year as $value)
                              <p></p>
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
<div class="box box-warning marginl wid90 fr">
            <div class="box-header">
            <button type="button" class="btn btn-success fr" id="next"><i class="fa fa-plus "></i>  เพิ่มปีการศึกษา</button>
              <h2 class="box-title">จัดการปีการศึกษา</h2>
            </div>
           
            <!-- /.box-header -->
            <div class="box-body">
            <table id="example3" class="table table-bordered table-striped ">
                <thead>
                <tr>
                  <th width="10%">ที่</th>
                  <th>ปีการศึกษา</th>
                  <th width="15%">เปิดใช้งาน</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($getAllyear as $key=>$row)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$row['year_name']}}</td>    
                  <td>
                  @if($row['active']==1)
                  <button type="button" class="btn btn-success"  id="{{$row->year_id}}" disabled>กำลังใช้งาน</button>
                  @else
                  <button type="button" class="btn btn-primary aaa"  id="{{$row->year_id}}">เปิดใช้งาน</button>
                  @endif
                  </td>        
                </tr>
                @endforeach
                </tbody>
              </table>
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
  width:68%;
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
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
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
  $('.ddd').click(function(e){
    var token = $('meta[name="csrf-token"]').attr('content');
    var id = $(this).attr('id');
        e.preventDefault();
        console.log(id);
        $.ajax({
           type:'DELETE',
           url:'/deleteyear/'+id,
           data: {
          _token : token,
          id:id 
        },
           success:function(data){
            swal({
              title: "ลบข้อมูลเรียบร้อยแล้ว",
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