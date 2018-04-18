var cek_table

function cek_host()
{
  $('.select2').trigger('change');
  cek_table.ajax.url("cek_host/cek_all/" + $('[name="cboUnit"]').val()).load();
}

$(document).ready(function () {

  //Initialize Select2 Elements
  $('.select2').select2();

  $('.sidebar-menu').tree();
  cek_table =
    $('#dynamic-table')
    .DataTable({
      serverSide: false,
        //Load data for the table's content from an Ajax source
        ajax: {
            url: "", //Populate data using a method in controller
            type: "POST"
        },
      autoWidth: false,
      paging: false,
      processing: true,
      rowCallback: function( row, data, index ) {
        if (data[4] == 'Y') {
          $('td:eq(4)', row).html( '<span class="fa fa-icon fa-circle text-green"></span>' );
        } else {
          $('td:eq(4)', row).html( '<span class="fa fa-icon fa-circle text-red"></span>' );
        }
      },
      //Custom texts
      language:
      {
        "decimal":        ",",
        "emptyTable":     "Tidak ada data",
        "info":           "Menampilkan _START_ s/d _END_ dari _TOTAL_ data",
        "infoEmpty":      "Menampilkan 0 s/d 0 dari 0 data",
        "infoFiltered":   "(disaring dari _MAX_ data)",
        "infoPostFix":    "",
        "thousands":      ".",
        "lengthMenu":     "Tampilkan  _MENU_  data",
        "loadingRecords": "Tidak ada data",
        "processing":     "<div id='my_proc'><h2><i class='fa fa-refresh fa-spin'></i>&nbsp;&nbsp;Loading...</h2></div>",
        "search":         "Cari:",
        "zeroRecords":    "Tidak ditemukan data yang cocok",
        "paginate": {
          "first":      "Pertama",
          "last":       "Terakhir",
          "next":       "Selanjutnya",
          "previous":   "Sebelumnya"
        },
        "aria": {
          "sortAscending":  ": aktifkan untuk pengurutan nilai dari kecil ke besar",
          "sortDescending": ": aktifkan untuk mengurutkan nilai dari besar ke kecil"
        }
      }
    });

    /* Error handling ketika menekan tombol tampilkan namun session telah habis */
    /* "TIMEOUT" dilempar dari modul/fungsi */
    $.fn.dataTable.ext.errMode = 'none';

    cek_table.on('error.dt', function (e, settings, techNote, message) {
      if(message.slice(-7) == "TIMEOUT")
      {
        window.top.location.href = '/';
        return '';
      }
    });

    cek_table.on('processing.dt', function ( e, settings, processing ) {
      if (processing) {
        /*$('[name="cboUnit"]').attr("disabled", "disabled");
        $('#btnCek').attr("disabled", "disabled");*/
        cek_table.clear().draw();
        $('#my_proc').modal('show');
      } else {
        /*$('[name="cboUnit"]').removeAttr("disabled");
        $('#btnCek').removeAttr("disabled");*/
        $('#my_proc').modal('hide');
      }
    } )
})

