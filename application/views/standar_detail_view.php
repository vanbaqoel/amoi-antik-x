<?php $this->load->view('header_view'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-list"></i> - <?= urldecode($nm_unit) . " - " . urldecode($status_desc); ?>
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
                // PC
                case 1: ?>
                  <th>NUP</th>
                  <th>Merek/Tipe</th>
                  <th>Processor</th>
                  <th class="hidecol">astd</th>
                  <th>Storage</th>
                  <th class="hidecol">bstd</th>
                  <th>RAM</th>
                  <th class="hidecol">cstd</th>
                  <th>NIC</th>
                  <th class="hidecol">dstd</th>
                  <th>Optical</th>
                  <th class="hidecol">estd</th>
                  <th>Lokasi</th>
            <?php
                  break;
                // Laptop/Notebook
                case 2: ?>
                  <th>NUP</th>
                  <th>Merek/Tipe</th>
                  <th>Processor</th>
                  <th class="hidecol">astd</th>
                  <th>Storage</th>
                  <th class="hidecol">bstd</th>
                  <th>RAM</th>
                  <th class="hidecol">cstd</th>
                  <th>NIC</th>
                  <th class="hidecol">dstd</th>
                  <th>Wifi</th>
                  <th class="hidecol">estd</th>
                  <th>Lokasi</th>
            <?php
                  break;
                // LCD Projector
                case 3: ?>
                  <th>NUP</th>
                  <th>Merek/Tipe</th>
                  <th>Resolusi</th>
                  <th class="hidecol">astd</th>
                  <th>Brightness</th>
                  <th class="hidecol">bstd</th>
                  <th>Contrast Ratio</th>
                  <th class="hidecol">cstd</th>
                  <th>Aspect Ratio</th>
                  <th class="hidecol">dstd</th>
                  <th>Lokasi</th>
            <?php
                  break;
                // Scanner
                case 4: ?>
                  <th>NUP</th>
                  <th>Merek/Tipe</th>
                  <th>Scan Speed</th>
                  <th class="hidecol">astd</th>
                  <th>Bit Depth</th>
                  <th class="hidecol">bstd</th>
                  <th>Doc. Size</th>
                  <th class="hidecol">cstd</th>
                  <th>Interface</th>
                  <th class="hidecol">dstd</th>
                  <th>Sent Speed</th>
                  <th class="hidecol">estd</th>
                  <th>Lokasi</th>
            <?php
                  break;
                // UPS
                case 5: ?>
                  <th>NUP</th>
                  <th>Merek/Tipe</th>
                  <th>Output Power Capacity</th>
                  <th class="hidecol">astd</th>
                  <th>Backup Time HL</th>
                  <th class="hidecol">bstd</th>
                  <th>Backup Time FL</th>
                  <th class="hidecol">cstd</th>
                  <th>Lokasi</th>
            <?php
                  break;
                // Printer
                case 6: ?>
                  <th>NUP</th>
                  <th>Merek/Tipe</th>
                  <th>Kategori</th>
                  <th>Printing Method</th>
                  <th class="hidecol">astd</th>
                  <th>Print Speed</th>
                  <th class="hidecol">bstd</th>
                  <th>Media Size</th>
                  <th class="hidecol">cstd</th>
                  <th>Connectivity</th>
                  <th class="hidecol">dstd</th>
                  <th>Lokasi</th>
            <?php
                  break;
                // Komputer Server
                case 7: ?>
                  <th>NUP</th>
                  <th>Merek/Tipe</th>
                  <th>Jenis</th>
                  <th class="hidecol">astd</th>
                  <th>Jumlah Processor</th>
                  <th class="hidecol">bstd</th>
                  <th>Jumlah Core</th>
                  <th class="hidecol">cstd</th>
                  <th>Storage</th>
                  <th class="hidecol">dstd</th>
                  <th>RAM</th>
                  <th class="hidecol">estd</th>
                  <th>Lokasi</th>
            <?php
                  break;
                // CCTV
                case 8: ?>
                  <th>NUP</th>
                  <th>Merek/Tipe</th>
                  <th>Frame Rate</th>
                  <th class="hidecol">astd</th>
                  <th>Jumlah Channel</th>
                  <th class="hidecol">bstd</th>
                  <th>Harddisk</th>
                  <th class="hidecol">cstd</th>
                  <th>Lokasi</th>
            <?php
                  break;
                // Mesin Absensi
                case 9: ?>
                  <th>NUP</th>
                  <th>Merek/Tipe</th>
                  <th>User Capacity</th>
                  <th class="hidecol">astd</th>
                  <th>Record Capacity</th>
                  <th class="hidecol">bstd</th>
                  <th>Recognition Identification</th>
                  <th class="hidecol">cstd</th>
                  <th>Lokasi</th>
            <?php
                  break;
                // Mesin Antrian
                case 10: ?>
                  <th>NUP</th>
                  <th>Merek/Tipe</th>
                  <th>Merek/Tipe</th>
                  <th class="hidecol">astd</th>
                  <th>Counter Support</th>
                  <th class="hidecol">bstd</th>
                  <th>Tickect Button</th>
                  <th class="hidecol">cstd</th>
                  <th>Lokasi</th>
            <?php
                  break;
                // Facsimile
                case 11: ?>
                  <th>NUP</th>
                  <th>Merek/Tipe</th>
                  <th>Kecepatan Fax</th>
                  <th class="hidecol">astd</th>
                  <th>Lokasi</th>
            <?php
                  break;
                // Televisi
                case 12: ?>
                  <th>NUP</th>
                  <th>Merek/Tipe</th>
                  <th>Tipe Layar</th>
                  <th class="hidecol">astd</th>
                  <th>Ukuran Layar</th>
                  <th>Lokasi</th>
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
