<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

      

        <link href="{{ asset('css/css_all.css') }}" rel="stylesheet">

    
      <!-- @yield('third_party_stylesheets') -->
      @yield('css')
      <script>
             
             (function (){
                   window.Laravel = {
                       csrfToken: '{{ csrf_token() }}'
                   };
             })();  

   </script>

    <!-- @stack('page_css') -->
    
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <!-- Main Header -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                    <!-- <img src="https://cdn.pixabay.com/photo/2020/07/01/12/58/icon-5359553_960_720.png"
                         class="user-image img-circle elevation-2" alt="User Image"> -->

                         @if(Auth::user()->profPic)
                                <img class="user-image img-circle elevation-2" src="{{Auth::user()->profPic}}" alt="User Image"/>
                            @else
                            <img class="user-image img-circle elevation-2" src="{{ asset('images/avatar6.png') }}" />
                            @endif

                    <span class="d-none d-md-inline">{{ Auth::user()->InsFName }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <!-- User image -->
                    <li class="user-header bg-secondary">
                        <!-- <img src="https://cdn.pixabay.com/photo/2020/07/01/12/58/icon-5359553_960_720.png"
                             class="img-circle elevation-2"
                             alt="User Image"> -->
                             @if(Auth::user()->profPic)
                                <img style= "border-radius: 50%;" src="{{Auth::user()->profPic}}" alt="User Image"/>
                            @else
                            <img style= "border-radius: 50%;" src="{{ asset('images/avatar6.png') }}" />
                            @endif
                        <p>
                            {{ Auth::user()->InsFName }}
                            
                        </p>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <a href="profile" class="btn btn-default btn-flat">Profile</a>
                        <a href="#" class="btn btn-default btn-flat float-right"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Sign out
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>

    <!-- Left side column. contains the logo and sidebar -->
@include('layouts.sidebar')

<!-- Content Wrapper. Contains page content -->
    
    <div class="content-wrapper">
        <div id="app">
            <!-- <section class="content"> -->
                @yield('content')
            <!-- </section> -->
        </div>
    </div>

    <!-- Main Footer -->
    <footer class="main-footer text-center">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 1.0
        </div>
        <strong>Copyright &copy; 2025 <a href="https://www.tangubcity.gov.ph/">Tangub City</a>.</strong> All rights
        reserved.
    </footer>
</div>
<!-- <script src="{{ mix('/js/app.js') }}"></script> -->
<script src="{{ asset('/js/app.js') }}"></script>
<!-- <script src="js/app.js"></script> -->

  

@yield('third_party_scripts')

@stack('page_scripts')
</body>
</html>
