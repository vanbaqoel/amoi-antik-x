<?php $this->load->view('header_view.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-lightbulb-o"></i> <span id="page-title"> <?= $title ?> INOVASI TIK</span>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="clearfix" >
        <form style="max-width: 768px; margin: 0 auto;">
          <div class="row" >
            <div class="col-xs-12">
              <div class="form-group input-group">
                <span class="input-group-addon input-label">Judul</span>
                <input type="text" class="form-control" id="txtJudul" name="txtJudul">
              </div>
            </div>
            <div class="col-xs-12">
              <div class="form-group input-group">
                <span class="input-group-addon input-label">Deskripsi</span>
                <textarea type="text" class="form-control" id="txtDeskripsi" name="txtDeskripsi" style="resize: none; height: 100px;"></textarea>
              </div>
            </div>
            <div class="col-xs-12">
              <div class="form-group input-group">
                <span class="input-group-addon input-label">Lingkup</span>
                <select class="form-control select2" name="cboLingkup">
                  <option></option>
                  <option value='0'>INTERNAL</option>
                  <option value='1'>EKSTERNAL</option>
                </select>
              </div>
            </div>
            <div class="col-xs-12 col-sm-4">
              <div class="form-group input-group">
                <span class="input-group-addon input-label">Penerapan</span>
                <input type="date" class="form-control" id="txtTanggal" name="txtTanggal">
              </div>
            </div>
            <div class="col-xs-12">
              <div class="form-group input-group">
                <span class="input-group-addon input-label">Laporan/Dok</span>
                <input type="file" accept=".pdf" class="form-control" id="txtFile" name="txtFile">
              </div>
            </div>
            <div class="col-xs-12">
              <div class="form-group input-group">
                <span class="input-group-addon input-label">Keterangan</span>
                <textarea type="text" class="form-control" id="txtKeterangan" name="txtKeterangan" style="resize: none; height: 100px;"></textarea>
              </div>
          </div>
          <div class="row" ></div>
          <div class="form-group text-center">
            <div class="btn-group">
            <a href="#" class="btn btn-default btn-app" id="btnSimpan"><i class="fa fa-save"></i><span>Simpan</span></a>
            <a href="#" class="btn btn-default btn-app" id="btnReset"><i class="fa fa-refresh"></i><span>Reset</span></a>
            <a href="<?= base_url('inovasi') ?>" class="btn btn-default btn-app"><i class="fa fa-times"></i><span>Batal</span></a>
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
<script src="<?= base_url(); ?>dist/js/amoi/inovasi_ru.js"></script>

</body>
</html>
