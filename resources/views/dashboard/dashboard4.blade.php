@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl ml wid20">
<div class="form-group">
                <label for="exampleInputPassword1">เลือกปีการศึกษาที่ต้องการดูย้อนหลัง</label>
                                  <select  class="form-control" id="year"  onchange="calc2()"  class="form-control @error('role') is-invalid @enderror" name="faculty_id">
                                    @foreach($getyear as $value)
                                    <option value="{{$value['year_id']}}">{{$value['year_name']}}</option>
                                    @endforeach
                                  </select>
</div>
      </div>

<div class="box box-warning marginl ml">
            <div class="box-header">
              <h2 class="box-title">ความคืบหน้าในภาพรวม</h2>
            </div>
            <div class="box-body">
              <table id="myTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
            <th width="5%">ที่</th>
                  <th width="50%">หมวด</th>
                  <th width="25%">ความคืบหน้า</th>
                  <th width="5%"></th>
                  <th ></th>
                  <th width="5%"></th>
            </tr>
        </thead>
    </table>
            </div>
          </div>
          </div>
          </div>
          <div class="slider">
    ... Data to be shown ...
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
  width:40%;
}
.wid40{
  width:40%;
}
.wid50{
  width:50%;
}
.wid90{
  width:55%;
}
.cnt{
  margin-left:100px;
}
.mt20{
  margin-top:50px
}
.ml-1{
  margin-left:10px
}
.mr-1{
  margin-right:10px
}
.ml{
  float:left;
}
td.details-control {
    background: url('images1/Untitled-2.png') no-repeat center center;
    cursor: pointer;
    
}
 
tr.shown td.details-control {
    background: url('images1/Untitled-1.png') no-repeat center center;
}
 
div.slider {
    display: none;
}
</style>
<script
    src=//code.jquery.com/jquery-3.5.1.min.js
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
    crossorigin=anonymous></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"></script>
