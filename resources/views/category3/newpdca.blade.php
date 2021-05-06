
            <br><ins>ผลการดำเนินงาน</ins>
            
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th width="60%">ประเด็นอธิบาย</th>
                  <th width="30%">หลักฐานอ้างอิง</th>
                </tr>
                @foreach($getcategorypdca as $key=>$value)
                
                <tr>
                @foreach($value->Categorypdca as $row)
                  <td><b>{{$row['category_name']}}</b><br>
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbspหลักสูตร{{$getcourse[0]['course_name']}} สาขา{{$getbranch[0]['name']}}  มีการนำระบบกลไกในการ{{$row['category_name']}}
                  โดยใช้กระบวนการ PDCA เป็นพื้นฐานและมีผลการดำเนินงานในปีการศึกษา {{ Session::get('year')}} ดังนี้ <br><br><br>
                  @if(count($row->pdca)!=0)
                  @foreach($row->pdca as $row1)
                  <?php 
                  $checkcheck=0;
                  foreach($row1->docpdca as $check2){
                      if($check2['doc_file']!=""&&$check2['categorypdca']=="p"){
                        $checkcheck=1;
                      }
                  }
                  ?>
                  @if($row1['p']!=null||$checkcheck!=0)@if($checkedit!="")<a href="/getp/{{$row1['pdca_id']}}" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไข</a>@endif
                  @else
                  @if($checkedit!="")<a href="/addp/{{$row['id']}}" class="btn btn-success fr"><i class='fa fa-plus'></i> เพิ่ม</a>@endif
                  @endif
                  <ins><b>ขั้นตอนการวางแผน (P)</b></ins><br>
                  {!!$row1['p']!!}<br><br>
                  <?php 
                  $checkcheck2=0;
                  foreach($row1->docpdca as $check3){
                      if($check3['doc_file']!=""&&$check3['categorypdca']=="d"){
                        $checkcheck2=1;
                      }
                  }
                  ?>
                  @if($row1['d']!=null||$checkcheck2!=0)@if($checkedit!="")<a href="/getd/{{$row1['pdca_id']}}" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไข</a>@endif
                  @else
                  @if($checkedit!="")<a href="/addd/{{$row['id']}}" class="btn btn-success fr"><i class='fa fa-plus'></i> เพิ่ม</a>@endif
                  @endif
                  <ins><b>การดำเนินงานตามแผน (D)</b></ins><br>
                  {!!$row1['d']!!}</b><br><br>
                  <?php 
                  $checkcheck3=0;
                  foreach($row1->docpdca as $check4){
                      if($check4['doc_file']!=""&&$check4['categorypdca']=="c"){
                        $checkcheck3=1;
                      }
                  }
                  ?>
                  @if($row1['c']!=null||$checkcheck3!=0)@if($checkedit!="")<a href="/getc/{{$row1['pdca_id']}}" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไข</a>@endif
                  @else
                  @if($checkedit!="")<a href="/addc/{{$row['id']}}" class="btn btn-success fr"><i class='fa fa-plus'></i> เพิ่ม</a>@endif
                  @endif
                  <ins><b>การประเมินกระบวนการ (C)</b></ins><br>
                  {!!$row1['c']!!}</b><br><br>
                  <?php 
                  $checkcheck4=0;
                  foreach($row1->docpdca as $check5){
                      if($check5['doc_file']!=""&&$check5['categorypdca']=="a"){
                        $checkcheck4=1;
                      }
                  }
                  ?>
                  @if($row1['a']!=null||$checkcheck4!=0)@if($checkedit!="")<a href="/geta/{{$row1['pdca_id']}}" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไข</a>@endif
                  @else
                  @if($checkedit!="")<a href="/adda/{{$row['id']}}" class="btn btn-success fr"><i class='fa fa-plus'></i> เพิ่ม</a>@endif
                  @endif
                  <ins><b>การปรับปรุง/พัฒนา/บูรณาการกระบวนการจากผลการประเมิน (A)</b></ins><br>
                  {!!$row1['a']!!}</b><br><br>
                  </td>
                  <td>
                  @foreach($row1->docpdca as $key2 =>$row2)
                  {{$value['composition_id']}}.{{$id}}-{{$key2+1}} {{$row2['doc_file']}}<br>
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
                  <th width="30%" class="text-center">ตัวบ่งชี้</th>
                  <th width="20%" class="text-center">เป้าหมาย</th>
                  <th width="20%" class="text-center">ผลการดำเนินงาน</th>
                  <th width="20%" class="text-center">คะแนนอิงเกณฑ์ สกอ.</th>
                </tr>
                @if($inc!="")
                @foreach($inc as $key =>$row )
                <tr>
                  <td>ตัวบ่งชี้ที่{{$row['Indicator_id']." ".$row['Indicator_name']}}</td>             
                  <td class="text-center">{{$row['target']}}</td>
                  <td class="text-center">{{$row['performance3']}}</td>
                  <td class="text-center">            
                  @if($checkedit!="")<a href="/getself_assessment_results2/{{$row['Indicator_id']}}" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไข</a>@endif
                  {{$row['score']}}</td>
                </tr>
                <tr>
                @endforeach
                @else
                <tr>
                  <td>ตัวบ่งชี้ที่ {{$id}} {{$name}} </td>             
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
            
                  
                

