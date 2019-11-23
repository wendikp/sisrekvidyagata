@extends('layouts/template_siswa')

@section('title')
Halaman Psikotest
@endsection

@section('content')
<div class="content-wrapper layout-boxed">
  <div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Psikotest
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-8">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Instruksi Pengerjaan: </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <ol>
                <li>Lorem ipsum dolor sit amet Consectetur adipiscing elit Consectetur adipiscing elit Consectetur adipiscing elit</li>
                <li>Consectetur adipiscing elit Consectetur adipiscing elit Integer molestie lorem at massa Facilisis in pretium nisl aliquet</li>
                <li>Integer molestie lorem at massa Facilisis in pretium nisl aliquet Nulla volutpat aliquam velit Nulla volutpat aliquam velit</li>
                <li>Facilisis in pretium nisl aliquet Ac tristique libero volutpat at Phasellus iaculis neque Nulla volutpat aliquam velit</li>
                <li>Nulla volutpat aliquam velit Nulla volutpat aliquam velit</li>
                <li>Phasellus iaculis neque Nulla volutpat aliquam velit Purus sodales ultricies Ac tristique libero volutpat at</li>
                <li>Purus sodales ultricies Ac tristique libero volutpat at</li>
                <li>Vestibulum laoreet porttitor sem Ac tristique libero volutpat at Purus sodales ultricies Ac tristique libero volutpat at</li>
                <li>Ac tristique libero volutpat at Ac tristique libero volutpat at</li>
                <li>Faucibus porta lacus fringilla vel Nulla volutpat aliquam velit Purus sodales ultricies Ac tristique libero volutpat at</li>
                <li>Aenean sit amet erat nunc Ac tristique libero volutpat at</li>
                <li>Eget porttitor lorem Facilisis in pretium nisl aliquet</li>
              </ol>
              <a href="{{ url('/start-psikotest') }}" class="btn btn-primary pull-right">Mulai Tes</a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- ./col -->
      </div><!-- /.row -->
    </section><!-- /.content -->
  </div>
  <!-- /.container -->
</div>
@endsection