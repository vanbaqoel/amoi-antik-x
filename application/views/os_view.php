<?php include('header_view.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-windows"></i> - PENGGUNAAN SISTEM OPERASI
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="clearfix">
        <div class="pull-right tableTools-container"></div>
      </div>
      <div>
        <table id="os-table" class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th rowspan="2" class="">Kode Unit</th>
              <th rowspan="2" class="">Nama Unit</th>
              <th rowspan="2" class="">Jenis Perangkat</th>
              <th colspan="2" class="text-center">Jumlah Perangkat</th>
              <th colspan="4" class="text-center">Sistem Operasi</th>
              <th colspan="2" class="text-center">Orisinalitas</th>
            </tr>
            <tr>
              <th>A</th>
              <th>B</th>
              <th>Win XP</th>
              <th>Win 7</th>
              <th>Win 10</th>
              <th>Lainnya</th>
              <th>Genuine</th>
              <th>Not Genuine</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
      <hr>
      <dl>
        <dt>Catatan :</dt>
        <dd>A : Jumlah keseluruhan perangkat yang tercatat</dd>
        <dd>B : Jumlah perangkat yang digunakan untuk bekerja</dd>
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
<script src="<?= base_url(); ?>dist/js/amoi/os.js"></script>

</body>
</html>
