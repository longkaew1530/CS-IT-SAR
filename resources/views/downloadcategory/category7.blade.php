@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl" id="exportContent">
<div class="box-header" >
              <h3 class="text-center">หมวดที่7 แผนการดำเนินงานเพื่อพัฒนาหลักสูตร</h3><br>
              <div class="box-header">
              @if($check1==1)
            <div class="box-body">
           <h4>ความก้าวหน้าของการดำเนินงานตามแผนที่เสนอในรายงานของปีที่ผ่านมา</h4>
              <table class="table table-bordered" >
                <tbody><tr>
                  <th width="30%" class="text-center" >แผนการดำเนินการ</th>
                  <th width="20%" class="text-center">กำหนดเวลาที่แล้วเสร็จ</th>
                  <th width="20%" class="text-center" >ผู้รับผิดชอบ</th>
                  <th width="20%" class="text-center" >ความสำเร็จของแผน/เหตุผลที่ไม่สามารถดำเนินการไม่สำเร็จ</th>
                </tr>
                <tr></tr>
                @if($querystrength!="[]")
                @foreach($querystrength as $key=>$value)
              <tr>
                  <td >{{$key+1}}) {{$value['composition']}}</td>
                  <td >{{$value['strength']}}</td>
                  <td >{{$value['should_develop']}}</td>
                  <td >@if($checkedit!="")<a href="/getstrength/{{$value['id']}}" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไขข้อมูล</a>@endif
                  {{$value['development_approach']}}</td>
              </tr>
                @endforeach
                @else
                <tr>
                  <td >-</td>
                  <td >-</td>
                  <td >-</td>
                  <td >-</td>
              </tr>
                @endif
              </tbody></table>
              </div>
              @endif
              @if($check2==1)
            <div class="box-body">
              <h4>ข้อเสนอในการพัฒนาหลักสูตร</h4></b>
              @if($querydevelopment_proposal!="[]")
              @foreach($querydevelopment_proposal as $key=>$value)
              <b>{{$key+1}}. {{$value['topic']}}</b>&nbsp&nbsp&nbsp @if($checkedit!="")<a href="/getdevelopment_proposal/{{$value['id']}}" class="btn btn-warning "><i class='fa fas fa-edit'></i></a>@endif<br>
              {!!$value['detail']!!}<br>
              @endforeach
              @else
              -
              @endif
              </div>
              @endif
              @if($check3==1)
            <div class="box-body">
              <h4>แผนปฏิบัติการใหม่ สำหรับปี {{ Session::get('year')}}</h4>
              <table class="table table-bordered" >
                <tbody><tr>
                  <th width="30%" class="text-center" >แผนการดำเนินการ</th>
                  <th width="20%" class="text-center">กำหนดเวลาที่แล้วเสร็จ</th>
                  <th width="20%" class="text-center" >ผู้รับผิดชอบ</th>
                </tr>
                <tr></tr>
                @if($querynewstrength!="[]")
                @foreach($querynewstrength as $key=>$value)
              <tr>
                  <td >{{$key+1}}) {{$value['composition']}}</td>
                  <td >{{$value['strength']}}</td>
                  <td > @if($checkedit!="")<a href="/getnewstrength/{{$value['id']}}" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไขข้อมูล</a>@endif
                  {{$value['should_develop']}}</td>
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
  Export2Word('exportContent','หมวดที่7 แผนการดำเนินงานเพื่อพัฒนาหลักสูตร');
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