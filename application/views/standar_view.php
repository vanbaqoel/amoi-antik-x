<?php include('header_view.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-check-square-o"></i> - PEMENUHAN STANDAR
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="clearfix">
        <div class="pull-right tableTools-container"></div>
      </div>
      <div>
        <table id="standar-table" class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th>KODE UNIT</th>
              <th>NAMA UNIT</th>
              <th>JENIS PERANGKAT</th>
              <th>A</th>
              <th>B</th>
              <th>C</th>
              <th>D</th>
              <th>E = A - D</th>
              <th>F = B - D</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
      <hr>
      <dl>
        <dt>Catatan :</dt>
        <dd>A = Jumlah Perangkat yang Bisa Digunakan Bekerja (Selain PC SPAN)</dd>
        <dd>B = Jumlah Perangkat yang Memenuhi Standar Spesifikasi</dd>
        <dd>C = Jumlah Perangkat yang Tidak Memenuhi Standar Spesifikasi</dd>
        <dd>D = Standar Jumlah</dd>
        <dd>E = Kelebihan (+)/Kekurangan (-) Perangkat yang Bisa Digunakan Bekerja</dd>
        <dd>F = Kelebihan (+)/Kekurangan (-) Perangkat Standar</dd>
      </dl>

      <!-- /.modal -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include('footer_view.php'); ?>

<script src="<?= base_url(); ?>bower_components/datatables-rowgroup/dataTables.rowGroup.min.js"></script>

<!-- Page Script -->
<script type="text/javascript"> var sname = '<?= $this->session->name; ?>';</script>
<script src="<?= base_url(); ?>dist/js/amoi/standar.js"></script>

</body>
</html>
