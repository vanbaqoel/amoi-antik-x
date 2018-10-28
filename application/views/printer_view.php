<?php $this->load->view('header_view.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-print"></i> - PRINTER
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="clearfix">
        <div class="pull-right tableTools-container"></div>
      </div>
      <div>
        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th>No.</th>
              <th>ID</th>
              <th>NUP</th>
              <th>Kategori</th>
              <th>Merek/Tipe</th>
              <th>Printing Method</th>
              <th>Print Speed</th>
              <th>Media Size</th>
              <th>Connectivity</th>
              <th>Kondisi</th>
              <th>Lokasi</th>
              <th>Keterangan</th>
              <?php
                if($this->session->kd_unit == '000')
                    echo "<th>Kode Unit</th>";
              ?>
              <th class="no-export">Aksi</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>

      <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Data Detil</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-xs-12">
                  <div class="box box-default box-solid">
                    <div class="box-header with-border">
                      <h3 class="box-title"> Info </h3>
                    </div>
                    <div class="box-body">
                      <div  id="printThis" class="profile-user-info profile-user-info-striped">
                        <div class="profile-info-row">
                          <div class="profile-info-name"> ID </div>
                          <div class="profile-info-value"><span id="txtID"></span></div>
                        </div>
                        <div class="profile-info-row">
                          <div class="profile-info-name"> Kategori </div>
                          <div class="profile-info-value"><span id="txtKategori"></span></div>
                        </div>
                        <div class="profile-info-row">
                          <div class="profile-info-name"> Merek </div>
                          <div class="profile-info-value"><span id="txtMerek"></span></div>
                        </div>
                        <div class="profile-info-row">
                          <div class="profile-info-name"> Tipe </div>
                          <div class="profile-info-value"><span id="txtTipe"></span></div>
                        </div>
                        <div class="profile-info-row">
                          <div class="profile-info-name"> S/N </div>
                          <div class="profile-info-value"><span id="txtSN"></span></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-12 col-sm-6">
                  <div class="box box-success box-solid">
                    <div class="box-header with-border">
                      <h3 class="box-title"> Spesifikasi </h3>
                    </div>
                    <div class="box-body">
                      <div class="profile-user-info profile-user-info-striped">
                        <div class="profile-info-row">
                          <div class="profile-info-name"> Print Method </div>
                          <div class="profile-info-value"><span id="txtPrintMethod"></span></div>
                        </div>
                        <div class="profile-info-row">
                          <div class="profile-info-name"> Print Speed</div>
                          <div class="profile-info-value"><span id="txtPrintSpeed"></span></div>
                        </div>
                        <div class="profile-info-row">
                          <div class="profile-info-name"> Media Size</div>
                          <div class="profile-info-value"><span id="txtMediaSize"></span></div>
                        </div>
                        <div class="profile-info-row">
                          <div class="profile-info-name"> Connectivity </div>
                          <div class="profile-info-value"><span id="txtKoneksi"></span></div>
                        </div>
                        <div class="profile-info-row">
                          <div class="profile-info-name"> Alamat IP </div>
                          <div class="profile-info-value"><span id="txtAlamatIP"></span></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                  <div class="box box-danger box-solid">
                    <div class="box-header with-border">
                      <h3 class="box-title"> BMN </h3>
                    </div>
                    <div class="box-body">
                      <div class="profile-user-info profile-user-info-striped">
                        <div class="profile-info-row">
                          <div class="profile-info-name"> Kode Barang </div>
                          <div class="profile-info-value"><span id="txtKodeBarang"></span></div>
                        </div>
                        <div class="profile-info-row">
                          <div class="profile-info-name"> NUP </div>
                          <div class="profile-info-value"><span id="txtNUP"></span></div>
                        </div>
                        <div class="profile-info-row">
                          <div class="profile-info-name"> Thn Perolehan </div>
                          <div class="profile-info-value"><span id="txtTahunPerolehan"></span></div>
                        </div>
                        <div class="profile-info-row">
                          <div class="profile-info-name"> Kondisi </div>
                          <div class="profile-info-value"><span id="txtKondisi"></span></div>
                        </div>
                        <div class="profile-info-row">
                          <div class="profile-info-name"> Status </div>
                          <div class="profile-info-value"><span id="txtStatus"></span></div>
                        </div>
                        <div class="profile-info-row">
                          <div class="profile-info-name"> Lokasi </div>
                          <div class="profile-info-value"><span id="txtLokasi"></span></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-12">
                  <div class="box box-default box-solid">
                    <div class="box-header with-border">
                      <h3 class="box-title"> Lain-Lain </h3>
                    </div>
                    <div class="box-body">
                      <div class="profile-user-info profile-user-info-striped">
                        <div class="profile-info-row">
                          <div class="profile-info-name"> Keterangan </div>
                          <div class="profile-info-value"><span id="txtKeterangan"></span></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <div class="btn-group">
                <a id="btnRiwayat" class="dt-button btn btn-default"><span><i class="fa fa-wrench bigger-110 grey"></i> <span>&nbsp;&nbsp;Riwayat</span></span></a>
                <a id="btnPrint" class="dt-button btn btn-default"><span><i class="fa fa-print bigger-110 grey"></i> <span>&nbsp;&nbsp;Cetak</span></span></a>
                <a class="dt-button btn btn-default" data-dismiss="modal"><span><i class="fa fa-times bigger-110 grey"></i> <span>&nbsp;&nbsp;Tutup</span></span></a>
              </div>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php $this->load->view('footer_view.php'); ?>

<!-- Page Script -->
<script type="text/javascript">
  var sk = '<?= $this->session->kd_unit; ?>';
  var sname = '<?= strtoupper($this->session->name); ?>';
</script>
<script src="<?= base_url(); ?>dist/js/amoi/printer.js"></script>

</body>
</html>
