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
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="{{ asset('AdminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">

  <style type="text/css">
    .example-modal .modal {
      position: relative;
      top: auto;
      bottom: auto;
      right: auto;
      left: auto;
      display: block;
      z-index: 1;
    }

    .example-modal .modal {
      background: transparent !important;
    }
  </style>

</head>

<body id="page-top">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
    <div class="container">
      <!-- <a class="navbar-brand js-scroll-trigger" href="{{ url('/homepage') }}">SisRek Vidyagata</a> -->
      <a class="navbar-brand js-scroll-trigger" href="#page-top">SisRek Vidyagata</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto my-2 my-lg-0">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#profile">Profil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#angket">Angket Peminatan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="{{ url('/pengumuman/detail/'.$id_pengumuman) }}">Pengumuman</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#kontak">Kontak</a>
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
  <header class="masthead">
    <div class="container h-100">
      <div class="row h-100 align-items-center justify-content-center text-center">
        <div class="col-lg-10 align-self-end">
          <h1 class="text-uppercase text-white font-weight-bold">Selamat Datang di Website Sisrek Vidyagata</h1>
          <hr class="divider my-4">
        </div>
        <div class="col-lg-8 align-self-baseline">
          <p class="text-white-75 font-weight-light mb-5">Sistem Rekomendasi Peminatan untuk Siswa Baru SMAN 6 Malang</p>
          <!-- <?php $tpa = 1; ?> -->
          <!-- @if($tpa == '1')
          <a class="btn btn-info btn-xl js-scroll-trigger" href="{{ url('/instruksi_pengerjaan_psikotest') }}" style="margin-right: 10px;">Psikotest</a>
          @else
          <a class="btn btn-info disabled btn-xl js-scroll-trigger" href="#" style="margin-right: 10px;">Tes Potensial Akademik</a>
          @endif -->
          <a class="btn btn-warning btn-xl js-scroll-trigger" href="#major">Informasi Jurusan Kuliah</a>
        </div>
      </div>
    </div>
  </header>

  <!-- Profile Section -->
  <section class="page-section bg-info" id="profile">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
          <h2 class="text-white mt-0">Data Siswa</h2>
          <hr class="divider light my-4">
          <br/>
          <div class="row">
            <div class="col-lg-4 text-center">
              <div class="team-member">
                <img src="{{ asset('AdminLTE/dist/img/user.jpg') }}" width="150px" class="img-responsive img-circle" alt="">
                <h4 style="color: white;">{{ Auth::user()->name }}</h4>
                <p class="text-white-50 mb-4">Angkatan - {{ Auth::user()->angkatan }}</p>
              </div>
            </div>
            <div class="col-lg-8 text-left mb-4">
              <table class="table table-sm">
                <tr>
                  <td class="text-white-50 mb-4" style="text-align: right;">Nomor Induk Siswa</td>
                  <td style="color: white;"> {{ Auth::user()->no_induk }}</td>
                </tr>
                <tr>
                  <td class="text-white-50 mb-4" style="text-align: right;">No.telepon</td>
                  <td style="color: white;"> {{ Auth::user()->no_telepon }}</td>
                </tr>
                <tr>
                  <td class="text-white-50 mb-4" style="text-align: right;">Email</td>
                  <td style="color: white;"> {{ Auth::user()->email }}</td>
                </tr>
                <tr>
                  <td class="text-white-50 mb-4" style="text-align: right;">Tanggal Lahir</td>
                  <td style="color: white;">
                    <?php
                    if (is_null(Auth::user()->tgl_lahir)) {
                      echo Auth::user()->tgl_lahir;
                    } else {
                      $birthday = explode("-", Auth::user()->tgl_lahir);
                      echo "$birthday[2]-$birthday[1]-$birthday[0]";
                    }
                    ?> 
                  </td>
                </tr>
                <tr>
                  <td class="text-white-50 mb-4" style="text-align: right;">Jenis Kelamin</td>
                  <td style="color: white;">
                    @if( Auth::user()->jenis_kelamin == 'L') Laki-Laki
                    @else Perempuan
                    @endif
                  </td>
                </tr>
                <tr>
                  <td class="text-white-50 mb-4" style="text-align: right;">Alamat</td>
                  <td style="color: white;"> {{ Auth::user()->alamat }}</td>
                </tr>
                <tr>
                  <td class="text-white-50 mb-4" style="text-align: right;">Asal Sekolah</td>
                  <td style="color: white;"> {{ Auth::user()->asal_sekolah }}</td>
                </tr>
                <tr>
                  <td class="text-white-50 mb-4" style="text-align: right;">Peminatan</td>
                  <td style="color: white;">{{ $peminatan }}</td>
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                </tr>
              </table>
            </div>
          </div>
          <button type="button" class="btn btn-light btn-md" data-toggle="modal" data-target="#modal-default" style="margin-right: 10px;">Edit Profile</button>
          <button type="button" class="btn btn-light btn-md" data-toggle="modal" data-target="#modal-password">Ganti Password</button>
        </div>
      </div>
    </div>
  </section>

  <!-- Form modal -->
  <div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit data siswa:</h4>
        </div>
        <div class="modal-body">
          <form action="{{ url('/profile/edit/'.Auth::user()->id) }}" role="form" method="POST">
            @csrf
            <table class="table table-sm table-striped">
              <tr>
                <td width="130">Asal Sekolah</td>
                <td class="text-white-50 mb-4"><input type="text" class="form-control" name="asal_sekolah" value="{{ Auth::user()->asal_sekolah }}" required="required"></td>
              </tr>
              <tr>
                <td width="130">No.telepon</td>
                <td class="text-white-50 mb-4"><input type="text" class="form-control" name="no_tlp" value="{{ Auth::user()->no_telepon }}" required="required" data-inputmask='"mask": "9999-9999-9999"' data-mask></td>
              </tr>
              <tr>
                <td width="130">Email</td>
                <td class="text-white-50 mb-4"><input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" required="required"></td>
              </tr>
              <tr>
                <td width="130">Tanggal Lahir</td>
                <td class="text-white-50 mb-4">
                  <div class="input-group date">
                    <?php
                    if (is_null(Auth::user()->tgl_lahir)) {
                      $birthday = Auth::user()->tgl_lahir;
                    } else {
                      $exploded_data = explode("-", Auth::user()->tgl_lahir);
                      $birthday = "$exploded_data[2]-$exploded_data[1]-$exploded_data[0]";
                    }
                    ?> 
                    <input type="text" class="form-control" id="datepicker" name="tgl_lahir" value="{{ $birthday }}" style="width: 192px;" required="required">
                  </div>
                </td>
              </tr>
              <tr>
                <td width="130">Jenis Kelamin</td>
                <td class="text-white-50 mb-4"><select name="jenis_kelamin" class="form-control" required="required">
                  <?php
                  if (Auth::user()->jenis_kelamin == "L") {
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
                </select></td>
              </tr>
              <tr>
                <td width="130">Alamat</td>
                <td class="text-white-50 mb-4"><textarea class="form-control " name="alamat" rows="3" cols="80" required="required">{{ Auth::user()->alamat }}</textarea></td>
              </tr>
            </table>
          </div>
          <div class="modal-footer">
            <button type="submit" value="submit" class="btn btn-info">Submit</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- Form modal -->
  <div class="modal fade" id="modal-password">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Ganti password</h4>
        </div>
        <div class="modal-body">
          <form action="{{ url('/homepage/gantiPassword') }}" role="form" method="POST">
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
            <button type="submit" value="submit" class="btn btn-info">Submit</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- Angket Section -->
  <section class="page-section bg-light" id="angket">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
          <h2 class="mt-0">Angket Peminatan</h2>
          <hr class="divider my-4">
          <div class="col-lg-12 text-left mb-4">
            <form action="{{ url('/angket_peminatan/simpan/'.Auth::user()->id) }}" role="form" method="POST">
              @csrf
              <table class="table table-sm table-striped">
                @foreach($kriteria as $data)
                <tr>
                  <td>{{ $data->kriteria }}</td>
                  <td>{{ $data->nilai }}</td>
                </tr>
                @endforeach
              </table>
            </div>
            <?php 
            if (count($kriteria) <= 0) {
              ?>
              <p class="text-center text-muted mb-5">
                Anda belum melakukan pengisian angket peminatan. Harap segera lakukan pengisian angket peminatan sebelum batas waktu yang telah ditentukan!!
              </p>
              <button type="button" class="btn btn-info btn-xl" data-toggle="modal" data-target="#modal-angket">Isi Angket Peminatan</button>
              <?php
            } else {
              ?>
              <button type="button" class="btn btn-info btn-xl" data-toggle="modal" data-target="#modal-angket-edit">Edit Angket Peminatan</button>
              <?php
            }
            ?>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- Form modal -->
  <div class="modal fade" id="modal-angket">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Silahkan isi angket peminatan dibawah ini:</h4>
        </div>
        <div class="modal-body">
          <form action="{{ url('/angket_peminatan/simpan/'.Auth::user()->id) }}" role="form" method="POST">
            @csrf
            <p class="text-left text-muted" style="font-size: 12px;">
              Note:<br/>
              <ul type="square" class="text-muted" style="font-size: 12px;">
                <li>untuk nilai mapel, harap isikan nilai rerata mapel tersebut dari semester 1 - 5/6</li>
              </ul>
            </p>
            <table class="table table-sm table-striped">
              @foreach($data_kriteria as $data)
              @if($data->kategori == 1)
              <tr>
                <input type="hidden" name="id_kriteria[]" value="{{ $data->id }}">
                <td>{{ $data->kriteria }}</td>
                <td>
                  <input type="text" class="form-control" name="nilai[]" required="required">
                </td>
              </tr>
              @elseif($data->kategori == 2)
              <input type="hidden" name="id_kriteria[]" value="{{ $data->id }}">
              <input type="hidden" class="form-control" name="nilai[]" value="Belum melakukan tes">  
              @elseif($data->kategori == 3)
              <tr>
                <input type="hidden" name="id_kriteria[]" value="{{ $data->id }}">
                <td>{{ $data->kriteria }}</td>
                <td>
                  <select class="form-control" name="nilai[]" required="required">
                    <option value="Sangat minat">Sangat minat</option>
                    <option value="Minat">Minat</option>
                    <option value="Cukup">Cukup</option>
                    <option value="Kurang minat">Kurang minat</option>
                    <option value="Tidak minat">Tidak minat</option>
                  </select>
                </td>
              </tr>
              @endif
              @endforeach
            </table>
          </div>
          <div class="modal-footer">
            <button type="submit" value="submit" class="btn btn-info">Submit</button>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- Form modal -->
  <div class="modal fade" id="modal-angket-edit">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Silahkan edit angket peminatan anda disini:</h4>
        </div>
        <div class="modal-body">
          <form action="{{ url('/angket_peminatan/edit/'.Auth::user()->id) }}" role="form" method="POST">
            @csrf
            <p class="text-left text-muted" style="font-size: 12px;">
              Note:<br/>
              <ul type="square" class="text-muted" style="font-size: 12px;">
                <li>untuk nilai mapel, harap isikan nilai rerata mapel tersebut dari semester 1 - 5/6</li>
              </ul>
            </p>
            <table class="table table-sm table-striped">
              @foreach($kriteria as $data)
              @if($data->kategori == 1)
              <tr>
                <input type="hidden" name="id_kriteria[]" value="{{ $data->id }}">
                <td>{{ $data->kriteria }}</td>
                <td>
                  <input type="text" class="form-control" name="nilai[]" value="{{ $data->nilai }}" required="required">
                </td>
              </tr>
              @elseif($data->kategori == 3)
              <tr>
                <input type="hidden" name="id_kriteria[]" value="{{ $data->id }}">
                <td>{{ $data->kriteria }}</td>
                <td>
                  <select class="form-control" name="nilai[]" required="required">
                    @if($data->nilai == "Sangat minat")
                    <option value="Sangat minat">Sangat minat</option>
                    <option value="Minat">Minat</option>
                    <option value="Cukup">Cukup</option>
                    <option value="Kurang minat">Kurang minat</option>
                    <option value="Tidak minat">Tidak minat</option>
                    @elseif($data->nilai == "Minat")
                    <option value="Minat">Minat</option>
                    <option value="Sangat minat">Sangat minat</option>
                    <option value="Cukup">Cukup</option>
                    <option value="Kurang minat">Kurang minat</option>
                    <option value="Tidak minat">Tidak minat</option>
                    @elseif($data->nilai == "Cukup")
                    <option value="Cukup">Cukup</option>
                    <option value="Sangat minat">Sangat minat</option>
                    <option value="Minat">Minat</option>
                    <option value="Kurang minat">Kurang minat</option>
                    <option value="Tidak minat">Tidak minat</option>
                    @elseif($data->nilai == "Kurang minat")
                    <option value="Kurang minat">Kurang minat</option>
                    <option value="Sangat minat">Sangat minat</option>
                    <option value="Minat">Minat</option>
                    <option value="Cukup">Cukup</option>
                    <option value="Tidak minat">Tidak minat</option>
                    @elseif($data->nilai == "Tidak minat")
                    <option value="Tidak minat">Tidak minat</option>
                    <option value="Sangat minat">Sangat minat</option>
                    <option value="Minat">Minat</option>
                    <option value="Cukup">Cukup</option>
                    <option value="Kurang minat">Kurang minat</option>
                    @endif
                  </select>
                </td>
              </tr>
              @endif
              @endforeach
            </table>
          </div>
          <div class="modal-footer">
            <button type="submit" value="submit" class="btn btn-info">Submit</button>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- Major Section -->
  <section class="page-section bg-warning" id="major">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
          <h2 class="mt-0">Informasi Jurusan Kuliah</h2>
          <hr class="divider light my-4">
          <p class="text-muted mb-4">Berikut adalah daftar jurusan kuliah yang tersedia di Perguruan Tinggi, baik Negeri Maupun Swasta, sesuai dengan masing-masing peminatan:</p>
          <div class="row">
            <div class="col-lg-4">
              <table class="table table-sm table-striped">
                <thead>
                  <th class="mt-0">Peminatan IPA</th>
                </thead>
                <tbody>
                  <tr><td>Kesehatan dan Keselamatan Kerja (K3)</td></tr>
                  <tr><td>Ilmu Gizi</td></tr>
                  <tr><td>Farmasi</td></tr>
                  <tr><td>Pendidikan Dokter</td></tr>
                  <tr><td>Teknologi Pangan</td></tr>
                  <tr><td>Astronomi</td></tr>
                  <tr><td>Statistika</td></tr>
                  <tr><td>Bioteknologi</td></tr>
                  <tr><td>Biokimia</td></tr>
                  <tr><td>Teknik Lingkungan</td></tr>
                  <tr><td>Budidaya Perairan</td></tr>
                  <tr><td>Rekayasa Pertanian</td></tr>
                  <tr><td>Agroekoteknologi</td></tr>
                  <tr><td>Kehutanan</td></tr>
                  <tr><td>Arsitektur</td></tr>
                  <tr><td>Oseanografi</td></tr>
                  <tr><td>Teknik Industri</td></tr>
                  <tr><td>Teknik Pertambangan</td></tr>
                  <tr><td>Teknik Perencanaan Wilayah dan Kota (Planologi)</td></tr>
                  <tr><td>Teknik Elektro</td></tr>
                  <tr><td>Teknik Penerbangan</td></tr>
                  <tr><td>Teknik Informatika</td></tr>
                  <tr><td>Cyber Security</td></tr>
                  <tr><td>Sistem Informasi</td></tr>
                  <tr><td>Ekonomi Pembangunan</td></tr>
                  <tr><td>Pendidikan Intelijen</td></tr>
                </tbody>
              </table>
              <br>
              <br>
            </div>
            <div class="col-lg-4">
              <table class="table table-sm table-striped">
                <thead>
                  <th>Peminatan IPS</th>
                </thead>
                <tbody>
                  <tr><td>Ilmu Komunikasi</td></tr>
                  <tr><td>Hubungan Internasional</td></tr>
                  <tr><td>Psikologi</td></tr>
                  <tr><td>Administrasi Bisnis</td></tr>
                  <tr><td>Administrasi Fiskal</td></tr>
                  <tr><td>Ekonomi Pembangunan</td></tr>
                  <tr><td>Akuntansi</td></tr>
                  <tr><td>Perpajakan</td></tr>
                  <tr><td>Manajemen Perhotelan</td></tr>
                  <tr><td>Manajemen Perbankan</td></tr>
                  <tr><td>Manajemen Pariwisata</td></tr>
                  <tr><td>Fashion Bisnis</td></tr>
                  <tr><td>Kesejahteraan Sosial</td></tr>
                  <tr><td>Desain Komunikasi Visual</td></tr>
                  <tr><td>Tata Rias dan Kecantikan</td></tr>
                  <tr><td>Tata Busana</td></tr>
                  <tr><td>Penyiaran (Broadcasting)</td></tr>
                  <tr><td>Pendidikan Pramugari/Pramugara</td></tr>
                  <tr><td>Hukum</td></tr>
                  <tr><td>Kriminologi</td></tr>
                  <tr><td>Sosiologi</td></tr>
                  <tr><td>Ilmu Polotik</td></tr>
                  <tr><td>Manajemen Pemasaran</td></tr>
                  <tr><td>Manajemen Pendidikan</td></tr>
                </tbody>
              </table>
              <br>
              <br>
            </div>
            <div class="col-lg-4">
              <table class="table table-sm table-striped">
                <thead>
                  <th>Peminatan Bahasa</th>
                </thead>
                <tbody>
                  <tr><td>Bahasa Asing</td></tr>
                  <tr><td>Sastra</td></tr>
                  <tr><td>Jurnalisme</td></tr>
                  <tr><td>Psikologi</td></tr>
                  <tr><td>Sosiologi</td></tr>
                  <tr><td>Antropologi</td></tr>
                  <tr><td>Perhotelan dan Pariwisata</td></tr>
                  <tr><td>Komunikasi</td></tr>
                  <tr><td>Hubungan Internasional</td></tr>
                  <tr><td>Hubungan Masyarakat</td></tr>
                  <tr><td>Seni</td></tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Contact Section -->
  <section class="page-section bg-light" id="kontak">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
          <h2 class="mt-0">Let's Get In Touch!</h2>
          <hr class="divider my-4">
          <p class="text-muted mb-5">Silahkan hubungi kontak dibawah ini jika ada yang ingin ditanyakan tentang pengisian angket peminatan dan lain sebagainya.</p>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4 ml-auto text-center">
          <i class="fas fa-phone fa-3x mb-3 text-muted"></i>
          <div>+62 Nomor Tlpn Sekolah</div>
        </div>
        <div class="col-lg-4 mr-auto text-center">
          <i class="fas fa-envelope fa-3x mb-3 text-muted"></i>
          <!-- Make sure to change the email address in anchor text AND the link below! -->
          <a class="d-block" href="mailto:contact@yourwebsite.com">emailsekolah@email.com</a>
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

  <!-- bootstrap datepicker -->
  <script src="{{ asset('AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
  <!-- InputMask -->
  <script src="{{ asset('AdminLTE/plugins/input-mask/jquery.inputmask.js') }}"></script>
  <script src="{{ asset('AdminLTE/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
  <script src="{{ asset('AdminLTE/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>

  <script type="text/javascript">
  //Input mask
  $('[data-mask]').inputmask()

  //Date picker
  $('#datepicker').datepicker({
    format: "dd-mm-yyyy",
    autoclose:true
  })
</script>

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

  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
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
</script>

</body>

</html>