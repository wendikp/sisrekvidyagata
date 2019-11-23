@extends('layouts/template_waka_kurikulum')

@section('title')
Halaman Tambah Kriteria Peminatan
@endsection

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Buat Kriteria Peminatan
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/dashboard-waka-kurikulum') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{ url('/daftar_kriteria_peminatan') }}">Daftar Kriteria Peminatan</a></li>
      <li class="active">Buat Baru</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Form. Membuat Kriteria Peminatan</h3>
          </div><!-- /.box-header -->
          <div class="box-body table-responsive">
            <form action="{{ url('/daftar_kriteria_peminatan/store_kriteria_baru')}}" role="form" method="POST">
              @csrf
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th style="width: 30px;">No.</th>
                    <th>Kriteria</th>
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
                          <input type="text" class="form-control" name="kriteria[]" placeholder="Nama Kriteria" required="required">
                        </div>
                      </td>
                    </tr>
                    <?php 
                  } 
                  ?>
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