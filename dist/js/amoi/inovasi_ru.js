
var inovasi_table;
var inovasi_id;

function edit_inovasi(id)
{
  inovasi_id = id;
  save_method = 'update';
  $('form')[0].reset();
  $('.select2').trigger('change');

  //Ajax Load data from ajax
  $.ajax({
    url : document.location.protocol + "//" + document.location.host + "/amoi-antik/inovasi/edit_inovasi/" + id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
      $('[name="txtJudul"]').val(data.judul);
      $('[name="txtDeskripsi"]').val(data.deskripsi);
      $('[name="cboLingkup"]').val(data.lingkup).trigger('change');
      $('[name="txtTanggal"]').val(data.penerapan);
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
    url = document.location.protocol + "//" + document.location.host + "/amoi-antik/inovasi/add_inovasi";
  }
  else
  {
    url = document.location.protocol + "//" + document.location.host + "/amoi-antik/inovasi/update_inovasi/" + inovasi_id;
  }

   // ajax adding data to database
  $.ajax({
    url : url,
    type: "POST",
    // Form data
    data: new FormData($('form')[0]),

    // Tell jQuery not to process data or worry about content-type
    // You *must* include these options!
    processData:false,
    contentType:false,
    cache:false,
    async:false,
    success: function(data)
    {
      console.log(data);
      if (data.status) {
        bootbox.alert(
          '<div class="col-xs-12" style="display: flex;align-items: center;" ><i class="fa fa-check-circle fa-4x text-green"></i>&nbsp;&nbsp;&nbsp;Data berhasil disimpan&hellip;</div>',
          function () {
            window.location = document.location.protocol + "//" + document.location.host + "/amoi-antik/inovasi";
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
    edit_inovasi(save_method);
  }
})
