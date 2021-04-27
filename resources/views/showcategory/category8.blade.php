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
                  <th width="50%" >ตัวบ่งชี้</th>
                  <th width="10%"class="text-center">เป้าหมาย</th>
                  <th colspan="2" width="20%" class="text-center">ผลการดำเนินงาน</th>
                  <th width="10%" class="text-center">คะแนนอิงเกณฑ์ สกอ.</th>
                </tr>
                @foreach($getall as $key=>$value)
                @php
                $i = $key
                @endphp
                @foreach($indicator as $row)
                  @if($value['id']==$row['composition_id'])
                    <tr>
                    @if($i+1==$value['id'])
                      <td rowspan="2">
                      <ins><b>องประกอบที่ {{$value['id']}} {{$value['name']}}</b></ins><br><br>
                      ตัวบ่งชี้ที่ {{$row['Indicator_id']." ".$row['Indicator_name']}}
                      </td>
                    @else
                      <td rowspan="2">
                      ตัวบ่งชี้ที่ {{$row['Indicator_id']." ".$row['Indicator_name']}}
                      </td>
                    @endif
                    <?php $check=$pdca->where('Indicator_id',$row['Indicator_id']); ?>
                    @if($check=='[]')
                    <td rowspan="2" class="text-center">0</td>
                    <td colspan="2" class="text-center">0</td>
                    <td rowspan="2" class="text-center">0</td>
                    </tr>
                    <tr></tr>
                    @endif
                   @foreach($pdca as $row1)
                      @if($row1['Indicator_id']==$row['Indicator_id'])
                      <td class="text-center" rowspan="2">{{$row1['target']}}</td>  
                      @if($row1['performance1']!=null)<td class="text-center" >{{$row1['performance1']}}</td>
                      <td rowspan="2" class="text-center">{{$row1['performance3']}}</td>
                      @else
                      <td colspan="2" class="text-center">{{$row1['performance3']}}</td> 
                      @endif
                      
                      <td class="text-center" rowspan="2">{{$row1['score']}}</td> 
                    </tr>
                    <tr>
                      @if($row1['performance1']!=null)
                          <td class="text-center">{{$row1['performance2']}}</td>
                        @endif 
                    </tr>    
                    @endif
                  @endforeach 
                  @php
                  $i++
                  @endphp
                  @endif
                  @endforeach      
                <tr>
                @endforeach
              </tbody></table>  

              <div class="box-header">
              <h3 class="box-title">2. รายงานผลการดำเนินงานในภาพรวมของหลักสูตร</h3>
            </div>
            <table class="table table-bordered ">
                <tbody><tr>
                  <th width="30%" class="text-center">องค์ประกอบ</th>
                  <th width="10%"class="text-center">I</th>
                  <th width="10%"  class="text-center">P</th>
                  <th width="10%" class="text-center">O</th>
                  <th width="10%" class="text-center">คะแนนเฉลี่ย</th>
                  <th width="40%" >ผลการประเมิน<br>0.01-2.00 ระดับคุณภาพน้อย<br>2.01-3.00 ระดับคุณภาพปานกลาง<br>3.01-4.00 ระดับคุณภาพดี<br>4.01-5.00 ระดับคุณภาพดีมาก</th>
                </tr>
                @foreach($getall2 as $key=>$value)
                <tr>
                <td>{{$key+1}}. {{$value['name']}}</td>
                @if($key+1==1)
                <td colspan="5" class="text-center">{{$data[0]['o']}}</td>
                @else
                <td class="text-center">@if(isset($data[$key]['i'])){{$data[$key]['i']}}@else-@endif</td>
                <td class="text-center">@if(isset($data[$key]['p'])){{$data[$key]['p']}}@else-@endif</td>
                <td class="text-center">@if(isset($data[$key]['o'])){{$data[$key]['o']}}@else-@endif</td>
                <td class="text-center">@if(isset($data[$key]['avr'])){{$data[$key]['avr']}}@else-@endif</td>
                <td class="text-center">@if(isset($data[$key]['result'])){{$data[$key]['result']}}@endif</td>
                @endif
                </tr>
                @endforeach
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