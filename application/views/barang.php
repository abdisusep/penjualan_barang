<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Daftar Barang</title>
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
              <h5 class="m-0">Daftar Barang</h5>
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
                        <th>Aksi</th>
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
  <script>
    $(document).ready(function () {

      // Load Data Barang
      LoadDataBarang();

      // simpan barang
      $('#simpanBarang').click(function () {
        let data = $("#formTambahBarang").serialize();
        $.ajax({
          url: "http://localhost/penjualan_barang/tambah_barang",
          data: data,
          type: "post",
          dataType:'json',
          success: function(result){
            if (result.success) {
              LoadDataBarang();
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
              LoadDataBarang();
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
            if (result.success) {
              LoadDataBarang();
              $("#modalEditBarang").modal("hide");
              Message('success', result.message);
            }else{
              Message('error', result.message);
            }
          }
        });
      });

      // load data barang
      function LoadDataBarang() {
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
                '<td><button class="btn btn-primary editBarang" kb="'+data[i].kode_barang+ '">Edit</button>' +
                '<button class="btn btn-danger hapusBarang" kb="'+ data[i].kode_barang+ '">Hapus</button></td>' +
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
  </script>
</body>

</html>