@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl" id="exportContent">
<div class="box-header" >
              <h3 class="text-center">หมวดที่4 ข้อมูลผลการเรียนรายวิชาของหลักสูตรและคุณภาพการสอนในหลักสูตร</h3><br>
              @if($check2==1)
              <div class="box-body">
            @if($checkedit!="")<a href="/getcourse_results" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไขข้อมูล</a>@endif
            <b><h4>สรุปผลรายวิชาที่เปิดสอนในภาค/ปีการศึกษา</h4></b>
              <table class="table table-bordered" >
                <tbody><tr>
                  <th width="25%" class="text-center" rowspan="3">รหัส ชื่อวิชา</th>
                  <th width="10%" class="text-center" rowspan="3">ภาค/ปีการศึกษา</th>
                  <th width="50%" class="text-center" colspan="7">การกระจายของระดับคะแนน(ร้อยละ)</th>
                  <th width="15%" class="text-center" colspan="2">จำนวนนักศึกษา</th>
                </tr>
                <tr>
                <th width="10%" class="text-center" rowspan="2">A</th>
                <th width="10%" class="text-center" rowspan="2">B+</th>
                <th width="10%" class="text-center" rowspan="2">B</th>
                <th width="10%" class="text-center" rowspan="2">C+</th>
                <th width="10%" class="text-center" rowspan="2">C</th>
                <th width="10%" class="text-center" rowspan="2">D</th>
                <th width="10%" class="text-center" rowspan="2">F</th>
                <th width="10%" class="text-center" rowspan="2">ลงทะเบียน</th>
                <th width="10%" class="text-center" rowspan="2">สอบผ่าน</th>
                </tr>
                <tr></tr>
                @if($ccr!="[]")
                @foreach($ccr as $key=>$value)
                @if($key>0)
              <tr>
                  <td>
                  {{$value['course_name']}}
                  </td>
                  <td class="text-center">{{$value['term_year']}}</td>
                  <td class="text-center">{{$value['a']}}</td>
                  <td class="text-center">{{$value['BB']}}</td>
                  <td class="text-center">{{$value['b']}}</td>
                  <td class="text-center">{{$value['CC']}}</td>
                  <td class="text-center">{{$value['c']}}</td>
                  <td class="text-center">{{$value['d']}}</td>
                  <td class="text-center">{{$value['f']}}</td>
                  <td class="text-center">{{$value['register']}}</td>
                  <td class="text-center">{{$value['pass_exam']}}</td>
              </tr>
              @endif
              @endforeach
              @else
              <tr>
                  <td>
                  -
                  </td>
                  <td class="text-center">-</td>
                  <td class="text-center">-</td>
                  <td class="text-center">-</td>
                  <td class="text-center">-</td>
                  <td class="text-center">-</td>
                  <td class="text-center">-</td>
                  <td class="text-center">-</td>
                  <td class="text-center">-</td>
                  <td class="text-center">-</td>
                  <td class="text-center">-</td>
              </tr>
              @endif
              </tbody></table>
            </div>
            @endif
            @if($check4==1)
            <div class="box-body">
            @if($checkedit!="")<a href="/getnot_offered" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไขข้อมูล</a>@endif
            <h4>รายวิชาที่ไม่ได้เปิดสอนในปีการศึกษา</h4></b>
            <table class="table table-bordered" >
                <tbody><tr>
                  <th width="20%" class="text-center">รหัส ชื่อวิชา</th>
                  <th width="20%" class="text-center">ภาค/ปีการศึกษา</th>
                  <th width="20%" class="text-center">เหตุผลที่ไม่เปิดสอน</th>
                  <th width="20%" class="text-center">มาตรการที่ดำเนิน</th>
                </tr>
                @if($ccr2!="[]")
                @foreach($ccr2 as $value)
              <tr>
                <td>{{$value['code_name']}}
                </td>
                <td>{{$value['term']}}
                </td>
                <td>{{$value['topic']}}
                </td>
                <td>{{$value['plan_update']}}
                </td>
              </tr>
              @endforeach
              @else
              <tr>
                <td>-
                </td>
                <td>-
                </td>
                <td>-
                </td>
                <td>-
                </td>
              </tr>
              @endif
              </tbody></table>
              </div> 
              @endif
              @if($check5_1==1)
              <br> <div class="box-body">
              <h1 class="box-title">{{$name5_1}} (ตัวบ่งชี้ที่ {{$id5_1}})</h1>
              <br>
              <ins>เกณฑ์การประเมิน</ins>
              <ul>-มีระบบ มีกลไกล</ul>
              <ul>-มีการนำระบบกลไกสู่การปฏิบัติ/ดำเนินงาน</ul>
              <ul>-มีการประเมินกระบวนการ</ul>
              <ul>-มีการปรับปรุง/พัฒนากระบวนการจากผลการประเมิน</ul>
              <ul>-มีผลจากการปรับปรุงเห็นชัดเจนเป็นรูปธรรม</ul>
              <ul>-มีแนวทางปฏิบัติที่ดี โดยมีหลักฐานเชิงประจักษ์ยืนยัน และกรรมการผู้ตรวจประเมินสามารถให้เหตุผลอธิบายการเป็นแนวปฏิบัติที่ดีได้ชัดเจน</ul>
              
              <br><ins>ผลการดำเนินงาน</ins>
            
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th width="60%">ประเด็นอธิบาย</th>
                  <th width="30%">หลักฐานอ้างอิง</th>
                </tr>
                @foreach($getcategorypdca5_1 as $key=>$value)
                
                <tr>
                @foreach($value->Categorypdca as $row)
                  <td><b>{{$row['category_name']}}</b><br>
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbspหลักสูตร{{$getcourse5_1[0]['course_name']}} สาขา{{$getbranch[0]['name']}}  มีการนำระบบกลไกในการ{{$row['category_name']}}
                  โดยใช้กระบวนการ PDCA เป็นพื้นฐานและมีผลการดำเนินงานในปีการศึกษา {{ Session::get('year')}} ดังนี้ <br><br><br>
                  @if(count($row->pdca)!=0)
                  @foreach($row->pdca as $row1)
                  @if($row1['p']!=null&&$checkedit!="")<a href="/getp/{{$row1['pdca_id']}}" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไข</a>
                  @else
                  @if($checkedit!="")<a href="/addp/{{$row['id']}}" class="btn btn-success fr"><i class='fa fa-plus'></i> เพิ่ม</a>@endif
                  @endif
                  <ins><b>ขั้นตอนการวางแผน (P)</b></ins><br>
                  {!!$row1['p']!!}<br><br>
                  @if($row1['d']!=null&&$checkedit!="")<a href="/getd/{{$row1['pdca_id']}}" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไข</a>
                  @else
                  @if($checkedit!="")<a href="/addd/{{$row['id']}}" class="btn btn-success fr"><i class='fa fa-plus'></i> เพิ่ม</a>@endif
                  @endif
                  <ins><b>การดำเนินงานตามแผน (D)</b></ins><br>
                  {!!$row1['d']!!}</b><br><br>
                  @if($row1['c']!=null&&$checkedit!="")<a href="/getc/{{$row1['pdca_id']}}" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไข</a>
                  @else
                  @if($checkedit!="")<a href="/addc/{{$row['id']}}" class="btn btn-success fr"><i class='fa fa-plus'></i> เพิ่ม</a>@endif
                  @endif
                  <ins><b>การประเมินกระบวนการ (C)</b></ins><br>
                  {!!$row1['c']!!}</b><br><br>
                  @if($row1['a']!=null&&$checkedit!="")<a href="/geta/{{$row1['pdca_id']}}" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไข</a>
                  @else
                  @if($checkedit!="")<a href="/adda/{{$row['id']}}" class="btn btn-success fr"><i class='fa fa-plus'></i> เพิ่ม</a>@endif
                  @endif
                  <ins><b>การปรับปรุง/พัฒนา/บูรณาการกระบวนการจากผลการประเมิน (A)</b></ins><br>
                  {!!$row1['a']!!}</b><br><br>
                  </td>
                  <td>
                  @foreach($row1->docpdca as $key2 =>$row2)
                  {{$value['composition_id']}}.{{$id5_1}}-{{$key2+1}} {{$row2['doc_file']}}<br>
                  @endforeach
                  </td> 
                  @endforeach
                  @else
                  @if($checkedit!="")<a href="/addp/{{$row['id']}}" class="btn btn-success fr"><i class='fa fa-plus'></i> เพิ่ม</a>@endif
                  <ins><b>ขั้นตอนการวางแผน (P)</b></ins><br>
                  <br><br>
                  @if($checkedit!="")<a href="/addd/{{$row['id']}}" class="btn btn-success fr"><i class='fa fa-plus'></i> เพิ่ม</a>@endif
                  <ins><b>การดำเนินงานตามแผน (D)</b></ins><br>
                  <br><br>
                  @if($checkedit!="")<a href="/addc/{{$row['id']}}" class="btn btn-success fr"><i class='fa fa-plus'></i> เพิ่ม</a>@endif
                  <ins><b>การประเมินกระบวนการ (C)</b></ins><br>
                  <br><br>
                  @if($checkedit!="")<a href="/adda/{{$row['id']}}" class="btn btn-success fr"><i class='fa fa-plus'></i> เพิ่ม</a>@endif
                  <ins><b>การปรับปรุง/พัฒนา/บูรณาการกระบวนการจากผลการประเมิน (A)</b></ins><br>
                  <br><br>
                  </td> 
                  <td>
                  </td>
                  @endif       
                  
                </tr>
                @endforeach
                <tr>
                @endforeach
              </tbody></table>
            </div>
            <div class="box-body">
            <ins>ผลการประเมินตนเอง</ins>
              <table class="table table-bordered">
                <tbody><tr>
                  <th width="30%">ตัวบ่งชี้</th>
                  <th width="20%">เป้าหมาย</th>
                  <th width="20%">ผลการดำเนินงาน</th>
                  <th width="20%">คะแนนอิงเกณฑ์ สกอ.</th>
                </tr>
                @if($inc5_1!="")
                @foreach($inc5_1 as $key =>$row )
                <tr>
                  <td>ตัวบ่งชี้ที่{{$row['Indicator_id']." ".$row['Indicator_name']}}</td>             
                  <td>{{$row['target']}}</td>
                  <td>{{$row['performance3']}}</td>
                  <td>            
                  @if($checkedit!="")<a href="/getself_assessment_results2/{{$row['Indicator_id']}}" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไข</a>@endif
                  {{$row['score']}}</td>
                </tr>
                <tr>
                @endforeach
                @else
                <tr>
                  <td>ตัวบ่งชี้ที่ {{$id5_1}} {{$name5_1}} </td>             
                  <td></td>
                  <td></td>
                  <td>            
                  @if($checkedit!="")<a href="/getself_assessment_results/{{$id}}" class="btn btn-success fr ml-1"><i class='fa fa-plus'></i>เพิ่ม</a>@endif
                  </td>
                </tr>
                <tr>
                @endif
              </tbody></table>
            </div>
              </div>   
              @endif
              @if($check5_2==1)
              <br> <div class="box-body">
              <h1 class="box-title">{{$name5_2}} (ตัวบ่งชี้ที่ {{$id5_2}})</h1>
              <br>
              <ins>เกณฑ์การประเมิน</ins>
              <ul>-มีระบบ มีกลไกล</ul>
              <ul>-มีการนำระบบกลไกสู่การปฏิบัติ/ดำเนินงาน</ul>
              <ul>-มีการประเมินกระบวนการ</ul>
              <ul>-มีการปรับปรุง/พัฒนากระบวนการจากผลการประเมิน</ul>
              <ul>-มีผลจากการปรับปรุงเห็นชัดเจนเป็นรูปธรรม</ul>
              <ul>-มีแนวทางปฏิบัติที่ดี โดยมีหลักฐานเชิงประจักษ์ยืนยัน และกรรมการผู้ตรวจประเมินสามารถให้เหตุผลอธิบายการเป็นแนวปฏิบัติที่ดีได้ชัดเจน</ul>
              
              <br><ins>ผลการดำเนินงาน</ins>
            
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th width="60%">ประเด็นอธิบาย</th>
                  <th width="30%">หลักฐานอ้างอิง</th>
                </tr>
                @foreach($getcategorypdca5_2 as $key=>$value)
                
                <tr>
                @foreach($value->Categorypdca as $row)
                  <td><b>{{$row['category_name']}}</b><br>
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbspหลักสูตร{{$getcourse5_2[0]['course_name']}} สาขา{{$getbranch[0]['name']}}  มีการนำระบบกลไกในการ{{$row['category_name']}}
                  โดยใช้กระบวนการ PDCA เป็นพื้นฐานและมีผลการดำเนินงานในปีการศึกษา {{ Session::get('year')}} ดังนี้ <br><br><br>
                  @if(count($row->pdca)!=0)
                  @foreach($row->pdca as $row1)
                  @if($row1['p']!=null&&$checkedit!="")<a href="/getp/{{$row1['pdca_id']}}" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไข</a>
                  @else
                  @if($checkedit!="")<a href="/addp/{{$row['id']}}" class="btn btn-success fr"><i class='fa fa-plus'></i> เพิ่ม</a>@endif
                  @endif
                  <ins><b>ขั้นตอนการวางแผน (P)</b></ins><br>
                  {!!$row1['p']!!}<br><br>
                  @if($row1['d']!=null&&$checkedit!="")<a href="/getd/{{$row1['pdca_id']}}" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไข</a>
                  @else
                  @if($checkedit!="")<a href="/addd/{{$row['id']}}" class="btn btn-success fr"><i class='fa fa-plus'></i> เพิ่ม</a>@endif
                  @endif
                  <ins><b>การดำเนินงานตามแผน (D)</b></ins><br>
                  {!!$row1['d']!!}</b><br><br>
                  @if($row1['c']!=null&&$checkedit!="")<a href="/getc/{{$row1['pdca_id']}}" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไข</a>
                  @else
                  @if($checkedit!="")<a href="/addc/{{$row['id']}}" class="btn btn-success fr"><i class='fa fa-plus'></i> เพิ่ม</a>@endif
                  @endif
                  <ins><b>การประเมินกระบวนการ (C)</b></ins><br>
                  {!!$row1['c']!!}</b><br><br>
                  @if($row1['a']!=null&&$checkedit!="")<a href="/geta/{{$row1['pdca_id']}}" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไข</a>
                  @else
                  @if($checkedit!="")<a href="/adda/{{$row['id']}}" class="btn btn-success fr"><i class='fa fa-plus'></i> เพิ่ม</a>@endif
                  @endif
                  <ins><b>การปรับปรุง/พัฒนา/บูรณาการกระบวนการจากผลการประเมิน (A)</b></ins><br>
                  {!!$row1['a']!!}</b><br><br>
                  </td>
                  <td>
                  @foreach($row1->docpdca as $key2 =>$row2)
                  {{$value['composition_id']}}.{{$id5_2}}-{{$key2+1}} {{$row2['doc_file']}}<br>
                  @endforeach
                  </td> 
                  @endforeach
                  @else
                  @if($checkedit!="")<a href="/addp/{{$row['id']}}" class="btn btn-success fr"><i class='fa fa-plus'></i> เพิ่ม</a>@endif
                  <ins><b>ขั้นตอนการวางแผน (P)</b></ins><br>
                  <br><br>
                  @if($checkedit!="")<a href="/addd/{{$row['id']}}" class="btn btn-success fr"><i class='fa fa-plus'></i> เพิ่ม</a>@endif
                  <ins><b>การดำเนินงานตามแผน (D)</b></ins><br>
                  <br><br>
                  @if($checkedit!="")<a href="/addc/{{$row['id']}}" class="btn btn-success fr"><i class='fa fa-plus'></i> เพิ่ม</a>@endif
                  <ins><b>การประเมินกระบวนการ (C)</b></ins><br>
                  <br><br>
                  @if($checkedit!="")<a href="/adda/{{$row['id']}}" class="btn btn-success fr"><i class='fa fa-plus'></i> เพิ่ม</a>@endif
                  <ins><b>การปรับปรุง/พัฒนา/บูรณาการกระบวนการจากผลการประเมิน (A)</b></ins><br>
                  <br><br>
                  </td> 
                  <td>
                  </td>
                  @endif       
                  
                </tr>
                @endforeach
                <tr>
                @endforeach
              </tbody></table>
            </div>
            <div class="box-body">
            <ins>ผลการประเมินตนเอง</ins>
              <table class="table table-bordered">
                <tbody><tr>
                  <th width="30%">ตัวบ่งชี้</th>
                  <th width="20%">เป้าหมาย</th>
                  <th width="20%">ผลการดำเนินงาน</th>
                  <th width="20%">คะแนนอิงเกณฑ์ สกอ.</th>
                </tr>
                @if($inc5_2!="")
                @foreach($inc5_2 as $key =>$row )
                <tr>
                  <td>ตัวบ่งชี้ที่{{$row['Indicator_id']." ".$row['Indicator_name']}}</td>             
                  <td>{{$row['target']}}</td>
                  <td>{{$row['performance3']}}</td>
                  <td>            
                  @if($checkedit!="")<a href="/getself_assessment_results2/{{$row['Indicator_id']}}" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไข</a>@endif
                  {{$row['score']}}</td>
                </tr>
                <tr>
                @endforeach
                @else
                <tr>
                  <td>ตัวบ่งชี้ที่ {{$id5_2}} {{$name5_2}} </td>             
                  <td></td>
                  <td></td>
                  <td>            
                  @if($checkedit!="")<a href="/getself_assessment_results/{{$id}}" class="btn btn-success fr ml-1"><i class='fa fa-plus'></i>เพิ่ม</a>@endif
                  </td>
                </tr>
                <tr>
                @endif
              </tbody></table>
            </div>
              </div>   
              @endif
              @if($check5_3==1)
              <br> <div class="box-body">
              <h1 class="box-title">{{$name5_3}} (ตัวบ่งชี้ที่ {{$id5_3}})</h1>
              <br>
              <ins>เกณฑ์การประเมิน</ins>
              <ul>-มีระบบ มีกลไกล</ul>
              <ul>-มีการนำระบบกลไกสู่การปฏิบัติ/ดำเนินงาน</ul>
              <ul>-มีการประเมินกระบวนการ</ul>
              <ul>-มีการปรับปรุง/พัฒนากระบวนการจากผลการประเมิน</ul>
              <ul>-มีผลจากการปรับปรุงเห็นชัดเจนเป็นรูปธรรม</ul>
              <ul>-มีแนวทางปฏิบัติที่ดี โดยมีหลักฐานเชิงประจักษ์ยืนยัน และกรรมการผู้ตรวจประเมินสามารถให้เหตุผลอธิบายการเป็นแนวปฏิบัติที่ดีได้ชัดเจน</ul>
              
              <br><ins>ผลการดำเนินงาน</ins>
            
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th width="60%">ประเด็นอธิบาย</th>
                  <th width="30%">หลักฐานอ้างอิง</th>
                </tr>
                @foreach($getcategorypdca5_3 as $key=>$value)
                
                <tr>
                @foreach($value->Categorypdca as $row)
                  <td><b>{{$row['category_name']}}</b><br>
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbspหลักสูตร{{$getcourse5_3[0]['course_name']}} สาขา{{$getbranch[0]['name']}}  มีการนำระบบกลไกในการ{{$row['category_name']}}
                  โดยใช้กระบวนการ PDCA เป็นพื้นฐานและมีผลการดำเนินงานในปีการศึกษา {{ Session::get('year')}} ดังนี้ <br><br><br>
                  @if(count($row->pdca)!=0)
                  @foreach($row->pdca as $row1)
                  @if($row1['p']!=null&&$checkedit!="")<a href="/getp/{{$row1['pdca_id']}}" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไข</a>
                  @else
                  @if($checkedit!="")<a href="/addp/{{$row['id']}}" class="btn btn-success fr"><i class='fa fa-plus'></i> เพิ่ม</a>@endif
                  @endif
                  <ins><b>ขั้นตอนการวางแผน (P)</b></ins><br>
                  {!!$row1['p']!!}<br><br>
                  @if($row1['d']!=null&&$checkedit!="")<a href="/getd/{{$row1['pdca_id']}}" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไข</a>
                  @else
                  @if($checkedit!="")<a href="/addd/{{$row['id']}}" class="btn btn-success fr"><i class='fa fa-plus'></i> เพิ่ม</a>@endif
                  @endif
                  <ins><b>การดำเนินงานตามแผน (D)</b></ins><br>
                  {!!$row1['d']!!}</b><br><br>
                  @if($row1['c']!=null&&$checkedit!="")<a href="/getc/{{$row1['pdca_id']}}" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไข</a>
                  @else
                  @if($checkedit!="")<a href="/addc/{{$row['id']}}" class="btn btn-success fr"><i class='fa fa-plus'></i> เพิ่ม</a>@endif
                  @endif
                  <ins><b>การประเมินกระบวนการ (C)</b></ins><br>
                  {!!$row1['c']!!}</b><br><br>
                  @if($row1['a']!=null&&$checkedit!="")<a href="/geta/{{$row1['pdca_id']}}" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไข</a>
                  @else
                  @if($checkedit!="")<a href="/adda/{{$row['id']}}" class="btn btn-success fr"><i class='fa fa-plus'></i> เพิ่ม</a>@endif
                  @endif
                  <ins><b>การปรับปรุง/พัฒนา/บูรณาการกระบวนการจากผลการประเมิน (A)</b></ins><br>
                  {!!$row1['a']!!}</b><br><br>
                  </td>
                  <td>
                  @foreach($row1->docpdca as $key2 =>$row2)
                  {{$value['composition_id']}}.{{$id5_3}}-{{$key2+1}} {{$row2['doc_file']}}<br>
                  @endforeach
                  </td> 
                  @endforeach
                  @else
                  @if($checkedit!="")<a href="/addp/{{$row['id']}}" class="btn btn-success fr"><i class='fa fa-plus'></i> เพิ่ม</a>@endif
                  <ins><b>ขั้นตอนการวางแผน (P)</b></ins><br>
                  <br><br>
                  @if($checkedit!="")<a href="/addd/{{$row['id']}}" class="btn btn-success fr"><i class='fa fa-plus'></i> เพิ่ม</a>@endif
                  <ins><b>การดำเนินงานตามแผน (D)</b></ins><br>
                  <br><br>
                  @if($checkedit!="")<a href="/addc/{{$row['id']}}" class="btn btn-success fr"><i class='fa fa-plus'></i> เพิ่ม</a>@endif
                  <ins><b>การประเมินกระบวนการ (C)</b></ins><br>
                  <br><br>
                  @if($checkedit!="")<a href="/adda/{{$row['id']}}" class="btn btn-success fr"><i class='fa fa-plus'></i> เพิ่ม</a>@endif
                  <ins><b>การปรับปรุง/พัฒนา/บูรณาการกระบวนการจากผลการประเมิน (A)</b></ins><br>
                  <br><br>
                  </td> 
                  <td>
                  </td>
                  @endif       
                  
                </tr>
                @endforeach
                <tr>
                @endforeach
              </tbody></table>
            </div>
            <div class="box-body">
            <ins>ผลการประเมินตนเอง</ins>
              <table class="table table-bordered">
                <tbody><tr>
                  <th width="30%">ตัวบ่งชี้</th>
                  <th width="20%">เป้าหมาย</th>
                  <th width="20%">ผลการดำเนินงาน</th>
                  <th width="20%">คะแนนอิงเกณฑ์ สกอ.</th>
                </tr>
                @if($inc5_3!="")
                @foreach($inc5_3 as $key =>$row )
                <tr>
                  <td>ตัวบ่งชี้ที่{{$row['Indicator_id']." ".$row['Indicator_name']}}</td>             
                  <td>{{$row['target']}}</td>
                  <td>{{$row['performance3']}}</td>
                  <td>            
                  @if($checkedit!="")<a href="/getself_assessment_results2/{{$row['Indicator_id']}}" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไข</a>@endif
                  {{$row['score']}}</td>
                </tr>
                <tr>
                @endforeach
                @else
                <tr>
                  <td>ตัวบ่งชี้ที่ {{$id5_3}} {{$name5_3}} </td>             
                  <td></td>
                  <td></td>
                  <td>            
                  @if($checkedit!="")<a href="/getself_assessment_results/{{$id}}" class="btn btn-success fr ml-1"><i class='fa fa-plus'></i>เพิ่ม</a>@endif
                  </td>
                </tr>
                <tr>
                @endif
              </tbody></table>
            </div>
              </div>   
              @endif
              @if($check5_4==1)
              <div class="box-body">
            
            <b><h4>ผลการดำเนินงานหลักสูตรตามกรอบมาตรฐานคุณวุฒิระดับอุดมศึกษาแห่งชาติ (ตัวบ่งชี้ที่ 5.4)</h4></b><br>
             <table class="table table-bordered" >
                 <tbody ><tr>
                   <th  class="text-center" colspan="3">ผลการดำเนินงานตามกรอบมาตรฐานคุณวุฒิ</th>
                   <th width="20%" class="text-center" rowspan="2">หลักฐานอ้างอิง</th>
                 </tr>
                 <tr>
                   <th  class="text-center">ดัชนีบ่งชี้ผลการดำเนินงาน<br>(Key performance indicators)</th>
                   <th width="10%" class="text-center">เป็นไปตามเกณฑ์</th>
                   <th width="10%" class="text-center">ไม่เป็นไปตามเกณฑ์</th>
                 </tr>
                 @foreach($indi as $key=>$value)
                 <tr>
                     <td ><b>{{($key + 1)}}) {{$value['name']}}</b><br>
                         <ins>ผลการดำเนินงาน</ins><br>
                         @foreach($value->indicator5_4 as $row)
                             {!!$row['performance']!!}<br><br>          
                         @endforeach
                     </td>
                         <td class="text-center">
                         @foreach($value->indicator5_4 as $row)
                             @if($row['status']==1)
                             <i class="fa fa-check "></i>
                             @endif
                             @endforeach
                         </td>
                         
                         <td class="text-center">
                         @foreach($value->indicator5_4 as $row)
                             @if($row['status']==0)
                             <i class="fa fa-check"></i>
                             @endif
                             @endforeach
                         </td>
                         <td>
                         <?php $getcount=count($value->indicator5_4);?>
                                 @if($getcount!=0)
                                 @foreach($value->indicator5_4 as $row)
                                 @if($checkedit)<a href="/getindicator5_4/{{$row['id']}}" class="btn btn-warning fr"><i class='fa fas fa-edit'></i></a> @endif                                                                 
                                         @foreach($row->doc_indicator5_4 as $key2=>$row1)
                                         {{$id5_4}}.{{$key+1}}-{{$key2+1}} {{$row1['doc_file']}}
                                         <br>
                                         @endforeach
                                  @endforeach
                                 @else
                                 @if($checkedit)<a href="/addindicator5-4/{{$value['id']}}" class="btn btn-success fr ml-1"><i class='fa fa-plus'></i></a>@endif
                                 @endif
                         </td>
                         
                 </tr>
                 
                 @endforeach
                 <tr>
                     <td class="text-center">รวมตัวบ่งชี้ในปีนี้</td>
                     <td class="text-center" colspan="3">{{$result}}</td>
                 </tr>
                 <tr>
                     <td class="text-center">จำนวนตัวบ่งชี้ที่ดำเนินการผ่านเฉพาะตัวบ่งชี้ที่ 1-5</td>
                     <td class="text-center" colspan="3">{{$resultpass1_5}}</td>
                 </tr>
                 <tr>
                     <td class="text-center">ร้อยละของตัวบ่งชี้ 1-5 </td>
                     <td class="text-center" colspan="3">{{$resultpass1_5persen}}</td>
                 </tr>
                 <tr>
                     <td class="text-center">จำนวนตัวบ่งชี้ในปีนี้ที่ดำเนินการผ่าน</td>
                     <td class="text-center" colspan="3">{{$resultpassall}}</td>
                 </tr>
                 <tr>
                     <td class="text-center">ร้อยละของตัวบ่งชี้ทั้งหมดในปีนี้</td>
                     <?php
                     $get=0;
                     if($result!=0){
                       $get=$resultpassall*100/$result;
                     }
                      ?>
                     <?php $result1 = round($get)  ?>
                     <td class="text-center" colspan="3">{{$result1}}</td>
                 </tr>
               </tbody></table>
          </div>
          <div class="box-body">
 
             <ins>ผลการประเมินตนเอง</ins>
             <table class="table table-bordered text-center">
                 <tbody><tr>
                   <th width="30%" >ตัวบ่งชี้</th>
                   <th width="20%">เป้าหมาย</th>
                   @if($per1!=null)
                       <th colspan="2" width="20%">ผลการดำเนินงาน</th>
                   @else
                       <th  width="20%">ผลการดำเนินงาน</th>
                   @endif
                   <th width="20%">คะแนนอิงเกณฑ์ สกอ.</th>
                 </tr>
                 @if($inc5_4!="[]")
                 @foreach($inc5_4 as $row)
                 
                 <tr>
                   <td rowspan="2">ตัวบ่งชี้ที่ {{$row['Indicator_id']." ".$row['Indicator_name']}}</td>           
                   <td rowspan="2">{{$row['target']}}</td>
                   @if($per1!=null)
                     <td >{{$row['performance1']}}</td>
                   @endif  
                   <td rowspan="2">{{$row['performance3']}}</td>
                   <td rowspan="2">
                   @if($checkedit!="")<a href="/getself_assessment_results2/5.4" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไขข้อมูล</a>@endif
                   {{$row['score']}}</td>
                 </tr>
                 <tr>
                 @if($per1!=null)
                     <td >{{$row['performance2']}}</td>
                   @endif  
                 </tr>
                 <tr>
                 @endforeach
                 @else
                 <tr>
                   <td rowspan="2">ตัวบ่งชี้ที่ {{$id5_4}} {{$name5_4}}</td>           
                   <td rowspan="2"></td>
                   @if($per1!=null)
                     <td ></td>
                   @endif  
                   <td rowspan="2"></td>
                   <td rowspan="2">@if($checkedit!="")<a href="/getself_assessment_results/5.4" class="btn btn-success fr ml-1"><i class='fa fa-plus'></i> เพิ่ม</a>@endif</td>
                 </tr>
                 <tr>
                 @if($per1!=null)
                     <td ></td>
                   @endif  
                 </tr>
                 <tr>
                 @endif
               </tbody></table>
             </div>
              @endif
              @if($check3==1)
             <div class="box-body">
            
            @if($checkedit!="")<a href="/getacademic_performance" class="btn btn-warning fr"><i class='fa fas fa-edit'></i></a>@endif
            <h4>การวิเคราะห์รายวิชาที่มีผลการเรียนที่ไม่ปกติ</h4></b>
            <table class="table table-bordered" >
            <tbody><tr>
              <th width="10%" class="text-center">รหัส ชื่อวิชา</th>
              <th width="10%" class="text-center">ภาคการศึกษา</th>
              <th width="10%" class="text-center">ความผิดปกติ</th>
              <th width="10%" class="text-center">การตรวจสอบ</th>
              <th width="10%" class="text-center">เหตุที่ทำให้ผิดปกติ</th>
              <th width="10%" class="text-center">มาตรการแก้ไข</th>
            </tr>
            @if($academic!="[]")
            @foreach($academic as $value)
            <tr>
            <td>{{$value['code_name']}}
            </td>
            <td>{{$value['term']}}
            </td>
            <td>{{$value['anomaly']}}
            </td>
            <td>{{$value['tocheck']}}
            </td>
            <td>{{$value['reason']}}
            </td>
            <td>{{$value['plan_update']}}
            </td>
            </tr>
            @endforeach
            @else
            <tr>
            <td>-
            </td>
            <td>-
            </td>
            <td>-
            </td>
            <td>-
            </td>
            <td>-
            </td>
            <td>-
            </td>
            </tr>
            @endif
            </tbody></table>
            </div>
            @endif

              @if($check4==1)
            <div class="box-body">
            @if($checkedit!="")<a href="/getnot_offered" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไขข้อมูล</a>@endif
            <h4>รายวิชาที่ไม่ได้เปิดสอนในปีการศึกษา</h4></b>
            <table class="table table-bordered" >
                <tbody><tr>
                  <th width="20%" class="text-center">รหัส ชื่อวิชา</th>
                  <th width="20%" class="text-center">ภาค/ปีการศึกษา</th>
                  <th width="20%" class="text-center">เหตุผลที่ไม่เปิดสอน</th>
                  <th width="20%" class="text-center">มาตรการที่ดำเนิน</th>
                </tr>
                @if($ccr2!="[]")
                @foreach($ccr2 as $value)
              <tr>
                <td>{{$value['code_name']}}
                </td>
                <td>{{$value['term']}}
                </td>
                <td>{{$value['topic']}}
                </td>
                <td>{{$value['plan_update']}}
                </td>
              </tr>
              @endforeach
              @else
              <tr>
                <td>-
                </td>
                <td>-
                </td>
                <td>-
                </td>
                <td>-
                </td>
              </tr>
              @endif
              </tbody></table>
              </div> 
              @endif

              @if($check5==1)
              <div class="box-body">
            @if($checkedit!="")<a href="/getincomplete_content" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไขข้อมูล</a>@endif
            <h4>รายวิชาที่สอนเนื้อหาไม่ครบในปีการศึกษา</h4></b>
            <table class="table table-bordered" >
                <tbody><tr>
                  <th width="20%" class="text-center">รหัส ชื่อวิชา</th>
                  <th width="20%" class="text-center">ภาค/ปีการศึกษา</th>
                  <th width="20%" class="text-center">หัวข้อที่ขาด</th>
                  <th width="20%" class="text-center">เหตุผลที่ไม่เปิดสอน</th>
                  <th width="20%" class="text-center">มาตรการที่ดำเนิน</th>
                </tr>
                @if($academic2!="[]")
                @foreach($academic2 as $value)
              <tr>
                <td>{{$value['code_name']}}
                </td>
                <td>{{$value['term']}}
                </td>
                <td>{{$value['topic']}}
                </td>
                <td>{{$value['untraceable']}}
                </td>
                <td>{{$value['plan_update']}}
                </td>
              </tr>
              @endforeach
              @else
              <tr>
                <td>-
                </td>
                <td>-
                </td>
                <td>-
                </td>
                <td>-
                </td>
                <td>-
                </td>
              </tr>
              @endif
              </tbody></table>
            </div>
            @endif
            @if($check1==1)
            <br><div class="box-body"><h4 class="text-center">คุณภาพการสอน</h4></br><br><br>
            <b>การประเมินรายวิชาที่เปิดสอนในปีที่รายงาน<br>
            รายวิชาที่มีการประเมินคุณภาพการสอน และแผนการปรับปรุงจากผลการประเมิน</b><br>
            @if($teachquagroup!="[]")
            @foreach($teachquagroup as $key1=>$row)
            <b>นักศึกษาชั้นปี {{$row['student_year']}} เข้าปี {{Session::get('year')-$key1}}</b><br>
            <table class="table table-bordered" >
                <tbody ><tr>
                  <th width="25%" class="text-center" rowspan="2">รหัส ชื่อวิชา</th>
                  <th width="15%" class="text-center" rowspan="2">ภาคการศึกษา</th>
                  <th  class="text-center" colspan="2">ผลการประเมินโดยนักศึกษา</th>
                  <th  class="text-center" rowspan="2">แผนการปรับปรุง</th>
                </tr>
                  <tr>
                  <th width="10%" class="text-center">มี</th>
                  <th width="10%" class="text-center">ไม่มี</th>
                  </tr>
                  <?php $data2=$teachqua->where('student_year',$row['student_year']); ?>
                @foreach($data2 as $key=>$value)
                <tr>
                    
                    <td >{{$value['course_code']}} {{$value['course_name']}}</td>
                    <td class="text-center">{{$value['term_year']}}</td>
                    <td class="text-center">
                            @if($value['status']==1)
                            <i class="fa fa-check "></i>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($value['status']==0)
                            <i class="fa fa-check "></i>
                            @endif
                        </td>
                    <td>{{$value['description']}}</td>
                </tr>
                @endforeach
              </tbody></table><br><br>
              @endforeach
              @else
             <br> <b>นักศึกษาชั้นปี 1 เข้าปี {{Session::get('year')-3}}</b><br>
              <table class="table table-bordered" >
                <tbody ><tr>
                  <th width="25%" class="text-center" rowspan="2">รหัส ชื่อวิชา</th>
                  <th width="15%" class="text-center" rowspan="2">ภาคการศึกษา</th>
                  <th  class="text-center" colspan="2">ผลการประเมินโดยนักศึกษา</th>
                  <th  class="text-center" rowspan="2">แผนการปรับปรุง</th>
                </tr>
                  <tr>
                  <th width="10%" class="text-center">มี</th>
                  <th width="10%" class="text-center">ไม่มี</th>
                  </tr>
                <tr>
                    <td >-</td>
                    <td class="text-center">-</td>
                    <td class="text-center">
                           
                          -
                           
                        </td>
                        <td class="text-center">
                            
                           -
                          
                        </td>
                    <td>-</td>
                    
                </tr>
              </tbody></table><br><br>

              <br> <b>นักศึกษาชั้นปี 2 เข้าปี {{Session::get('year')-2}}</b><br>
              <table class="table table-bordered" >
                <tbody ><tr>
                  <th width="25%" class="text-center" rowspan="2">รหัส ชื่อวิชา</th>
                  <th width="15%" class="text-center" rowspan="2">ภาคการศึกษา</th>
                  <th  class="text-center" colspan="2">ผลการประเมินโดยนักศึกษา</th>
                  <th  class="text-center" rowspan="2">แผนการปรับปรุง</th>
                </tr>
                  <tr>
                  <th width="10%" class="text-center">มี</th>
                  <th width="10%" class="text-center">ไม่มี</th>
                  </tr>
                <tr>
                    <td >-</td>
                    <td class="text-center">-</td>
                    <td class="text-center">
                           
                          -
                           
                        </td>
                        <td class="text-center">
                            
                           -
                          
                        </td>
                    <td>-</td>
                    
                </tr>
              </tbody></table><br><br>

              <br> <b>นักศึกษาชั้นปี 3 เข้าปี {{Session::get('year')-1}}</b><br>
              <table class="table table-bordered" >
                <tbody ><tr>
                  <th width="25%" class="text-center" rowspan="2">รหัส ชื่อวิชา</th>
                  <th width="15%" class="text-center" rowspan="2">ภาคการศึกษา</th>
                  <th  class="text-center" colspan="2">ผลการประเมินโดยนักศึกษา</th>
                  <th  class="text-center" rowspan="2">แผนการปรับปรุง</th>
                </tr>
                  <tr>
                  <th width="10%" class="text-center">มี</th>
                  <th width="10%" class="text-center">ไม่มี</th>
                  </tr>
                <tr>
                    <td >-</td>
                    <td class="text-center">-</td>
                    <td class="text-center">
                           
                          -
                           
                        </td>
                        <td class="text-center">
                            
                           -
                          
                        </td>
                    <td>-</td>
                    
                </tr>
              </tbody></table><br><br>

              <br> <b>นักศึกษาชั้นปี 4 เข้าปี {{Session::get('year')}}</b><br>
              <table class="table table-bordered" >
                <tbody ><tr>
                  <th width="25%" class="text-center" rowspan="2">รหัส ชื่อวิชา</th>
                  <th width="15%" class="text-center" rowspan="2">ภาคการศึกษา</th>
                  <th  class="text-center" colspan="2">ผลการประเมินโดยนักศึกษา</th>
                  <th  class="text-center" rowspan="2">แผนการปรับปรุง</th>
                </tr>
                  <tr>
                  <th width="10%" class="text-center">มี</th>
                  <th width="10%" class="text-center">ไม่มี</th>
                  </tr>
                <tr>
                    <td >-</td>
                    <td class="text-center">-</td>
                    <td class="text-center">
                           
                          -
                           
                        </td>
                        <td class="text-center">
                            
                           -
                          
                        </td>
                    <td>-</td>
                    
                </tr>
              </tbody></table><br><br>
              @endif
              <b>ผลการประเมินคุณภาพการสอนโดยรวม</b>
              @if($teachqua!="[]")
              @foreach($teachqua as $key=>$value)
              @if($value['result']!=null)
              <br>{{$value['result']}}
              @endif
              @endforeach
              @else
              <br>-
              @endif
              </div>
                @endif

                @if($check6==1)
              <div class="box-body">
            <b><h4>ประสิทธิผลของกลยุทธ์การสอน</h4></b>
              <table class="table table-bordered" >
                <tbody><tr>
                  <th width="30%" class="text-center" >มาตรฐานผลการเรียนรู้</th>
                  <th width="30%" class="text-center">สรุปข้อคิดเห็นของผู้สอน และข้อมูลป้อนกลับจากแหล่งต่าง ๆ </th>
                  <th width="30%" class="text-center" >แนวทางแก้ไขปรับปรุง</th>
                </tr>
                <tr></tr>
                @if($effec!="[]")
                @foreach($effec as $value)
              <tr>
                  <td >{!!$value['learning_standards']!!}</td>
                  <td >{!!$value['comment']!!}</td>
                  <td >@if($checkedit!="")<a href="/geteffectiveness/{{$value['id']}}" class="btn btn-warning fr"><i class='fa fas fa-edit'></i></a>@endif
                  {!!$value['solution']!!}</td>
              </tr>
                @endforeach
                @else
                <tr>
                  <td >-</td>
                  <td >-</td>
                  <td >-</td>
              </tr>
                @endif
              </tbody></table>
          </div>
            @endif

            @if($check7==1)
          <div class="box-body">
            @if($th!="[]"&&$checkedit!="")<a href="/getteacher_orientation/{{$th[0]['id']}}" class="btn btn-warning fr"><i class='fa fas fa-edit'></i>แก้ไขข้อมูล</a>@endif
            <h4>การปฐมนิเทศอาจารย์ใหม่</h4></b>
            @foreach($th as $row)
            @if(!$checkpass)
            การปฐมนิเทศเพื่อชี้แจงหลักสูตร <label>มี</label>  
                      <input type="checkbox"  @if($checkpass) checked @endif disabled>
                      <label>ไม่มี</label>  
                      <input type="checkbox"  @if(!$checkpass) checked @endif disabled>
            <br>จำนวนอาจารย์ใหม่................ จำนวนอาจารย์ที่เข้าร่วมปฐมนิเทศ............
            @else
            การปฐมนิเทศเพื่อชี้แจงหลักสูตร <label>มี</label>  
                      <input type="checkbox"  @if($checkpass) checked @endif disabled>
                      <label>ไม่มี</label>  
                      <input type="checkbox"  @if(!$checkpass) checked @endif disabled>
            <br>จำนวนอาจารย์ใหม่ {{$row['new_teacher_qty']}} จำนวนอาจารย์ที่เข้าร่วมปฐมนิเทศ {{$row['teacher_point_out_qty']}}
            @endif
            @endforeach
          
        </div>
          @endif
          @if($check8==1)
        <div class="box-body">
            
            <h4 >กิจกรรมการพัฒนาวิชาชีพของอาจารย์และบุคลากรสายสนับสนุน</h4></b>
            <table class="table table-bordered" >
                <tbody ><tr>
                  <th width="25%" class="text-center" rowspan="2">กิจกรรมที่จัดหรือเข้าร่วม</th>
                  <th  class="text-center" colspan="2">จำนวน</th>
                  <th  class="text-center" colspan="2" rowspan="2">สรุปข้อคิดเห็น และประโยชน์ที่ผู้เข้าร่วมกิจกรรมได้รับ</th>
                </tr>
                  <tr>
                  <th width="10%" class="text-center">อาจารย์</th>
                  <th width="10%" class="text-center">บุคลากรสายสนับสนุน</th>
                  </tr>
                  @if($activity!="[]")
                @foreach($activity as $key=>$value)
                <tr>
                    <td >{!!$value['organized_activities']!!}</td>
                    <td class="text-center">
                            @if($value['status']==1)
                            <i class="fa fa-check "></i>
                            @endif
                    </td>
                    <td class="text-center">
                            @if($value['status']==0)
                            <i class="fa fa-check "></i>
                            @endif
                    </td>
                    <td>@if($checkedit!="")<a href="/getactivity/{{$value['id']}}" class="btn btn-warning fr"><i class='fa fas fa-edit'></i></a>@endif{!!$value['comment']!!}
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td class="text-center">-</td>
                    <td class="text-center">
                           -
                    </td>
                    <td class="text-center">
                            -
                    </td>
                    <td class="text-center">-
                    </td>
                </tr>
                @endif
              </tbody></table><br><br>
          

          </div>
          @endif
