@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl ">
  <div class="box-header">
    <h2 class="box-title">ข้อมูลเผยแพร่ผลงานทางวิชาการ</h2>
  </div>
  <button class="btn btn-success ml-1" type="button" data-toggle="modal" data-target="#modal-info"><i class="fa fa-plus"></i> เพิ่มข้อมูล</button>
  <div class="modal  fade" id="modal-info">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">เพิ่มเผยแพร่ผลงานทางวิชาการ</h4>
              </div>
              <form id="adddata" method="POST" action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data" >
                @csrf
                <div class="box-body ">
                <input type="hidden" id="owner" name="owner" >
                <input type="hidden" id="owner2" name="owner2" value="{{ Auth::user()->id }}">
                <input type="hidden" id="checkinfo" name="checkinfo" >
                <div class="form-group">
                <input type="radio" id="cate1" name="cate" value="0" onclick="myFunction()" checked/>
                    <label for="exampleInputPassword1">ตีพิมพ์ในวารสาร</label>
                    <input type="radio" id="cate2" name="cate" value="1" onclick="myFunction2()"/>
                    <label for="exampleInputPassword1">นำเสนอผลงาน</label>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">ผลงานวิจัย</label>
                    <select class="form-control" id="research_results_name" class="form-control @error('role') is-invalid @enderror" 
                    name="research_results_name" onchange="myFunction3()">
                      @foreach($researchresults2 as $value)
                      <option value="{{$value['research_results_id']}}">{{$value['research_results_name']}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div id="myDIV">
                  <div class="form-group">
                    <label for="exampleInputPassword1">ชื่อบทความ</label>
                    <input type="text" class="form-control" id="publish_work_name" name="publish_work_name" placeholder="ชื่อบทความ">
                  </div>
                  <div class="form-group">
                <label>ชื่อเจ้าของผลงาน</label>
                <select class="form-control select1" id="teacher_name" name="teacher_name[]" multiple="multiple" 
                        style="width: 100%;">
                        @foreach($userall as $value)
                      <option value="{{$value['id']}}">{{$value['user_fullname']}}</option>
                        @endforeach
                </select disabled>
              </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">ชื่อวารสาร</label>
                    <input type = "text" class="form-control" id="journal_name" name="journal_name" placeholder="ชื่อวารสาร">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">วัน/เดือน/ปี</label>
                    <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right " id="datepicker" name="publish_work_year">
                </div>
                    <!-- <input type = "date" class="form-control" id="publish_work_year" name="publish_work_year" placeholder="ปีที่"> -->
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">ถึง วัน/เดือน/ปี</label>
                    <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right " id="datepicker5" name="publish_work_yearnew">
                </div>
                    <!-- <input type = "date" class="form-control" id="publish_work_year" name="publish_work_year" placeholder="ปีที่"> -->
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">ฉบับที่</label>
                    <input type = "text" class="form-control" id="publish_work_issue" name="publish_work_issue" placeholder="ฉบับที่">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">หน้า</label>
                    <input type="text" class="form-control" id="publish_work_page" name="publish_work_page" placeholder="หน้า">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">ประเภทการเผยแพร่</label>
                    <select class="form-control" id="category_publish_work" class="form-control @error('role') is-invalid @enderror" name="category_publish_work">
                      @foreach($category as $value)
                      <option value="{{$value['id']}}">{{$value['name']}}</option>
                      @endforeach
                    </select>
                  </div>
                  </div>


                  <div id="myDIV2">
                  <div class="form-group">
                    <label for="exampleInputPassword1">ชื่อผลงาน</label>
                    <input type = "text" class="form-control" id="publish_work_name2" name="publish_work_name2" placeholder="ชื่อผลงาน">
                  </div>
                  <div class="form-group">
                <label>ชื่อเจ้าของผลงาน</label>
                <select class="form-control " id="select3" name="teacher_name2[]" multiple="multiple" 
                        style="width: 100%;">
                        @foreach($userall as $value)
                      <option value="{{$value['id']}}">{{$value['user_fullname']}}</option>
                        @endforeach
                </select>
              </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">ชื่อการประชุม</label>
                    <input type ="text" class="form-control" id="journal_name5" name="journal_name5" placeholder="ชื่องาน">
                  </div>
                  <!-- <div class="form-group">
                    <label for="exampleInputPassword1">วันที่</label>
                    <input type = "text" class="form-control" id="publish_work_date2" name="publish_work_date2" placeholder="วันที่">
                  </div> -->
                  <div class="form-group">
                    <label for="exampleInputPassword1">วัน/เดือน/ปี</label>
                    <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right " id="datepicker2" name="publish_work_yearanddate2">
                </div>
                    <!-- <input type = "date" class="form-control" id="publish_work_yearanddate2" name="publish_work_yearanddate2" placeholder="วันที่"> -->
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">ถึง วัน/เดือน/ปี</label>
                    <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right " id="datepicker7" name="publish_work_yearnew2">
                </div>
                    <!-- <input type = "date" class="form-control" id="publish_work_yearanddate2" name="publish_work_yearanddate2" placeholder="วันที่"> -->
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">สถานที่จัด</label>
                    <input type="text" class="form-control" id="publish_work_place2" name="publish_work_place2" placeholder="สถานที่จัด">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">จังหวัด</label>
                    <input type="text" class="form-control" id="province" name="province" placeholder="จังหวัด">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">ประเทศ</label>
                    <input type="text" class="form-control" id="country" name="country" placeholder="ประเทศ">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">หน้า</label>
                    <input type = "text" class="form-control" id="publish_work_page2" name="publish_work_page2" placeholder="หน้า">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">ประเภทการเผยแพร่</label>
                    <select class="form-control" id="category_publish_work2" class="form-control @error('role') is-invalid @enderror" name="category_publish_work2">
                      @foreach($category as $value)
                      <option value="{{$value['id']}}">{{$value['name']}}</option>
                      @endforeach
                    </select>
                  </div>
                  </div>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-info">บันทึกข้อมูล</button>
                </div>
              </form>
              <input type="hidden" class="form-control" name="id" id="emp_id">

            </div>

            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
  <!-- /.box-header -->
  <div class="box-body">
    <!-- /.box-header -->
    <table id="example3" class="table table-bordered table-striped ">
      <thead>
        <tr>
          <th width="5%">ที่</th>
          <th width="30%">ผลงานที่เผยแพร่</th>
          <th width="30%">ประเภทการเผยแพร่</th>
          <th width="5%">แก้ไข</th>
          <th width="5%">ลบ</th>
        </tr>
      </thead>
      <tbody>
        @foreach($researchresults as $key=>$row)
        <tr>
        <?php 
              $y=0;
              if($row['publish_work_year']<=2500){
                  $y=543;
              }
            ?>
          <td>{{$key+1}}</td>
          @if($row['category']==1)
            
          <td>{{$row['teacher_name'].".(".($row['publish_work_year']+$y).") ".$row['publish_work_name'].". ".$row['journal_name']." ".$row['publish_work_issue']." (".$row['publish_work_year'].") ".$row['publish_work_page']}}</td>
          @else
          <?php
            $get_date=explode(" ",$row['publish_work_date']);          
          ?>
          @if($row['publish_work_date']!="1")
          <td>{{$row['teacher_name'].".(".($row['publish_work_year']+$y).") ".$row['publish_work_name']." ".$row['journal_name'].". ".$row['publish_work_date']." ".$row['publish_work_place'].", ".$row['province'].". ".$row['country']." ".$row['publish_work_page']."."}}</td>
          @else
          <td>{{$row['teacher_name'].".(".($row['publish_work_year']+$y).") ".$row['publish_work_name']." ".$row['journal_name'].". ".$row['province'].". ".$row['country']." ".$row['publish_work_page']."."}}</td>
          @endif
          @endif
          <td>{{$row['name']}}</td>
          <td class="text-center"><button class="btn btn-warning" type="button" data-toggle="modal" data-target="#modal-edit" data-id="{{$row['publish_id']}}"><i class='fa fas fa-edit'></i></button></td>
          <td class="text-center">
          <button type="button" class="btn btn-danger deletedata" data-id="{{$row['publish_id']}}"><i class='fa fa-trash'></i></button>
          </td>
        </tr>
        

        <div class="modal  fade" id="modal-edit">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">แก้ไขผลงานวิจัย</h4>
              </div>
              <form id="updatedata" method="POST" action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data" >
                @csrf
                <input type="hidden" class="form-control" id="owner3" name="owner3" >
                   <input type="hidden" class="form-control" id="id3" name="id" >
                    <input type="hidden" class="form-control" id="getcategory3" name="category" >
                <div class="box-body">
                    <div id="myDIV3">
                  <div class="form-group">
                    <label for="exampleInputPassword1">ชื่อบทความ</label>
                    <input type="text" class="form-control" id="publish_work_name3" name="publish_work_name" placeholder="ชื่อบทความ">
                  </div>
                  <div class="form-group">
                <label>ชื่อเจ้าของผลงาน</label>
                <select class="form-control " id="teacher_name3" name="teacher_name3[]" multiple="multiple" 
                        style="width: 100%;">
                        @foreach($userall as $value)
                      <option value="{{$value['id']}}">{{$value['user_fullname']}}</option>
                        @endforeach
                </select>
              </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">ชื่อวารสาร</label>
                    <input type = "text" class="form-control" id="journal_name3" name="journal_name" placeholder="ชื่อวารสาร">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">วัน/เดือน/ปี</label>
                    <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right " id="datepicker3" name="publish_work_year">
                </div>
                    <!-- <input type = "date" class="form-control" id="publish_work_year3" name="publish_work_year" placeholder="ปีที่"> -->
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">ถึง วัน/เดือน/ปี</label>
                    <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right " id="datepicker6" name="publish_work_yearnew">
                </div>
                    <!-- <input type = "date" class="form-control" id="publish_work_year" name="publish_work_year" placeholder="ปีที่"> -->
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">ฉบับที่</label>
                    <input type = "text" class="form-control" id="publish_work_issue3" name="publish_work_issue" placeholder="ฉบับที่">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">หน้า</label>
                    <input type="text" class="form-control" id="publish_work_page3" name="publish_work_page" placeholder="หน้า">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">ประเภทการเผยแพร่</label>
                    <select class="form-control" id="category_publish_work3" class="form-control @error('role') is-invalid @enderror" name="category_publish_work">
                      @foreach($category as $value)
                      <option value="{{$value['id']}}">{{$value['name']}}</option>
                      @endforeach
                    </select>
                  </div>
                  </div>


                  <div id="myDIV4">
                  <div class="form-group">
                    <label for="exampleInputPassword1">ชื่อผลงาน</label>
                    <input type = "text" class="form-control" id="publish_work_name4" name="publish_work_name3" placeholder="ชื่อผลงาน">
                  </div>
                  <div class="form-group">
                <label>ชื่อเจ้าของผลงาน</label>
                <select class="form-control " id="teacher_name4" name="teacher_name4[]" multiple="multiple" 
                        style="width: 100%;">
                        @foreach($userall as $value)
                      <option value="{{$value['id']}}">{{$value['user_fullname']}}</option>
                        @endforeach
                </select>
              </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">ชื่อการประชุม</label>
                    <input type = "text" class="form-control" id="journal_name4" name="journal_name3" placeholder="ชื่องาน">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">วัน/เดือน/ปี</label>
                    <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right " id="datepicker4" name="publish_work_yearanddate3">
                </div>
                    <!-- <input type = "date" class="form-control" id="publish_work_yearanddate4" name="publish_work_yearanddate3" placeholder="วันที่"> -->
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">ถึง วัน/เดือน/ปี</label>
                    <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right " id="datepicker8" name="publish_work_yearnew3">
                </div>
                    <!-- <input type = "date" class="form-control" id="publish_work_yearanddate2" name="publish_work_yearanddate2" placeholder="วันที่"> -->
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">สถานที่จัด</label>
                    <input type="text" class="form-control" id="publish_work_place4" name="publish_work_place3" placeholder="สถานที่จัด">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">จังหวัด</label>
                    <input type="text" class="form-control" id="province4" name="province3" placeholder="จังหวัด">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">ประเทศ</label>
                    <input type="text" class="form-control" id="country4" name="country3" placeholder="ประเทศ">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">หน้า</label>
                    <input type = "text" class="form-control" id="publish_work_page4" name="publish_work_page3" placeholder="หน้า">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">ประเภทการเผยแพร่</label>
                    <select class="form-control" id="category_publish_work4" class="form-control @error('role') is-invalid @enderror" name="category_publish_work3">
                      @foreach($category as $value)
                      <option value="{{$value['id']}}">{{$value['name']}}</option>
                      @endforeach
                    </select>
                  </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-info">บันทึกข้อมูล</button>
                </div>
              </form>
              <input type="hidden" class="form-control" name="id" id="emp_id">

            </div>

            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
  </div>

  @endforeach
  </tbody>
  </table>

</div>


<!-- /.box-body -->
</div>
<!-- /.box-body -->
</div>
<style>
  .marginl {
    padding: 10px;
  }

  .wid10 {
    width: 10%;
  }

  .wid20 {
    width: 20%;
  }

  .wid30 {
    width: 30%;
  }

  .wid40 {
    width: 40%;
  }

  .wid50 {
    width: 50%;
  }

  .mt20 {
    margin-top: 50px
  }

  .ml-1 {
    margin-left: 10px
  }

  .ml-2 {
    margin-left: 20px
  }

  .mt-3 {
    margin-top: 30px;
  }
#myDIV{
    display:block;
}
#myDIV2{
    display:none;
}
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>
<script type="text/javascript" >
  $(function () {
    var currentTime = new Date()
    var year = currentTime.getFullYear()
    $.fn.datepicker.defaults.language = 'th';
    $.fn.datepicker.defaults.format = 'yyyy/mm/dd';
    if(year<2500){
      year=year+543;
    }
    $('#datepicker').datepicker({
    defaultViewDate: {year: year},
    autoclose: true,
  })
  $('#datepicker2').datepicker({
    defaultViewDate: {year: year},
    autoclose: true,
  })
  $('#datepicker3').datepicker({
    defaultViewDate: {year: year},
    autoclose: true,
  })
  $('#datepicker4').datepicker({
    defaultViewDate: {year: year},
    autoclose: true,
  })
  $('#datepicker5').datepicker({
    defaultViewDate: {year: year},
    autoclose: true,
  })
  $('#datepicker6').datepicker({
    defaultViewDate: {year: year},
    autoclose: true,
  })
  $('#datepicker7').datepicker({
    defaultViewDate: {year: year},
    autoclose: true,
  })
  $('#datepicker8').datepicker({
    defaultViewDate: {year: year},
    autoclose: true,
  })
   //as you defined in bootstrap-datepicker.XX.js
});
</script>
<script>
  $(function() {
    $('#example3').DataTable({
      lengthMenu: [8, 20, 50, 100]
    })
  });
 
