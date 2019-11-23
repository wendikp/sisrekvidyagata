@extends('layouts/template_tim_ppdb')

@section('title')
Halaman Daftar Rekomendasi Siswa
@endsection

@section('style')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Daftar Rekomendasi Siswa
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/dashboard-tim-ppdb') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{ url('/angket_peminatan/angkatan_siswa') }}">Angket Siswa</a></li>
      <li class="active">Daftar Rekomendasi Siswa</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Daftar Rekomendasi Peminatan Siswa Baru Angkatan {{ $angkatan }}</h3>
            <a href="{{ url('/angket_peminatan/angkatan_siswa/daftar_rekomendasi/export_ke_excel/'.$angkatan) }}" class="btn btn-sm btn-success pull-right" data-toggle="tooltip" title="Export Data Peminatan Siswa ke Excel"><i class="fa fa-file-excel-o"></i> Export Data</a>
          </div><!-- /.box-header -->
          <div class="box-body table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>No. Induk</th>
                  <th>Nama</th>
                  <th>Nilai Peminatan IPA</th>
                  <th>Nilai Peminatan IPS</th>
                  <th>Nilai Peminatan Bahasa</th>
                  <th>Rekomendasi Pertama</th>
                  <th>Rekomendasi Kedua</th>
                  <th>Rekomendasi Ketiga</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $i=1;
                ?>
                @foreach($data_rekomendasi as $data)
                <tr>
                  <td><?php echo ($i++) ?></td>
                  <td>{{ $data->no_induk }}</td>
                  <td>{{ $data->name }}</td>
                  <td>{{ $data->nilai_ipa }}</td>
                  <td>{{ $data->nilai_ips }}</td>
                  <td>{{ $data->nilai_bahasa }}</td>
                  <td>{{ $data->rekomendasi_1 }}</td>
                  <td>{{ $data->rekomendasi_2 }}</td>
                  <td>{{ $data->rekomendasi_3 }}</td>
                </tr>
                @endforeach
                <?php 
                if (count($data_rekomendasi) <= 0) {
                  ?>
                  <tr>
                    <td colspan="9" align="center">Belum Ada Data</td>
                  </tr>
                  <?php
                }
                ?>
              </tbody>
            </table>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </section><!-- /.content -->
</div>
@endsection

@section('script-js')
<!-- DataTables -->
<script src="{{ asset('AdminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('AdminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
@endsection

@section('page-script')
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
</script>
@endsection