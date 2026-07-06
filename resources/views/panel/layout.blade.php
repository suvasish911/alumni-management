<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> Alumni Management </title>

    <link href="{{asset('assets/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">
	
    <link href="{{ asset('assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/jqvmap/dist/jqvmap.min.css')}}" rel="stylesheet"/>
    <link href="{{ asset('assets/vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">

    <link href="{{ asset('assets/build/css/custom.min.css')}}" rel="stylesheet">

    <style>
        /* Force the parent container wrappers to match our exact dark slate theme color */
        html, body {
            background: #0f172a !important;
        }
        .nav-md .container.body .col-md-3.left_col {
            background: #0f172a !important;
            min-height: 100vh !important;
            position: fixed;
            height: 100%;
        }
        .left_col, .scroll-view {
            background-color: #0f172a !important;
        }
        .nav_title {
            background-color: #0f172a !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.04) !important;
        }
        .site_title i {
            border: none !important;
            color: #94a3b8 !important;
        }
        .site_title span {
            color: #f8fafc !important;
            font-weight: 600 !important;
            letter-spacing: 0.5px;
        }
        
        /* Eliminate the trailing green footer block injected by standard Gentelella styling rules */
        .sidebar-footer {
            display: none !important;
            background: transparent !important;
        }
    </style>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container" style="background: #0f172a;">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="{{url('/dashboard')}}" class="site_title"><i class="fa fa-graduation-cap"></i> <span>Alumni System</span></a>
            </div>

            <div class="clearfix"></div>

            @include('panel.includes.header')
            <br />

            @include('panel.includes.sidebar')
            </div>
        </div>

        <div class="top_nav">
            <div class="nav_menu" style="background: #ffffff; border-bottom: 1px solid #e2e8f0;">
                @include('panel.includes.top_nav')
            </div>
        </div>
        
        <div class="right_col" role="main" style="background: #f8fafc; min-height: calc(100vh - 50px);">
            @yield('content')
         </div>
        
        <footer style="background: #ffffff; border-top: 1px solid #e2e8f0; color: #64748b; margin-left: 0;">
          @include('panel.includes.footer')
          <div class="clearfix"></div>
        </footer>
      </div>
    </div>

    <script src="{{ asset('assets/vendors/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/fastclick/lib/fastclick.js')}}"></script>
    <script src="{{ asset('assets/vendors/nprogress/nprogress.js')}}"></script>
    <script src="{{ asset('assets/vendors/Chart.js/dist/Chart.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/gauge.js/dist/gauge.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/iCheck/icheck.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/skycons/skycons.js')}}"></script>
    <script src="{{ asset('assets/vendors/Flot/jquery.flot.js')}}"></script>
    <script src="{{ asset('assets/vendors/Flot/jquery.flot.pie.js')}}"></script>
    <script src="{{ asset('assets/vendors/Flot/jquery.flot.time.js')}}"></script>
    <script src="{{ asset('assets/vendors/Flot/jquery.flot.stack.js')}}"></script>
    <script src="{{ asset('assets/vendors/Flot/jquery.flot.resize.js')}}"></script>
    <script src="{{ asset('assets/vendors/flot.orderbars/js/jquery.flot.orderBars.js')}}"></script>
    <script src="{{ asset('assets/vendors/flot-spline/js/jquery.flot.spline.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/flot.curvedlines/curvedLines.js')}}"></script>
    <script src="{{ asset('assets/vendors/DateJS/build/date.js')}}"></script>
    <script src="{{ asset('assets/vendors/jqvmap/dist/jquery.vmap.js')}}"></script>
    <script src="{{ asset('assets/vendors/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
    <script src="{{ asset('assets/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js')}}"></script>
    <script src="{{ asset('assets/vendors/moment/min/moment.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

    <script src="{{ asset('assets/build/js/custom.min.js')}}"></script>
  </body>
</html>