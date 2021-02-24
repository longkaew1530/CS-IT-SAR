@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
  <div class="box-header">
    <div class="box-body">
      <div class="col-sm-2" align="right"></div>
      <div class="col-sm-8" align="center">
        <h3><i class=""></i>ข้อมูลนักศึกษา</h3>
        <hr>
      </div>
    </div>
    <form id="adddata" method="POST" action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data">
    @csrf
            <div class="box-body">
              <table class="table table-bordered text-center">
                <tbody><tr>
                  <th width="30%" >ปีการศึกษาที่รับเข้า</th>
                  <th width="5%">2556</th>
                  <th width="5%">2557</th>
                  <th width="5%">2558</th>
                  <th width="5%">2559</th>
                  <th width="5%">2560</th>
                  <th width="5%">2561</th>
                  <th width="5%">2562</th>
                <tr>

                            <td>2556</td>
                            <td><input type="text" class="wid10"></td>
                            <td><input type="text" class="wid10"></td>
                            <td><input type="text" class="wid10"></td>
                            <td><input type="text" class="wid10"></td>
                            <td><input type="text" class="wid10"></td>
                            <td><input type="text" class="wid10"></td>
                            <td><input type="text" class="wid10"></td>

                </tr>
                <tr>

                            <td>2557</td>
                            <td><input type="text" class="wid10"></td>
                            <td><input type="text" class="wid10"></td>
                            <td><input type="text" class="wid10"></td>
                            <td><input type="text" class="wid10"></td>
                            <td><input type="text" class="wid10"></td>
                            <td><input type="text" class="wid10"></td>
                            <td><input type="text" class="wid10"></td>

                </tr>
                </tr>
              </tbody></table>
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
  .wid10{
    width:50px;
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
      var formData = new FormData(this);
      $.ajax({
        type: 'POST',
        url: "/addinfostd",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: (data) => {
          if(data){
            swal({
          title: "เพิ่มข้อมูลเรียบร้อยแล้ว",
          text: "",
          icon: "success",
          button: "ตกลง",
        }).then(function() {
          window.location = "/category3/studentinfomation";
        });
          }
        },
        error: function(data) {
          alert(data.responseJSON.errors.files1[0]);
          console.log(data.responseJSON.errors);
        }
      });
    });
  });
  
</script>
@endsection