<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tambah Barang</title>
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
              <h5 class="m-0">Tambah Barang</h5>
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
                  <a href="<?= base_url(uri_string().'?kode_transaksi='.$_GET['kode_transaksi'].'&batal=true') ?>" class="btn btn-danger"><i class="fas fa-angle-left"></i> Batal</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-5">
                            <form id="formTransaksi">
                            <input type="text" name="kode_transaksi" class="d-none" value="<?= $_GET['kode_transaksi']; ?>">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label>Cari Nama/Kode Barang</label>
                                        <select class="form-control" name="kode_barang" id="selectBarang">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>Qty</label>
                                        <input type="number" name="qty" class="form-control" id="t_qty" value="0">
                                    </div>
                                </div>
                                <input type="number" id="total_bayar" class="d-none">
                                <button type="button" id="tambahItem" class="btn btn-dark">Tambah</button>
                                <button type="button" id="selesaiTransaksi" class="btn btn-success">Selesai</button>
                            </form>
                        </div>
                        <div class="col-lg-7">
                            <table class="table table-bordered" id="tabelItemBarang">
                                <thead>
                                    <tr>
                                        <th>Nama Barang</th>
                                        <th>Qty</th>
                                        <th>Jumlah</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="dataItemTransaksi">
                                </tbody>
                                <tfooter>
                                  <tr>
                                    <td colspan="2" class="text-right font-weight-bold">Total</td>
                                    <td colspan="2">Rp. <span id="totalBayar"></span></td>
                                  </tr>
                                </tfooter>
                            </table>
                        </div>
                    </div>
                    
                <div>
                        
                    </div>
                </div>
              </div>
            </div>
          </div>
          
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

      LoadDataBarang();
      LoadItemTransaksi();

      $('#selectBarang').select2({
        theme: 'bootstrap4',
      });

      // tambah item transaksi
      $('#tambahItem').click(function () {
        let data = $("#formTransaksi").serialize();
        $.ajax({
          url: "<?= base_url('tambah_item'); ?>",
          data: data,
          type: "post",
          dataType:'json',
          success: function(result){
            console.log(result)
            if (result.success) {
              $('#t_qty').val('0');
              LoadItemTransaksi();
            }else{
              $('#t_qty').val('0');
              Message('error', result.message);
            }
          }
        });
      });

      // hapus item
      $("#tabelItemBarang").on('click', '.hapusItem',function(){
        let ki = $(this).attr('ki');
        let kb = $(this).attr('kb');
        $.ajax({
          url: "<?= base_url('hapus_item'); ?>",
          type: 'post',
          dataType:'json',
          data: 'ki='+ki+'&kb='+kb+'&kt=<?= $_GET['kode_transaksi']; ?>',
          success: function(result){
            console.log(result)
            if (result.success) {
              LoadItemTransaksi();
            }
          }
        });
      });


      // selesai transaksi
      $('#selesaiTransaksi').click(function () {
        let tb = $('#total_bayar').val();
        $.ajax({
          url: "<?= base_url('selesai_transaksi'); ?>",
          type: 'post',
          dataType:'json',
          data: 'tb='+tb+'&kt=<?= $_GET['kode_transaksi']; ?>',
          success: function(result){
            console.log(result)
            if (result.success) {
              Message('success', result.message);
              window.setTimeout(function() {
                  window.location.href = '<?= base_url('transaksi'); ?>';
              }, 1400);
            }
          }
        });
      });

      // Load Barang
      function LoadDataBarang() {
        $.ajax({
          url: '<?= base_url('get_barang'); ?>',
          type: 'get',
          dataType:'json',
          success: function(data) {
            let row = '';
            for (let i=0; i<data.length; i++) {
              row += '<option value="'+data[i].kode_barang+'">'+data[i].nama_barang+' - Rp.'+data[i].harga_barang+'</option>';
              $('#selectBarang').html(row);
            }
          }
        });
      }

      // Load data item
      function LoadItemTransaksi() {
        $.ajax({
          url: '<?= base_url('get_item'); ?>',
          type: 'post',
          data: 'kode_transaksi=<?= $_GET['kode_transaksi']; ?>',
          dataType:'json',
          success: function(data) {
            // console.log(data.length)
            if (data.length < 1) {
              $('#dataItemTransaksi').hide();
              $('#selesaiTransaksi').hide();
            }else{
              $('#dataItemTransaksi').show();
              $('#selesaiTransaksi').show();
            }
            let row = '';
            let total = 0;
            for (let i=0; i<data.length; i++) {
              total = total + data[i].harga_barang * data[i].qty
              row += '<tr>' +
                '<td>'+ data[i].nama_barang +'</td>' +
                '<td>'+ data[i].qty +'</td>' +
                '<td> Rp.'+ data[i].harga_barang*data[i].qty +'</td>' +
                '<td><button class="btn btn-danger btn-sm hapusItem" kb="'+data[i].kode_barang+'" ki="'+data[i].kode_item_transaksi+'"><i class="fas fa-times"></i></button></td>' +
              '</tr>';

              $('#dataItemTransaksi').html(row);
            }
            $('#totalBayar').html(total);
            $('#total_bayar').val(total);
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