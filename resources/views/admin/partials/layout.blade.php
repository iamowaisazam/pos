<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('/uploads/'.$_s['icon'])}}">
    <title>{{$_s['name']}}</title>

    <!-- ============================================================== -->
    <!-- Plugins -->
    <!-- ============================================================== -->
    <link href="{{asset('admin/assets/node_modules/morrisjs/morris.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/node_modules/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/node_modules/toast-master/css/jquery.toast.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/css/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('admin/assets/node_modules/select2/dist/css/select2.css')}}">
  
    <style>

        .switchery{background-color:#fff;border:1px solid #dfdfdf;border-radius:20px;cursor:pointer;display:inline-block;height:30px;position:relative;vertical-align:middle;width:50px;-moz-user-select:none;-khtml-user-select:none;-webkit-user-select:none;-ms-user-select:none;user-select:none;box-sizing:content-box;background-clip:content-box}.switchery>small{background:#fff;border-radius:100%;box-shadow:0 1px 3px rgba(0,0,0,0.4);height:30px;position:absolute;top:0;width:30px}.switchery-small{border-radius:20px;height:20px;width:33px}.switchery-small>small{height:20px;width:20px}.switchery-large{border-radius:40px;height:40px;width:66px}.switchery-large>small{height:40px;width:40px}

        .menu-button:hover{
            color: #03a9f3;
        }

        .file_manager_parent .file_manager {
            width: 100%;
        }
        .select2-container .img-flag {
            width: 20px;
            height: 20px;
            vertical-align: middle;
            margin-right: 5px;
        }
       .file_manager_parent .select2-selection__rendered {
            display: flex;
            align-items: center;
            line-height: 36px!important;
        }

        .file_manager_parent .select2-selection--single{
            min-height: 38px;
            border: 1px solid #e9ecef!important;
            border-radius: 0px;
        }

        .tox-tinymce{
        width: 100%!important;
        }


        .left-sidebar {
        width: 251px;
        }

        @media (min-width: 1024px) {
         .page-wrapper, .footer {
             margin-left: 251px;
         } 
        }

        @media (min-width: 768px) {
        .navbar-header {
            width: 251px;
            flex-shrink: 0;
            }
        }

        @media (max-width: 768px) {
           .left-sidebar {
            width: 220px;
           }  
        }



        /* Buttons */

        .btn-primary{
            background: {{$_s['secondry_color']}} !important;
            border-color: {{$_s['secondry_color']}} !important;
        }

       /* Colors */

       .sidebar-nav{
           background-color: {{$_s['sidebar_background_color']}} !important;
        }

        .bg-green {
            background-color: #0ea396;
        }

        .sidebar-nav li ul{
           background-color: {{$_s['sidebar_background_color']}} !important;
        }

        .sidebar-nav ul li a {
            color: {{$_s['sidebar_text_color']}} !important;
        }

        .sidebar-nav > ul > li > a i {
            color: {{$_s['sidebar_text_color']}} !important;
        }

        .sidebar-nav .has-arrow::after {
            border-color: {{$_s['sidebar_text_color']}} !important;
        }

        .sidebar-nav  .active .active a{
            color: {{$_s['sidebar_active_color']}} !important;
        }

        .sidebar-nav  .active i{
            color: {{$_s['sidebar_active_color']}} !important;
        }

        .topbar .top-navbar .navbar-header {
            background: {{$_s['topbar_background_color']}} !important;
        }

        .topbar .top-navbar .navbar-nav > .nav-item > .nav-link {
        color: {{$_s['topbar_text_color']}} !important;
        }

        .top-navbar{
            background: {{$_s['topbar_background_color']}} !important;
        }

        .navbar-collapse {
            background: {{$_s['topbar_background_color']}} !important;
        }

        .left-sidebar {
            top: -3px;
        }

        .mini-sidebar .sidebar-nav #sidebarnav > li:hover > a {
          background: {{$_s['primary_color']}};
        }

        .skin-blue .page-titles .breadcrumb .breadcrumb-item.active {
            color: {{$_s['primary_color']}};
        }

        .card-header{
            background: {{$_s['primary_color']}} !important;
        }

        .card-header {
            color: {{$_s['contrast_color']}} !important;
        }

        

        .btn-info{
            background: {{$_s['primary_color']}} !important;
            border-color: {{$_s['primary_color']}};
        }

        @media (min-width: 768px) {
            .mini-sidebar .sidebar-nav #sidebarnav li {
                background: {{$_s['sidebar_background_color']}};
            }
        }

        @media (min-width: 768px) {
            .mini-sidebar .sidebar-nav #sidebarnav > li:hover > ul, .mini-sidebar .sidebar-nav #sidebarnav > li:hover > ul.collapse {
                background: {{$_s['primary_color']}};
            }
         }

         .left-sidebar{
            background: {{$_s['sidebar_background_color']}};
         }
         
         .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 37px!important;
        }
        .select2-container--default .select2-selection--single {
            border: 1px solid #e9ecef!important;
        }
        .select2-container .select2-selection--single {
            height: 39px!important;
        }

        
    </style>
    @yield('css')
    @stack('css')
