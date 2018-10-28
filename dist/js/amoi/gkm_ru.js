
var gkm_table;
var gkm_id;

function edit_gkm(id)
{
  gkm_id = id;
  save_method = 'update';
  $('form')[0].reset();
  $('.select2').trigger('change');

  //Ajax Load data from ajax
  $.ajax({
    url : document.location.protocol + "//" + document.location.host + "/amoi-antik/gkm/edit_gkm/" + id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
      $('[name="txtJudul"]').val(data.judul);
      $('[name="txtTanggal"]').val(data.pelaksanaan);
      // $('[name="txtFile"]').val(data.file_dok);
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
    url = document.location.protocol + "//" + document.location.host + "/amoi-antik/gkm/add_gkm";
  }
  else
  {
    url = document.location.protocol + "//" + document.location.host + "/amoi-antik/gkm/update_gkm/" + gkm_id;
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
      alert("Data berhasil disimpan...");
      //if success close modal and reload ajax table
      // window.location = document.location.protocol + "//" + document.location.host + "/amoi-antik/gkm";
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
    edit_gkm(save_method);
  }

})
