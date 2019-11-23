@extends('layouts/template_tim_ppdb')

@section('title')
Halaman Edit Info Psikotest
@endsection

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Edit Info Psikotest
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Edit Info Psikotest</h3>
          </div><!-- /.box-header -->
          <div class="box-body table-responsive">
          <!-- belum dibuat -->
            <form action="{{ url('/update_psikotest')}}" role="form" method="POST">
              @csrf
              <table id="example2" class="table table-striped">
                <thead>
                  <tr>
                    <th>Psikotest Version</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($data_angket as $data)
                  <tr>
                    <td>
                      <input type="hidden" name="id[] " value="{{ $data->id }}">
                      <input type="text" name="psikotest_version" value="{{ $data->psikotest_version }}" required="required">
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