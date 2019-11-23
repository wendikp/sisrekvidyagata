@extends('layouts/template_admin')

@section('title')
Halaman Tambah Pengguna
@endsection

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Tambah Pengguna
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Pilih jenis pengguna dan jumlah yang akan ditambah:</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <form action="{{ url('/tambah_pengguna')}}" role="form" method="POST">
              {{ csrf_field() }}
              <div class="form-group">
              <select name="jenis_pengguna" class="form-control" style="width: 230px;" required="required">
                 <option value="Admin">Admin</option>
                 <option value="Waka Kurikulum">Waka Kurikulum</option>
                 <option value="Tim PPDB">Tim PPDB</option>
                 <option value="Siswa Baru">Siswa Baru</option>
               </select>
             </div>
             <div class="form-group">
              <input type="number" min="1" class="form-control" name="jumlah" placeholder="Jumlah" style="width: 230px;" required="required">
            </div>
            <div class="box-footer">
              <button name="submit" value="submit" type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->
</section><!-- /.content -->
</div>
@endsection