@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl ">
            <div class="box-header">
              <h2 class="box-title">หลักสูตร</h2>
            </div>
            <button  class="btn btn-success ml-1" type="button"   data-toggle="modal" data-target="#modal-info"><i class="fa fa-plus"></i> เพิ่มข้อมูล</button>
            <!-- /.box-header -->
            <div class="box-body">
            <!-- /.box-header -->
            <table id="example3" class="table table-bordered table-striped ">
                <thead>
                <tr>
                  <th width="5%">ที่</th>
                  <th width="30%">หลักสูตร</th>
                  <th width="30%">คณะ</th>
                  <th width="20%">เพิ่มรายชื่ออาจารย์ตามตาราง มคอ.2</th>
                  <th width="5%" >แก้ไข</th>
                  <th width="5%">ลบ</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($course as $key=>$row)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$row['course_name']}}</td>  
                  <td>{{$row['faculty_name']}}</td>
                  <?php $data2=$getcoursedetail->where('course_id',$row['course_id']); ?>
                  <td> @if($data2=="[]")<button  class="btn btn-success ml-1" type="button"   data-toggle="modal" data-target="#modal-info2" data-id="{{$row['course_id']}}"><i class="fa fa-plus" ></i> เพิ่มรายชื่ออาจารย์ตามตารางมคอ.2</button>
                  @else
                  <button class="btn btn-warning" type="button"   data-toggle="modal" data-target="#modal-info3" data-id="{{$row['course_id']}}"><i class='fa fas fa-edit'></i> แก้ไขรายชื่ออาจารย์ตามตารางมคอ.2</button>
                  @endif
                  </td>       
                  <td class="text-center"><button class="btn btn-warning" type="button"   data-toggle="modal" data-target="#modal-edit" data-id="{{$row['course_id']}}"><i class='fa fas fa-edit'></i></button></td>
                  <td class="text-center"><button id="{{$row['course_id']}}" class="btn btn-danger delete" type="button" name="remove" ><i class="fa fa-trash"></i></button>
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
                <h4 class="modal-title">เพิ่มข้อมูลหลักสูตร</h4>
              </div>
              <form id="adddata" method="POST" action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data" >
              @csrf
              <div class="modal-body">
            <div class="form-group">
                  <label for="exampleInputEmail1">หลักสูตร</label>
                  <input type="text" class="form-control" id="course_name" name="course_name" placeholder="หลักสูตร">
                </div>
                <div class="form-group">
                <label for="exampleInputPassword1">คณะ</label>
                                  <select class="form-control"  id="faculty_id"  class="form-control @error('role') is-invalid @enderror" name="faculty_id">
                                    @foreach($faculty as $value)
                                    <option value="{{$value['faculty_id']}}">{{$value['faculty_name']}}</option>
                                    @endforeach
                                  </select>
                                  </div>
                                  <div class="form-group">
                  <label for="exampleInputPassword1">รหัสหลักสูตร</label>
                  <input type="text" class="form-control" id="course_code" name="course_code" placeholder="รหัสหลักสูตร">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">ปีที่ปรับปรุงหลักสูตร</label>
                  <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                  type = "number"
                  maxlength = "4" class="form-control" id="update_course" name="update_course" placeholder="หลักสูตรปรับปรุง">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">สถานที่</label>
                  <input type="text" class="form-control" id="place" name="place" placeholder="สถานที่">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">ชื่อย่อ</label>
                  <input type="text" class="form-control" id="initials" name="initials" placeholder="ชื่อย่อ">
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
                <h4 class="modal-title">เพิ่มข้อมูลหลักสูตร</h4>
              </div>
              <form id="adddata2" method="POST" action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data" >
              @csrf
              <div class="modal-body">
            <label>เพิ่มรายชื่ออาจารย์ตามตาราง มคอ.2</label>
            <input type="hidden" class="form-control" id="courseid2" name="course_id" >
            <div class="table-responsive">  
                <table class="table table-bordered" id="dynamic_field">  
                    <tr><td width="100%"><input type="text" id="name" name="name[]" placeholder="ชื่อ-สกุล" class="form-control name_list" /></td></tr>
                    <tr>  
                        <td><textarea type="text" id="background"   name="background[]" placeholder="วุฒิการศึกษา" class="form-control name_list"></textarea></td>    
                        <td><button type="button" name="add" id="add" class="btn btn-success"><i class="fa fa-plus"></i></button></td>  
                    </tr>  
                </table>  
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
        <div class="modal  fade" id="modal-info3">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">แก้ไขรายชื่ออาจารย์ตามตาราง มคอ.2</h4>
              </div>
              <form id="update" method="POST" action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data" >
              @csrf
              <div class="modal-body">
              <label>แก้ไขรายชื่ออาจารย์ตามตาราง มคอ.2</label>
              <div class="table-responsive">  
                <table class="table table-bordered" id="dynamic_field2">
                        <div id="get"></div>
                </table>
            </div>
            <label>เพิ่มรายชื่ออาจารย์ตามตาราง มคอ.2</label>
            <input type="hidden" class="form-control" id="courseid3" name="course_id">
            <div class="table-responsive">  
                <table class="table table-bordered" id="dynamic_field3">  
                    <tr><td width="100%"><input type="text" id="name" name="name[]" placeholder="ชื่อ-สกุล" class="form-control name_list" /></td></tr>
                    <tr>  
                        <td><textarea type="text" id="background"   name="background[]" placeholder="วุฒิการศึกษา" class="form-control name_list"></textarea></td>    
                        <td><button type="button" name="add2" id="add2" class="btn btn-success"><i class="fa fa-plus"></i></button></td>  
                    </tr>  
                </table>  
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
        <div class="modal  fade" id="modal-edit">
          <div class="modal-dialog ">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">แก้ไขข้อมูลหลักสูตร</h4>
              </div>
              <form  method="POST" action="/updatecourse">
              @csrf
              {{ method_field('PUT') }}
              <div class="modal-body">

            <div class="form-group">
              <input type="hidden" class="form-control" id="courseid" name="course_id" >
                  <label for="exampleInputEmail1">หลักสูตร</label>
                  <input type="text" class="form-control" id="coursename" name="course_name" placeholder="หลักสูตร">
                </div>
                <div class="form-group">
                <label for="exampleInputPassword1">คณะ</label>
                                  <select class="form-control"  id="facultyid"  class="form-control @error('role') is-invalid @enderror" name="faculty_id">
                                    @foreach($faculty as $value)
                                    <option value="{{$value['faculty_id']}}">{{$value['faculty_name']}}</option>
                                    @endforeach
                                  </select>
                                  </div>
                                  <div class="form-group">
                  <label for="exampleInputPassword1">รหัสหลักสูตร</label>
                  <input type="text" class="form-control" id="coursecode" name="course_code" placeholder="รหัสหลักสูตร">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">ปีที่ปรับปรุงหลักสูตร</label>
                  <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                  type = "number"
                  maxlength = "4" class="form-control" id="updatecourse" name="update_course" placeholder="หลักสูตรปรับปรุง">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">สถานที่</label>
                  <input type="text" class="form-control" id="place1" name="place" placeholder="สถานที่">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">ชื่อย่อ</label>
                  <input type="text" class="form-control" id="initials1" name="initials" placeholder="ชื่อย่อ">
                </div>
            </div>
 
    
              
                
                
               
                
                
              
            
              <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">ปิด</button>
                <button type="submit" class="btn btn-info">บันทึกข้อมูล</button>
              </div>
              
              <input type="hidden" class="form-control" name="id" id="emp_id" >
              
            </div>
            
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
            </div>
            </form>
               
                
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
  width:80%;
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
.fr{
  float:right;
}
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script >
  $(function () {
    $('#example3').DataTable({
      lengthMenu: [ 8, 20, 50, 100]
    })
  });
  $(function () {
 
 CKEDITOR.replace('editor',{
   enterMode : Number(2),
   toolbar: [],
   width : '100%',
   height:'10%',
 })  
});
$(function () {
 
 
});
</script>

