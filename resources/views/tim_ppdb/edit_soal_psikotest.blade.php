@extends('layouts/template_tim_ppdb')

@section('title')
Halaman Edit Soal Psikotest
@endsection

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Soal Psikotest
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Form. Pengeditan Soal Psikotest</h3>
          </div><!-- /.box-header -->
          <div class="box-body table-responsive">
            <form action="{{ url('/update_soal_psikotest') }}" role="form" method="POST" enctype="multipart/form-data">
              @csrf
              <table id="example2" class="table table-striped">
                <thead>
                  <tr>
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
                  <tr>
                    @foreach($data_soal as $data)
                    <td>
                      <input type="hidden" name="id" value="{{ $data->id }}">
                      <input type="hidden" name="id_psikotest" value="{{ $data->id_psikotest }}">
                      <textarea class="form-control " name="soal" rows="4" cols="150" style="width: 400px" required="required">{{ $data->soal }}</textarea>
                    </td>
                    <td>
                      <input type="file" class="form-control" name="gambar" placeholder="input gambar (jika ada)" style="width: 250px" value="{{ $data->gambar }}">
                    </td>
                    <td>
                      <input type="text" class="form-control" name="a" placeholder="Jawaban Opsi A" required="required" style="width: 120px" value="{{ $data->a }}">
                    </td>
                    <td>
                      <input type="text" class="form-control" name="b" placeholder="Jawaban Opsi B" required="required" style="width: 120px" value="{{ $data->b }}">
                    </td>
                    <td>
                      <input type="text" class="form-control" name="c" placeholder="Jawaban Opsi C" required="required" style="width: 120px" value="{{ $data->c }}">
                    </td>
                    <td>
                      <input type="text" class="form-control" name="d" placeholder="Jawaban Opsi D" required="required" style="width: 120px" value="{{ $data->d }}">
                    </td>
                    <td>
                      <input type="text" class="form-control" name="e" placeholder="Jawaban Opsi E" required="required" style="width: 120px" value="{{ $data->e }}">
                    </td>
                    <td>
                      <select name="jawaban" class="form-control" required="required">
                        <?php 
                        if ($data->jawaban == 'a') {
                          ?>
                          <option value="a">A</option>
                          <option value="b">B</option>
                          <option value="c">C</option>
                          <option value="d">D</option>
                          <option value="e">E</option>
                          <?php
                        } elseif ($data->jawaban == 'b') {
                          ?>
                          <option value="b">B</option>
                          <option value="a">A</option>
                          <option value="c">C</option>
                          <option value="d">D</option>
                          <option value="e">E</option>
                          <?php
                        } elseif ($data->jawaban == 'c') {
                          ?>
                          <option value="c">C</option>
                          <option value="a">A</option>
                          <option value="b">B</option>
                          <option value="d">D</option>
                          <option value="e">E</option>
                          <?php
                        } elseif ($data->jawaban == 'd') {
                          ?>
                          <option value="d">D</option>
                          <option value="a">A</option>
                          <option value="b">B</option>
                          <option value="c">C</option>
                          <option value="e">E</option>
                          <?php
                        } else {
                          ?>
                          <option value="e">E</option>
                          <option value="a">A</option>
                          <option value="b">B</option>
                          <option value="c">C</option>
                          <option value="d">D</option>
                          <?php
                        }
                        ?>
                      </select>
                    </td>
                    @endforeach
                  </tr>
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