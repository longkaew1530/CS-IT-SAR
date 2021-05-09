            
            
            <div class="box-header">
            <div class="data">
        <div class="col-md-12">
        @if($checkedit!="")<a href="/getindicator1_1" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไขข้อมูล</a>@endif
              <h1 class="box-title">การกำกับให้เป็นไปตามมาตรฐาน (เกณฑ์มาตรฐานหลักสูตร พ.ศ.2558)</h1>
              <br>
              <br><li><h4 class="box-title">การบริหารจัดการหลักสูตรตามเกณฑ์มาตรฐานหลักสูตรที่กำหนดโดย สกอ. (ตัวบ่งชี้ที่ 1.1)</h4><br></li>
              <ins>เกณฑ์การประเมิน</ins>การบริหารจัดการหลักสูตรระดับปริญญาตรีเป็นไปตามตามเกณฑ์มาตรฐานหลักสูตรที่กำหนด โดย สกอ.
              <br><br><li><h4 class="box-title">การบริหารจัดการหลักสูตรตามเกณฑ์มาตรฐานหลักสูตรที่กำหนดโดย สกอ. (ตัวบ่งชี้ที่ 1.1)</h4><br></li>
              <br><h4 class="box-title">1.จำนวนอาจารย์ผู้รับผิดชอบหลักสูตร</h4><br>

              <div class="form-group">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox"   @if($result2) checked @endif disabled/>
                      ไม่เป็นไปตามเกณฑ์
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox"   @if($result1) checked @endif disabled/>
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
                  <div class="checkbox">
                    <label>
                      <input type="checkbox"   @if($result4) checked @endif disabled/>
                      ไม่เป็นไปตามเกณฑ์
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox"   @if($result3) checked @endif disabled/>
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
                  
                 
                  <td>@foreach($row->research_results as $value) 
                  @if($value['research_results_year']==$y
                     ||$value['research_results_year']==$y-1
                     ||$value['research_results_year']==$y-2
                     ||$value['research_results_year']==$y-3
                     ||$value['research_results_year']==$y-4)
                    -{{$value['teacher_name'].".(".$value['research_results_year']."). ".$value['research_results_name'].". ".$value['research_results_description']}}<br>
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
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="result1" id="result5"  @if($result2) checked @endif disabled/>
                      ไม่เป็นไปตามเกณฑ์
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="result1" id="result6"  @if($result1) checked @endif disabled/>
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
                  
                 
                  <td>@foreach($row->research_results as $value) 
                  @if($value['research_results_year']==$y
                     ||$value['research_results_year']==$y-1
                     ||$value['research_results_year']==$y-2
                     ||$value['research_results_year']==$y-3
                     ||$value['research_results_year']==$y-4)
                    -{{$value['teacher_name'].".(".$value['research_results_year']."). ".$value['research_results_name'].". ".$value['research_results_description']}}<br>
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
                  <div class="checkbox">
                    <label>
                      <input type="checkbox"   @if($result8) checked @endif disabled/>
                      ไม่เป็นไปตามเกณฑ์
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox"   @if($result7) checked @endif disabled/>
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
                  <div class="checkbox">
                    <label>
                      <input type="checkbox"   @if($result10) checked @endif disabled/>
                      ไม่เป็นไปตามเกณฑ์
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox"   @if($result9) checked @endif disabled/>
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
                @if(isset($inc[0]['target']))
                @foreach($inc as $key =>$row )
                <tr >
                  <td rowspan="2">ตัวบ่งชี้ที่ {{$row['Indicator_id']." ".$row['Indicator_name']}}</td>           
                  <td rowspan="2">{{$row['target']}}</td>
                  
                  <td rowspan="2">{{$row['performance3']}}</td>
                  <td rowspan="2">
                  {{$row['score']}}</td>
                </tr>

                <tr>
                @endforeach
                @else
                <tr>
                  <td rowspan="2">ตัวบ่งชี้ที่ {{$id}} {{$name}}</td>           
                  <td rowspan="2"></td>
                  <td rowspan="2"></td>
                  <td rowspan="2">@if($checkedit!="")<a href="/getself_assessment_results/1.1" class="btn btn-success fr ml-1"><i class='fa fa-plus'></i> เพิ่ม</a>@endif</td>
                  
                </tr>
                <tr>
                @endif
              </tbody></table>
            </div>
            </div>
            </div>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }); 
    $('.set').click(function(e){
      var token = $('meta[name="csrf-token"]').attr('content');
      var id = $(this).attr('id');
      var gender = $(this).val(); 
      document.getElementById(id).checked = true;
        e.preventDefault();

        // $.ajax({
        //    type:'PUT',
        //    url:'/nextyear',
        //    data: {
        //   _token : token 
        // },
        //    success:function(data){
        //     swal({
        //       title: "เพิ่มข้อมูลเรียบร้อยแล้ว",
        //     text: "",
        //     icon: "success",
        //     button: "ตกลง",
        //    }).then(function() {
        //       window.location = "/";
        //    });
        //    }
        // });
	});
  function calc2(id)
{
  var token = $('meta[name="csrf-token"]').attr('content');
  var  cb = document.getElementById(id);
  var txtboxname = cb.name;
  var getvalue=0;
  if (id=="result1"||id=="result3"||id=="result5"||id=="result7"||id=="result9"){
    getvalue=1;
  } else {
    getvalue=2;
  }
  

        swal({
      title: "ยืนยันการบันทึก?",
      icon: "warning",
      buttons: true,
      successMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
           type:'POST',
           url:'/addresultindicator1_1',
           data: {
          _token : token,
           value:getvalue,
           name:txtboxname,
        },
           success:function(data){
            swal({
              title: "บันทึกข้อมูลเรียบร้อย",
            text: "",
            icon: "success",
            button: "ตกลง",
           }).then(function() {
              
           });
           }
        });
      } else {
        
      }
    });
}
</script>