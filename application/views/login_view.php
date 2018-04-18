<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>amoi-antik</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Faveicon -->
  <link rel="icon" type="image/png" href=<?= base_url("images/logo.png");?>>
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href=<?= base_url("bower_components/bootstrap/dist/css/bootstrap.min.css");?>>
  <!-- Font Awesome -->
  <link rel="stylesheet" href=<?= base_url("bower_components/font-awesome/css/font-awesome.min.css");?>>
  <!-- Ionicons -->
  <link rel="stylesheet" href=<?= base_url("bower_components/Ionicons/css/ionicons.min.css");?>>
  <!-- Theme style -->
  <link rel="stylesheet" href=<?= base_url("dist/css/AdminLTE.css");?>>
  <!-- iCheck -->
  <link rel="stylesheet" href=<?= base_url("plugins/iCheck/square/blue.css");?>>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <img src=<?= base_url("images/logo.png");?> height="48">
    <br>
    <a href=<?= base_url();?>><b>amoi</b>@ntik</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
  <?php
    if (isset($error_message)) {
      echo "<p class='login-box-msg text-danger'>$error_message</p>";
    } else {
      echo "<p class='login-box-msg'>Masukkan nama pengguna dan kata sandi untuk memulai</p>";
    }
  ?>

    <form action=<?= base_url("autentikasi/do_login");?> method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Nama Pengguna" name="txtUser">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Kata Sandi" name="txtPass">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Masuk</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <hr>
    <a href="#" id="lost-pass">Lupa Kata Sandi</a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src=<?= base_url("bower_components/jquery/dist/jquery.min.js");?>></script>
<!-- Bootstrap 3.3.7 -->
<script src=<?= base_url("bower_components/bootstrap/dist/js/bootstrap.min.js");?>></script>
<!-- iCheck -->
<script src=<?= base_url("plugins/iCheck/icheck.min.js");?>></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });

    $('#lost-pass').click( function () {
      alert('Tidak ada langkah khusus! Silahkan kirim email permintaan reset kata sandi ke kanwil16.djpbkalbar@kemenkeu.go.id.');
    });
  });
</script>
</body>
</html>
