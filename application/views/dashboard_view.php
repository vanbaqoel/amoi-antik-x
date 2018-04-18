<?php include('header_view.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-dashboard"></i> - DASHBOARD
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="pad margin no-print">
        <div class="callout callout-primary" style="margin-bottom: 0!important;">
          <h4><i class="fa fa-comments"></i> Selamat Datang</h4>
          Aplikasi amoi-antik merupakan aplikasi yang digunakan untuk memonitor data spesifikasi dan jumlah perangkat TIK yang ada di Kanwil/KPPN lingkup Provinsi Kalimantan Barat. Fungsi yang tercakup dalam aplikasi ini adalah pemetaan standardisasi perangkat TIK, monitoring kepatuhan join domain, serta monitoring penggunaan komputer personal/server/laptop yang terhubung dengan jaringan internal Kementerian Keuangan.
        </div>
      </div>

      <div class="row margin">
        <div class="col-md-4">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Join Domain</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-8">
                  <div class="chart-responsive">
                    <canvas id="pieChart" height="150"></canvas>
                  </div>
                  <!-- ./chart-responsive -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                  <ul class="chart-legend clearfix">
                    <li><i class="fa fa-circle-o text-green"></i> Sudah</li>
                    <li><i class="fa fa-circle-o text-red"></i> Belum</li>
                  </ul>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="#">Server
                  <span class="pull-right text-red" id="jondo-server"></span></a></li>
                <li><a href="#">Personal Computer <span class="pull-right text-green" id="jondo-pc"></span></a>
                </li>
                <li><a href="#">Laptop/Notebook
                  <span class="pull-right text-yellow" id="jondo-laptop"></span></a></li>
              </ul>
            </div>
            <!-- /.footer -->
          </div>
        </div>

        <div class="col-md-4">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Standar Jumlah</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="barChart" height="150"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="#">Server
                  <span class="pull-right text-red" id="jumlah-server"></span></a></li>
                <li><a href="#">Personal Computer <span class="pull-right text-green" id="jumlah-pc"></span></a>
                </li>
                <li><a href="#">Laptop/Notebook
                  <span class="pull-right text-yellow" id="jumlah-laptop"></span></a></li>
              </ul>
            </div>
            <!-- /.footer -->
          </div>
        </div>

        <div class="col-md-4">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Standar Spesifikasi</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-8">
                  <div class="chart-responsive">
                    <canvas id="pieSpek" height="150"></canvas>
                  </div>
                  <!-- ./chart-responsive -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                  <ul class="chart-legend clearfix">
                    <li><i class="fa fa-circle-o text-red"></i> Belum Standar</li>
                    <li><i class="fa fa-circle-o text-green"></i> Standar</li>
                  </ul>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="#">Server
                  <span class="pull-right text-red" id="spek-server"></span></a></li>
                <li><a href="#">Personal Computer <span class="pull-right text-green" id="spek-pc"></span></a>
                </li>
                <li><a href="#">Laptop/Notebook
                  <span class="pull-right text-yellow" id="spek-laptop"></span></a></li>
              </ul>
            </div>
            <!-- /.footer -->
          </div>
        </div>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.0.0
    </div>
    <strong>Copyright &copy; 2017-2018 <a href="https://adminlte.io">Kanwil DJPb Prov. Kalbar</a>.</strong> &nbsp; All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src=<?= base_url("bower_components/jquery/dist/jquery.min.js");?>></script>
<!-- Bootstrap 3.3.7 -->
<script src=<?= base_url("bower_components/bootstrap/dist/js/bootstrap.min.js");?>></script>
<!-- Select2 -->
<script src=<?= base_url("bower_components/select2/dist/js/select2.full.min.js");?>></script>
<!-- DataTables -->
<!--<script src=<?= base_url("bower_components/datatables.net/js/jquery.dataTables.min.js");?>></script> -->
<!-- <script src=<?= base_url("bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js");?>></script> -->
<!-- Slimscroll -->
<script src=<?= base_url("bower_components/jquery-slimscroll/jquery.slimscroll.min.js");?>></script>
<!-- FastClick -->
<script src=<?= base_url("bower_components/fastclick/lib/fastclick.js");?>></script>
<!-- AdminLTE App -->
<script src=<?= base_url("dist/js/adminlte.min.js");?>></script>
<!-- iCheck -->
<script src=<?= base_url("plugins/iCheck/icheck.min.js");?>></script>
<!-- ChartJS -->
<script src=<?= base_url("bower_components/chart.js/Chart.js"); ?>></script>
<!-- ChartJS -->
<!-- <script src=<?= base_url("bower_components/chart.js/ChartNew.js"); ?>></script> -->

<script src="<?= base_url(); ?>bower_components/datatables.net/1.10.13/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>bower_components/datatables.net-bs/jquery.dataTables.bootstrap.min.js"></script> <!-- Somehow we still need this -->
<script src="<?= base_url(); ?>bower_components/datatables-buttons-1.2.4/dataTables.buttons.min.js"></script>
<script src="<?= base_url(); ?>bower_components/datatables-buttons-1.2.4/buttons.flash.min.js"></script>
<script src="<?= base_url(); ?>bower_components/datatables-buttons-1.2.4/buttons.html5.min.js"></script>
<script src="<?= base_url(); ?>bower_components/datatables-buttons-1.2.4/buttons.print.min.js"></script>
<!-- <script src="<?= base_url(); ?>bower_components/datatables-buttons-1.2.4/buttons.colVis.min.js"></script> -->
<script src="<?= base_url(); ?>bower_components/jszip-2.5.0/jszip.min.js"></script>
<script src="<?= base_url(); ?>bower_components/pdfmake-0.1.18/pdfmake.min.js"></script>
<script src="<?= base_url(); ?>bower_components/pdfmake-0.1.18/vfs_fonts.js"></script>

<!-- Page Script -->
<script src="<?= base_url(); ?>dist/js/amoi/dashboard.js"></script>

</body>
</html>
