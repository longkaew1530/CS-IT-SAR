@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl ">
            <div class="box-header">
              <h2 class="box-title">ผลการประเมิน</h2>
            </div>
            <button  class="btn btn-success ml-1" type="button" data-toggle="modal" data-target="#modal-info"><i class="fa fa-plus"></i> เพิ่มหมวด</button>

            <div class="modal  fade" id="modal-info">
            <div class="modal-dialog">
                <div class="modal-content">
                   <div class="modal-header">
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                        <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">เพิ่มหมวด</h4>
                  </div>
                      <form  method="POST" action="/addassessment_results">
                       @csrf
                  <div class="box-body">
                      <div class="form-group">
                      @if($cAss!=0)
                          @foreach($Category as $row)
                            @foreach($Assessment_results as $value)
                            @if($row['category_id']==$value['category_id'])
                            @continue
                            @endif
                                  <div class="checkbox">
                                        <label>
                                        <input type="checkbox" class="minimal" value="{{$row['category_id']}}"  name="per[]" >     
                                        {{$row['category_name']}}
                                        </label>
                                  </div>
                            @endforeach

                          @endforeach

                      @else
                      @foreach($Category as $row1)
                      <div class="checkbox">
                            <label>
                            <input type="checkbox" class="minimal" value="{{$row1['category_id']}}"  name="per[]" >     
                             {{$row1['category_name']}}
                            </label>
                      </div>
                      @endforeach
                      @endif
                      
                      </div>
                  </div>
            
                   <div class="modal-footer">
                      <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">ปิด</button>
                      <button type="submit" class="btn btn-info">บันทึกข้อมูล</button>
                    </div>
                    </form>       
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
                  <th >หมวด</th>
                  <th width="5%">ลบ</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($Assessment_results as $key=>$row)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$row['category_name']}}</td>           
                  <td class="text-center">
                                      <form id="delete-form" method="POST" action="/deletecategory/{{$row['id']}}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                      <button type="submit" class="btn btn-danger"><i class='fa fa-trash'></i></button></form>
                  </td>
                </tr>
       
      
        <div class="modal  fade" id="modal-edit">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">เพิ่มข้อมูลกลุ่มเมนู</h4>
              </div>
              <form  method="POST" action="/updatecategory">
              @csrf
              {{ method_field('PUT') }}
              <div class="box-body">
              <div class="form-group">
              <input type="hidden" class="form-control" id="category_id" name="category_id" >
                  <label for="exampleInputEmail1">หมวด</label>
                  <input type="text" class="form-control" id="categoryname" name="category_name" placeholder="หมวด">
                </div>
              </div>
            
              <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">ปิด</button>
                <button type="submit" class="btn btn-info">บันทึกข้อมูล</button>
              </div>
              </form>
              <input type="hidden" class="form-control" name="id" id="emp_id" >
              
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
.ml-2{
  margin-left:20px
}
.mt-3{
  margin-top:30px;
}
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
  $(function () {
    $('#example3').DataTable({
      lengthMenu: [ 8, 20, 50, 100]
    })
  })
</script>

<script>
$(document).ready(function() {
$('#modal-edit').on('show.bs.modal', function (event) {
var button = $(event.relatedTarget);
var id= button.data('id');
var modal = $(this);
modal.find('#emp_id').val(id);
var url = "/getcategory";
        $.get(url + '/' + id, function (data) {
            //success data
            console.log(data)
            $("#category_id").val(data[0].category_id);
            $("#categoryname").val(data[0].category_name);
        }) 
});
});
</script>


@endsection