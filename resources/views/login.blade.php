@section('pageTitle', 'Login')
@include('partials._header')
<body>
<div class="limiter">
    <div class="container-login100" style="background-image: url('/assets/images/bg-01.jpg');">
        <div class="wrap-login100 p-t-20 p-b-30">
				<span class="login100-form-title p-b-41">
					Account Login
				</span>
            {{ Form::open(['url' => route('login.submit'),
                    'enctype' => 'multipart/form-data',
                    'method' => 'POST',
                    'id' => 'frm_companies',
                    'class' => 'login100-form validate-form p-b-33 p-t-5'])
                }}
            @include('partials._flash_message')
            <div class="wrap-input100 validate-input" data-validate = "Enter email-ID">
                <input class="input100" type="email" name="email" placeholder="User email">
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
                <span class="focus-input100" data-placeholder="&#xe82a;"></span>
            </div>

            <div class="wrap-input100 validate-input" data-validate="Enter password">
                <input class="input100" type="password" name="password" placeholder="Password">
                @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
                <span class="focus-input100" data-placeholder="&#xe80f;"></span>
            </div>
            <div class="container-login100-form-btn m-t-32">
                <button type="submit" class="login100-form-btn">
                    Login
                </button>
            </div>
            <div class="container-login100-form-btn m-t-32">
                <a href="{{ route('register.form') }}" class="login100-form-btn">
                    Register
                </a>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
<div id="dropDownSelect1"></div>
@include('partials._scripts')
</body>
</html>