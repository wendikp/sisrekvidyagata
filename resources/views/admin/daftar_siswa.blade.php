@extends('layouts/template_admin')

@section('title')
Halaman Daftar Pengguna
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
      Daftar Siswa
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/dashboard-admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{ url('/folder_siswa') }}">Folder Siswa</a></li>
      <li class="active">Daftar Siswa Angkatan {{ $angkatan }}/{{ $angkatan+1 }}</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Daftar Siswa Angkatan {{ $angkatan }}/{{ $angkatan+1 }}</h3>
            <button type="button" class="btn btn-default btn-sm pull-right" data-toggle="modal" data-target="#modal-default">
              <i class="fa fa-plus"></i> Tambah Siswa
            </button>
          </div><!-- /.box-header -->

          <!-- Form modal -->
          <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Silahkan masukkan jumlah siswa</h4>
                  </div>
                  <div class="modal-body">
                    <form action="{{ url('/folder_siswa/daftar_siswa/tambah/'.$angkatan) }}" role="form" method="POST">
                      @csrf
                      <table class="table table-responsive">
                        <tr>
                          <td style="border: none; width: 90px;">Jumlah data</td>
                          <td style="border: none; width: 10px">:</td>
                          <td style="border: none;">
                            <input type="number" class="form-control" name="jumlah" placeholder="Masukkan jumlah siswa baru" style="width: 220px;" required="required">
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
                      if (is_null($data->tgl_lahir)) {
                        echo "$data->tgl_lahir";
                      } else {
                        $exploded_data = explode("-", $data->tgl_lahir); 
                        echo "$exploded_data[2]-$exploded_data[1]-$exploded_data[0]";
                      }
                      ?>
                    </td>
                    <td>{{ $data->jenis_kelamin }}</td>
                    <td>{{ $data->email }}</td>
                    <td>{{ $data->no_telepon }}</td>
                    <td>{{ $data->alamat }}</td>
                    <td>{{ $data->no_induk }}</td>
                    <td>{{ $data->temp_password}}</td>
                    <td width="100">
                      <div class="btn-group">
                        <a href="{{ url('/folder_siswa/daftar_siswa/edit/'.$data->id) }}" class="btn btn-default" data-toggle="tooltip" title="Edit Siswa"><i class="fa fa-pencil"></i></a>
                        <a href="{{ url('/hapus/'.$data->id) }}" class="btn btn-default"><i class="fa fa-trash" data-toggle="tooltip" title="Hapus"></i></a>
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
  <!-- InputMask -->
  <script src="{{ asset('AdminLTE/plugins/input-mask/jquery.inputmask.js') }}"></script>
  <script src="{{ asset('AdminLTE/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
  <script src="{{ asset('AdminLTE/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
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

  //Input mask
  $('[data-mask]').inputmask();

  // Tooltip
  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
  });
</script>
@endsection