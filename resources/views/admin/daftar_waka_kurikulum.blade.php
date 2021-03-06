@extends('layouts/template_admin')

@section('title')
Halaman Daftar Pengguna
@endsection

@section('style')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="{{ asset('AdminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endsection

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Daftar Waka Kurikulum
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/dashboard-admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Daftar Waka Kurikulum</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Waka Kurikulum</h3>
            <button type="button" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#modal-tambah"><i class="fa fa-plus"></i> Tambah Waka Kurikulum</button>
            <!-- <a href="{{ url('/daftar_waka_kurikulum/tambah')}}" class="btn btn-default btn-sm pull-right">
              <i class="fa fa-plus"></i> Tambah Waka Kurikulum
            </a> -->
          </div><!-- /.box-header -->
          <div class="box-body table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>NIP/NIK</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>No. Telepon</th>
                  <th>Tanggal Lahir</th>
                  <th>Jenis Kelamin</th>
                  <th>Alamat</th>
                  <th>Periode</th>
                  <th>Username</th>
                  <th>Password</th>
                  <th>Tools</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1; ?>
                @foreach ($data_waka as $data)
                <tr>
                  <td><?php echo ($i++) ?></td>
                  <td>{{ $data->no_induk }}</td>
                  <td>{{ $data->name }}</td>
                  <td>{{ $data->email }}</td>
                  <td>{{ $data->no_telepon }}</td>
                  <td>
                    <?php
                    $exploded_data = explode("-", $data->tgl_lahir); 
                    echo "$exploded_data[2]-$exploded_data[1]-$exploded_data[0]";
                    ?>
                  </td>
                  <td>{{ $data->jenis_kelamin }}</td>
                  <td>{{ $data->alamat }}</td>
                  <td>{{ $data->periode }}</td>
                  <td>{{ $data->no_induk }}</td>
                  <td>{{ $data->temp_password}}</td>
                  <td width="100">
                    <div class="btn-group">
                      <a href="{{ url('/daftar_waka_kurikulum/edit/'.$data->id) }}" class="btn btn-default" data-toggle="tooltip" title="Edit Staf"><i class="fa fa-pencil"></i></a>
                      <a href="{{ url('/daftar_waka_kurikulum/hapus/'.$data->id) }}" class="btn btn-default" data-toggle="tooltip" title="Hapus"><i class="fa fa-trash"></i></a>
                    </div>
                  </td>
                </tr>
                @endforeach
                <?php 
                if (count($data_waka) <= 0) {
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

    <!-- Form modal -->
    <div class="modal modal-primary fade" id="modal-tambah">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Tambah Waka Kurikulum</h4>
          </div>
          <form action="{{ url('/insert_admin') }}" role="form" method="POST">
            <div class="modal-body">
              @csrf
              <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
              <table class="table table-responsive table-condensed">
                <tr>
                  <div class="form-group">
                    <td style="border: none; width: 110px;">NIP/NIK</td>
                    <td style="border: none; width: 20px;">:</td>
                    <td style="border: none;"><input type="text" class="form-control" name="no_induk" style="width: 230px;" required="required"></td>
                  </div>
                </tr>
                <tr>
                  <div class="form-group">
                    <td style="border: none;">Nama Lengkap</td>
                    <td style="border: none;">:</td>
                    <td style="border: none;"><input type="text" class="form-control" name="nama" style="width: 230px;" required="required"></td>
                  </div>
                </tr>
                <tr>
                  <div class="form-group">
                    <td style="border: none;">Periode</td>
                    <td style="border: none;">:</td>
                    <td style="border: none;">
                      <input type="text" class="form-control" name="periode" style="width: 230px;" required="required" data-inputmask='"mask": "9999 - 9999"' data-mask placeholder="Ex: 2010 - 2014">
                    </td>
                  </div>
                </tr>
                <tr>
                  <div class="form-group">
                    <td style="border: none;">Email</td>
                    <td style="border: none;">:</td>
                    <td style="border: none;"><input type="email" class="form-control" name="email" style="width: 230px;" required="required"></td>
                  </div>
                </tr>
                <tr>
                  <div class="form-group">
                    <td style="border: none;">No. HP</td>
                    <td style="border: none;">:</td>
                    <td style="border: none;">
                      <input type="text" class="form-control" name="no_hp" style="width: 230px;" required="required" data-inputmask='"mask": "9999-9999-9999"' data-mask>
                    </td>
                  </div>
                </tr>
                <tr>
                  <div class="form-group">
                    <td style="border: none;">Tanggal Lahir</td>
                    <td style="border: none;">:</td>
                    <td style="border: none;">
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control" id="datepicker" name="tgl_lahir" style="width: 192px;" required="required">
                      </div>
                    </td>
                  </div>
                </tr>
                <tr>
                  <div class="form-group">
                    <td style="border: none;">Jenis Kelamin</td>
                    <td style="border: none;">:</td>
                    <td style="border: none;">
                      <select name="jenis_kelamin" class="form-control" style="width: 130px;" required="required">
                       <option value="L">Laki-laki</option>
                       <option value="P">Perempuan</option>
                     </select>
                   </td>
                 </div>
               </tr>
               <tr>
                <td style="border: none;">Alamat</td>
                <td style="border: none;">:</td>
                <td style="border: none;"><textarea class="form-control " name="alamat" rows="3" cols="80" required="required"></textarea></td>
              </tr>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
            <button type="submit" value="submit" class="btn btn-outline">Submit</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
  </section><!-- /.content -->
</div>
@endsection

@section('script-js')
<!-- DataTables -->
<script src="{{ asset('AdminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('AdminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<!-- bootstrap datepicker -->
<script src="{{ asset('AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
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

  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
  })
  //Input mask
  $('[data-mask]').inputmask()

  //Date picker
  $('#datepicker').datepicker({
    format: "dd-mm-yyyy",
    autoclose:true
  })
</script>
@endsection