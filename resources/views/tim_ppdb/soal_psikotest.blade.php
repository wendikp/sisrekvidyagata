@extends('layouts/template_tim_ppdb')

@section('title')
Halaman Soal Psikotest
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
      Psikotest
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/dashboard-tim-ppdb') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{ url('/daftar_psikotest') }}">Daftar Psikotest</a></li>
      <li class="active">Soal</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">
              Soal Psikotest : {{ $kode_soal }}
            </h3>
            <button type="button" class="btn btn-default btn-sm pull-right" data-toggle="modal" data-target="#modal-default">
              <i class="fa fa-plus"></i> Buat Soal Baru
            </button>
          </div><!-- /.box-header -->

          <!-- Form modal -->
          <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Silahkan masukkan jumlah soal</h4>
                </div>
                <div class="modal-body">
                  <form action="{{ url('/daftar_psikotest/soal/tambah/'.$kode_soal) }}" role="form" method="POST">
                    @csrf
                    <table class="table table-responsive">
                      <tr>
                        <td style="border: none; width: 110px;">Jumlah Soal</td>
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
            <table id="example2" class="table table-bordered">
              <tbody>
                <?php 
                $i=0;
                foreach ($data_soal as $data){
                  ?>
                  <tr>
                    <td rowspan="4">{{ ++$i }}</td>
                    <td colspan="2">{{ $data->soal }}</td>
                    <?php
                    if ($data->gambar != NULL) {
                      ?>
                      <td colspan="2">{{ $data->gambar }}</td>
                      <?php
                    }
                    ?>
                    <td rowspan="4" width="100">
                      <div class="btn-group">
                        <a href="{{ url('/edit_soal_psikotest/'.$data->id) }}" class="btn btn-default"><i class="fa fa-edit"></i></a>
                        <a href="{{ url('/hapus_soal_psikotest/'.$data->id) }}" class="btn btn-default"><i class="fa fa-trash"></i></a>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <?php
                    if ($data->jawaban == 'a') {
                      ?>
                      <td style="color: blue"><b>A.{{ $data->a }}</b></td>
                      <?php
                    } else {
                      ?>
                      <td>A.{{ $data->a }}</td>
                      <?php
                    }

                    if ($data->jawaban == 'd') {
                      ?>
                      <td style="color: blue"><b>D.{{ $data->d }}</b></td>
                      <?php
                    } else {
                      ?>
                      <td>D.{{ $data->d }}</td>
                      <?php
                    }
                    ?>
                  </tr>
                  <tr>
                    <?php
                    if ($data->jawaban == 'b') {
                      ?>
                      <td style="color: blue"><b>B.{{ $data->b }}</b></td>
                      <?php
                    } else {
                      ?>
                      <td>B.{{ $data->b }}</td>
                      <?php
                    }
                    
                    if ($data->jawaban == 'e') {
                      ?>
                      <td rowspan="2" style="color: blue"><b>E.{{ $data->e }}</b></td>
                      <?php
                    } else {
                      ?>
                      <td rowspan="2">E.{{ $data->e }}</td>
                      <?php
                    }
                    ?>
                  </tr>
                  <tr>
                    <?php
                    if ($data->jawaban == 'c') {
                      ?>
                      <td style="color: blue"><b>C.{{ $data->c }}</b></td>
                      <?php
                    } else {
                      ?>
                      <td>C.{{ $data->c }}</td>
                      <?php
                    }
                    ?>
                  </tr>
                  <?php 
                }
                if (count($data_soal) <= 0) {
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