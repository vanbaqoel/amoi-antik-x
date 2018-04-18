<?php include('header_view.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-server"></i> - SERVER
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
              <th>Aksi</th>
              <th>Kategori</th>
              <th>Merek</th>
              <th>Tipe</th>
              <th>Serial Number</th>
              <th>Processor</th>
              <th>Jumlah Processor</th>
              <th>Jumlah Core</th>
              <th>Storage</th>
              <th>RAM</th>
              <th>NIC</th>
              <th>Optical</th>
              <th>OS</th>
              <th>Edisi OS</th>
              <th>Orisinalitas OS</th>
              <th>Office</th>
              <th>Antivirus</th>
              <th>Alamat IP</th>
              <th>Nama Komputer</th>
              <th>Join Domain</th>
              <th>Kode Barang</th>
              <th>NUP</th>
              <th>Tahun Perolehan</th>
              <th>Kondisi</th>
              <th>NIP Pengguna</th>
              <th>Lokasi</th>
              <th>Keterangan</th>
              <?php
                if($this->session->kd_unit == '000')
                    echo "<th>Kode Unit</th>";
              ?>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>

      <div class="modal fade" id="modal-default">
        <div class="modal-dialog ruh-modal">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Tambah Data</h4>
            </div>
            <div class="modal-body">
              <div class="clearfix" >
                <div class="row" >
                  <!-- form start -->
                  <form class="form-horizontal">
                    <div class="box-body">
                      <div class="profile-user-info profile-user-info-striped">

                          <div class="profile-info-row form-group row">
                            <div class="no-padding col-xs-12 col-sm-6 col-lg-3" style="display: table-cell;">
                              <div style="display: table;width: 100%;">
                                <div style="display: table-row;">
                                  <label class="profile-info-name control-label" for="cboKategori"> Kategori </label>
                                  <div class="profile-info-value col-xs-12">
                                    <select class="form-control select2" name="cboKategori" style="width: 100%;" data-placeholder="Silahkan Pilih...">
                                      <option></option>
                                      <option>TOWER</option>
                                      <option>RACK</option>
                                      <option>BLADE</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="no-padding col-xs-12 col-sm-6 col-lg-3" style="display: table-cell;">
                              <div style="display: table;width: 100%;">
                                <div style="display: table-row;">
                                  <label class="profile-info-name control-label" for="txtMerek"> Merek </label>
                                  <div class="profile-info-value">
                                    <input type="text" class="form-control text-uppercase" id="txtMerek" name="txtMerek" placeholder="Merek">
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="no-padding col-xs-12 col-sm-6 col-lg-3" style="display: table-cell;">
                              <div style="display: table;width: 100%;">
                                <div style="display: table-row;">
                                  <label class="profile-info-name control-label" for="txtTipe"> Tipe </label>
                                  <div class="profile-info-value">
                                    <input type="text" class="form-control text-uppercase" id="txtTipe" name="txtTipe" placeholder="Tipe">
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="no-padding col-xs-12 col-sm-6 col-lg-3" style="display: table-cell;">
                              <div style="display: table;width: 100%;">
                                <div style="display: table-row;">
                                  <label class="profile-info-name control-label" for="txtSN"> S/N </label>
                                  <div class="profile-info-value">
                                    <input type="text" class="form-control text-uppercase" id="txtSN" name="txtSN" placeholder="Serial Number">
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="profile-info-row form-group row">
                            <div class="no-padding col-xs-12 col-sm-6 col-lg-3" style="display: table-cell;">
                              <div style="display: table;width: 100%;">
                                <div style="display: table-row;">
                                  <label class="profile-info-name control-label" for="txtProcessor"> Processor </label>
                                  <div class="profile-info-value">
                                    <input type="text" class="form-control text-uppercase" id="txtProcessor" name="txtProcessor" placeholder="Processor">
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="no-padding col-xs-12 col-sm-6 col-lg-3" style="display: table-cell;">
                              <div style="display: table;width: 100%;">
                                <div style="display: table-row;">
                                  <label class="profile-info-name control-label" for="txtJumlahCore"> Jumlah Core </label>
                                  <div class="profile-info-value">
                                    <input type="number" class="form-control text-uppercase" id="txtJumlahCore" name="txtJumlahCore" placeholder="Jumlah Core">
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="no-padding col-xs-12 col-sm-6 col-lg-3" style="display: table-cell;">
                              <div style="display: table;width: 100%;">
                                <div style="display: table-row;">
                                  <label class="profile-info-name control-label" for="txtStorage"> Storage </label>
                                  <div class="profile-info-value">
                                    <input type="number" class="form-control text-uppercase" id="txtStorage" name="txtStorage" placeholder="Dalam GB">
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="no-padding col-xs-12 col-sm-6 col-lg-3" style="display: table-cell;">
                              <div style="display: table;width: 100%;">
                                <div style="display: table-row;">
                                  <label class="profile-info-name control-label" for="txtRAM"> RAM </label>
                                  <div class="profile-info-value">
                                    <input type="number" class="form-control text-uppercase" id="txtRAM" name="txtRAM" placeholder="Dalam GB">
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="profile-info-row form-group row">
                            <div class="no-padding col-xs-12 col-sm-6 col-lg-3" style="display: table-cell;">
                              <div style="display: table;width: 100%;">
                                <div style="display: table-row;">
                                  <label class="profile-info-name control-label" for="cboNIC"> NIC </label>
                                  <div class="profile-info-value">
                                    <select class="form-control select2" name="cboNIC" style="width: 100%;" data-placeholder="Silahkan Pilih...">
                                      <option></option>
                                      <option>FAST ETHERNET</option>
                                      <option>GIGABIT ETHERNET</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="no-padding col-xs-12 col-sm-6 col-lg-3" style="display: table-cell;">
                              <div style="display: table;width: 100%;">
                                <div style="display: table-row;">
                                  <label class="profile-info-name control-label" for="cboOptical"> Optical </label>
                                  <div class="profile-info-value">
                                    <select class="form-control select2" name="cboOptical" style="width: 100%;" data-placeholder="Silahkan Pilih...">
                                      <option></option>
                                      <option>CD R/W</option>
                                      <option>DVD R/W</option>
                                      <option>BLUE-RAY</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="no-padding col-xs-12 col-sm-6 col-lg-3" style="display: table-cell;">
                              <div style="display: table;width: 100%;">
                                <div style="display: table-row;">
                                  <label class="profile-info-name control-label" for="txtOS"> OS </label>
                                  <div class="profile-info-value">
                                    <input type="text" class="form-control text-uppercase" id="txtOS" name="txtOS" placeholder="Operating System">
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="no-padding col-xs-12 col-sm-6 col-lg-3" style="display: table-cell;">
                              <div style="display: table;width: 100%;">
                                <div style="display: table-row;">
                                  <label class="profile-info-name control-label" for="txtEdisiOS"> Edisi OS </label>
                                  <div class="profile-info-value">
                                    <input type="text" class="form-control text-uppercase" id="txtEdisiOS" name="txtEdisiOS" placeholder="Edisi OS">
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="profile-info-row form-group row">
                            <div class="no-padding col-xs-12 col-sm-6 col-lg-3" style="display: table-cell;">
                              <div style="display: table;width: 100%;">
                                <div style="display: table-row;">
                                  <label class="profile-info-name control-label" for="cboOrisinalitasOS"> Orisinalitas OS </label>
                                  <div class="profile-info-value">
                                    <select class="form-control select2" name="cboOrisinalitasOS" style="width: 100%;" data-placeholder="Silahkan Pilih...">
                                      <option></option>
                                      <option>ORIGINAL/GENUINE</option>
                                      <option>NOT ORIGINAL/GENUINE</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="no-padding col-xs-12 col-sm-6 col-lg-3" style="display: table-cell;">
                              <div style="display: table;width: 100%;">
                                <div style="display: table-row;">
                                  <label class="profile-info-name control-label" for="txtOffice"> Office </label>
                                  <div class="profile-info-value">
                                    <input type="text" class="form-control text-uppercase" id="txtOffice" name="txtOffice" placeholder="Office">
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="no-padding col-xs-12 col-sm-6 col-lg-3" style="display: table-cell;">
                              <div style="display: table;width: 100%;">
                                <div style="display: table-row;">
                                  <label class="profile-info-name control-label" for="txtAntivirus"> Antivirus </label>
                                  <div class="profile-info-value">
                                    <input type="text" class="form-control text-uppercase" id="txtAntivirus" name="txtAntivirus" placeholder="Antivirus">
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="no-padding col-xs-12 col-sm-6 col-lg-3" style="display: table-cell;">
                              <div style="display: table;width: 100%;">
                                <div style="display: table-row;">
                                  <label class="profile-info-name control-label" for="txtAlamatIP"> Alamat IP </label>
                                  <div class="profile-info-value">
                                    <input type="text" class="form-control text-uppercase" id="txtAlamatIP" name="txtAlamatIP" placeholder="Alamat IP">
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="profile-info-row form-group row">
                            <div class="no-padding col-xs-12 col-sm-6 col-lg-3" style="display: table-cell;">
                              <div style="display: table;width: 100%;">
                                <div style="display: table-row;">
                                  <label class="profile-info-name control-label" for="txtHostName"> Hostname </label>
                                  <div class="profile-info-value">
                                    <input type="text" class="form-control text-uppercase" id="txtHostname" name="txtHostName" placeholder="Nama Komputer">
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="no-padding col-xs-12 col-sm-6 col-lg-3" style="display: table-cell;">
                              <div style="display: table;width: 100%;">
                                <div style="display: table-row;">
                                  <label class="profile-info-name control-label" for="cboJoinDomain"> Join Domain </label>
                                  <div class="profile-info-value">
                                    <select class="form-control select2" name="cboJoinDomain" style="width: 100%;" data-placeholder="Silahkan Pilih...">
                                      <option></option>
                                      <option>SUDAH</option>
                                      <option>BELUM</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="no-padding col-xs-12 col-sm-6 col-lg-3" style="display: table-cell;">
                              <div style="display: table;width: 100%;">
                                <div style="display: table-row;">
                                  <label class="profile-info-name control-label" for="txtKodeBarang"> Kode Barang </label>
                                  <div class="profile-info-value">
                                    <input type="text" class="form-control text-uppercase" id="txtKodeBarang" name="txtKodeBarang" placeholder="Kode Barang">
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="no-padding col-xs-12 col-sm-6 col-lg-3" style="display: table-cell;">
                              <div style="display: table;width: 100%;">
                                <div style="display: table-row;">
                                  <label class="profile-info-name control-label" for="txtNUP"> NUP </label>
                                  <div class="profile-info-value">
                                    <input type="text" class="form-control text-uppercase" id="txtNUP" name="txtNUP" placeholder="NUP">
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="profile-info-row form-group row">
                            <div class="no-padding col-xs-12 col-sm-6 col-lg-3" style="display: table-cell;">
                              <div style="display: table;width: 100%;">
                                <div style="display: table-row;">
                                  <label class="profile-info-name control-label" for="txtTahunPerolehan"> Tahun Perolehan </label>
                                  <div class="profile-info-value">
                                    <input type="number" class="form-control text-uppercase" id="txtTahunPerolehan" name="txtTahunPerolehan" placeholder="Tahun Perolehan">
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="no-padding col-xs-12 col-sm-6 col-lg-3" style="display: table-cell;">
                              <div style="display: table;width: 100%;">
                                <div style="display: table-row;">
                                  <label class="profile-info-name control-label" for="cboKondisi"> Kondisi </label>
                                  <div class="profile-info-value">
                                    <select class="form-control select2" name="cboKondisi" style="width: 100%;" data-placeholder="Silahkan Pilih...">
                                      <option></option>
                                      <option>BAIK</option>
                                      <option>RUSAK RINGAN</option>
                                      <option>RUSAK BERAT</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="no-padding col-xs-12 col-sm-6 col-lg-3" style="display: table-cell;">
                              <div style="display: table;width: 100%;">
                                <div style="display: table-row;">
                                  <label class="profile-info-name control-label" for="txtNIP"> NIP Pengguna </label>
                                  <div class="profile-info-value">
                                    <input type="text" class="form-control text-uppercase" id="txtNIP" name="txtNIP" placeholder="NIP Pengguna">
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="no-padding col-xs-12 col-sm-6 col-lg-3" style="display: table-cell;">
                              <div style="display: table;width: 100%;">
                                <div style="display: table-row;">
                                  <label class="profile-info-name control-label" for="txtLokasi"> Lokasi </label>
                                  <div class="profile-info-value">
                                    <input type="text" class="form-control text-uppercase" id="txtLokasi" name="txtLokasi" placeholder="Lokasi">
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="profile-info-row form-group row">
                            <div class="no-padding col-xs-12" style="display: table-cell;">
                              <div style="display: table;width: 100%;">
                                <div style="display: table-row;">
                                  <label class="profile-info-name control-label" for="txtKeterangan"> Keterangan </label>
                                  <div class="profile-info-value">
                                    <input type="text" class="form-control text-uppercase" id="txtKeterangan" name="txtKeterangan" placeholder="Keterangan">
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                      </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer text-center">
                      <button type="button" class="btn btn-primary" onclick="save()"><i class="fa fa-save"></i> &nbsp; Simpan</button>
                    </div>
                    <!-- /.box-footer -->
                  </form>
                </div>
              <!-- </div> -->
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

<?php include('footer_view.php'); ?>

<!-- Page Script -->
<script type="text/javascript"> var sk = '<?= $this->session->kd_unit; ?>';</script>
<script src="<?= base_url(); ?>dist/js/amoi/server.js"></script>

</body>
</html>
