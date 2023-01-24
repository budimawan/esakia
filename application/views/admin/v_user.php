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
            <?php if (validation_errors()) : ?>
                <?= validation_errors(); ?>
            <?php endif; ?> 
          <div class="col-md-12">
            <div class="card">
              <div class="card-header p-2 text-center">
                <b class="text-uppercase">CRUD ALL USER</b>
              </div><!-- /.card-header -->
                <div class="card">
                    <div class="card-body">
                      <a href="" data-toggle="modal" data-target="#newMenuModal"><label class="btn btn-primary mb-3 ">Tambah User <i class="fas fa-user-plus"></i></label></a>
                      <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                          <th>#</th>
                          <th>Nama</th>
                          <th>Jabatan</th>
                          <th>Pangkat</th>
                          <th>Jenis Pengguna</th>
                          <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php $i = 1; ?>
                        <?php foreach ($user2 as $u ) : ?>
                        <tr>
                          <th scope="row"><?= $i; ?></th>
                          <td><?= $u['nama'] ?><br><?= $u['nip'] ?></td>
                          <td><?= $u['jabatan'] ?><br><?= $u['unit_kerja'] ?></td>
                          <td><?= $u['pangkat_golongan'] ?></td>
                          <td><?php if($u['role_id']==1){echo "user";}else{echo "admin";}?></td>
                          <td>
                            <!-- <a href="" data-toggle="modal" data-target="#newMenuModal2">
                              <label class="btn btn-success badge badge-success">Edit</label>
                            </a> -->
                            <a href="<?= base_url('Admin_user/reset_pasword/'.$u['id']) ?>" onclick="return confirm('Reset Password <?= $u['nama']?> ?');">
                              <label class="btn btn-warning badge badge-warning">Reset</label>
                            </a>
                            <a href="<?= base_url('Admin_user/delete_user/'.$u['id']) ?>" onclick="return confirm('Hapus User <?= $u['nama']?> ?');">
                              <label class="btn btn-danger badge badge-danger">Delete</label>
                            </a>
                          </td>
                        </tr>
                        <?php $i++; ?>
                        <?php endforeach; ?>

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

  <div class="modal fade" id="newMenuModal" tabindex="-1" aria-labelledby="newMenuModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newMenuModalLabel">Tambahkan User Baru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <?php echo form_open_multipart('Admin_user/insert_user');?>
      
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="nip" name="nip" placeholder="Nomor Induk Pegawai">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="Jabatan">
          </div>
          <div class="form-group ">
            <input type="text" class="form-control" id="unit_kerja" name="unit_kerja" placeholder="Unit Kerja">
          </div>
          <div class="form-group ">
            <input type="text" class="form-control" id="pangkat_golongan" name="pangkat_golongan" placeholder="Pangkat/Golongan">
          </div>
          <div class="form-group col-sm-12">
            <label for="">Photo Profile :</label>
            <div class="col-sm-12">
              <div class="row">
                <div class="col-sm-3">
                  <img src="<?= base_url('assets/')?>dist/img/user2-160x160.jpg" class="img-thumbnail">
                </div>

                <!-- <div class="col-sm-9">
                  <div class="custom-file">
                    <div class="">
                      <input type="file" class="file-upload-default" id="img" name="img">
                      <div class="input-group col-xs-12">
                        <input type="text" class="form-control file-upload-info" readonly="" placeholder="Tidak ada foto dipilih" id="img2" name="img2" value="<?= $user['image'];?>">
                      </div>
                      <div class="input-group col-xs-12">
                        <small>
                        <span class="input-group-append">
                          <i>max width x height = 700x700 Px <br>max size = 1 Mb </i>
                        </span>
                        </small>
                      </div>
                    </div>
                  </div>
                </div> -->

                <div class="col-sm-9">
                  <div class="custom-file">
                    <div class="">
                      <input type="file" class="file-upload-default" id="img" name="img" value="<?= $user['image'];?>">
                      <div class="input-group col-xs-12">
                        <!-- <input type="text" class="form-control file-upload-info" readonly="" placeholder="Tidak ada foto dipilih" id="img2" name="img2" value="<?= $user['image'];?>"> -->
                        <span class="input-group-append">
                          <!-- <button class="file-upload-browse btn btn-primary" type="button">Select Foto</button> -->
                        </span>
                      </div>
                      <div class="input-group col-xs-12">
                        <small>
                        <span class="input-group-append">
                          <i>max width x height = 700x700 Px <br>max size = 2 Mb </i>
                        </span>
                        </small>
                      </div>
                    </div>
                  </div>
                </div>

              </div>          
            </div>
          </div>
          <div class="form-group col-sm-12">
            <div class="form-check form-check-flat form-check-primary">
              <label for="is_active" class="form-check-label">
              <input type="checkbox" class="form-check-input" id="is_active" name="is_active" placeholder="Active" value="1" checked>
                Active? <i class="input-helper"></i>
              </label>
            </div>
          </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-warning" onclick="return confirm('Tambahkan User?');">Tambahkan User</button>
        </div>
      
      <?php echo form_close(); ?>
        
    </div>
  </div>
</div>
