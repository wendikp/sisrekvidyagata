@extends('layouts/template_tim_ppdb')

@section('title')
Halaman Daftar Psikotest
@endsection

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Daftar Psikotest
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Daftar Psikotest</h3>
          </div><!-- /.box-header -->
          <div class="box-body table-responsive">
            <table id="example2" class="table table-striped">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Kode Psikotest</th>
                  <th>Tanggal Pembuatan</th>
                  <th>Tools</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $i=0;
                ?>
                @foreach($data_psikotest as $data)
                <tr>
                  <td><?php echo (++$i) ?></td>
                  <td>{{ $data->psikotest_code }}</td>
                  <td>{{ $data->created_at }}</td>
                  <td width="100">
                    <div class="btn-group">
                    <a href="{{ url('/deleted_soal_psikotest/'.$data->id) }}" class="btn btn-default"><i class="fa fa-list"></i></a>
                      <?php
                      if ($data->deleted_at != NULL) {
                        ?>
                        <a href="{{ url('/restore_psikotest/'.$data->id) }}" class="btn btn-default"><i class="fa fa-undo"></i></a>
                        <?php
                      }
                      ?>
                    </div>
                  </td>
                  <td></td>
                </tr>
                @endforeach
                <?php 
                if (count($data_psikotest) <= 0) {
                  ?>
                  <tr>
                    <td colspan="4" align="center">Belum Ada Data</td>
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