</script>

<script type="text/javascript">

// function doAction(el) {

// for (var i = 0; i < document.getElementById('owner1').length; i++) {
//     var v = (i != el.selectedIndex ? '' : 'disabled');

//     document.getElementById('owner1')[i].disabled = v;
//     if (document.getElementById('owner1').selectedIndex == el.selectedIndex)
//         document.getElementById('owner1').selectedIndex = 0;

//     document.getElementById('select')[i].disabled = v;
//     if (document.getElementById('select').selectedIndex == el.selectedIndex)
//         document.getElementById('select').selectedIndex = 0;
// }
// }
  // $('#formadd').ajaxForm(function() {
  //   swal({
  //     title: "บันทึกข้อมูลเรียบร้อย",
  //     text: "",
  //     icon: "success",
  //     button: "ตกลง",
  //   }).then(function() {
  //     window.location = "/research_results";
  //   });
  // });
  // $('#updatedata').ajaxForm(function() {
  //   swal({
  //     title: "แก้ไขข้อมูลเรียบร้อย",
  //     text: "",
  //     icon: "success",
  //     button: "ตกลง",
  //   }).then(function() {
  //     window.location = "/research_results";
  //   });
  // });
</script>
<script>
  $(document).ready(function() {
    $('#select3').select2({
        
      })
      $('#teacher_name3').select2({
        
      })
      $('#teacher_name4').select2({
        
      })
      $('.select1').select2({
        
      })
    $selectElement = $('#teacher_name').select2({
      allowClear: true,
    placeholder: {
        id: "0",
        placeholder: "Select an Title"
    }
  });
  document.getElementById("research_results_name").selectedIndex = "-1";
  $("#checkinfo").val(1);
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $('#adddata').submit(function(e) {
      e.preventDefault();
      var formData = new FormData(this);
      // var owner = document.getElementById("owner").value;
      // var research_results_year = document.getElementById("research_results_year").value;
      // var research_results_name = document.getElementById("research_results_name").value;
      // var research_results_salary = document.getElementById("research_results_salary").value;
      // var teacher_name = $('#teacher_name').val();
      
      // var checkdup="aaaaa";
      //       for (index = 0; index < teacher_name.length; ++index) {
      //         if(teacher_name[index]==owner){
      //           checkdup="";
      //         }
      //       }
      // var gettname="";
      //       for (index = 0; index < teacher_name.length; ++index) {
      //         if(teacher_name[index]!=""){
      //           gettname="aaaa";
      //        }
      //       }
      //       console.log(research_results_salary);
      // if(checkdup==""){
      //    swal({
      //     title: "ชื่อผู้วิจัยไม่สามารถซ้ำกับชื่อผู้ร่วมวิจัยได้",
      //     text: "",
      //     icon: "warning",
      //     showConfirmButton: false,
      //   });
      // }
      // else if(owner==""||research_results_year==""||research_results_name==""||research_results_salary==""){
      //   swal({
      //     title: "กรุณาป้อนข้อมูลให้ครบ",
      //     text: "",
      //     icon: "warning",
      //     showConfirmButton: false,
      //   });
      // }
      // else{
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
        url: "/addpublish_work",
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
          window.location = "/publish_work";
        });
          }
        },
        error: function(data) {
          swal({
          title: "วัน/เดือน/ปี ไม่ถูกต้อง",
          text: "",
          icon: "error",
          showConfirmButton: false,
        });
          
          console.log(data.responseJSON.errors);
        }
      });
      } else {
        
      }
    });
  
    });
    $('#updatedata').submit(function(e) {
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
        url: "/updatepublish_work",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: (data) => {
          if(data){
            swal({
          title: "แก้ไขข้อมูลเรียบร้อย",
          text: "",
          icon: "success",
          button: "ตกลง",
        }).then(function() {
          window.location = "/publish_work";
        });
          }
        },
        error: function(data) {
          swal({
          title: "วัน/เดือน/ปี ไม่ถูกต้อง",
          text: "",
          icon: "error",
          showConfirmButton: false,
        });
          
          console.log(data.responseJSON.errors);
        }
      });
      } else {
        
      }
    });

    });

    $('#modal-edit').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget);
      var id = button.data('id');
      var modal = $(this);
      var studentSelect = $('#select');
      modal.find('#emp_id').val(id);
      var url = "/getpublish_work";
      $.get(url + '/' + id, function(data) {
        //success data
        
        $("#id3").val(data[0].publish_id);
          $("#getcategory3").val(data[0].category);
          $("#owner3").val(data[0].owner);
        if(data[0].category==1){
          var x = document.getElementById("myDIV3");
          x.style.display = "block";
          var n = document.getElementById("myDIV4");
          n.style.display = "none";
          var get=[];
        for (index = 0; index < data.length; ++index) {
                
                  get[index]=data[index].user_id;
               
        }
        $("#teacher_name3").val(get);
        $('#teacher_name3').select2();
        $("#publish_work_name3").val(data[0].publish_work_name);
        $("#journal_name3").val(data[0].journal_name);
        $("#datepicker3").val(data[0].publish_work_yearanddate);
        $('#datepicker3').datepicker("setDate", new Date(data[0].publish_work_yearanddate));
        $("#datepicker6").val(data[0].publish_work_yearanddate2);
        $('#datepicker6').datepicker("setDate", new Date(data[0].publish_work_yearanddate2));
        $("#publish_work_issue3").val(data[0].publish_work_issue);
        $("#publish_work_page3").val(data[0].publish_work_page);
        $("#category_publish_work3").val(data[0].category_publish_work);
        }
        else{
          var x = document.getElementById("myDIV3");
          x.style.display = "none";
          var n = document.getElementById("myDIV4");
          n.style.display = "block";
          var get=[];
          for (index = 0; index < data.length; ++index) {
               
                  get[index]=data[index].user_id;
               
        }
        $("#teacher_name4").val(get);
        $('#teacher_name4').select2();
        $("#publish_work_name4").val(data[0].publish_work_name);
        $("#journal_name4").val(data[0].journal_name);
        if(data[0].publish_work_date==1){
          $("#publish_work_date4").val('-');
        }
        else{
          $("#publish_work_date4").val(data[0].publish_work_date);
        }
        $("#datepicker4").val(data[0].publish_work_yearanddate);
        $('#datepicker4').datepicker("setDate", new Date(data[0].publish_work_yearanddate));
        $("#datepicker8").val(data[0].publish_work_yearanddate2);
        $('#datepicker8').datepicker("setDate", new Date(data[0].publish_work_yearanddate2));
        $("#publish_work_page4").val(data[0].publish_work_page);
        $("#publish_work_place4").val(data[0].publish_work_place);
        $("#province4").val(data[0].province);
        $("#country4").val(data[0].country);
        $("#category_publish_work4").val(data[0].category_publish_work);
        }
        

        $('#select').select2({
        
      })
      


        
        
      })
    });
  });

  
