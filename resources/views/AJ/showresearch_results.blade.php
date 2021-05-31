@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
  <div class="box-header">
    <div class="box-body">
      <div class="col-sm-2" align="right"></div>
      <div class="col-sm-8" align="center">
        <h3><i class=""></i>เพิ่มข้อมูลผลงานวิจัย</h3>
        <hr>
      </div>
    </div>
    <form id="adddata" method="POST" action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data">
    @csrf
    <div class="row">
            <div class="col">
            <div class="data">
        <div class="col-md-12">
          <div id="body">
            <div class="col-md-12 col-sm-9 col-xs-12">
            <div class="form-group">
                    <label for="exampleInputPassword1">ชื่อผลงานวิจัย</label>
                    <input type="text" class="form-control" id="research_results_name" name="research_results_name" placeholder="ชื่อผลงานวิจัย">
                  </div>
            </div>
          </div>
        </div>
      </div>
            </div>
            <div class="col">
            <div class="data">
        <div class="col-md-12">
          <div id="body">
            <div class="col-md-12 col-sm-9 col-xs-12">
            <div class="form-group">
                    <label for="exampleInputPassword1">ชื่อผู้วิจัย</label>
                    <input type="hidden" id="owner" name="owner"  value="{{ Auth::user()->id }}" >
                    <input type="text" class="form-control"  value="{{ Auth::user()->user_fullname }}" disabled>
                  </div>
            </div>
          </div>
        </div>
      </div>
      </div>
    </div>
    <div class="row">
            <div class="col">
            <div class="data">
        <div class="col-md-12">
          <div id="body">
            <div class="col-md-12 col-sm-9 col-xs-12">
            <div class="form-group">
            <!-- <a data-target="#modal-edit" data-toggle="modal" class="MainNavText" id="MainNavHelp" 
       href="#modal-edit"><i class='fa fa-plus'></i> เพิ่มผู้ร่วมวิจัยหลักสูตรอื่น</a> -->
                <label>ชื่อผู้ร่วมวิจัย</label>  
       &nbsp;&nbsp;<a data-target="#modal-info" data-toggle="modal" class="MainNavText" id="MainNavHelp" 
       href="#modal-info"><i class='fa fa-plus'></i> เพิ่มผู้ใช้งาน</a>
                <select class="form-control" id="teacher_name" name="teacher_name[]" multiple="multiple" 
                        style="width: 100%;">
                        @foreach($userall as $value)
                      <option value="{{$value['id']}}">{{$value['user_fullname']}}</option>
                        @endforeach
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
            </div>
            <div class="col">
            <div class="data">
        <div class="col-md-12">
          <div id="body">
            <div class="col-md-6 col-sm-9 col-xs-12">
            
            <div class="form-group">    
                    <label for="exampleInputPassword1">วัน/เดือน/ปี ที่ทำสัญญา</label>
                    <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right " id="datepicker" name="research_results_date">
                </div>
                    <!-- <input type="date" class="form-control" id="research_results_date" name="research_results_date" placeholder="งบประมาณ"> -->
                  </div>
            </div>
            <div class="col-md-6 col-sm-9 col-xs-12">
            
            <div class="form-group">    
                    <label for="exampleInputPassword1">วัน/เดือน/ปี ที่สิ้นสุดสัญญา</label>
                    <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right " id="datepicker3" name="research_results_date2">
                </div>
                    <!-- <input type="date" class="form-control" id="research_results_date" name="research_results_date" placeholder="งบประมาณ"> -->
                  </div>
            </div>
          </div>
        </div>
      </div>
      </div>
    </div>
    <div class="row">
            <div class="col">
            <div class="data">
        <div class="col-md-12">
          <div id="body">
            <div class="col-md-12 col-sm-9 col-xs-12">
            <label for="exampleInputPassword1">แหล่งงบประมาณ</label>
            <div class="form-group">
                    <input type="radio" id="source_salary" name="source_salary" value="ภายใน"  checked/>
                    <label for="exampleInputPassword1">ภายใน</label>
                    <input type="radio" id="source_salary" name="source_salary" value="ภายนอก" />
                    <label for="exampleInputPassword1">ภายนอก</label>
                  </div>
            </div>
          </div>
        </div>
      </div>
            </div>
            <div class="col">
            <div class="data">
        <div class="col-md-12">
          <div id="body">
            <div class="col-md-12 col-sm-9 col-xs-12">
            <div class="form-group">
                    <label for="exampleInputPassword1">หน่วยงานที่ให้ทุน</label>
                    <input type="text" class="form-control" id="research_results_source_salary" name="research_results_source_salary" placeholder="หน่วยงานที่ให้ทุน">
                  </div>
            </div>
          </div>
        </div>
      </div>
      </div>
    </div>
    <div class="row">
            <div class="col">
            <div class="data">
        <div class="col-md-12">
          <div id="body">
            <div class="col-md-12 col-sm-9 col-xs-12">
            <div class="form-group">
              
                    <label for="exampleInputPassword1">งบประมาณ</label>
                    <input type="number" class="form-control" id="research_results_salary" name="research_results_salary" placeholder="งบประมาณ">
                  </div>
            </div>
          </div>
        </div>
      </div>
            </div>
            <div class="col">
            <div class="data">
        <div class="col-md-12">
          <div id="body">
            <div class="col-md-12 col-sm-9 col-xs-12">
            
            </div>
          </div>
        </div>
      </div>
      </div>
    </div>
   
      <div class="col-md-12">
        <div id="body">
          <div class="col-md-12 col-sm-9 col-xs-12">
            <hr>
            <button type="submit" class="btn btn-info pull-right">บันทึกข้อมูล</button>
            </textarea>
          </div>
        </div>
      </div>
    </form>
    <div class="modal  fade " id="modal-info">
          <div class="modal-dialog ">
            <div class="modal-content">
              <div class="modal-header">
             
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">เพิ่มข้อมูลผู้ร่วมวิจัย</h4>
              </div>
              <form  id="adddata2" method="POST" action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data">
              @csrf
              <div class="modal-body">
                <div class="form-group">
                <input type="hidden" class="form-control" id="username" name="username" placeholder="username" readonly>
                  <label for="exampleInputPassword1">ชื่อ-สกุล</label>
                  <input type="text" class="form-control" id="user_fullname" name="user_fullname" placeholder="ชื่อ-สกุล">
                </div>
            <div class="form-group">
                <label for="exampleInputPassword1">คณะ</label>
                                  <select class="form-control"  id="user_faculty"  class="form-control @error('role') is-invalid @enderror" name="user_faculty">
                                    @foreach($faculty as $value)
                                    <option value="{{$value['faculty_id']}}">{{$value['faculty_name']}}</option>
                                    @endforeach
                                  </select>
                                  </div>
                <div class="form-group">
                <label for="exampleInputPassword1">หลักสูตร</label>
                                  <select class="form-control"  id="user_course" onchange="myFunction()"  class="form-control @error('role') is-invalid @enderror" name="user_course">
                                    @foreach($course as $value)
                                    <option value="{{$value['course_id']}}">{{$value['course_name']}}</option>
                                    @endforeach
                                  </select>
                                  </div>
                                  <div class="form-group">
                <label for="exampleInputPassword1">สาขา</label>
                                  <select class="form-control"  id="branch"  class="form-control @error('role') is-invalid @enderror" name="branch">
                                    @foreach($branch as $value)
                                    <option value="{{$value['branch_id']}}">{{$value['name']}}</option>
                                    @endforeach
                                  </select>
                                  </div>

      

              <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">ปิด</button>
                <button type="submit"  class="btn btn-info ">บันทึกข้อมูล</button>
              </div>
              </form>
              <input type="hidden" class="form-control " name="id" id="emp_id" >        
            </div>   
          </div>
          </div>
          <!-- /.modal-dialog -->
        </div>
        <div class="modal  fade" id="modal-edit">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">เพิ่มอาจารย์ประจำหลักสูตร</h4>
              </div>
              <div class="box-body">
              <table id="example11" class="table table-bordered table-striped" name="table">
                <thead>
                <tr>
                  <th width="30px">ที่</th>
                  <th >ชื่อ-สกุล</th>
                  <th width="30px">เลือก</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($tc as $key=>$row)
                <tr>
                <td>{{$key+1}}</td>
                  <td>{{$row['user_fullname']}}</td>
                  <td>
                  <div class="form-check text-center">
                  <input class="form-check-input messageCheckbox" value="{{$row['id']}}" name="idall[]" type="checkbox" id="flexCheckChecked" >
                </div>
                  </td>
                </tr>
                @endforeach
                </tbody></table>
           
              </div>
             
              <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">ปิด</button>
                <button type="button" class="btn btn-info" onclick="selectname()">เลือก</button>
              </div>
              </form>
              <input type="hidden" class="form-control" name="id" id="emp_id" >
              
            </div>
            
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
  </div>
