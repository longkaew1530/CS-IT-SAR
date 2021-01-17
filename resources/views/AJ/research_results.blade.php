@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl ">
  <div class="box-header">
    <h2 class="box-title">ข้อมูลผลงานวิจัย</h2>
  </div>
  <button class="btn btn-success ml-1" type="button" data-toggle="modal" data-target="#modal-info"><i class="fa fa-plus"></i> เพิ่มข้อมูล</button>
  <!-- /.box-header -->
  <div class="box-body">
    <!-- /.box-header -->
    <table id="example3" class="table table-bordered table-striped ">
      <thead>
        <tr>
          <th width="5%">ที่</th>
          <th width="30%">ผลงานวิจัย</th>
          <th width="30%">ประเภทผลงานวิจัย</th>
          <th width="5%">แก้ไข</th>
          <th width="5%">ลบ</th>
        </tr>
      </thead>
      <tbody>
        @foreach($researchresults as $key=>$row)
        <tr>
          <td>{{$key+1}}</td>
          <td>{{$row['teacher_name'].".(".$row['research_results_year'].")".$row['research_results_name'].". ".$row['research_results_description']}}</td>
          <td>{{$row['name']}}</td>
          <td class="text-center"><button class="btn btn-warning" type="button" data-toggle="modal" data-target="#modal-edit" data-id="{{$row['research_results_id']}}"><i class='fa fas fa-edit'></i></button></td>
          <td class="text-center">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <button type="button" class="btn btn-danger deletedata" data-id="{{$row['research_results_id']}}"><i class='fa fa-trash'></i></button>
          </td>
        </tr>
        <div class="modal  fade" id="modal-info">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">เพิ่มข้อมูลผลงานวิจัย</h4>
              </div>
              <form id="formadd" method="POST" action="/addresearch_results">
                @csrf
                <div class="box-body">
                  <div class="form-group">
                    <label for="exampleInputPassword1">อาจารย์</label>
                    @foreach($userall as $value)
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" value="{{$value['id']}}" id="teacher_name" name="teacher_name[]">
                        {{$value['user_fullname']}}
                      </label>
                    </div>
                    @endforeach
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">ประเภทผลงานวิจัย</label>
                    <select class="form-control" id="research_results_category" class="form-control @error('role') is-invalid @enderror" name="research_results_category">
                      @foreach($category as $value)
                      <option value="{{$value['id']}}">{{$value['name']}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">ปีที่ทำวิจัย/ตีพิมพ์</label>
                    <input type="text" class="form-control" id="research_results_year" name="research_results_year" placeholder="ปีที่จัดทำ">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">ชื่อผลงาน</label>
                    <input type="text" class="form-control" id="research_results_name" name="research_results_name" placeholder="ชื่อผลงาน">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">รายละเอียด</label>
                    <textarea class="form-control" rows="3" placeholder="รายละเอียด" id="research_results_description" name="research_results_description"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">งบประมาณ</label>
                    <input type="text" class="form-control" id="research_results_salary" name="research_results_salary" placeholder="งบประมาณ">
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
      window.location = "/research_results";
    });
  });
  $('#updatedata').ajaxForm(function() {
    swal({
      title: "อัปเดตข้อมูลเรียบร้อยแล้ว",
      text: "",
      icon: "success",
      button: "ตกลง",
    }).then(function() {
      window.location = "/research_results";
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
      url: "/deleteresearch_results/" + id,
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
          window.location = "/research_results";
        });
      }
    });

  });
</script>
@endsection