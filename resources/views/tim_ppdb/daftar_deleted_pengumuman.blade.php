@extends('layouts/template_tim_ppdb')

@section('title')
Halaman Daftar Pengumuman (Deleted)
@endsection

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Daftar Pengumuman (Deleted)
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Daftar Pengumuman (Deleted)</h3>
          </div><!-- /.box-header -->
          <div class="box-body table-responsive">
            <table id="example2" class="table table-striped">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Penulis</th>
                  <th>Judul</th>
                  <th>Tanggal Pembuatan</th>
                  <th>Tools</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1; ?>
                @foreach ($data_pengumuman as $data)
                <tr>
                  <td><?php echo ($i++) ?></td>
                  <td>{{ $data->name }}</td>
                  <td>{{ $data->judul }}</td>
                  <td>{{ $data->created_at }}</td>
                  <td width="150">
                    <div class="btn-group">
                      <a href="{{ url('/restore_pengumuman/'.$data->id) }}" class="btn btn-default"><i class="fa fa-undo"></i></a>
                    </div>
                  </td>
                </tr>
                @endforeach
                <?php 
                if (count($data_pengumuman) <= 0) {
                  ?>
                  <tr>
                    <td colspan="5" align="center">Belum Ada Data</td>
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
@endsection