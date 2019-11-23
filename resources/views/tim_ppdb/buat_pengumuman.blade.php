@extends('layouts/template_tim_ppdb')

@section('title')
Halaman Buat Pengumuman
@endsection

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Buat Pengumuman
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/dashboard-tim-ppdb') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{ url('/daftar_pengumuman') }}">Daftar Pengumuman</a></li>
      <li class="active">Buat Pengumuman</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Form. Buat Pengumuman</h3>
          </div><!-- /.box-header -->
          <div class="box-body table-responsive">
          <form action="{{ url('/daftar_pengumuman/tambah/simpan')}}" role="form" method="POST">
              @csrf
              <table id="example2" class="table">
                <tbody>
                  <tr>
                    <td style="width: 130px">Judul : </td>
                    <td>
                      <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                      <input type="text" class="form-control" name="judul" placeholder="Judul Pengumuman" required="required">
                    </td>
                  </tr>
                  <tr>
                    <td style="width: 130px">Isi Pengumuman : </td>
                    <td>
                      <textarea class="form-control " name="isi" rows="15" cols="150" required="required"></textarea>
                    </td>
                  </tr>
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