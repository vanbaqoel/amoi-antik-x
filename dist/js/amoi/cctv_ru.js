
var cctv_table;
var cctv_id;

function edit_cctv(id)
{
  cctv_id = id;
  save_method = 'update';
  $('form')[0].reset();
  $('.select2').trigger('change');

  //Ajax Load data from ajax
  $.ajax({
    url : document.location.protocol + "//" + document.location.host + "/amoi-antik/cctv/edit_cctv/" + id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
      $('[name="txtMerek"]').val(data.merek);
      $('[name="txtTipe"]').val(data.tipe);
      $('[name="txtSN"]').val(data.sn);
      $('[name="txtFrameRate"]').val(data.frame_rate);
      $('[name="txtChannel"]').val(data.channel);
      $('[name="txtKamera"]').val(data.jml_kamera);
      $('[name="txtHarddisk"]').val(data.harddisk);
      $('[name="txtKodeBarang"]').val(data.kode_barang);
      $('[name="txtNUP"]').val(data.nup);
      $('[name="txtTahunPerolehan"]').val(data.tahun_perolehan);
      $('[name="cboKondisi"]').val(data.kondisi).trigger('change');
      $('[name="cboStatus"]').val(data.status).trigger('change');
      $('[name="cboLokasi"]').val(data.lokasi).trigger('change');
      $('[name="txtKeterangan"]').val(data.keterangan);
    },
    error: function (jqXHR, textStatus, errorThrown)
    {
      bootbox.alert('<div class="col-xs-12" style="display: flex;align-items: center;" ><i class="fa  fa-times-circle fa-4x text-red"></i>&nbsp;&nbsp;&nbsp;Gagal menarik data&hellip;</div>');
    }
  });
}

function save()
{
  var url;
  if(save_method == 'add')
  {
    url = document.location.protocol + "//" + document.location.host + "/amoi-antik/cctv/add_cctv";
  }
  else
  {
    url = document.location.protocol + "//" + document.location.host + "/amoi-antik/cctv/update_cctv/" + cctv_id;
  }

   // ajax adding data to database
  $.ajax({
    url : url,
    type: "POST",
    data: $('form').serialize(),
    dataType: "JSON",
    success: function(data)
    {
      console.log(data);
      if (data.status) {
        bootbox.alert(
          '<div class="col-xs-12" style="display: flex;align-items: center;" ><i class="fa fa-check-circle fa-4x text-green"></i>&nbsp;&nbsp;&nbsp;Data berhasil disimpan&hellip;</div>',
          function () {
            window.location = document.location.protocol + "//" + document.location.host + "/amoi-antik/cctv";
          }
        );
      } else {
        bootbox.alert(
          '<div class="col-xs-12" style="display: flex;align-items: center;" ><i class="fa  fa-times-circle fa-4x text-red"></i>&nbsp;&nbsp;&nbsp;Gagal menyimpan/mengubah data&hellip;</div>',
        );
      }
    },
    error: function (jqXHR, textStatus, errorThrown)
    {
      bootbox.alert(
        '<div class="col-xs-12" style="display: flex;align-items: center;" ><i class="fa  fa-times-circle fa-4x text-red"></i>&nbsp;&nbsp;&nbsp;Gagal menyimpan/mengubah data&hellip;</div>',
      );
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
    edit_cctv(save_method);
  }

})
