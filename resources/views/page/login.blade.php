<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/favicon.png') }}">
    <title>@lang('Log in') | {{ $ApplicationSetting->item_name }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}" />
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}" />
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/css/adminlte.min.css') }}" />
    <!-- Ambitious CSS -->
    <link href="{{ asset('assets/css/frontend.css') }}" rel="stylesheet">
    @if(session('locale') == 'ar')
        <link href="{{ asset('assets/css/bootstrap-rtl.min.css') }}" rel="stylesheet">
    @else
        <link href="{{ asset('assets/plugins/alertifyjs/css/themes/bootstrap.min.css') }}" rel="stylesheet">
    @endif

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="rounded-2xl border border-slate-100 bg-slate-50/70 backdropblur-xl shadow-sm shadow-slate-50">
            <div class="card-header text-center">
                <a class="text-3xl"><span class="text-blue-500"><b>{{ $ApplicationSetting->item_name }}</b></span></a>
            </div>
            <div class="card-body">
                <p class="login-box-msg m-0 text-orange-400 font-semibold p-1">@lang('Sign in to start your session')</p>
                <p class="text-center m-0 font-bold">@lang('Or')</p>
                <p class="text-center text-blue-600 underline mb-4"><a href="{{ url('/') }}"><strong>
                            <i class="fas fa-arrow-left"></i> @lang('Go back')
                        </strong></a></p>

                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input id="email" type="email" class="form-control rounded-xl focus:ring-blue-300 focus:ring-2 transition-all duration-500 @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" placeholder="@lang('Email')" required>
                        <div class="input-group-append">
                            <div class="input-group-text rounded-r-xl bg-blue-400 text-white">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input id="password" type="password"
                            class="form-control rounded-xl focus:ring-blue-300 focus:ring-2 transition-all duration-500 @error('password') is-invalid @enderror" name="password"
                            placeholder="@lang('Password')" required>
                        <div class="input-group-append">
                            <div class="input-group-text rounded-r-xl bg-blue-400 text-white">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="flex items-center gap-2">
                                <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}
                                class="rounded-xl border-2 border-slate-100 size-4"
                                >
                                <label for="remember" class="mt-2 text-gray-500 cursor-pointer">
                                    @if(session('locale') == 'ar')
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    @endif
                                    @lang('Remember Me')
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="social-auth-links text-center mt-2 mb-3">
                        <button type="submit" class="rounded-full bg-blue-500 px-4 py-2 text-white w-full "> <i class="fas fa-sign-in-alt mr-2"></i>
                            @lang('Log in')</button>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    @if(session('locale') == 'ar')
        <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    @else
        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    @endif
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/js/adminlte.min.js') }}"></script>
    <!-- Custom Js -->
    <script src="{{ asset('assets/js/custom/login.js') }}"></script>
</body>

</html>