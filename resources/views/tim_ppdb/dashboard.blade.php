@extends('layouts/template_tim_ppdb')

@section('title')
Dashboard
@endsection

@section('style')
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="{{ asset('AdminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
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
      <div class="col-md-9">
        <div class="col-md-6">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-person-outline"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Siswa IPA</span>
              <span class="info-box-number">{{ $jumlah_siswa_ipa }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-6">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-person-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Siswa IPS</span>
              <span class="info-box-number">{{ $jumlah_siswa_ips }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-6">
          <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="ion ion-ios-person-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Siswa Bahasa</span>
              <span class="info-box-number">{{ $jumlah_siswa_bhs }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-6">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Siswa Baru</span>
              <span class="info-box-number">{{ $total }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <div class="col-md-12">
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
      </div>
      <!-- col. left -->

      <div class="col-md-3">
        <!-- About Me Box -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <img class="profile-user-img img-responsive img-circle" src="{{ asset('AdminLTE/dist/img/user.jpg') }}" alt="User profile picture">
            @foreach($data_tim as $data)
            <h3 class="profile-username text-center">{{ $data->name }}</h3>

            <p class="text-muted text-center">{{ $data->no_induk }} | {{ $data->periode }}</p>
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
          <div class="box-footer">
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-profil">Edit Profil</button>
            <button type="button" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#modal-password">Ganti Password</button>
          </div>
          <!-- /.box-footer -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Form modal -->
    <div class="modal modal-primary fade" id="modal-profil">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Edit Profil</h4>
          </div>
          <div class="modal-body">
            <form action="{{ url('/dashboard-tim-ppdb/updateProfil') }}" role="form" method="POST">
              @csrf
              @foreach($data_tim as $data)
              <input type="hidden" name="id" value="{{ $data->id }}">
              <table class="table table-responsive table-condensed">
                <tr>
                  <div class="form-group">
                    <td style="border: none; width: 110px;">NIP/NIK</td>
                    <td style="border: none; width: 20px;">:</td>
                    <td style="border: none;"><input type="text" class="form-control" name="no_induk" value="{{ $data->no_induk }}" style="width: 230px;" required="required"></td>
                  </div>
                </tr>
                <tr>
                  <div class="form-group">
                    <td style="border: none;">Nama Lengkap</td>
                    <td style="border: none;">:</td>
                    <td style="border: none;"><input type="text" class="form-control" name="nama" value="{{ $data->name }}" style="width: 230px;" required="required"></td>
                  </div>
                </tr>
                <tr>
                  <div class="form-group">
                    <td style="border: none;">Email</td>
                    <td style="border: none;">:</td>
                    <td style="border: none;"><input type="email" class="form-control" name="email" value="{{ $data->email }}" style="width: 230px;" required="required"></td>
                  </div>
                </tr>
                <tr>
                  <div class="form-group">
                    <td style="border: none;">No. HP</td>
                    <td style="border: none;">:</td>
                    <td style="border: none;">
                      <input type="text" class="form-control" name="no_hp" value="{{ $data->no_telepon }}" style="width: 230px;" required="required" data-inputmask='"mask": "9999-9999-9999"' data-mask>
                    </td>
                  </div>
                </tr>
                <tr>
                  <div class="form-group">
                    <td style="border: none;">Tanggal Lahir</td>
                    <td style="border: none;">:</td>
                    <td style="border: none;">
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <?php
                        $exploded_data = explode("-", $data->tgl_lahir);
                        ?>
                        <input type="text" class="form-control" id="datepicker" name="tgl_lahir" value='<?php echo "$exploded_data[2]-$exploded_data[1]-$exploded_data[0]" ?>' style="width: 192px;" required="required">
                      </div>
                    </td>
                  </div>
                </tr>
                <tr>
                  <div class="form-group">
                    <td style="border: none;">Jenis Kelamin</td>
                    <td style="border: none;">:</td>
                    <td style="border: none;">
                      <select name="jenis_kelamin" class="form-control" style="width: 130px;" required="required">
                        <?php
                        if ($data->jenis_kelamin == "L" || $data->jenis_kelamin == "Laki-laki") {
                          ?>
                          <option value="L">Laki-laki</option>
                          <option value="P">Perempuan</option>
                          <?php
                        } else {
                          ?>
                          <option value="P">Perempuan</option>
                          <option value="L">Laki-laki</option>
                          <?php
                        }
                        ?>
                      </select>
                    </td>
                  </div>
                </tr>
                <tr>
                  <td style="border: none;">Periode</td>
                  <td style="border: none;">:</td>
                  <td style="border: none;">
                    <input type="text" class="form-control" name="periode" value="{{ $data->periode }}" style="width: 230px;" required="required" data-inputmask='"mask": "9999 - 9999"' data-mask placeholder="Ex: 2010 - 2014">
                  </td>
                </tr>
                <tr>
                  <td style="border: none;">Alamat</td>
                  <td style="border: none;">:</td>
                  <td style="border: none;"><textarea class="form-control " name="alamat" rows="3" cols="80" required="required">{{ $data->alamat }}</textarea></td>
                </tr>
              </table>
              <?php
              $id = Auth::user()->id;
              ?>
              @endforeach
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

    <!-- Form modal -->
    <div class="modal modal-primary fade" id="modal-password">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Ganti password</h4>
          </div>
          <div class="modal-body">
            <form action="{{ url('/dashboard-tim-ppdb/gantiPassword') }}" role="form" method="POST">
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
<!-- bootstrap datepicker -->
<script src="{{ asset('AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<!-- InputMask -->
<script src="{{ asset('AdminLTE/plugins/input-mask/jquery.inputmask.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
@endsection

@section('page-script')
<!-- page script -->
<script>
  //Input mask
  $('[data-mask]').inputmask();

  //Date picker
  $('#datepicker').datepicker({
    format: "dd-mm-yyyy",
    autoclose:true
  });

  // New Password confirmation
  window.onload = function () {
    document.getElementById("pw1").onchange = validatePassword;
    document.getElementById("pw2").onchange = validatePassword;
  }
  function validatePassword(){
    var pass2=document.getElementById("pw2").value;
    var pass1=document.getElementById("pw1").value;
    if(pass1!=pass2)
      document.getElementById("pw2").setCustomValidity("Passwords Tidak Sama, Coba Lagi");
    else
      document.getElementById("pw2").setCustomValidity('');
  }

  Highcharts.chart('barChart', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Hasil Rekomendasi Peminatan Siswa Tiap Tahun'
    },
    xAxis: {
        categories: {!! json_encode($tahun_ajaran) !!},
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
            '<td style="padding:0"><b>{point.y:.0f} Siswa</b></td></tr>',
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
        name: 'MIPA',
        data: {!! json_encode($rekomendasi_siswa_ipa) !!}

    }, {
        name: 'IPS',
        data: {!! json_encode($rekomendasi_siswa_ips) !!}

    }, {
        name: 'Bahasa dan Budaya',
        data: {!! json_encode($rekomendasi_siswa_bhs) !!}

    }]
  });

</script>
@endsection