<?php $this->load->view('header_view.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-desktop"></i> <span id="page-title"> <?= $title ?> SERVER </span>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="clearfix" >
        <form>
          <div class="row" >
            <div class="col-sm-6 col-md-3">
              <div class="form-group input-group">
                <span class="input-group-addon input-label">Kategori</span>
                <select class="form-control select2" name="cboKategori">
                  <option></option>
                  <?php
                    var_dump($ref);
                    foreach ($ref['r_kategori'] as $kategori) {
                      echo "<option value='".$kategori['kd_kategori']."'>".$kategori['deskripsi']."</option>";
                    }
                  ?>
                </select>
              </div>
            </div>
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

          </div>
          <div class="row">
            <div class="col-sm-6 col-md-3">
              <div class="form-group input-group">
                <span class="input-group-addon input-label">Jml Processor</span>
                <input type="number" class="form-control text-uppercase" id="txtJmlProcessor" name="txtJmlProcessor">
              </div>
            </div>
            <div class="col-sm-6 col-md-3">
              <div class="form-group input-group">
                <span class="input-group-addon input-label">Jml Core</span>
                <input type="number" class="form-control text-uppercase" id="txtJmlCore" name="txtJmlCore">
              </div>
            </div>
            <div class="col-sm-6 col-md-3">
              <div class="form-group input-group">
                <span class="input-group-addon input-label">Storage</span>
                <input type="number" class="form-control text-uppercase" id="txtStorage" name="txtStorage">
                <span class="input-group-addon">GB</span>
              </div>
            </div>
            <div class="col-sm-6 col-md-3">
              <div class="form-group input-group">
                <span class="input-group-addon input-label">RAM</span>
                <input type="number" class="form-control text-uppercase" id="txtRAM" name="txtRAM">
                <span class="input-group-addon">GB</span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6 col-md-3">
              <div class="form-group input-group">
                <span class="input-group-addon input-label">OS</span>
                <select class="form-control select2" name="cboOS">
                  <option></option>
                  <?php
                    var_dump($ref);
                    foreach ($ref['r_os'] as $os) {
                      echo "<option value='".$os['kd_os']."'>".$os['deskripsi']."</option>";
                    }
                  ?>
                </select>
              </div>
            </div>
            <div class="col-sm-6 col-md-3">
              <div class="form-group input-group">
                <span class="input-group-addon input-label">Edisi OS</span>
                <select class="form-control select2" name="cboEdisiOS">
                  <option></option>
                  <?php
                    var_dump($ref);
                    foreach ($ref['r_osedisi'] as $osedisi) {
                      echo "<option value='".$osedisi['kd_osedisi']."'>".$osedisi['deskripsi']."</option>";
                    }
                  ?>
                </select>
              </div>
            </div>
            <div class="col-sm-6 col-md-3">
              <div class="form-group input-group">
                <span class="input-group-addon input-label">Orisinalitas OS</span>
                <select class="form-control select2" name="cboOrisinalitasOS">
                  <option></option>
                  <option value='0'>TIDAK ORIGINAL/GENUINE</option>
                  <option value='1'>ORIGINAL/GENUINE</option>
                </select>
              </div>
            </div>
            <div class="col-sm-6 col-md-3">
              <div class="form-group input-group">
                <span class="input-group-addon input-label">Office</span>
                <select class="form-control select2" name="cboOffice">
                  <option></option>
                  <?php
                    var_dump($ref);
                    foreach ($ref['r_office'] as $office) {
                      echo "<option value='".$office['kd_office']."'>".$office['deskripsi']."</option>";
                    }
                  ?>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6 col-md-3">
              <div class="form-group input-group">
                <span class="input-group-addon input-label">Antivirus</span>
                <input type="text" class="form-control text-uppercase" id="txtAntivirus" name="txtAntivirus">
              </div>
            </div>
            <div class="col-sm-6 col-md-3">
              <div class="form-group input-group">
                <span class="input-group-addon input-label">Koneksi</span>
                <select class="form-control select2" name="cboKoneksi">
                  <option></option>
                  <?php
                    var_dump($ref);
                    foreach ($ref['r_koneksi'] as $koneksi) {
                      echo "<option value='".$koneksi['kd_koneksi']."'>".$koneksi['deskripsi']."</option>";
                    }
                  ?>
                </select>
              </div>
            </div>
            <div class="col-sm-6 col-md-3">
              <div class="form-group input-group">
                <span class="input-group-addon input-label">Hostname</span>
                <input type="text" class="form-control text-uppercase" id="txtHostName" name="txtHostName">
              </div>
            </div>
            <div class="col-sm-6 col-md-3">
              <div class="form-group input-group">
                <span class="input-group-addon input-label">Alamat IP</span>
                <input type="text" class="form-control text-uppercase" id="txtAlamatIP" name="txtAlamatIP">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6 col-md-3">
              <div class="form-group input-group">
                <span class="input-group-addon input-label">Join Domain</span>
                <select class="form-control select2" name="cboJoinDomain">
                  <option></option>
                  <option value='0'>BELUM</option>
                  <option value='1'>SUDAH</option>
                </select>
              </div>
            </div>
            <div class="col-sm-6 col-md-3">
              <div class="form-group input-group">
                <span class="input-group-addon input-label">Kode Barang</span>
                <input type="text" class="form-control text-uppercase" id="txtKodeBarang" name="txtKodeBarang">
              </div>
            </div>
            <div class="col-sm-6 col-md-3">
              <div class="form-group input-group">
                <span class="input-group-addon input-label">NUP</span>
                <input type="number" class="form-control text-uppercase" id="txtNUP" name="txtNUP">
              </div>
            </div>
            <div class="col-sm-6 col-md-3">
              <div class="form-group input-group">
                <span class="input-group-addon input-label">Thn Perolehan</span>
                <input type="number" class="form-control text-uppercase" id="txtTahunPerolehan" name="txtTahunPerolehan">
              </div>
            </div>
          </div>
          <div class="row">
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
            <div class="col-sm-6 col-md-3">
              <div class="form-group input-group">
                <span class="input-group-addon input-label">NIP PIC</span>
                <input type="text" class="form-control text-uppercase" id="txtNIP" name="txtNIP">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <div class="form-group input-group">
                <span class="input-group-addon input-label">Keterangan</span>
                <input type="text" class="form-control text-uppercase" id="txtKeterangan" name="txtKeterangan">
              </div>
            </div>
          </div>
            <div class="form-group text-center">
              <div class="btn-group">
              <a href="#" class="btn btn-default btn-app" id="btnSimpan"><i class="fa fa-save"></i><span>Simpan</span></a>
              <a href="#" class="btn btn-default btn-app" id="btnReset"><i class="fa fa-refresh"></i><span>Reset</span></a>
              <a href="<?= base_url('server') ?>" class="btn btn-default btn-app"><i class="fa fa-times"></i><span>Batal</span></a>
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
<script src="<?= base_url(); ?>dist/js/amoi/server_ru.js"></script>

</body>
</html>
