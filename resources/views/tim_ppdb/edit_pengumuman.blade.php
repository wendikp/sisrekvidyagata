@extends('layouts/template_tim_ppdb')

@section('title')
Halaman Edit Pengumuman
@endsection

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Edit Pengumuman
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Form. Edit Pengumuman</h3>
          </div><!-- /.box-header -->
          <div class="box-body table-responsive">
            <form action="{{ url('/update_pengumuman')}}" role="form" method="POST">
              @csrf
              <table id="example2" class="table">
                <tbody>
                  @foreach($data_pengumuman as $data)
                  <tr>
                    <td style="width: 130px">Judul : </td>
                    <td>
                    <input type="hidden" name="id" value="{{ $data->id }}">
                      <input type="text" class="form-control" name="judul" value="{{ $data->judul }}" required="required">
                    </td>
                  </tr>
                  <tr>
                    <td style="width: 130px">Isi Pengumuman : </td>
                    <td>
                      <textarea class="form-control " name="isi" rows="15" cols="150" required="required">{{ $data->isi }}</textarea>
                    </td>
                  </tr>
                  @endforeach
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