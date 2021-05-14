@extends('layouts.app')

@section('content')
<div class="login">
        <div class="box card">
        <img class="center" src="images1/51068867_2169891829944413_1397301733545213952_n.png" width="150px" id="logo">
        <div  class="title text-center mt-3">ระบบสารสนเทศเพื่อการบริหารจัดการผลการดำเนินงานของหลักสูตร&nbsp;&nbsp; (CS-IT SAR)</div>
        <form id="login_form" method="POST" action="{{ route('login') }}">
		@csrf
            <div class="form-group">
            <input type="username" id="username" name="username"  class="form-control mt-3 @error('username') is-invalid @enderror" value="{{ old('username') }}"  placeholder="Username" required autocomplete="username" autofocus>
						<!-- <span >
							<i class="fa fa-user" aria-hidden="true"></i>
                        </span> -->
						
                        @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
            </div>
            <div class="form-group">
            <input  class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}"  type="password" placeholder="Password" id="password"   name="password" required autocomplete="current-password">
			<!-- <span>
							<i class="fa fa-lock" aria-hidden="true"></i>
                        </span> -->
						
                        @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
            </div>
            <button type="submit" class="btn btn-primary btn_submit">{{ __('เข้าสู่ระบบ') }}</button>
        </form>

        </div>

    </div>
<!-- <div class="limiter bg">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="images1/51068867_2169891829944413_1397301733545213952_n.png" alt="IMG">
				</div>

                <form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
                        @csrf
					<span class="login100-form-title">
						<b>CS-IT SAR</b>
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input id="username" type="username" class="input100 @error('username') is-invalid @enderror"  name="username" value="{{ old('username') }}"  placeholder="Username" required autocomplete="username" autofocus>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
                        </span>
                        @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100 @error('password') is-invalid @enderror " type="password" placeholder="Password" id="password"   name="password" required autocomplete="current-password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                        @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
					</div>
					
					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn">
                        {{ __('Login') }}
						</button>
					</div>

					<div class="text-center p-t-12">
                    @if (Route::has('password.request'))
						<span class="txt1">
							Forgot
						</span>
						<a class="txt2" href="{{ route('password.request') }}">
							Password?
                        </a>
                        @endif
					</div>

					<div class="text-center p-t-136">
					</div>
				</form>
			</div>
		</div>
    </div> -->
    
<style>
.bg{
    background:color:#63AFBB;
}
.login {
    position: relative;
    min-height: 100vh;
    font-family: 'Sarabun', sans-serif;
    background-color: #E0E0E0;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    color: #63AFBB;
    padding: 16px;
}

.form-control{
    display: block;
    width: 100%;
    height: calc(1.5em + .75rem + 2px);
    padding: .375rem .75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: .25rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}
.login #login_form .btn_submit {
    width: 100%;
    background-color: #63AFBB;
    border-color: #63AFBB;
}
.login .box .title {
    font-weight: bold;
    font-size: 16px;
    line-height: 24px;
}
.login .box, .login .warning {
    width: 100%;
    max-width: 500px;
    padding: 16px;
}
*, ::after, ::before {
    box-sizing: border-box;
}
.login .box {
    box-shadow: 0px 4px 4px rgb(0 0 0 / 25%);
}
.center {
  display: block;
  margin-left: auto;
  margin-right: auto;
}
body {
    margin: 0;
    font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #212529;
    text-align: left;
    background-color: #fff;
}
*, ::after, ::before {
    box-sizing: border-box;
}
/* Style the counter cards */
.card {
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid rgba(0,0,0,.125);
    border-radius: .25rem;
}


</style>

@endsection
