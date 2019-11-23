@extends('layouts/template_tim_ppdb')

@section('title')
Halaman Daftar Pengumuman
@endsection

@section('style')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">

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
@endsection

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Daftar Pengumuman
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/dashboard-tim-ppdb') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Daftar Pengumuman</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Daftar Pengumuman</h3>
            <a href="{{ url('/daftar_pengumuman/tambah') }}" class="btn btn-default btn-sm pull-right"><i class="fa fa-plus"></i> Buat Pengumuman</a>
          </div><!-- /.box-header -->
          <div class="box-body table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Penulis</th>
                  <th>Judul</th>
                  <th>Tanggal Pembuatan</th>
                  <th>Tools</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1; ?>
                @foreach ($data_pengumuman as $data)
                <tr>
                  <td><?php echo ($i++) ?></td>
                  <td>{{ $data->name }}</td>
                  <td>{{ $data->judul }}</td>
                  <td>{{ $data->day }}-{{ $data->month }}-{{ $data->year }}</td>
                  <td width="150">
                    <div class="btn-group">
                      <a href="{{ url('/edit_pengumuman/'.$data->id) }}" class="btn btn-default"><i class="fa fa-pencil"></i></a>
                      <a href="{{ url('/hapus_pengumuman/'.$data->id) }}" class="btn btn-default"><i class="fa fa-trash"></i></a>
                      <!-- <a href="{{ url('/lihat_pengumuman/'.$data->id) }}" class="btn btn-default"><i class="fa fa-list"></i></a> -->
                    </div>
                  </td>
                </tr>
                @endforeach
                <?php 
                if (count($data_pengumuman) <= 0) {
                  ?>
                  <tr>
                    <td colspan="5" align="center">Belum Ada Data</td>
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