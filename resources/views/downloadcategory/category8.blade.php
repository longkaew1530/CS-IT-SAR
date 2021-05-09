@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl" id="exportContent">
<div class="box-header" >
              <h3 class="text-center">สรุปผลการประเมินคุณภาพหลักสูตรตามเกณฑ์มาตรฐานของ สกอ.</h3><br>
              <div class="box-header">
              <h3 class="box-title">1. ผลการประเมินคุณภาพหลักสูตรรายตัวบ่งชี้</h3>
            </div>
            <table class="table table-bordered ">
                <tbody><tr>
                  <th rowspan="4" width="50%" class="text-center">ตัวบ่งชี้คุณภาพ</th>
                  <th rowspan="4" width="10%"class="text-center">เป้าหมาย</th>
                  <th colspan="3" width="10%"class="text-center">ประเมินตนเอง</th>   
                </tr>
                <tr>
                <th colspan="2" width="20%" class="text-center">ผลการดำเนินงาน</th>
                  <th rowspan="3" width="10%" class="text-center">คะแนนอิงเกณฑ์</th>
                </tr>
                <tr>
                <th width="10%"class="text-center">ตัวตั้ง</th>
                  <th rowspan="2" width="10%"class="text-center">ผลลัพธ์ (%, สัดส่วน)</th>
                  
                </tr>
                <tr>
                <th width="10%"class="text-center">ตัวหาร</th>
                </tr>
                <?php $resultall=0;
                      $getloop=0; ?>
           
                @foreach($indicator as $row)
                    <tr>

                      <td rowspan="2">
                      ตัวบ่งชี้ที่ {{$row['Indicator_id']." ".$row['Indicator_name']}}
                      </td>

                    <?php $check=$pdca->where('Indicator_id',$row['Indicator_id']); ?>
                    @if($check=='[]')
                    <td rowspan="2" class="text-center">0</td>
                    <td colspan="2" class="text-center">0</td>
                    <td rowspan="2" class="text-center">0.00</td>
                    </tr>
                    <tr></tr>
                    @endif
                   @foreach($pdca as $row1)
                      @if($row1['Indicator_id']==$row['Indicator_id'])
                      <?php 
                            $getvalue=0.0000001;
                            $getvalue=(float)$row1['score'];
                             $resultall=$resultall+$getvalue;
                            $getloop++;
                            $gett=gettype($getvalue);
                      ?>
                      <td class="text-center" rowspan="2">{{$row1['target']}}</td>  
                      @if($row1['performance1']!=null)<td class="text-center" >{{$row1['performance1']}}</td>
                      <td rowspan="2" class="text-center">{{$row1['performance3']}}</td>
                      @else
                      <td colspan="2" class="text-center">{{$row1['performance3']}}</td> 
                      @endif
                      <?php
                        $getpass="";
                       if($row1['Indicator_id']==1.1){
                            if($row1['score']=="ผ่านมาตรฐาน"){
                              $getpass="หลักสูตรได้มาตรฐาน";
                            }
                            else if($row1['score']=="ไม่ผ่านมาตรฐาน"){
                              $getpass="หลักสูตรไม่ได้มาตรฐาน";
                            }
                            else{
                              $getpass="";
                            }
                          }
                      else{
                        $getscore= sprintf('%.2f',$row1['score']);
                      }
                     
                      ?>
                      <td class="text-center" rowspan="2">@if($row1['Indicator_id']==1.1){{$getpass}}@else{{$getscore}}@endif</td> 
                    </tr>
                    <tr>
                      @if($row1['performance1']!=null)
                          <td class="text-center">{{$row1['performance2']}}</td>
                        @endif 
                    </tr>    
                    @endif
                  @endforeach 
                  @endforeach      
                <tr>
                <tr>
                <td class="text-center" colspan="2">ผลการประเมิน</td>
                <?php
                $getget=0;

                if($getloop!=1&&$getloop!=0&&$resultall!=0){
                  $getget=$resultall/($getloop-1); 
                  $scorecategory1 = sprintf('%.2f',$getget);
                 }
                 else{
                   $scorecategory1 =0.00;
                 }
                ?>
                <td  class="text-center" colspan="3">{{$scorecategory1}}</td>
                </tr>
              </tbody></table>  

              <div class="box-header">
              <h3 class="box-title">2. รายงานผลการดำเนินงานในภาพรวมของหลักสูตร</h3>
            </div>
            <table class="table table-bordered ">
                <tbody><tr>
                  <th width="25%" class="text-center">องค์ประกอบที่</th>
                  <th width="5%" class="text-center">คะแนนผ่าน</th>
                  <th width="5%" class="text-center">จำนวนตัวบ่งชี้</th>
                  <th width="10%"class="text-center">I</th>
                  <th width="10%"  class="text-center">P</th>
                  <th width="10%" class="text-center">O</th>
                  <th width="10%" class="text-center">คะแนนเฉลี่ย</th>
                  <th width="40%" >ผลการประเมิน<br>0.01-2.00 ระดับคุณภาพน้อย<br>2.01-3.00 ระดับคุณภาพปานกลาง<br>3.01-4.00 ระดับคุณภาพดี<br>4.01-5.00 ระดับคุณภาพดีมาก</th>
                </tr>
                @foreach($getall as $key=>$value)
                <tr>
                <td>องค์ประกอบที่ {{$key+1}} {{$value['name']}}</td>
                @if($key+1==1)
                <td colspan="6" class="text-center">@if($data[0]['o']!=""){{$data[0]['o']}}@else-@endif</td>
                <?php 
                if($data[0]['o']==="ผ่านการประเมิน")
                {
                    $gett="หลักสูตรได้มาตรฐาน";
                }
                else if($data[0]['o']==="ไม่ผ่านการประเมิน"){
                  $gett="หลักสูตรไม่ได้มาตรฐาน";
                }
                else{
                  $gett="";
                }
                ?>
                <td class="text-center"><b>{{$gett}}</b></td>
                @else
                @if($key+1==2)
                <td rowspan="6" class="text-center"></td>
                @endif
                <td  class="text-center">@if(isset($data[$key]['cindi'])){{$data[$key]['cindi']}}@else-@endif</td>
                <td class="text-center">@if(isset($data[$key]['i'])){{$data[$key]['i']}}@else-@endif</td>
                <td class="text-center">@if(isset($data[$key]['p'])){{$data[$key]['p']}}@else-@endif</td>
                <td class="text-center">@if(isset($data[$key]['o'])){{$data[$key]['o']}}@else-@endif</td>
                <td class="text-center">@if(isset($data[$key]['avr']))<b>{{$data[$key]['avr']}}</b>@else-@endif</td>
                <td class="text-center">@if(isset($data[$key]['result']))<b>{{$data[$key]['result']}}</b>@else-@endif</td>
                @endif
                </tr>
                @endforeach
                <tr>
                  <td class="text-center"><b>รวม</b></td>
                  <td class="text-center"><b>{{$data[0]['cindiall']}}</b></td>
                  <td class="text-center"><b>{{$data[0]['resultindicatori']}}</b></td>
                  <td class="text-center"><b>{{$data[0]['resultindicatorp']}}</b></td>
                  <td class="text-center"><b>{{$data[0]['resultindicatoro']}}</b></td>
                  <td rowspan="2" class="text-center"><b>{{$data[0]['avgall']}}</b></td>
                  <td rowspan="2" class="text-center"><b>@if($data[0]['resultavg']!=""){{$data[0]['resultavg']}}@endif</b></td>
                </tr>
                <tr>
                  <td colspan="3" class="text-center">ผลการประเมิน</td>
                  <td class="text-center"><b>{{$data[0]['resultipo1']}}</b></td>
                  <td class="text-center"><b>{{$data[0]['resultipo2']}}</b></td>
                  <td class="text-center"><b>{{$data[0]['resultipo3']}}</b></td>
                </tr>
              </tbody></table>    
          
                @if($check1==1)
              <div class="box-header">
            <div class="box-body">
              <h4>3. สรุปจุดแข็ง จุดที่ควรพัฒนา และแนวทางการพัฒนา</h4></br>
              @foreach($querynewstrength as $key=>$value)
                  <b>องค์ประกอบที่ {{$value['id']}} {{$value['name']}}</b><br>
                  <table class="table table-bordered" >
                    <tbody><tr>
                      <th width="30%" class="text-center" >จุดแข็ง</th>
                      <th width="30%" class="text-center">จุดที่ควรพัฒนา</th>
                      <th width="30%" class="text-center" >แนวทางการพัฒนา</th>
                    </tr>
                    <tr></tr>
                    @if($value->category7_strengths_summary!="[]")
                    @foreach($value->category7_strengths_summary as $row)
                    <tr>
                      <td>{!!$row['strength']!!}</td>
                      <td>{!!$row['points_development']!!}</td>
                      <td>
                      @if($checkedit!="")<a href="/getstrengths_summary/{{$row['id']}}" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไข</a>@endif
                      {!!$row['development_approach']!!}
                      </td>
                  
                   </tr>
                   @endforeach
                   @else
                   <tr>
                      <td>-</td>
                      <td>-</td>
                      <td>
                      @if($checkedit!="")<a href="/addstrengths_summary/{{$value['id']}}" class="btn btn-success fr"><i class='fa fa-plus'></i> เพิ่ม</a>@endif
                      -
                      </td>
                  
                   </tr>
                   @endif
              </tbody></table><br>
              @endforeach
              
</div>
@endif
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
  Export2Word('exportContent','สรุปผลการประเมินคุณภาพ');
  window.history.back();
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