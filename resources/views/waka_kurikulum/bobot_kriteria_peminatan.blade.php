@extends('layouts/template_waka_kurikulum')

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
      <li><a href="{{ url('/dashboard-waka-kurikulum') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{ url('/daftar_kriteria_peminatan') }}">Daftar Kriteria Peminatan</a></li>
      <li class="active">Tentukan Bobot Kriteria</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title"><b>Form. Pengisian Bobot Kriteria Jurusan IPA</b></h3>
          </div><!-- /.box-header -->
          <div class="box-body table-responsive">
            <form action="{{ url('/daftar_kriteria/CI_CR/'.$id)}}" role="form" method="POST">
              @csrf
              <table id="example2" class="table table-hover table-bordered">
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
                            <input type="text" name="bobot_ipa[{{ $i }}][{{ $j }}]" value="1" style="width: 50px" readonly>
                          </td>
                          <?php
                        } else {
                          ?>
                          <td>
                            <input type="text" name="bobot_ipa[{{ $i }}][{{ $j }}]" placeholder="bobot" style="width: 50px" required="required">
                          </td>
                          <?php
                        }
                      }
                      ?>
                    </tr>
                    <?php
                    $i++;
                  }
                  // /.bagian thead samping dan inputan bobot
                  ?>
                </tbody>
              </table>
              <hr>
              <!-- tabel ips -->
              <div class="box-header with-border">
              <h3 class="box-title"><b>Form. Pengisian Bobot Kriteria Jurusan IPS</b></h3>
              </div><!-- /.box-header -->
              <table id="example2" class="table table-hover table-bordered">
                <?php
                for ($i=0; $i < 1; $i++) { 
                  ?>
                  <tbody>
                    <thead>
                      <tr>
                        <th>Kriteria/Kriteria</th>
                        <?php 
                        $j=0;
                        foreach ($data_kriteria as $data) {
                          ?>
                          <th>{{ $data->kriteria }}</th>
                          <?php
                          $j++;
                        }
                        ?>
                      </tr>
                    </thead>
                    <?php
                  } 

                  $i=0;
                  foreach ($data_kriteria as $data) {
                    ?>
                    <tr>
                      <th>{{ $data->kriteria }}</th>
                      
                      <?php
                      for ($j=0; $j < count($data_kriteria); $j++) { 
                        if ($i==$j) {
                          ?>
                          <td>
                            <input type="text" name="bobot_ips[{{ $i }}][{{ $j }}]" value="1" style="width: 50px" readonly>
                          </td>
                          <?php
                        } else {
                          ?>
                          <td>
                            <input type="text" name="bobot_ips[{{ $i }}][{{ $j }}]" placeholder="bobot" style="width: 50px" required="required">
                          </td>
                          <?php
                        }
                      }
                      ?>
                    </tr>
                    <?php
                    $i++;
                  }
                  ?>
                </tbody>
              </table>
              <hr>
              <!-- tabel bahasa -->
              <div class="box-header with-border">
              <h3 class="box-title"><b>Form. Pengisian Bobot Kriteria Jurusan Bahasa</b></h3>
              </div><!-- /.box-header -->
              <table id="example2" class="table table-hover table-bordered">
                <?php
                for ($i=0; $i < 1; $i++) { 
                  ?>
                  <tbody>
                    <thead>
                      <tr>
                        <th>Kriteria/Kriteria</th>
                        <?php 
                        $j=0;
                        foreach ($data_kriteria as $data) {
                          ?>
                          <th>{{ $data->kriteria }}</th>
                          <?php
                          $j++;
                        }
                        ?>
                      </tr>
                    </thead>
                    <?php
                  } 

                  $i=0;
                  foreach ($data_kriteria as $data) {
                    ?>
                    <tr>
                      <th>{{ $data->kriteria }}</th>
                      
                      <?php
                      for ($j=0; $j < count($data_kriteria); $j++) { 
                        if ($i==$j) {
                          ?>
                          <td>
                            <input type="text" name="bobot_bhs[{{ $i }}][{{ $j }}]" value="1" style="width: 50px" readonly>
                          </td>
                          <?php
                        } else {
                          ?>
                          <td>
                            <input type="text" name="bobot_bhs[{{ $i }}][{{ $j }}]" placeholder="bobot" style="width: 50px" required="required">
                          </td>
                          <?php
                        }
                      }
                      ?>
                    </tr>
                    <?php
                    $i++;
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