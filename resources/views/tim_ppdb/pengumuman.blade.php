@extends('layouts/template_tim_ppdb')

@section('title')
Halaman Pengumuman
@endsection

@section('content')
<div class="content-wrapper">
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
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Pengumuman</h3>
          </div><!-- /.box-header -->
          <div class="box-body table-responsive">

            <table id="example2" class="table">
              <tbody>
                @foreach($data_pengumuman as $data)
                <tr>
                  <td>{{ $data->judul }}</td>
                  <td>{{ $data->created_at }}</td>
                </tr>
                <tr>
                  <td colspan="2">{{ $data->isi }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </section><!-- /.content -->
</div>
@endsection