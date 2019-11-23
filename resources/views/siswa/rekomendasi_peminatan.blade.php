@extends('layouts/template_siswa')

@section('title')
Halaman Rekomendasi Peminatan Siswa
@endsection

@section('content')
<div class="content-wrapper layout-boxed">
  <div class="container">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Rekomendasi Peminatan Siswa
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-6">
          <div class="box box-solid">
            <div class="box-header with-border">
              <i class="fa fa-info-circle"></i>

              <h3 class="box-title">Informasi Peminatan Siswa</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <dl class="dl-horizontal">
              @foreach($data_siswa as $data)
                <dt>Nomor Induk Siswa</dt>
                <dd>{{ $data->no_induk }}</dd>
                <dt>Nama</dt>
                <dd>{{ $data->name}}</dd>
                <dt>Rombongan Belajar</dt>
                <dd>X - {{ $data->nama_rombel }}</dd>
                <dt>Wali Kelas</dt>
                <dd>{{ $data->wali_kelas }}</dd>
                <dt>Peminatan</dt>
                <dd>{{ $data->peminatan }}</dd>
              @endforeach
              @if(count($data_siswa) == 0)
              <p>Peminatan belum ditentukan.</p>
              @endif
              </dl>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- ./col -->
    </div><!-- /.row -->
  </section><!-- /.content -->
  </div>
  <!-- /.container -->
</div>
@endsection