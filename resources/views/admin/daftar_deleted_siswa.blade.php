@extends('layouts/template_admin')

@section('title')
Halaman Daftar Pengguna (Deleted)
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
      Daftar Siswa (Deleted)
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/dashboard-admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{ url('/folder_siswa/deleted') }}">Folder Siswa (Deleted)</a></li>
      <li class="active">Daftar Siswa Angkatan {{ $angkatan }}/{{ $angkatan+1 }} (Deleted)</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Daftar Siswa Angkatan {{ $angkatan }}/{{ $angkatan+1 }} (Deleted)</h3>
          </div><!-- /.box-header -->
          <div class="box-body table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>NISN/NIS</th>
                  <th>Nama</th>
                  <th>Asal Sekolah</th>
                  <th>Angkatan</th>
                  <th>Tanggal Lahir</th>
                  <th>Jenis Kelamin</th>
                  <th>Email</th>
                  <th>No. Telp</th>
                  <th>Alamat</th>
                  <th>Username</th>
                  <th>Password</th>
                  <th>Tools</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1; ?>
                @foreach ($data_siswa as $data)
                <tr>
                  <td><?php echo ($i++) ?></td>
                  <td>{{ $data->no_induk }}</td>
                  <td>{{ $data->name }}</td>
                  <td>{{ $data->asal_sekolah }}</td>
                  <td>{{ $data->angkatan }}</td>
                  <td>
                    <?php
                    $exploded_data = explode("-", $data->tgl_lahir); 
                    echo "$exploded_data[2]-$exploded_data[1]-$exploded_data[0]";
                    ?>
                  </td>
                  <td>{{ $data->jenis_kelamin }}</td>
                  <td>{{ $data->email }}</td>
                  <td>{{ $data->no_telepon }}</td>
                  <td>{{ $data->alamat }}</td>
                  <td>{{ $data->no_induk }}</td>
                  <td>{{ $data->temp_password}}</td>
                  <td width="85">
                    <div class="btn-group">
                    <a href="{{ url('/restore_siswa/'.$data->id) }}" class="btn btn-default" data-toggle="tooltip" title="Restore Siswa"><i class="fa fa-undo"></i></a>
                    </div>
                  </td>
                </tr>
                @endforeach
                <?php 
                if (count($data_siswa) <= 0) {
                  ?>
                  <tr>
                    <td colspan="13" align="center">Belum Ada Data</td>
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

  // Tooltip
  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
  });
</script>
@endsection