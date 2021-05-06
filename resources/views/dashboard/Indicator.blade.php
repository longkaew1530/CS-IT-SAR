@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl ">
            <div class="box-header">
              <h2 class="box-title">ตัวบ่งชี้</h2>
            </div>
            <button  class="btn btn-success ml-1" type="button"   data-toggle="modal" data-target="#modal-info"><i class="fa fa-plus"></i> เพิ่มข้อมูล</button>
            <!-- /.box-header -->
            <div class="box-body">
            <!-- /.box-header -->
            <table id="example3" class="table table-bordered table-striped ">
                <thead>
                <tr>
                  <th width="5%">ที่</th>
                  <th >ตัวบ่งชี้</th>
                  <th width="5%" >แก้ไข</th>
                  <th width="5%">ลบ</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($indicator as $key=>$row)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>@if($row['Indicator_id']!="")ตัวบ่งชี้ {{$row['Indicator_id']}}@endif {{$row['Indicator_name']}}</td>           
                  <td class="text-center"><button class="btn btn-warning" type="button"   data-toggle="modal" data-target="#modal-edit" data-id="{{$row['id']}}"><i class='fa fas fa-edit'></i></button></td>
                  <td class="text-center">
                                      <button  id="{{$row->id}}" type="button" class="btn btn-danger deletedata"><i class='fa fa-trash'></i></button>
                  </td>
                </tr>
                <div class="modal  fade" id="modal-info">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">เพิ่มตัวบ่งชี้</h4>
              </div>
              <form  id="adddata" method="POST" action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data">
              @csrf
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">ตัวบ่งชี้ที่</label>
                  <input type="text" class="form-control" id="Indicator_id" name="Indicator_id" placeholder="ตัวบ่งชี้ที่">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">ชื่อตัวบ่งชี้</label>
                  <input type="text" class="form-control" id="Indicator_name" name="Indicator_name" placeholder="ชื่อตัวบ่งชี้">
                </div>
                <div class="form-group">
                <label for="exampleInputPassword1">หมวด</label>
                                  <select class="form-control"  id="category_id"  class="form-control @error('role') is-invalid @enderror" name="category_id">
                                    @foreach($category as $value)
                                    <option value="{{$value['category_id']}}">{{$value['category_name']}}</option>
                                    @endforeach
                                  </select>
                                  </div>
                 <div class="form-group">
                <label for="exampleInputPassword1">องค์ประกอบ</label>
                                  <select class="form-control"  id="composition_id"  class="form-control @error('role') is-invalid @enderror" name="composition_id">
                                    @foreach($composition as $value)
                                    <option value="{{$value['id']}}">{{$value['name']}}</option>
                                    @endforeach
                                  </select>
                                  </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">URL</label>
                  <input type="text" class="form-control" id="url" name="url" placeholder="URL">
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
              <form  id="updatedata" method="POST" action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data">
              @csrf
              <div class="box-body">
              <div class="form-group">
              <input type="hidden" class="form-control" id="id" name="id" >
                  <label for="exampleInputEmail1">ตัวบ่งชี้ที่</label>
                  <input type="text" class="form-control" id="Indicatorid" name="Indicator_id" placeholder="ตัวบ่งชี้ที่">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">ชื่อตัวบ่งชี้</label>
                  <input type="text" class="form-control" id="Indicatorname" name="Indicator_name" placeholder="ชื่อตัวบ่งชี้">
                </div>
                <div class="form-group">
                <label for="exampleInputPassword1">หมวด</label>
                                  <select class="form-control"  id="categoryid"  class="form-control @error('role') is-invalid @enderror" name="category_id">
                                    @foreach($category as $value)
                                    <option value="{{$value['category_id']}}">{{$value['category_name']}}</option>
                                    @endforeach
                                  </select>
                                  </div>
                 <div class="form-group">
                <label for="exampleInputPassword1">องค์ประกอบ</label>
                                  <select class="form-control"  id="compositionid"  class="form-control @error('role') is-invalid @enderror" name="composition_id">
                                    @foreach($composition as $value)
                                    <option value="{{$value['id']}}">{{$value['name']}}</option>
                                    @endforeach
                                  </select>
                                  </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">URL</label>
                  <input type="text" class="form-control" id="uurl" name="url" placeholder="URL">
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
$('#modal-edit').on('show.bs.modal', function (event) {
var button = $(event.relatedTarget);
var id= button.data('id');
var modal = $(this);
modal.find('#emp_id').val(id);
var url = "/getdefualindicator";
        $.get(url + '/' + id, function (data) {
            //success data
            console.log(data)
            $("#id").val(data[0].id);
            $("#Indicatorid").val(data[0].Indicator_id);
            $("#Indicatorname").val(data[0].Indicator_name);
            $("#categoryid").val(data[0].category_id);
            $("#compositionid").val(data[0].composition_id);
            $("#uurl").val(data[0].url);
        }) 
});
});
</script>
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
      $.ajax({
        type: 'POST',
        url: "/adddefualindicator",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: (data) => {
          swal({
          title: "เพิ่มข้อมูลสำเร็จ",
          text: "Success",
          icon: "success",
          button: "ตกลง",
        }).then(function() {
          window.location = "/Indicator";
        });
        },
        error: function(data) {
          alert(data.responseJSON.errors.files1[0]);
          console.log(data.responseJSON.errors);
        }
      });
    });
    $('#updatedata').submit(function(e) {
      e.preventDefault();
      for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
        }
      var formData = new FormData(this);
      $.ajax({
        type: 'POST',
        url: "/updatedefualindicator",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: (data) => {
          swal({
          title: "อัปเดตข้อมูลสำเร็จ",
          text: "Success",
          icon: "success",
          button: "ตกลง",
        }).then(function() {
          window.location = "/Indicator";
        });
        },
        error: function(data) {
          alert(data.responseJSON.errors.files1[0]);
          console.log(data.responseJSON.errors);
        }
      });
    });
    $('.deletedata').click(function(e) {
      console.log("asdasd");
      e.preventDefault();
      var id = $(this).attr('id');
      $.ajax({
        type: 'DELETE',
        url: "/deletedefualindicator/"+id,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: (data) => {
          swal({
          title: "ลบข้อมูลเรียบร้อยแล้ว",
          text: "",
          icon: "success",
          button: "ตกลง",
        }).then(function() {
          window.location = "/Indicator";
        });
        },
        error: function(data) {
          swal({
          title: "ไม่สามารถลบข้อมูลได้เนื่องจากข้อมูลสัมพันธ์กัน",
          text: "",
          icon: "error",
          showConfirmButton: false,
          });
          alert(data.responseJSON.errors.files1[0]);
          console.log(data.responseJSON.errors);
        }
      });
    });
  });
  
</script>
@endsection