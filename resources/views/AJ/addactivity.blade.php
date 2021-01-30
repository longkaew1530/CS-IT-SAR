@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
  <div class="box-header">
    <div class="box-body">
    <a href="/category4/activity" class="btn btn-info fr"><i class='fa fa-eye'></i> ดูรายงาน</a>
      <div class="col-sm-2" align="right"></div>
      <div class="col-sm-8" align="center">
      
        <h3><i class=""></i>กิจกรรมการพัฒนาวิชาชีพของอาจารย์</h3>
        <hr>
      </div>
    </div>
    <form id="adddata" method="POST" action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data">
    @csrf
        <div class="col-md-12">
          <div class="box-header col-md-12 col-sm-9 col-xs-12">
            <h3 class="box-title">กิจกรรมที่จัดหรือเข้าร่วม</h3>
          </div>
            <div class="col-md-12 col-sm-9 col-xs-12">
              <textarea  id="editor5" name="organized_activities" rows="10" cols="80">
              </textarea>
            </div>
        </div>

        <div class="col-md-12">
          <div class="box-header col-md-12 col-sm-9 col-xs-12">
          </div>
            <div class="col-md-12 col-sm-9 col-xs-12">
            <label>
                      <input type="radio" name="status" id="optionsRadios1" value="1" checked="">
                      อาจารย์
                    </label>
                    <label>
                      <input type="radio" name="status" id="optionsRadios1" value="0" checked="">
                      บุคคลกรสายสนับสนุน
                    </label>
            </div>
        </div>
        <div class="col-md-12">
          <div class="box-header col-md-12 col-sm-9 col-xs-12">
            <h3 class="box-title">สรุปข้อคิดเห็น และประโยนช์ที่ผู้เข้าร่วมกิจกรรมได้รับ</h3>
          </div>
            <div class="col-md-12 col-sm-9 col-xs-12">
              <textarea  id="editor1" name="comment" rows="10" cols="80">
              </textarea>
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
    $('#adddata').submit(function(e) {
      e.preventDefault();
      for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
        }
      var formData = new FormData(this);
      $.ajax({
        type: 'POST',
        url: "/addactivity",
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
          window.location = "/category4/activity";
        });
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