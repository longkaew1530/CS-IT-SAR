@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl ">
  <div class="box-header">
    <h2 class="box-title">ข้อมูลผลงานวิจัย</h2>
  </div>
  <button class="btn btn-success ml-1" type="button" data-toggle="modal" data-target="#modal-info"><i class="fa fa-plus"></i> เพิ่มข้อมูล</button>
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
                    <label for="exampleInputPassword1">ชื่อผู้วิจัย</label>
                    <select class="form-control" id="owner" class="form-control @error('role') is-invalid @enderror" name="owner">
                      @foreach($userall as $value)
                      <option value="{{$value['id']}}">{{$value['user_fullname']}}</option>
                      @endforeach
                    </select>
                  </div>
                  
                  <div class="form-group">
                <label>ชื่อผู้ร่วมวิจัย</label>
                <select class="form-control select2" name="teacher_name[]" multiple="multiple" data-placeholder="Select a State"
                        style="width: 100%;">
                        @foreach($userall as $value)
                      <option value="{{$value['id']}}">{{$value['user_fullname']}}</option>
                      @endforeach
                </select>
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
                    <input type="hidden" class="form-control" id="id" name="id">
                  <div class="form-group">
                    <label for="exampleInputPassword1">ชื่อผู้วิจัย</label>
                    <select class="form-control" id="research_results_category" class="form-control @error('role') is-invalid @enderror" name="research_results_category">
                      @foreach($userall as $value)
                      <option value="{{$value['id']}}">{{$value['user_fullname']}}</option>
                      @endforeach
                    </select>
                  </div>
                  
                  <div class="form-group">
                <label>ชื่อผู้ร่วมวิจัย</label>
                <select class="form-control select2" id="select" name="teacher_name[]" multiple="multiple" data-placeholder="Select a State"
                        style="width: 100%;">
                        @foreach($userall as $value)
                      <option value="{{$value['id']}}">{{$value['user_fullname']}}</option>
                      @endforeach
                </select>
              </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">ประเภทผลงานวิจัย</label>
                    <select class="form-control" id="research_results_category1" class="form-control @error('role') is-invalid @enderror" name="research_results_category">
                      @foreach($category as $value)
                      <option value="{{$value['id']}}">{{$value['name']}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">ปีที่ทำวิจัย/ตีพิมพ์</label>
                    <input type="text" class="form-control" id="research_results_year1" name="research_results_year" placeholder="ปีที่จัดทำ">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">ชื่อผลงาน</label>
                    <input type="text" class="form-control" id="research_results_name1" name="research_results_name" placeholder="ชื่อผลงาน">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">รายละเอียด</label>
                    <textarea class="form-control" rows="3" placeholder="รายละเอียด" id="research_results_description1" name="research_results_description"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">งบประมาณ</label>
                    <input type="text" class="form-control" id="research_results_salary1" name="research_results_salary" placeholder="งบประมาณ">
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
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
   
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
      var studentSelect = $('#select');
      modal.find('#emp_id').val(id);
      var url = "/getresearch_results";
      $.get(url + '/' + id, function(data) {
        //success data
        $("#id").val(data[0].id);
        $("#research_results_year1").val(data[0].research_results_year);
        $("#research_results_category1").val(data[0].research_results_category);
        $("#research_results_name1").val(data[0].research_results_name);
        $("#research_results_description1").val(data[0].research_results_description);
        $("#research_results_salary1").val(data[0].research_results_salary);
        

        // var option = new Option(data[0].user_fullname,data[0].id,true, true);
        // studentSelect.append(option).trigger('change');
        // studentSelect.trigger({
        //     type: 'select2:select',
        //     params: {
        //         data: data
        //     }
        // });

        $('#select').select2({
        // ...
        templateSelection: function (data, container) {
          // Add custom attributes to the <option> tag for the selected option
          $(data.id).attr('data-custom-attribute', data.customValue);
          return data.text;
        }
      });

      // Retrieve custom attribute value of the first selected element
      // $('#mySelect2').find(':selected').data('custom-attribute');
      //   for (const [key, value] of Object.entries(data)) {
      //       var option = new Option(value.user_fullname, value.id,true, true);
      //   studentSelect.append(option).trigger('change');
      //   studentSelect.trigger({
      //       type: 'select2:select',
      //       params: {
      //           data: data
      //       }
      //   });
      //   }
        
        
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