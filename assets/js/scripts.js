$(document).ready(function () {

  LoadDataTransaksi();

  $("#tabelTransaksi").on('click', '.lihatItem',function(){
    let kt = $(this).attr('kt');
    alert(kt)
  });

    function LoadDataTransaksi() {
    $.ajax({
      url: 'http://localhost/penjualan_barang/get_transaksi',
      type: 'get',
      dataType:'json',
      success: function(data) {
        let row = '';
        for (let i=0; i<data.length; i++) {
          row += '<tr>' +
            '<td>'+data[i].kode_transaksi+'</td>' +
            '<td><button type="button" class="btn btn-info btn-sm lihatItem" kt="'+data[i].kode_transaksi+'">Lihat Item</button></td>' +
            '<td>Rp.'+data[i].total_bayar+'</td>' +
            '<td>'+data[i].tanggal+'</td>' +
          '</tr>';

          $('#dataTransaksi').html(row);
        }
      }
    });
  }

  // message sweetalert
  function Message(type, text) {
    Swal.fire({
      icon: type,
      html: text,
      showConfirmButton: false,
      timer: 1500
    })
  }

});
