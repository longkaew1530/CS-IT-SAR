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
    <form id="adddata" method="POST" action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data">
    @csrf
    <table class="table table-bordered">
                <tbody><tr>
                  <th width="80%" class="text-center">ข้อมูลพื้นฐาน</th>
                  <th width="10%" class="text-center">จำนวน</th>
                  @foreach($editdata as $row)
                </tr>
                <td>1. จำนวนบัณฑิตที่สำเร็จการศึกษาในหลักสูตรนี้ทั้งหมด</td>
                <input type="hidden" class="form-control" id="id" name="id" value="{{$row['id']}}"/>
                <td><input type="text" class="form-control" id="qtyall" name="qtyall" value="{{$row['qtyall']}}"/></td>
                <tr>
                </tr>
                <td>2. จำนวนบัณฑิตในหลักสูตรที่ได้รับการประเมินจากผู้ใช้บัณฑิต</td>
                <td><input type="text" class="form-control" id="qtyrate" name="qtyrate" value="{{$row['qtyrate']}}"/></td>
                <tr>
                </tr>
                <td>3. ร้อยละของบัณฑิตที่ได้รับจากการประเมินผู้ใช้บัณฑิตต่อจำนวนบัณฑิตที่สำเร็จการศึกษาทั้งหมด</td>
                <td><input type="text" class="form-control" id="persen" name="persen" value="{{$row['persen']}}"/></td>
                <tr>
                </tr>
                <td>4. ผลรวมของค่าคะแนนที่ได้จากการประเมินบัณฑิต</td>
                <td><input type="text" class="form-control" id="sumscore" name="sumscore" value="{{$row['sumscore']}}"/></td>
                <tr>
                </tr>
                <td>5. ค่าเฉลี่ยของคะแนนประเมินบัณฑิต (คะแนนเต็ม5)</td>
                <td><input type="text" class="form-control" id="resultscore" name="resultscore" value="{{$row['resultscore']}}"/></td>
                <tr>
                </tr>
                @endforeach
              </tbody></table>

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
      $.ajax({
        type: 'POST',
        url: "/updateindicator2_1",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: (data) => {
          swal({
          title: "แก้ไขข้อมูลเรียบร้อยแล้ว",
          text: "",
          icon: "success",
          button: "ตกลง",
        }).then(function() {
            window.location = "/category3/indicator2-1";
        });
        },
        error: function(data) {
          alert(data.responseJSON.errors.files[0]);
          console.log(data.responseJSON.errors);
        }
      });
    });
  });
</script>
@endsection