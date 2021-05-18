@extends('layout.admid_layout')

@section('content')
<div class="box box-warning ">
            <div class="box-header">
            <a href="/assign_indicator" class="btn btn-primary fr"><i class='fa fa-arrow-left'></i> กลับ</a>
              <h2 class="box-title">มอบหมายตัวบ่งชี้ </h2>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <?php $checkrole=false ?>
              <form  class="bd" id="adddata" method="POST" action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data">
               @csrf
               <input type="hidden" class="form-control" id="id" name="id" value="{{$userid}}"/>
                @foreach($role as $key=>$row )
                <?php
                $getstatus1=$getstatus[0]['status'.($key+1)]
                 ?>
                <h4><p class="bginfo"><input type="checkbox" id="cate{{$row->category_id}}" name="cate{{$row->category_id}}"   onclick="calc('{{$row->category_id}}');" @if($getstatus1) checked @endif/> <i class="{{$row['icon']}}"></i> {{$row['category_name']}}</p></h4>
                <div class="form-group ml-1">
                @foreach($row->indicator2 as $value)
                    @if($permiss!=null)
                      @foreach($permiss as $row2)
                         @if($row2['Indicator_id']==$value['id'])
                           <?php $checkrole=true; ?>
                         @endif
                      @endforeach
                     @endif
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" id="{{$value['id']}}"   name="per[]" onclick="calc2('{{$row->category_id}}');" value="{{$value['id']}}" @if($checkrole) checked @endif> 
                      <?php $checkrole=false; ?>      
                      <p class="bd">{{$value['Indicator_name']}} @if($value['Indicator_id']!="")(ตัวบ่งชี้ {{$value['Indicator_id']}})@endif</p>
                    </label>
                  </div>
                  @endforeach
          </div>
                 @endforeach
                <button type="submit" class="btn btn-info fr">บันทึกข้อมูล</button>
              </form>
            
            
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
            </div>
            <!-- /.box-body -->
          </div>
            <!-- /.box-body -->
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
.pd-1{
  padding:5px;
}
.ml-1{
  margin-left:10px
}
.bginfo{
    background-color:#63AFBB;
    padding:10px;
}
.bd{
  background-color:#d3e0ea;
}

</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript">
  
  $(document).ready(function(e) {
    $.ajax({  //create an ajax request to display.php
          type: "GET",
          url: "/getcateall",    
          success: function(data){
            var get1=0;
            var get2=0;
            var get3=0;
            var get4=0;
            var get5=0;
            var get6=0;
            var get7=0;
            var get8=0;
            var check=0;
            var notcheck=0;
            for (index = 0; index < data.length; ++index) {
              const cb = document.getElementById(data[index].id);
              if(cb.checked){
                check++;
              }
              else{
                notcheck++;
              }         
            }
            console.log(check);
            // if(check==data.length){
            //   document.getElementById("cate"+id).checked = true;
            // }
            // if(notcheck==data.length){
            //   document.getElementById("cate"+id).checked = false;
            // }
          }
        });
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $('#adddata').submit(function(e) {
      e.preventDefault();
      var formData = new FormData(this);
      swal({
      title: "ยืนยันการบันทึก?",
      icon: "warning",
      buttons: true,
      successMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
        type: 'POST',
        url: "/addindicator",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: (data) => {
          if(data){
            swal({
              title: "บันทึกข้อมูลเรียบร้อย",
          text: "",
          icon: "success",
          button: "ตกลง",
        }).then(function() {
          window.location = "/assign_indicator";
        });
          }
        },
        error: function(data) {
          alert(data.responseJSON.errors.files1[0]);
          console.log(data.responseJSON.errors);
        }
      });
      } else {
        
      }
    });
    });
    
  });
</script>
<script>
  function calc(id) {
      
      $.ajax({  //create an ajax request to display.php
          type: "GET",
          url: "/getcate/"+id,       
          success: function (data) {
            var check=0;
            var notcheck=0;
            for (index = 0; index < data.length; ++index) {
              const cb = document.getElementById(data[index].id);
              if(cb.checked){
                check++;
              }
              else{
                notcheck++;
              }         
            }
            for (index = 0; index < data.length; ++index) {
              const cb = document.getElementById(data[index].id);
              const cb2 = document.getElementById("cate"+id);
              if(!cb2.checked){
                document.getElementById(data[index].id).checked = false;
              }
              else{
                if(cb.checked&&check==data.length){
                document.getElementById(data[index].id).checked = false;
              }
              else{
                document.getElementById(data[index].id).checked = true;
              }
              }
              
              
            }
 
          }
        });
}
function calc2(id) {
      
      $.ajax({  //create an ajax request to display.php
          type: "GET",
          url: "/getcate/"+id,       
          success: function (data) {
            var check=0;
            var notcheck=0;
            for (index = 0; index < data.length; ++index) {
              const cb = document.getElementById(data[index].id);
              if(cb.checked){
                check++;
              }
              else{
                notcheck++;
              }         
            }
            if(check==data.length){
              document.getElementById("cate"+id).checked = true;
            }
            if(notcheck==data.length){
              document.getElementById("cate"+id).checked = false;
            }
          }
        });
}
</script>
<script>
  $(function () {
    $('#example8').DataTable({
      lengthMenu: [ 10, 20, 50, 100]
    })
  })
</script>
@endsection