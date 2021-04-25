@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
<div class="box-header">

  <div id="exportContent">
            <div class="box-header" >
            <h3 class="box-title">ดาวโหลดเอกสาร</h3>
            </div>
              <table class="table table-condensed">
                <tbody><tr>
                  <th>หมวดที่</th>
                  <th></th>
                  <th></th>
                </tr>
                @foreach($query as $key=>$row)
                <div id="show{{$key}}">
                <tr>
                  <td>{{$row['category_name']}}</td>
                  <td>
                    
                  </td>
                  <td><img src="/images1/word.png" width="20px"> <a href="downloadcategory/{{$row['category_id']}}" ><b>ดาวน์โหลด</b></a></td>
                  
                </tr>
                </div>
                @endforeach
              </tbody></table>
</div></div></div>
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
