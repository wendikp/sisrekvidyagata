@extends('layouts/template_tim_ppdb')

@section('title')
Halaman Soal Psikotest
@endsection

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Psikotest
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">
              Daftar Soal Psikotest (Deleted)
            </h3>
          </div><!-- /.box-header -->
          <div class="box-body table-responsive">
            <table id="example2" class="table table-striped">
              <tbody>
                <thead>
                  <th>No.</th>
                  <th>Kode Psikotest</th>
                  <th>Tanggal dibuat</th>
                  <th>Soal</th>
                  <th>Gambar</th>
                  <th>Jawaban</th>
                  <th>Tools</th>
                </thead>
                <?php 
                $i=0;
                foreach ($data_soal as $data){
                  ?>
                  <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $data->psikotest_code }}</td>
                    <td>{{ $data->day }}-{{ $data->month }}-{{ $data->year }}</td>
                    <td>{{ $data->soal }}</td>
                    <?php
                    if ($data->gambar != NULL) {
                      ?>
                      <td>{{ $data->gambar }}</td>
                      <?php
                    } else {
                      ?>
                      <td>Tidak ada gambar</td>
                      <?php
                    }

                    if ($data->jawaban == 'a') {
                      ?>
                      <td>A.{{ $data->a }}</td>
                      <?php
                    } elseif ($data->jawaban == 'b') {
                      ?>
                      <td>B.{{ $data->b }}</td>
                      <?php
                    } elseif ($data->jawaban == 'c') {
                      ?>
                      <td>C.{{ $data->c }}</td>
                      <?php
                    } elseif ($data->jawaban == 'd') {
                      ?>
                      <td>D.{{ $data->d }}</td>
                      <?php
                    } else {
                      ?>
                      <td>E.{{ $data->e }}</td>
                      <?php
                    }
                    ?>
                    <td>
                      <div class="btn-group">
                        <a href="{{ url('/restore_soal_psikotest/'.$data->id) }}" class="btn btn-default"><i class="fa fa-undo"></i></a>
                      </div>
                    </td>
                  </tr>   
                  <?php 
                }

                if (count($data_soal) <= 0) {
                  ?>
                  <tr>
                    <td colspan="7" align="center">Belum Ada Data</td>
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