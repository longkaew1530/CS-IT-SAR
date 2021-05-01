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
                  <th width="10%">รหัสหลักสูตร</th>
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
                  <td>{{$row['course_code']}}</td>       
                  <td class="text-center"><button class="btn btn-warning" type="button"   data-toggle="modal" data-target="#modal-edit" data-id="{{$row['course_id']}}"><i class='fa fas fa-edit'></i></button></td>
                  <td class="text-center">
                                      <form id="delete-form" method="POST" action="/deletecourse/{{$row['course_id']}}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                      <button type="submit" class="btn btn-danger"><i class='fa fa-trash'></i></button></form>
                  </td>
                </tr>
                <div class="modal  fade" id="modal-info">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">เพิ่มข้อมูลหลักสูตร</h4>
              </div>
              <form id="adddata" method="POST" action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data" >
              @csrf
              <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
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
                  <label for="exampleInputPassword1">หลักสูตรปรับปรุง</label>
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
            <div class="col-md-6 ">
            <label>มคอ.2</label>
                  <div id="dynamic_field">
                        <div class="row">
                            <div class="col-md-10">
                            <input type="text" id="name" name="name[]" placeholder="ชื่อ-สกุล" class="form-control" />
                            </div>
                            <div class="col-md-1">
                            <button type="button" name="add" id="add" class="btn btn-success "><i class="fa fa-plus"></i></button>
                            </div>
                  
                        </div>
                        <br><div class="row">
                                  <div class="col-md-10">
                                  <textarea type="text" id="background" name="background[]" placeholder="วุฒิการศึกษา" class="form-control" ></textarea>
                                  </div>               
                            </div>
                  </div>
                  
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
          </form>
          <!-- /.modal-dialog -->
        </div>

        <div class="modal  fade" id="modal-edit">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">แก้ไขข้อมูลหลักสูตร</h4>
              </div>
              <form  method="POST" action="/updatecourse">
              @csrf
              {{ method_field('PUT') }}
              <div class="box-body">
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
                  <label for="exampleInputPassword1">หลักสูตรปรับปรุง</label>
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
              </form>
              <input type="hidden" class="form-control" name="id" id="emp_id" >
              
            </div>
            
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
            </div>

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
<script>
  $(function () {
    $('#example3').DataTable({
      lengthMenu: [ 8, 20, 50, 100]
    })
  })
</script>

<script>
$(document).ready(function() {

  
$('#modal-edit').on('show.bs.modal', function (event) {
var button = $(event.relatedTarget);
var id= button.data('id');
var modal = $(this);
modal.find('#emp_id').val(id);
var url = "/getcourse";
        $.get(url + '/' + id, function (data) {
            //success data
            console.log(data)
            $("#courseid").val(data[0].course_id);
            $("#coursename").val(data[0].course_name);
            $("#facultyid").val(data[0].faculty_id);
            $("#coursecode").val(data[0].course_code);
            $("#updatecourse").val(data[0].update_course);
            $("#place1").val(data[0].place);
            $("#initials1").val(data[0].initials);
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


      $('#add').click(function(){  
           i++;  
           $('#dynamic_field').append('<br><div id="row'+i+'" class="row"><div class="col-md-10"><input type="text" id="name" name="name'+i+'" placeholder="ชื่อ-สกุล" class="form-control" /></div><div class="col-md-1"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></div></div><br><div id="row2'+i+'"  class="row"><div class="col-md-10"><textarea type="text" id="background" name="background'+i+'" placeholder="วุฒิการศึกษา" class="form-control" ></textarea></div></div>');  
      });  


      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
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
    $('#updatedata').submit(function(e) {
      e.preventDefault();
      var formData = new FormData(this);
      var owner = document.getElementById("owner1").value;
      var research_results_year = document.getElementById("research_results_year1").value;
      var research_results_name = document.getElementById("research_results_name1").value;
      var research_results_description = document.getElementById("research_results_description1").value;
      var research_results_salary = document.getElementById("research_results_salary1").value;
      var teacher_name = $('#select').val();
      var checkdup="aaaaa";
            for (index = 0; index < teacher_name.length; ++index) {
              if(teacher_name[index]==owner){
                checkdup="";
              }
            }
      var gettname="";
            for (index = 0; index < teacher_name.length; ++index) {
              if(teacher_name[index]!=""){
                gettname="aaaa";
             }
            }
      if(checkdup==""){
         swal({
          title: "ชื่อผู้วิจัยไม่สามารถซ้ำกับชื่อผู้ร่วมวิจัยได้",
          text: "",
          icon: "warning",
          showConfirmButton: false,
        });
      }
      else if(gettname==""||owner==""||research_results_year==""||research_results_name==""||research_results_description==""||research_results_salary==""){
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
        url: "/updateresearch_results",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: (data) => {
          if(data){
            swal({
          title: "แก้ไขข้อมูลเรียบร้อย",
          text: "",
          icon: "success",
          button: "ตกลง",
        }).then(function() {
          window.location = "/research_results";
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