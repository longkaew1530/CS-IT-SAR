@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
            <div class="box-header">
            <div class="data">
        <div class="col-md-12">
              <h1 class="box-title">การกำกับให้เป็นไปตามมาตรฐาน (เกณฑ์มาตรฐานหลักสูตร พ.ศ.2558)</h1>
              <br>
              <br><li><h4 class="box-title">การบริหารจัดการหลักสูตรตามเกณฑ์มาตรฐานหลักสูตรที่กำหนดโดย สกอ. (ตัวบ่งชี้ที่ 1.1)</h4><br></li>
              <ins>เกณฑ์การประเมิน</ins>การบริหารจัดการหลักสูตรระดับปริญญาตรีเป็นไปตามตามเกณฑ์มาตรฐานหลักสูตรที่กำหนด โดย สกอ.
              <br><br><li><h4 class="box-title">การบริหารจัดการหลักสูตรตามเกณฑ์มาตรฐานหลักสูตรที่กำหนดโดย สกอ. (ตัวบ่งชี้ที่ 1.1)</h4><br></li>
              <br><h4 class="box-title">1.จำนวนอาจารย์ผู้รับผิดชอบหลักสูตร</h4><br>
              <form id="adddata" method="POST" action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data">
                @csrf
              <input type="hidden" class="form-control" id="id" name="id" value="{{$get1_1[0]['id']}}"/>
              <div class="form-group">
                  <div class="radio">
                    <label>
                      <input type="radio" name="result1" id="result1"  value="1" @if($result2) checked @endif>
                      ไม่เป็นไปตามเกณฑ์
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" name="result1" id="result2"  value="2" @if($result1) checked @endif>
                            เป็นไปตามเกณฑ์ ดังนี้
                    </label>
                  </div>
                </div>

              หลักสูตร{{$c}} มีอาจารย์ประจำหลักสูตรจำนวน {{$count}} คน 
              เป็นอาจารย์ผู้รับผิดชอบหลักสูตรเพียง 1 หลักสูตรเท่านั้น และอยู่ประจำหลักสูตรตลอดระยะเวลาที่จัดการศึกษาตามหลักสูตรดังนี้<br>
              @foreach($nameteacher as $key =>$value)
              
                <ul>{{($key + 1)}}. {{$value['user_fullname']}}</ul>
              
              @endforeach

              <br><h4 class="box-title">2.คุณสมบัติของอาจารย์ผู้รับผิดชอบหลักสูตร</h4><br>
              1. คุณวฒิระดับปริญญาโทหรือเทียบเท่า หรือดำรงตำแหน่งทางวิชาการไม่ต่ำกว่าผู้ช่วยศาสตราจารย์ในสาขาที่ตรงหรือสัมพันธ์กับสาขาที่เปิดสอน<br>
              2. มีผลงานทางวิชาการอย่างน้อย 1 รายการในรอบ 5 ปีย้อนหลัง <br>
              <div class="form-group">
                  <div class="radio">
                    <label>
                      <input type="radio" name="result2" id="result3" value="1"  @if($result4) checked @endif>
                      ไม่เป็นไปตามเกณฑ์
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" name="result2" id="result4" value="2" @if($result3) checked @endif>
                            เป็นไปตามเกณฑ์ ดังนี้
                    </label>
                  </div>
                </div> 
              
            <ins>ผลการดำเนินงาน</ins>
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th width="15%">ชื่อ-สกุล</th>
                  <th width="30%">สาขาวิชาที่จบ</th>
                  <th width="40%">ผลงานทางวิชาการในรอบ 5 ปี<br>(พ.ศ.{{$y-4}}-{{$y}})</th>
                </tr>
                @foreach($educ_bg as $key =>$row )
                <tr>
                  <td>{{($key + 1)}}. {{$row['user_fullname']}}</td>
                                
                  <td>
                  @foreach($row->educational_background as $value) 
                  {{$value['abbreviations']." (".$value['eb_fieldofstudy'].")"}}<br>
                  @endforeach
                  </td>
                  
                 
                  <td>@foreach($row->publish_work as $value) 
                  @if($value['publish_work_year']==$y
                     ||$value['publish_work_year']==$y-1
                     ||$value['publish_work_year']==$y-2
                     ||$value['publish_work_year']==$y-3
                     ||$value['publish_work_year']==$y-4)
                     @if($value['category']==1)
                    -{{$value['teacher_name'].".(".($value['publish_work_year']).") ".$value['publish_work_name'].". ".$value['journal_name']." ".$value['publish_work_issue']." (".$value['publish_work_yearshow'].") ".$value['publish_work_page']}}<br>
                    @else
                    @if($value['publish_work_date']!=1)
                    -{{$value['teacher_name'].".(".($value['publish_work_year']).") ".$value['publish_work_name']." ".$value['journal_name'].". ".$value['publish_work_date']." ".$value['publish_work_place'].", ".$value['province'].". ".$value['country']." ".$value['publish_work_page']."."}}<br>
                    @else
                    -{{$value['teacher_name'].".(".($value['publish_work_year']).") ".$value['publish_work_name']." ".$value['journal_name'].". ".$value['province'].". ".$value['country']." ".$value['publish_work_page']."."}}<br>
                    @endif
                    @endif
                  @endif
                  @endforeach
                  </td>
                </tr>
                <tr>
                @endforeach
              </tbody></table>
            </div>

          <br><h4 class="box-title">3.คุณสมบัติของอาจารย์ประจำหลักสูตร(อาจารย์ประจำซึ่งมีหน้าที่สอนในสาขาวิชาของหลักสูตรที่เปิดสอน)</h4><br>
              1. คุณวฒิระดับปริญญาโทหรือเทียบเท่า หรือดำรงตำแหน่งทางวิชาการไม่ต่ำกว่าผู้ช่วยศาสตราจารย์ในสาขาที่ตรงหรือสัมพันธ์กับสาขาที่เปิดสอน<br>
              2. มีผลงานทางวิชาการอย่างน้อย 1 รายการในรอบ 5 ปีย้อนหลัง <br>
              3. ไม่จำกัดจำนวนและประจำได้มากกว่าหนึ่งหลักสูตร <br>
            
              <div class="form-group">
                  <div class="radio">
                    <label>
                      <input type="radio" name="result3" id="result5" value="1" @if($result6) checked @endif>
                      ไม่เป็นไปตามเกณฑ์
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" name="result3" id="result6" value="2" @if($result5) checked @endif>
                            เป็นไปตามเกณฑ์ ดังนี้
                    </label>
                  </div>
                </div>
              
            <ins>ผลการดำเนินงาน</ins>
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th width="15%">ชื่อ-สกุล</th>
                  <th width="30%">สาขาวิชาที่จบ</th>
                  <th width="40%">ผลงานทางวิชาการในรอบ 5 ปี<br>(พ.ศ.{{$y-4}}-{{$y}})</th>
                </tr>
                @foreach($tc_course as $key =>$row )
                <tr>
                  <td>{{($key + 1)}}. {{$row['user_fullname']}}</td>
                                
                  <td>
                  @foreach($row->educational_background as $value) 
                  {{$value['abbreviations']." (".$value['eb_fieldofstudy'].")"}}<br>
                  @endforeach
                  </td>
                  
                 
                  <td>@foreach($row->publish_work as $value) 
                  @if($value['publish_work_year']==$y
                     ||$value['publish_work_year']==$y-1
                     ||$value['publish_work_year']==$y-2
                     ||$value['publish_work_year']==$y-3
                     ||$value['publish_work_year']==$y-4)
                     @if($value['category']==1)
                    -{{$value['teacher_name'].".(".($value['publish_work_year']).") ".$value['publish_work_name'].". ".$value['journal_name']." ".$value['publish_work_issue']." (".$value['publish_work_yearshow'].") ".$value['publish_work_page']}}<br>
                    @else
                    @if($value['publish_work_date']!=1)
                    -{{$value['teacher_name'].".(".($value['publish_work_year']).") ".$value['publish_work_name']." ".$value['journal_name'].". ".$value['publish_work_date']." ".$value['publish_work_place'].", ".$value['province'].". ".$value['country']." ".$value['publish_work_page']."."}}<br>
                    @else
                    -{{$value['teacher_name'].".(".($value['publish_work_year']).") ".$value['publish_work_name']." ".$value['journal_name'].". ".$value['province'].". ".$value['country']." ".$value['publish_work_page']."."}}<br>
                    @endif
                    @endif
                  @endif
                  @endforeach
                  </td>
                </tr>
                <tr>
                @endforeach
              </tbody></table>
            </div>
              
               


          <br><h4 class="box-title">4.คุณสมบัติของอาจารย์ผู้สอน</h4><br>
              4.1คุณสมบัติของอาจารย์ผู้สอนที่เป็นอาจารย์ประจำ<br>
              1. คุณวฒิระดับปริญญาโทหรือเทียบเท่า หรือดำรงตำแหน่งทางวิชาการไม่ต่ำกว่าผู้ช่วยศาสตราจารย์ในสาขาที่ตรงหรือสัมพันธ์กับสาขาที่เปิดสอน<br>
              3. หากเป็นอาจารย์ผู้สอนก่อนเกณฑ์นี้ประกาศใช้ อนุโลมคุณวุฒิระดับปริญญาตรีได้<br>
            
              <div class="form-group">
                  <div class="radio">
                    <label>
                      <input type="radio" name="result4" id="result7" value="1" @if($result8) checked @endif>
                      ไม่เป็นไปตามเกณฑ์
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" name="result4" id="result8" value="2" @if($result7) checked @endif>
                            เป็นไปตามเกณฑ์ ดังนี้
                    </label>
                  </div>
                </div> 
             
            <ins>ผลการดำเนินงาน</ins>
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                <th width="5%">ที่</th>
                  <th width="25%">รายชื่ออาจารย์</th>
                  <th width="50%">สาขาวิชาที่จบ</th>
                </tr>
                @foreach($instructor as $key =>$row )
                <tr>
                <td>{{($key + 1)}}</td>
                  <td>{{$row['user_fullname']}}</td>             
                  <td>
                  @foreach($row->educational_background as $value) 
                  {{$value['abbreviations']." (".$value['eb_fieldofstudy'].")"}}<br>
                  @endforeach
                  </td>
                </tr>
                <tr>
                @endforeach
              </tbody></table>
            </div>
              

                
              4.2คุณสมบัติของอาจารย์ผู้สอนที่เป็นอาจารย์ประจำ<br>
              1) คุณวฒิระดับปริญญาโทหรือเทียบเท่า หรือคุณวุฒิปริญญาตรีหรือเทียบเท่า<br>
              2) มีประสบการณ์ทำงานเกี่ยวข้องกับวิชาที่สอนไม่น้อยกว่า 6 ปี<br>
              3) มีชั่วโมงสอนไม่เกินร้อยละ 50 ของรายวิชา โดยมีอาจารย์ประจำเป็นผู้รับผิดชอบรายวิชานั้น<br>
            </div>
            
            @if($specialinstructor==[])
            <div class="box-body">
            <ins>ผลการดำเนินงาน</ins>
              <table class="table table-bordered">
                <tbody><tr>
                  <th width="15%">รายชื่ออาจารย์</th>
                  <th width="30%">สาขาวิชาที่จบ</th>
                </tr>
                @foreach($specialinstructor as $key =>$row )
                <tr>
                  <td>{{($key + 1)}}.{{$row['user_fullname']}}</td>             
                  <td>
                  @foreach($row->educational_background as $value) 
                  {{$value['abbreviations']." (".$value['eb_fieldofstudy'].")"}}<br>
                  @endforeach
                  </td>
                </tr>
                <tr>
                @endforeach
              </tbody></table>
            </div>
          </div>
          @else
          <div class="box-body">
          <br><b>ไม่มีอาจารย์พิเศษ</b><br><br>
          </div>
          @endif
          <div class="box-body">
          <br><h4 class="box-title">10.การปรับปรุงหลักสูตรตามรอบระยะเวลาที่กำหนด</h4>
          
              <div class="form-group">
                  <div class="radio">
                    <label>
                      <input type="radio" name="result5" id="result9" value="1" @if($result10) checked @endif>
                      ไม่เป็นไปตามเกณฑ์
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" name="result5" id="result10" value="2" @if($result9) checked @endif>
                            เป็นไปตามเกณฑ์ ดังนี้
                    </label>
                  </div>
                </div>
             
              </div>
            <div class="box-body">
            <ins>ผลการประเมินตนเอง</ins>
            <div class="box-body">
              <table class="table table-bordered text-center">
                <tbody><tr>
                  <th width="30%" >ตัวบ่งชี้</th>
                  <th width="20%">เป้าหมาย</th>
                  <th  width="20%">ผลการดำเนินงาน</th>
                  <th width="20%">คะแนนอิงเกณฑ์ สกอ.</th>
                </tr>
                @foreach($inc as $row)
                <tr >
                <input type="hidden" class="form-control" id="indicator_id" name="Indicator_id" value="{{$row['pdca_id']}}"/>
                  <td rowspan="2">ตัวบ่งชี้ที่ 1.1 การบริหารจัดการหลักสูตรตามเกณฑ์มาตรฐานหลักสูตรที่กำหนดโดย สกอ.</td>           
                  <td rowspan="2"><div class="form-group">
                                  <select class="form-control"  id="target"  class="form-control @error('role') is-invalid @enderror" name="target">
                                    <option value="ผ่านมาตรฐาน" <?php if($row['target']=="ผ่านมาตรฐาน"){ print ' selected'; }?>>ผ่านมาตรฐาน</option>
                                    <option value="ไม่ผ่านมาตรฐาน" <?php if($row['target']=="ไม่ผ่านมาตรฐาน"){ print ' selected'; }?>>ไม่ผ่านมาตรฐาน</option>
                                  </select>
                                  </div></td>
                  
                  <td rowspan="2"><div class="form-group">
                                  <select class="form-control"  id="performance3"  class="form-control @error('role') is-invalid @enderror" name="performance3">
                                    <option value="ผ่านมาตรฐาน" <?php if($row['performance3']=="ผ่านมาตรฐาน"){ print ' selected'; }?>>ผ่านมาตรฐาน</option>
                                    <option value="ไม่ผ่านมาตรฐาน" <?php if($row['performance3']=="ไม่ผ่านมาตรฐาน"){ print ' selected'; }?>>ไม่ผ่านมาตรฐาน</option>
                                  </select>
                                  </div></td>
                  <td rowspan="2">
              
                <div class="form-group">
                                  <select class="form-control"  id="score"  class="form-control @error('role') is-invalid @enderror" name="score">
                                    <option value="ผ่านมาตรฐาน" <?php if($row['score']=="ผ่านมาตรฐาน"){ print ' selected'; }?>>ผ่านมาตรฐาน</option>
                                    <option value="ไม่ผ่านมาตรฐาน" <?php if($row['score']=="ไม่ผ่านมาตรฐาน"){ print ' selected'; }?>>ไม่ผ่านมาตรฐาน</option>
                                  </select>
                                  </div></td>
                </tr>

                <tr>
               @endforeach
              </tbody></table>
              <div class="col-md-12">
        <div id="body">
          <div class="col-md-12 col-sm-9 col-xs-12">
            <hr>
            <button type="submit" class="btn btn-info pull-right">บันทึกข้อมูล</button>
            </textarea>
          </div>
</form>
        </div>
      </div>
            </div>
            </div>
            </div>
</div>


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
        url: "/updateindicator1_1",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: (data) => {
          swal({
          title: "แก้ไขข้อมูลเรียบร้อย",
          text: "",
          icon: "success",
          button: "ตกลง",
        }).then(function() {
          window.location = "/category1/indicator1-1";
        });
        },
        error: function(data) {
          swal({
          title: "เอกสารอ้างอิงไม่ถูกต้อง",
          text: "",
          icon: "error",
          showConfirmButton: false,
        });
          alert(data.responseJSON.errors.files[0]);
          console.log(data.responseJSON.errors);
        }
      });
      } else {
        
      }
    });
    });
  });
</script>
@endsection