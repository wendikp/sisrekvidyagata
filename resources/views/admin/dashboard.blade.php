@extends('layouts/template_admin')

@section('title')
Dashboard
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard active"></i> Dashboard</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <h1 style="text-align: center; padding-bottom: 30px;">Selamat Datang di Website <b>SisRek</b> Vidyagata</h1>
      </div>
    </div>
    <!-- Info boxes -->
    <div class="row">
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-green"><i class="ion ion-ios-person-outline"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Akun Admin</span>
            <span class="info-box-number">{{ $jml_admin }}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-yellow"><i class="ion ion-ios-person-outline"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Akun Waka Kurikulum</span>
            <span class="info-box-number">{{ $jml_waka }}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <!-- fix for small devices only -->
      <div class="clearfix visible-sm-block"></div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-blue"><i class="ion ion-ios-person-outline"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Akun Tim PPDB</span>
            <span class="info-box-number">{{ $jml_timppdb }}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-aqua"><i class="ion ion-ios-people-outline"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Akun Siswa</span>
            <span class="info-box-number">{{ $jml_siswa }}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    
    <div class="row">
      <div class="col-md-9">
        <!-- BAR CHART -->
        <div class="box box-primary">
          <div class="box-body">
            <div id="barChart"></div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col (RIGHT) -->
      <div class="col-md-3">
        <!-- About Me Box -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <img class="profile-user-img img-responsive img-circle" src="{{ asset('AdminLTE/dist/img/user.jpg') }}" alt="User profile picture">
            @foreach($data_admin as $data)
            <h3 class="profile-username text-center">{{ $data->name }}</h3>
            <p class="text-muted text-center">{{ $data->no_induk }}</p>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <strong><i class="fa fa-phone margin-r-5"></i> No. Telepon</strong>
            <p class="text-muted">{{ $data->no_telepon }}</p>
            <hr>
            <strong><i class="fa fa-envelope margin-r-5"></i> Email</strong>
            <p class="text-muted">{{ $data->email }}</p>
            <hr>
            <strong><i class="fa fa-birthday-cake margin-r-5"></i> Tanggal lahir</strong>
            <p class="text-muted">
              <?php
              $birthday = explode("-", $data->tgl_lahir);
              echo "$birthday[2]-$birthday[1]-$birthday[0]";
              ?>
            </p>
            <hr>
            <strong><i class="fa fa-map-marker margin-r-5"></i> Alamat</strong>
            <p class="text-muted">{{ $data->alamat }}</p>
            @endforeach
          </div>
          <!-- /.box-body -->
          <div class="box-footer text-align-center">
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-password">Ganti Password</button>
          </div>
          <!-- /.box-footer -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Form modal -->
    <div class="modal modal-primary fade" id="modal-password">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Ganti password</h4>
          </div>
          <form action="{{ url('/dashboard-admin/gantiPassword') }}" role="form" method="POST">
            <div class="modal-body">
              @csrf
              <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
              <table class="table table-responsive">
                <tr>
                  <td style="border: none; width: 150px">Password Baru</td>
                  <td style="border: none;">:</td>
                  <td style="border: none;">
                    <input type="password" class="form-control" id="pw1" name="password_baru" placeholder="Password Baru" style="width: 220px;" required="required">
                  </td>
                </tr>
                <tr>
                  <td style="border: none;">Konfirmasi Password</td>
                  <td style="border: none;">:</td>
                  <td style="border: none;">
                    <input type="password" class="form-control" id="pw2" name="konfirmasi_password" placeholder="Masukkan Ulang Password" style="width: 220px;" required="required">
                  </td>
                </tr>
              </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
              <button type="submit" value="submit" class="btn btn-outline">Submit</button>
            </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

@section('script-js')
<!-- ChartJS -->
<script src="https://code.highcharts.com/highcharts.js"></script>
@endsection

@section('page-script')
<script type="text/javascript">
  // New Password confirmation
  window.onload = function () {
    document.getElementById("pw1").onchange = validatePassword;
    document.getElementById("pw2").onchange = validatePassword;
  };

  function validatePassword(){
    var pass2=document.getElementById("pw2").value;
    var pass1=document.getElementById("pw1").value;
    if(pass1!=pass2)
      document.getElementById("pw2").setCustomValidity("Passwords Tidak Sama, Coba Lagi");
    else
      document.getElementById("pw2").setCustomValidity('');
  };

  Highcharts.chart('barChart', { 
    chart: {
      type: 'column'
    },
    title: {
      text: 'Jumlah Siswa Baru Setiap Tahun'
    },
    xAxis: {
      categories: {!! json_encode($angkatan) !!},
      crosshair: true
    },
    yAxis: {
      min: 0,
      title: {
        text: 'Jumlah'
      }
    },
    tooltip: {
      headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
      pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
      '<td style="padding:0"><b>{point.y:.0f}</b></td></tr>',
      footerFormat: '</table>',
      shared: true,
      useHTML: true
    },
    plotOptions: {
      column: {
        pointPadding: 0.2,
        borderWidth: 0
      }
    },
    series: [{
      name: 'Jumlah Siswa',
      data: {!! json_encode($jumlah) !!}
    }]
  });
</script>
@endsection