<script src="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css"></script>
<script type=text/javascript>
$(document).ready(function(){
  $.ajax({  //create an ajax request to display.php
          type: "GET",
          url: "/getallresult",       
          success: function (data) {
            $("#getwork").html(data.score+'%');
          }
        });
        $.ajax({  //create an ajax request to display.php
          type: "GET",
          url: "/getallindicator",       
          success: function (data) {
            var success=0;
           var not=0;
            for (index = 0; index < data.length; ++index) {
              if(data[index].score==100){
              success=success+1;
             }
             else{
              not=not+1;
             }
            }
            $("#not").html(not);
            $("#success").html(success);
          }
        });
        var table = $('#myTable').DataTable( {
    ajax: {url:"/getoverview",dataSrc:""},
    columns: [
        { data: "category_id" },
        {"data" : function(data) {
          if(typeof data.code === 'undefined'){
            return data.category_name
            
          }else{
            return data.category_name+'<br>'+data.code
          }
       }},
        {"data" : function(data) {
          return '<div class="progress progress-xs"><div class="progress-bar progress-bar-'+data.color+'" style="width: '+data.score+'%"></div></div>'
       }},
       {"data" : function(data) {
          return '<span class="badge bg-'+data.color2+'">'+data.score+'%</span>'
       }},
       {"data" : function(data) {
          return '<a href="/showcategory/'+data.category_id+'">ดูรายละเอียด</a>'
       }},
        {
                "class":          'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": ''
            }
    ],
} );
function validate(id) {
        if (document.getElementById(id).checked) {
            alert("checked");
        } else {
            alert("You didn't check it! Let me check it for you.");
        }
    }
function format ( d ) {
     var text="";
     for (const [key, value] of Object.entries(d)) {
      if(value.Indicator_id!=null){
        text=text+'<tr>'+
                '<td width="10%"></td>'+
                '<td width="50%">'+"ตัวบ่งชี้"+`${value.Indicator_id} ${value.Indicator_name}`+'</td>'+
                '<td width="25%">'+'<div class="progress progress-xs"><div class="progress-bar progress-bar-'+`${value.color}`+'" style="width:'+`${value.score}`+'%"></div></div>'+'</td>'+
                '<td width="5%">'+'<span class="badge bg-'+`${value.color2}`+'">'+`${value.score}`+'%</span>'+'</td>'+
                '<td ><a href="/showindicator/'+`${value.Indicator_id}`+'">ดูรายละเอียด</a></td>'+
                '<td ></td>'+
            '</tr>';
      }
      else{
        text=text+'<tr>'+
                '<td width="10%"></td>'+
                '<td width="50%">'+`${value.Indicator_name}`+'</td>'+
                '<td width="25%">'+'<div class="progress progress-xs"><div class="progress-bar progress-bar-'+`${value.color}`+'" style="width:'+`${value.score}`+'%"></div></div>'+'</td>'+
                '<td width="5%">'+'<span class="badge bg-'+`${value.color2}`+'">'+`${value.score}`+'%</span>'+'</td>'+
                '<td ><a href="/showindicator/'+`${value.Indicator_name}`+'">ดูรายละเอียด</a></td>'+
                '<td ></td>'+
            '</tr>';
      }
    }
    return '<div class="slider">'+
        '<table  class="table table-striped table-bordered" style="width:100%" >'+
          text+
        '</table>'+
    '</div>';
}
$('#myTable tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
        var get =row.data();
        var url = "/getclidincategory2";
        var getdata;
        $.get(url + '/' + get.category_id, function (data) {
            getdata=data; 
        })

        if ( row.child.isShown() ) {
            // This row is already open - close it
            $('div.slider', row.child()).slideUp( function () {
                row.child.hide();
                tr.removeClass('shown');
            } );
        }
        else {
            // Open this row
            $.get(url + '/' + get.category_id, function (data) {
              row.child( format(data), 'no-padding' ).show();
             tr.addClass('shown');
 
            $('div.slider', row.child()).slideDown(); 
            })
            
        }
    } );

});
  $(function () {
    $('#example3').DataTable({
      lengthMenu: [ 5, 10, 15, 100]
    })
  })
  function calc2()
{
  var token = $('meta[name="csrf-token"]').attr('content');
  var e = document.getElementById("year");
  var strUser = e.value;
     $.ajax({
           type:'GET',
           url:'/updatebackyear/'+strUser,
           data: {
          _token : token
        },
           success:function(data){
             console.log(data);
            $("#year").val(data);
            $('#myTable').DataTable().ajax.reload();
              // location.reload().then;
           }
        });
}
</script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }); 
    $("#next").click(function(e){
      var token = $('meta[name="csrf-token"]').attr('content');
        e.preventDefault();
        $.ajax({
           type:'PUT',
           url:'/nextyear',
           data: {
          _token : token 
        },
           success:function(data){
            swal({
              title: "เพิ่มข้อมูลเรียบร้อยแล้ว",
            text: "",
            icon: "success",
            button: "ตกลง",
           }).then(function() {
              window.location = "/";
           });
           }
        });
	});
  $("#myid option").click(function() {
    var token = $('meta[name="csrf-token"]').attr('content');
  
     var idb=this.id;
        console.log(this.id);
        // $.ajax({
        //    type:'GET',
        //    url:'/updatesessionyear/'+idb,
        //    data: {
        //   _token : token
        // },
        //    success:function(data){
        //       location.reload();
        //    }
        // });

    
});
  

  $('.aaa').click(function(e){
    var token = $('meta[name="csrf-token"]').attr('content');
    var id = $(this).attr('id');
        e.preventDefault();
        console.log(id);
        $.ajax({
           type:'PUT',
           url:'/backyear',
           data: {
          _token : token,
          id:id 
        },
           success:function(data){
            swal({
              title: "เปิดใช้งานปีการศึกษาเรียบร้อยแล้ว",
            text: "",
            icon: "success",
            button: "ตกลง",
           }).then(function() {
              window.location = "/";
           });
           }
        });
  });
</script>

@endsection