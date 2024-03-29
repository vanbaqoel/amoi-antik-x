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
          <?php
            if ($this->session->crud_locked) {
          ?>
          <hr />
          <span class="text-danger">
            <h4><i class="fa fa-exclamation-circle"></i> Perhatian</h4>
            <?= $this->session->name ?> saat ini sedang berada dalam masa penilaian Montik. Oleh karena itu, semua fungsi rekam, ubah, dan hapus dinonaktifkan sementara waktu untuk menjaga konsistensi data.
          </span>
        <?php } ?>
        </div>

      </div>

      <div class="row margin">
        <div class="col-md-6">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Kondisi</h3>
              <div class="box-tools pull-right">
                <select class="form-control select2" id="cboKondisi">
                  <option value="0">Semua</option>
                  <option value="1">PC</option>
                  <option value="2">Laptop</option>
                  <option value="3">LCD Projector</option>
                  <option value="4">Scanner</option>
                  <option value="5">UPS</option>
                  <option value="6">Printer</option>
                  <option value="7">Server</option>
                  <option value="8">CCTV</option>
                  <option value="9">Mesin Absensi</option>
                  <option value="10">Mesin Antrian</option>
                  <option value="11">Facsimile</option>
                  <option value="12">Televisi</option>
                </select>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-8 kondisi-area">
                  <div class="chart-responsive">
                    <canvas id="pieKondisi" height="150"></canvas>
                  </div>
                  <!-- ./chart-responsive -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                  <ul class="chart-legend clearfix">
                    <li><i class="fa fa-circle-o" style="color: LightSeaGreen"></i> Baik</li>
                    <li><i class="fa fa-circle-o" style="color: LightSkyBlue"></i> Kurang Baik</li>
                    <li><i class="fa fa-circle-o" style="color: Khaki"></i> Rusak Ringan</li>
                    <li><i class="fa fa-circle-o" style="color: LightCoral"></i> Rusak Berat</li>
                  </ul>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <div class="col-md-6">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Standar Spesifikasi</h3>
              <div class="box-tools pull-right">
                <select class="form-control select2" id="cboSpek">
                  <option value="0">Semua</option>
                  <option value="1">PC</option>
                  <option value="2">Laptop</option>
                  <option value="3">LCD Projector</option>
                  <option value="4">Scanner</option>
                  <option value="5">UPS</option>
                  <option value="6">Printer</option>
                  <option value="7">Server</option>
                  <option value="8">CCTV</option>
                  <option value="9">Mesin Absensi</option>
                  <option value="10">Mesin Antrian</option>
                  <option value="11">Facsimile</option>
                  <option value="12">Televisi</option>
                </select>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-8 spek-area">
                  <div class="chart-responsive">
                    <canvas id="pieSpek" height="150"></canvas>
                  </div>
                  <!-- ./chart-responsive -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                  <ul class="chart-legend clearfix">
                    <li><i class="fa fa-circle-o" style="color: LightSeaGreen"></i> Sudah Standar</li>
                    <li><i class="fa fa-circle-o" style="color: LightCoral"></i> Belum Standar</li>
                  </ul>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>
      <div class="row margin">
        <div class="col-md-6">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Join Domain</h3>
              <div class="box-tools pull-right">
                <select class="form-control select2" id="cboJondo">
                  <option value="0">Semua</option>
                  <option value="1">PC</option>
                  <option value="2">Laptop</option>
                </select>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-8 jondo-area">
                  <div class="chart-responsive">
                    <canvas id="pieJondo" height="150">
                    </canvas>
                  </div>
                  <!-- ./chart-responsive -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                  <ul class="chart-legend clearfix">
                    <li><i class="fa fa-circle-o" style="color: LightSeaGreen"></i> Sudah Join</li>
                    <li><i class="fa fa-circle-o" style="color: LightCoral"></i> Belum Join</li>
                  </ul>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <div class="col-md-6">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">OS Genuine</h3>
              <div class="box-tools pull-right">
                <select class="form-control select2" id="cboOS">
                  <option value="0">Semua</option>
                  <option value="1">PC</option>
                  <option value="2">Laptop</option>
                  <option value="3">Server</option>
                </select>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-8 os-area">
                  <div class="chart-responsive">
                    <canvas id="pieOS" height="150"></canvas>
                  </div>
                  <!-- ./chart-responsive -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                  <ul class="chart-legend clearfix">
                    <li><i class="fa fa-circle-o" style="color: LightSeaGreen"></i> Genuine</li>
                    <li><i class="fa fa-circle-o" style="color: LightCoral"></i> Tidak Genuine</li>
                  </ul>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-body -->
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
<!-- Slimscroll -->
<script src=<?= base_url("bower_components/jquery-slimscroll/jquery.slimscroll.min.js");?>></script>
<!-- FastClick -->
<script src=<?= base_url("bower_components/fastclick/lib/fastclick.js");?>></script>
<!-- AdminLTE App -->
<script src=<?= base_url("dist/js/adminlte.min.js");?>></script>
<!-- ChartJS -->
<script src=<?= base_url("bower_components/chart.js/Chart.js"); ?>></script>
<!-- ChartJS -->
<!-- <script src=<?= base_url("bower_components/chart.js/ChartNew.js"); ?>></script> -->

<!-- Page Script -->
<script src="<?= base_url(); ?>dist/js/amoi/dashboard.js"></script>

</body>
</html>
