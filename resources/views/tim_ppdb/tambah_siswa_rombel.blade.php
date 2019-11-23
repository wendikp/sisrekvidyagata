@extends('layouts/template_tim_ppdb')

@section('title')
Halaman Tambah Siswa Rombel
@endsection

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Tambah Siswa Rombel
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Form. Tambah Siswa</h3>
          </div><!-- /.box-header -->
          <div class="box-body table-responsive">
            <form action="{{ url('/store_siswa_rombel')}}" role="form" method="POST">
              @csrf
              <table id="example2" class="table table-striped">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>No. Induk</th>
                    <th>Nama</th>
                    <th>Nilai Peminatan IPA</th>
                    <th>Nilai Peminatan IPS</th>
                    <th>Nilai Peminatan Bahasa</th>
                    <th>Rekomendasi Peminatan 1</th>
                    <th>Rekomendasi Peminatan 2</th>
                    <th>Rekomendasi Peminatan 3</th>
                    <th>Pilih</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i=1; ?>
                  @foreach ($data_siswa as $data)
                  <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $data->no_induk }}</td>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->nilai_ipa }}</td>
                    <td>{{ $data->nilai_ips }}</td>
                    <td>{{ $data->nilai_bahasa }}</td>
                    <td>{{ $data->rekomendasi_1 }}</td>
                    <td>{{ $data->rekomendasi_2 }}</td>
                    <td>{{ $data->rekomendasi_3 }}</td>
                    <td>
                      <input type="hidden" name="id[]" value="{{ $data->id }}">
                      <input type="hidden" name="id_rombel[]" value="NULL">
                      <input type="checkbox" name="id_rombel[]" value="{{ $data->id_rombel }}">
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
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