@extends('layouts/template_admin')

@section('title')
Halaman Daftar Pengguna
@endsection

@section('style')
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
      Tahun Ajaran
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/dashboard-admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Tahun Ajaran</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Tahun Ajaran</h3>
            <button type="button" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#modal-default">
              <i class="fa fa-plus"></i> Tambah Siswa Angkatan Baru
            </button>
          </div><!-- /.box-header -->

          <!-- Form modal -->
          <div class="modal modal-primary fade" id="modal-default">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Silahkan masukkan jumlah siswa dan angkatan</h4>
                  </div>
                  <div class="modal-body">
                  <form action="{{ url('/folder_siswa/tambah') }}" role="form" method="POST">
                      @csrf
                      <table class="table table-responsive">
                        <tr>
                          <td style="border: none; width: 90px;">Jumlah data</td>
                          <td style="border: none; width: 10px">:</td>
                          <td style="border: none;">
                            <input type="number" class="form-control" name="jumlah" placeholder="Masukkan jumlah siswa baru" style="width: 220px;" required="required">
                          </td>
                        </tr>
                        <tr>
                          <td style="border: none;">Angkatan</td>
                          <td style="border: none;">:</td>
                          <td style="border: none;">
                            <input type="text" class="form-control" name="angkatan" placeholder="Ex: 2019" style="width: 220px;" required="required" data-inputmask='"mask": "9999"' data-mask>
                          </td>
                        </tr>
                      </table>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" value="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </form>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->

            <div class="box-body">
              <?php
              foreach ($data_angkatan as $data) {
                ?>
                <div class="col-md-2">
                  <a href="{{ url('/folder_siswa/daftar_siswa/'.$data->angkatan) }}" style="color: #f4bf42;"><span class="glyphicon glyphicon-folder-open" style="font-size: 80px;"></span><p style="color: black;">Tahun Ajaran {{ $data->angkatan }}/{{ $data->angkatan+1 }}</p></a>
                </div>
                <?php
              }
              ?>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </section><!-- /.content -->
  </div>
  @endsection

  @section('script-js')
  <!-- InputMask -->
  <script src="{{ asset('AdminLTE/plugins/input-mask/jquery.inputmask.js') }}"></script>
  <script src="{{ asset('AdminLTE/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
  <script src="{{ asset('AdminLTE/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
  @endsection

  @section('page-script')
  <script>
  //Input mask
  $('[data-mask]').inputmask()
</script>
@endsection