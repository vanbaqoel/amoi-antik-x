
var pc_table;
var pc_id;

function add_pc() {
  save_method = 'add';
  $('form')[0].reset();
  $('.select2').trigger('change');
  $('.modal').modal('show');
  $('.modal-title').text('Tambah Data PC');
}

function edit_pc(id)
{
  save_method = 'update';
  $('form')[0].reset();
  $('.select2').trigger('change');

  //Ajax Load data from ajax
  $.ajax({
    url : "pcnss/edit_pc/" + id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
      $('[name="cboKategori"]').val(data.kategori).trigger('change');
      $('[name="txtMerek"]').val(data.merek);
      $('[name="txtTipe"]').val(data.tipe);
      $('[name="txtSN"]').val(data.sn);
      $('[name="txtProcessor"]').val(data.processor);
      $('[name="txtStorage"]').val(data.storage);
      $('[name="txtRAM"]').val(data.ram);
      $('[name="cboNIC"]').val(data.nic).trigger('change');
      $('[name="cboOptical"]').val(data.optical).trigger('change');
      $('[name="txtOS"]').val(data.os);
      $('[name="txtEdisiOS"]').val(data.edisi_os);
      $('[name="cboOrisinalitasOS"]').val(data.orisinalitas_os).trigger('change');
      $('[name="txtOffice"]').val(data.office);
      $('[name="txtAntivirus"]').val(data.antivirus);
      $('[name="txtAlamatIP"]').val(data.alamat_ip);
      $('[name="txtHostName"]').val(data.hostname);
      $('[name="cboJoinDomain"]').val(data.join_domain).trigger('change');
      $('[name="txtKodeBarang"]').val(data.kode_barang);
      $('[name="txtNUP"]').val(data.nup);
      $('[name="txtTahunPerolehan"]').val(data.tahun_perolehan);
      $('[name="cboKondisi"]').val(data.kondisi).trigger('change');
      $('[name="txtNIP"]').val(data.nip);
      $('[name="txtLokasi"]').val(data.lokasi);
      $('[name="txtKeterangan"]').val(data.keterangan);


      $('.modal').modal('show'); // show bootstrap modal when complete loaded
      $('.modal-title').text('Ubah Data PC'); // Set title to Bootstrap modal title

      pc_id = id;

    },
    error: function (jqXHR, textStatus, errorThrown)
    {
        alert('Gagal menarik data...');
    }
  });
}

function save()
{
  var url;
  if(save_method == 'add')
  {
    url = "pcnss/add_pc";
  }
  else
  {
    url = "pcnss/update_pc/" + pc_id;
  }

   // ajax adding data to database
  $.ajax({
    url : url,
    type: "POST",
    data: $('form').serialize(),
    dataType: "JSON",
    success: function(data)
    {
      alert("Data berhasil disimpan...");
      //if success close modal and reload ajax table
      $('.modal').modal('hide');
      pc_table.ajax.reload();// for reload a page
    },
    error: function (jqXHR, textStatus, errorThrown)
    {
        alert('Gagal menyimpan/mengubah data...');
    }
  });
}

function delete_pc(id)
{
  if(confirm('Apakah Anda yakin mau menghapus data ini?'))
  {
    // ajax delete data from database
    $.ajax({
      url : "pcnss/delete_pc/" + id,
      type: "POST",
      dataType: "JSON",
      success: function(data)
      {
        alert("Data berhasil dihapus...");
        pc_table.ajax.reload();
      },
      error: function (jqXHR, textStatus, errorThrown)
      {
        alert('Gagal menghapus data...');
      }
    });
  }
}

$(document).ready(function () {

  //Initialize Select2 Elements
  $('.select2').select2();

  $('.sidebar-menu').tree();
  pc_table =
    $('#dynamic-table')
    .DataTable({
      serverSide: false,
        //Load data for the table's content from an Ajax source
        ajax: {
            url: "pcnss/get_all", //Populate data using a method in controller
            type: "POST"
        },
      autoWidth: true,
      scrollX: true,
      scrollCollapse: true,
      order: [],
      lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
      columnDefs: [
          {
              targets: [ 1 ],
              width: "85px",
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

    /* <-- Datatables button */
    $.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';
    $.fn.dataTable.Buttons.swfPath = "<?= base_url('dist/swf/flashExport-1.2.4.swf') ?>";

    new $.fn.dataTable.Buttons(pc_table, {
      buttons: [
        {
          text: "<i class='fa fa-plus bigger-110 green'></i> <span>&nbsp;&nbsp;Tambah</span>",
          className: "btn btn-white btn-default btn-bold",
          titleAttr: "Tambah data baru",
          action: function ( e, dt, node, config ) {
                    add_pc();
          }
        },
        {
          extend: "excel",
          text: "<i class='fa fa-file-excel-o bigger-110 green'></i> <span>&nbsp;&nbsp;Excel</span>",
          className: "btn btn-white btn-default btn-bold",
          titleAttr: "Simpan sebagai file Excel",
          filename: "daftar-pc-non-span-sakti",
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
          title: 'DAFTAR PC NON SPAN/SAKTI',
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

    if (sk == '000') {pc_table.button('0').disable();}
})
