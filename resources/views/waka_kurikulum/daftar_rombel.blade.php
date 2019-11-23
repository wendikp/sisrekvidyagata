@extends('layouts/template_waka_kurikulum')

@section('title')
Halaman Daftar Rombel
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
      Daftar Rombel
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/dashboard-waka-kurikulum') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{ url('/tahun_ajaran') }}">Tahun Ajaran</a></li>
      <li class="active">Daftar Rombel</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Daftar Rombel Tahun Ajaran {{$tahun_ajaran}}/{{$tahun_ajaran+1}}</h3>
          </div><!-- /.box-header -->

          <div class="box-body table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Peminatan</th>
                  <th>Nama Rombel</th>
                  <th>Wali Kelas</th>
                  <th>Kuota Kelas</th>
                  <th width="100">Tools</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1; ?>
                @foreach ($data_rombel as $data)
                <tr>
                  <td><?php echo ($i++) ?></td>
                  <td>{{ $data->peminatan }}</td>
                  <td>{{ $data->nama_rombel }}</td>
                  <td>{{ $data->wali_kelas }}</td>
                  <td>{{ $data->jumlah_siswa }}/{{ $data->kuota_kelas }}</td>
                  <td width="100">
                    <div class="btn-group">
                      <a href="{{ url('/tahun_ajaran/daftar_rombel/edit/'.$data->id) }}" class="btn btn-default" data-toggle="tooltip" title="Edit Rombel"><i class="fa fa-edit"></i></a>
                      <a href="{{ url('/tahun_ajaran/daftar_rombel/hapus/'.$data->id) }}" class="btn btn-default" data-toggle="tooltip" title="Hapus Rombel"><i class="fa fa-trash"></i></a>
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