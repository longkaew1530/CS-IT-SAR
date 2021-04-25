@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
  <div class="box-header">
    <div class="box-body">
      <div class="col-sm-2" align="right"></div>
      <div class="col-sm-9" align="center">
        <h3><i class=""></i>เพิ่มผลการประเมินตนเอง</h3>
        <hr>
      </div>
    </div>
    <form id="adddata" method="POST" action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data">
    @csrf
    @if($pdca[0]['Indicator_id']!='1.1')
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
                <input type="hidden" class="form-control" id="Indicator_id" name="Indicator_id" value="{{$row['pdca_id']}}"/>
                <input type="hidden" class="form-control" id="check" name="check" value="{{$row['Indicator_id']}}"/>
                <tr>
                  <td rowspan="2">ตัวบ่งชี้ที่ {{$row['Indicator_id']." ".$row['Indicator_name']}}</td>           
                  <td rowspan="2"><input type="number" max="5" min="0" class="form-control text-center" name="target" value="{{$row['target']}}"></td>
                  @if($per1!=null)
                    <td ><input class="form-control" type="number" name="performance1" max="5" min="0" value="{{$row['performance1']}}" readonly></td></td>
                    <td rowspan="2"><input type="number" class="form-control text-center" max="5" min="0" name="performance3" value="{{$row['performance3']}}" readonly></td>
                  @else
                  <td rowspan="2"><input type="number" class="form-control text-center" max="5" min="0" name="performance3" value="{{$row['performance3']}}" ></td>
                  @endif 
                  <td rowspan="2"><input type="number" class="form-control text-center" max="5" min="0" name="score" value="{{$row['score']}}"></td> 
                  
                </tr>
                <tr>
                @if($per1!=null)
                    <td ><input type="number" class="form-control text-center" max="5" min="0" name="performance2" value="{{$row['performance2']}}" readonly></td></td>
                  @endif  
                </tr>
                <tr>
                @endforeach
              </tbody></table>
              @else
          <table class="table table-bordered text-center">
                <tbody><tr>
                  <th width="30%" >ตัวบ่งชี้</th>
                  <th width="10%">เป้าหมาย</th>
                  <th  width="10%">ผลการดำเนินงาน</th>
                  <th width="10%">คะแนนอิงเกณฑ์ สกอ.</th>
                </tr>
                @foreach($pdca as $row)
                <input type="hidden" class="form-control" id="Indicator_id" name="Indicator_id" value="{{$row['pdca_id']}}"/>
                <input type="hidden" class="form-control" id="check" name="check" value="{{$row['Indicator_id']}}"/>
                <tr>
                  <td rowspan="2">ตัวบ่งชี้ที่ {{$row['Indicator_id']." ".$row['Indicator_name']}}</td>           
                  <td rowspan="2"><div class="form-group">
                                  <select class="form-control"  id="courseid"  class="form-control @error('role') is-invalid @enderror" name="target">
                                    <option value="ผ่านมาตรฐาน" <?php if($row['target']=="ผ่านมาตรฐาน"){ print ' selected'; }?>>ผ่านมาตรฐาน</option>
                                    <option value="ไม่ผ่านมาตรฐาน" <?php if($row['target']=="ไม่ผ่านมาตรฐาน"){ print ' selected'; }?>>ไม่ผ่านมาตรฐาน</option>
                                  </select>
                                  </div></td>
                  @if($per1!=null)
                    <td ><div class="form-group">
                                  <select class="form-control"  id="courseid"  class="form-control @error('role') is-invalid @enderror" name="performance1">
                                    <option value="ผ่านมาตรฐาน" <?php if($row['performance1']=="ผ่านมาตรฐาน"){ print ' selected'; }?>>ผ่านมาตรฐาน</option>
                                    <option value="ไม่ผ่านมาตรฐาน" <?php if($row['performance1']=="ไม่ผ่านมาตรฐาน"){ print ' selected'; }?>>ไม่ผ่านมาตรฐาน</option>
                                  </select>
                                  </div></td></td>
                  @endif  
                  <td rowspan="2"><div class="form-group">
                                  <select class="form-control"  id="courseid"  class="form-control @error('role') is-invalid @enderror" name="performance3">
                                    <option value="ผ่านมาตรฐาน" <?php if($row['performance3']=="ผ่านมาตรฐาน"){ print ' selected'; }?>>ผ่านมาตรฐาน</option>
                                    <option value="ไม่ผ่านมาตรฐาน" <?php if($row['performance3']=="ไม่ผ่านมาตรฐาน"){ print ' selected'; }?>>ไม่ผ่านมาตรฐาน</option>
                                  </select>
                                  </div></td>
                  <td rowspan="2"><div class="form-group">
                                  <select class="form-control"  id="courseid"  class="form-control @error('role') is-invalid @enderror" name="score">
                                    <option value="ผ่านมาตรฐาน" <?php if($row['score']=="ผ่านมาตรฐาน"){ print ' selected'; }?>>ผ่านมาตรฐาน</option>
                                    <option value="ไม่ผ่านมาตรฐาน" <?php if($row['score']=="ไม่ผ่านมาตรฐาน"){ print ' selected'; }?>>ไม่ผ่านมาตรฐาน</option>
                                  </select>
                                  </div></td>
                </tr>
                <tr>
                @if($per1!=null)
                    <td ><div class="form-group">
                                  <select class="form-control"  id="courseid"  class="form-control @error('role') is-invalid @enderror" name="performance2">
                                    <option value="ผ่านมาตรฐาน">ผ่านมาตรฐาน</option>
                                    <option value="ไม่ผ่านมาตรฐาน">ไม่ผ่านมาตรฐาน</option>
                                  </select>
                                  </div></td></td>
                  @endif  
                </tr>
                <tr>
                @endforeach
              </tbody></table>
          @endif
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
      var formData = new FormData(this);
      var id = document.getElementById("check");
      

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
        url: "/updateself_assessment_results",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: (data) => {
          if(data){
            swal({
          title: "แก้ไขข้อมูลเรียบร้อย",
          text: "Success",
          icon: "success",
          button: "ตกลง",
        }).then(function() {
          if(id.value=='1.1'){
            window.location = "/category1/indicator1-1"; 
          }
          else if(id.value=='5.4'){
            window.location = "/category4/indicator5_4"; 
          }
          else if(id.value=='4.2'){
            window.location = "/category/indicator4-2"; 
          }
          else{
            window.location = "/category3/pdca/{{session()->get('idmenu')}}";
          }
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
@endsection