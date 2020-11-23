@extends('layouts/template_tim_ppdb')

@section('title')
Halaman Kriteria Peminatan
@endsection

@section('style')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">

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
      Kriteria Peminatan
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/dashboard-tim-ppdb') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{ url('/daftar_kriteria_peminatan') }}">Daftar Kriteria Peminatan</a></li>
      <li class="active">Kriteria</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Daftar Kriteria Peminatan</h3>
            <div class="pull-right">
              <div class="btn-group">
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-tambah">
                  Tambah Kriteria
                </button>
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-edit">
                  Edit
                </button>
              </div>
            </div>
          </div><!-- /.box-header -->

          <!-- Form modal -->
          <div class="modal modal-primary fade" id="modal-tambah">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Silahkan masukkan kriteria baru disini</h4>
                </div>
                <div class="modal-body">
                  <form action="{{ url('/daftar_kriteria_peminatan/daftar_kriteria/tambah') }}" role="form" method="POST">
                    @csrf
                    <p>Note:</p>
                    <ul style="font-size: 9pt;">
                      <li>Klasifikasi nilai dengan kategori sangat baik, baik, cukup, dll, digunakan untuk kriteria yang memiliki rentang nilai. Contoh: 81-90, 91-100</li>
                      <li>Klasifikasi nilai dengan kategori sangat minat, minat, cukup, dll, hanya digunakan untuk kriteria berupa saran atau minat siswa terhadap peminatan.</li>
                    </ul>
                    <table class="table table-responsive">
                      <tr>
                        <input type="hidden" name="id_kriteria_peminatan" value="{{ $id_kriteria_peminatan }}">
                        <td style="border: none; width: 110px;">Nama kriteria</td>
                        <td style="border: none; width: 10px;">:</td>
                        <td style="border: none;">
                          <input type="text" class="form-control" name="kriteria" style="width: 220px;" required="required">
                        </td>
                      </tr>
                      <tr>
                        <td style="border: none; width: 110px;">Kategori</td>
                        <td style="border: none; width: 10px;">:</td>
                        <td style="border: none;">
                          <select class="form-control" name="kategori" required="required">
                            <option value="1">Nilai raport, nilai UN</option>
                            <option value="2">Nilai psikotest</option>
                            <option value="3">Minat/saran</option>
                          </select>
                        </td>
                      </tr>
                      <tr>
                        <td style="border: none; width: 110px;">Klasifikasi nilai</td>
                        <td style="border: none; width: 10px;">:</td>
                        <td style="border: none;">
                         <select class="form-control" name="klasifikasi_nilai" required="required">
                          <option value="1">Sangat baik, baik, cukup, kurang, sangat kurang</option>
                          <option value="2">Sangat minat, cukup, kurang minat, tidak minat</option>
                        </select>
                      </td>
                    </tr>
                  </table>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
                <button type="submit" value="submit" class="btn btn-outline">Submit</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <!-- Form modal -->
        <div class="modal modal-primary fade" id="modal-edit">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Silahkan ubah nama kriteria disini</h4>
              </div>
              <div class="modal-body">
                <form action="{{ url('/daftar_kriteria_peminatan/daftar_kriteria/update/'.$id_kriteria_peminatan) }}" role="form" method="POST">
                  @csrf
                  <p>Note:</p>
                  <ul style="font-size: 9pt;">
                    <li>Klasifikasi nilai dengan kategori sangat baik, baik, cukup, dll, digunakan untuk kriteria yang memiliki rentang nilai. Contoh: 81-90, 91-100</li>
                    <li>Klasifikasi nilai dengan kategori sangat minat, minat, cukup, dll, hanya digunakan untuk kriteria berupa saran atau minat siswa terhadap peminatan.</li>
                  </ul>
                  <table class="table table-responsive">
                    <tr>
                      <th>No.</th>
                      <th>Kriteria</th>
                      <th>Kategori</th>
                      <th>Klasifikasi nilai</th>
                    </tr>
                    <?php
                    $i=0;
                    ?>
                    @foreach($data_kriteria as $data)
                    <tr>
                      <td style="border: none;">{{ $i+1 }}</td>
                      <td style="border: none;">
                        <input type="hidden" name="id[]" value="{{ $data->id }}">
                        <input type="text" class="form-control" name="kriteria[]" style="width: 220px;" value="{{ $data->kriteria }}" required="required">
                      </td>
                      <td style="border: none;">
                        <select class="form-control" name="kategori[]" required="required">
                          <option value="1">Nilai raport, nilai UN</option>
                          <option value="2">Nilai psikotest</option>
                          <option value="3">Minat/saran</option>
                        </select>
                      </td>
                      <td style="border: none;">
                        <select class="form-control" name="klasifikasi_nilai[]" required="required">
                          <option value="1">Sangat baik, baik, cukup, kurang, sangat kurang</option>
                          <option value="2">Sangat minat, cukup, kurang minat, tidak minat</option>
                        </select>
                      </td>
                    </tr>
                    <?php
                    $i++;
                    ?>
                    @endforeach
                  </table>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
                  <button type="submit" value="submit" class="btn btn-outline">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <div class="box-body table-responsive">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No.</th>
                <th>Kriteria</th>
                <th>Bobot Preferensi MIPA</th>
                <th>Bobot Preferensi IPS</th>
                <th>Bobot Preferensi Bahasa dan Budaya</th>
                <th>Kategori</th>
                <th>Klasifikasi nilai</th>
                <th>Tanggal Pembuatan</th>
                <th>Tools</th>
              </tr>
            </thead>
            <tbody>
              <?php $i=1; ?>
              @foreach ($data_kriteria as $data)
              <tr>
                <td style="border: none;"><?php echo ($i++) ?></td>
                <td style="border: none;">{{ $data->kriteria }}</td>
                <td style="border: none;">{{ $data->bobot_prioritas_ipa }}</td>
                <td style="border: none;">{{ $data->bobot_prioritas_ips }}</td>
                <td style="border: none;">{{ $data->bobot_prioritas_bhs }}</td>
                <td style="border: none;">
                  @if($data->kategori == 1) Nilai raport, nilai UN
                  @elseif($data->kategori == 2) Nilai Psikotest
                  @else Minat/saran
                  @endif
                </td>
                <td style="border: none;">
                  @if($data->klasifikasi_nilai == 1) Sangat baik - sangat Kurang
                  @else Sangat minat - tidak minat
                  @endif
                </td>
                <td style="border: none;">{{ $data->day }}-{{ $data->month }}-{{ $data->year }}</td>
                <td style="border: none;" width="100">
                  <div class="btn-group">
                    <a href="{{ url('/daftar_kriteria/kriteria/hapus/'.$data->id) }}" class="btn btn-default" data-toggle="tooltip" title="Hapus Kriteria"><i class="fa fa-trash"></i></a>
                  </div>
                </td>
              </tr>
              @endforeach
              <?php 
              if (count($data_kriteria) <= 0) {
                ?>
                <tr>
                  <td colspan="13" align="center">Belum Ada Data</td>
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

@section('script-js')
<!-- DataTables -->
<script src="{{ asset('AdminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('AdminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
@endsection

@section('page-script')
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  });

  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
  });
</script>
@endsection