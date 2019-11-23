@extends('layouts/template_admin')

@section('title')
Halaman Edit Pengguna
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
      Edit Tim PPDB
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/dashboard-admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{ url('/daftar_tim_ppdb') }}">Daftar Tim PPDB</a></li>
      <li class="active">Edit</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Form. Edit Anggota Tim PPDB</h3>
          </div><!-- /.box-header -->
          <div class="box-body  table-responsive">
            <form action="{{ url('/update_tim_ppdb') }}" role="form" method="POST">
              @csrf
              @foreach($data_tim as $data)
              <input type="hidden" name="id" value="{{ $data->id }}">
              <table class="table table-responsive table-condensed">
                <tr>
                  <div class="form-group">
                    <td style="border: none; width: 110px;">NIP/NIK</td>
                    <td style="border: none; width: 20px;">:</td>
                    <td style="border: none;"><input type="text" class="form-control" name="no_induk" value="{{ $data->no_induk }}" style="width: 230px;" required="required"></td>
                  </div>
                </tr>
                <tr>
                  <div class="form-group">
                    <td style="border: none;">Nama Lengkap</td>
                    <td style="border: none;">:</td>
                    <td style="border: none;"><input type="text" class="form-control" name="nama" value="{{ $data->name }}" style="width: 230px;" required="required"></td>
                  </div>
                </tr>
                <tr>
                  <div class="form-group">
                    <td style="border: none;">Email</td>
                    <td style="border: none;">:</td>
                    <td style="border: none;"><input type="email" class="form-control" name="email" value="{{ $data->email }}" style="width: 230px;" required="required"></td>
                  </div>
                </tr>
                <tr>
                  <div class="form-group">
                    <td style="border: none;">No. HP</td>
                    <td style="border: none;">:</td>
                    <td style="border: none;">
                      <input type="text" class="form-control" name="no_hp" value="{{ $data->no_telepon }}" style="width: 230px;" required="required" data-inputmask='"mask": "9999-9999-9999"' data-mask>
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
                        <?php
                        $exploded_data = explode("-", $data->tgl_lahir);
                        ?>
                        <input type="text" class="form-control" id="datepicker" name="tgl_lahir" value='<?php echo "$exploded_data[2]-$exploded_data[1]-$exploded_data[0]" ?>' style="width: 192px;" required="required">
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
                        <?php
                        if ($data->jenis_kelamin == "L" || $data->jenis_kelamin == "Laki-laki") {
                          ?>
                          <option value="L">Laki-laki</option>
                          <option value="P">Perempuan</option>
                          <?php
                        } else {
                          ?>
                          <option value="P">Perempuan</option>
                          <option value="L">Laki-laki</option>
                          <?php
                        }
                        ?>
                      </select>
                    </td>
                  </div>
                </tr>
                <tr>
                  <td style="border: none;">Periode</td>
                  <td style="border: none;">:</td>
                  <td style="border: none;">
                    <input type="text" class="form-control" name="periode" value="{{ $data->periode }}" style="width: 230px;" required="required" data-inputmask='"mask": "9999 - 9999"' data-mask placeholder="Ex: 2010 - 2014">
                  </td>
                </tr>
                <tr>
                  <td style="border: none;">Alamat</td>
                  <td style="border: none;">:</td>
                  <td style="border: none;"><textarea class="form-control " name="alamat" rows="3" cols="80" required="required">{{ $data->alamat }}</textarea></td>
                </tr>
              </table>
              @endforeach
            <div class="box-footer">
              <button name="submit" value="submit" type="submit" class="btn btn-primary pull-right">Submit</button>
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
  $('#datepicker').datepicker({
    format: "dd-mm-yyyy",
    autoclose:true
  })
</script>
@endsection