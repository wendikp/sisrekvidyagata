@extends('layouts/template_tim_ppdb')

@section('title')
Halaman Tambah Kriteria Peminatan
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
      <li class="active">Instruksi</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title"><b>Instruksi Penentuan Bobot Kriteria Peminatan</b></h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <div class="col-md-7" style="text-align: justify;">
              <ol>
                <li>Prosedur pemberian nilai perbandingan berpasangan mengacu pada skor penilaian yang telah dikembangkan oleh Thomas L. Saaty di metode AHP (<i>Analytical Hierarchy Process</i>).</li>
                <li>Pada penilaian perbandingan berpasangan berlaku hukum <i>aksioma reciprocal</i>. Contoh: Jika kriteria A dinilai lebih penting 5 kali dibandingkan kriteria B, maka kriteria B lebih penting 1/5 dibandingkan dengan kriteria A.</li>
                <li>Nilai perbandingan berpasangan yang telah disubmit selanjutnya akan diuji tingkat kekonsistensiannya (<i>Concistency Index</i>) menggunakan algoritma AHP.</li>
                <li>Jika nilai dari <i>Concistency Index</i> (CI) sama dengan 0 artinya nilai perbandingan berpasangan yang diinputkan konsisten dan sistem akan mengarahkan user ke halaman penginputan nilai perbandingan berpasangan untuk alternatif berikutnya.</li>
                <li>Jika nilai dari <i>Consistency Index</i> (CI) besar dari 0, maka sistem akan menguji batas ketidakkonsistenan nilai perbandingan berpasangan menggunakan <i>Concistency Ratio</i> (CR).</li>
                <li>Jika nilai dari <i>Concistency Ratio</i> (CR) lebih kecil atau sama dengan 10% artinya ketidakkonsistenan nilai masih dapat diterima dan sistem akan mengarahkan user ke halaman penginputan nilai perbandingan berpasangan untuk alternatif berikutnya.</li>
                <li>Jika nilai dari <i>Concistency Ratio</i> (CR) lebih besar dari 10% artinya ketidakkonsistenan nilai tidak dapat diterima dan user harus memperbaiki kembali nilai perbandingan berpasangan yang diinputkan sebelumnya.</li>
                <li>Penginputan nilai perbandingan berpasangan dilakukan sebanyak tiga kali sesuai dengan jumlah dari peminatan yang ada di SMAN 6 Malang.</li>
              </ol>
            </div>
            <div class="col-md-5 col-xs-12">
              Berikut adalah tabel nilai perbandingan berpasangan: <br/>
              <img src="{{ asset('/image/tabel_skor_perbandingan_berpasangan.png') }}" class="img-responsive" alt="tabel nilai perbandingan berpasangan" width="400px">
            </div>
          </div><!-- /.box-body -->
          <div class="box-footer">
            <a href="{{ url('/daftar_kriteria/nilai_perbandingan_berpasangan_ipa/'.$id)}}" class="btn btn-primary pull-right">Next</a>
          </div>
        </div><!-- /.box -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </section><!-- /.content -->
</div>
@endsection