@extends('layouts/template_waka_kurikulum')

@section('title')
Halaman Tambah Rombel
@endsection

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Tambah Rombel
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/dashboard-waka-kurikulum') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{ url('/tahun_ajaran') }}">Tahun Ajaran</a></li>      
      <li class="active">Tambah Rombel</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Form. Tambah Rombel</h3>
          </div><!-- /.box-header -->
          <div class="box-body table-responsive">
            <form action="{{ url('/tahun_ajaran/tambah_rombel/store') }}" role="form" method="POST">
              @csrf
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Peminatan</th>
                    <th>Tahun Ajaran</th>
                    <th>Nama Rombel</th>
                    <th>Wali Kelas</th>
                    <th>Kuota Kelas</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  for ($i=0; $i<$jumlah; $i++) { 
                    ?>
                    <tr>
                      <td><?php echo ($i+1) ?></td>
                      <td>
                        <div class="form-group">
                          <select class="form-control" name="peminatan[]" required="required">
                            <option value="MIPA">MIPA</option>
                            <option value="IPS">IPS</option>
                            <option value="Bahasa dan Budaya">Bahasa dan Budaya</option>
                          </select>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                          <input type="text" class="form-control" name="tahun_ajaran[]" placeholder="Tahun Ajaran" required="required" data-inputmask='"mask": "9999"' data-mask placeholder="Ex: 2019">
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                          <input type="text" class="form-control" name="nama_rombel[]" placeholder="Nama Rombel" required="required">
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                          <input type="text" class="form-control" name="wali_kelas[]" placeholder="Wali Kelas" required="required">
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                          <input type="text" class="form-control" name="kuota_kelas[]" placeholder="Kuota kelas" required="required">
                        </div>
                      </td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
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
<!-- InputMask -->
<script src="{{ asset('AdminLTE/plugins/input-mask/jquery.inputmask.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
@endsection

@section('page-script')
<script type="text/javascript">
  //Input mask
  $('[data-mask]').inputmask()
</script>
@endsection