</div>
</div>
<style>
  hr {
    display: block;
    height: 1px;
    border: 0;
    border-top: 1px solid #ccc;
    margin: 1em 0;
    padding: 0;
  }
  .row {
  display: flex;
}

/* Create two equal columns that sits next to each other */
.col {
  flex: 50%;
  padding: 10px;
  height: 80px; /* Should be removed. Only for demonstration */
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
   //as you defined in bootstrap-datepicker.XX.js
});
</script>
<script>
function myFunction() {
  var token = $('meta[name="csrf-token"]').attr('content');
  var e = document.getElementById("user_course");
  var strUser = e.options[e.selectedIndex].value;
    $.ajax({  //create an ajax request to display.php
          type: "GET",
          url: "/getcourse_username/"+strUser,       
      success: function (data) {
        console.log(data);
        document.getElementById("username").value =data;
          }
          });

}
function selectname() {
   var teacher_name = document.getElementsByName('teacher_name[]');
   var checkedValue = null; 
    var inputElements = document.getElementsByClassName('messageCheckbox');
 
    for(var i=0; inputElements[i]; ++i){
          if(inputElements[i].checked){
              // console.log(inputElements[i].value);
              var rows = document.getElementsByTagName("table")[0].rows;
              var last = rows[i+1];
              var cell = last.cells[1];
              var value = cell.innerHTML
              for (index = 0; index < teacher_name.length; ++index) {
              if(teacher_name[index].value!=inputElements[i].value){
                var newOption = new Option(value, inputElements[i].value, true, true);
                 $('#teacher_name').append(newOption).trigger('change');
              }
              }
              
              // document.getElementById("example11").deleteRow(i+1);
          }
    }
    $('#modal-edit').modal('hide');

}
$(function () {
    $('#example3').DataTable({
      lengthMenu: [ 10, 20, 50, 100]
    });
    $('#example11').DataTable({
      lengthMenu: [ 10, 20, 50, 100]
    });
    
      
  })
