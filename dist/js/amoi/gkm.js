
var gkm_table;
var gkm_id;


function edit_gkm(id)
{
  window.location = document.location.protocol + "//" + document.location.host + "/amoi-antik/gkm/ru/" + id;
}

function delete_gkm(id)
{
  bootbox.confirm(
    '<div class="col-xs-12" style="display: flex;align-items: center;" ><i class="fa fa-question-circle fa-4x text-blue"></i>&nbsp;&nbsp;&nbsp;Apakah Anda yakin mau menghapus data ini?</div>',
    function (result)
    {
      if (result) {
        // ajax delete data from database
        $.ajax({
          url : document.location.protocol + "//" + document.location.host + "/amoi-antik/gkm/delete_gkm/" + id,
          type: "POST",
          dataType: "JSON",
          success: function(data)
          {
            if (data.status) {
              bootbox.alert(
                '<div class="col-xs-12" style="display: flex;align-items: center;" ><i class="fa fa-check-circle fa-4x text-green"></i>&nbsp;&nbsp;&nbsp;Data berhasil dihapus&hellip;</div>',
                function () {
                  gkm_table.ajax.reload();
                }
              );
            } else {
              bootbox.alert(
                '<div class="col-xs-12" style="display: flex;align-items: center;" ><i class="fa  fa-times-circle fa-4x text-red"></i>&nbsp;&nbsp;&nbsp;Gagal menghapus data&hellip;</div>');
            }
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
            bootbox.alert(
              '<div class="col-xs-12" style="display: flex;align-items: center;" ><i class="fa  fa-times-circle fa-4x text-red"></i>&nbsp;&nbsp;&nbsp;Gagal menghapus data&hellip;</div>');
          }
        });
      }
    }
  );
}

function printElement(elem)
{
  /*var domClone = elem.cloneNode(true);*/
  var domClone = elem.cloneNode(true);;
  $('.profile-info-row').each(function( index ){
    if (index > 4) {
      domClone.appendChild(this.cloneNode(true));
    }
  });

  var $printSection = document.getElementById("printSection");

  if (!$printSection) {
    var $printSection = document.createElement("div");
    $printSection.id = "printSection";
    document.body.appendChild($printSection);
  }

  $printSection.innerHTML = "<h3>&nbsp;&nbsp;DATA DETAIL TELEVISI</h3>";

  $printSection.appendChild(domClone);
}

$(document).ready(function () {

  //Initialize Select2 Elements
  $('.select2').select2();

  $('.sidebar-menu').tree();
  gkm_table =
    $('#dynamic-table').DataTable({
      serverSide: false,
      /* Load data for the table's content from an Ajax source */
      ajax: {
          url: document.location.protocol + "//" + document.location.host + "/amoi-antik/gkm/get_all", /* Populate data using a method in controller */
          type: "POST"
      },
      autoWidth: false,
      scrollX: true,
      scrollCollapse: true,
      order: [],
      lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
      columnDefs: [
        {
          targets: [ 0, 1, 3 ],
          className: "text-center"
        },
        {
            targets: [ 4, -1 ], /* targeting the last column */
            width: "125px",
            sortable: false,
            className: "text-center"
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
        "search":         "Cari: ",
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

  /* <-- Datatables button */
  $.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group';
  $.fn.dataTable.Buttons.swfPath = document.location.protocol + "//" + document.location.host + "/amoi-antik/dist/swf/flashExport-1.2.4.swf";

  new $.fn.dataTable.Buttons(gkm_table, {
    buttons: [
      {
        text: "<i class='fa fa-plus bigger-110 green'></i> <span>&nbsp;&nbsp;Tambah</span>",
        className: "btn btn-default",
        titleAttr: "Tambah data baru",
        action: function ( e, dt, node, config ) {
          window.location = document.location.protocol + "//" + document.location.host + "/amoi-antik/gkm/ru/add";
        }
      },
      {
        extend: "excel",
        text: "<i class='fa fa-file-excel-o bigger-110 green'></i> <span>&nbsp;&nbsp;Excel</span>",
        className: "btn btn-white btn-default btn-bold",
        titleAttr: "Simpan sebagai file Excel",
        filename: "daftar-gkm",
        exportOptions: {
          orthogonal: 'sort',
          columns: ':not(.no-export)'
        }
      },
      {
        extend: "print",
        text: "<i class='fa fa-print bigger-110 grey'></i> <span>&nbsp;&nbsp;Cetak</span>",
        className: "btn btn-default",
        titleAttr: "Cetak",
        title: 'DAFTAR GKM TIK',
        exportOptions: {
          columns: ':not(.no-export)'
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
          $('body *').removeClass('hide-me'); /* Menghindari bentrok dengan print detail */
        }
      }
    ]
  });

  gkm_table.buttons().container().appendTo($('.tableTools-container'));

  setTimeout(function() {
    $($('.tableTools-container')).find('a.dt-button').each(function() {
      var div = $(this).find(' > div').first();
      if(div.length == 1) div.tooltip({container: 'body', title: div.parent().text()});
      else $(this).tooltip({container: 'body', title: $(this).text()});
    });
  }, 500);

  /* Disable Tambah button if logged in as Administrator */
  if (cl == 1) {gkm_table.button('0').disable();}

  $('#btnPrint').on('click', function () {
    printElement(document.getElementById("printThis"));
    $('body *').addClass('hide-me'); /* Menghindari bentrok dengan print datatable */

    window.print();
  });
})
