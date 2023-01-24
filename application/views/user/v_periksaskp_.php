  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?= $title;?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
        <?= $this->session->flashdata('message');?>
          <div class="col-md-12">
            <div class="card">
              <div class="card-header p-2 text-center">
                <b class="text-uppercase">SKP YANG HARUS DINILAI OLEH <span class="text-danger"><?= $user['nama'];?></span></b>
              </div><!-- /.card-header -->
                <div class="card">
                      <div class="card-body">
                      <table id="example2" class="table table-bordered table-hover" style="font-size: 11pt">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Pegawai Dinilai</th>
                            <th>Waktu</th>
                            <th>Nilai Capaian SKP</th>
                            <th class="text-center">Status Penilaian</th>
                            <th class="text-center">Menu</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $no = 1; foreach($skp as $data) { ?>
                          <tr>
                            <td><?= $no++ ?>.</td>
                            <td><?= $data['nama'] ?></td>
                            <td><?= $data['tgl_ajuan'] ?></td>
                            <td><?= $data['nilai_total'] ?></td>
                            <td class="text-center">
                              <?php
                              if ($data['status_skp'] == 0) {
                                echo '<span class="badge badge-warning">Belum Diperiksa</span>';
                              } else {
                                echo '<span class="badge badge-success">Sudah Diperiksa</span>';
                              }
                              
                              ?>
                            </td>
                            <td class="text-center">
                              <?php if ($data['status_skp'] == 0) { ?>
                                <a class="btn btn-warning btn-sm" href="<?= base_url('User_periksa/periksa_skp/'.$data['id']) ?>">Periksa</a>
                              <?php } else { ?>
                                <a class="btn btn-primary btn-sm" href="<?= base_url('User_periksa/lihat_skp/'.$data['id']) ?>">Lihat</a>
                              <?php } ?>
                            </td>
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                      </div>
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->