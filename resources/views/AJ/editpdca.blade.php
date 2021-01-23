@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
  <div class="box-header">
    <div class="box-body">
      <div class="col-sm-2" align="right"></div>
      <div class="col-sm-8" align="center">
      @foreach($pdca as $value)
        <h3><i class=""></i>{{$value['category_pdca']}}</h3>
        <hr>
      </div>
    </div>
    <form id="adddata" method="POST" action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data">
    @csrf
      <div class="data">
        <div class="col-md-12">
          <div class="box-header col-md-12 col-sm-9 col-xs-12">
            <h3 class="box-title">ขั้นตอนการวางแผน (P)</h3>
            <input type="hidden" class="form-control" id="pdca_id" name="pdca_id" value="{{$value['pdca_id']}}"/>
            
          </div>
          <div id="body">
            <div class="col-md-12 col-sm-9 col-xs-12">
              <textarea id="editor1" name="editor1" rows="10" cols="80">
              {{$value['p']}}
              </textarea>
            </div>
          </div>

        </div>
      </div>
      <div class="data">
        <div class="col-md-12">
          <div class="box-header col-md-12 col-sm-9 col-xs-12">
            <h3 class="box-title">การดำเนินงานตามแผน (D)</h3>
          </div>
          <div id="body">
            <div class="col-md-12 col-sm-9 col-xs-12">
              <textarea id="editor2" name="editor2" rows="10" cols="80">
              {{$value['d']}}
                           </textarea>
            </div>
          </div>

        </div>
      </div>
      <div class="data">
        <div class="col-md-12">
          <div class="box-header col-md-12 col-sm-9 col-xs-12">
            <h3 class="box-title">การประเมินกระบวนการ (C)</h3>
          </div>
          <div id="body">
            <div class="col-md-12 col-sm-9 col-xs-12">
              <textarea id="editor3" name="editor3" rows="10" cols="80">
              {{$value['c']}}
                           </textarea>
            </div>
          </div>

        </div>
      </div>
      <div class="data">
        <div class="col-md-12">
          <div class="box-header col-md-12 col-sm-9 col-xs-12">
            <h3 class="box-title">การปรับปรุง/พัฒนา/บูรณาการกระบวนการจากผลการประเมิน (A)</h3>
          </div>
          <div id="body">
            <div class="col-md-12 col-sm-9 col-xs-12">
              <textarea id="editor4" name="editor4" rows="10" cols="80">
              {{$value['a']}}
                           </textarea>
            </div>
          </div>

        </div>
      </div>
      <div class="data">
        <div class="col-md-12">
          <div class="box-header col-md-12 col-sm-9 col-xs-12">
            <h3 class="box-title">หลักฐานอ้างอิง</h3>
          </div>
          <div id="body">
            <div class="col-md-12 col-sm-9 col-xs-12">
              <input multiple="true" type="file" id="doc_file" name="doc_file[]">
            </div>
          </div>

        </div>
      </div>
  @endforeach

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
      let TotalFiles = $('#doc_file')[0].files.length; //Total files
      let files = $('#doc_file')[0];
      for (let i = 0; i < TotalFiles; i++) {
        formData.append('files' + i, files.files[i]);
      }
      formData.append('TotalFiles', TotalFiles);
      $.ajax({
        type: 'POST',
        url: "/updatepdca",
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
          window.location = "/category3/pdca/{{$pdca[0]['m_id']}}";
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