</script>
<script type="text/javascript">
  $(".deletedata").click(function() {
    var id = $(this).data("id");
    var token = $("meta[name='csrf-token']").attr("content");
    console.log(id);
    swal({
      title: "ยืนยันการลบข้อมูล?",
      icon: "warning",
      buttons: true,
      successMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
      url: "/deletepublish_work/" + id,
      type: 'post',
      data: {
        "id": id,
        "_token": token,
      },
      success: function(data) {
        swal({
          title: "ลบข้อมูลเรียบร้อยแล้ว",
          text: "",
          icon: "success",
          button: "ตกลง",
        }).then(function() {
          window.location = "/publish_work";
        });
      }
    });
      } else {
        
      }
    });
  });
  
</script>
<script>
function myFunction() {
  $("#checkinfo").val(1);
  var x = document.getElementById("myDIV");
    x.style.display = "block";
    var n = document.getElementById("myDIV2");
    n.style.display = "none";

}
function myFunction2() {
  $("#checkinfo").val(0);
  var x = document.getElementById("myDIV2");
    x.style.display = "block";
    var n = document.getElementById("myDIV");
    n.style.display = "none";

}
function myFunction3() {
  var e = document.getElementById("research_results_name");
  var id = e.value;
  var radios = document.getElementById('cate1');
  
  $.ajax({  //create an ajax request to display.php
          type: "GET",
          url: "/getresu/"+id,       
          success: function (data) {
            var get=[];
            for (index = 0; index < data.length; ++index) {
                      get[index]=data[index].user_id;
            }
            $("#owner").val(data[0].owner);
            if(radios.checked){
            $("#checkinfo").val(1);
            $(".select1").empty();
            for (index = 0; index < data.length; ++index) {
            var newOption = new Option(data[index].user_fullname, data[index].user_id, true, true);
            $('.select1').append(newOption).trigger('change');
            }
            }
            else{
              $("#checkinfo").val(0);
              $("#select3").empty();
            for (index = 0; index < data.length; ++index) {
            var newOption = new Option(data[index].user_fullname, data[index].user_id, true, true);
            $('#select3').append(newOption).trigger('change');
            }
            }
          }
        });
}
</script>
@endsection