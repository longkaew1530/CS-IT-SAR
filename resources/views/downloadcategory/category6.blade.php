@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl" id="exportContent">
<div class="box-header" >
              <h3 class="text-center">หมวดที่6 ข้อคิดเห็นและข้อเสนอแนะเกี่ยวกับคุณภาพหลักสูตรจากผู้ประเมิน</h3><br>
              <div class="box-header">
              @if($check2==1)
              <div class="box-body">
           <b><h4>ข้อคิดเห็น และข้อเสนอแนะเกี่ยวกับคุณภาพหลักสูตรจากผู้ประเมิน</h4></b>
              <table class="table table-bordered" >
                <tbody><tr>
                  <th width="30%" class="text-center" >ข้อคิดเห็นหรือสาระจากผู้ประเมิน</th>
                  <th width="30%" class="text-center">ความเห็นของผู้รับผิดชอบหลักสูตร</th>
                  <th width="30%" class="text-center" >การนำไปดำเนินการวางแผนหรือปรับปรุงหลักสูตร</th>
                </tr>
                <tr></tr>
                @if($coursemanage!="[]")
                @foreach($coursemanage as $value)
              <tr>
                  <td >{!!$value['comment_assessor']!!}</td>
                  <td >{!!$value['comment_course_responsible_person']!!}</td>
                  <td >@if($checkedit!="")<a href="/getcomment_course/{{$value['id']}}" class="btn btn-warning fr"><i class='fa fas fa-edit'></i></a>@endif{!!$value['update_course']!!}</td>
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
@if($check1==1)
<div class="box-body">
            <b><h3 class="text-center">สรุปการประเมินหลักสูตร</h3></b>
            <br>
            @if($assessmentsummary!="[]")
            @if($checkedit!="")<a href="/getassessment_summary/การประเมินจากผู้ที่สำเร็จการศึกษา" class="btn btn-warning fr"><i class='fa fas fa-edit'></i>แก้ไขข้อมูล</a>@endif
            @else
            @if($checkedit!="")<a href="/addassessment_summary/การประเมินจากผู้ที่สำเร็จการศึกษา" class="btn btn-success fr ml-1"><i class='fa fa-plus'></i> เพิ่มข้อมูล</a>@endif
            @endif
            <b><h4>การประเมินจากผู้ที่สำเร็จการศึกษา (รายงานตามปีที่สำรวจ)</h4></b>
              <table class="table table-bordered">
                <tbody><tr>
                  <th width="30%" class="text-center" >ข้อวิพากษ์ที่สำคัญจากผลการประเมิน</th>
                  <th width="30%" class="text-center">ข้อคิดเห็นของคณาจารย์ต่อผลการประเมิน</th>
                </tr>
                <tr></tr>
                @if($assessmentsummary!="[]")
               @foreach($assessmentsummary as $row)
              <tr>
              
                  <td >{!!$row['evaluation_results']!!}</td>
                  <td >{!!$row['comment_faculty']!!}</td>
              </tr>
              <tr>
              <td colspan="2"><b>ข้อเสนอการเปลี่ยนแปลงในหลักสูตรจากผลการประเมิน</b><br>{!!$row['change_proposal']!!}</td>
              </tr>
              @endforeach
              @else
              <tr>
                  <td >-</td>
                  <td >-</td>
              </tr>
              <tr>
              <td colspan="2"><b>ข้อเสนอการเปลี่ยนแปลงในหลักสูตรจากผลการประเมิน</b><br>-</td>
              </tr>
              @endif
              </tbody></table>


              <br><br>
              @if($assessmentsummary2!="[]")
              @if($checkedit!="")<a href="/getassessment_summary/การประเมินจากผู้ที่มีส่วนเกี่ยวข้อง" class="btn btn-warning fr"><i class='fa fas fa-edit'></i>แก้ไขข้อมูล</a>@endif
            @else
            @if($checkedit!="")<a href="/addassessment_summary/การประเมินจากผู้ที่มีส่วนเกี่ยวข้อง" class="btn btn-success fr ml-1"><i class='fa fa-plus'></i> เพิ่มข้อมูล</a>@endif
            @endif
            <b><h4>การประเมินจากผู้ที่มีส่วนเกี่ยวข้อง (ผู้ใช้บัณฑิต)</h4></b>
              <table class="table table-bordered">
                <tbody><tr>
                  <th width="30%" class="text-center" >ข้อวิพากษ์ที่สำคัญจากผลการประเมิน</th>
                  <th width="30%" class="text-center">ข้อคิดเห็นของคณาจารย์ต่อผลการประเมิน</th>
                </tr>
                <tr></tr>
               @if($assessmentsummary2!="[]")
               @foreach($assessmentsummary2 as $row)
              <tr>
              
                  <td >{!!$row['evaluation_results']!!}</td>
                  <td >{!!$row['comment_faculty']!!}</td>
              </tr>
              <tr>
              <td colspan="2"><b>ข้อเสนอการเปลี่ยนแปลงในหลักสูตรจากผลการประเมิน</b><br>{!!$row['change_proposal']!!}</td>
              </tr>
              @endforeach
              @else
              <tr>
                  <td >-</td>
                  <td >-</td>
              </tr>
              <tr>
              <td colspan="2"><b>ข้อเสนอการเปลี่ยนแปลงในหลักสูตรจากผลการประเมิน</b><br>-</td>
              </tr>
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
  Export2Word('exportContent','หมวดที่6 ข้อคิดเห็น และข้อเสนอแนะเกี่ยวกับคุณภาพหลักสูตรจากผู้ประเมิน');
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
    filename = filename?filename+'.docx':'document.doc';
    
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