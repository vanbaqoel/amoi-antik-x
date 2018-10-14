<?php $this->load->view('header_view.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-phone"></i> <span id="page-title"> <?= $title ?> FACSIMILE </span>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="clearfix" >
        <form>
          <div class="row" >
            <div class="col-sm-6 col-md-3">
              <div class="form-group input-group">
                <span class="input-group-addon input-label">Merek</span>
                <input type="text" class="form-control text-uppercase" id="txtMerek" name="txtMerek">
              </div>
            </div>
            <div class="col-sm-6 col-md-3">
              <div class="form-group input-group">
                <span class="input-group-addon input-label">Tipe</span>
                <input type="text" class="form-control text-uppercase" id="txtTipe" name="txtTipe">
              </div>
            </div>
            <div class="col-sm-6 col-md-3">
              <div class="form-group input-group">
                <span class="input-group-addon input-label">S/N</span>
                <input type="text" class="form-control text-uppercase" id="txtSN" name="txtSN">
              </div>
            </div>
            <div class="col-sm-6 col-md-3">
              <div class="form-group input-group">
                <span class="input-group-addon input-label">Kecepatan Fax</span>
                <input type="number" class="form-control text-uppercase" id="txtSpeed" name="txtSpeed" min="0" max="99">
                <span class="input-group-addon">S/P</span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6 col-md-3">
              <div class="form-group input-group">
                <span class="input-group-addon input-label">Kode Barang</span>
                <input type="text" class="form-control text-uppercase" id="txtKodeBarang" name="txtKodeBarang" maxlength="14">
              </div>
            </div>
            <div class="col-sm-6 col-md-3">
              <div class="form-group input-group">
                <span class="input-group-addon input-label">NUP</span>
                <input type="number" class="form-control text-uppercase" id="txtNUP" name="txtNUP" min="0" max="99">
              </div>
            </div>
            <div class="col-sm-6 col-md-3">
              <div class="form-group input-group">
                <span class="input-group-addon input-label">Thn Perolehan</span>
                <input type="number" class="form-control text-uppercase" id="txtTahunPerolehan" name="txtTahunPerolehan" min="2000" max="2099">
              </div>
            </div>
            <div class="col-sm-6 col-md-3">
              <div class="form-group input-group">
                <span class="input-group-addon input-label">Kondisi</span>
                <select class="form-control select2" name="cboKondisi">
                  <option></option>
                  <?php
                    var_dump($ref);
                    foreach ($ref['r_kondisi'] as $kondisi) {
                      echo "<option value='".$kondisi['kd_kondisi']."'>".$kondisi['deskripsi']."</option>";
                    }
                  ?>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6 col-md-3">
              <div class="form-group input-group">
                <span class="input-group-addon input-label">Status</span>
                <select class="form-control select2" name="cboStatus">
                  <option></option>
                  <?php
                    var_dump($ref);
                    foreach ($ref['r_status'] as $status) {
                      echo "<option value='".$status['kd_status']."'>".$status['deskripsi']."</option>";
                    }
                  ?>
                </select>
              </div>
            </div>
            <div class="col-sm-6 col-md-3">
              <div class="form-group input-group">
                <span class="input-group-addon input-label">Lokasi</span>
                <select class="form-control select2" name="cboLokasi">
                  <option></option>
                  <?php
                    var_dump($ref);
                    foreach ($ref['r_ruang'] as $ruang) {
                      echo "<option value='".$ruang['kd_ruang']."'>".$ruang['deskripsi']."</option>";
                    }
                  ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group input-group">
                <span class="input-group-addon input-label">Keterangan</span>
                <input type="text" class="form-control text-uppercase" id="txtKeterangan" name="txtKeterangan">
              </div>
            </div>
          </div>
          <div class="row">
          </div>
          <div class="row">
          </div>
            <div class="form-group text-center">
              <div class="btn-group">
              <a href="#" class="btn btn-default btn-app" id="btnSimpan"><i class="fa fa-save"></i><span>Simpan</span></a>
              <a href="#" class="btn btn-default btn-app" id="btnReset"><i class="fa fa-refresh"></i><span>Reset</span></a>
              <a href="<?= base_url('fax') ?>" class="btn btn-default btn-app"><i class="fa fa-times"></i><span>Batal</span></a>
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
<script src="<?= base_url(); ?>dist/js/amoi/fax_ru.js"></script>

</body>
</html>
