@extends('layout.admid_layout')
@section('content')
<div class="box box-warning ">
  <div class="box-header">
    <div class="box-body">
      <div class="col-sm-2" align="right"></div>
      <div class="col-sm-8" align="center">
      <h3><i class=""></i>คุณภาพบัณฑิตตามกรอบมาตรฐานคุณวุฒิระดับอุดมศึกษาแห่งชาติ</h3><hr>
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
                  <th width="80%" class="text-center">ข้อมูลพื้นฐาน</th>
                  <th width="10%" class="text-center">จำนวน</th>
                  
                </tr>
                <td>1. จำนวนบัณฑิตที่สำเร็จการศึกษาในหลักสูตรนี้ทั้งหมด</td>
                <td><input type="text" class="form-control text-center" id="qtyall" name="qtyall" /></td>
                <tr>
                </tr>
                <td>2. จำนวนบัณฑิตในหลักสูตรที่ได้รับการประเมินจากผู้ใช้บัณฑิต</td>
                <td><input type="text" class="form-control text-center" id="qtyrate" name="qtyrate" onchange="myScript()"/></td>
                <tr>
                </tr>
                <td>3. ร้อยละของบัณฑิตที่ได้รับจากการประเมินผู้ใช้บัณฑิตต่อจำนวนบัณฑิตที่สำเร็จการศึกษาทั้งหมด</td>
                <td><input type="text" class="form-control text-center" id="persen" name="persen" /></td>
                <tr>
                </tr>
                <td>4. ผลรวมของค่าคะแนนที่ได้จากการประเมินบัณฑิต</td>
                <td><input type="text" class="form-control text-center" id="sumscore" name="sumscore" /></td>
                <tr>
                </tr>
                <td>5. ค่าเฉลี่ยของคะแนนประเมินบัณฑิต (คะแนนเต็ม5)</td>
                <td><input type="text" class="form-control text-center" id="resultscore" name="resultscore" onchange="myScript1()"/></td>
                <tr>
                </tr>
                
              </tbody></table>
    </div></div></div></div>
              <div class="data">
        <div class="col-md-12">
          <div class="box-header col-md-12 col-sm-9 col-xs-12">
            <h3 class="box-title">ผลการประเมินตนเอง</h3>
          </div>
          <div id="body">
            <div class="col-md-12 col-sm-9 col-xs-12">
            <table class="table table-bordered text-center">
                <tbody><tr>
                  <th width="30%" >ตัวบ่งชี้</th>
                  <th width="10%">เป้าหมาย</th>
                  @if($per1!=null)
                      <th colspan="2" width="10%">ผลการดำเนินงาน</th>
                  @else
                      <th  width="10%">ผลการดำเนินงาน</th>
                  @endif
                  <th width="10%">คะแนนอิงเกณฑ์ สกอ.</th>
                </tr>
                @foreach($pdca as $row)
                <input type="hidden" class="form-control" id="Indicator_id" name="Indicator_id" value="{{$row['Indicator_id']}}"/>
                <tr>
                  <td rowspan="2">ตัวบ่งชี้ที่ {{$row['Indicator_id']}} {{$row['Indicator_name']}}</td>           
                  <td rowspan="2"><input type="number" max="5" min="0" class="form-control text-center" id="target" name="target" ></td>
                  @if($per1!=null)
                    <td ><input type="text" class="form-control text-center" id="performance1" name="performance1"  readonly></td></td>
                  @endif  
                  <td rowspan="2"><input type="text" class="form-control text-center" id="performance3" name="performance3"  readonly></td>
                  <td rowspan="2"><input type="text" class="form-control text-center" id="score"  name="score"  readonly></td>
                </tr>
                <tr>
                @if($per1!=null)
                    <td ><input type="text" class="form-control text-center" id="performance2" name="performance2"  readonly></td></td>
                  @endif  
                </tr>
                <tr>
                @endforeach
              </tbody></table>

            </div>
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
      var qtyall = document.getElementById("qtyall").value;
      var qtyrate = document.getElementById("qtyrate").value;
      var persen = document.getElementById("persen").value;
      var sumscore = document.getElementById("sumscore").value;
      var resultscore = document.getElementById("resultscore").value;
      var target = document.getElementById("target").value;
      if(qtyall==""||qtyrate==""||persen==""||sumscore==""||resultscore==""||target==""){
         swal({
          title: "กรุณาป้อนข้อมูลให้ครบ",
          text: "",
          icon: "warning",
          showConfirmButton: false,
        });
      }
      else{
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
        url: "/addindicator2_1",
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
          if(data.category_factor=="ปัจจัยที่มีผลกระทบต่อจำนวนนักศึกษา"){
            window.location = "/category3/Impactfactors";
          }
          else{
            window.location = "/category3/indicator2-1";
          }
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
  }
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
@endsection