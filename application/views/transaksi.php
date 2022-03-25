<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>List Barang</title>
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