<?php include('header_view.php'); ?>

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
        <div class="row">
          <form class="" id="my_form">
            <div class="col-xs-12 col-sm-6">
              <div class="space visible-xs"></div>
              <div class="profile-user-info profile-user-info-striped">
                <div class="profile-info-row form-group">
                  <label class="profile-info-name control-label"> Nama Pengguna </label>

                  <div class="profile-info-value col-xs-12">
                    <input type="text" class="form-control" disabled value="<?= $this->session->username; ?>">
                  </div>
                </div>

                <div class="profile-info-row form-group">
                  <label class="profile-info-name control-label" for="txtOldPass"> Kata Sandi Lama </label>

                  <div class="profile-info-value col-xs-12">
                    <input type="password" class="form-control" id="txtOldPass" name="txtOldPass">
                  </div>
                </div>

                <div class="profile-info-row form-group">
                  <label class="profile-info-name control-label" for="txtNewPass0"> Kata Sandi Baru </label>

                  <div class="profile-info-value col-xs-12">
                    <input type="password" class="form-control" id="txtNewPass0" name="txtNewPass0">
                  </div>
                </div>
                <div class="profile-info-row form-group">
                    <label class="profile-info-name control-label" for="txtNewPass1"> Ketik Ulang Kata Sandi Baru </label>

                    <div class="profile-info-value col-xs-12">
                      <input type="password" class="form-control" id="txtNewPass1" name="txtNewPass1">
                    </div>
                </div>
              </div>

              <br />
              <div class="text-center">
                <button type="button" class="btn btn-primary" onclick="save()"><i class="fa fa-save"></i> &nbsp; Simpan</button>
                <button type="button" class="btn btn-default" onclick="bersih()"><i class="fa fa-eraser"></i> &nbsp; Bersihkan</button>
              </div>
            </div>
          </form>
        </div>
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
