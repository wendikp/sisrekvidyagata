@extends('layouts/template_tim_ppdb')

@section('title')
Halaman Nilai Perbandingan Berpasangan
@endsection

@section('style')
<style type="text/css">
  .example-modal .modal {
    position: relative;
    top: auto;
    bottom: auto;
    right: auto;
    left: auto;
    display: block;
    z-index: 1;
  }

  .example-modal .modal {
    background: transparent !important;
  }
</style>
@endsection

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Bobot Kriteria Peminatan
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/dashboard-tim-ppdb') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{ url('/daftar_kriteria_peminatan') }}">Daftar Kriteria Peminatan</a></li>
      <li><a href="{{ url('/daftar_kriteria/instruksi/'.$id) }}">Instruksi</a></li>
      <li class="active">Nilai Perbandingan Berpasangan IPA</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        @if($id_pesan == 1)
        <div class="callout callout-danger">
        <h4>Warning!!!</h4>

          <p>Setelah dilakukan perhitungan menggunakan metode <i>Analytical Hierarchy Process</i>, nilai perbandingan berpasangan yang diinputkan sebelumnya dinyatakan <b>TIDAK KONSISTEN</b>. Hal tersebut dapat mempengaruhi hasil perekomendasian peminatan siswa. Silahkan masukkan kembali nilai perbandingan berpasangan pada matriks di bawah ini!</p>
        </div>
        @endif
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Form. Pengisian Nilai Perbandingan Berpasangan IPA</h3>
            <button type="button" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#modal-default">
              <i class="fa fa-table"></i> Tabel Nilai Perbandingan Berpasangan
            </button>
          </div><!-- /.box-header -->

          <!-- Form modal -->
          <div class="modal modal-primary fade" id="modal-default">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Berikut adalah tabel nilai perbandingan berpasangan:</h4>
                </div>
                <div class="modal-body">
                  <img src="{{ asset('/image/tabel_skor_perbandingan_berpasangan.png') }}" class="img-responsive" alt="tabel nilai perbandingan berpasangan">
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- /.modal -->

          <div class="box-body table-responsive">
            <form action="{{ url('/daftar_kriteria/hitung_CI_CR_ipa/'.$id)}}" role="form" method="POST">
              @csrf
              <table id="example2" class="table table-striped table-bordered">
                <?php
                // thead-atas
                for ($i=0; $i < 1; $i++) { 
                  ?>
                  <tbody>
                    <thead>
                      <tr>
                        <th>Kriteria/Kriteria</th>
                        <?php 
                        // $j=0;
                        foreach ($data_kriteria as $data) {
                          ?>
                          <th>{{ $data->kriteria }}</th>
                          <?php
                          // $j++;
                        }
                        ?>
                      </tr>
                    </thead>
                    <?php
                  } 
                  // /.thead-atas

                  $i=0;
                  // bagian thead samping dan inputan bobot
                  foreach ($data_kriteria as $data) {
                    ?>
                    <tr>
                      <th>{{ $data->kriteria }}</th>

                      <?php
                      for ($j=0; $j < count($data_kriteria); $j++) { 
                        if ($i==$j) {
                          ?>
                          <td>
                            <input type="text" name="nilai_pb[{{ $i }}][{{ $j }}]" value="1" style="width: 50px" readonly>
                          </td>
                          <?php
                        } else {
                          ?>
                          <td>
                            <input type="text" name="nilai_pb[{{ $i }}][{{ $j }}]" placeholder="Nilai" style="width: 50px" required="required">
                          </td>
                          <?php
                        }
                      }
                      ?>
                    </tr>
                    <input type="hidden" name="id_kriteria[{{ $i }}]" value="{{ $data->id }}">
                    <?php
                    $i++;
                  }
                  // /.bagian thead samping dan inputan bobot
                  ?>
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