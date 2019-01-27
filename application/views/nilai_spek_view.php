<?php include('header_view.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-desktop"></i> - PENILAIAN STANDAR PERANGKAT
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="clearfix">
        <div class="form-group">
          <form class="form-inline">
            <div id="unit" class="col-sm-3">
              <select class="form-control select2" name="cboUnit" id="cboUnit" style="width: 100%;">

    <?php
      if ($this->session->kd_unit == '000') {
    ?>
                <option value="000">SEMUA UNIT</option>
                <option value="K17">KANWIL DJPB PROV. KALBAR</option>
                <option value="042">KPPN PONTIANAK</option>
                <option value="079">KPPN SINTANG</option>
                <option value="093">KPPN SINGKAWANG</option>
                <option value="094">KPPN KETAPANG</option>
                <option value="117">KPPN PUTUSSIBAU</option>
                <option value="167">KPPN SANGGAU</option>
    <?php
      } else {
        echo "<option value='". $this->session->kd_unit ."'>". strtoupper($this->session->name) ."</option>";
      }
    ?>
              </select>
            </div>
            <button id="btnCek" type="button" class="btn btn-default" onclick="nilai_spek()" <?= ($this->session->crud_locked ? 'disabled' : '') ?>><i class="fa fa-search"></i>&nbsp;&nbsp;Proses</button>
          </form>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <i class="fa fa-info"></i>

              <h3 class="box-title">Info</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <dl id="info_text">

              </dl>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- ./col -->
      </div>
      <!-- ./row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include('footer_view.php'); ?>

<!-- Page Script -->
<script src="<?= base_url(); ?>dist/js/amoi/nilai_spek.js"></script>

</body>
</html>
