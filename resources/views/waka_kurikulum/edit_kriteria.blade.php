@extends('layouts/template_waka_kurikulum')

@section('title')
Halaman Edit Kriteria Peminatan
@endsection

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Edit Kriteria Peminatan
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Form. Edit Kriteria Peminatan</h3>
          </div><!-- /.box-header -->
          <div class="box-body table-responsive">
          <form action="{{ url('/update_kriteria')}}" role="form" method="POST">
              @csrf
              <table id="example2" class="table table-hover">
                <thead>
                  <tr>
                    <th>Kode Kriteria</th>
                    <th>Kriteria</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($data_kriteria as $data) {
                    ?>
                    <tr>
                      <td>
                        <div class="form-group">
                        <input type="hidden" name="id" value="{{ $data->id }}" >
                          <input type="text" class="form-control" name="kode_kriteria" value="{{ $data->kode_kriteria }}" style="width: 50px;" required="required">
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                          <input type="text" class="form-control" name="kriteria" value="{{ $data->kriteria }}" required="required">
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