</script>
<script type="text/javascript">
  $(document).ready(function(e) {
    
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({  //create an ajax request to display.php
          type: "GET",
          url: "/getcourse_username2",       
      success: function (data) {
        console.log(data);
        document.getElementById("username").value =data;
          }
          });
    $selectElement = $('#teacher_name').select2({
      allowClear: true,
    placeholder: {
        id: "0",
        placeholder: "Select an Title"
    }
  });
    var postURL = "<?php echo url('addmore'); ?>";
      var i=0;  


      $('#add').click(function(){  
           i++;  
           $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input multiple="true" type="file" id="doc_file" name="doc_file[]" class="form-control name_list"></td><td width="60%"><input type="text" id="name" name="name[]" placeholder="ตั้งชื่อไฟล์" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
      });  


      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });  
      $('#adddata').submit(function(e) {
      e.preventDefault();
      var formData = new FormData(this);
      var owner = document.getElementById("owner").value;
      var research_results_year = document.getElementById("datepicker").value;
      var research_results_name = document.getElementById("research_results_name").value;
      var research_results_salary = document.getElementById("research_results_salary").value;
      var teacher_name = $('#teacher_name').val();
      
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
            console.log(research_results_salary);
      if(checkdup==""){
         swal({
          title: "ชื่อผู้วิจัยไม่สามารถซ้ำกับชื่อผู้ร่วมวิจัยได้",
          text: "",
          icon: "warning",
          showConfirmButton: false,
        });
      }
      else if(owner==""||research_results_year==""||research_results_name==""||research_results_salary==""){
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
        url: "/addresearch_results",
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

    $('#adddata2').submit(function(e) {
      e.preventDefault();
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
        url: "/adduser2",
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
          location.reload();
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
  });
</script>
<script>
  $(function () {
    
  })
</script>
@endsection 