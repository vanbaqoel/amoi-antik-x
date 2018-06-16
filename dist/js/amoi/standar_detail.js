
var pc_table;
$(document).ready(function () {
  pc_table =
    $('#dynamic-table')
    .DataTable({
      serverSide: false,
        //Load data for the table's content from an Ajax source
      ajax: {
            url: document.location.protocol + "//" + document.location.host + "/amoi-antik/standar_detail/standar/" + kat + "/" + ku, //Populate data using a method in controller
            type: "POST"
      },
      autoWidth: false,
      scrollX: true,
      scrollCollapse: true,
      order: [],
      lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
      columnDefs: [
          {
              targets: [ 0, 2, 8, 10, 12, 14, 16 ],
              className: "text-center"
          },
          {
            targets: [ 7, 9, 11, 13, 15 ],
            visible: false
          }
      ],
      processing: true,
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
        "processing":     "<h2><i class='fa fa-refresh fa-spin'></i>&nbsp;&nbsp;Loading...</h2>",
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
      },
      rowCallback: function( row, data, index ) {
        var j = 6;
        for (var i = 7; i < (data.length - 1); i += 2) {
          if (data[i] == 0) {
            $('td:eq('+ j +')', row).css('background-color', '#FFB6C1');
          }

          j++;
        }
      }
    });

    /* <-- Datatables button */
    $.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';
    $.fn.dataTable.Buttons.swfPath = document.location.protocol + "//" + document.location.host + "/amoi-antik/dist/swf/flashExport-1.2.4.swf";

    new $.fn.dataTable.Buttons(pc_table, {
      buttons: [
        {
          extend: "print",
          text: "<i class='fa fa-print bigger-110 grey'></i> <span>&nbsp;&nbsp;Cetak</span>",
          className: "btn btn-white btn-default btn-bold",
          titleAttr: "Cetak",
          title: sd,
          exportOptions: {
                    columns: ':visible'
                },
          customize: function (win) {
                    $(win.document.body).css('font-size', '10pt');
                    $(win.document.body).find('table')
                        .addClass('compact')
                        .css('font-size', 'inherit');
                    $(win.document.body).find('h1')
                      .css({
                        'text-align':'center',
                        'font-size':'14pt',
                        'text-decoration':'underline',
                        'font-weight':'bold'
                      })
                        .after('<center><h4>' + nu + '</h4></center><br />');

                    var body = $('tbody');
                    var exporBody = $(win.document.body).find('tbody');
                    exporBody.after(body.clone());
                    exporBody.remove();
                }
        }
      ]
    });

    pc_table.buttons().container().appendTo($('.tableTools-container'));

    setTimeout(function() {
      $($('.tableTools-container')).find('a.dt-button').each(function() {
        var div = $(this).find(' > div').first();
        if(div.length == 1) div.tooltip({container: 'body', title: div.parent().text()});
        else $(this).tooltip({container: 'body', title: $(this).text()});
      });
    }, 500);
})
