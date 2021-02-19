@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
  <div class="box-header">
    <div class="box-body">
    <a href="{{ URL::previous() }}" class="btn btn-primary fr"><i class='fa fa-arrow-left'></i> ย้อนกลับ</a>
      <div class="col-sm-2" align="right"></div>
      <div class="col-sm-8" align="center">
      
        <h3><i class=""></i>สรุปจุดแข็ง จุดที่ควรพัฒนา และแนวทางการพัฒนา</h3>
        <hr>
      </div>
    </div>
    <form id="adddata" method="POST" action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data">
    @csrf
    @foreach($query as $row)
    <input type="hidden" class="form-control" id="id" name="id" value="{{$row['id']}}"/>
    <div class="col-md-12">
          <div class="box-header col-md-12 col-sm-9 col-xs-12">
            <h3 class="box-title">ผลการดำเนินงาน</h3>
          </div>
            <div class="col-md-12 col-sm-9 col-xs-12">
            <select class="form-control"  id="composition_id"  class="form-control @error('role') is-invalid @enderror" name="composition_id">
            @foreach($get as $key=>$value) 
                                      @if($key+1==$query[0]['composition_id'])
                                       <option value="{{$value['id']}}"  selected>{{$value['name']}}</option>
                                      @else 
                                        @if($value['id']!==$getdata[0]&&$value['id']!==$getdata[1]&&$value['id']!==$getdata[2]&&$value['id']!==$getdata[3]&&
                                        $value['id']!==$getdata[4]&&$value['id']!==$getdata[5]&&$value['id'])
                                        <option value="{{$value['id']}}">{{$value['name']}}</option>
                                        @endif
                                    @endif
                                    @endforeach
              </select>
            </div>
        </div>
        <div class="col-md-12">
          <div class="box-header col-md-12 col-sm-9 col-xs-12">
            <h3 class="box-title">จุดแข็ง</h3>
          </div>
            <div class="col-md-12 col-sm-9 col-xs-12">
              <textarea  id="editor5" name="strength" rows="10" cols="80">
              {!!$row['strength']!!}
              </textarea>
            </div>
        </div>
        <div class="col-md-12">
          <div class="box-header col-md-12 col-sm-9 col-xs-12">
            <h3 class="box-title">จุดที่ควรพัฒนา</h3>
          </div>
            <div class="col-md-12 col-sm-9 col-xs-12">
              <textarea  id="editor4" name="points_development" rows="10" cols="80">
              {!!$row['points_development']!!}
              </textarea>
            </div>
        </div>
        <div class="col-md-12">
          <div class="box-header col-md-12 col-sm-9 col-xs-12">
            <h3 class="box-title">แนวทางการพัฒนา</h3>
          </div>
            <div class="col-md-12 col-sm-9 col-xs-12">
              <textarea  id="editor1" name="development_approach" rows="10" cols="80">
              {!!$row['development_approach']!!}
              </textarea>
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
      @endforeach
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
        url: "/updatestrengths_summary",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: (data) => {
          swal({
          title: "อัปเดตข้อมูลเรียบร้อยแล้ว",
          text: "",
          icon: "success",
          button: "ตกลง",
        }).then(function() {
          window.location = "/category7/strengths_summary";
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
@endsection