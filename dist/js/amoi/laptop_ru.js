
var laptop_table;
var laptop_id;

function view_laptop(id)
{
  //Ajax Load data from ajax
  $.ajax({
    url : "laptop/edit_laptop/" + id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
      $('#txtID').text(data.id);
      $('#txtMerek').text(data.merek);
      $('#txtTipe').text(data.tipe);
      $('#txtSN').text(data.sn);
      $('#txtProcessor').text(data.bdesc);
      $('#txtStorage').text(data.storage);
      $('#txtRAM').text(data.ram);
      $('#txtNIC').text(data.cdesc);
      $('#txtWifi').text(data.ddesc);
      $('#txtOptical').text(data.edesc);
      $('#txtOS').text(data.fdesc);
      $('#txtEdisiOS').text(data.gdesc);
      $('#txtOrisinalitasOS').text(data.ori);
      $('#txtOffice').text(data.hdesc);
      $('#txtKoneksi').text(data.idesc);
      $('#txtHostName').text(data.hostname);
      $('#txtAlamatIP').text(data.alamat_ip);
      $('#txtAntivirus').text(data.antivirus);
      $('#txtJoinDomain').text(data.jondo);
      $('#txtKodeBarang').text(data.kode_barang);
      $('#txtNUP').text(data.nup);
      $('#txtTahunPerolehan').text(data.tahun_perolehan);
      $('#txtKondisi').text(data.jdesc);
      $('#txtStatus').text(data.kdesc);
      $('#txtNIP').text(data.nip);
      $('#txtLokasi').text(data.ldesc);
      $('#txtKeterangan').text(data.keterangan);


      $('.modal').modal('show'); // show bootstrap modal when complete loaded

      laptop_id = id;

    },
    error: function (jqXHR, textStatus, errorThrown)
    {
        alert('Gagal menarik data...');
    }
  });
}

function add_laptop()
{
  save_method = 'add';
  $('form')[0].reset();
  $('.select2').trigger('change');
  $('.modal').modal('show');
  $('.modal-title').text('Tambah Data Laptop');
}

function edit_laptop(id)
{
  save_method = 'update';
  $('form')[0].reset();
  $('.select2').trigger('change');

  //Ajax Load data from ajax
  $.ajax({
    url : "laptop/edit_laptop/" + id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
      $('[name="txtMerek"]').val(data.merek);
      $('[name="txtTipe"]').val(data.tipe);
      $('[name="txtSN"]').val(data.sn);
      $('[name="txtProcessor"]').val(data.processor);
      $('[name="txtStorage"]').val(data.storage);
      $('[name="txtRAM"]').val(data.ram);
      $('[name="cboNIC"]').val(data.nic).trigger('change');
      $('[name="cboWifi"]').val(data.wifi).trigger('change');
      $('[name="cboOptical"]').val(data.optical).trigger('change');
      $('[name="txtOS"]').val(data.os);
      $('[name="txtEdisiOS"]').val(data.edisi_os);
      $('[name="cboOrisinalitasOS"]').val(data.orisinalitas_os).trigger('change');
      $('[name="txtOffice"]').val(data.office);
      $('[name="txtAntivirus"]').val(data.antivirus);
      $('[name="txtAlamatIP"]').val(data.alamat_ip);
      $('[name="txtHostName"]').val(data.hostname);
      $('[name="cboJoinDomain"]').val(data.join_domain).trigger('change');
      $('[name="txtKodeBarang"]').val(data.kode_barang);
      $('[name="txtNUP"]').val(data.nup);
      $('[name="txtTahunPerolehan"]').val(data.tahun_perolehan);
      $('[name="cboKondisi"]').val(data.kondisi).trigger('change');
      $('[name="txtNIP"]').val(data.nip);
      $('[name="txtLokasi"]').val(data.lokasi);
      $('[name="txtKeterangan"]').val(data.keterangan);


      $('.modal').modal('show'); // show bootstrap modal when complete loaded
      $('.modal-title').text('Ubah Data Laptop'); // Set title to Bootstrap modal title

      laptop_id = id;

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
    url = "laptop/add_laptop";
  }
  else
  {
    url = "laptop/update_laptop/" + laptop_id;
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
      $('.modal').modal('hide');
      laptop_table.ajax.reload();// for reload a page
    },
    error: function (jqXHR, textStatus, errorThrown)
    {
        alert('Gagal menyimpan/mengubah data...');
    }
  });
}

function delete_laptop(id)
{
  if(confirm('Apakah Anda yakin mau menghapus data ini?'))
  {
    // ajax delete data from database
    $.ajax({
      url : "laptop/delete_laptop/" + id,
      type: "POST",
      dataType: "JSON",
      success: function(data)
      {
        alert("Data berhasil dihapus...");
        laptop_table.ajax.reload();
      },
      error: function (jqXHR, textStatus, errorThrown)
      {
        alert('Gagal menghapus data...');
      }
    });
  }
}

function printElement(elem) {
  /*var domClone = elem.cloneNode(true);*/
  var domClone = elem.cloneNode(true);;
  $('.profile-info-row').each(function( index ){
    if (index > 3) {
      domClone.appendChild(this.cloneNode(true));
    }
  });

  var $printSection = document.getElementById("printSection");

  if (!$printSection) {
      var $printSection = document.createElement("div");
      $printSection.id = "printSection";
      document.body.appendChild($printSection);
  }


  $printSection.innerHTML = "<h3>&nbsp;&nbsp;DATA DETAIL LAPTOP</h3>";

  $printSection.appendChild(domClone);
}

$(document).ready(function () {

  //Initialize Select2 Elements
  $('.select2').select2();

  $('.sidebar-menu').tree();

  $('.select2-container').attr('style', 'width: 100%;');

})
