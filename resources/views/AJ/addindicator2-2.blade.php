@extends('layout.admid_layout')
@section('content')
<div class="box box-warning ">
  <div class="box-header">
    <div class="box-body">
    <div class="col-sm-2" align="right"></div>
      <div class="col-sm-8" align="center">
      <h3><i class=""></i>ร้อยละของบัณฑิตที่ได้งานทำหรือประกอบอาชีพอิสระภายใน 1 ปี</h3><hr>
      </div>
    </div>
    <form id="adddata" method="POST" action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data">
    @csrf
    <div class="data">
        <div class="col-md-12">
        <div class="box-header col-md-12 col-sm-9 col-xs-12">
            <h3 class="box-title">ผลการดำเนินงาน</h3>
          </div>
    <div id="body">
    <div class="col-md-12 col-sm-9 col-xs-12">
    <table class="table table-bordered m-3">
                <tbody><tr>
                  <th width="70%" class="text-center">ข้อมูลพื้นฐาน</th>
                  <th width="15%" class="text-center">จำนวน</th>
                  <th width="15%" class="text-center">ร้อยละ</th>
                </tr>
                <tr>
                <td>จำนวนบัณทิตทั้งหมด</td>
                <td><input type="text" class="form-control" id="total" name="total" /></td>
                <td><input type="text" class="form-control" id="totalpersen" name="totalpersen" /></td>
                </tr>
                <tr>
                <td>จำนวนบัณฑิตที่ตอบแบบสำรวจ</td>
                <td><input type="text" class="form-control" id="answer" name="answer" /></td>
                <td><input type="text" class="form-control" id="answerpersen" name="answerpersen" /></td>
                </tr>
                <tr>
                <td>จำนวนบัณฑิตที่ได้งานทำหลังสำเร็จการศึกษา</td>
                <td><input type="text" class="form-control" id="job" name="job" /></td>
                <td><input type="text" class="form-control" id="jobpersen" name="jobpersen" /></td>
                </tr>
                <tr>
                <td>ตรงสาขาที่เรียน</td>
                <td><input type="text" class="form-control" id="straight_line" name="straight_line" /></td>
                <td><input type="text" class="form-control" id="straight_linepersen" name="straight_linepersen" /></td>
                </tr>
                <tr>
                <td>ไม่ตรงสาขาที่เรียน</td>
                <td><input type="text" class="form-control" id="not_straight_line" name="not_straight_line" /></td>
                <td><input type="text" class="form-control" id="not_straight_linepersen" name="not_straight_linepersen" /></td>
                </tr>
                <tr>
                <td>จำนวนบัณฑิตที่ประกอบอาชีพอิสระ</td>
                <td><input type="text" class="form-control" id="freelance" name="freelance" /></td>
                <td><input type="text" class="form-control" id="freelancepersen" name="freelancepersen" /></td>
                </tr>
                <tr>
                <td>จำนวนผู้สำเร็จการศึกษาที่มีงานทำก่อนเข้าศึกษา</td>
                <td><input type="text" class="form-control" id="before" name="before" /></td>
                <td><input type="text" class="form-control" id="beforepersen" name="beforepersen" /></td>
                </tr>
                <tr>
                <td>จำนวนบัณฑิตที่ศึกษาต่อ</td>
                <td><input type="text" class="form-control" id="continue_study" name="continue_study" /></td>
                <td><input type="text" class="form-control" id="continue_studypersen" name="continue_studypersen" /></td>
                </tr>
                <tr>
                <td>จำนวนบัณฑิตที่อุปสมบท</td>
                <td><input type="text" class="form-control" id="ordain" name="ordain" /></td>
                <td><input type="text" class="form-control" id="ordainpersen" name="ordainpersen" /></td>
                </tr>
                <tr>
                <td>จำนวนบัณฑิตที่เกณฑ์ทหาร</td>
                <td><input type="text" class="form-control" id="soldier" name="soldier" /></td>
                <td><input type="text" class="form-control" id="soldierpersen" name="soldierpersen" /></td>
                </tr>
                <tr>
                <td>จำนวนบัณฑิตที่ไม่มีงานทำ</td>
                <td><input type="text" class="form-control" id="unemployed" name="unemployed" /></td>
                <td><input type="text" class="form-control" id="unemployedpersen" name="unemployedpersen" /></td>
                </tr>
              </tbody></table>
            </div>
              <div class="box-header col-md-12 col-sm-9 col-xs-12">
            <h3 class="box-title">การวิเคราะห์ผลที่ได้</h3>
            </div>
              <div id="body">
            <div class="col-md-12 col-sm-9 col-xs-12">
            
              <textarea id="editor1" name="result" rows="10" cols="80">
              </textarea>
            </div>
          </div>
          </div>
          </div>
          </div>
          <div class="data">
        <div class="col-md-12">
          <div class="box-header col-md-12 col-sm-9 col-xs-12">
            <h3 class="box-title">ผลการประเมินตนเอง</h3>
          </div>
          <div id="body">
            <div class="col-md-12 col-sm-9 col-xs-12">
            <table class="table table-bordered text-center">
                <tbody><tr>
                  <th width="30%" >ตัวบ่งชี้</th>
                  <th width="10%">เป้าหมาย</th>
                  @if($per1!=null)
                      <th colspan="2" width="10%">ผลการดำเนินงาน</th>
                  @else
                      <th  width="10%">ผลการดำเนินงาน</th>
                  @endif
                  <th width="10%">คะแนนอิงเกณฑ์ สกอ.</th>
                </tr>
                @foreach($pdca as $row)
                <input type="hidden" class="form-control" id="Indicator_id" name="Indicator_id" value="{{$row['Indicator_id']}}"/>
                <tr>
                  <td rowspan="2">ตัวบ่งชี้ที่ {{$row['Indicator_id']}} {{$row['Indicator_name']}}</td>           
                  <td rowspan="2"><input type="text" class="form-control text-center" name="target" ></td>
                  @if($per1!=null)
                    <td ><input type="text" class="form-control text-center" id="performance1" name="performance1"  readonly></td></td>
                  @endif  
                  <td rowspan="2"><input type="text" class="form-control text-center" id="performance3" name="performance3"  readonly></td>
                  <td rowspan="2"><input type="text" class="form-control text-center" id="score"  name="score"  readonly></td>
                </tr>
                <tr>
                @if($per1!=null)
                    <td ><input type="text" class="form-control text-center" id="performance2" name="performance2"  readonly></td></td>
                  @endif  
                </tr>
                <tr>
                @endforeach
              </tbody></table>

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
        url: "/addindicator2_2",
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
          if(data.category_factor=="ปัจจัยที่มีผลกระทบต่อจำนวนนักศึกษา"){
            window.location = "/category3/Impactfactors";
          }
          else{
            window.location = "/category3/indicator2-2";
          }
        });
        },
        error: function(data) {
          alert(data.responseJSON.errors.files[0]);
          console.log(data.responseJSON.errors);
        }
      });
    });
  });
</script>
@endsection