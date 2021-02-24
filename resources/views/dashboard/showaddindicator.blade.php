@extends('layout.admid_layout')

@section('content')
<div class="box box-warning ">
            <div class="box-header">
            <a href="{{ URL::previous() }}" class="btn btn-primary fr"><i class='fa fa-arrow-left'></i> ย้อนกลับ</a>
              <h2 class="box-title">มอบหมายตัวบ่งชี้ </h2>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <?php $checkrole=false ?>
              <form method="POST" action="/addindicator" class="bd">
               @csrf
               <input type="hidden" class="form-control" id="id" name="id" value="{{$userid}}"/>
                @foreach($role as $row )
                <h4><p class="bginfo"><i class="{{$row['icon']}}"></i> {{$row['category_name']}}</p></h4>
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
                      <input type="checkbox"   name="per[]" value="{{$value['id']}}" @if($checkrole) checked @endif> 
                      <?php $checkrole=false; ?>      
                      <p class="bd">{{$value['Indicator_name']}}</p>
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

<script>
  $(function () {
    $('#example2').DataTable({
      lengthMenu: [ 10, 20, 50, 100]
    })
  })
</script>
@endsection