@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
            <div class="box-header with-border">
              <h2 class="box-title">เพิ่มผู้ใช้งาน</h2>
            </div>
            <form class="ml-2 mt-3" method="POST" action="/save">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-1 col-form-label text-md-right">{{ __('ชื่อนามสกุล') }}</label>

                            <div class="col-md-6">
                                <input id="user_fullname" type="text" class="form-control @error('name') is-invalid @enderror wid50" name="user_fullname" required  autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-1 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                            <div class="col-md-6">
                                <input  id="email" type="text" class="form-control @error('email') is-invalid @enderror wid50" name="email" value="{{ old('email') }}" required >

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-1 col-form-label text-md-right">{{ __('username') }}</label>

                            <div class="col-md-6">
                                <input  id="username" type="text" class="form-control @error('email') is-invalid @enderror wid50" name="username" value="{{ old('username') }}" required >

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-1 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6 ">
                                <input  id="password" type="password" class="form-control @error('password') is-invalid @enderror wid50" name="password" >

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>    
                        </div>
                        <div class="form-group row">
                        <label for="password" class="col-md-1 col-form-label text-md-right">{{ __('กลุ่มผู้ใช้งาน') }}</label>
                        <div class="col-md-2">
                                  <select class="form-control"  id="role" type="role" class="form-control @error('role') is-invalid @enderror" name="role">
                                    <option>Admin</option>
                                    <option>ผู้บริหาร</option>
                                    <option>ประธานหลักสูตร</option>
                                    <option>อาจารย์</option>
                                  </select>
                                  </div>
                                </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
            
                
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
@endsection