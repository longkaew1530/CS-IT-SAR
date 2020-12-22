<h1 class="box-title">{{$name}} (ตัวบ่งชี้ที่ {{$id}})</h1>
              <br>
              <ins>เกณฑ์การประเมิน</ins>
              <ul>-มีระบบ มีกลไกล</ul>
              <ul>-มีการนำระบบกลไกสู่การปฏิบัติ/ดำเนินงาน</ul>
              <ul>-มีการประเมินกระบวนการ</ul>
              <ul>-มีการปรับปรุง/พัฒนากระบวนการจากผลการประเมิน</ul>
              <ul>-มีผลจากการปรับปรุงเห็นชัดเจนเป็นรูปธรรม</ul>
              <ul>-มีแนวทางปฏิบัติที่ดี โดยมีหลักฐานเชิงประจักษ์ยืนยัน และกรรมการผู้ตรวจประเมินสามารถให้เหตุผลอธิบายการเป็นแนวปฏิบัติที่ดีได้ชัดเจน</ul>
            <ins>ผลการดำเนินงาน</ins>
            
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th width="60%">ประเด็นอธิบาย</th>
                  <th width="30%">หลักฐานอ้างอิง</th>
                </tr>
                @foreach($pdca as $key =>$row )
                <tr>
                  <td><b>{{$row['category_pdca']}}</b><br>
                  <ins><b>ขั้นตอนการวางแผน (P)</b></ins><br>
                  {{$row['p']}}<br>
                  <ins><b>การดำเนินงานตามแผน (D)</b></ins><br>
                  {{$row['d']}}</b><br>
                  <ins><b>การประเมินกระบวนการ (C)</b></ins><br>
                  {{$row['c']}}</b><br>
                  <ins><b>การปรับปรุง/พัฒนา/บูรณาการกระบวนการจากผลการประเมิน (A)</b></ins><br>
                  {{$row['a']}}</b><br>
                  </td>        
                  <td>
                  @foreach($row->docpdca as $key =>$row)
                  -{{$row['doc_name']}}<br>
                  @endforeach
                  </td>
                </tr>
                <tr>
                @endforeach
              </tbody></table>
            </div>

