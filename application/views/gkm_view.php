<?php $this->load->view('header_view.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-book"></i> - GUGUS KENDALI MUTU TIK
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
              <th>ID</th>
              <th>Topik/Judul</th>
              <th>Tgl. Pelaksanaan</th>
              <th>Laporan/Dokumentasi</th>
              <th>Keterangan</th>
              <?php
                if($this->session->kd_unit == '000')
                    echo "<th>Kode Unit</th>";
              ?>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
      <!-- /.modal -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php $this->load->view('footer_view.php'); ?>

<!-- Page Script -->
<script type="text/javascript">
  var sk = '<?= $this->session->kd_unit; ?>';
  var sname = '<?= strtoupper($this->session->name); ?>';
</script>
<script src="<?= base_url(); ?>dist/js/amoi/gkm.js"></script>

</body>
</html>
