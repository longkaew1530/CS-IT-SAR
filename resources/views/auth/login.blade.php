@extends('layouts.app')

@section('content')
<div class="limiter bg">
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
    </div>
    
<style>
.bg{
    background:color:#63AFBB;
}
</style>
@endsection
