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
              <h5 class="m-0">List Barang</h5>
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
                  <a data-toggle="modal" data-target="#modalTambahBarang" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah</a>
                </div>
                <div class="card-body">
                  <table class="table table-bordered" id="tabelBarang">
                    <thead>
                      <tr>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Harga Barang</th>
                        <th>Stok</th>
                        <th>Opsi</th>
                      </tr>
                    </thead>
                    <tbody id="dataBarang"></tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- /.row -->

          <!-- Modal Edit Barang -->
          <div class="modal fade" id="modalEditBarang" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalEditBarangLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header border-light">
                  <h5 class="modal-title" id="modalEditBarangLabel">Edit Barang</h5>
                </div>
                <div class="modal-body">
                  <form id="formUpdateBarang">
                    <input type="text" name="e_kode_barang" class="d-none">  
                    <div class="form-row">
                      <div class="form-group col-md-12">
                        <label>Nama Barang</label>
                        <input type="text" name="e_nama_barang" class="form-control">
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label>Harga Barang</label>
                        <input type="number" name="e_harga_barang" class="form-control">
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-4">
                        <label>Stok</label>
                        <input type="number" name="e_stok" class="form-control">
                      </div>
                    </div>
                    <button type="button" id="updateBarang" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- EndModal Tambah Barang -->

          <!-- Modal tambah Barang -->
          <div class="modal fade" id="modalTambahBarang" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalTambahBarangLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header border-light">
                  <h5 class="modal-title" id="modalTambahBarangLabel">Tambah Barang</h5>
                </div>
                <div class="modal-body">
                <form id="formTambahBarang">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Nama Barang</label>
                                <input type="text" name="nama_barang" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Harga Barang</label>
                                <input type="number" name="harga_barang" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Stok</label>
                                <input type="number" name="stok" class="form-control" required>
                            </div>
                        </div>
                        <button type="button" id="simpanBarang" class="btn btn-dark">Simpan</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    </form>
                </div>
              </div>
            </div>
          </div>
          <!-- EndModal Tambah Barang -->

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