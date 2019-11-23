@extends('layouts/template_admin')

@section('title')
Halaman Tambah Pengguna
@endsection

@section('style')
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="{{ asset('AdminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endsection

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Tambah Siswa
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/dashboard-admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{ url('/folder_siswa') }}">Folder Siswa</a></li>
      <li class="active">Tambah</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Form. Tambah Siswa Baru</h3>
          </div><!-- /.box-header -->
          <div class="box-body table-responsive">
            <form action="{{ url('/insert_siswa/'.$angkatan) }}" role="form" method="POST">
              @csrf
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>NISN/NIS</th>
                    <th>Nama Lengkap</th>
                    <th>Asal Sekolah</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Email</th>
                    <th>No. Telp</th>
                    <th>Alamat</th>
                  </tr>
                </thead>
                <tbody>
                  <input type="hidden" name="jumlah" value="{{ $jumlah }}">
                  <?php
                  for ($i=0; $i<$jumlah; $i++) { 
                    ?>
                    <tr>
                      <td><?php echo ($i+1) ?></td>
                      <td>
                        <div class="form-group">
                          <input type="text" class="form-control" name="no_induk[]" placeholder="NISN/NIS" style="width: 130px;" required="required">
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                          <input type="text" class="form-control" name="nama[]" placeholder="Nama Lengkap" style="width: 130px;" required="required">
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                          <input type="text" class="form-control" name="asal_sekolah[]" placeholder="Asal Sekolah" style="width: 130px;">
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                          <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control datepicker" name="tgl_lahir[]" style="width: 90px;">
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                          <select name="jenis_kelamin[]" class="form-control" style="width: 117px;">
                          <option value="L">Laki-laki</option>
                           <option value="P">Perempuan</option>
                         </select>
                       </div>
                     </td>
                     <td>
                       <div class="form-group">
                        <input type="email" class="form-control" name="email[]" placeholder="Email" style="width: 220px;" required="required">
                      </div>
                    </td>
                    <td>
                     <div class="form-group">
                      <input type="text" class="form-control" name="no_hp[]" style="width: 120px;" required="required" data-inputmask='"mask": "9999-9999-9999"' data-mask>
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                      <textarea class="form-control " name="alamat[]" rows="2" cols="80" style="width: 180px"></textarea>
                    </div>
                  </td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
            <div class="box-footer">
              <button name="submit" value="submit" type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->
</section><!-- /.content -->
</div>
@endsection

@section('script-js')
<!-- bootstrap datepicker -->
<script src="{{ asset('AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<!-- InputMask -->
<script src="{{ asset('AdminLTE/plugins/input-mask/jquery.inputmask.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
@endsection

@section('page-script')
<script type="text/javascript">
  //Input mask
  $('[data-mask]').inputmask()

  //Date picker
  $('.datepicker').datepicker({
    format: "dd-mm-yyyy",
    autoclose:true
  })
</script>
@endsection