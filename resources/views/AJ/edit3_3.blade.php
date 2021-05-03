@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
  <div class="box-header">
    <div class="box-body">
      <div class="col-sm-2" align="right"></div>
      <div class="col-sm-8" align="center">
        <h3><i class=""></i>เพิ่มผลการดำเนินงาน</h3>
        <hr>
      </div>
    </div>
    <form id="adddata" method="POST" action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data">
    @csrf
        <input type="hidden" class="form-control" id="id" name="id" value="{{$editdata[0]['id']}}">
        <input type="hidden" class="form-control" id="id2" name="id2" value="{{$editdata[1]['id']}}">
        <input type="hidden" class="form-control" id="id3" name="id3" value="{{$editdata[2]['id']}}">
        @foreach($editdata as $key=>$row)
        <div class="col-md-12">
          <div class="box-header col-md-12 col-sm-9 col-xs-12">
            <h3 class="box-title">{{$row['category_retention_rate']}}</h3>
          </div>
          
            <div class="col-md-12 col-sm-9 col-xs-12">
              <textarea  id="editor{{$key+4}}" name="retention_rate{{$key+1}}" rows="10" cols="80" >
              {{$row['retention_rate']}}
              </textarea>
            </div>
        </div>
        <div class="data">
        <div class="col-md-12">
          <div class="box-header col-md-12 col-sm-9 col-xs-12">
          <h3 class="box-title">หลักฐานอ้างอิง</h3><br><br>
          <table id="example2" class="table table-bordered table-hover">
          <thead>
                <tr>
                <th width="5%">ที่</th>
                  <th>ชื่อไฟล์</th>
                  <th width="5%">ลบ</th>
                </tr>
                </thead>
                <tbody>
          <?php $i=1 ?>
          @foreach($row->doc_performance3_3 as $value)
                    <tr>  
                         <td >{{$i}}</td>
                        <td >{{$value['doc_file']}}</td>   
                        <td width="10%" class="text-center"><button id="{{$value['Indicator_id']}}" class="btn btn-danger delete" type="button" name="remove" ><i class="fa fa-trash"></i></button></td>  
                    </tr>
            <?php $i++ ?>  
          @endforeach
          </tbody>
          </table> 
          </div>

        </div>
      </div>

      <div class="data">
        <div class="col-md-12">
          <div class="box-header col-md-12 col-sm-9 col-xs-12">
            <h3 class="box-title">เพิ่มหลักฐานอ้างอิง</h3>
          </div>
          
          <div id="show2"></div>
          <div id="body">
            <div class="col-md-12 col-sm-9 col-xs-12">
            <div class="table-responsive">  
                <table class="table table-bordered" id="dynamic_field{{$key+1}}">  
                    <tr>  
                        <td ><input multiple="true" type="file" id="doc_file{{$key+1}}" name="doc_file{{$key+1}}[0]" class="form-control name_list"></td> 
                        <td width="60%"><input type="text" name="name{{$key+1}}[0]" placeholder="ตั้งชื่อไฟล์" class="form-control name_list" /></td>   
                        <td><button type="button" name="add" id="add{{$key+1}}" class="btn btn-success"><i class="fa fa-plus"></i></button></td>  
                    </tr>  
                </table>   
            </div>
            
              
            </div>
          </div>

        </div>
      </div>
      @endforeach

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
                <input type="hidden" class="form-control" id="Indicator_id" name="Indicator_id" value="{{$row['pdca_id']}}"/>
                <tr>
                  <td rowspan="2">ตัวบ่งชี้ที่ {{$row['Indicator_id']}} {{$row['Indicator_name']}}</td>           
                  <td rowspan="2"><input type="number" max="5" min="0" class="form-control text-center" name="target"  value="{{$row['target']}}"></td>
                  @if($per1!=null)
                    <td ><input type="text" class="form-control text-center" id="performance1" name="performance1"  value="{{$row['performance1']}}" ></td></td>
                  @endif  
                  <td rowspan="2"><input type="number" max="5" min="0" class="form-control text-center" id="performance3" name="performance3"  value="{{$row['performance3']}}" ></td>
                  <td rowspan="2"><input type="number" max="5" min="0" class="form-control text-center" id="score" name="score"  value="{{$row['score']}}" ></td>
                </tr>
                <tr>
                @if($per1!=null)
                    <td ><input type="text" class="form-control text-center" id="performance2" name="performance2"  value="{{$row['performance2']}}" ></td></td>
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
      var s=0;
      $('#add1').click(function(){  
           i++;  
           $('#dynamic_field1').append('<tr id="row'+i+'" class="dynamic-added"><td><input multiple="true" type="file" id="doc_file1" name="doc_file1['+i+']" class="form-control name_list"></td><td width="60%"><input type="text" name="name1['+i+']" placeholder="ตั้งชื่อไฟล์" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
      });  


      $(document).on('click', '.btn_remove1', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      }); 

      $('#add2').click(function(){  
           x++;  
           $('#dynamic_field2').append('<tr id="row'+x+'" class="dynamic-added"><td><input multiple="true" type="file" id="doc_file2" name="doc_file2['+x+']" class="form-control name_list"></td><td width="60%"><input type="text" name="name2['+x+']" placeholder="ตั้งชื่อไฟล์" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+x+'" class="btn btn-danger btn_remove2">X</button></td></tr>');  
      });  


      $(document).on('click', '.btn_remove2', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });
      $('#add3').click(function(){  
           s++;  
           $('#dynamic_field3').append('<tr id="row'+s+'" class="dynamic-added"><td><input multiple="true" type="file" id="doc_file3" name="doc_file3['+s+']" class="form-control name_list"></td><td width="60%"><input type="text" name="name3['+s+']" placeholder="ตั้งชื่อไฟล์" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+s+'" class="btn btn-danger btn_remove3">X</button></td></tr>');  
      });  


      $(document).on('click', '.btn_remove3', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });
    $('#adddata').submit(function(e) {
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
        url: "/updateindicator3_3",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: (data) => {
          swal({
          title: "แก้ไขข้อมูลเรียบร้อย",
          text: "",
          icon: "success",
          button: "ตกลง",
        }).then(function() {
          window.location = "/category3/performance";
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
        url: "/deletedoc3_3/"+id,
        data: {id:id},
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: (data) => {
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

          alert(data.responseJSON.errors.files[0]);
          console.log(data.responseJSON.errors);
        }
      });
      } else {
        
      }
    });
    });
  });
  
</script>
@endsection