</div>
</div>
<style>
.marginl{
  padding:10px;
}
.wid10{
  width:10%;
}
.wid20{
  width:20%;
}
.wid30{
  width:30%;
}
.wid40{
  width:40%;
}
.wid50{
  width:50%;
}
.mt20{
  margin-top:50px
}
.ml-1{
  margin-left:10px
}
.ml-2{
  margin-left:20px
}
.mt-3{
  margin-top:30px;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript">
 $(document).ready(function(){      
var i=1;  
$('#add').click(function(){  
var id = $("#add").attr("data-id")
// i++;  
$('#show'+id).append('<tr><td>'+id+'</td></tr>');  
});  
$(document).on('click', '.btn_remove', function(){  
var button_id = $(this).attr("id");   
$('#row'+button_id+'').remove();  
}); 
 }); 

 function Export2Word(element, filename = ''){
    var preHtml = "<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'><head><meta charset='utf-8'><title>Export HTML To Doc</title></head><body>";
    var postHtml = "</body></html>";
    var html = preHtml+document.getElementById(element).innerHTML+postHtml;

    var blob = new Blob(['\ufeff', html], {
        type: 'application/msword'
    });
    
    // Specify link url
    var url = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(html);
    
    // Specify file name
    filename = filename?filename+'.doc':'document.doc';
    
    // Create download link element
    var downloadLink = document.createElement("a");

    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob ){
        navigator.msSaveOrOpenBlob(blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = url;
        
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
    
    document.body.removeChild(downloadLink);
}
</script>
@endsection