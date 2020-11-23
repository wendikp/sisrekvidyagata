@extends('layouts/template_admin')

@section('title')
Halaman Daftar Pengguna (Deleted)
@endsection

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Folder Siswa
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/dashboard-admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Folder Siswa (Deleted)</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Folder Siswa (Deleted)</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <?php
            foreach ($data_angkatan as $data) {
              ?>
              <div class="col-md-2">
              <a href="{{ url('/folder_siswa/daftar_siswa/deleted/'.$data->angkatan) }}" style="color: #f4bf42;"><span class="glyphicon glyphicon-folder-open" style="font-size: 80px;"></span><p style="color: black;">Angkatan {{ $data->angkatan }}/{{ $data->angkatan+1 }}</p></a>
              </div>
              <?php
            }
            if ($data_angkatan == '[]') {
              echo "Belum ada data";
            }
            ?>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </section><!-- /.content -->
</div>
@endsection