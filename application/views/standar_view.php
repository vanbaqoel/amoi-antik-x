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
              <th>C (B - A)</th>
              <th>D</th>
              <th>E (D - A)</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
      <hr>
      <dl>
        <dt>Catatan :</dt>
        <dd>A : Jumlah standar sesuai dengan rumus pada SE-32/PB/2016</dd>
        <dd>B : Jumlah saat ini yang dapat digunakan untuk bekerja</dd>
        <dd>C : Selisih jumlah saat ini dengan jumlah standar; (-) Kekurangan, (+) Kelebihan</dd>
        <dd>D : Jumlah dari B yang memenuhi spesifikasi minimal sesuai dengan SE-32/PB/2016</dd>
        <dd>E : Selisih jumlah yang memenuhi spesifikasi minimal dengan jumlah standar; (-) Kekurangan, (+) Kelebihan</dd>
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
