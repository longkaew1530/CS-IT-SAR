@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl wid50">
            <div class="box-header">
              <h2 class="box-title">จัดการปีการศึกษา</h2>
            </div>
            <a href="{{url('/dashboard/index3')}}">
            <button type="submit" class="btn btn-danger ml-1"><i class="fa  fa-minus"></i> ปีการศึกษาย้อนหลัง</button>
            <button type="submit" class="btn btn-success ml-1"><i class="fa fa-plus"></i> ปีการศึกษาถัดไป</button>
            </a>
            <!-- /.box-header -->
            <div class="box-body">
            <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>53<sup style="font-size: 20px">%</sup></h3>

              <p>Bounce Rate</p>
            </div>
            <div class="icon">
              <i class="fa fa-calendar"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-calendart"></i></a>
          </div>
        </div>
            </div>
            </div>
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
.ml-1{
  margin-left:10px
}
</style>
@endsection