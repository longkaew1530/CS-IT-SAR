@extends('layout.admid_layout')
@section('content')
<div class="box box-warning ">
  <div class="box-header">
    <div class="box-body">
      <div class="col-sm-2" align="right"></div>
      <div class="col-sm-8" align="center">
      @if($data!="[]")
      <h3><i class=""></i>คุณภาพการสอน</h3><hr>
      </div>
    </div>
    
    <div class="data">
        <div class="col-md-12">
    <div id="body">
      <div class="col-md-12 col-sm-9 col-xs-12">
    <form id="adddata" method="POST" action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data">
    @csrf
    <table class="table table-bordered">
                <tbody><tr>
                  <th width="15%" rowspan="3" class="text-center">รหัส ชื่อวิชา</th>
                  <th width="10%" rowspan="3" class="text-center">ภาคการศึกษา</th>
                  <th width="10%" rowspan="3" class="text-center">ชั้นปีการศึกษา</th>
                  <th width="15%"  colspan="2" class="text-center">ผลการประเมินโดยนักศึกษา</th>
                  <th width="30%" rowspan="3" class="text-center">แผนการปรับปรุง</th>
                </tr>
                <tr>
                    <th class="text-center">มี</th>
                    <th class="text-center">ไม่มี</th>
                </tr>
                <tr>
                    <th class="text-center">เลือกทั้งหมด<br>
                    <div class="radio">
                    <label>
                      <input type="radio" id="ONE" onclick="calc()" >
                    </label>
                    </div>
                    </th>
                    <th class="text-center">เลือกทั้งหมด<br>
                    <div class="radio">
                    <label>
                      <input type="radio" id="TWO"   onclick="calc2()" >
                    </label>
                    </div>
                    </th>
                    
                </tr>
                @foreach($data as $value)
                <tr> 
                <td>{{$value['course_name']}}</td>
                <td class="text-center">{{$value['term_year']}}</td>
                <td class="text-center"><div class="form-group">
                                  <select class="form-control"  id="student_year"  class="form-control @error('role') is-invalid @enderror" name="student_year{{$value['id']}}">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                  </select>
                                  </div></td>
                <td class="text-center">
                  <div class="radio">
                    <label>
                      <input type="radio" name="result{{$value['id']}}" id="ONE{{$value['id']}}" value="1" >
                    </label>
                  </div>
                </td>
                <td class="text-center"><div class="radio">
                    <label>
                      <input type="radio" name="result{{$value['id']}}" id="TWO{{$value['id']}}" value="0" >   
                    </label>
                  </div></td>
                <td><textarea class="form-control" rows="3" placeholder="แผนการปรับปรุง" name="planupdate{{$value['id']}}"></textarea></td>
                  </tr>   
                @endforeach         
              </tbody></table>
              
    </div></div></div></div>
    <div class="col-md-12">
          <div class="box-header col-md-12 col-sm-9 col-xs-12">
            <h3 class="box-title">ผลการประเมินคุณภาพการสอนโดยรวม</h3>
          </div>
            <div class="col-md-12 col-sm-9 col-xs-12">
            <textarea class="form-control" rows="3" placeholder="ผลการประเมินคุณภาพการสอนโดยรวม" name="resultall"></textarea>
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
    @else
    <img src="/images1/exclamation-mark.png" width="150">
    <h2>กรุณาป้อนข้อมูลสรุปผลรายวิชาที่เปิดสอน</h2>
    @endif
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
      for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
        }
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
        url: "/addteaching_quality",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: (data) => {
          swal({
          title: "บันทึกข้อมูลเรียบร้อย",
          text: "",
          icon: "success",
          button: "ตกลง",
        }).then(function() {
            window.location = "/category4/teachingquality";
        });
        },
        error: function(data) {
          alert(data.responseJSON.errors.files[0]);
          console.log(data.responseJSON.errors);
        }
      });
      } else {
        
      }
    });
    });
  });

  function myScript() {
    var id = document.getElementById("qtyrate");
    var id2 = document.getElementById("resultscore");
    document.getElementById("performance2").value = id.value;
    document.getElementById("performance3").value = id2.value/id.value;
}
function myScript1() {
    var id = document.getElementById("resultscore");
    var id2 = document.getElementById("qtyrate");
    document.getElementById("performance1").value = id.value;
    document.getElementById("performance3").value = id.value/id2.value;
    document.getElementById("score").value = id.value;
}
</script>
<script>
  function calc() {
    $.ajax({  //create an ajax request to display.php
          type: "GET",
          url: "/getcateall2",       
          success: function (data) {
            for (index = 0; index < data.length; ++index) {
              const cb = document.getElementById("ONE"+data[index].id);
              document.getElementById("TWO").checked = false;
                document.getElementById("ONE"+data[index].id).checked = true;
            }
 
          }
        });
}
function calc2(id) {
      
  $.ajax({  //create an ajax request to display.php
          type: "GET",
          url: "/getcateall2",       
          success: function (data) {
            for (index = 0; index < data.length; ++index) {
              const cb = document.getElementById("TWO"+data[index].id);
              document.getElementById("ONE").checked = false;
              
                document.getElementById("TWO"+data[index].id).checked = true;
            }
 
          }
        });
}
</script>
@endsection