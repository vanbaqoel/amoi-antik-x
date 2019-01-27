
var medsos_table;
var medsos_platform;

function edit_medsos(platform)
{
  save_method = 'update';
  medsos_platform = platform
  $('form')[0].reset();
  $('.select2').trigger('change');

  //Ajax Load data from ajax
  $.ajax({
    url : document.location.protocol + "//" + document.location.host + "/amoi-antik/medsos/edit_medsos/" + platform,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
      $('[name="cboPlatform"]').val(data.platform).trigger('change');
      $('[name="txtAkun"]').val(data.nm_akun);
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
    url = document.location.protocol + "//" + document.location.host + "/amoi-antik/medsos/add_medsos";
  }
  else
  {
    url = document.location.protocol + "//" + document.location.host + "/amoi-antik/medsos/update_medsos/" + medsos_platform;
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
            window.location = document.location.protocol + "//" + document.location.host + "/amoi-antik/medsos";
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
    edit_medsos(save_method);
  }

})
