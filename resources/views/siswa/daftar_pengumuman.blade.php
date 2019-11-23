@extends('layouts/template_siswa')

@section('title')
Halaman Daftar Pengumuman
@endsection

@section('content')
<div class="content-wrapper layout-boxed">
  <div class="container">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Pengumuman
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Daftar Pengumuman</h3>
          </div><!-- /.box-header -->
          <div class="box-body table-responsive">
            <table id="example2" class="table table-striped">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Judul</th>
                  <th>Tanggal Pembuatan</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1; ?>
                @foreach ($data_pengumuman as $data)
                <tr>
                  <td><?php echo ($i++) ?></td>
                  <td><a href="{{ url('/detail-pengumuman/'.$data->id) }}">{{ $data->judul }}</a></td>
                  <td>{{ $data->created_at }}</td>
                </tr>
                @endforeach
                <?php 
                if (count($data_pengumuman) <= 0) {
                  ?>
                  <tr>
                    <td colspan="3" align="center">Belum Ada Pengumuman</td>
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
  <!-- /.container -->
</div>
@endsection