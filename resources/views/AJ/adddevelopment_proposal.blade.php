@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
  <div class="box-header">
    <div class="box-body">
    <a href="/category7/development_proposal" class="btn btn-info fr"><i class='fa fa-eye'></i> ดูรายงาน</a>
      <div class="col-sm-2" align="right"></div>
      <div class="col-sm-8" align="center">
      
        <h3><i class=""></i>ข้อเสนอในการพัฒนาหลักสูตร</h3>
        <hr>
      </div>
    </div>
    <form id="adddata" method="POST" action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data">
    @csrf
      <div id="show">
        <div class="col-md-12">
          <div class="box-header col-md-12 col-sm-9 col-xs-12">
            <h3 class="box-title">ข้อเสนอ</h3>
          </div>
            <div class="col-md-12 col-sm-9 col-xs-12" id="hed">
            <input type="text" class="form-control" id="topic" name="topic" placeholder="ข้อเสนอ">
            </div>
        </div>
        <div class="col-md-12">
          <div class="box-header col-md-12 col-sm-9 col-xs-12">
            <h3 class="box-title">รายละเอียด</h3>
          </div>
            <div class="col-md-11 col-sm-9 col-xs-12" id="hed">
            <input type="text" class="form-control" id="detail" name="detail[]" placeholder="รายละเอียด">
            </div>
            <div class="col-md-1">
            <button type="button" name="add" id="add" class="btn btn-success"><i class="fa fa-plus"></i></button>
            </div>
        </div>
        </div>
      <div class="col-md-12">
        <div id="body">
          <div class="col-md-12 col-sm-9 col-xs-12">
            <hr>
            <button type="submit" class="btn btn-info pull-right">บันทึกข้อมูล</button>
            </textarea>
          </div>

        </div>
      </div>
    </form>

  </div>
</div>
</div>
<style>
  hr {
    display: block;
    height: 1px;
    border: 0;
    border-top: 1px solid #ccc;
    margin: 1em 0;
    padding: 0;
  }
  .mt{
    margin-top:15px;
  }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(e) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $('#adddata').submit(function(e) {
      e.preventDefault();
      var formData = new FormData(this);
      $.ajax({
        type: 'POST',
        url: "/adddevelopment_proposal",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: (data) => {
          swal({
          title: "เพิ่มข้อมูลเรียบร้อยแล้ว",
          text: "",
          icon: "success",
          button: "ตกลง",
        }).then(function() {
          window.location = "/category7/development_proposal";
        });
        },
        error: function(data) {
          alert(data.responseJSON.errors.files1[0]);
          console.log(data.responseJSON.errors);
        }
      });
    });
  });
  
</script>
<script type="text/javascript">
 $(document).ready(function(){      
var url = "{{ url('add-remove-input-fields') }}";
var i=1;  
$('#add').click(function(){  
var title = $("#term").val();
i++;  
$('#show').append('<div class="col-md-12 mt" id="row'+i+'"><div class="col-md-11 col-sm-9 col-xs-12" id="hed"><input type="text" class="form-control" id="detail" name="detail[]" placeholder="รายละเอียด"></div><div class="col-md-1"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove"><i class="fa fa-minus"></i></button></div></div>');  
});  
$(document).on('click', '.btn_remove', function(){  
var button_id = $(this).attr("id");   
$('#row'+button_id+'').remove();  
}); 
 }); 
</script>
@endsection