</head>
<body class="skin-blue fixed-layout">
    
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">{{$_s['name']}}</p>
        </div>
    </div>

    <div id="main-wrapper">
        <header class="topbar">
            @include('admin.partials.topbar')       
        </header>
        <aside class="left-sidebar">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        @include('admin.partials.navbar')
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="page-wrapper">
            <div class="container-fluid">
              @yield('content')

                <div class="right-sidebar">
                    <div class="slimscrollright">
                        <div class="rpanel-title"> Theme Settings <span><i class="ti-close right-side-toggle"></i></span> </div>
                        <div class="r-panel-body">
                            <ul id="themecolors" class="m-t-20">
                                <li><b>With Light sidebar</b></li>
                                <li><a href="javascript:void(0)" data-skin="skin-default" class="default-theme">1</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-green" class="green-theme">2</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-red" class="red-theme">3</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-blue" class="blue-theme working">4</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-purple" class="purple-theme">5</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-megna" class="megna-theme">6</a></li>
                                <li class="d-block m-t-30"><b>With Dark sidebar</b></li>
                                <li><a href="javascript:void(0)" data-skin="skin-default-dark" class="default-dark-theme ">7</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-green-dark" class="green-dark-theme">8</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-red-dark" class="red-dark-theme">9</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-blue-dark" class="blue-dark-theme">10</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-purple-dark" class="purple-dark-theme">11</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-megna-dark" class="megna-dark-theme ">12</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer">
            © 2024 {{$_s['name']}} Developed by  
             <a href="https://www.azamsolutions.com/">Azamsolutions</a>
        </footer>
    </div>

    <script src="{{asset('admin/assets/node_modules/jquery/dist/jquery3.7.js')}}"></script>
    <script src="{{asset('admin/assets/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('admin/assets/node_modules/select2/dist/js/select2.js')}}"></script>
    <script src="{{asset('admin/assets/node_modules/raphael/raphael-min.js')}}"></script>
    <script src="{{asset('admin/assets/node_modules/morrisjs/morris.min.js')}}"></script>
    <script src="{{asset('admin/assets/node_modules/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
    <script src="{{asset('admin/assets/node_modules/toast-master/js/jquery.toast.js')}}"></script>
    <script src="{{asset('admin/assets/node_modules/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/perfect-scrollbar.jquery.min.js')}}"></script>
    <script src="{{asset('admin/tinymce/tinymce.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/custom.js')}}"></script>

    <script>
         let site_url = "{{URL::to('/')}}";
        

        
        function getRandomUniqueNumber() {
            const dateNow = Date.now();
            const randomNum = Math.floor(100000 + Math.random() * 900000);
            const uniqueNumber = dateNow.toString() + randomNum.toString();
            return uniqueNumber;
        }


    </script>

    

    @include('admin.partials.alert')

    <!-- ============================================================== -->
    <!-- Pages JS -->
    <!-- ============================================================== -->
    @yield('js')

    @stack('js')
    
 </body>
</html>