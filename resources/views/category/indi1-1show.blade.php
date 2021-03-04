            <div class="box-header">
              <h1 class="box-title">การกำกับให้เป็นไปตามมาตรฐาน (เกณฑ์มาตรฐานหลักสูตร พ.ศ.2558)</h1>
              <br>
              <br><li><h4 class="box-title">การบริหารจัดการหลักสูตรตามเกณฑ์มาตรฐานหลักสูตรที่กำหนดโดย สกอ. (ตัวบ่งชี้ที่ 1.1)</h4><br></li>
              <br><br><li><h4 class="box-title">การบริหารจัดการหลักสูตรตามเกณฑ์มาตรฐานหลักสูตรที่กำหนดโดย สกอ. (ตัวบ่งชี้ที่ 1.1)</h4><br></li>
              <br><h4 class="box-title">1.จำนวนอาจารย์ผู้รับผิดชอบหลักสูตร</h4><br>
              <div class="checkbox">
                    <label>
                      <input type="checkbox"  @if($checknotpass) checked @endif>
                      ไม่เป็นไปตามเกณฑ์
                    </label>
              </div>
              <div class="checkbox">
                    <label>
                      <input type="checkbox"  @if($checkpass) checked @endif>
                      เป็นไปตามเกณฑ์ ดังนี้
                    </label>
              </div> 
              หลักสูตร{{$c}} มีอาจารย์ประจำหลักสูตรจำนวน {{$count}} คน 
              เป็นอาจารย์ผู้รับผิดชอบหลักสูตรเพียง 1 หลักสูตรเท่านั้น และอยู่ประจำหลักสูตรตลอดระยะเวลาที่จัดการศึกษาตามหลักสูตรดังนี้<br>
              @foreach($nameteacher as $key =>$value)
              
                <ul>{{($key + 1)}}. {{$value['user_fullname']}}</ul>
              
              @endforeach

              <br><h4 class="box-title">2.คุณสมบัติของอาจารย์ผู้รับผิดชอบหลักสูตร</h4><br>
              1. คุณวฒิระดับปริญญาโทหรือเทียบเท่า หรือดำรงตำแหน่งทางวิชาการไม่ต่ำกว่าผู้ช่วยศาสตราจารย์ในสาขาที่ตรงหรือสัมพันธ์กับสาขาที่เปิดสอน<br>
              2. มีผลงานทางวิชาการอย่างน้อย 1 รายการในรอบ 5 ปีย้อนหลัง <br>
              <div class="checkbox">
                    <label>
                      <input type="checkbox"  @if($checknotpass) checked @endif>
                      ไม่เป็นไปตามเกณฑ์
                    </label>
              </div>
              <div class="checkbox">
                    <label>
                      <input type="checkbox"  @if($checkpass) checked @endif>
                      เป็นไปตามเกณฑ์ ดังนี้
                    </label>
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
                    -{{$value['teacher_name']."(".$value['research_results_year']."). ".$value['research_results_name'].". ".$value['research_results_description']}}<br>
                  @endif
                  @endforeach
                  </td>
                </tr>
                <tr>
                @endforeach
              </tbody></table>
            </div>
              
                <h4><p class="bginfo"></p></h4>
                <div class="form-group ml-1">
                @foreach($row->educational_background as $value)
                      {{$value['eb_name']}}
                  @endforeach
          </div>

          <br><h4 class="box-title">3.คุณสมบัติของอาจารย์ประจำหลักสูตร(อาจารย์ประจำซึ่งมีหน้าที่สอนในสาขาวิชาของหลักสูตรที่เปิดสอน)</h4><br>
              1. คุณวฒิระดับปริญญาโทหรือเทียบเท่า หรือดำรงตำแหน่งทางวิชาการไม่ต่ำกว่าผู้ช่วยศาสตราจารย์ในสาขาที่ตรงหรือสัมพันธ์กับสาขาที่เปิดสอน<br>
              2. มีผลงานทางวิชาการอย่างน้อย 1 รายการในรอบ 5 ปีย้อนหลัง <br>
              3. ไม่จำกัดจำนวนและประจำได้มากกว่าหนึ่งหลักสูตร <br>
              <div class="checkbox">
                    <label>
                      <input type="checkbox"  @if($checknotpass) checked @endif>
                      ไม่เป็นไปตามเกณฑ์
                    </label>
              </div>
              <div class="checkbox">
                    <label>
                      <input type="checkbox"  @if($checkpass) checked @endif>
                      เป็นไปตามเกณฑ์ ดังนี้
                    </label>
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
                    -{{$value['teacher_name']."(".$value['research_results_year']."). ".$value['research_results_name'].". ".$value['research_results_description']}}<br>
                  @endif
                  @endforeach
                  </td>
                </tr>
                <tr>
                @endforeach
              </tbody></table>
            </div>
              
                <h4><p class="bginfo"></p></h4>
                <div class="form-group ml-1">
                @foreach($row->educational_background as $value)
                      {{$value['eb_name']}}
                  @endforeach
          </div>


          <br><h4 class="box-title">4.คุณสมบัติของอาจารย์ผู้สอน</h4><br>
              4.1คุณสมบัติของอาจารย์ผู้สอนที่เป็นอาจารย์ประจำ<br>
              1. คุณวฒิระดับปริญญาโทหรือเทียบเท่า หรือดำรงตำแหน่งทางวิชาการไม่ต่ำกว่าผู้ช่วยศาสตราจารย์ในสาขาที่ตรงหรือสัมพันธ์กับสาขาที่เปิดสอน<br>
              3. หากเป็นอาจารย์ผู้สอนก่อนเกณฑ์นี้ประกาศใช้ อนุโลมคุณวุฒิระดับปริญญาตรีได้<br>
              <div class="checkbox">
                    <label>
                      <input type="checkbox"  @if($checknotpass) checked @endif>
                      ไม่เป็นไปตามเกณฑ์
                    </label>
              </div>
              <div class="checkbox">
                    <label>
                      <input type="checkbox"  @if($checkpass) checked @endif>
                      เป็นไปตามเกณฑ์ ดังนี้
                    </label>
              </div> 
            <ins>ผลการดำเนินงาน</ins>
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th width="15%">รายชื่ออาจารย์</th>
                  <th width="30%">สาขาวิชาที่จบ</th>
                </tr>
                @foreach($instructor as $key =>$row )
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
              
                <h4><p class="bginfo"></p></h4>
                <div class="form-group ml-1">
                @foreach($row->educational_background as $value)
                      {{$value['eb_name']}}
                  @endforeach
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
          <br>ไม่มีอาจารย์พิเศษ<br><br><br>
          @endif

          <ins>ผลการประเมินตนเอง</ins>
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th width="30%">ตัวบ่งชี้</th>
                  <th width="20%">เป้าหมาย</th>
                  <th width="20%">ผลการดำเนินงาน</th>
                  <th width="20%">คะแนนอิงเกณฑ์ สกอ.</th>
                </tr>
                @foreach($inc as $key =>$row )
                <tr>
                  <td>ตัวบ่งชี้ที่{{$row['Indicator_id']." ".$row['Indicator_name']}}</td>             
                  <td>{{$row['target']}}</td>
                  <td>{{$row['performance']}}</td>
                  <td>{{$row['score']}}</td>
                </tr>
                <tr>
                @endforeach
              </tbody></table>
            </div>