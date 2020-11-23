@extends('layouts/template_tim_ppdb')

@section('title')
Halaman Daftar Angket Peminatan
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
      Daftar Angket Peminatan
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/dashboard-tim-ppdb') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{ url('/angket_peminatan/angkatan_siswa') }}">Angkatan Siswa</a></li>
      <li class="active">Daftar Angket Peminatan</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Daftar Angket Peminatan Siswa Baru Angkatan {{ $angkatan }}</h3>
            <div>
            @if($tombol_rekomendasi == 'on')
            <span class="label label-success">Semua siswa telah mengisi angket peminatan</span>
            @else
            <span class="label label-danger">Beberapa siswa belum mengisi angket peminatan</span>
            @endif

            @if($status_bobot == 1)
            <span class="label label-success">Bobot preferensi sudah ditentukan</span>
            @else
            <span class="label label-danger">Bobot preferensi belum ditentukan</span>
            @endif
            </div>

            <div class="btn-group pull-right">
            <a href="{{ url('/angket_peminatan/angkatan_siswa/angket/export_data/'.$angkatan) }}" class="btn btn-sm btn-primary"><i class="fa fa-file-excel-o"></i> Export Data</a>
            @if($tombol_rekomendasi == 'on' && $status_bobot == 1)
            <a href="{{ url('/angket_peminatan/angkatan_siswa/angket/hasilkan_rekomendasi/'.$angkatan) }}" class="btn btn-sm btn-primary"> Hasilkan Rekomendasi</a>
            @else
            <a href="#" class="btn btn-sm btn-default disabled"> Hasilkan Rekomendasi</a>
            @endif
            </div>

          </div><!-- /.box-header -->
          <div class="box-body table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>No. Induk</th>
                  <th>Nama</th>
                  @foreach($header_kriteria as $data)
                  <th>{{ $data->kriteria }}</th>
                  @endforeach
                  <th>Tools</th>
                </tr>
              </thead>

              
              <tbody>
                @for($i=0; $i < $baris; $i++)
                <tr>
                  @for($j=0; $j < $kolom; $j++)
                  @if ($j == 0)
                  <td>{{ $i+1 }}</td>
                  <?php $j++; ?>
                  @endif
                  <td>{{ $angket_peminatan[$i][$j] }}</td>
                  @endfor
                  <td width="100">
                    <div class="btn-group">
                      <a href="{{ url('/angket_peminatan/angkatan_siswa/angket/edit/'.$angket_peminatan[$i][0]) }}" class="btn btn-default" data-toggle="tooltip" title="Edit Angket Siswa"><i class="fa fa-pencil"></i></a>
                    </div>

                  </td>
                </tr>
                @endfor
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