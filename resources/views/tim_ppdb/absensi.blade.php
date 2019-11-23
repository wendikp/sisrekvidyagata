@extends('layouts/template_tim_ppdb')

@section('title')
Halaman Daftar Siswa Rombel
@endsection

@section('style')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">

<style>
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
      Daftar Siswa Rombel
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/dashboard-tim-ppdb') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{ url('/daftar_rombel') }}">Tahun Ajaran</a></li>
      <li><a href="{{ url('/daftar_rombel/tahun_ajaran/'.$data_rombel->tahun_ajar) }}">Daftar Rombel</a></li>
      <li class="active">Siswa</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Daftar Siswa Rombel: <b>{{ $data_rombel->nama_rombel }}</b></h3>
            <h5>Wali Kelas: {{ $data_rombel->wali_kelas }} </h5>
            <div class="btn-group pull-right">
              <a href="{{ url('/daftar_rombel/absensi/export_data/'.$id_rombel) }}" class="btn btn-success btn-sm"><i class="fa fa-file-excel-o"></i> Export Data</a>
              <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modal-default">
                <i class="fa fa-plus"></i> Tambah Siswa
              </button>
            </div>
          </div><!-- /.box-header -->

          <!-- Form modal -->
          <div class="modal fade" id="modal-default">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Daftar Siswa</h4>
                  </div>
                  <div class="modal-body table-responsive">
                    <form action="{{ url('/tambah_siswa_rombel')}}" role="form" method="POST">
                      @csrf
                      <table id="example1" class="table table-striped">
                        <thead>
                          <tr>
                            <th>No.</th>
                            <th>No. Induk</th>
                            <th>Nama</th>
                            <th>Nilai Peminatan IPA</th>
                            <th>Nilai Peminatan IPS</th>
                            <th>Nilai Peminatan Bahasa</th>
                            <th>Rekomendasi Peminatan 1</th>
                            <th>Rekomendasi Peminatan 2</th>
                            <th>Rekomendasi Peminatan 3</th>
                            <th>Pilih</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $i=1; ?>
                          @foreach ($data_daftar_siswa as $data)
                          <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $data->no_induk }}</td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->nilai_ipa }}</td>
                            <td>{{ $data->nilai_ips }}</td>
                            <td>{{ $data->nilai_bahasa }}</td>
                            <td>{{ $data->rekomendasi_1 }}</td>
                            <td>{{ $data->rekomendasi_2 }}</td>
                            <td>{{ $data->rekomendasi_3 }}</td>
                            <td>
                              <input type="hidden" name="id_rombel" value="{{ $id_rombel }}">
                              <input type="checkbox" name="id[]" value="{{ $data->id }}">
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                      <button type="submit" value="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                  </form>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->

            <div class="box-body table-responsive">
              <table id="example2" class="table table-striped">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>No. Induk</th>
                    <th>Nama</th>
                    <th>Nilai Peminatan IPA</th>
                    <th>Nilai Peminatan IPS</th>
                    <th>Nilai Peminatan Bahasa</th>
                    <th>Rekomendasi Peminatan 1</th>
                    <th>Rekomendasi Peminatan 2</th>
                    <th>Rekomendasi Peminatan 3</th>
                    <th>Tools</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i=1; ?>
                  @foreach ($data_siswa_rombel as $data)
                  <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $data->no_induk }}</td>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->nilai_ipa }}</td>
                    <td>{{ $data->nilai_ips }}</td>
                    <td>{{ $data->nilai_bahasa }}</td>
                    <td>{{ $data->rekomendasi_1 }}</td>
                    <td>{{ $data->rekomendasi_2 }}</td>
                    <td>{{ $data->rekomendasi_3 }}</td>
                    <td width="150">
                      <div class="btn-group">
                        <a href="{{ url('/delete_siswa/'.$data->id) }}" class="btn btn-default"><i class="fa fa-minus"></i></a>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                  <?php
                  if (count($data_siswa_rombel) <= 0) {
                    ?>
                    <tr>
                      <td colspan="10" align="center">Belum Ada Data</td>
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