<!--

=========================================================
* Now UI Dashboard - v1.5.0
=========================================================

* Product Page: https://www.creative-tim.com/product/now-ui-dashboard
* Copyright 2019 Creative Tim (http://www.creative-tim.com)

* Designed by www.invisionapp.com Coded by www.creative-tim.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

-->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('/img/apple-icon.png')}}">
  <link rel="icon" type="image/png" href="{{asset('/img/favicon.png')}}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    @yield('title')
  </title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="{{asset('/local-resource/releases/v5.7.1/css/all.css')}}" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link rel="stylesheet" href="{{asset('/local-resource/1.10.7/css/jquery.dataTables.min.css')}}">
  <link rel="stylesheet" href="{{asset('/local-resource/ajax/libs/font-awesome/6.1.0/css/all.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('/local-resource/ui/1.12.0/themes/smoothness/jquery-ui.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('/local-resource/responsive/2.2.9/css/responsive.dataTables.min.css')}}"></style>
  <!-- CSS Files -->
  <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet" />
  <link href=" {{asset('/css/now-ui-dashboard.css?v=1.5.0')}}" rel="stylesheet" />
  <link href=" {{asset('/css/global.css')}}" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <!-- <link href="{{asset('/css/demo.css')}}" rel="stylesheet" /> -->
  

  <style>
    /* html, body {margin: 0; height: 100%; overflow: hidden !important} */

  </style>
</head>
<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="orange">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
      <div class="logo">
        <a href="#" class="simple-text logo-mini">
          FS
        </a>
        <a href="#" class="simple-text logo-normal">
          Tracking
        </a>
      </div>
      <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
          <li class= @yield("dashboard") >
            <a href="{{ route('dashboard.index') }}">
              <i class="now-ui-icons design_app"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class= @yield("trip")>
            <a href="{{ route('dashboard.trip') }}">
              <i class="now-ui-icons education_atom"></i>
              <p>Trip</p>
            </a>
          </li>
          <li class= @yield("driver")>
            <a href="{{ route('dashboard.driver') }}">
              <i class="now-ui-icons location_map-big"></i>
              <p>Driver</p>
            </a>
          </li>
          <li class= @yield("truck")>
            <a href="{{ route('dashboard.truck') }}">
              <i class="now-ui-icons ui-1_bell-53"></i>
              <p>Truck</p>
            </a>
          </li>
          <li class= @yield("company")>
            <a href="{{ route('dashboard.company') }}">
              <i class="now-ui-icons users_single-02"></i>
              <p>Company</p>
            </a>
          </li>
          <li class= @yield("report")>
            <a href="{{ route('dashboard.report') }}">
              <i class="now-ui-icons design_bullet-list-67"></i>
              <p>Report</p>
            </a>
          </li>
          <li class= @yield("settings")>
            <a href="{{ route('dashboard.settings') }}">
              <i class="now-ui-icons text_caps-small"></i>
              <p>Settings</p>
            </a>
          </li>
          <!-- <li class="active-pro">
            <a href="./upgrade.html">
              <i class="now-ui-icons arrows-1_cloud-download-93"></i>
              <p>Upgrade to PRO</p>
            </a>
          </li> -->
        </ul>
      </div>
    </div>
    <div class="main-panel" id="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="#pablo">@yield('title')</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <form>
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Search...">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="now-ui-icons ui-1_zoom-bold"></i>
                  </div>
                </div>
              </div>
            </form>
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="#pablo">
                  <i class="now-ui-icons media-2_sound-wave"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Stats</span>
                  </p>
                </a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="now-ui-icons location_world"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Some Actions</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#pablo">
                  <i class="now-ui-icons users_single-02"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Account</span>
                  </p>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->

      <!--
      Content
      Placeholder
      -->
      <link href="{{asset('/css/app.css')}}" rel="stylesheet" />
   @yield('content')
      <footer class="footer">
        <div class=" container-fluid ">
          <nav>
            <ul>
              <li>
                <a href="https://www.creative-tim.com">
                  Creative Tim
                </a>
              </li>
              <li>
                <a href="http://presentation.creative-tim.com">
                  About Us
                </a>
              </li>
              <li>
                <a href="http://blog.creative-tim.com">
                  Blog
                </a>
              </li>
            </ul>
          </nav>
          <div class="copyright" id="copyright">
            &copy; <script>
              document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
            </script>, Designed by <a href="https://www.invisionapp.com" target="_blank">Invision</a>. Coded by <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a>.
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!--   Core JS Files   -->
  {{asset('')}}
  <script src="{{asset('/js/core/jquery.min.js')}}"></script>
  <script src="{{asset('/js/core/popper.min.js')}}"></script>
  <script src="{{asset('/js/core/bootstrap.min.js')}}"></script>
  <!-- <script src="{{asset('/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script> -->
  <!--  Google Maps Plugin    -->
  <!-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> -->
  <!-- Chart JS -->
  <script src="{{asset('/js/plugins/chartjs.min.js')}}"></script>
  <!--  Notifications Plugin    -->
  <script src="{{asset('/js/plugins/bootstrap-notify.js')}}"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <!-- <script src="{{asset('/js/now-ui-dashboard.min.js?v=1.5.0')}}" type="text/javascript"></script>Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <script src="{{asset('/js/demo.js')}}"></script>
  <script src="{{asset('/js/app.js')}}"></script>
  <script src="{{asset('/local-resource/ajax/libs/moment.js/2.11.2/moment.min.js')}}"></script>
  <script src="{{asset('/local-resource/1.10.7/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('/local-resource/buttons/2.2.2/js/dataTables.buttons.min.js')}} "></script>
  <script src="{{asset('/local-resource/plug-ins/1.10.12/sorting/datetime-moment.js')}} "></script>
  <script src="{{asset('/local-resource/ajax/libs/jszip/3.1.3/jszip.min.js')}} "></script>
  <script src="{{asset('/local-resource/ajax/libs/pdfmake/0.1.53/pdfmake.min.js')}} "></script>
  <script src="{{asset('/local-resource/ajax/libs/pdfmake/0.1.53/vfs_fonts.js')}} "></script>
  <script src="{{asset('/local-resource/buttons/2.2.2/js/buttons.html5.min.js')}} "></script>
  <script src="{{asset('/local-resource/buttons/2.2.2/js/buttons.print.min.js')}} "></script>
  <script src="{{asset('/local-resource/datetime/1.1.2/js/dataTables.dateTime.min.js')}} "></script>
  <script src="{{asset('/local-resource/ajax/jquery.validate/1.10.0/jquery.validate.js')}} " type="text/javascript"></script>
  <script src="{{asset('/local-resource/ui/1.11.4/jquery-ui.js')}}"></script>

  <script src="{{asset('/local-resource/fixedheader/3.2.2/js/dataTables.fixedHeader.min.js')}} "></script>
  
  <!-- Data Table - Responsive -->
  <script src="{{asset('/local-resource/1.11.5/js/jquery.dataTables.min.js')}} "></script>
  <script src="{{asset('/local-resource/responsive/2.2.9/js/dataTables.responsive.min.js')}} "></script>
  
  <!-- Custom JS Function -->
  <script src="{{asset('/js/globalFunctions.js')}}"></script>
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      demo.initDashboardPageCharts();

    });
  </script>
  @yield('scripts')
  <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->

</body>

</html>