<?php include('header_view.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-desktop"></i> - CEK HOST
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="clearfix">
        <div class="form-group">
          <form class="form-inline">
            <div id="unit" class="col-sm-3">
              <select class="form-control select2" name="cboUnit" style="width: 100%;">
                <option value="K17">KANWIL DJPB PROV. KALBAR</option>
                <option value="042">KPPN PONTIANAK</option>
                <option value="079">KPPN SINTANG</option>
                <option value="093">KPPN SINGKAWANG</option>
                <option value="094">KPPN KETAPANG</option>
                <option value="117">KPPN PUTUSSIBAU</option>
                <option value="167">KPPN SANGGAU</option>
              </select>
            </div>
            <button id="btnCek" type="button" class="btn btn-default" onclick="cek_host()"><i class="fa fa-search"></i>&nbsp;&nbsp;Cek</button>
          </form>
        </div>
      </div>
      <div class="clearfix">
        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th>No.</th>
              <th>Alamat IP</th>
              <th>Nama Komputer</th>
              <th>Lokasi</th>
              <th>Status</th>
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

<?php include('footer_view.php'); ?>

<!-- Page Script -->
<script src="<?= base_url(); ?>dist/js/amoi/cek_host.js"></script>

</body>
</html>
