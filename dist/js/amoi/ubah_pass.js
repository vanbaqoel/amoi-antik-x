

function bersih() {
  // $('form')[0].reset();
   $('#my_form').bootstrapValidator("resetForm",true);
}

function save() {
  if ($('#txtNewPass')) {} else {}
  alert('save');
}

$(document).ready(function() {
  $('.form-control-feedback').css({'z-index': '-1'});

  $('.togpass').on('click', function () {
    var objBefore = $(this).prevAll('input');
    var objAfter = $(this).find(">:first-child");
    console.log($(this).attr("data-showpass"));

    if ($(this).attr("data-showpass") == 0) {
      objBefore.attr("type", "text");
      objAfter.removeClass("fa-eye");
      objAfter.addClass("fa-eye-slash");
      $(this).attr("data-showpass", "1");
    } else {
      objBefore.attr("type", "password");
      objAfter.removeClass("fa-eye-slash");
      objAfter.addClass("fa-eye");
      $(this).attr("data-showpass", "0");
    }
  });

  $('#my_form')
    .bootstrapValidator({
      container: '#messages',
      feedbackIcons: {
          valid: 'glyphicon glyphicon-ok',
          invalid: 'glyphicon glyphicon-remove',
          validating: 'glyphicon glyphicon-refresh'
      },
      excluded: [':disabled'],
      fields: {
        txtLama: {
          validators: {
            notEmpty: {
                message: 'Kata sandi lama harus diisi'
            }
          }
        },
        txtBaru: {
          validators: {
            notEmpty: {
                message: 'Kata sandi baru harus diisi'
            },
            identical: {
              field: 'txtBaru1',
              message: 'Kata sandi baru tidak sama dengan konfirmasi'
            }
          }
        },
        txtBaru1: {
          validators: {
            notEmpty: {
                message: 'Konfirmasi kata sandi baru harus diisi'
            },
            identical: {
              field: 'txtBaru',
              message: 'Konfirmasi tidak sama dengan kata sandi baru'
            }
          }
        }
      }
    })
    .on('success.form.bv', function(e) {
      // Prevent form submission
      e.preventDefault();

      // Get the form instance
      var $form = $(e.target);

      // Get the BootstrapValidator instance
      var bv = $form.data('bootstrapValidator');

      // Use Ajax to submit form data
      $.ajax({
        url : document.location.protocol + "//" + document.location.host + "/amoi-antik/ubah_pass/do_ubah_pass",
        type: "POST",
        data: $('form').serialize(),
        dataType: "JSON",
        success: function(data)
        {
          console.log(data);
          if (data.status) {
            bootbox.alert(
              '<div class="col-xs-12" style="display: flex;align-items: center;" ><i class="fa fa-check-circle fa-4x text-green"></i>&nbsp;&nbsp;&nbsp;Kata sandi berhasil diubah&hellip;</div>',
              function () {
                window.location = document.location.protocol + "//" + document.location.host + "/amoi-antik/autentikasi/do_logout";
              }
            );
          } else {
            bootbox.alert(
              '<div class="col-xs-12" style="display: flex;align-items: center;" ><i class="fa  fa-times-circle fa-4x text-red"></i>&nbsp;&nbsp;&nbsp;Gagal mengubah kata sandi&hellip; <br />&nbsp;&nbsp;&nbsp;Kata sandi lama salah!</div>',
            );
          }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
          bootbox.alert(
            '<div class="col-xs-12" style="display: flex;align-items: center;" ><i class="fa  fa-times-circle fa-4x text-red"></i>&nbsp;&nbsp;&nbsp;Gagal mengubah kata sandi&hellip;</div>');
        }
      });
    });
});