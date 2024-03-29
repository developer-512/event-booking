@extends('layouts.front')
@section('content')
    <div class="container-fluid margin_80_0">
        <div class="row justify-content-center">

            <div class="col-4 px-lg-6 my-5 align-self-center">

                <!-- Heading -->
                <h1 class="display-4 mb-3">
                    Welcome Back!
                </h1>

                <!-- Subheading -->
                <p class="text-muted mb-5">
                  Log in to continue
                </p>

                <!-- Form -->
                @if(session('message'))
                    <div class="alert alert-info" role="alert">
                        {!!  session('message') !!}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                @csrf

                    <!-- Email address -->
                    <div class="form-group">

                        <!-- Label -->
                        <label class="form-label" for="email">
                            Email
                        </label>

                        <!-- Input -->
                        <input id="email" name="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required autocomplete="email" autofocus placeholder="{{ trans('global.login_email') }}" value="{{ old('email', null) }}">

                        @if($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif

                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col">

                                <!-- Label -->
                                <label class="form-label" for="password">
                                    Password
                                </label>

                            </div>
                            <div class="col-auto">

                                <!-- Help text -->
{{--                                <a href="password-reset-cover.html" class="form-text small text-muted">--}}
{{--                                    Forgot password?--}}
{{--                                </a>--}}
                                @if(Route::has('password.request'))
                                    <a class="form-text small text-muted" href="{{ route('password.request') }}">
                                        {{ trans('global.forgot_password') }}
                                    </a><br>
                                @endif

                            </div>
                        </div> <!-- / .row -->

                        <!-- Input group -->
                        <div class="input-group input-group-merge">

                            <!-- Input -->
                            <input id="password" name="password" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" required placeholder="{{ trans('global.login_password') }}">

                            @if($errors->has('password'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('password') }}
                                </div>
                        @endif

                            <!-- Icon -->
{{--                            <span class="input-group-text" id="view-pass">--}}
{{--                                  <i class="fe fe-eye"></i>--}}
{{--                            </span>--}}

                        </div>
                    </div>
                    <div class="form-group">
                        <input class="form-check-input" name="remember" type="checkbox" id="remember" style="vertical-align: middle;" />
                        <!-- Label -->
                        <label class="form-label" for="remember">
                            Remember me
                        </label>
                    </div>
                    <!-- Submit -->
                    <button class="btn_1  btngrad" style="width: 100%" type="submit">
                        Sign in
                    </button>

                    <!-- Link -->
                    <p class="text-center mt-3 mb-3">
                        <span class="arwsqft">
                            Forget Password ? <a href="{{route('password.request')}}">Reset Password</a>.
                        </span>
                    </p>
                    <p class="text-center">
                        <span class="arwsqft">
                            Don't have an account ? <a href="{{route('register')}}">Sign up</a>.
                        </span>
                    </p>

                </form>

            </div>
        </div> <!-- / .row -->
    </div>
    <?php /*
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card mx-4">
            <div class="card-body p-4">
                <h1>{{ trans('panel.site_title') }}</h1>

                <p class="text-muted">{{ trans('global.login') }}</p>

                @if(session('message'))
                    <div class="alert alert-info" role="alert">
                        {{ session('message') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-user"></i>
                            </span>
                        </div>

                        <input id="email" name="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required autocomplete="email" autofocus placeholder="{{ trans('global.login_email') }}" value="{{ old('email', null) }}">

                        @if($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-lock"></i></span>
                        </div>

                        <input id="password" name="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required placeholder="{{ trans('global.login_password') }}">

                        @if($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>

                    <div class="input-group mb-4">
                        <div class="form-check checkbox">
                            <input class="form-check-input" name="remember" type="checkbox" id="remember" style="vertical-align: middle;" />
                            <label class="form-check-label" for="remember" style="vertical-align: middle;">
                                {{ trans('global.remember_me') }}
                            </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary px-4">
                                {{ trans('global.login') }}
                            </button>
                        </div>
                        <div class="col-6 text-right">
                            @if(Route::has('password.request'))
                                <a class="btn btn-link px-0" href="{{ route('password.request') }}">
                                    {{ trans('global.forgot_password') }}
                                </a><br>
                            @endif
                            <a class="btn btn-link px-0" href="{{ route('register') }}">
                                {{ trans('global.register') }}
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
 */ ?>
@endsection
@section('scripts')
    <script>
        $('#view-pass').click(function (){
            var password=$('#password');
            if('password' == password.attr('type')){
                password.prop('type', 'text');
            }else{
                password.prop('type', 'password');
            }
        });
    </script>
@endsection
