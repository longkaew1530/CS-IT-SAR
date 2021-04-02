@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
  <div class="box-header">
    <div class="box-body">
      <div class="col-sm-2" align="right"></div>
      <div class="col-sm-8" align="center">
        <h3><i class=""></i>{{$getindi[0]['category_name']}}</h3>
        <hr>
      </div>
    </div>
    <form id="adddata" method="POST" action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data">
    @csrf
      <div class="data">
        <div class="col-md-12">
          <div class="box-header col-md-12 col-sm-9 col-xs-12">
            <h3 class="box-title">ขั้นตอนการวางแผน (P)</h3>
            <input type="hidden" class="form-control" id="Indicator_id" name="Indicator_id" value="{{$getcateid[0]['Indicator_id']}}"/>
            <input type="hidden" class="form-control" id="category_id" name="category_id" value="{{$getindi[0]['id']}}"/>
          </div>
          <div id="body">
            <div class="col-md-12 col-sm-9 col-xs-12">
              <textarea id="editor1" name="editor1" rows="10" cols="80">
              </textarea>
            </div>
          </div>
        </div>
      </div>
      <div class="data">
        <div class="col-md-12">
          <div class="box-header col-md-12 col-sm-9 col-xs-12">
            <h3 class="box-title">หลักฐานอ้างอิง</h3>
          </div>
          <input type="hidden" class="form-control" name="doc[]" id="doc" >
          <div id="show2"></div>
          <div id="body">
            <div class="col-md-12 col-sm-9 col-xs-12">
            <button class="btn btn-primary" type="button" id="add"  data-toggle="modal" data-target="#modal-edit" ><i class='fa fa-plus'></i> เพิ่ม</button>
              <!-- <input multiple="true" type="file" id="doc_file" name="doc_file[]"> -->
            </div>
          </div>

        </div>
      </div>

      <div class="modal  fade" id="modal-edit">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">เพิ่มหลักฐานอ้างอิง</h4>
              </div>
              <form  method="POST" action="/updateusergroup">
              @csrf
              {{ method_field('PUT') }}
              <div class="box-body">
              <div id="show"></div>
              <div class="form-group">
              <input type="hidden" class="form-control" id="usergroup_id" name="user_group_id" >
                  <label for="exampleInputEmail1">หลักฐานอ้างอิง</label>
                  <input type="file" id="doc_file" name="doc_file[]" onchange="example()">
                </div>
                
              </div>
            
              <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">ปิด</button>
                <button type="button" onclick="example2()" class="btn btn-info">บันทึกข้อมูล</button>
              </div>
              </form>
              <input type="hidden" class="form-control" name="id" id="emp_id" >
              
            </div>
            
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        
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
    $('#adddata').submit(function(e) {
      e.preventDefault();
      for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
        }
      var formData = new FormData(this);
      let TotalFiles = $('#doc_file')[0].files.length; //Total files
      let files = $('#doc_file')[0];
      for (let i = 0; i < TotalFiles; i++) {
        formData.append('files' + i, files.files[i]);
      }
      formData.append('TotalFiles', TotalFiles);
      $.ajax({
        type: 'POST',
        url: "/addp",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: (data) => {
          swal({
          title: "เพิ่มข้อมูลเรียบร้อยแล้ว",
          text: "",
          icon: "success",
          button: "ตกลง",
        }).then(function() {
          window.location = "/category3/pdca/{{session()->get('idmenu')}}";
        });
        },
        error: function(data) {
          alert(data.responseJSON.errors.files[0]);
          console.log(data.responseJSON.errors);
        }
      });
    });
  });
  function example(){
    var inp = document.getElementById('doc_file');
      for (var i = 0; i < inp.files.length; ++i) {
        var name = inp.files.item(i).name;
        $('#show').append(name+'<div class="form-group"><input type="text" class="form-control" id="filename" name="filename[]" placeholder="ชื่อไฟล์"></div>');  
      }
       }
  function example2(){
    var values = $("input[name='filename[]']")
              .map(function(){return $(this).val();}).get();
    var inp = document.getElementById('doc_file');
    var i=0;
    document.getElementById("doc").value =inp;
        var name = inp.files.item(i).name;
        $('#show2').append('<div class="col-md-12 col-sm-9 col-xs-12"><span class="badge bg-green">'+(i+1)+'. '+values[i]+'</span><input type="hidden" class="form-control" id="getfilename" name="getfilename[]" value="'+values[i]+'"></div>');  
      i++;
      $('#modal-edit').modal('toggle');
      document.getElementById("doc_file").value = "";
      document.getElementById('show').style.visibility = 'hidden';
       }
</script>
@endsection