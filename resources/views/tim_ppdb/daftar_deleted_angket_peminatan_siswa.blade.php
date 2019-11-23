@extends('layouts/template_tim_ppdb')

@section('title')
Halaman Kriteria Peminatan
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
      Kriteria Peminatan
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/dashboard-tim-ppdb') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Daftar Kriteria Peminatan (Deleted)</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Daftar Kriteria Peminatan (Deleted)</h3>
          </div><!-- /.box-header -->

          <div class="box-body table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Kode Kriteria</th>
                  <th>Jumlah Kriteria</th>
                  <th>Tanggal Pembuatan</th>
                  <th>Status Bobot Preferensi</th>
                  <th width="100">Tools</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1; ?>
                @foreach ($data_kriteria_peminatan as $data)
                <tr>
                  <td><?php echo ($i++) ?></td>
                  <td>{{ $data->kode_kriteria }}</td>
                  <td>{{ $data->jumlah }}</td>
                  <td>{{ $data->day }}-{{ $data->month }}-{{ $data->year }}</td>
                  <td>
                    <?php
                    if ($data->status_bobot == 1) {
                      ?>
                      <span class="label label-success">Sudah Ditentukan</span>
                      <?php
                    } else {
                      ?>
                      <span class="label label-danger">Belum Ditentukan</span>
                      <?php
                    }
                    ?>
                  </td>
                  <td width="100">
                    <div class="btn-group">
                      <a href="{{ url('/daftar_kriteria_peminatan_deleted/restore/'.$data->id) }}" class="btn btn-default" data-toggle="tooltip" title="Restore Daftar Kriteria"><i class="fa fa-undo"></i></a>
                    </div>
                  </td>
                </tr>
                @endforeach
                <?php 
                if (count($data_kriteria_peminatan) <= 0) {
                  ?>
                  <tr>
                    <td colspan="6" align="center">Belum Ada Data</td>
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