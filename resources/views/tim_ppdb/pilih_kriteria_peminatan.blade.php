@extends('layouts/template_tim_ppdb')

@section('title')
Halaman Pemilihan Kriteria Peminatan
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
      Daftar Kriteria Peminatan
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/dashboard-tim-ppdb') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{ url('/angket_peminatan/angkatan_siswa') }}">Angkatan Siswa</a></li>
      <li class="active">Daftar Kriteria Peminatan</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Silahkan pilih kriteria peminatan untuk angkatan {{ $angkatan }}</h3>
          </div><!-- /.box-header -->
          <div class="box-body table-responsive">
          <form action="{{ url('/angket_peminatan/angkatan_siswa/pilih_kriteria_peminatan/simpan/'.$angkatan) }}" role="form" method="POST">
              @csrf
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Kode Kriteria</th>
                    <th>Jumlah Kriteria</th>
                    <th>Status Bobot Preferensi</th>
                    <th>Pilih</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $i=1;
                  ?>
                  @foreach($data_kriteria_peminatan as $data)
                  <tr>
                    <input type="hidden" name="angkatan" value="{{ $angkatan }}">
                    <td><?php echo ($i++) ?></td>
                    <td><a href="{{ url('/daftar_kriteria_peminatan/daftar_kriteria/'.$data->id) }}" data-toggle="tooltip" title="Klik untuk melihat daftar kriteria">{{ $data->kode_kriteria }}</a></td>
                    <td>{{ $data->jumlah }}</td>
                    <td>
                      @if($data->status_bobot == 1)
                      <span class="label label-success">Sudah ditentukan</span>
                      @else
                      <span class="label label-danger">Belum ditentukan</span>
                      @endif
                    </td>
                    <td>
                      <input type="radio" name="pilihan" value="{{ $data->id }}" required>
                    </td>
                  </tr>
                  @endforeach

                  <?php 
                  if (count($data_kriteria_peminatan) <= 0) {
                    ?>
                    <tr>
                      <td colspan="5" align="center">Belum Ada Data</td>
                    </tr>
                    <?php
                  }
                  ?>
                </tbody>
              </table>
              <button type="submit" value="submit" class="btn btn-primary pull-right">Submit</button>
            </form>
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