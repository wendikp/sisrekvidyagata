@extends('layouts/template_siswa')

@section('title')
Halaman Edit Angket Peminatan Siswa
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
            <h3 class="box-title">Silahkan edit Angket Peminatan:</h3>
          </div><!-- /.box-header -->
          <div class="box-body table-responsive">
            <form action="{{ url('/update-angket-peminatan')}}" role="form" method="POST">
              @csrf
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
                    <td>
                      <input type="hidden" name="id_user" value="{{ AUth::user()->id }}">
                      <input type="hidden" name="id_kriteria[] " value="{{ $data->id }}">
                      <input type="text" name="nilai[]" value="{{ $data->nilai }}" required="required">
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
  <!-- /.container -->
</div>
@endsection