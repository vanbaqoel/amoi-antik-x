function a1(id_enc) {
    window.open('os_detail/os_view/a/' + id_enc, '_blank');
}

function a2(id_enc) {
    window.open('os_detail/os_view/b/' + id_enc, '_blank');
}

function a3(id_enc) {
    window.open('os_detail/os_view/c/' + id_enc, '_blank');
}

function a4(id_enc) {
    window.open('os_detail/os_view/d/' + id_enc, '_blank');
}

function a5(id_enc) {
    window.open('os_detail/os_view/e/' + id_enc, '_blank');
}

function a6(id_enc) {
    window.open('os_detail/os_view/f/' + id_enc, '_blank');
}

function a7(id_enc) {
    window.open('os_detail/os_view/g/' + id_enc, '_blank');
}

function a8(id_enc) {
    window.open('os_detail/os_view/h/' + id_enc, '_blank');
}

$(document).ready(function () {
  os_table =
  $('#os-table').DataTable({
      serverSide: false,
      //Load data for the table's content from an Ajax source
      ajax: {
            url: "os/get_os", //Populate data using a method in controller
            type: "POST"
      },
      paging:   false,
      ordering: false,
      info:     false,
      searching: false,
      autoWidth: false,
      scrollX: true,
      scrollCollapse: true,
      rowGroup: {
        dataSrc: 1,
        endRender: function ( rows, group ) {
            var aSum = rows
                .data()
                .pluck(3)
                .reduce( function (a, b) {
                    return a + b.replace(/[^\d]/g, '')*1;
                }, 0);
            var bSum = rows
                .data()
                .pluck(4)
                .reduce( function (a, b) {
                    return a + b.replace(/[^\d]/g, '')*1;
                }, 0);
            var cSum = rows
                .data()
                .pluck(5)
                .reduce( function (a, b) {
                    return a + b.replace(/[^\d]/g, '')*1;
                }, 0);
            var dSum = rows
                .data()
                .pluck(6)
                .reduce( function (a, b) {
                    return a + b.replace(/[^\d]/g, '')*1;
                }, 0);
            var eSum = rows
                .data()
                .pluck(7)
                .reduce( function (a, b) {
                    return a + b.replace(/[^\d]/g, '')*1;
                }, 0);
            var fSum = rows
                .data()
                .pluck(8)
                .reduce( function (a, b) {
                    return a + b.replace(/[^\d]/g, '')*1;
                }, 0);
            var gSum = rows
                .data()
                .pluck(9)
                .reduce( function (a, b) {
                    return a + b.replace(/[^\d]/g, '')*1;
                }, 0);
            var hSum = rows
                .data()
                .pluck(9)
                .reduce( function (a, b) {
                    return a + b.replace(/[^\d]/g, '')*1;
                }, 0);

            return $('<tr/>')
                .append( '<td>JUMLAH</td>' )
                .append( '<td>' + aSum + '</td>' )
                .append( '<td>' + bSum + '</td>' )
                .append( '<td>' + cSum + '</td>' )
                .append( '<td>' + dSum + '</td>' )
                .append( '<td>' + eSum + '</td>' )
                .append( '<td>' + fSum + '</td>' )
                .append( '<td>' + gSum + '</td>' )
                .append( '<td>' + hSum + '</td>' );
        }
      },
      columnDefs: [
        {
          targets: [ 3, 4, 5, 6, 7, 8, 9, 10 ],
          className: "text-center"
        },
        {
          targets: [ 0, 1, 11 ],
          visible: false
        }
      ],
      rowCallback: function( row, data, index ) {
        var j = 1;
        for (var i = 2; i < (data.length - 1); i++) {
          $('td:eq('+ j +')', row).wrapInner("<a href='#' onClick='a" + j + '("' + data[11] + '")' + "'></a>");
          j++;
        }
      }
  });

  /* <-- Datatables button */
  $.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';
  $.fn.dataTable.Buttons.swfPath = document.location.protocol + "//" + document.location.host + "/amoi-antik/dist/swf/flashExport-1.2.4.swf";

  new $.fn.dataTable.Buttons(os_table, {
    buttons: [
      {
        extend: "excel",
        text: "<i class='fa fa-file-excel-o bigger-110 green'></i> <span>&nbsp;&nbsp;Excel</span>",
        className: "btn btn-white btn-default btn-bold",
        titleAttr: "Simpan sebagai file Excel",
        filename: "laporan-penggunaan-os",
        exportOptions: {
                  orthogonal: 'sort',
                  columns: ':visible'
              }
      },
      {
        extend: "print",
        text: "<i class='fa fa-print bigger-110 grey'></i> <span>&nbsp;&nbsp;Cetak</span>",
        className: "btn btn-white btn-default btn-bold",
        titleAttr: "Cetak",
        title: 'LAPORAN PENGGUNAAN OS',
        exportOptions: {
                  columns: ':visible'
              },
        customize: function (win) {
                  $(win.document.body).css('font-size', '8pt');
                  $(win.document.body).find('table')
                      .addClass('compact')
                      .css('font-size', 'inherit');
                  $(win.document.body).find('h1')
                      .css({
                        'text-align':'center',
                        'font-size':'12pt',
                        'text-decoration':'underline',
                        'font-weight':'bold'
                      })
                      .after('<center><h4>' + sname + '</h4></center><br />');

                  /* Khusus untuk table yang punya lebih dari 2 row header and footer */
                  var footer = $('tfoot');
                  if (footer.length > 0) {
                      var exportFooter = $(win.document.body).find('tfoot');
                      exportFooter.after(footer.clone());
                      exportFooter.remove();
                  }

                  var header = $('thead');
                  if (header.length > 0) {
                      var exporHeader = $(win.document.body).find('thead');
                      exporHeader.after(header.clone());
                      exporHeader.remove();
                  }

                  $(win.document.body).find('td:not(:first-child)')
                      .css('text-align', 'center');

                  var body = $('tbody');
                  var exporBody = $(win.document.body).find('tbody');
                  exporBody.after(body.clone());
                  exporBody.remove();

                  var notes = $('dl');
                  $(win.document.body).find('table')
                    .after(notes.clone());
              }
      }
    ]
  });

  os_table.buttons().container().appendTo($('.tableTools-container'));

  setTimeout(function() {
    $($('.tableTools-container')).find('a.dt-button').each(function() {
      var div = $(this).find(' > div').first();
      if(div.length == 1) div.tooltip({container: 'body', title: div.parent().text()});
      else $(this).tooltip({container: 'body', title: $(this).text()});
    });
  }, 500);
})