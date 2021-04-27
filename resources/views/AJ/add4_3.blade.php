@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
  <div class="box-header">
    <div class="box-body">
      <div class="col-sm-2" align="right"></div>
      <div class="col-sm-8" align="center">
        <h3><i class=""></i>ผลที่เกิดกับอาจารย์ (ตัวบ่งชี้ 4.3)</h3>
        <hr>
      </div>
    </div>
    <form id="adddata" method="POST" action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data">
    @csrf
      
        <div class="col-md-12">
          <div class="box-header col-md-12 col-sm-9 col-xs-12">
            <h3 class="box-title">อัตราการคงอยู่ของอาจารย์</h3>
          </div>
          
            <div class="col-md-12 col-sm-9 col-xs-12">
              <textarea  id="editor5" name="retention_rate1" rows="10" cols="80">
              </textarea>
            </div>
          

        </div>
      
      <div class="data">
        <div class="col-md-12">
          <div class="box-header col-md-12 col-sm-9 col-xs-12">
            <h3 class="box-title">หลักฐานอ้างอิง</h3>
          </div>
          <div id="body">
            <div class="col-md-12 col-sm-9 col-xs-12">
            <div class="table-responsive">  
                <table class="table table-bordered" id="dynamic_field">  
                    <tr>  
                        <td ><input multiple="true" type="file" id="doc_file1" name="doc_file1[]" class="form-control name_list"></td> 
                        <td width="60%"><input type="text" name="name1[]" placeholder="ตั้งชื่อไฟล์" class="form-control name_list" /></td>   
                        <td><button type="button" name="add" id="add" class="btn btn-success"><i class="fa fa-plus"></i></button></td>  
                    </tr>  
                </table>  
            </div>
            </div>
          </div>

        </div>
      </div>
      <div class="data">
        <div class="col-md-12">
          <div class="box-header col-md-12 col-sm-9 col-xs-12">
            <h3 class="box-title">ความพึงพอใจของอาจารย์ต่อการบริหารหลักสูตร</h3>
          </div>
          
            <div class="col-md-12 col-sm-9 col-xs-12">
              <textarea  id="editor6" name="retention_rate2" rows="10" cols="80">
                           </textarea>
            </div>
          

        </div>
      </div>
      <div class="data">
        <div class="col-md-12">
          <div class="box-header col-md-12 col-sm-9 col-xs-12">
            <h3 class="box-title">หลักฐานอ้างอิง</h3>
          </div>
          <div id="body">
            <div class="col-md-12 col-sm-9 col-xs-12">
            <div class="table-responsive">  
                <table class="table table-bordered" id="dynamic_field2">  
                    <tr>  
                        <td ><input multiple="true" type="file" id="doc_file2" name="doc_file2[]" class="form-control name_list"></td> 
                        <td width="60%"><input type="text" name="name2[]" placeholder="ตั้งชื่อไฟล์" class="form-control name_list" /></td>   
                        <td><button type="button" name="add" id="add2" class="btn btn-success"><i class="fa fa-plus"></i></button></td>  
                    </tr>  
                </table>  
            </div>
            </div>
          </div>

        </div>
      </div>

      <div class="data">
        <div class="col-md-12">
          <div class="box-header col-md-12 col-sm-9 col-xs-12">
            <h3 class="box-title">ผลการประเมินตนเอง</h3>
          </div>
          <div id="body">
            <div class="col-md-12 col-sm-9 col-xs-12">
            <table class="table table-bordered text-center">
                <tbody><tr>
                  <th width="30%" >ตัวบ่งชี้</th>
                  <th width="10%">เป้าหมาย</th>
                  @if($per1!=null)
                      <th colspan="2" width="10%">ผลการดำเนินงาน</th>
                  @else
                      <th  width="10%">ผลการดำเนินงาน</th>
                  @endif
                  <th width="10%">คะแนนอิงเกณฑ์ สกอ.</th>
                </tr>
                @foreach($pdca as $row)
                <input type="hidden" class="form-control" id="Indicator_id" name="Indicator_id" value="{{$row['Indicator_id']}}"/>
                <tr>
                  <td rowspan="2">ตัวบ่งชี้ที่ {{$row['Indicator_id']}} {{$row['Indicator_name']}}</td>           
                  <td rowspan="2"><input type="number" class="form-control text-center" id="target" name="target" min="0" max="5"></td>
                  @if($per1!=null)
                    <td ><input type="number" class="form-control text-center" name="performance1" min="0" max="5"></td></td>
                  @endif  
                  <td rowspan="2"><input type="number" class="form-control text-center" id="performance3" name="performance3" min="0" max="5"></td>
                  <td rowspan="2"><input type="number" class="form-control text-center" id="score" name="score" min="0" max="5"></td>
                </tr>
                <tr>
                @if($per1!=null)
                    <td ><input type="number" class="form-control text-center" name="performance2" min="0" max="5"></td></td>
                  @endif  
                </tr>
                <tr>
                @endforeach
              </tbody></table>

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
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(e) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    var postURL = "<?php echo url('addmore'); ?>";
      var i=0;  
      var x=0;

      $('#add').click(function(){  
           i++;  
           $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input multiple="true" type="file" id="doc_file" name="doc_file1[]" class="form-control name_list"></td><td width="60%"><input type="text" name="name1[]" placeholder="ตั้งชื่อไฟล์" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
      });  


      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      }); 

      $('#add2').click(function(){  
           x++;  
           $('#dynamic_field2').append('<tr id="row'+x+'" class="dynamic-added"><td><input multiple="true" type="file" id="doc_file2" name="doc_file2[]" class="form-control name_list"></td><td width="60%"><input type="text" name="name2[]" placeholder="ตั้งชื่อไฟล์" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+x+'" class="btn btn-danger btn_remove2">X</button></td></tr>');  
      });  


      $(document).on('click', '.btn_remove2', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });
    $('#adddata').submit(function(e) {
      e.preventDefault();
      for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
        }
      var formData = new FormData(this);
      let TotalFiles1 = $('#doc_file1')[0].files.length; //Total files
      
      for (let i = 0; i < TotalFiles1; i++) {
        let files1 = $('#doc_file1')[i];
        formData.append('files1' + i, files1.files[i]);
      }
      formData.append('TotalFiles1', TotalFiles1);

      let TotalFiles2 = $('#doc_file2')[0].files.length; //Total files
      
      for (let i2 = 0; i2 < TotalFiles2; i2++) {
        let files2 = $('#doc_file2')[i2];
        formData.append('files2' + i2, files2.files[i2]);
      }
      formData.append('TotalFiles2', TotalFiles2);
      var editor5 = document.getElementById("editor5").value;
      var editor6 = document.getElementById("editor6").value;
      var target = document.getElementById("target").value;
      var score = document.getElementById("score").value;
      var performance3 = document.getElementById("performance3").value;
      var getdoc_file1 = $("input[name='doc_file1[]']")
              .map(function(){return $(this).val();}).get();
      var getname1 = $("input[name='name1[]']")
              .map(function(){return $(this).val();}).get();
      var getdoc_file2 = $("input[name='doc_file2[]']")
              .map(function(){return $(this).val();}).get();
      var getname2 = $("input[name='name2[]']")
              .map(function(){return $(this).val();}).get();

      var doc_file1="";
            for (index = 0; index < getdoc_file1.length; ++index) {
              if(getdoc_file1[index]!=""){
                doc_file1="aaaa";
             }
             else{
              doc_file1="";
             }
            }
      var name1="";
            for (index = 0; index < getname1.length; ++index) {
              if(getname1[index]!=""){
                name1="aaaa";
             }
             else{
              name1="";
             }
            }


      var doc_file2="";
            for (index = 0; index < getdoc_file2.length; ++index) {
              if(getdoc_file2[index]!=""){
                doc_file2="aaaa";
             }
             else{
              doc_file2="";
             }
            }
      var name2="";
            for (index = 0; index < getname2.length; ++index) {
              if(getname2[index]!=""){
                name2="aaaa";
             }
             else{
              name2="";
             }
            }

      if(editor5==""||editor6==""||doc_file2==""||doc_file1==""||name1==""||name2==""||performance3==""||score==""||target==""){
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
        url: "/addindicator4_3",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: (data) => {
          swal({
          title: "บันทึกข้อมูลเรียบร้อย",
          text: "",
          icon: "success",
          button: "ตกลง",
        }).then(function() {
          window.location = "/category/indicator4-3";
        });
        },
        error: function(data) {
          swal({
          title: "เอกสารอ้างอิงไม่ถูกต้อง",
          text: "",
          icon: "error",
          showConfirmButton: false,
        });
          alert(data.responseJSON.errors.files1[0]);
          console.log(data.responseJSON.errors);
        }
      });
      } else {
        
      }
    });
  }
    });
  });
  
</script>
@endsection