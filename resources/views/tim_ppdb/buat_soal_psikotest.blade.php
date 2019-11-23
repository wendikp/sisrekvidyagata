@extends('layouts/template_tim_ppdb')

@section('title')
Halaman Buat Soal Psikotest
@endsection

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Soal Psikotest
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/dashboard-tim-ppdb') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{ url('/daftar_psikotest') }}">Daftar Psikotest</a></li>
      <li class="active">Buat Soal</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Form. Pembuatan Soal Psikotest</h3>
          </div><!-- /.box-header -->
          <div class="box-body table-responsive">
            <form action="{{ url('/daftar_psikotest/buat_soal/simpan')}}" role="form" method="POST" enctype="multipart/form-data">
              @csrf
              <table id="example2" class="table table-striped">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Soal</th>
                    <th>Upload Gambar (Jika Ada)</th>
                    <th>Opsi A</th>
                    <th>Opsi B</th>
                    <th>Opsi C</th>
                    <th>Opsi D</th>
                    <th>Opsi E</th>
                    <th>Jawaban Benar</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  for ($i=0; $i < $jumlah; $i++) { 
                    ?>
                    <tr>
                      <td>
                        {{ $i+1 }}
                      </td>
                      <td>
                        <textarea class="form-control " name="soal[]" rows="4" cols="150" style="width: 400px" required="required"></textarea>
                      </td>
                      <td>
                        <input type="file" class="form-control" name="gambar[]" placeholder="input gambar (jika ada)" style="width: 250px">
                      </td>
                      <td>
                        <input type="text" class="form-control" name="a[]" placeholder="Jawaban Opsi A" required="required" style="width: 120px">
                      </td>
                      <td>
                        <input type="text" class="form-control" name="b[]" placeholder="Jawaban Opsi B" required="required" style="width: 120px">
                      </td>
                      <td>
                        <input type="text" class="form-control" name="c[]" placeholder="Jawaban Opsi C" required="required" style="width: 120px">
                      </td>
                      <td>
                        <input type="text" class="form-control" name="d[]" placeholder="Jawaban Opsi D" required="required" style="width: 120px">
                      </td>
                      <td>
                        <input type="text" class="form-control" name="e[]" placeholder="Jawaban Opsi E" required="required" style="width: 120px">
                      </td>
                      <td>
                        <select name="jawaban[]" class="form-control" required="required">
                         <option value="a">A</option>
                         <option value="b">B</option>
                         <option value="c">C</option>
                         <option value="d">D</option>
                         <option value="e">E</option>
                       </select>
                     </td>
                   </tr>
                   <?php
                 }
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