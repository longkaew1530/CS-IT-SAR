@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl ">
  <div class="box-header">
    <h2 class="box-title">ข้อมูลการอบรม</h2>
  </div>
  <button class="btn btn-success ml-1" type="button" data-toggle="modal" data-target="#modal-info"><i class="fa fa-plus"></i> เพิ่มข้อมูล</button>
  <div class="modal  fade" id="modal-info">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">เพิ่มข้อมูลการอบรม</h4>
              </div>
              <form id="adddata" method="POST" action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data" >
                @csrf
                <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputPassword1">ชื่อการอบรบ</label>
                    
                    <input type="text" class="form-control"  id="name_training" name="name_training"   placeholder="ชื่อการอบรบ">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">วัน/เดือน/ปี ที่อบรบ</label>
                    <input  type="text" class="form-control" id="date_training" name="date_training" placeholder="วัน/เดือน/ปี ที่อบรบ">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">วัน/เดือน/ปี ที่อบรบ</label>
                    <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right " id="datepicker"  name="year_id" >
                </div>
                    <!-- <input  type="date" class="form-control" id="year_id" name="year_id" placeholder="วัน/เดือน/ปี ที่อบรบ"> -->
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">สถานที่</label>
                    <input type="hidden" id="owner" name="owner"  >
                    <input type="text" class="form-control"  placeholder="สถานที่" id="place_training" name="place_training" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">ประเภท</label>
                    <select class="form-control" id="category_training" name="category_training" class="form-control @error('role') is-invalid @enderror" >
                      <option value="อบรบ">อบรบ</option>
                      <option value="ประชุม">ประชุม</option>
                      <option value="สัมมนา">สัมมนา</option>
                    </select>
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
          <th width="30%">ชื่อการอบรบ</th>
          <th width="20%">วัน/เดือน/ปี ที่อบรบ</th>
          <th width="15%">สถานที่</th>
          <th width="10%">ประเภท</th>
          <th width="5%">แก้ไข</th>
          <th width="5%">ลบ</th>
        </tr>
      </thead>
      <tbody>
        @foreach($userall as $key=>$row)
        <tr>
          <td>{{$key+1}}</td>
          <td>{{$row['name_training']}}</td>
          <td>{{$row['date_training']}}</td>
          <td>{{$row['place_training']}}</td>
          <td>{{$row['category_training']}}</td>
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
                <h4 class="modal-title">แก้ไขผลงานวิจัย</h4>
              </div>
              <form id="updatedata" method="POST" action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data" >
                @csrf
                <div class="box-body">
                    <input type="hidden" class="form-control" id="id" name="id" >
                    <div class="form-group">
                    <label for="exampleInputPassword1">ชื่อการอบรบ</label>
                    
                    <input type="text" class="form-control"  id="name_training1" name="name_training"   placeholder="ชื่อการอบรบ">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">วัน/เดือน/ปี ที่อบรบ</label>
                    <input  type="text" class="form-control" id="date_training1" name="date_training" placeholder="วัน/เดือน/ปี ที่อบรบ">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">วัน/เดือน/ปี ที่อบรบ</label>
                    <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right " id="datepicker2"  name="year_id" >
                </div>
                    <!-- <input  type="date" class="form-control" id="year_id1" name="year_id" placeholder="วัน/เดือน/ปี ที่อบรบ"> -->
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">สถานที่</label>
                    <input type="hidden" id="owner" name="owner"  >
                    <input type="text" class="form-control"  placeholder="สถานที่" id="place_training1" name="place_training" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">ประเภท</label>
                    <select class="form-control" id="category_training1" name="category_training" class="form-control @error('role') is-invalid @enderror" >
                      <option value="อบรบ">อบรบ</option>
                      <option value="ประชุม">ประชุม</option>
                      <option value="สัมมนา">สัมมนา</option>
                    </select>
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
    defaultViewDate: {year: year}
  })
  $('#datepicker2').datepicker({
    defaultViewDate: {year: year}
  })
   //as you defined in bootstrap-datepicker.XX.js
});
</script>
<script>
  $(function() {
    $('#example3').DataTable({
      lengthMenu: [8, 20, 50, 100]
    })
  });
</script>

<script type="text/javascript">

</script>
<script>
  $(document).ready(function() {
    $selectElement = $('#teacher_name').select2({
      allowClear: true,
    placeholder: {
        id: "0",
        placeholder: "Select an Title"
    }
  });
      
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $('#adddata').submit(function(e) {
      e.preventDefault();
      var formData = new FormData(this);
      var name_training = document.getElementById("name_training").value;
      var date_training = document.getElementById("date_training").value;
      var category_training = document.getElementById("category_training").value;
      if(name_training==""||date_training==""||category_training==""){
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
        url: "/addtraining_information",
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
          window.location = "/training_information";
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
      var name_training1 = document.getElementById("name_training1").value;
      var date_training1 = document.getElementById("date_training1").value;
      var category_training1 = document.getElementById("category_training1").value;

      if(name_training1==""||date_training1==""||category_training1==""){
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
        url: "/updatetraining_information",
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
          window.location = "/training_information";
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
      var url = "/gettraining_information";
      $.get(url + '/' + id, function(data) {
        //success data
        $("#id").val(data[0].id);
        $("#name_training1").val(data[0].name_training);
        $("#date_training1").val(data[0].date_training);
        $("#datepicker2").val(data[0].year_id);
        $("#place_training1").val(data[0].place_training);
        $("#category_training1").val(data[0].category_training);

        

        $('#select').select2({
        
      })
      


        
        
      })
    });
  });

  
</script>
<script type="text/javascript">
  $(".deletedata").click(function() {
    var id = $(this).data("id");
    var token = $("meta[name='csrf-token']").attr("content");

    swal({
      title: "ยืนยันการลบข้อมูล?",
      icon: "warning",
      buttons: true,
      successMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
      url: "/deletetraining_information/" + id,
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
          window.location = "/training_information";
        });
      }
    });
      } else {
        
      }
    });
  });
  
</script>
@endsection