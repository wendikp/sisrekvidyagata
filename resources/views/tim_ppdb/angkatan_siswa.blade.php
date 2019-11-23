@extends('layouts/template_tim_ppdb')

@section('title')
Halaman Angket Peminatan
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
      Angket Peminatan
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/dashboard-tim-ppdb') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Angket Siswa</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Angkatan Siswa</h3>
          </div><!-- /.box-header -->

          <div class="box-body table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Angkatan</th>
                  <th>Jumlah Siswa</th>
                  <th>Angket Peminatan</th>
                  <th>Tools</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $i=0;
                ?>
                @foreach($data_angkatan as $data)
                <tr>
                  <td><?php echo ($i+1) ?></td>
                  <td>{{ $data->angkatan }}</td>
                  <td>
                    {{ $total_siswa[$i] }}
                  </td>
                  <td>
                    @for($j=0; $j < count($data_record_kriteria); $j++)
                    @if($data->angkatan == $angkatan[$j]) {{ $kode_kriteria[$j] }}
                    @endif
                    @endfor
                  </td>
                  <td>
                    <div class="btn-group">
                      <a href="{{ url('/angket_peminatan/angkatan_siswa/angket/'.$data->angkatan) }}" class="btn btn-default" data-toggle="tooltip" title="Angket Peminatan"><i class="fa fa-list"></i></a>
                      <a href="{{ url('/angket_peminatan/angkatan_siswa/daftar_rekomendasi/'.$data->angkatan) }}" class="btn btn-default" data-toggle="tooltip" title="Rekomendasi Siswa"><i class="fa fa-list-ol"></i></a>
                      <a href="{{ url('/angket_peminatan/angkatan_siswa/pilih_kriteria_peminatan/'.$data->angkatan) }}" class="btn btn-primary">Pilih Angket Peminatan</a>
                      <!-- @if($data->total_siswa == $data->jml_pengisi_angket)
                      @if($data->rekomendasi != 0)
                      <a href="#" class="btn btn-success" data-toggle="tooltip" title="Rekomendasi Sudah Dihasilkan"><i class="fa fa-check"></i></a>
                      @else
                      <a href="{{ url('/angket_peminatan/angkatan_siswa/angket/hasilkan_rekomendasi/'.$data->angkatan) }}" class="btn btn-success pull-right"> Hasilkan Rekomendasi</a>
                      @endif
                      @else
                      <a href="#" class="btn btn-success disabled"> Hasilkan Rekomendasi</a>
                      @endif -->
                    </div>
                  </td>
                </tr>
                <?php $i++; ?>
                @endforeach
                <?php 
                if (count($data_angkatan) <= 0) {
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