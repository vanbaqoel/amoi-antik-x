

function bersih() {
  // $('form')[0].reset();
   $('#my_form').bootstrapValidator("resetForm",true);
}

function save() {
  if ($('#txtNewPass')) {} else {}
  alert('save');
}

$(document).ready(function() {
  $('#my_form')
    .bootstrapValidator({
      feedbackIcons: {
          valid: 'glyphicon glyphicon-ok',
          invalid: 'glyphicon glyphicon-remove',
          validating: 'glyphicon glyphicon-refresh'
      },
      excluded: [':disabled'],
      fields: {
        txtOldPass: {
          validators: {
            notEmpty: {
                message: 'Harus diisi'
            }
          }
        },
        txtNewPass1: {
          validators: {
            notEmpty: {
                message: 'Harus diisi'
            },
            identical: {
              field: 'txtNewPass0',
              message: 'Tidak sama dengan kata sandi baru'
            }
          }
        },
        txtNewPass0: {
          validators: {
            notEmpty: {
                message: 'Harus diisi'
            },
            identical: {
              field: 'txtNewPass1',
              message: 'Tidak sama dengan konfirmasi kata sandi baru'
            }
          }
        }
      }
    });
});