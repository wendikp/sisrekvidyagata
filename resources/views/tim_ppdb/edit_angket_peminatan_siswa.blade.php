@extends('layouts/template_tim_ppdb')

@section('title')
Halaman Edit Angket Peminatan Siswa
@endsection

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Daftar Angket Peminatan
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/dashboard-tim-ppdb') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{ url('/angket_peminatan/angkatan_siswa') }}">Angkatan Siswa</a></li>
      <li><a href="{{ url('/angket_peminatan/angkatan_siswa/angket/'.$angkatan) }}">Daftar Angket Peminatan {{ $angkatan }}</a></li>
      <li class="active">Edit</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Edit Angket Peminatan Siswa Baru : {{ $nama }}</h3>
          </div><!-- /.box-header -->
          <div class="box-body table-responsive">
            <form action="{{ url('/angket_peminatan/angkatan_siswa/angket/edit/update/'.$id_user) }}" role="form" method="POST">
              @csrf
              <table id="example2" class="table table-striped table-hover">
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
                    @if($data->kategori == 1)
                      <input type="hidden" name="id_kriteria[] " value="{{ $data->id }}">
                      <input type="text" class="form-control" name="nilai[]" value="{{ $data->nilai }}">
                    @elseif($data->kategori == 2)
                      <input type="hidden" name="id_kriteria[] " value="{{ $data->id }}">
                      <input type="text" class="form-control" name="nilai[]" value="{{ $data->nilai }}" readonly>
                    @else
                      <input type="hidden" name="id_kriteria[] " value="{{ $data->id }}">
                      <select class="form-control" name="nilai[]" required="required">
                        @if($data->nilai == "Sangat minat")
                        <option value="Sangat minat">Sangat minat</option>
                        <option value="Minat">Minat</option>
                        <option value="Cukup">Cukup</option>
                        <option value="Kurang minat">Kurang minat</option>
                        <option value="Tidak minat">Tidak minat</option>
                        @elseif($data->nilai == "Minat")
                        <option value="Minat">Minat</option>
                        <option value="Sangat minat">Sangat minat</option>
                        <option value="Cukup">Cukup</option>
                        <option value="Kurang minat">Kurang minat</option>
                        <option value="Tidak minat">Tidak minat</option>
                        @elseif($data->nilai == "Cukup")
                        <option value="Cukup">Cukup</option>
                        <option value="Sangat minat">Sangat minat</option>
                        <option value="Minat">Minat</option>
                        <option value="Kurang minat">Kurang minat</option>
                        <option value="Tidak minat">Tidak minat</option>
                        @elseif($data->nilai == "Kurang minat")
                        <option value="Kurang minat">Kurang minat</option>
                        <option value="Sangat minat">Sangat minat</option>
                        <option value="Minat">Minat</option>
                        <option value="Cukup">Cukup</option>
                        <option value="Tidak minat">Tidak minat</option>
                        @elseif($data->nilai == "Tidak minat")
                        <option value="Tidak minat">Tidak minat</option>
                        <option value="Sangat minat">Sangat minat</option>
                        <option value="Minat">Minat</option>
                        <option value="Cukup">Cukup</option>
                        <option value="Kurang minat">Kurang minat</option>
                        @endif
                      </select>
                    @endif
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
@endsection