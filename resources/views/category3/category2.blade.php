@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl" id="exportContent">
<div class="box-header" >
              <h3 class="text-center">หมวดที่ 2 อาจารย์</h3><br>
              @if($check4_1==1)
              <h1 class="box-title">{{$name}} (ตัวบ่งชี้ที่ {{$id}})</h1>
              <br>
              <ins>เกณฑ์การประเมิน</ins>
              <ul>-มีระบบ มีกลไกล</ul>
              <ul>-มีการนำระบบกลไกสู่การปฏิบัติ/ดำเนินงาน</ul>
              <ul>-มีการประเมินกระบวนการ</ul>
              <ul>-มีการปรับปรุง/พัฒนากระบวนการจากผลการประเมิน</ul>
              <ul>-มีผลจากการปรับปรุงเห็นชัดเจนเป็นรูปธรรม</ul>
              <ul>-มีแนวทางปฏิบัติที่ดี โดยมีหลักฐานเชิงประจักษ์ยืนยัน และกรรมการผู้ตรวจประเมินสามารถให้เหตุผลอธิบายการเป็นแนวปฏิบัติที่ดีได้ชัดเจน</ul>
              
              @include('category3/newpdca',['pdca','name','id','getcourse','getcategorypdca','inc','checkedit'])
              <br><br>
              @endif
              @if($check4_2==1)
              <h1 class="box-title"><li>คุณภาพอาจารย์ (ตัวบ่งชี้ที่ 4.2)</li></h1>
              <br><br>
            <ins>ข้อมูลพื้นฐานตัวบ่งชี้</ins>
            
            <br><br><b>1. ข้อมูลคุณวุฒิปริญญาเอกและตำแหน่งทางวิชาการ</b>
            <div class="box-body">
              <table class="table table-bordered ">
                <tbody><tr>
                  <th width="50%">รายการข้อมูล</th>
                  <th width="30%">จำนวน</th>
                </tr>
                
                <tr>
                  <td>1. จำนวนอาจารย์ผู้รับผิดชอบหลักสูตรทั้งหมด</td>
                  <td>{{$count}}</td>
               </tr>
               <tr>
                  <td>2. จำนวนอาจารย์ผู้รับผิดชอบหลักสูตรที่มีคุณวุฒิปริญญาเอก</td>
                  <td>
                  {{$counteb_name}}
                  </td>
               </tr>
               <tr>
                  <td>3. จำนวนอาจารย์ผู้รับผิดชอบหลักสูตรที่เป็น ผู้ช่วยศาสตราจารย์</td>
                  <td>{{$countposition1}}</td>
               </tr>
               <tr>
                  <td>4. จำนวนอาจารย์ผู้รับผิดชอบหลักสูตรที่เป็น รองศาตราจารย์</td>
                  <td>{{$countposition2}}</td>
               </tr>
               <tr>
                  <td>5. จำนวนอาจารย์ผู้รับผิดชอบหลักสูตรที่เป็น ศาสตราจารย์</td>
                  <td>{{$countposition3}}</td>
               </tr>
              </tbody></table>
            </div>
            <?php $totalqty=0;
                  $total=0;
            ?>
            <br><br><b>2. ข้อมูลผลงานทางวิชาการของอาจารย์ผู้รับผิดชอบหลักสูตร (นับผลงานตามปีการศึกษา)</b>
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th width="50%" class="text-center">ระดับคุณภาพ</th>
                  <th width="5%">ค่าน้ำหนัก</th>
                  <th width="5%">จำนวนผลงาน</th>
                  <th width="5%">ค่าถ่วงน้ำหนัก</th>
                </tr>
                @foreach($cate as $key =>$row)
                <tr>
                  <td>-{{$row['name']}}<br>
                     @foreach($row->publish_work as $key =>$value)
                     @if($value['publish_work_yearanddate']>=session()->get('yearBegin')&&$value['publish_work_yearanddate']<=session()->get('yearEnd'))
                              @if($value['publish_work_issue']!="")
                              <li class="ml-2">{{$value['teacher_name'].".(".($value['publish_work_year']).") ".$value['publish_work_name'].". ".$value['journal_name']." ".$value['publish_work_issue']." (".$value['publish_work_year'].") ".$value['publish_work_page']}}</li>
                              @else
                              @if($value['publish_work_date']!=1)
                              <li class="ml-2">{{$value['teacher_name'].".(".($value['publish_work_year']).") ".$value['publish_work_name']." ".$value['journal_name'].". ".$value['publish_work_date']." ".$value['publish_work_place'].", ".$value['province'].". ".$value['country']." ".$value['publish_work_page']."."}}</li><br>
                              @else
                              <li class="ml-2">{{$value['teacher_name'].".(".($value['publish_work_year']).") ".$value['publish_work_name']." ".$value['journal_name'].". ".$value['province'].". ".$value['country']." ".$value['publish_work_page']."."}}</li><br>
                              @endif
                              @endif
                        @elseif($value['publish_work_yearanddate2']>=session()->get('yearBegin')&&$value['publish_work_yearanddate2']<=session()->get('yearEnd'))
                        @if($value['publish_work_issue']!="")
                              <li class="ml-2">{{$value['teacher_name'].".(".($value['publish_work_year']).") ".$value['publish_work_name'].". ".$value['journal_name']." ".$value['publish_work_issue']." (".$value['publish_work_year'].") ".$value['publish_work_page']}}</li>
                              @else
                              @if($value['publish_work_date']!=1)
                              <li class="ml-2">{{$value['teacher_name'].".(".($value['publish_work_year']).") ".$value['publish_work_name']." ".$value['journal_name'].". ".$value['publish_work_date']." ".$value['publish_work_place'].", ".$value['province'].". ".$value['country']." ".$value['publish_work_page']."."}}</li><br>
                              @else
                              <li class="ml-2">{{$value['teacher_name'].".(".($value['publish_work_year']).") ".$value['publish_work_name']." ".$value['journal_name'].". ".$value['province'].". ".$value['country']." ".$value['publish_work_page']."."}}</li><br>
                              @endif
                              @endif
                        @endif
                      @endforeach
                  </td>           
                  <td class="text-center">
                  {{$row['score']}}
                  </td>
                  <td class="text-center">
                  <?php $i=0 ?>
                  @foreach($row->publish_work as $ke =>$value1)
                  @if($value1['publish_work_yearanddate']>=session()->get('yearBegin')&&$value1['publish_work_yearanddate']<=session()->get('yearEnd'))
                        <?php $i++ ?>
                  @elseif($value1['publish_work_yearanddate2']>=session()->get('yearBegin')&&$value1['publish_work_yearanddate2']<=session()->get('yearEnd'))
                        <?php $i++ ?>
                  @endif 
                  @endforeach
                  <?php  $totalqty=$totalqty+$i;?>
                  @if( $i!=0)
                  <?php echo $i ?>
                  @endif
                  </td>
                  <td class="text-center">
                  @if( $i!=0)
                  <?php echo $i*$row['score'];
                        $total=$total+($i*$row['score']);
                  ?>
                  @endif
                  </td>
                @endforeach
                </tr>
                <tr>
                <td colspan="2" class="text-right">รวม</td>
                <td><?php echo $totalqty ?></td>
                <td><?php echo $total ?></td>
                </tr>
                <tr>
                <td colspan="3" class="text-right">ร้อยละของผลรวมถ่วงน้ำหนักของผลงานที่ตีพิมพ์หรือเผยแพร่ต่ออาจารย์ผู้รับผิดชอบหลักสูตรทั้งหมด</td>
                <td>{{$E}}</td>
                </tr>
              </tbody></table>
            </div>

            <br><br><b>3. รายละเอียดข้อมูลผลงานทางวิชาการของอาจารย์ผู้รับผิดชอบหลักสูตร</b>
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th width="20%" class="text-center">ชื่อผลงาน</th>
                  <th width="15%" class="text-center">ชื่อเจ้าของผลงาน</th>
                  <th width="30%" class="text-center">แหล่งเผยแพร่<br>(ชื่อการประชุม/ชื่อวารสาร เล่มที่/ชื่อฐานข้อมูล/<br>รูปแบบการเผยแพร่)</th>
                  <th width="10%" class="text-center">ค่าน้ำหนัก</th>
                </tr>
                @foreach($category_re as $key =>$value)
                @if($value['publish_work_yearanddate']>=session()->get('yearBegin')&&$value['publish_work_yearanddate']<=session()->get('yearEnd'))
                    <tr>
                      <td>{{$value['publish_work_name']}}</td>           
                      <td>{{$value['teacher_name']}}</td>
                      @if($value['publish_work_issue']!="")
                      <td>{{$value['journal_name']." ".$value['publish_work_issue']." (".$value['publish_work_year'].") ".$value['publish_work_page']}}</td>
                      @else
                        @if($value['publish_work_date']!=1)
                        <td>{{$value['journal_name'].". ".$value['publish_work_date']." ".$value['publish_work_place'].", ".$value['province'].". ".$value['country']." ".$value['publish_work_page']."."}}</td>
                        @else
                        <td>{{$value['journal_name'].". ".$value['province'].". ".$value['country']." ".$value['publish_work_page']."."}}</td>
                        @endif
                        
                      @endif
                      <td>{{$value['score']}}</td>
                    </tr>
                  @elseif($value['publish_work_yearanddate2']>=session()->get('yearBegin')&&$value['publish_work_yearanddate2']<=session()->get('yearEnd'))
                      <tr>
                      <td>{{$value['publish_work_name']}}</td>           
                      <td>{{$value['teacher_name']}}</td>
                      @if($value['publish_work_issue']!="")
                      <td>{{$value['journal_name']." ".$value['publish_work_issue']." (".$value['publish_work_year'].") ".$value['publish_work_page']}}</td>
                      @else
                        @if($value['publish_work_date']!=1)
                        <td>{{$value['journal_name'].". ".$value['publish_work_date']." ".$value['publish_work_place'].", ".$value['province'].". ".$value['country']." ".$value['publish_work_page']."."}}</td>
                        @else
                        <td>{{$value['journal_name'].". ".$value['province'].". ".$value['country']." ".$value['publish_work_page']."."}}</td>
                        @endif
                        
                      @endif
                      <td>{{$value['score']}}</td>
                    </tr>
                  @endif 
                @endforeach
              </tbody></table>
            </div>
            <br><br><b><ins>ผลการดำเนินงาน</ins> </b>
            <div class="box-body">
              <table class="table table-bordered" >
                <tbody><tr>
                  <th width="30%" class="text-center">ประเด็นการประเมิน</th>
                  <th width="15%" class="text-center">ร้อยละ</th>
                  <th width="20%" class="text-center">เกณฑ์คะแนน</th>
                  <th width="15%" class="text-center">คะแนนที่ได้</th>
                </tr>
                <tr>
                  <td>1. ร้อยละของอาจารย์ผู้รับผิดชอบหลักสูตรที่มีคุณวุติปริญญาเอก</td> 
                  <td>@if($B<=20)
                      {{$B}}
                      @else
                      20
                      @endif
                  </td>  
                  <td class="text-center">ร้อยละ 20=5</td>
                  <?php  $result1 = sprintf('%.2f',$qty1); ?>  
                  <td>{{$result1}}</td>            
                </tr>
                <tr>
                  <td>2. ร้อยละของอาจารย์ผู้รับผิดชอบหลักสูตรที่มีตำแหน่งทางวิชาการ</td> 
                  <td>@if($C<=60)
                      {{$C}}
                      @else
                      60
                      @endif
                  </td>  
                  <td class="text-center">ร้อยละ 60=5</td>  
                  <?php  $result2 = sprintf('%.2f',$qty2); ?> 
                  <td>{{$result2}}</td>            
                </tr>
                <tr>
                  <td>3. ผลงานทางวิชาการของอาจารย์ผู้รับผิดชอบหลักสูตร</td>   
                  <td>@if($E<=20)
                      {{$E}}
                      @else
                      20
                      @endif
                  </td>  
                  <td class="text-center">ร้อยละ 20=5</td>  
                  <?php  $result3 = sprintf('%.2f',$qty3); ?>
                  <td>{{$result3}}</td>          
                </tr>
                <tr>
                  <td class="text-center" colspan="3">คะแนนเฉลี่ยรวม</td>  
                  <?php  $result4 = sprintf('%.2f',$qty1+$qty2+$qty3); ?>  
                  <?php  session()->put('resultpass',$result4); ?>
                  <?php
                    $get=session()->get('resultpass');
                    $get2=session()->get('result');
                    $get3 = sprintf('%.2f',$get/$get2);
                    session()->put('resultavg',$get3); 
                    ?>
                    
                  <td>{{$result4}}</td>          
                </tr>
              </tbody></table>
            </div>
            
            
            <ins>ผลการประเมินตนเอง</ins>
            <div class="box-body">
              <table class="table table-bordered text-center">
                <tbody><tr>
                  <th width="30%" >ตัวบ่งชี้</th>
                  <th width="20%">เป้าหมาย</th>
                  <th colspan="2" width="20%">ผลการดำเนินงาน</th>
                  <th width="20%">คะแนนอิงเกณฑ์ สกอ.</th>
                </tr>
                @if(isset($inc4_2[0]['target']))
                @foreach($inc4_2 as $key =>$row )
                <tr >
                  <td rowspan="2">ตัวบ่งชี้ที่ {{$row['Indicator_id']." ".$row['Indicator_name']}}</td>           
                  <td rowspan="2">{{$row['target']}}</td>
                  <td >{{$row['performance1']}}</td>
                  <td rowspan="2">{{$row['performance3']}}</td>
                  <td rowspan="2">
                  
                  {{$row['score']}}</td>
                </tr>
                <tr>
                <td>{{$row['performance2']}}</td>
                </tr>
                <tr>
                @endforeach
                @else
                <tr>
                  <td rowspan="2">ตัวบ่งชี้ที่ {{$id4_2}} {{$name4_2}}</td>           
                  <td rowspan="2"></td>
                  <td ></td>
                  <td rowspan="2"></td>
                 
                </tr>
                <tr>
                <td></td>
                </tr>
                <tr>
                @endif
              </tbody></table>
            </div>
          </div>
          @endif
          @if($check4_3==1)
          <div class="box-header">
              <h1 class="box-title"><li>ผลที่เกิดกับอาจารย์ (ตัวบ่งชี้ที่ 4.3)</li></h1>
              @if($in4_3!="[]"&&$checkedit!="")<a href="/getindicator4_3/{{$inc[0]['Indicator_id']}}" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไขข้อมูล</a>@endif
              <br><br><br>
            <ins>เกณฑ์การประเมิน</ins><br>
              - มีการรายงานผลการดำเนินงานครบทุกเรื่องตามคำอธิบายในตัวบ่งชี้ (อัตราการคงอยู่ของอาจารย์, ความพึงพอใจของอาจารย์ต่อการบริหารหลักสูตร)<br>
              - มีแนวโน้มผลการดำเนินงานที่ดีขึ้นในทุกเรื่อง (อัตราการคงอยู่ของอาจารย์, ความพึงพอใจของอาจารย์ต่อการบริหารหลักสูตร)<br>
              - มีผลการดำเนินงานที่โด่ดเด่น เทียบเคียงกับหลักสูตรนั้นในสถาบันกลุ่มเดียวกัน โดยมีหลักฐานเชิงประจักษ์ยืนยัน และกรรมการผู้ตรวจประเมินสามารถให้เหตุผลอธิบายว่าเป็นผลการดำเนินงานที่โดดเด่นอย่างแท้จริง<br>

              
            <div class="box-body">
            <br><br><b><ins>ผลการดำเนินงาน</ins></b>
              <table class="table table-bordered" >
                <tbody><tr>
                  <th width="60%" class="text-center">ประเด็นอธิบาย</th>
                  <th width="15%" class="text-center">หลักฐานอ้างอิง</th>
                </tr>
                @if($in4_3!="[]")
                @foreach($in4_3 as $value)
              <tr>
                <td><b>{{$value['category_retention_rate']}}</b><br>
                {!!$value['retention_rate']!!}
                
                </td>
                <td>
                @foreach($value->docindicator4_3 as $key4_3=>$row)
                {{$getcategorypdca4_3[0]['composition_id']}}.{{$id4_3}}-{{$key4_3+1}} {!!$row['doc_file']!!}<br>
                @endforeach
                </td>
              </tr>
              @endforeach
              @else
              <tr>
                <td>-
                </td>
                <td>
                 -
                </td>
              </tr>
              @endif
              </tbody></table>
            </div> 
         
          <div class="box-body">
         <br><b><ins>ผลการประเมินตนเอง</ins></b>
              <table class="table table-bordered">
                <tbody><tr>
                  <th width="30%" class="text-center">ตัวบ่งชี้</th>
                  <th width="20%" class="text-center">เป้าหมาย</th>
                  <th width="20%" class="text-center">ผลการดำเนินงาน</th>
                  <th width="20%" class="text-center">คะแนนอิงเกณฑ์ สกอ.</th>
                </tr>
                @if($inc3!="[]")
                @foreach($inc3 as $key =>$row )
                <tr>
                  <td>ตัวบ่งชี้ที่{{$row['Indicator_id']." ".$row['Indicator_name']}}</td>             
                  <td class="text-center">{{$row['target']}}</td>
                  <td class="text-center">{{$row['performance3']}}</td>
                  <td class="text-center">            
                  
                  {{$row['score']}}</td>
                </tr>
                <tr>
                @endforeach
                @else
                <tr>
                  <td>ตัวบ่งชี้ที่ {{$id4_3}} {{$name4_3}} </td>             
                  <td></td>
                  <td></td>
                  <td>            
                  
                  </td>
                </tr>
                <tr>
                @endif
              </tbody></table>
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