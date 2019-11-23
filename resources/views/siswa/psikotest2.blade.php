@extends('layouts/template_siswa')

@section('title')
Halaman Psikotest
@endsection

@section('content')
<div class="content-wrapper layout-boxed">
  <div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Psikotest
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Selamat mengerjakan! </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <form action="{{ url('/store-jawaban-soal') }}" role="form" method="POST" enctype="multipart/form-data">
                @csrf
                <table id="example2" class="table table-condensed">
                  <tbody>
                    <?php $i=0; ?>
                    @foreach ($data_soal as $data)
                    <tr>
                      <td rowspan="4" style="border: none;">{{ ++$i }}</td>
                      <td colspan="2" style="border: none;">{{ $data->soal }}</td>
                      <?php
                      if ($data->gambar != NULL) {
                        ?>
                        <td colspan="2" style="border: none;">{{ $data->gambar }}</td>
                        <?php
                      }
                      ?>
                    </tr>
                    <input type="hidden" name="id_soal[]" value="{{ $data->id }}">
                    <tr>
                      <td style="border: none;"><input type="radio" name="jawaban[{{ $i-1 }}]" value="a"> A.{{ $data->a }}</td>
                      <td style="border: none;"><input type="radio" name="jawaban[{{ $i-1 }}]" value="d"> D.{{ $data->d }}</td> 
                    </tr>
                    <tr>
                      <td style="border: none;"><input type="radio" name="jawaban[{{ $i-1 }}]" value="b"> B.{{ $data->b }}</td>
                      <td rowspan="2" style="border: none;"><input type="radio" name="jawaban[{{ $i-1 }}]" value="e"> E.{{ $data->e }}</td>
                    </tr>
                    <tr>
                      <td style="border: none;"><input type="radio" name="jawaban[{{ $i-1 }}]" value="c"> C.{{ $data->c }}</td> 
                    </tr>
                    @endforeach
                    <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
                  </tbody>
                </table>
                <div class="box-footer">
                  <button type="button" class="btn btn-primary center-block" data-toggle="modal" data-target="#modal-default">Selesai</button>
                </div>

                <!-- Form modal -->
                <div class="modal fade" id="modal-default">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Konfirmasi</h4>
                        </div>
                        <div class="modal-body">
                          <p>Dengan memilih tombol "Ya" maka anda dianggap selesai mengerjakan tes.</p>
                          <p>Selesai mengerjakan tes?</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tidak</button>
                          <button type="submit" value="submit" class="btn btn-primary">Ya</button>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <!-- /.modal -->
                </form>
              </div><!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
          <!-- ./col -->
        </div><!-- /.row -->
      </section><!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  @endsection