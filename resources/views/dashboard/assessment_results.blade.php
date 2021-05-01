@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl ">
            <div class="box-header">
              <h2 class="box-title">เลือกหมวดการประเมินประจำปี</h2>
            </div>
            
            <!-- <button  class="btn btn-success ml-1" type="button" data-toggle="modal" data-target="#modal-info"><i class="fa fa-plus"></i> เพิ่มหมวด</button>

            <div class="modal  fade" id="modal-info">
            <div class="modal-dialog">
                <div class="modal-content">
                   <div class="modal-header">
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                        <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">เพิ่มหมวด</h4>
                  </div>
                      <form  method="POST" action="/addassessment_results">
                       @csrf
                  <div class="box-body">
                      <div class="form-group">
                      @if($cAss!=0)
                          @foreach($Category as $row)
                            @foreach($Assessment_results as $value)
                            @if($row['category_id']==$value['category_id'])
                            @continue
                            @endif
                                  <div class="checkbox">
                                        <label>
                                        <input type="checkbox" class="minimal" value="{{$row['category_id']}}"  name="per[]" >     
                                        {{$row['category_name']}}
                                        </label>
                                  </div>
                            @endforeach

                          @endforeach

                      @else
                      @foreach($Category as $row1)
                      <div class="checkbox">
                            <label>
                            <input type="checkbox" class="minimal" value="{{$row1['category_id']}}"  name="per[]" >     
                             {{$row1['category_name']}}
                            </label>
                      </div>
                      @endforeach
                      @endif
                      
                      </div>
                  </div>
            
                   <div class="modal-footer">
                      <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">ปิด</button>
                      <button type="submit" class="btn btn-info">บันทึกข้อมูล</button>
                    </div>
                    </form>       
            </div>
             /.modal-content -->
          <!-- </div> -->
          <!-- /.modal-dialog -->
        <!-- </div>  -->
            <!-- /.box-header -->
            <div class="box-body">
            <!-- /.box-header -->
            <!-- <table id="example3" class="table table-bordered table-striped ">
                <thead>
                <tr>
                  <th width="5%">ที่</th>
                  <th width="5%">สถานะ</th>
                  <th >หมวด</th>
                  <th></th>
                  
                </tr>
                </thead>
                <tbody>
                  @foreach($Assessment_results as $key=>$row)
                <tr>
                  <td>{{$key+1}}</td>
                  <td class="details-control"><button type="button" class="btn btn-success aaa"  id="{{$row->year_id}}"><i class="fa fa-check"></i></button></td>
                  <td>{{$row['category_name']}}</td> 
                  <td class="text-center"><i class="fa fa-sort-down fa-lg" id="add" type="button" data-id="{{$key}}"></i></td>
                </tr>
       
                <div class="slider">
                    ... Data to be shown ...
                </div>
        <div class="modal  fade" id="modal-edit">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">เพิ่มข้อมูลกลุ่มเมนู</h4>
              </div>
              <form  method="POST" action="/updatecategory">
              @csrf
              {{ method_field('PUT') }}
              <div class="box-body">
              <div class="form-group">
              <input type="hidden" class="form-control" id="category_id" name="category_id" >
                  <label for="exampleInputEmail1">หมวด</label>
                  <input type="text" class="form-control" id="categoryname" name="category_name" placeholder="หมวด">
                </div>
              </div>
            
              <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">ปิด</button>
                <button type="submit" class="btn btn-info">บันทึกข้อมูล</button>
              </div>
              </form>
              <input type="hidden" class="form-control" name="id" id="emp_id" >
              
            </div>
            
             /.modal-content -->
          <!-- </div>
           /.modal-dialog -->
        <!-- </div>
            </div>

                @endforeach
                </tbody>
              </table>  -->
              <table id="myTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
            <th width="5%">ที่</th>
                  <th width="5%"></th>
                  <th >หมวด</th>
                  <th width="5%"></th>

            </tr>
        </thead>
    </table>
            </div>

            
            <!-- /.box-body -->
          </div>
            <!-- /.box-body -->
          </div>
          <div class="slider">
    ... Data to be shown ...
