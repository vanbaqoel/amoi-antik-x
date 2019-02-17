<?php $this->load->view('header_view.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-video-camera"></i> - RIWAYAT PEMELIHARAAN
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box box-solid">
        <div class="box-body">
          <dl class="dl-horizontal">
            <dt>Jenis Perangkat</dt> <dd><?= $desc ?></dd>
            <dt>ID Perangkat</dt> <dd><?= $id ?></dd>
          </dl>
        </div>
      </div>
      <div class="clearfix">
        <div class="pull-right tableTools-container"></div>
      </div>
      <div>
        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th>No.</th>
              <th>ID</th>
              <th>Rekanan</th>
              <th>Tgl. Mulai</th>
              <th>Tgl. Selesai</th>
              <th>Uraian</th>
              <th class="no-export">Aksi</th>
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

<?php $this->load->view('footer_view.php'); ?>

<!-- Page Script -->
<script type="text/javascript">
  var kdp = '<?= $kode ?>';
  var idp = '<?= $id ?>';
  var cl = '<?= $this->session->crud_locked; ?>';
  var sname = '<?= strtoupper($this->session->name); ?>';
</script>
<script src="<?= base_url(); ?>dist/js/amoi/riwayat.js"></script>

</body>
</html>
