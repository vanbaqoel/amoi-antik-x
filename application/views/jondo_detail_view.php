<?php $this->load->view('header_view'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-list"></i> - <?= urldecode($nm_unit) . " - $status_desc"; ?>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="clearfix">
        <div class="pull-right tableTools-container"></div>
      </div>
      <div>
        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th>No.</th>
              <th>NUP</th>
              <th>Kategori</th>
              <th>Alamat IP</th>
              <th>Hostname</th>
              <th>Lokasi</th>
              <th>Keterangan</th>
              <?php
                if($this->session->kd_unit == '000')
                    echo "<th>Kode Unit</th>";
              ?>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php $this->load->view('footer_view'); ?>

<!-- Page Script -->
<script type="text/javascript">
  var sname = '<?= $this->session->name; ?>';
  var st = '<?= $status; ?>';
  var kat = '<?= $kategori; ?>';
  var sd = '<?= $status_desc; ?>';
  var ku = '<?= $kd_unit; ?>';
  var nu = '<?= urldecode($nm_unit); ?>';
</script>
<script src="<?= base_url(); ?>dist/js/amoi/jondo_detail.js"></script>

</body>
</html>
