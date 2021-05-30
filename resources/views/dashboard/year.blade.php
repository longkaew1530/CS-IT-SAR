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
                            @if($year!="[]")
                            @foreach($year as $value)
                              <p></p>
                              <h3>{{$value['year_name']}}</h3>   
                            @endforeach
                            @else
                            <p></p>
                              <h4>ยังไม่มีปีการศึกษา</h4>   
                            @endif
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
            @if($getAllyear!="[]")
            <button type="button" class="btn btn-success fr" data-toggle="modal" data-target="#modal-info2"><i class="fa fa-plus "></i>  เพิ่มปีการศึกษา</button>
              <h2 class="box-title">จัดการปีการศึกษา</h2>
            </div>
           @else
           <button type="button" class="btn btn-success fr" data-toggle="modal" data-target="#modal-info"><i class="fa fa-plus "></i>  เพิ่มปีการศึกษา</button>
              <h2 class="box-title">จัดการปีการศึกษา</h2>
            </div>
           @endif
            <!-- /.box-header -->
            <div class="box-body">
            <table id="example3" class="table table-bordered table-striped ">
                <thead>
                <tr>
                  <th width="10%">ที่</th>
                  <th>ปีการศึกษา</th>
                  <th width="15%">เปิด-ปิดการใช้งาน</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($getAllyear as $key=>$row)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$row['year_name']}}</td>    
                  <td>
                  @if($row['active']==1)
                  <label class="switch" ><input class="switch-input " type="checkbox"  checked disabled/><span class="switch-label" data-on="เปิดการใช้งาน" data-off="ปิดการใช้งาน"></span><span class="switch-handle"></span></label>
                  @else
                  <label class="switch" ><input class="switch-input aaa" type="checkbox"  id="{{$row->year_id}}" /><span class="switch-label" data-on="ปิดการใช้งาน" data-off="ปิดการใช้งาน"></span><span class="switch-handle"></span></label>
                  @endif
                  </td>        
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
                <h4 class="modal-title">เพิ่มปีการศึกษา</h4>
              </div>
              <form id="adddata2" method="POST" action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data" >
              @csrf
              <div class="modal-body">
            <div class="form-group">
                  <label for="exampleInputEmail1">ปีการศึกษา</label>
                  <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                  type = "number"
                  maxlength = "4" class="form-control" id="year" name="year" placeholder="ปีการศึกษา">
                </div>

                <div class="row">
              <div class="col-md-6">
              <div class="form-group">
                  <label for="exampleInputEmail1">วัน/เดือน/ปี</label>
                  <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right " id="datepicker3" name="date3">
                </div>
                  <!-- <input type ="date"  class="form-control" id="date3" name="date3" placeholder="ปีการศึกษา"> -->
                </div>
             </div>
             <div class="col-md-6">
              <div class="form-group">
                  <label for="exampleInputEmail1">ถึง วัน/เดือน/ปี</label>
                  <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right " id="datepicker4" name="date4">
                </div>
                  <!-- <input type ="date"  class="form-control" id="date4" name="date4" placeholder="ปีการศึกษา">  -->
                </div>
             </div>
              </div>
            </div>
            
           
              <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">ปิด</button>
                <button type="submit" class="btn btn-info">บันทึกข้อมูล</button>
              </div>
              
              <input type="hidden" class="form-control" name="id" id="emp_id" >
              </form>
            </div>
            
            <!-- /.modal-content -->
          </div>
          </div>
          <!-- /.modal-dialog -->
        </div>

        <div class="modal  fade" id="modal-info2">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">เพิ่มปีการศึกษา</h4>
              </div>
              <form id="adddata1" method="POST" action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data" >
              @csrf
              <div class="modal-body">
              <div class="row">
              <div class="col-md-6">
              <div class="form-group">
                  <label for="exampleInputEmail1">วัน/เดือน/ปี</label>
                  <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right " id="datepicker" name="date1">
                </div>
                  <!-- <input type ="date"  class="form-control" id="date1" name="date1" placeholder="ปีการศึกษา"> -->
                </div>
             </div>
             <div class="col-md-6">
              <div class="form-group">
                  <label for="exampleInputEmail1">ถึง วัน/เดือน/ปี</label>
                  <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right " id="datepicker2" name="date2">
                </div>
                  <!-- <input type ="date"  class="form-control" id="date2" name="date2" placeholder="ปีการศึกษา">  -->
                </div>
             </div>
              </div>

              
            </div>
           
        
           
              <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">ปิด</button>
                <button type="submit" class="btn btn-info">บันทึกข้อมูล</button>
              </div>
              
              <input type="hidden" class="form-control" name="id" id="emp_id" >
              </form>
            </div>
            
            <!-- /.modal-content -->
          </div>
          </div>
          <!-- /.modal-dialog -->
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
.switch {
	position: relative;
	display: block;
	vertical-align: top;
	width: 100px;
	height: 30px;
	padding: 3px;
	margin: 0 10px 10px 0;
	background: linear-gradient(to bottom, #eeeeee, #FFFFFF 25px);
	background-image: -webkit-linear-gradient(top, #eeeeee, #FFFFFF 25px);
	border-radius: 18px;
	box-shadow: inset 0 -1px white, inset 0 1px 1px rgba(0, 0, 0, 0.05);
	cursor: pointer;
	box-sizing:content-box;
}
.switch-input {
	position: absolute;
	top: 0;
	left: 0;
	opacity: 0;
	box-sizing:content-box;
}
.switch-label {
	position: relative;
	display: block;
	height: inherit;
	font-size: 10px;
	text-transform: uppercase;
	background: #eceeef;
	border-radius: inherit;
	box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.12), inset 0 0 2px rgba(0, 0, 0, 0.15);
	box-sizing:content-box;
}
.switch-label:before, .switch-label:after {
	position: absolute;
	top: 50%;
	margin-top: -.5em;
	line-height: 1;
	-webkit-transition: inherit;
	-moz-transition: inherit;
	-o-transition: inherit;
	transition: inherit;
	box-sizing:content-box;
}
.switch-label:before {
	content: attr(data-off);
	right: 11px;
	color: #aaaaaa;
	text-shadow: 0 1px rgba(255, 255, 255, 0.5);
}
.switch-label:after {
	content: attr(data-on);
	left: 11px;
	color: #FFFFFF;
	text-shadow: 0 1px rgba(0, 0, 0, 0.2);
	opacity: 0;
}
.switch-input:checked ~ .switch-label {
	background: #009578;
	box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.15), inset 0 0 3px rgba(0, 0, 0, 0.2);
}
.switch-input:checked ~ .switch-label:before {
	opacity: 0;
}
.switch-input:checked ~ .switch-label:after {
	opacity: 1;
}
.switch-handle {
	position: absolute;
	top: 4px;
	left: 4px;
	width: 28px;
	height: 28px;
	background: linear-gradient(to bottom, #FFFFFF 40%, #f0f0f0);
	background-image: -webkit-linear-gradient(top, #FFFFFF 40%, #f0f0f0);
	border-radius: 100%;
	box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.2);
}
.switch-handle:before {
	content: "";
	position: absolute;
	top: 50%;
	left: 50%;
	margin: -6px 0 0 -6px;
	width: 12px;
	height: 12px;
	background: linear-gradient(to bottom, #eeeeee, #FFFFFF);
	background-image: -webkit-linear-gradient(top, #eeeeee, #FFFFFF);
	border-radius: 6px;
	box-shadow: inset 0 1px rgba(0, 0, 0, 0.02);
}
.switch-input:checked ~ .switch-handle {
	left: 74px;
	box-shadow: -1px 1px 5px rgba(0, 0, 0, 0.2);
}
 
/* Transition
========================== */
.switch-label, .switch-handle {
	transition: All 0.3s ease;
	-webkit-transition: All 0.3s ease;
	-moz-transition: All 0.3s ease;
	-o-transition: All 0.3s ease;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" >
  $(function () {
    var currentTime = new Date()
    var year = currentTime.getFullYear()
    $.fn.datepicker.defaults.language = 'th';
    $.fn.datepicker.defaults.format = 'yyyy/mm/dd';
    if(year<2500){
      year=year+543;
    }
    $('#datepicker').datepicker({
    defaultViewDate: {year: year},
    autoclose: true,
  })
  $('#datepicker2').datepicker({
    defaultViewDate: {year: year},
    autoclose: true,
  })
  $('#datepicker3').datepicker({
    defaultViewDate: {year: year},
    autoclose: true,
  })
  $('#datepicker4').datepicker({
    defaultViewDate: {year: year},
    autoclose: true,
  })
   //as you defined in bootstrap-datepicker.XX.js
});
</script>
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



    $('#adddata2').submit(function(e) {
      e.preventDefault();
      for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
        }
      var formData = new FormData(this);
      var course_name = document.getElementById("year").value;
      var date1 = document.getElementById("datepicker3").value;
      var date2 = document.getElementById("datepicker4").value;

       if(course_name==""||date1==""||date2==""){
        swal({
          title: "กรุณาป้อนข้อมูลให้ครบ",
          text: "",
          icon: "warning",
          showConfirmButton: false,
        });
      }
      else{
      swal({
      title: "ยืนยันการบันทึก?",
      icon: "warning",
      buttons: true,
      successMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
        type: 'POST',
        url: "/backyear",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: (data) => {
          if(data){
            swal({
          title: "บันทึกข้อมูลเรียบร้อย",
          text: "",
          icon: "success",
          button: "ตกลง",
        }).then(function() {
          window.location = "/";
        });
          }
        },
        error: function(data) {
         
          
          console.log(data.responseJSON.errors);
        }
      });
      } else {
        
      }
    });
  }
    });

    $('#adddata1').submit(function(e) {
      e.preventDefault();
      for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
        }
      var formData = new FormData(this);
      var date1 = document.getElementById("datepicker").value;
      var date2 = document.getElementById("datepicker2").value;

       if(date1==""||date2==""){
        swal({
          title: "กรุณาป้อนข้อมูลให้ครบ",
          text: "",
          icon: "warning",
          showConfirmButton: false,
        });
      }
      else{
      swal({
      title: "ยืนยันการบันทึก?",
      icon: "warning",
      buttons: true,
      successMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
        type: 'POST',
        url: "/nextyear",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: (data) => {
          if(data){
            swal({
          title: "บันทึกข้อมูลเรียบร้อย",
          text: "",
          icon: "success",
          button: "ตกลง",
        }).then(function() {
          window.location = "/";
        });
          }
        },
        error: function(data) {
         
          
          console.log(data.responseJSON.errors);
        }
      });
      } else {
        
      }
    });
  }
    });
    $("#next").click(function(e){
      var token = $('meta[name="csrf-token"]').attr('content');
        e.preventDefault();
        

        swal({
      title: "ยืนยันการบันทึก?",
      icon: "warning",
      buttons: true,
      successMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
           type:'post',
           url:'/nextyear',
           data: {
          _token : token 
        },
           success:function(data){
            swal({
              title: "บันทึกข้อมูลเรียบร้อย",
            text: "",
            icon: "success",
            button: "ตกลง",
           }).then(function() {
              window.location = "/";
           });
           }
        });
      } else {
        
      }
    });
	});
  

  $('.aaa').click(function(e){
    var token = $('meta[name="csrf-token"]').attr('content');
    var id = $(this).attr('id');
        e.preventDefault();
        console.log(id);
        swal({
      title: "ยืนยันการบันทึก?",
      icon: "warning",
      buttons: true,
      successMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
           type:'PUT',
           url:'/backyear2',
           data: {
          _token : token,
          id:id 
        },
           success:function(data){
            swal({
              title: "บันทึกข้อมูลเรียบร้อย",
            text: "",
            icon: "success",
            button: "ตกลง",
           }).then(function() {
              window.location = "/";
           });
           }
        });
      } else {
        
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