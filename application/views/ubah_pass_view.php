<?php include('header_view.php'); ?>
<style type="text/css">
  .form-control-feedback{
    z-index: -1;
  }
</style>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-desktop"></i> - UBAH KATA SANDI
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="clearfix">
        <form class="" id="my_form" style="max-width: 400px; margin: 0 auto;">
          <div class="row" >
            <div class="col-xs-12">
              <div class="form-group input-group">
                <span class="input-group-addon input-label" style="min-width: 124px">Kata Sandi Lama</span>
                <input type="password" class="form-control" id="txtLama" name="txtLama">
                <span class="input-group-addon togpass" data-showpass="0"><i class="fa fa-eye"></i></span>
              </div>
            </div>
            <div class="col-xs-12">
              <div class="form-group input-group">
                <span class="input-group-addon input-label" style="min-width: 124px">Kata Sandi Baru</span>
                <input type="password" class="form-control" id="txtBaru" name="txtBaru">
                <span class="input-group-addon togpass" data-showpass="0"><i class="fa fa-eye"></i></span>
              </div>
            </div>
            <div class="col-xs-12">
              <div class="form-group input-group">
                <span class="input-group-addon input-label" style="min-width: 124px">Konfirmasi<br />Kata Sandi Baru</span>
                <input type="password" class="form-control" id="txtBaru1" name="txtBaru1" style="height: 42px;"></input>
                <span class="input-group-addon togpass" data-showpass="0"><i class="fa fa-eye"></i></span>
              </div>
            </div>
          <div class="row">
            <div class="form-group">
              <div class="col-xs-12 text-center">
                <div id="messages"></div>
              </div>
            </div>
          </div>
          <div class="row">
          </div>
          <br />
          <div class="text-center">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> &nbsp; Simpan</button>
            <button type="button" class="btn btn-default" onclick="bersih()"><i class="fa fa-eraser"></i> &nbsp; Bersihkan</button>
          </div>
        </form>
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include('footer_view.php'); ?>

<!-- Page Script -->
<script src="<?= base_url(); ?>dist/js/amoi/ubah_pass.js"></script>

</body>
</html>
