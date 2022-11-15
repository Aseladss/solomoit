<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>@yield('title')</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css')}}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">

        <link rel="stylesheet" href="{{asset('dist/css/skins/_all-skins.min.css')}}">

        <script src="{{asset('js/jquery-1.11.1.min.js')}}"></script>


        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Poppins&family=Raleway&display=swap" rel="stylesheet">
    </head>
    <body class="hold-transition skin-blue {{ session()->has('ADMIN_USER_INFO') ? 'sidebar-mini' : 'layout-top-nav'  }}">
        <style type="text/css">
            html,body{
                font-family: 'Poppins', sans-serif;
                font-size: 13px;
            }
            .content-header h1{
                font-family: 'Raleway', sans-serif;
                font-size: 16px !important;
                letter-spacing: 0.05em;
                font-weight: 600;
                margin-bottom: 10px;
            }
            .logo-lg{
                font-family: 'Raleway', sans-serif;
                letter-spacing: 0.05em;
            }
            .box-title{
                font-family: 'Raleway', sans-serif;
                font-size: 12px !important;
                letter-spacing: 0.05em;
                font-weight: 600;
            }
            .form-group label{
                font-size: 11px;
            }
            #logout{
                position: absolute;
                bottom: 0px;
                width: 100%;
                color: #fff;
            }
        </style>
        <!-- Site wrapper -->
        <div class="wrapper">

            <header class="main-header">
                <!-- Logo -->
                <a href="{{ url('/') }}" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>T</b></span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>TICKET</b>.com</span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    @if(session()->has('ADMIN_USER_INFO'))
                    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    @endif
                </nav>
                <!--                <li class="nav-item dropdown">
                                    <a class="nav-link" href="{{ url('/login') }}">
                                        <i class="fas fa-power-off fa-2x"></i>
                                        <span style="vertical-align: super;">Logout</span></a>
                                </li>-->
            </header>

            <!-- =============================================== -->
            @if(session()->has('ADMIN_USER_INFO'))
            <!-- Left side column. contains the sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu" data-widget="tree">
                        <li class="header">MAIN NAVIGATION</li>
                        <li>
                            <a href="{{ url('dashboard') }}">
                                <i class="fa fa-th"></i> <span>Ticket Management</span>
                            </a>
                        </li>
                            <li id="logout">
                                <a href="{{ url('login') }}">
                                <i class="fa fa-power-off"></i> <span>LOGOUT</span>
                            </a>
                            </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>
            @endif

            <!-- =============================================== -->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        @yield('header')
                        <!--<small>it all starts here</small>-->
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">@yield('content')</section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <footer class="main-footer">
                <!--    <div class="pull-right hidden-xs">
                      <b>Version</b> 2.4.13
                    </div>-->
                <strong>Copyright &copy; 2022 <a href="#">ASELA DEWANARAYANA</a>.</strong> All rights
                reserved.
            </footer>

            <!-- /.control-sidebar -->
            <!-- Add the sidebar's background. This div must be placed
                 immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>
        <!-- ./wrapper -->

        <!-- jQuery 3 -->

<!--<script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>-->
        <!-- Bootstrap 3.3.7 -->
        <script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
        <!-- SlimScroll -->
        <script src="{{asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
        <!-- FastClick -->
        <script src="{{asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
        <!-- AdminLTE App -->
        <script src="{{asset('dist/js/adminlte.min.js')}}"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="{{asset('dist/js/demo.js')}}"></script>
        <script>

        </script>
    </body>
</html>
