@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
  <div class="box-header">
    <div class="box-body">
    @foreach($editdata as $key=>$row)
      <div class="col-sm-2" align="right"></div>
      <div class="col-sm-8" align="center">
        <h3><i class=""></i>{{$row['category_name']}}</h3>
        <hr>
      </div>
    </div>
    <form id="adddata" method="POST" action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data">
    @csrf
      <div class="data">
        <div class="col-md-12">
        <input type="hidden" class="form-control" id="pdca_id" name="pdca_id" value="{{$row['pdca_id']}}"/>
          <div class="box-header col-md-12 col-sm-9 col-xs-12">
            <h3 class="box-title">การดำเนินงานตามแผน (D)</h3>
          </div>
          <div id="body">
            <div class="col-md-12 col-sm-9 col-xs-12">
              <textarea id="editor1" name="editor1" rows="10" cols="80">
              {{$row['d']}}
              </textarea>
            </div>
          </div>
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
          @foreach($row->docpdca as $key=>$value)
          @if($value['categorypdca']=='d')
                    <tr>  
                         <td >{{$i}}</td>
                        <td >{{$value['doc_file']}}</td>   
                        <td width="10%" class="text-center"><button id="{{$value['doc_id']}}" class="btn btn-danger delete" type="button" name="remove" ><i class="fa fa-trash"></i></button></td>  
                    </tr>
            <?php $i++ ?>  
          @endif
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
                <table class="table table-bordered" id="dynamic_field">  
                    <tr>  
                        <td ><input multiple="true" type="file" id="doc_file" name="doc_file[0]" class="form-control name_list"></td> 
                        <td width="60%"><input type="text" name="name[0]" placeholder="ตั้งชื่อไฟล์" class="form-control name_list" /></td>   
                        <td><button type="button" name="add" id="add" class="btn btn-success"><i class="fa fa-plus"></i></button></td>  
                    </tr>  
                </table>   
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
      @endforeach
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
  button {
    background-color: Transparent;
    background-repeat:no-repeat;
    border: none;
    cursor:pointer;
    overflow: hidden;
    outline:none;
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


      $('#add').click(function(){  
           i++;  
           $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input multiple="true" type="file" id="doc_file" name="doc_file['+i+']" class="form-control name_list"></td><td width="60%"><input type="text" name="name['+i+']" placeholder="ตั้งชื่อไฟล์" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
      });  


      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      }); 
    $('#adddata').submit(function(e) {
      e.preventDefault();
      for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
        }
      var formData = new FormData(this);
      let TotalFiles = $('#doc_file').length;
      let files = $('#doc_file')[0];
      for (let i = 0; i < TotalFiles; i++) {
        formData.append('files' + i, files.files[i]);
      }
      formData.append('TotalFiles', TotalFiles);
      

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
        url: "/updated",
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
          window.location = "/category3/pdca/{{session()->get('idmenu')}}";
        });
        },
        error: function(data) {
          swal({
          title: "เอกสารอ้างอิงไม่ถูกต้อง",
          text: "",
          icon: "error",
          showConfirmButton: false,
        });
          alert(data.responseJSON.errors.files[0]);
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
        url: "/deletedoc/"+id,
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