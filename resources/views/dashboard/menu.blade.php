@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl ">
            <div class="box-header">
              <h1 class="box-title">เมนู</h1>
            </div>
           
            <button class="btn btn-success ml-1" type="button"   data-toggle="modal" data-target="#modal-info"><i class="fa fa-plus"></i> เพิ่มข้อมูล</button>
            
            <!-- /.box-header -->
            <div class="box-body">
            <!-- /.box-header -->
            <table id="example3" class="table table-bordered table-striped ">
                <thead>
                <tr>
                  <th width="5%">ที่</th>
                  <th width="30%">เมนู</th>
                  <th width="30%">URL</th>
                  <th width="20%">กลุ่มเมนู</th>
                  <th width="5%" >แก้ไข</th>
                  <th width="5%">ลบ</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($getmenu as $key=>$row)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$row['m_name']}}</td>
                  <td>{{$row['m_url']}}</td> 
                  <td>{{$row['g_name']}}</td>              
                  <td class="text-center"><button class="btn btn-warning" type="button"   data-toggle="modal" data-target="#modal-edit" data-id="{{$row['m_id']}}"><i class='fa fas fa-edit'></i></button></td>
                  <td class="text-center"><button id="{{$row['m_id']}}" class="btn btn-danger delete" type="button" name="remove" ><i class="fa fa-trash"></i></button>
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
                <h4 class="modal-title">เพิ่มข้อมูลกลุ่มเมนู</h4>
              </div>
              <form id="adddata" method="POST" action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data" >
              @csrf
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">เมนู</label>
                  <input type="text" class="form-control" id="m_name" name="m_name" placeholder="เมนู">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">URL</label>
                  <input type="text" class="form-control" id="m_url" name="m_url" placeholder="URL">
                </div>
                <div class="form-group">
                <label for="exampleInputPassword1">กลุ่มเมนู</label>
                                  <select class="form-control"  id="g_id"  class="form-control @error('role') is-invalid @enderror" name="g_id">
                                    @foreach($getgroupmenu as $value)
                                    <option value="{{$value['g_id']}}">{{$value['g_name']}}</option>
                                    @endforeach
                                  </select>
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

        <div class="modal  fade" id="modal-edit">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">เพิ่มข้อมูลกลุ่มเมนู</h4>
              </div>
              <form  id="update" method="POST" action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data" >
              @csrf
              <div class="box-body">
              <input type="hidden" class="form-control" id="m_id1" name="m_id1" >
                <div class="form-group">
                  <label for="exampleInputEmail1">เมนู</label>
                  <input type="text" class="form-control" id="m_name1" name="m_name1" placeholder="เมนู">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">URL</label>
                  <input type="text" class="form-control" id="m_url1" name="m_url1" placeholder="URL">
                </div>
                <div class="form-group">
                <label for="exampleInputPassword1">กลุ่มเมนู</label>
                                  <select class="form-control"  id="g_id1"  class="form-control @error('role') is-invalid @enderror" name="g_id1">
                                    @foreach($getgroupmenu as $value)
                                    <option value="{{$value['g_id']}}">{{$value['g_name']}}</option>
                                    @endforeach
                                  </select>
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
  width:50%;
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
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
  $(function () {
    $('#example3').DataTable({
      lengthMenu: [ 5, 10, 50, 100]
    })
  })
</script>
<script>
$(document).ready(function() {
  $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $('#adddata').submit(function(e) {
      e.preventDefault();

      var formData = new FormData(this);
      var m_name = document.getElementById("m_name").value;
      var m_url = document.getElementById("m_url").value;


       if(m_name==""||m_url==""){
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
        url: "/addmenu",
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
          window.location = "/Menu";
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
      var m_name = document.getElementById("m_name1").value;
      var m_url = document.getElementById("m_url1").value;


       if(m_name==""||m_url==""){
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
        url: "/updatemenu",
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
          window.location = "/Menu";
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
$('#modal-edit').on('show.bs.modal', function (event) {
var button = $(event.relatedTarget);
var id= button.data('id');
var modal = $(this);
modal.find('#emp_id').val(id);
var url = "/getmenu";
        $.get(url + '/' + id, function (data) {
            //success data
            console.log(data)
            $("#m_id1").val(data[0].m_id);
            $("#m_name1").val(data[0].m_name);
            $("#m_url1").val(data[0].m_url);
            $("#g_id1").val(data[0].g_id);
        }) 
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
        url: "/deletemenu/"+id,
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
});
</script>
@endsection