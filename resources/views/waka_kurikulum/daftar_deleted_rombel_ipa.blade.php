@extends('layouts/template_waka_kurikulum')

@section('title')
Halaman Daftar Rombel
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
      Daftar Rombel
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/dashboard-waka-kurikulum') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Daftar Rombel IPA (Deleted)</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Daftar Rombel IPA (Deleted)</h3>
          </div><!-- /.box-header -->
          <div class="box-body table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Nama Rombel</th>
                  <th>Wali Kelas</th>
                  <th>Kuota Kelas</th>
                  <th>Tahun Ajaran</th>
                  <th>Tools</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1; ?>
                @foreach ($data_rombel as $data)
                <tr>
                  <td><?php echo ($i++) ?></td>
                  <td>{{ $data->nama_rombel }}</td>
                  <td>{{ $data->wali_kelas }}</td>
                  <td>{{ $data->jumlah_siswa }}/{{ $data->kuota_kelas }}</td>
                  <td>{{ $data->tahun_ajar }}/{{ $data->tahun_ajar+1 }}</td>
                  <td width="85">
                    <div class="btn-group">
                    <a href="{{ url('/daftar_deleted_rombel/restore/'.$data->id) }}" class="btn btn-default" data-toggle="tooltip" title="Restore Rombel"><i class="fa fa-undo"></i></a>
                    </div>
                  </td>
                </tr>
                @endforeach
                <?php 
                if (count($data_rombel) <= 0) {
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