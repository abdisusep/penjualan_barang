$(document).ready(function () {

  $('#selectBarang').select2({
    theme: 'bootstrap4',
  });

  LoadData();
  LoadDataTransaksi();
  LoadItemTransaksi();

  // tambah item transaksi
  $('#tambahItem').click(function () {
    let data = $("#formTransaksi").serialize();
    $.ajax({
			url: "http://localhost/penjualan_barang/tambah_item",
			data: data,
			type: "post",
      dataType:'json',
			success: function(result){
        if (result.success) {
          $('#t_qty').val('1');
          LoadItemTransaksi();
        }else{
          $('#t_qty').val('1');
          Message('error', result.message);
        }
			}
		});
  });

  // selesai transaksi
  $('#selesaiTransaksi').click(function () {
    alert('a')
  });

  // simpan barang
  $('#simpanBarang').click(function () {
    let data = $("#formTambahBarang").serialize();
		$.ajax({
			url: "http://localhost/penjualan_barang/tambah_barang",
			data: data,
			type: "post",
      dataType:'json',
			success: function(result){
        console.log(result)
				if (result.success) {
          LoadData();
          $("#modalTambahBarang").modal("hide");
          Message('success', result.message);
        }else{
          Message('error', result.message);
        }
			}
		});
  });

  // hapus barang
  $("#tabelBarang").on('click', '.hapusBarang',function(){
    let kode_barang = $(this).attr('kb');
    $.ajax({
			url: "http://localhost/penjualan_barang/hapus_barang",
      type: 'post',
      dataType:'json',
      data: {kb:kode_barang},
			success: function(result){
				if (result.success) {
          LoadData();
          Message('success', result.message);
        }
			}
		});
  });

  // form edit barang
  $("#tabelBarang").on('click', '.editBarang',function(){
    let kode_barang = $(this).attr('kb');
    $("#modalEditBarang").modal("show");
    $.ajax({
			url: "http://localhost/penjualan_barang/detail_barang",
      type: 'post',
      dataType:'json',
      data: {kb:kode_barang},
			success: function(result){
				// console.log(result)
        $('[name=e_kode_barang]').val(result.kode_barang);
        $('[name=e_nama_barang]').val(result.nama_barang);
        $('[name=e_harga_barang]').val(result.harga_barang);
        $('[name=e_stok]').val(result.stok);
			}
		});
  });

  // update data barang
  $('#updateBarang').click(function () {
    let data = $("#formUpdateBarang").serialize();
		$.ajax({
			url: "http://localhost/penjualan_barang/update_barang",
			data: data,
			type: "post",
      dataType:'json',
			success: function(result){
        // console.log(result)
				if (result.success) {
          LoadData();
          $("#modalEditBarang").modal("hide");
          Message('success', result.message);
        }else{
          Message('error', result.message);
        }
			}
		});
  });

  $("#tabelTransaksi").on('click', '.lihatItem',function(){
    let kt = $(this).attr('kt');
    alert(kt)
  });

  function LoadItemTransaksi() {
    $.ajax({
      url: 'http://localhost/penjualan_barang/get_item',
      type: 'get',
      dataType:'json',
      success: function(data) {
        console.log(data)
        let row = '';
        let total = 0;
        for (let i=0; i<data.length; i++) {
          total = total + data[i].harga_barang * data[i].qty
          row += '<tr>' +
            '<td>'+ data[i].nama_barang +'</td>' +
            '<td>'+ data[i].qty +'</td>' +
            '<td> Rp.'+ data[i].harga_barang*data[i].qty +'</td>' +
            '<td><button class="btn btn-danger btn-sm hapusItem" ki="'+ data[i].kode_item_transaksi+ '"><i class="fas fa-times"></i></button></td>' +
          '</tr>';

          $('#dataItemTransaksi').html(row);
        }
        $('#totalBayar').html(total);
      }
    });
  }


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

  // load data barang
  function LoadData() {
    $.ajax({
      url: 'http://localhost/penjualan_barang/get_barang',
      type: 'get',
      dataType:'json',
      success: function(data) {
        let row = '';
        let row2 = '';
        for (let i=0; i<data.length; i++) {
          row += '<tr>' +
            '<td>'+ data[i].kode_barang +'</td>' +
            '<td>'+ data[i].nama_barang +'</td>' +
            '<td> Rp.'+ data[i].harga_barang +'</td>' +
            '<td>'+ data[i].stok +'</td>' +
            '<td><button class="btn btn-primary editBarang" kb="'+data[i].kode_barang+ '">Edit</button></td>' +
            '<td><button class="btn btn-danger hapusBarang" kb="'+ data[i].kode_barang+ '">Hapus</button></td>' +
          '</tr>';

          row2 += '<option value="'+data[i].kode_barang+'">'+data[i].nama_barang+' - Rp.'+data[i].harga_barang+'</option>';
          $('#dataBarang').html(row);
          $('#selectBarang').html(row2);
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
