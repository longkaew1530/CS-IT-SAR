            <div class="box-body">
            <ins>ผลการประเมินตนเอง</ins><br>
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
                @foreach($pdca as $row)
                @if($row['target']!="")
                <tr>
                  <td rowspan="2">ตัวบ่งชี้ที่ {{$row['Indicator_id']." ".$row['Indicator_name']}}</td>           
                  <td rowspan="2">{{$row['target']}}</td>
                  @if($per1!=null)
                    <td >{{$row['performance1']}}</td>
                  @endif  
                  <td rowspan="2">{{$row['performance3']}}</td>
                  <td rowspan="2">{{$row['score']}}</td>
                </tr>
                <tr>
                @if($per1!=null)
                    <td >{{$row['performance2']}}</td>
                  @endif  
                </tr>
                <tr>
                @endif
                @endforeach
              </tbody></table>







             