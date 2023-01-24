  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url('Auth');?>" class="brand-link">
      <img src="<?= base_url('assets/');?>dist/img/logo_esakia2.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><b>E-SAKIA</b></span>
    </a>

    <?php 
      $this->db->where('id', $this->session->userdata('id'));
      $user = $this->db->get('user')->row_array();
    ?>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= base_url('assets/');?>dist/img/<?= $user['image'];?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info ">
          <a href="#" class="d-block"><?= $user['nama'];?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-header">MENU</li>
          <li class="nav-item">
            <a href="<?= base_url('User_dashboard');?>" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('User_pengajuan');?>" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>Buat SKP Baru</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('User_riwayat');?>" class="nav-link">
              <i class="nav-icon fas fa-history"></i>
              <p>Riwayat SKP</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('User_periksa');?>" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>Periksa SKP</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>


