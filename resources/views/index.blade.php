<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SisRek Vidyagata | @yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('AdminLTE/bower_components/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('AdminLTE/bower_components/Ionicons/css/ionicons.min.css') }}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{ asset('AdminLTE/bower_components/jvectormap/jquery-jvectormap.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/AdminLTE.min.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
  folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/skins/_all-skins.min.css') }}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
  href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <header class="main-header">

      <!-- Logo -->
      <a href="{{ asset('AdminLTE/index2.html') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">SrV</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">SisRek Vidyagata</span>
      </a>

      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="hidden-xs">Logout</span></a>
            </li>
          </ul>
        </div>

      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="{{ asset('AdminLTE/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p>Alexander Pierce</p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>
        
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">MENU UTAMA</li>
          <li class="active treeview menu-open">
            <a href="#">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{ asset('AdminLTE/index.html') }}"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
              <li class="active"><a href="{{ asset('AdminLTE/index2.html') }}"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-files-o"></i>
              <span>Layout Options</span>
              <span class="pull-right-container">
                <span class="label label-primary pull-right">4</span>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{ asset('AdminLTE/pages/layout/top-nav.html') }}"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
              <li><a href="{{ asset('AdminLTE/pages/layout/boxed.html') }}"><i class="fa fa-circle-o"></i> Boxed</a></li>
              <li><a href="{{ asset('AdminLTE/pages/layout/fixed.html') }}"><i class="fa fa-circle-o"></i> Fixed</a></li>
              <li><a href="{{ asset('AdminLTE/pages/layout/collapsed-sidebar.html') }}"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
            </ul>
          </li>
          <li>
            <a href="{{ asset('AdminLTE/pages/widgets.html') }}">
              <i class="fa fa-th"></i> <span>Widgets</span>
              <span class="pull-right-container">
                <small class="label pull-right bg-green">new</small>
              </span>
            </a>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-pie-chart"></i>
              <span>Charts</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{ asset('AdminLTE/pages/charts/chartjs.html') }}"><i class="fa fa-circle-o"></i> ChartJS</a></li>
              <li><a href="{{ asset('AdminLTE/pages/charts/morris.html') }}"><i class="fa fa-circle-o"></i> Morris</a></li>
              <li><a href="{{ asset('AdminLTE/pages/charts/flot.html') }}"><i class="fa fa-circle-o"></i> Flot</a></li>
              <li><a href="{{ asset('AdminLTE/pages/charts/inline.html') }}"><i class="fa fa-circle-o"></i> Inline charts</a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-laptop"></i>
              <span>UI Elements</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{ asset('AdminLTE/pages/UI/general.html') }}"><i class="fa fa-circle-o"></i> General</a></li>
              <li><a href="{{ asset('AdminLTE/pages/UI/icons.html') }}"><i class="fa fa-circle-o"></i> Icons</a></li>
              <li><a href="{{ asset('AdminLTE/pages/UI/buttons.html') }}"><i class="fa fa-circle-o"></i> Buttons</a></li>
              <li><a href="{{ asset('AdminLTE/pages/UI/sliders.html') }}"><i class="fa fa-circle-o"></i> Sliders</a></li>
              <li><a href="{{ asset('AdminLTE/pages/UI/timeline.html') }}"><i class="fa fa-circle-o"></i> Timeline</a></li>
              <li><a href="{{ asset('AdminLTE/pages/UI/modals.html') }}"><i class="fa fa-circle-o"></i> Modals</a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-edit"></i> <span>Forms</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{ asset('AdminLTE/pages/forms/general.html') }}"><i class="fa fa-circle-o"></i> General Elements</a></li>
              <li><a href="{{ asset('AdminLTE/pages/forms/advanced.html') }}"><i class="fa fa-circle-o"></i> Advanced Elements</a></li>
              <li><a href="{{ asset('AdminLTE/pages/forms/editors.html') }}"><i class="fa fa-circle-o"></i> Editors</a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-table"></i> <span>Tables</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{ asset('AdminLTE/pages/tables/simple.html') }}"><i class="fa fa-circle-o"></i> Simple tables</a></li>
              <li><a href="{{ asset('AdminLTE/pages/tables/data.html') }}"><i class="fa fa-circle-o"></i> Data tables</a></li>
            </ul>
          </li>
          <li>
            <a href="{{ asset('AdminLTE/pages/calendar.html') }}">
              <i class="fa fa-calendar"></i> <span>Calendar</span>
              <span class="pull-right-container">
                <small class="label pull-right bg-red">3</small>
                <small class="label pull-right bg-blue">17</small>
              </span>
            </a>
          </li>
          <li>
            <a href="{{ asset('AdminLTE/pages/mailbox/mailbox.html') }}">
              <i class="fa fa-envelope"></i> <span>Mailbox</span>
              <span class="pull-right-container">
                <small class="label pull-right bg-yellow">12</small>
                <small class="label pull-right bg-green">16</small>
                <small class="label pull-right bg-red">5</small>
              </span>
            </a>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-folder"></i> <span>Examples</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{ asset('AdminLTE/pages/examples/invoice.html') }}"><i class="fa fa-circle-o"></i> Invoice</a></li>
              <li><a href="{{ asset('AdminLTE/pages/examples/profile.html') }}"><i class="fa fa-circle-o"></i> Profile</a></li>
              <li><a href="{{ asset('AdminLTE/pages/examples/login.html') }}"><i class="fa fa-circle-o"></i> Login</a></li>
              <li><a href="{{ asset('AdminLTE/pages/examples/register.html') }}"><i class="fa fa-circle-o"></i> Register</a></li>
              <li><a href="{{ asset('AdminLTE/pages/examples/lockscreen.html') }}"><i class="fa fa-circle-o"></i> Lockscreen</a></li>
              <li><a href="{{ asset('AdminLTE/pages/examples/404.html') }}"><i class="fa fa-circle-o"></i> 404 Error</a></li>
              <li><a href="{{ asset('AdminLTE/pages/examples/500.html') }}"><i class="fa fa-circle-o"></i> 500 Error</a></li>
              <li><a href="{{ asset('AdminLTE/pages/examples/blank.html') }}"><i class="fa fa-circle-o"></i> Blank Page</a></li>
              <li><a href="{{ asset('AdminLTE/pages/examples/pace.html') }}"><i class="fa fa-circle-o"></i> Pace Page</a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-share"></i> <span>Multilevel</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
              <li class="treeview">
                <a href="#"><i class="fa fa-circle-o"></i> Level One
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                  <li class="treeview">
                    <a href="#"><i class="fa fa-circle-o"></i> Level Two
                      <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                      </span>
                    </a>
                    <ul class="treeview-menu">
                      <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                      <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                    </ul>
                  </li>
                </ul>
              </li>
              <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
            </ul>
          </li>
          <li><a href="https://adminlte.io/docs"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
          <li class="header">LABELS</li>
          <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
          <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
          <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Dashboard
          <small>Version 2.0</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Dashboard</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">

                <h3 class="box-title">Tambah Siswa Baru</h3>
              </div><!-- /.box-header -->
              <div class="box-body">
                <form action="" role="form" method="POST">
                  <div class="form-group">
                    <label for="">Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama_lkp" placeholder="Nama Lengkap" style="width: 230px;" required="required">
                  </div>
                  <div class="form-group">
                    <label for="">NISN</label>
                    <input type="text" class="form-control" name="nisn" placeholder="NISN" style="width: 230px;" required="required">
                  </div>
                  <div class="form-group">
                    <label for="nopol">Tanggal Lahir</label>
                    <input type="text" class="form-control" name="tgl" placeholder="YYYY-MM-DD" style="width: 230px;" required="required">
                  </div>
                  <div class="form-group">
                    <label for="nopol">Alamat</label>
                    <textarea class="form-control " name="alamat" rows="5" cols="80" style="width: 500px;"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="">Asal Sekolah</label>
                    <input type="text" class="form-control" name="nama_lkp" placeholder="Nama Lengkap" style="width: 230px;" required="required">
                  </div>
                  <div class="form-group">
                    <button name="submit" value="submit" type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </section><!-- /.content -->

    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b>Version</b> 2.4.0
      </div>
      <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
      reserved.
    </footer>

  </div>
  <!-- ./wrapper -->

  <!-- jQuery 3 -->
  <script src="{{ asset('AdminLTE/bower_components/jquery/dist/jquery.min.js') }}"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="{{ asset('AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
  <!-- FastClick -->
  <script src="{{ asset('AdminLTE/bower_components/fastclick/lib/fastclick.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('AdminLTE/dist/js/adminlte.min.js') }}"></script>
  <!-- Sparkline -->
  <script src="{{ asset('AdminLTE/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
  <!-- jvectormap  -->
  <script src="{{ asset('AdminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
  <script src="{{ asset('AdminLTE/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
  <!-- SlimScroll -->
  <script src="{{ asset('AdminLTE/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
  <!-- ChartJS -->
  <script src="{{ asset('AdminLTE/bower_components/Chart.js/Chart.js') }}"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="{{ asset('AdminLTE/dist/js/pages/dashboard2.js') }}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{ asset('AdminLTE/dist/js/demo.js') }}"></script>
</body>
</html>
