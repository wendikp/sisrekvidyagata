@extends('layouts/template_siswa')

@section('title')
Halaman Angket Peminatan Siswa
@endsection

@section('content')
<div class="content-wrapper layout-boxed">
  <div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Angket Peminatan Siswa
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
      <div class="col-xs-12">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Angket Peminatan Siswa Baru SMAN 6 Malang</h3>
              <a href="{{ url('/edit-angket-peminatan/'.Auth::user()->id) }}" class="btn btn-default pull-right"><i class="fa fa-edit"></i> Edit</a>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example2" class="table table-striped">
                <thead>
                  <tr>
                    <th>Kriteria</th>
                    <th>Nilai</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($data_angket as $data)
                  <tr>
                    <td>{{ $data->kriteria }}</td>
                    <td>{{ $data->nilai }}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </section><!-- /.content -->
    <!-- /.content -->
  </div>
  <!-- /.container -->
</div>
<!-- /.content-wrapper -->
@endsection