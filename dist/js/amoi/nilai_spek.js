function nilai_spek()
{
  $('.select2').trigger('change');
  var data_unit = $('#cboUnit').select2('data');
  $('#info_text').html('');
  $('#info_text').append('<dt>Mulai memeriksa...mohon tunggu sebentar...</dt>');
  $('#info_text').append('<dd>Memeriksa pemenuhan standar spesifikasi perangkat di ' + data_unit[0].text + '...</dd>');
  $.getJSON("nilai_spek/nilai_all/" + data_unit[0].id, function(result){
      $.each(result, function(i, field){
        $('#info_text').append('<dd>Pemeriksaan terhadap ' + field[0][0] + ' perangkat telah selesai...</dd>');
        $('#info_text').append('<dd>' + field[0][1] + ' Server telah memenuhi spesifikasi.</dd>');
        $('#info_text').append('<dd>' + field[0][2] + ' PC telah memenuhi spesifikasi.</dd>');
        $('#info_text').append('<dd>' + field[0][3] + ' Laptop telah memenuhi spesifikasi.</dd>');
      });
  });
}

$(document).ready(function () {
  $('.select2').select2();

})

