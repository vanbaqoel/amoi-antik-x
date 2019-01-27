<?php $this->load->view('header_view.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-globe"></i> <span id="page-title"> <?= $title ?> MEDIA ONLINE</span>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="clearfix" >
        <form style="max-width: 400px; margin: 0 auto;">
          <div class="row" >
            <div class="col-xs-12">
              <div class="form-group input-group">
                <span class="input-group-addon input-label">Platform</span>
                <select class="form-control select2" name="cboPlatform">
                  <option></option>
                  <option value='1'>MICROWEB</option>
                  <option value='2'>TWITTER</option>
                  <option value='3'>FACEBOOK</option>
                  <option value='4'>INSTAGRAM</option>
                  <option value='5'>YOUTUBE</option>
                </select>
              </div>
            </div>
            <div class="col-xs-12">
              <div class="form-group input-group">
                <span class="input-group-addon input-label">Akun/URL</span>
                <textarea type="text" class="form-control" id="txtAkun" name="txtAkun" style="resize: none; height: 100px;"></textarea>
              </div>
            </div>
          </div>
          <div class="row" ></div>
          <div class="form-group text-center">
            <div class="btn-group">
            <a href="#" class="btn btn-default btn-app" id="btnSimpan"><i class="fa fa-save"></i><span>Simpan</span></a>
            <a href="#" class="btn btn-default btn-app" id="btnReset"><i class="fa fa-refresh"></i><span>Reset</span></a>
            <a href="<?= base_url('medsos') ?>" class="btn btn-default btn-app"><i class="fa fa-times"></i><span>Batal</span></a>
          </div>
        </form>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php $this->load->view('footer_view'); ?>

<!-- Page Script -->
<script type="text/javascript">
  var sk = '<?= $this->session->kd_unit; ?>';
  var save_method = '<?= $save_method; ?>';
</script>
<script src="<?= base_url(); ?>dist/js/amoi/medsos_ru.js"></script>

</body>
</html>
