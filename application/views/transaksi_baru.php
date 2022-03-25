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
                                        <input type="number" name="qty" class="form-control" id="t_qty" value="1">
                                    </div>
                                </div>
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
</body>

</html>