@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
  <div class="box-header">
    <div class="box-body">
      <div class="col-sm-2" align="right"></div>
      <div class="col-sm-8" align="center">
        <h3><i class=""></i>จำนวนที่ลาออกและคัดชื่อออกสะสมจนถึงสิ้นปีการศึกษา</h3>
        <hr>
      </div>
    </div>
            <div class="box-body">
            
            <form id="adddata" method="POST" action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data">
            @csrf
            @if($get!="")
            <?php $yearname=session()->get('year'); ?>
            <table class="table table-bordered text-center">
                <tbody><tr>
                  <th width="5%" rowspan="5" style="background-color:#9ddfd3">ปีการศึกษาที่รับเข้า</th>
                  <th width="5%" rowspan="5" style="background-color:#9ddfd3">จำนวนที่รับเข้า</th>
                  <?php $zero2=0 ?>
                  @foreach($gropby as $key=>$value)
                  <?php $zero1=0 ?>
                    @foreach($getinfo as $c)
                      @if($c['reported_year']==$value['year_add']&&$c['reported_year_qty']!=0)
                            <?php $zero1=$zero1+1 ?>
                      @endif
                    @endforeach
                    @if($zero1!=0)
                    <?php $zero2=$zero2+1 ?>
                    @endif
                  @endforeach
                  <th width="5%" rowspan="4" colspan="{{$zero2}}" style="background-color:#9ddfd3">จำนวนสำเร็จการศึกษาตามหลักสูตร</th>
                  <th width="5%" rowspan="5"  style="background-color:#9ddfd3">จำนวนที่ลาออกและคัดชื่อออกสะสมจนถึงสิ้นปีการศึกษา</th>
                  </tr>
                  <tr></tr>
                  <tr></tr>
                  <tr></tr>
                  <tr>
                  <?php $i=0 ?>
                  @foreach($gropby as $key=>$value)
                  
                  <?php $zero=0 ?>
                 
                    @foreach($getinfo as $c)
                      @if($c['reported_year']==$value['year_add']&&$c['reported_year_qty']!=0)
                            <?php $zero=$zero+1 ?>
                      @endif
                    @endforeach
                    
                    @if($zero!=0)
                    <?php $getinfo[$key]['check']=1; ?>
                    <?php $yearresult[$i]=$value['year_add'];?>
                    <?php $i++ ?>
                    @endif
                  @if($zero!=0)<th width="5%"  style="background-color:#9ddfd3">{{$value['year_add']}}</th>@endif
                  
                  @endforeach
                  </tr>
                  <tr>
                  </tr>
                  <tr></tr>
                  <tr>
                  <?php $n=0 ?>
                  <?php $test=0 ?>
                  @for($y=$get[0]['year_add'];$y<=$yearname; $y++)
                  <?php $qtyavgsuccess=0 ?>
                  <?php $data=$getinfo->where('year_add',$y); ?>
                  <?php $check1=0; ?>
                  @foreach($data as $t)
                  @if($t['reported_year_qty']!=0)
                  <?php $check1=1 ?>
                  @endif
                  @endforeach
                  @if($check1==0)
                  @continue
                  @endif
                  <?php $data1=$getinfo2->where('year_add',$y)->where('reported_year_qty','!=',0)->first(); ?>
                            
                            <td style="background-color:#9ddfd3">{{$y}}</td>
                            <td>{{$data1['reported_year_qty']}}</td>
                            <?php $k=0 ?>
                            @for($x =$get[0]['year_add'];$x<=$yearname; $x++)
                            <?php $data2=[] ?>
                            <?php $data2=$data->where('reported_year',$x)->where('year_add',$y); ?>
                            @if($data2!='[]')
                                @foreach($data2 as $key2=>$value)    
                                <?php $result=$value['reported_year_qty']*100/$data1['reported_year_qty']; ?> 
                                <?php  $result2 = sprintf('%.2f',$result); ?>
                                <?php $getc=count($yearresult); ?>
                                <?php $show=0 ?>
                                @for($ii=0;$ii<$getc;$ii++)
                                @if($yearresult[$ii]==$value['reported_year'])
                                <?php $show=1 ?>
                                @endif
                                @endfor    
                                  @if($show==1)<td>{{$value['reported_year_qty']}}</td>
                                  <?php $qtyavgsuccess=$qtyavgsuccess+$value['reported_year_qty'] ?>
                                  @endif
                                  <?php $k++ ?>
                                @endforeach
                            @else
                                <td ></td>
                                <td><input type="text" class="form-control text-center" ></td>
                            @endif    
                            <?php $n++ ?>                        
                            @endfor
                            <?php $getre=$re->where('year_add',$value['year_add']); ?>
                            @if($getre!='[]')
                            @foreach($getre as $getvalue)
                            <input type="hidden" class="form-control" id="yearadd" name="yearadd[{{$test}}]" value="{{$value['year_add']}}"/>
                            <td><input type="text" class="form-control text-center" name="qty[{{$test}}]" value="{{$getvalue['qty']}}"></td> 
                            @endforeach
                            @else
                            <input type="hidden" class="form-control" id="yearadd" name="yearadd[{{$test}}]" value="{{$value['year_add']}}"/>
                            <td><input type="text" class="form-control text-center" name="qty[{{$test}}]" ></td> 
                            @endif
                            <?php $test++ ?>
                </tr>
                @endfor
                
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
  .wid10{
    width:50px;
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
        url: "/addresignation",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: (data) => {
          if(data){
            swal({
          title: "เพิ่มข้อมูลเรียบร้อยแล้ว",
          text: "",
          icon: "success",
          button: "ตกลง",
        }).then(function() {
          window.location = "/category3/resignation";
        });
          }
        },
        error: function(data) {
          alert(data.responseJSON.errors.files1[0]);
          console.log(data.responseJSON.errors);
        }
      });
    });

    $('#adddata1').submit(function(e) {
      e.preventDefault();
      var formData = new FormData(this);
      $.ajax({
        type: 'POST',
        url: "/addyear_graduate",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: (data) => {
          if(data){
            swal({
          title: "เพิ่มข้อมูลเรียบร้อยแล้ว",
          text: "",
          icon: "success",
          button: "ตกลง",
        }).then(function() {
          window.location = "/addinfostudent";
        });
          }
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