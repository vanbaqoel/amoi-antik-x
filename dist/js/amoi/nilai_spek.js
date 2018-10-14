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
        $('#info_text').append('<dd>' + field[0][1] + ' PC telah memenuhi spesifikasi.</dd>');
        $('#info_text').append('<dd>' + field[0][2] + ' Laptop telah memenuhi spesifikasi.</dd>');
        $('#info_text').append('<dd>' + field[0][3] + ' LCD Projector telah memenuhi spesifikasi.</dd>');
        $('#info_text').append('<dd>' + field[0][4] + ' Scanner telah memenuhi spesifikasi.</dd>');
        $('#info_text').append('<dd>' + field[0][5] + ' UPS telah memenuhi spesifikasi.</dd>');
        $('#info_text').append('<dd>' + field[0][6] + ' Printer telah memenuhi spesifikasi.</dd>');
        $('#info_text').append('<dd>' + field[0][7] + ' Komputer Server telah memenuhi spesifikasi.</dd>');
        $('#info_text').append('<dd>' + field[0][8] + ' CCTV telah memenuhi spesifikasi.</dd>');
        $('#info_text').append('<dd>' + field[0][9] + ' Mesin Absensi telah memenuhi spesifikasi.</dd>');
        $('#info_text').append('<dd>' + field[0][10] + ' Mesin Antrian telah memenuhi spesifikasi.</dd>');
        $('#info_text').append('<dd>' + field[0][11] + ' Facsimile telah memenuhi spesifikasi.</dd>');
        $('#info_text').append('<dd>' + field[0][12] + ' TV telah memenuhi spesifikasi.</dd>');
      });
  });
}

$(document).ready(function () {
  $('.select2').select2();

})