</div>
<style>
.marginl{
  padding:10px;
}
div.slider {
    display: none;
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
.toggle {
    --width: 40px;
    --height: calc(var(--width) / 2);
    --border-radius: calc(var(--height) / 2);

    display: inline-block;
    cursor: pointer;
}
.toggle__input {
    display: none;
}
.toggle__fill {
    position: relative;
    width: var(--width);
    height: var(--height);
    border-radius: var(--border-radius);
    background: #dddddd;
    transition: background 0.2s;
}
.toggle__fill::after {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    height: var(--height);
    width: var(--height);
    background: #ffffff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.25);
    border-radius: var(--border-radius);
    transition: transform 0.2s;
}
.toggle__input:checked ~ .toggle__fill {
    background: #009578;
}

.toggle__input:checked ~ .toggle__fill::after {
    transform: translateX(var(--height));
}
</style>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"></script>
<script src="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css"></script>
<script>
$(document).ready(function() {
  var table = $('#myTable').DataTable( {
    ajax: {url:"/getassessment_results",dataSrc:""},
    columns: [
        { data: "category_id" },
        {"data" : function(data) {
        if(data.active==1){
          return '<label class="toggle" for="cate'+data.id+'"><input class="toggle__input add" onclick="calc('+data.id+');"  type="checkbox" id="cate'+data.id+'"checked ><div class="toggle__fill"></div></label>'
        }
        else{
          return '<label class="toggle" for="cate'+data.id+'"><input class="toggle__input add" onclick="calc('+data.id+');"  type="checkbox" id="cate'+data.id+'"><div class="toggle__fill"></div></label>'
        }
       }},
        { data: "category_name" },
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
      if(value.active==1&&value.Indicator_id!=null){
        text=text+'<tr>'+
                '<td width="5%"></td>'+
                '<td width="5%"><label class="toggle" for="'+`${value.id}`+'"><input class="toggle__input" onclick="calc2('+value.id+');"  type="checkbox" id="'+`${value.id}`+'" checked><div class="toggle__fill"></div></label>'+
                '<td>'+"ตัวบ่งชี้"+`${value.Indicator_id} ${value.Indicator_name}`+'</td>'+
            '</tr>';
      }
      else if(value.Indicator_id!=null){
        text=text+'<tr>'+
                '<td width="5%"></td>'+
                '<td width="5%"><label class="toggle" for="'+`${value.id}`+'"><input class="toggle__input" onclick="calc2('+value.id+');"  type="checkbox" id="'+`${value.id}`+'" ><div class="toggle__fill"></div></label>'+
                '<td>'+"ตัวบ่งชี้"+`${value.Indicator_id} ${value.Indicator_name}`+'</td>'+
            '</tr>';
      }
      else if(value.active==1&&value.Indicator_id==null){
        text=text+'<tr>'+
                '<td width="5%"></td>'+
                '<td width="5%"><label class="toggle" for="'+`${value.id}`+'"><input class="toggle__input" onclick="calc2('+value.id+');" type="checkbox" id="'+`${value.id}`+'" checked><div class="toggle__fill"></div></label>'+
                '<td>'+`${value.Indicator_name}`+'</td>'+
            '</tr>';
      }
      else{
        text=text+'<tr>'+
                '<td width="5%"></td>'+
                '<td width="5%"><label class="toggle" for="'+`${value.id}`+'"><input class="toggle__input" onclick="calc2('+value.id+');" type="checkbox" id="'+`${value.id}`+'" ><div class="toggle__fill"></div></label>'+
                '<td>'+`${value.Indicator_name}`+'</td>'+
            '</tr>';
      }
    }
      
    console.log(text);
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
        var url = "/getclidincategory";
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

</script>
<script>
  $(function() {
    $('.toggle-class').change(function() {
        var status = $(this).prop('checked') == true ? 1 : 0; 
        var user_id = $(this).data('id'); 
         
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/changeStatus',
            data: {'status': status, 'user_id': user_id},
            success: function(data){
              console.log(data.success)
            }
        });
    })
  })
</script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }); 
    $(".add").click(function(e){
      var token = $('meta[name="csrf-token"]').attr('content');
      var id = $(this).attr('id');
        e.preventDefault();
        console.log("asdasdasd")
        // $.ajax({
        //    type:'PUT',
        //    url:'/nextyear',
        //    data: {
        //   _token : token 
        // },
        //    success:function(data){
        //     swal({
        //       title: "เพิ่มข้อมูลเรียบร้อยแล้ว",
        //     text: "",
        //     icon: "success",
        //     button: "ตกลง",
        //    }).then(function() {
        //       window.location = "/";
        //    });
        //    }
        // });
	});
function calc(id)
{
  var token = $('meta[name="csrf-token"]').attr('content');
  var  cb = document.getElementById("cate"+id);
  var getvalue=0;
  if (cb.checked == true){
    getvalue=1;
  } else {
    getvalue=0;
  }
  $.ajax({  //create an ajax request to display.php
          type: "GET",
          url: "/getallresult",       
          success: function (data) {
            if(data.score==0){
              swal({
      title: "ยืนยันการบันทึก?",
      icon: "warning",
      buttons: true,
      successMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
           type:'PUT',
           url:'/updateactive/'+id,
           data: {
          _token : token,
           value:getvalue,
        },
           success:function(data){
            swal({
              title: "แก้ไขข้อมูลเรียบร้อย",
            text: "",
            icon: "success",
            button: "ตกลง",
           }).then(function() {
            window.location = "/assessment_results";
           });
           }
        });
      } else {
       
      }
    });
            }
            else{
              swal({
              title: "ไม่สามารถแก้ไขข้อมูลได้",
              text: "เนื่องจากเพิ่มข้อมูลไปแล้ว",
              icon: "error",
              showConfirmButton: false,
            }).then(function() {
              window.location = "/assessment_results";
            });
            }
          }
        });

        
}
function calc2(id)
{
  var token = $('meta[name="csrf-token"]').attr('content');
  var  cb = document.getElementById(id);
  var getvalue=0;
  if (cb.checked == true){
    getvalue=1;
  } else {
    getvalue=0;
  }
    $.ajax({  //create an ajax request to display.php
          type: "GET",
          url: "/getallresult",       
          success: function (data) {
            console.log(data);
            if(data.score==0){
              swal({
      title: "ยืนยันการบันทึก?",
      icon: "warning",
      buttons: true,
      successMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
           type:'PUT',
           url:'/updateactive2/'+id,
           data: {
          _token : token,
           value:getvalue,
        },
           success:function(data){
            swal({
              title: "แก้ไขข้อมูลเรียบร้อย",
            text: "",
            icon: "success",
            button: "ตกลง",
           }).then(function() {
            window.location = "/assessment_results";
           });
           }
        });
      } else {
       
      }
    });
            }
            else{
              swal({
              title: "ไม่สามารถแก้ไขข้อมูลได้",
              text: "เนื่องจากเพิ่มข้อมูลไปแล้ว",
              icon: "error",
              showConfirmButton: false,
            }).then(function() {
              window.location = "/assessment_results";
            });
            }
          }
        });
}
</script>
@endsection