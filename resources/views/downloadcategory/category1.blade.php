@extends('layout.admid_layout')

@section('content')

<div class="box box-warning marginl" id="exportContent">
<div class="box-header" >
                <h3 class="text-center">หมวดที่ 1 ข้อมูลทั่วไป</h3><br>
              @foreach($course as $key =>$value)
              <br><b>หลักสูตร{{$value['course_name']." สาขา" .$getbranch[0]['name']." หลักสูตรปรับปรุง พ.ศ. ".$value['update_course']}} ระดับปริญญาตรี</b><br>
              <b>รหัสหลักสูตร</b> {{$value['course_code']}}<br>
              <b>สถานที่จัดการเรียนการสอน</b> {{$value['place']}}<br>
              @endforeach
              <br><br><br>
              <b>อาจารย์ผู้รับผิดชอบหลักสูตร</b>
                  <div class="box-body">
                  <table class="table table-bordered">
                    <tbody><tr>
                      <th width="15%">มคอ.2</th>
                      <th width="15%">ปัจจุบัน</th>
                      <th width="15%">หมายเหตุ</th>
                    </tr>
                    @foreach($educ_bg as $key =>$row)
                    <tr>
                    @if($course_detail!="[]")<td>{{($key + 1)}}. {{$course_detail[$key]['name']}}<br>@else<td>-@endif
                      @if($course_detail!="[]")
                      <?php 
                     $get=explode("\r\n",$course_detail[$key]['background']);
                       ?>
                       @foreach($get as $getvalue)
                       {{$getvalue}}<br>
                       @endforeach
                       @endif
                      </td>
                      <td>{{($key + 1)}}. {{$row['user_fullname']}}<br>
                      @foreach($row->educational_background as $value) 
                      {{$value['abbreviations']." (".$value['eb_fieldofstudy'].")"}}<br>
                      @endforeach
                      </td>
                      <td></td>
                    </tr>
                    <tr>
                    @endforeach
                  </tbody></table>
                </div>

                <br><br><b>อาจารย์ผู้สอน</b>  
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

                <br><br>@include('category/indi1-1show',['c','count','nameteacher'
                  ,'educ_bg','y','checkpass','checknotpass','tc_course','instructor','specialinstructor','inc','course','checkedit'])
              </div>
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
  Export2Word('exportContent','หมวดที่1 การกำกับให้เป็นมาตรฐาน');
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
    filename = filename?filename+'.docx':'document.docx';
    
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