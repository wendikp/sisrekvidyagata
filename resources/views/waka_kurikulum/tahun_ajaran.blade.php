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
      Tahun Ajaran
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/dashboard-waka-kurikulum') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Tahun Ajaran</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Daftar Tahun Ajaran</h3>
            <button type="button" class="btn btn-default btn-sm pull-right" data-toggle="modal" data-target="#modal-default">
              <i class="fa fa-plus"></i> Tambah Rombel Baru
            </button>
          </div><!-- /.box-header -->

          <!-- Form modal -->
          <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Silahkan masukkan jumlah rombel yang ingin ditambahkan</h4>
                </div>
                <div class="modal-body">
                  <form action="{{ url('/tahun_ajaran/tambah_rombel') }}" role="form" method="POST">
                    @csrf
                    <table class="table table-responsive">
                      <tr>
                        <td style="border: none; width: 110px;">Jumlah rombel</td>
                        <td style="border: none; width: 10px">:</td>
                        <td style="border: none;">
                          <input type="number" class="form-control" name="jumlah" style="width: 220px;" required="required">
                        </td>
                      </tr>
                    </table>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                    <button type="submit" value="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- /.modal -->

          <div class="box-body table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Tahun Ajaran</th>
                  <th>Jumlah Rombel</th>
                  <th width="100">Tools</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1; ?>
                @foreach ($data_rombel as $data)
                <tr>
                  <td><?php echo ($i++) ?></td>
                  <td>{{ $data->tahun_ajar }}/{{ $data->tahun_ajar+1 }}</td>
                  <td>{{ $data->jumlah_rombel }}</td>
                  <td width="100">
                    <div class="btn-group">
                      <a href="{{ url('/tahun_ajaran/daftar_rombel/'.$data->tahun_ajar) }}" class="btn btn-default" data-toggle="tooltip" title="Daftar Rombel"><i class="fa fa-list"></i></a>
                    </div>
                  </td>
                </tr>
                @endforeach
                <?php 
                if (count($data_rombel) <= 0) {
                  ?>
                  <tr>
                    <td colspan="4" align="center">Belum Ada Data</td>
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