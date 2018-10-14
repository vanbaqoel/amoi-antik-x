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
  <!-- DataTables -->
  <link rel="stylesheet" href=<?= base_url("bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css");?>>
  <!-- Select2 -->
  <link rel="stylesheet" href=<?= base_url("bower_components/select2/dist/css/select2.min.css");?>>
  <!-- Bootstrap Validator -->
  <link rel="stylesheet" href=<?= base_url("bower_components/bootstrap-validator/bootstrapValidator.min.css");?>>
  <!-- Animation -->
  <link rel="stylesheet" href=<?= base_url("bower_components/bootstrap-notify/animate.css");?>>
  <!-- Theme style -->
  <link rel="stylesheet" href=<?= base_url("dist/css/AdminLTE.css");?>>
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href=<?= base_url("dist/css/skins/_all-skins.min.css");?>>
  <!-- iCheck -->
  <link rel="stylesheet" href=<?= base_url("plugins/iCheck/flat/blue.css");?>>
  <!-- Custom -->
  <link rel="stylesheet" href=<?= base_url("dist/css/amoi-custom.css");?>>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-collapse">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href=<?= base_url();?> class="logo">
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>amoi</b>-antik</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src=<?= base_url("images/logo.png");?> class="user-image" alt="User Image">
              <span class="hidden-xs"><?= $this->session->name; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src=<?= base_url("images/logo.png");?> class="img-circle" alt="User Image">

                <p>
                  <?= $this->session->name; ?>
                  <small>Admin Sejak Nov. 2017</small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="<?= base_url("autentikasi/do_logout");?>" class="btn btn-default btn-flat">Keluar</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">NAVIGASI UTAMA</li>
        <li>
          <a href="<?= base_url() ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="header">DAFTAR</li>
        <li>
          <a href="<?= base_url("pc") ?>">
            <i class="fa fa-desktop"></i> <span>PC</span>
          </a>
        </li>
        <!-- <li class="treeview">
          <a href="#">
            <i class="fa fa-desktop"></i>
            <span>PC</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= base_url("pcss") ?>"><i class="fa fa-circle-o"></i> SPAN/SAKTI</a></li>
            <li><a href="<?= base_url("pcnss") ?>"><i class="fa fa-circle-o"></i> Non SPAN/SAKTI</a></li>
          </ul>
        </li> -->
        <li>
          <a href="<?= base_url("laptop") ?>">
            <i class="fa fa-laptop"></i> <span>Laptop</span>
          </a>
        </li>

        <li>
          <a href="<?= base_url("projector") ?>">
            <i class="fa fa-video-camera"></i> <span>LCD Projector</span>
          </a>
        </li>

        <li>
          <a href="<?= base_url("scanner") ?>">
            <i class="fa fa-picture-o"></i> <span>Scanner</span>
          </a>
        </li>

        <li>
          <a href="<?= base_url("ups") ?>">
            <i class="fa fa-battery-half"></i> <span>UPS</span>
          </a>
        </li>

        <li>
          <a href="<?= base_url("printer") ?>">
            <i class="fa fa-print"></i> <span>Printer</span>
          </a>
        </li>

        <li>
          <a href="<?= base_url("server") ?>">
            <i class="fa fa-server"></i> <span>Server</span>
          </a>
        </li>

        <li>
          <a href="<?= base_url("cctv") ?>">
            <i class="fa fa-eye"></i> <span>CCTV</span>
          </a>
        </li>

        <li>
          <a href="<?= base_url("absensi") ?>">
            <i class="fa fa-hand-paper-o"></i> <span>Mesin Absensi</span>
          </a>
        </li>

        <li>
          <a href="<?= base_url("antrian") ?>">
            <i class="fa fa-users"></i> <span>Mesin Antrian</span>
          </a>
        </li>

        <li>
          <a href="<?= base_url("fax") ?>">
            <i class="fa fa-phone"></i> <span>Facsimile</span>
          </a>
        </li>

        <li>
          <a href="<?= base_url("tv") ?>">
            <i class="fa fa-television"></i> <span>Televisi</span>
          </a>
        </li>

        <li class="header">SUMMARY</li>
        <li>
          <a href="<?= base_url("join_domain") ?>">
            <i class="fa fa-plug"></i> <span>Join Domain</span>
          </a>
        </li>
        <li>
          <a href="<?= base_url("standar") ?>">
            <i class="fa fa-check-square-o"></i> <span>Pemenuhan Standar</span>
          </a>
        </li>
        <li class="header">UTILITAS</li>
        <li>
          <a href="<?= base_url("nilai_spek") ?>">
            <i class="fa fa-check-square-o"></i> <span>Penilaian Standar</span>
          </a>
        </li>
        <!-- <li>
          <a href="<?= base_url("ubah_pass") ?>">
            <i class="fa fa-lock"></i> <span>Ubah Kata Sandi</span>
          </a>
        </li> -->
    <?php
      if ($this->session->kd_unit == '000') {
    ?>
        <li>
          <a href="<?= base_url("cek_host") ?>">
            <i class="fa fa-search"></i> <span>Cek Host</span>
          </a>
        </li>
    <?php } ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->