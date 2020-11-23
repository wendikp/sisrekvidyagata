<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>SisRek Vidyagata | Log in</title>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('AdminLTE/bower_components/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('AdminLTE/bower_components/Ionicons/css/ionicons.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/AdminLTE.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/iCheck/square/blue.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('style.css') }}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

</head>
<body class="hold-transition login-page" style="background-image: url({{ url('/image/IMG_20191127_103105.jpg') }}); width: 100%; height: 100%; position: fixed; background-size: 100%;">
  <div>
    <div class="login-box-tp">
      <img src="{{ url('/image/avatar.png') }}" class="avatar">
      <h1>SisRek Vidyagata</h1>
      <br/>
      <h2>Silahkan login untuk masuk ke sistem</h2>

      <form method="POST" action="{{ route('login') }}">
        @csrf
        <p>Username</p>
        <div class="form-group has-feedback">
          <input id="no_induk" name="no_induk" type="text" class="form-control" placeholder="NIS (Siswa) | NIK/NIP (Staf)" required autofocus>
          @if ($errors->has('no_induk'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('no_induk') }}</strong>
          </span>
          @endif
          <span class="fa fa-user form-control-feedback"></span>
        </div>
        <p>Password</p>
        <div class="form-group has-feedback">
          <input id="password" name="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"placeholder="Password" required>
          @if ($errors->has('password'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('password') }}</strong>
          </span>
          @endif
          <span class="fa fa-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <div class="col-xs-12">
            <!-- <button type="submit" class="btn btn-primary btn-flat center-block" style="width: 30%">Login</button> -->
            <input type="submit" name="submit" value="Login">
          </div>
          <!-- /.col -->
        </div>
        <div class="row">
          <div class="col-xs-12">
            <!-- <a href="https://www.instagram.com/wendi_kp/" class="pull-right" style="margin-top: 20px; margin-bottom: -15px; font-size: 8pt">Developed by Wendi K.P.</a> -->
          </div>
        </div>
      </form>
      <!-- </div> -->
      <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->
  </div>

  <!-- jQuery 3 -->
  <script src="{{ asset('AdminLTE/bower_components/jquery/dist/jquery.min.js') }}"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="{{ asset('AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
  <!-- iCheck -->
  <script src="{{ asset('AdminLTE/plugins/iCheck/icheck.min.js') }}"></script>
  <script>
    $(function () {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
    });
  </script>
</body>
</html>
