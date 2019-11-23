@extends('layouts/template_waka_kurikulum')

@section('title')
Halaman Edit Rombel
@endsection

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Edit Rombel
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Form. Edit Rombel</h3>
          </div><!-- /.box-header -->
          <div class="box-body table-responsive">
            <form action="{{ url('/tahun_ajaran/daftar_rombel/update')}}" role="form" method="POST">
              @csrf
              <table id="example2" class="table table-hover">
                <thead>
                  <tr>
                    <th>Nama Rombel</th>
                    <th>Wali Kelas</th>
                    <th>Kuota Kelas</th>
                    <th>Tahun Ajaran</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data_rombel as $data)
                  <tr>
                    <td>
                      <div class="form-group">
                      <input type="hidden" name="id" value="{{ $data->id }}">
                      <input type="hidden" name="peminatan" value="{{ $data->peminatan }}">
                        <input type="text" class="form-control" name="nama_rombel" value="{{ $data->nama_rombel }}" required="required">
                      </div>
                    </td>
                    <td>
                      <div class="form-group">
                        <input type="text" class="form-control" name="wali_kelas" value="{{ $data->wali_kelas }}" required="required">
                      </div>
                    </td>
                    <td>
                      <div class="form-group">
                        <input type="text" class="form-control" name="kuota_kelas" value="{{ $data->kuota_kelas }}" required="required">
                      </div>
                    </td>
                    <td>
                      <div class="form-group">
                        <input type="text" class="form-control" name="tahun_ajaran" value="{{ $data->tahun_ajar }}" required="required" data-inputmask='"mask": "9999"' data-mask placeholder="Ex: 2019">
                      </div>
                    </td>
                  </tr>
                  @endforeach
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