<script>

  
$(document).ready(function() {

  
$('#modal-edit').on('show.bs.modal', function (event) {
var button = $(event.relatedTarget);
var id= button.data('id');
var modal = $(this);
modal.find('#emp_id').val(id);
var url = "/getcourse";
var url2 = "/getcoursedetail";
        $.get(url + '/' + id, function (data) {
            //success data
            $("#courseid").val(data[0].course_id);
            $("#coursename").val(data[0].course_name);
            $("#facultyid").val(data[0].faculty_id);
            $("#coursecode").val(data[0].course_code);
            $("#updatecourse").val(data[0].update_course);
            $("#place1").val(data[0].place);
            $("#initials1").val(data[0].initials);
            $('#job-summ-panel').html(data[0].initials)
        }) 
        $.get(url2 + '/' + id, function (data2) {
            //success data
            
            jQuery('#dynamic_field2').show();
            jQuery('#dynamic_field2').html(data2.success);
            console.log(data2[0].id);
        })
});
$('#modal-info3').on('show.bs.modal', function (event) {
var button = $(event.relatedTarget);
var id= button.data('id');
var modal = $(this);
modal.find('#emp_id').val(id);
var url = "/getcourse";
var url2 = "/getcoursedetail"; 
$.get(url + '/' + id, function (data) {
            //success data
            $("#courseid3").val(data[0].course_id);
            console.log(data[0].course_id);
        }) 
        $.get(url2 + '/' + id, function (data2) {
            //success data
            jQuery('#dynamic_field2').show();
            jQuery('#dynamic_field2').html(data2.success);
           
        })
});
$('#modal-info2').on('show.bs.modal', function (event) {
var button = $(event.relatedTarget);
var id= button.data('id');
var modal = $(this);
modal.find('#emp_id').val(id);
var url = "/getcourse";
var url2 = "/getcoursedetail";
        $.get(url + '/' + id, function (data) {
            //success data
      
            $("#courseid2").val(data[0].course_id);

        }) 
});
});
</script>
<script>
  $(document).ready(function() {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    var postURL = "<?php echo url('addmore'); ?>";
      var i=0;  
      var x=10;  

      $('#add').click(function(){  
           i++;  

           $('#dynamic_field').append('<tr id="row2'+i+'"><td width="100%"><input type="text" id="name" name="name[]" placeholder="ชื่อ-สกุล" class="form-control name_list" /></td></tr><tr id="row'+i+'" class="dynamic-added"><td><textarea type="text"  id="editor" name="background[]" placeholder="วุฒิการศึกษา" class="form-control name_list"></textarea></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
      });  
      $('#add2').click(function(){  
           x++;  
           $('#dynamic_field3').append('<tr id="row2'+x+'"><td width="100%"><input type="text" id="name" name="name[]" placeholder="ชื่อ-สกุล" class="form-control name_list" /></td></tr><tr id="row'+x+'" class="dynamic-added"><td><textarea type="text"  id="editor" name="background[]" placeholder="วุฒิการศึกษา" class="form-control name_list"></textarea></td><td><button type="button" name="remove" id="'+x+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
      });

      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove(); 
           $('#row2'+button_id+'').remove();   
      });
      $(document).on('click', '.btn_remove2', function(){  
           var button_id = $(this).attr("id"); 
           var background = $('#background1').val();
           var name = $('#name1').val();
           console.log(name);
          //  const index = background.indexOf(button_id);
          //  const index2 = name.indexOf(button_id);
          //  var index = array.indexOf(button_id);
          // if (index !== -1) {
          //   array.splice(index, 1);
          // }
            
          //     name.splice(button_id, 1);
          //   } 
           $('#row'+button_id+'').remove(); 
           $('#row2'+button_id+'').remove();   
      });
    $('#adddata').submit(function(e) {
      e.preventDefault();
      for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
        }
      var formData = new FormData(this);
      var course_name = document.getElementById("course_name").value;
      var faculty_id = document.getElementById("faculty_id").value;
      var course_code = document.getElementById("course_code").value;
      var update_course = document.getElementById("update_course").value;
      var place = document.getElementById("place").value;
      var initials = document.getElementById("initials").value;
      var teacher_name = $('#name').val();
      

      var gettname="";
            for (index = 0; index < teacher_name.length; ++index) {
              if(teacher_name[index]!=""){
                gettname="aaaa";
             }
            }
            

       if(course_name==""||faculty_id==""||course_code==""||update_course==""||place==""||initials==""){
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
        url: "/addcourse",
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
          window.location = "/course";
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
    $('#adddata2').submit(function(e) {
      e.preventDefault();
      for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
        }
      var formData = new FormData(this);

      var teacher_name = $('#name').val();
      var teacher_name2 = $('#background').val();
      console.log(teacher_name2);
      var gettname="";
            for (index = 0; index < teacher_name.length; ++index) {
              if(teacher_name[index]!=""){
                gettname="aaaa";
             }
            }
      var gettname2="";
            for (index = 0; index < teacher_name2.length; ++index) {
              if(teacher_name2[index]!=""){
                gettname2="aaaa";
             }
            }      

       if(gettname==""||gettname2==""){
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
        url: "/addcoursetname",
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
          window.location = "/course";
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
    $('#update').submit(function(e) {
      e.preventDefault();
      for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
        }
      var formData = new FormData(this);

   

 
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
        url: "/updatecoursetname",
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
          window.location = "/course";
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

    });
    $('.delete').click(function(e) {
      var id = $(this).attr('id');
      swal({
      title: "ยืนยันการลบข้อมูล?",
      icon: "warning",
      buttons: true,
      successMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
        type: 'delete',
        url: "/deletecourse/"+id,
        data: {id:id},
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: (data) => {
          console.log(data);

            swal({
          title: "ลบข้อมูลเรียบร้อย",
          text: "",
          icon: "success",
          button: "ตกลง",
        }).then(function() {
          location.reload();
        });
          
        },
        error: function(data) {
          swal({
          title: "ไม่สามารถลบข้อมูลได้เนื่องจากข้อมูลสัมพันธ์กัน",
          text: "",
          icon: "error",
          showConfirmButton: false,
          });
          
        }
      });
      } else {
        
      }
    });
    });

    $('#modal-edit').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget);
      var id = button.data('id');
      var modal = $(this);
      var studentSelect = $('#select');
      modal.find('#emp_id').val(id);
      var url = "/getresearch_results";
      $.get(url + '/' + id, function(data) {
        //success data
        $("#id").val(data[0].research_results_id);
        $("#owner1").val(data[0].owner);
        var get=[];
        for (index = 0; index < data.length; ++index) {
                if(data[index].user_id!=data[0].owner){
                  get[index]=data[index].user_id;
                } 
        }
        $("#select").val(get);
        $("#research_results_year1").val(data[0].research_results_year);
        $("#research_results_year1").val(data[0].research_results_year);
        $("#research_results_category1").val(data[0].research_results_category);
        $("#research_results_name1").val(data[0].research_results_name);
        $("#research_results_description1").val(data[0].research_results_description);
        $("#research_results_salary1").val(data[0].research_results_salary);
        

        

        $('#select').select2({
        // ...
        templateSelection: function (data, container) {
          // Add custom attributes to the <option> tag for the selected option
          $(data.id).attr('data-custom-attribute', data.customValue);
          return data.text;
        }
      });

      // Retrieve custom attribute value of the first selected element
      // $('#mySelect2').find(':selected').data('custom-attribute');
      //   for (const [key, value] of Object.entries(data)) {
      //       var option = new Option(value.user_fullname, value.id,true, true);
      //   studentSelect.append(option).trigger('change');
      //   studentSelect.trigger({
      //       type: 'select2:select',
      //       params: {
      //           data: data
      //       }
      //   });
      //   }
        
        
      })
    });
  });
</script>
@endsection