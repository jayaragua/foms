<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }}</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Font Awesome -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css"
          integrity="sha512-0S+nbAYis87iX26mmj/+fWt1MmaKCv80H+Mbo+Ne7ES4I6rxswpfnC6PxmLiw33Ywj2ghbtTw0FkLbMWqh4F7Q=="
          crossorigin="anonymous"/> -->

    <!-- AdminLTE -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.0.5/css/adminlte.min.css"
          integrity="sha512-rVZC4rf0Piwtw/LsgwXxKXzWq3L0P6atiQKBNuXYRbg2FoRbSTIY0k2DxuJcs7dk4e/ShtMzglHKBOJxW8EQyQ=="
          crossorigin="anonymous"/> -->

    <!-- iCheck -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css"
          integrity="sha512-8vq2g5nHE062j3xor4XxPeZiPjmRDh6wlufQlfC6pdQ/9urJkU07NM0tEREeymP++NczacJ/Q59ul+/K2eYvcg=="
          crossorigin="anonymous"/> -->

    <link rel="stylesheet" type="text/css" href="/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/css/util.css">
	<link rel="stylesheet" type="text/css" href="/css/main.css">




    <meta name="_token" content="{!! csrf_token() !!}" />
</head>
<body >

        <div class="limiter">
            <div class="container-login100">
            
                <div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
                <div class="p-b-20">
                    <a style="text-align:center !mportant;" href="{{ url('/home') }}"><b>{{ config('app.name') }}</b></a>
                </div> 
                    <form action="{{ route('password.email') }}" method="post" class="login100-form validate-form flex-sb flex-w">
                    @csrf
                        <!-- <span class="login100-form-title p-b-32">
                        Sign into your account
                        </span> -->
                        <p class="login-box-msg p-b-20">You forgot your password? Here you can easily retrieve a new password.</p>
                        
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                       
                        <div class="wrap-input100 validate-input m-b-36" data-validate="Email is required">
                             
                                <input type="email"
                                        name="email"
                                        class="input100 form-control @error('email') is-invalid @enderror"
                                        placeholder="Email">
                                   
                                    @error('email')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror

                                    <span class="focus-input100"></span>
                        </div>

                     
                       
                       
                        <div  class="container-login100-form-btn" style="text-align:center !important;">
                            <!-- <button type="submit" class="login100-form-btn"> -->
                            <button type="submit" class="login100-form-btn">Send Password Reset Link</button>
                            <!-- Login
                            </button> -->
                        </div>
                        <p class="mt-3 mb-1">
                            <a href="{{ route("login") }}">Login</a>
                        </p>
                    </form>

                   
                </div>
            </div>
        </div>   


    <!-- /.login-logo -->
    <!-- <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form action="{{ route('password.email') }}" method="post">
                @csrf

                <div class="input-group mb-3">
                    <input type="email"
                           name="email"
                           class="form-control @error('email') is-invalid @enderror"
                           placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                    </div>
                    @error('email')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Send Password Reset Link</button>
                    </div> -->
                    <!-- /.col -->
                <!-- </div>
            </form>

            <p class="mt-3 mb-1">
                <a href="{{ route("login") }}">Login</a>
            </p> -->
          <!--   <p class="mb-0">
                <a href="{{ route("register") }}" class="text-center">Register a new membership</a>
            </p> -->
        <!-- </div> -->
        <!-- /.login-card-body -->
    <!-- </div> -->
<!-- </div> -->
<!-- /.login-box -->

<!-- AdminLTE App  -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.0.5/js/adminlte.min.js"
        integrity="sha512-++c7zGcm18AhH83pOIETVReg0dr1Yn8XTRw+0bWSIWAVCAwz1s2PwnSj4z/OOyKlwSXc4RLg3nnjR22q0dhEyA=="
        crossorigin="anonymous"></script>
        <script src="vendor/jquery/jquery-3.2.1.min.js"></script>

  <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="/vendor/bootstrap/js/popper.js"></script>
	<script src="/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="/vendor/daterangepicker/moment.min.js"></script>
	<script src="/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="/js/main.js"></script>
</body>
</html>
