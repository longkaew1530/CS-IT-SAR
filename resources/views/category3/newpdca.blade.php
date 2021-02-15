
            <ins>ผลการดำเนินงาน</ins>
            
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th width="60%">ประเด็นอธิบาย</th>
                  <th width="30%">หลักฐานอ้างอิง</th>
                </tr>
                @foreach($getcategorypdca as $key=>$value)
                {{$value['Indicator_name']}}
                <tr>
                @foreach($value->Categorypdca as $row)
                  <td><b>{{$row['category_name']}}</b><br>
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbspหลักสูตร{{$getcourse[0]['course_name']}} สาขา{{$getcourse[0]['branch']}}  มีการนำระบบกลไกในการ{{$row['category_name']}}
                  โดยใช้กระบวนการ PDCA เป็นพื้นฐานและมีผลการดำเนินงานในปีการศึกษา {{ Session::get('year')}} ดังนี้ <br><br><br>
                  @if(count($row->pdca)!=0)
                  @foreach($row->pdca as $row1)
                  <a href="/getpdca/{{$value['Indicator_id']}}" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไข</a>
                  <ins><b>ขั้นตอนการวางแผน (P)</b></ins><br>
                  {!!$row1['p']!!}<br><br>
                  <a href="/getpdca/{{$value['Indicator_id']}}" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไข</a>
                  <ins><b>การดำเนินงานตามแผน (D)</b></ins><br>
                  {!!$row1['d']!!}</b><br><br>
                  <a href="/getpdca/{{$value['Indicator_id']}}" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไข</a>
                  <ins><b>การประเมินกระบวนการ (C)</b></ins><br>
                  {!!$row1['c']!!}</b><br><br>
                  <a href="/getpdca/{{$value['Indicator_id']}}" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไข</a>
                  <ins><b>การปรับปรุง/พัฒนา/บูรณาการกระบวนการจากผลการประเมิน (A)</b></ins><br>
                  {!!$row1['a']!!}</b><br><br>
                  </td> 
                  @endforeach
                  @else
                  <a href="/getpdca/{{$value['Indicator_id']}}" class="btn btn-success fr"><i class='fa fas fa-edit'></i> เพิ่ม</a>
                  <ins><b>ขั้นตอนการวางแผน (P)</b></ins><br>
                  <br><br>
                  <a href="/getpdca/{{$value['Indicator_id']}}" class="btn btn-success fr"><i class='fa fas fa-edit'></i> เพิ่ม</a>
                  <ins><b>การดำเนินงานตามแผน (D)</b></ins><br>
                  <br><br>
                  <a href="/getpdca/{{$value['Indicator_id']}}" class="btn btn-success fr"><i class='fa fas fa-edit'></i> เพิ่ม</a>
                  <ins><b>การประเมินกระบวนการ (C)</b></ins><br>
                  <br><br>
                  <a href="/getpdca/{{$value['Indicator_id']}}" class="btn btn-success fr"><i class='fa fas fa-edit'></i> เพิ่ม</a>
                  <ins><b>การปรับปรุง/พัฒนา/บูรณาการกระบวนการจากผลการประเมิน (A)</b></ins><br>
                  <br><br>
                  </td> 
                  @endif       
                  <td>
                  @foreach($row1->docpdca as $key =>$row2)
                  -{{$row2['doc_name']}}<br>
                  @endforeach
                  </td>
                </tr>
                @endforeach
                <tr>
                @endforeach
              </tbody></table>
            </div>

