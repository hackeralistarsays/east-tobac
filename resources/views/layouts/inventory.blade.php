<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Inventory</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('admin/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{asset('admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('admin/plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('admin/dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('admin/plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('admin/plugins/summernote/summernote-bs4.min.css')}}">
    <style>
      .sidebar{
        margin-left: -50px;
        height: auto;
        overflow: auto;
        width: 150%;
      }
      .sidebar .user-info {
    position: absolute;;
    border-bottom: 1px solid #eee
}
.image{
  height: 150px;
    overflow: hidden;
    background-size: cover;
    background-position: top
}
.stretchRight {
    animation-name: stretchRight;
    -webkit-animation-name: stretchRight;
    animation-duration: 1.5s;
    -webkit-animation-duration: 1.5s;
    animation-timing-function: ease-out;
    -webkit-animation-timing-function: ease-out;
    transform-origin: 0% 0%;
    -ms-transform-origin: 0% 0%;
    -webkit-transform-origin: 0% 0%
}

@keyframes stretchRight {
    0% {
        transform: scaleX(0.3)
    }
    40% {
        transform: scaleX(1.02)
    }
    60% {
        transform: scaleX(0.98)
    }
    80% {
        transform: scaleX(1.01)
    }
    100% {
        transform: scaleX(0.98)
    }
    80% {
        transform: scaleX(1.01)
    }
    100% {
        transform: scaleX(1)
    }
}

@-webkit-keyframes stretchRight {
    0% {
        -webkit-transform: scaleX(0.3)
    }
    40% {
        -webkit-transform: scaleX(1.02)
    }
    60% {
        -webkit-transform: scaleX(0.98)
    }
    80% {
        -webkit-transform: scaleX(1.01)
    }
    100% {
        -webkit-transform: scaleX(0.98)
    }
    80% {
        -webkit-transform: scaleX(1.01)
    }
    100% {
        -webkit-transform: scaleX(1)
    }
}
.sidebar .user-info a {
    display: inline-block !important
}

.sidebar .menu {
    position: relative;
}

.sidebar .menu .list {
    list-style: none;
    margin: 0 15px
}

.sidebar .menu .list li.active > :first-child span {
    font-weight: 700
}

.sidebar .menu .list .header {
    font-weight: 700;
    color: #455a64;
    padding: 8px 12px;
    position: relative
}
#events {
    margin-bottom: 1em;
    padding: 1em;
    background-color: #f6f6f6;
    border: 1px solid #999;
    border-radius: 3px;
    height: 100px;
    overflow: auto;
}
.sidebar .menu .list .header:before {
    position:absolute;
    left: 0;
    top: 7px
}

.sidebar .menu .list i.material-icons {
    margin-top: 4px
}

.sidebar .menu .list .menu-toggle:after, .sidebar .menu .list .menu-toggle:before {
    -moz-transform: scale(0);
    -ms-transform: scale(0);
    -o-transform: scale(0);
    -webkit-transform: scale(0);
    transform: scale(0);
    -moz-transition: all 0.3s;
    -o-transition: all 0.3s;
    -webkit-transition: all 0.3s;
    transition: all 0.3s;
    font-family: 'Material-Design-Iconic-Font';
    position: absolute;
    top: calc(50% - 11px);
    right: 17px
}

.sidebar .menu .list .menu-toggle:before {
    -moz-transform: scale(1);
    -ms-transform: scale(1);
    -o-transform: scale(1);
    -webkit-transform: scale(1);
    transform: scale(1);
    content: '\f2fb'
}

.sidebar .menu .list .menu-toggle:after {
    -moz-transform: scale(0);
    -ms-transform: scale(0);
    -o-transform: scale(0);
    -webkit-transform: scale(0);
    transform: scale(0);
    content: '\f2f9'
}

.sidebar .menu .list .menu-toggle.toggled:before {
    content: '\f2f9';
    -moz-transform: scale(0);
    -ms-transform: scale(0);
    -o-transform: scale(0);
    -webkit-transform: scale(0);
    transform: scale(0);
    font-family: 'Material-Design-Iconic-Font'
}

.sidebar .menu .list .menu-toggle.toggled:after {
    -moz-transform: scale(1);
    -ms-transform: scale(1);
    -o-transform: scale(1);
    -webkit-transform: scale(1);
    transform: scale(1)
}

.sidebar .menu .list a {
    color: #546e7a;
    position: relative;
    padding: 14px 10px
}

.sidebar .menu .list a:hover, .sidebar .menu .list a:active, .sidebar .menu .list a:focus {
    text-decoration: none !important
}

.sidebar .menu .list a i {
    width: 16px
}

.sidebar .menu .list a small {
    position: absolute;
    top: calc(50% - 7.5px);
    right: 15px
}

.sidebar .menu .list a span {
    margin: 0 0 0 12px
}

.sidebar .menu .list .ml-menu {
    list-style: none;
    display: none
}

.sidebar .menu .list .ml-menu span {
    font-weight: normal;
    margin: 3px 0 1px 6px
}

.sidebar .menu .list .ml-menu li a {
    padding-left: 40px;
    padding-top: 7px;
    padding-bottom: 7px
}

.sidebar .menu .list .ml-menu li a:before {
    content: '\f30f';
    position: absolute;
    left: 14px;
    font-family: 'Material-Design-Iconic-Font';
    color: #999;
    top: 8px
}

.sidebar .menu .list .ml-menu li.active a.toggled:not(.menu-toggle) {
    font-weight: 600
}

.sidebar .menu .progress-container {
    margin: 12px
}
.sidebar {
    -moz-transition: all 0.5s;
    -o-transition: all 0.5s;
    -webkit-transition: all 0.5s;
    transition: all 0.5s;
    font-family: "Montserrat", sans-serif;
    background: #fff;
    width: 250px;
    height: 100vh;
    position: fixed;
    top: 0px;
    left: 0;
    box-shadow: 1px 0px 20px rgba(0, 0, 0, 0.08);
    z-index: 11
}

.sidebar .nav-tabs {
    padding: 7px 10px
}

.sidebar .user-info {
    position: relative;
    border-bottom: 1px solid #eee
}

.sidebar .user-info .image img {
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    -ms-border-radius: 50%;
    border-radius: 50%;
    width: 80px;
    vertical-align: bottom !important;
    border: 3px solid #fff;
    box-shadow: 0px 5px 25px 0px rgba(0, 0, 0, 0.2)
}

.sidebar .user-info a {
    display: inline-block !important
}

.sidebar .menu {
    position: relative
}

.sidebar .menu .list {
    list-style: none;
    margin: 0 15px
}

.sidebar .menu .list li.active > :first-child span {
    font-weight: 700
}

.sidebar .menu .list .header {
    font-weight: 700;
    color: #455a64;
    padding: 8px 12px;
    position: relative
}
#events {
    margin-bottom: 1em;
    padding: 1em;
    background-color: #f6f6f6;
    border: 1px solid #999;
    border-radius: 3px;
    height: 100px;
    overflow: auto;
}
.sidebar .menu .list .header:before {
    position: absolute;
    left: 0;
    top: 7px
}

.sidebar .menu .list i.material-icons {
    margin-top: 4px
}

.sidebar .menu .list .menu-toggle:after, .sidebar .menu .list .menu-toggle:before {
    -moz-transform: scale(0);
    -ms-transform: scale(0);
    -o-transform: scale(0);
    -webkit-transform: scale(0);
    transform: scale(0);
    -moz-transition: all 0.3s;
    -o-transition: all 0.3s;
    -webkit-transition: all 0.3s;
    transition: all 0.3s;
    font-family: 'Material-Design-Iconic-Font';
    position: absolute;
    top: calc(50% - 11px);
    right: 17px
}

.sidebar .menu .list .menu-toggle:before {
    -moz-transform: scale(1);
    -ms-transform: scale(1);
    -o-transform: scale(1);
    -webkit-transform: scale(1);
    transform: scale(1);
    content: '\f2fb'
}

.sidebar .menu .list .menu-toggle:after {
    -moz-transform: scale(0);
    -ms-transform: scale(0);
    -o-transform: scale(0);
    -webkit-transform: scale(0);
    transform: scale(0);
    content: '\f2f9'
}

.sidebar .menu .list .menu-toggle.toggled:before {
    content: '\f2f9';
    -moz-transform: scale(0);
    -ms-transform: scale(0);
    -o-transform: scale(0);
    -webkit-transform: scale(0);
    transform: scale(0);
    font-family: 'Material-Design-Iconic-Font'
}

.sidebar .menu .list .menu-toggle.toggled:after {
    -moz-transform: scale(1);
    -ms-transform: scale(1);
    -o-transform: scale(1);
    -webkit-transform: scale(1);
    transform: scale(1)
}

.sidebar .menu .list a {
    color: #546e7a;
    position: relative;
    padding: 14px 10px
}

.sidebar .menu .list a:hover, .sidebar .menu .list a:active, .sidebar .menu .list a:focus {
    text-decoration: none !important
}

.sidebar .menu .list a i {
    width: 16px
}

.sidebar .menu .list a small {
    position: absolute;
    top: calc(50% - 7.5px);
    right: 15px
}

.sidebar .menu .list a span {
    margin: 0 0 0 12px
}

.sidebar .menu .list .ml-menu {
    list-style: none;
    display: none
}

.sidebar .menu .list .ml-menu span {
    font-weight: normal;
    margin: 3px 0 1px 6px
}

.sidebar .menu .list .ml-menu li a {
    padding-left: 40px;
    padding-top: 7px;
    padding-bottom: 7px
}

.sidebar .menu .list .ml-menu li a:before {
    content: '\f30f';
    position: absolute;
    left: 14px;
    font-family: 'Material-Design-Iconic-Font';
    color: #999;
    top: 8px
}

.sidebar .menu .list .ml-menu li.active a.toggled:not(.menu-toggle) {
    font-weight: 600
}

.sidebar .menu .progress-container {
    margin: 12px
}
.sidebar .menu .list .header {
    font-weight: 700;
    color: #455a64;
    padding: 8px 12px;
    position: relative
}
.nav-treeview{
  color:grey;
  font-size: 90%;
  margin-left: 20px;
}
.fa-arrow-right{
  margin-right: -10px;

}


    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  
  <aside id="sidebar" class="sidebar collapse show" data-widget="treeview" role="menu" data-accordion="false">
    <div class="tab-content">
        <div class="tab-pane stretchRight active" id="dashboard">
            <div class="menu">
                <ul class="list">
                    <li>
                        <div class="user-info" style="text-align:center;">
                           
                            <div class="image" style="margin-bottom: -50px;"><a href="/"><img src="{{ asset('images/avatar-1.jpg') }}" alt="user-image" alt="User"></a></div>
                            <div class="detail" >
                              <span>
                                <span class="account-user-name">{{ Auth::user()->name }}</span>
                                <a href="{{ route('logout') }}" class="dropdown-item notify-item" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                    <i class="mdi mdi-logout mr-1"></i>
                                    <span class="text-red"><i class="fa fa-power"></i> Logout</span>
                                </a>            
                
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </span>
                            </div>
                            <a title="facebook" href="javascript:void(0);"><i class="fab fa-facebook-f"></i></a>
                            <a title="twitter" href="javascript:void(0);"><i class="fab fa-twitter"></i></a>
                            <a title="instagram" href="javascript:void(0);"><i class="fab fa-instagram"></i></a>
                        </div>
                    </li>
                    <li class="nav-item">
                      <a href="" class="nav-link">
                          <i class="nav-icon fas fa-home"></i>
                          <span>
                              Home
                          </span>
                      </a>
                  </li>
                  @can('roles')
                    <li class="nav-item">
                      <a href="" class="nav-link">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <span>
                              Dashboard
                          </span>
                      </a>
                  </li>
                  @endcan
                  <li class="nav-item">
                    <a href="#" class="nav-link" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="products">
                      <i class=" nav-icon fas fa-dolly"></i>
                      <span>
                        Products
                        <i class="right fas fa-angle-right"></i>
                      </span>
                    </a>
                    <ul class="nav nav-treeview collapse" id="products">
                      <li class="nav-item">
                        <a href="{{route('products.create')}}" class="nav-link">
                          <i class="fa fa-arrow-right"></i>
                          <span class="text-muted">Add Product</span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{route('units.create')}}" class="nav-link">
                          <i class="fa fa-arrow-right text-muted"></i>
                          <span>Add Unit</span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{route('tobaccotypes.create')}}" class="nav-link">
                          <i class="fa fa-arrow-right text-muted"></i>
                          <span>Add Type</span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{route('grades.create')}}" class="nav-link">
                          <i class="fa fa-arrow-right text-muted"></i>
                          <span>Add Grade</span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{route('balereceptions.create')}}" class="nav-link">
                          <i class="fa fa-arrow-right text-muted"></i>
                          <span>Add Supplier</span>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link ">
                      <i class=" nav-icon fas fa-warehouse"></i>
                      <span>
                        Stocks
                        <i class="right fas fa-angle-right"></i>
                      </span>
                    </a>
                    <ul class="nav nav-treeview collapse">
                      <li class="nav-item">
                        <a href="{{route('stocks.in')}}" class="nav-link">
                          <i class="fa fa-arrow-right text-muted"></i>
                          <span>Stock in</span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{route('stocks.out')}}" class="nav-link">
                          <i class="fa fa-arrow-right text-muted"></i>
                          <span>Stock Out</span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{route('stocks.available')}}" class="nav-link">
                          <i class="fa fa-arrow-right text-muted"></i>
                          <span>Available Stock</span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="" class="nav-link">
                          <i class="fa fa-arrow-right text-muted"></i>
                          <span>Destroyed Stock</span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="" class="nav-link">
                          <i class="fa fa-arrow-right text-muted"></i>
                          <span>Stock Conversion</span>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link ">
                      <i class=" nav-icon fas fa-file"></i>
                      <span>
                        Reports
                        <i class="right fas fa-angle-right"></i>
                      </span>
                    </a>
                    <ul class="nav nav-treeview collapse">
                      <li class="nav-item">
                        <a href="" class="nav-link">
                          <i class="fa fa-arrow-right nav-icon"></i>
                          <span>Availability</span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="" class="nav-link">
                          <i class="fa fa-arrow-right nav-icon"></i>
                          <span>All Categories</span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="" class="nav-link">
                          <i class="fa fa-arrow-right nav-icon"></i>
                          <span>Profit/Loss</span>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-item">
                    <a href="" class="nav-link ">
                      <i class="fas fa-coins nav-icon"></i>
                      <span>
                        Expenses
                      </span>
                    </a>
                  </li>
                @can('roles')
                <li class="nav-item">
                  <a href="" class="nav-link ">
                    <i class="fas fa-user-friends nav-icon"></i>
                    <span>
                      Users
                    </span>
                  </a>
                </li>
                @endcan
                <li class="nav-item">
                  <a href="" class="nav-link">
                    <i class="fas fa-user nav-icon"></i>
                    <span>
                      Profile
                    </span>
                  </a>
                </li>
                </ul>
            </div>
        </div>
    </div>
</aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
    <!-- /.content-header -->

    <!-- Main content -->
    @yield('content')
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; {{now()->year}} <a href="/">LEAF</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('admin/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('admin/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('admin/plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{asset('admin/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('admin/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('admin/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('admin/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('admin/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('admin/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('admin/dist/js/adminlte.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('admin/dist/js/demo.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('admin/dist/js/pages/dashboard.js')}}"></script>
<!-- OPTIONAL SCRIPTS -->
<script src="{{asset('admin/plugins/chart.js/Chart.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('admin/dist/js/demo.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('admin/dist/js/pages/dashboard3.js')}}"></script>
{{-- For ChartJS --}}
<script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
<!-- Chartisan -->
<script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
</body>
</html>
