
var pc_table;
var pc_id;

function edit_pc(id)
{
  pc_id = id;
  save_method = 'update';
  $('form')[0].reset();
  $('.select2').trigger('change');

  //Ajax Load data from ajax
  $.ajax({
    url : document.location.protocol + "//" + document.location.host + "/amoi-antik/pc/edit_pc/" + id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
      $('[name="cboKategori"]').val(data.kategori).trigger('change');
      $('[name="txtMerek"]').val(data.merek);
      $('[name="txtTipe"]').val(data.tipe);
      $('[name="txtSN"]').val(data.sn);
      $('[name="cboProcessor"]').val(data.processor).trigger('change');
      $('[name="txtStorage"]').val(data.storage);
      $('[name="txtRAM"]').val(data.ram);
      $('[name="cboNIC"]').val(data.nic).trigger('change');
      $('[name="cboOptical"]').val(data.optical).trigger('change');
      $('[name="cboOS"]').val(data.os).trigger('change');
      $('[name="cboEdisiOS"]').val(data.edisi_os).trigger('change');
      $('[name="cboOrisinalitasOS"]').val(data.orisinalitas_os).trigger('change');
      $('[name="cboOffice"]').val(data.office).trigger('change');
      $('[name="txtAntivirus"]').val(data.antivirus);
      $('[name="cboKoneksi"]').val(data.koneksi).trigger('change');
      $('[name="txtHostName"]').val(data.hostname);
      $('[name="txtAlamatIP"]').val(data.alamat_ip);
      $('[name="cboJoinDomain"]').val(data.join_domain).trigger('change');
      $('[name="txtKodeBarang"]').val(data.kode_barang);
      $('[name="txtNUP"]').val(data.nup);
      $('[name="txtTahunPerolehan"]').val(data.tahun_perolehan);
      $('[name="cboKondisi"]').val(data.kondisi).trigger('change');
      $('[name="cboStatus"]').val(data.status).trigger('change');
      $('[name="cboLokasi"]').val(data.lokasi).trigger('change');
      $('[name="txtNIP"]').val(data.nip);
      $('[name="txtKeterangan"]').val(data.keterangan);
    },
    error: function (jqXHR, textStatus, errorThrown)
    {
        alert('Gagal menarik data...');
    }
  });
}

function save()
{
  var url;
  if(save_method == 'add')
  {
    url = document.location.protocol + "//" + document.location.host + "/amoi-antik/pc/add_pc";
  }
  else
  {
    url = document.location.protocol + "//" + document.location.host + "/amoi-antik/pc/update_pc/" + pc_id;
  }

   // ajax adding data to database
  $.ajax({
    url : url,
    type: "POST",
    data: $('form').serialize(),
    dataType: "JSON",
    success: function(data)
    {
      alert("Data berhasil disimpan...");
      //if success close modal and reload ajax table
      window.location = document.location.protocol + "//" + document.location.host + "/amoi-antik/pc";
    },
    error: function (jqXHR, textStatus, errorThrown)
    {
        alert('Gagal menyimpan/mengubah data...');
    }
  });
}

$(document).ready(function () {

  //Initialize Select2 Elements
  $('.select2').select2();

  $('.sidebar-menu').tree();

  $('.select2-container').attr('style', 'width: 100%;');

  $('#btnReset').on('click', function() {
    $('form')[0].reset();
  });

  $('#btnSimpan').on('click', function() {
    save();
  });

  if(save_method != 'add')
  {
    edit_pc(save_method);
  }

})