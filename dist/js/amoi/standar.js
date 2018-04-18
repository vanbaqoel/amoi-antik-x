function a(kategori, unit, nm_unit) {
    window.open('standar_detail/standar_view/' + kategori + '/' + unit + '/' + nm_unit, '_blank');
}

$(document).ready(function () {
  standar_table = $('#standar-table').DataTable({
      serverSide: false,
      //Load data for the table's content from an Ajax source
      ajax: {
            url: "standar/get_all", //Populate data using a method in controller
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
            var cSum = aSum - bSum;
            var dSum = rows
                .data()
                .pluck(6)
                .reduce( function (a, b) {
                    return a + b.replace(/[^\d]/g, '')*1;
                }, 0);
            var eSum = aSum - dSum;
            var fSum = bSum - dSum;

            return $('<tr/>')
                .append( '<td>JUMLAH</td>' )
                .append( '<td>' + aSum + '</td>' )
                .append( '<td>' + bSum + '</td>' )
                .append( '<td>' + cSum + '</td>' )
                .append( '<td>' + dSum + '</td>' )
                .append( '<td>' + eSum + '</td>' )
                .append( '<td>' + fSum + '</td>' );
        }
      },
      columnDefs: [
        {
          targets: [ 3, 4, 5, 6, 7, 8 ],
          className: "text-center"
        },
        {
          targets: [ 0, 1 ],
          visible: false
        }
      ],
      rowCallback: function( row, data, index ) {
        $('td:eq(3)', row).wrapInner("<a href='#' onClick='a(" + '"' + data[2] + '", "' + data[0] + '", "' + data[1] + '")' + "'></a>");
      }
  });

    /* <-- Datatables button */
    $.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';
    $.fn.dataTable.Buttons.swfPath = "<?= base_url('dist/swf/flashExport-1.2.4.swf') ?>";

    new $.fn.dataTable.Buttons(standar_table, {
      buttons: [
        {
          extend: "excel",
          text: "<i class='fa fa-file-excel-o bigger-110 green'></i> <span>&nbsp;&nbsp;Excel</span>",
          className: "btn btn-white btn-default btn-bold",
          titleAttr: "Simpan sebagai file Excel",
          filename: "standar",
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
          title: 'LAPORAN PEMENUHAN STANDAR',
          exportOptions: {
                    columns: ':visible'
                },
          customize: function (win) {
                    $(win.document.body).css('font-size', '10pt');
                    $(win.document.body).find('table')
                        .addClass('compact')
                        .css('font-size', 'inherit');
                    $(win.document.body).find('h1')
                        .css('text-align','center')
                        .after('<center><h3>' + sname + '</h3></center><br />');

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

    standar_table.buttons().container().appendTo($('.tableTools-container'));

    setTimeout(function() {
      $($('.tableTools-container')).find('a.dt-button').each(function() {
        var div = $(this).find(' > div').first();
        if(div.length == 1) div.tooltip({container: 'body', title: div.parent().text()});
        else $(this).tooltip({container: 'body', title: $(this).text()});
      });
    }, 500);
})