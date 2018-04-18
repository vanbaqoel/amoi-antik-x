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
            <?php
              switch ($kategori) {
                case 'SERVER': ?>
                  <th>Kategori</th>
                  <th>NUP</th>
                  <th>Merek</th>
                  <th>Tipe</th>
                  <th>Serial Number</th>
                  <th>Jenis</th>
                  <th>Jstd</th>
                  <th>Jumlah Processor</th>
                  <th>Pstd</th>
                  <th>Jumlah Core</th>
                  <th>Cstd</th>
                  <th>Storage</th>
                  <th>Sstd</th>
                  <th>RAM</th>
                  <th>rstd</th>
                  <th>Lokasi</th>
                  <th>Kode Unit</th>
            <?php
                  break;

                case 'PC': ?>
                  <th>Kategori</th>
                  <th>NUP</th>
                  <th>Merek</th>
                  <th>Tipe</th>
                  <th>Serial Number</th>
                  <th>Processor</th>
                  <th>Pstd</th>
                  <th>Storage</th>
                  <th>Sstd</th>
                  <th>RAM</th>
                  <th>rstd</th>
                  <th>NIC</th>
                  <th>nstd</th>
                  <th>Optical</th>
                  <th>ostd</th>
                  <th>Lokasi</th>
                  <th>Kode Unit</th>
            <?php
                  break;

                case 'LAPTOP': ?>
                  <th>Kategori</th>
                  <th>NUP</th>
                  <th>Merek</th>
                  <th>Tipe</th>
                  <th>Serial Number</th>
                  <th>Processor</th>
                  <th>Pstd</th>
                  <th>Storage</th>
                  <th>Sstd</th>
                  <th>RAM</th>
                  <th>rstd</th>
                  <th>NIC</th>
                  <th>nstd</th>
                  <th>Wifi</th>
                  <th>wstd</th>
                  <th>Lokasi</th>
                  <th>Kode Unit</th>
            <?php
                  break;
              }

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
  var kat = '<?= $kategori; ?>';
  var sd = '<?= $status_desc; ?>';
  var ku = '<?= $kd_unit; ?>';
  var nu = '<?= urldecode($nm_unit); ?>';
</script>
<script src="<?= base_url(); ?>dist/js/amoi/standar_detail.js"></script>

</body>
</html>
