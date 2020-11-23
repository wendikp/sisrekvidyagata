@extends('layouts/template_tim_ppdb')

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
      <li><a href="{{ url('/dashboard-tim-ppdb') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{ url('/daftar_kriteria_peminatan') }}">Daftar Kriteria Peminatan</a></li>
      <li class="active">Buat Baru</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Form. Membuat Kriteria Peminatan</h3>
          </div><!-- /.box-header -->
          <div class="box-body table-responsive">
            <form action="{{ url('/daftar_kriteria_peminatan/store_kriteria_baru')}}" role="form" method="POST">
              @csrf
              <p>Note:</p>
              <ul style="font-size: 9pt;">
                <li>Klasifikasi nilai dengan kategori sangat baik, baik, cukup, dll, digunakan untuk kriteria yang memiliki rentang nilai. Contoh: 81-90, 91-100</li>
                <li>Klasifikasi nilai dengan kategori sangat minat, minat, cukup, dll, hanya digunakan untuk kriteria berupa saran atau minat siswa terhadap peminatan.</li>
              </ul>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th style="width: 30px;">No.</th>
                    <th>Kriteria</th>
                    <th>Kategori</th>
                    <th>Klasifikasi nilai</th>
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
                      <td>
                        <div class="form-group">
                          <select class="form-control" name="kategori[]" required="required">
                            <option value="1">Nilai raport, nilai UN</option>
                            <option value="2">Nilai psikotest</option>
                            <option value="3">Minat/saran</option>
                          </select>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                          <select class="form-control" name="klasifikasi_nilai[]" required="required">
                            <option value="1">Sangat baik, baik, cukup, kurang, sangat kurang</option>
                            <option value="2">Sangat minat, cukup, kurang minat, tidak minat</option>
                          </select>
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