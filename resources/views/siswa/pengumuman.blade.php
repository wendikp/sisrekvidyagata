<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" type="image/png" href="{{ url('/image/logo_sekolah.jpg') }}">
  <title>SisRek Vidyagata</title>
  <!-- Font Awesome Icons -->
  <link href="{{ asset('landing-page/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
  <!-- Plugin CSS -->
  <link href="{{ asset('landing-page/vendor/magnific-popup/magnific-popup.css') }}" rel="stylesheet">
  <!-- Theme CSS - Includes Bootstrap -->
  <link href="{{ asset('landing-page/css/creative.css') }}" rel="stylesheet">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
</head>

<body id="page-top">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
    <div class="container">
      <!-- <a class="navbar-brand js-scroll-trigger" href="{{ url('/homepage') }}">SisRek Vidyagata</a> -->
      @if($kriteria_peminatan != null)
      <a class="navbar-brand js-scroll-trigger" href="{{ url('/homepage') }}"><i class="fa fa-arrow-left"></i> Kembali</a>
      @endif
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto my-2 my-lg-0">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#pengumuman">Pengumuman</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> {{ __('Logout') }}</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Masthead -->
  <header class="masthead2"></header>

  <!-- Pengumuman Section -->
  <section class="page-section bg-light" id="pengumuman">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-10 text-center">
          <h2 class="mt-0">Pengumuman</h2>
          <hr class="divider my-4">
          <div class="row">
            <div class="col-lg-4 text-left mb-4">
              <table class="table table-sm table-striped table-borderless">
                @foreach($pengumuman as $data)
                <tr>
                  <td class="text-muted mb-4" style="font-size: 13px;"><a href="{{ url('/pengumuman/detail/'.$data->id) }}" style="color: black;">{{ $data->judul }}</a>
                    <?php
                    echo "$data->day-$data->month-$data->year";
                    ?>
                  </td>
                </tr>
                @endforeach
              </table>
            </div>
            <div class="col-lg-8 text-left mb-4">
              <table class="table table-sm table-borderless">
                @foreach($pengumumanid as $data)
                <tr class="text-muted mb-4" style="font-size: 13px;">
                  <td>{{ $data->judul }}</td>
                  <td style="text-align: right;">
                    <label>
                      <?php
                      echo "$data->day-$data->month-$data->year";
                      ?>
                    </label>
                  </td>
                </tr>
                <tr>
                  <td style="color: black;" colspan="2">{{ $data->isi }}</td>
                </tr>
                @endforeach
                @if($id == "kosong")
                Belum ada pengumuman
                @endif
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-dark py-5">
    <div class="container">
      <div class="small text-center text-muted">
        <strong>Copyright &copy; 2018 <a href="https://vidyagata.wordpress.com/about/">SMAN 6 Malang</a>.</strong> All rights
        reserved.
      </div>
    </div>
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="{{ asset('landing-page/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('landing-page/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Plugin JavaScript -->
  <script src="{{ asset('landing-page/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('landing-page/vendor/magnific-popup/jquery.magnific-popup.min.js') }}"></script>

  <!-- Custom scripts for this template -->
  <script src="{{ asset('landing-page/js/creative.min.js') }}"></script>

  <!-- DataTables -->
  <script src="{{ asset('AdminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('AdminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

  <script>
    $(function () {
      $('#example1').DataTable()
      $('#example2').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false
      })
    });
  </script>

</body>

</html>