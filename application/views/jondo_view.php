<?php include('header_view.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-plug"></i> - Join Domain
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="clearfix">
        <div class="pull-right tableTools-container"></div>
      </div>
      <div>
        <table id="jondo-table" class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th rowspan="2" class="">Kode Unit</th>
              <th rowspan="2" class="">Nama Unit</th>
              <th rowspan="2" class="">Jenis Perangkat</th>
              <th colspan="3" class="text-center">Jumlah Perangkat</th>
              <th colspan="2" class="text-center">Perangkat Join Domain</th>
              <th colspan="4" class="text-center">Sistem Operasi</th>
            </tr>
            <tr>
              <th>A</th>
              <th>B</th>
              <th>C</th>
              <th>Sudah</th>
              <th>Belum</th>
              <th>Win XP</th>
              <th>Win 7</th>
              <th>Win 10</th>
              <th>Lainnya</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
      <hr>
      <dl>
        <dt>Catatan :</dt>
        <dd>A = PC/Laptop/Notebook Pada SIMAK BMN/SIPAT</dd>
        <dd>B = PC/Laptop/Notebook Yang Bisa Digunakan Bekerja</dd>
        <dd>C = PC/Laptop/Notebook Yang Tidak Bisa Digunakan Bekerja</dd>
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
<script src="<?= base_url(); ?>dist/js/amoi/jondo.js"></script>

</body>
</html>
