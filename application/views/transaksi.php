<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Daftar Transaksi</title>
    <?php include 'template/css.php'; ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
  <div class="wrapper">

    <?php include 'template/navbar.php'; ?>
    <?php include 'template/sidebar.php'; ?>
   
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mt-3 mb-2">
            <div class="col-sm-12">
              <h5 class="m-0">Daftar Transaksi</h5>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header border-light">
                  <a href="<?= base_url('transaksi_baru') ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Transaksi Baru</a>
                </div>
                <div class="card-body">
                  <div>
                    <p>Filter tanggal :
                      <button class="btn btn-info" id="urut-terbaru">Terbaru</button>
                      <button class="btn" id="urut-terakhir">Terakhir</button>
                    </p>
                  </div>
                  <table class="table table-bordered" id="tabelTransaksi">
                    <thead>
                      <tr>
                        <th>Kode Transaksi</th>
                        <th>Item Transaki</th>
                        <th>Total Bayar</th>
                        <th>Tanggal</th>
                      </tr>
                    </thead>
                    <tbody id="dataTransaksi">
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <!-- Modal item -->
          <div class="modal fade" id="LihatTransaksi" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalLihatTransaksiLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header border-light">
                  <h5 class="modal-title" id="modalLihatTransaksi">Item Transaksi</h5>
                </div>
                <div class="modal-body">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Nama Barang</th>
                        <th>Harga Barang</th>
                        <th>Qty</th>
                        <th>Jumlah</th>
                      </tr>
                    </thead>
                    <tbody id="tampilItem">
                      <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                    </tbody>
                  </table>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- EndModal lihat item -->
          
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php include 'template/footer.php'; ?>
  </div>
  <!-- ./wrapper -->

  <?php include 'template/js.php'; ?>
  <script>
    $(document).ready(function () {

      LoadDataTransaksi();

      // filter desc
      $('#urut-terbaru').click(function () {
        $('#urut-terbaru').addClass('btn-info');
        $('#urut-terakhir').removeClass('btn-info');
        LoadDataTransaksi('desc');
      });

      // filter asc
      $('#urut-terakhir').click(function () {
        $('#urut-terbaru').removeClass('btn-info');
        $('#urut-terakhir').addClass('btn-info');
        LoadDataTransaksi('asc');
      });

      // lihat item
      $("#tabelTransaksi").on('click', '.lihatItem',function(){
        let kt = $(this).attr('kt');
        $("#LihatTransaksi").modal("show");
        LoadItemTransaksi(kt);
      });

      // Load data item
      function LoadItemTransaksi(kt) {
        $.ajax({
          url: 'http://localhost/penjualan_barang/get_item',
          type: 'post',
          data: {kode_transaksi:kt},
          dataType:'json',
          success: function(data) {
            let row = '';
            for (let i=0; i<data.length; i++) {
              row += '<tr>' +
                '<td>'+ data[i].nama_barang +'</td>' +
                '<td>'+ data[i].harga_barang +'</td>' +
                '<td>'+ data[i].qty +'</td>' +
                '<td> Rp.'+ data[i].harga_barang*data[i].qty +'</td>' +
              '</tr>';
              $('#tampilItem').html(row);
            }
          }
        });
      }

      // Load data transaksi
      function LoadDataTransaksi(filter = 'desc') {
        $.ajax({
          url: 'http://localhost/penjualan_barang/get_transaksi',
          type: 'post',
          data:{urut:filter},
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

  </script>
</body>

</html>