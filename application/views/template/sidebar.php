<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-dark">
    <!-- Brand Logo -->
    <div class="brand-link">
        <img src="<?= base_url('assets/img/logo.png'); ?>" alt="Logo" class="brand-image p-0">
        <span class="brand-text">Penjualan Barang</span>
    </div>

    <!-- Sidebar -->
    <div class="sidebar pt-2">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel d-flex border-0">
          <div class="image">
            <img src="<?= base_url('assets/img/user.png'); ?>" class="img-circle" alt="User">
          </div>
          <div class="info">
            <span class="d-block text-white">Kasir</span>
          </div>
        </div>

        <nav style="font-size: 14px;">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="true">
            <li class="nav-header pl-0 pt-0">Menu</l>
            <li class="nav-item">
              <a href="<?= base_url(); ?>" class="nav-link <?= $this->uri->segment('1') == '' ? 'active' : '' ?>">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Beranda</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('transaksi'); ?>" class="nav-link <?= $this->uri->segment('1') == 'transaksi' ? 'active' : '' ?>">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Transaksi</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('barang'); ?>" class="nav-link <?= $this->uri->segment('1') == 'barang' ? 'active' : '' ?>">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Data Barang</p>
              </a>
            </li>
            
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>