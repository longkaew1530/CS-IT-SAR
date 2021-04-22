@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl ">
  <div class="box-header">
    <h2 class="box-title">ข้อมูลวุฒิการศึกษา</h2>
  </div>
  <button class="btn btn-success ml-1" type="button" data-toggle="modal" data-target="#modal-info"><i class="fa fa-plus"></i> เพิ่มข้อมูล</button>
  <div class="modal  fade" id="modal-info">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">เพิ่มข้อมูลกลุ่มเมนู</h4>
              </div>
              <form id="formadd" method="POST" action="/addeducational_background">
                @csrf
                <div class="box-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">ปีที่สำเร็จการศึกษา</label>
                    <input type="text" class="form-control" id="eb_yearsuccess" name="eb_yearsuccess" placeholder="ปีที่สำเร็จการศึกษา">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">วุฒิการศึกษา</label>
                    <select class="form-control" id="eb_name" class="form-control @error('role') is-invalid @enderror" name="eb_name">
                      <option value="ปริญญาตรี">ปริญญาตรี</option>
                      <option value="ปริญญาโท">ปริญญาโท</option>
                      <option value="ปริญญาเอก">ปริญญาเอก</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">สาขา</label>
                    <input type="text" class="form-control" id="eb_fieldofstudy" name="eb_fieldofstudy" placeholder="สาขา">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">ตัวย่อ</label>
                    <input type="text" class="form-control" id="abbreviations" name="abbreviations" placeholder="ตัวย่อ">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">สถาบันการศึกษา</label>
                    <input type="text" class="form-control" id="education" name="education" placeholder="สถาบันการศึกษา">
                  </div>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-info">บันทึกข้อมูล</button>
                </div>
              </form>
              <input type="hidden" class="form-control" name="id" id="emp_id">

            </div>

            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
  <!-- /.box-header -->
  <div class="box-body">
    <!-- /.box-header -->
    <table id="example3" class="table table-bordered table-striped ">
      <thead>
        <tr>
          <th width="5%">ที่</th>
          <th width="13%">ปีที่สำเร็จการศึกษา</th>
          <th width="10%">วุฒิการศึกษา</th>
          <th width="20%">สาขา</th>
          <th width="30%">สถาบันการศึกษา</th>
          <th width="5%">แก้ไข</th>
          <th width="5%">ลบ</th>
        </tr>
      </thead>
      <tbody>
        @foreach($eductional as $key=>$row)
        <tr>
          <td>{{$key+1}}</td>
          <td>{{$row['eb_yearsuccess']}}</td>
          <td>{{$row['eb_name']}}</td>
          <td>{{$row['eb_fieldofstudy']}}</td>
          <td>{{$row['education']}}</td>
          <td class="text-center"><button class="btn btn-warning" type="button" data-toggle="modal" data-target="#modal-edit" data-id="{{$row['id']}}"><i class='fa fas fa-edit'></i></button></td>
          <td class="text-center">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <button type="button" class="btn btn-danger deletedata" data-id="{{$row['id']}}"><i class='fa fa-trash'></i></button>
          </td>
        </tr>
       

        <div class="modal  fade" id="modal-edit">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">เพิ่มข้อมูลกลุ่มเมนู</h4>
              </div>
              <form id="updatedata" method="POST" action="/updateeducational_background">
                @csrf
                {{ method_field('PUT') }}
                <div class="box-body">
                  <div class="form-group">
                    <input type="hidden" class="form-control" id="id" name="id">
                    <label for="exampleInputEmail1">ปีที่สำเร็จการศึกษา</label>
                    <input type="text" class="form-control" id="eb_yearsuccess1" name="eb_yearsuccess" placeholder="ปีที่สำเร็จการศึกษา">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">วุฒิการศึกษา</label>
                    <select class="form-control" id="eb_name1" class="form-control @error('role') is-invalid @enderror" name="eb_name">
                      <option value="ปริญญาตรี">ปริญญาตรี</option>
                      <option value="ปริญญาโท">ปริญญาโท</option>
                      <option value="ปริญญาเอก">ปริญญาเอก</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">สาขา</label>
                    <input type="text" class="form-control" id="eb_fieldofstudy1" name="eb_fieldofstudy" placeholder="สาขา">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">ตัวย่อ</label>
                    <input type="text" class="form-control" id="abbreviations1" name="abbreviations" placeholder="ตัวย่อ">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">สถาบันการศึกษา</label>
                    <input type="text" class="form-control" id="education1" name="education" placeholder="สถาบันการศึกษา">
                  </div>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-info">บันทึกข้อมูล</button>
                </div>
              </form>
              <input type="hidden" class="form-control" name="id" id="emp_id">

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
  .marginl {
    padding: 10px;
  }

  .wid10 {
    width: 10%;
  }

  .wid20 {
    width: 20%;
  }

  .wid30 {
    width: 30%;
  }

  .wid40 {
    width: 40%;
  }

  .wid50 {
    width: 50%;
  }

  .mt20 {
    margin-top: 50px
  }

  .ml-1 {
    margin-left: 10px
  }

  .ml-2 {
    margin-left: 20px
  }

  .mt-3 {
    margin-top: 30px;
  }
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>
<script>
  $(function() {
    $('#example3').DataTable({
      lengthMenu: [8, 20, 50, 100]
    })
  })
</script>
<script type="text/javascript">
  $('#formadd').ajaxForm(function() {
    swal({
      title: "เพิ่มข้อมูลเรียบร้อยแล้ว",
      text: "",
      icon: "success",
      button: "ตกลง",
    }).then(function() {
      window.location = "/educational_background";
    });
  });
  $('#updatedata').ajaxForm(function() {
    swal({
      title: "อัปเดตข้อมูลเรียบร้อยแล้ว",
      text: "",
      icon: "success",
      button: "ตกลง",
    }).then(function() {
      window.location = "/educational_background";
    });
  });
</script>
<script>
  $(document).ready(function() {
    $('#modal-edit').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget);
      var id = button.data('id');
      var modal = $(this);
      modal.find('#emp_id').val(id);
      var url = "/geteducational_background";
      $.get(url + '/' + id, function(data) {
        //success data
        console.log(data)
        $("#id").val(data[0].id);
        $("#eb_yearsuccess1").val(data[0].eb_yearsuccess);
        $("#eb_name1").val(data[0].eb_name);
        $("#eb_fieldofstudy1").val(data[0].eb_fieldofstudy);
        $("#abbreviations1").val(data[0].abbreviations);
        $("#education1").val(data[0].education);
      })
    });
  });
</script>
<script type="text/javascript">
  $(".deletedata").click(function() {
    var id = $(this).data("id");
    var token = $("meta[name='csrf-token']").attr("content");

    $.ajax({
      url: "/deleteeducational_background/" + id,
      type: 'post',
      data: {
        "id": id,
        "_token": token,
      },
      success: function(data) {
        swal({
          title: "ลบข้อมูลเรียบร้อยแล้ว",
          text: "",
          icon: "success",
          button: "ตกลง",
        }).then(function() {
          window.location = "/educational_background";
        });
      }
    });

  });
</script>
@endsection