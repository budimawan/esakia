  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-9">
            <h1 class="m-0"><?= $title;?></h1>
          </div><!-- /.col -->
          <div class="col-sm-3">
            <?= $this->session->flashdata('message');?>
            <?php if (validation_errors()) : ?>
                <?= validation_errors(); ?>
            <?php endif; ?> 
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= $user['nilai_prestasi']?><sup style="font-size: 20px">%</sup></h3>
                <p>SKP Terakhir</p>
              </div>
              <div class="icon">
                <i class="fas fa-star-half-alt"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>
                  <?php
                    $this->db->like('status_skp', 1);
                    $this->db->where('pegawai_id', $this->session->userdata('id'));
                    $this->db->from('skp');
                    echo $this->db->count_all_results();
                   ?>
                </h3>
                <p>Jumlah SKP Diterima</p>
              </div>
              <div class="icon">
                <i class="fas fa-file-word"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>
                  <?php
                    $this->db->like('status_skp', 0);
                    $this->db->where('penilai_id', $this->session->userdata('id'));
                    $this->db->from('skp');
                    echo $this->db->count_all_results();
                  ?>
                </h3>
                <p>SKP Harus Diperiksa</p>
              </div>
              <div class="icon">
                <i class="fas fa-clipboard-check"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>
                  <?php
                    $this->db->like('status_skp', 2);
                    $this->db->where('pegawai_id', $this->session->userdata('id'));
                    $this->db->from('skp');
                    echo $this->db->count_all_results();
                  ?>
                </h3>
                <p>SKP Ditolak</p>
              </div>
              <div class="icon">
                <i class="fas fa-times-circle"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
        </div>
      </div><!-- /.container-fluid -->

      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="<?= base_url('assets/')?>dist/img/<?= $user['image'];?>"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center text-uppercase"><?= $user['nama'];?></h3>

                <p class="text-muted text-center"><?= $user['jabatan'];?></p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Kinerja</b> <a class="float-right"><?= $user['nilai_kinerja'];?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Prilaku</b> <a class="float-right"><?= $user['nilai_prilaku'];?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Prestasi Kerja</b> <a class="float-right"><?= $user['nilai_prestasi'];?></a>
                  </li>
                </ul>
                <ul class="list-group list-group-unbordered mb-3">
                    <a href="" data-toggle="modal" data-target="#newMenuModal" class="btn btn-success"><b>PERBARUI DATA PRIBADI</b></a>
                </ul>
                <?php $tgl_update = explode(" ", $user['tgl_update']);?>
                <p class="text-danger fst-italic"><small>Terakhir diperbarui tanggal <?= date($tgl_update[0]);?>, pukul <?= date($tgl_update[1]);?></small></p>              
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <div class="col-md-3">
            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">About Me</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-book mr-1"></i> Education</strong>

                <p class="text-muted">
                  <?= $user['pendidikan']?>
                </p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                <p class="text-muted"><?= $user['alamat']?></p>

                <hr>

                <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                <p class="text-muted">
                  <span class="tag tag-danger"><?= $user['skill']?></span>
                </p>

                <hr>

                <strong><i class="far fa-file-alt mr-1"></i> Moto</strong>

                <p class="text-muted"><?= $user['moto']?></p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-6">
            <div class="card">
              <div class="card-body"> 

              <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title">Ganti Pasword</h3>
                </div>
              <!-- /.card-header -->
              <!-- form start -->
                <form class="action=" method="post" action="<?=base_url('User_dashboard/ganti_pasword');?>">
                  <div class="card-body">
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-3 col-form-label">PASWORD LAMA</label>
                      <div class="col-sm-9">
                        <input type="password" class="form-control" id="pas_lama" name="pas_lama" placeholder="OLD PASSWORD" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-3 col-form-label">PASWORD BARU</label>
                      <div class="col-sm-9">
                        <input type="password" class="form-control" id="pas_baru" name="pas_baru" placeholder="NEW PASSWORD" required>
                        <input type="password" class="form-control" id="pas_baru2" placeholder="REPEAT NEW PASSWORD" name="pas_baru2" required>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-warning" onclick="return confirm('Yakin mengubah password?');">Ubah Pasword</button>
                  </div>
                  <!-- /.card-footer -->
                </form>
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


<!-- modal edit data user -->
<div class="modal fade" id="newMenuModal" tabindex="-1" aria-labelledby="newMenuModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newMenuModalLabel">Lengkapi Data Pribadi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <?php echo form_open_multipart('User_dashboard/updatedatauser');?>
      
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap" value="<?= $user['nama'];?>">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="nip" name="nip" placeholder="Nomor Induk Pegawai" value="<?= $user['nip'];?>">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="Jabatan" value="<?= $user['jabatan'];?>">
          </div>
          <div class="form-group ">
            <input type="text" class="form-control" id="unit_kerja" name="unit_kerja" placeholder="Unit Kerja" value="<?= $user['unit_kerja'];?>">
          </div>
          <div class="form-group ">
            <input type="text" class="form-control" id="pangkat_golongan" name="pangkat_golongan" placeholder="Pangkat/Golongan" value="<?= $user['pangkat_golongan'];?>">
          </div>
          <div class="form-group">
            <textarea type="text" class="form-control" id="pendidikan" name="pendidikan" placeholder="Riwayat Pendidikan" value="<?= $user['pendidikan'];?>"><?= $user['pendidikan'];?></textarea>
          </div>
          <div class="form-group">
            <textarea type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat Pribadi" value="<?= $user['alamat'];?>"><?= $user['alamat'];?></textarea>
          </div>
          <div class="form-group ">
            <textarea type="text" class="form-control" id="skill" name="skill" placeholder="Soft Skills" value="<?= $user['skill'];?>"><?= $user['pendidikan'];?></textarea>
          </div>
          <div class="form-group ">
            <input type="text" class="form-control" id="moto" name="moto" placeholder="Moto" value="<?= $user['moto'];?>">
          </div>
          <div class="form-group col-sm-12">
            <label for="">Photo Profile :</label>
            <div class="col-sm-12">
              <div class="row">
                <div class="col-sm-3">
                  <img src="<?= base_url('assets/')?>dist/img/<?= $user['image'];?>" class="img-thumbnail">
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
                        <input type="text" class="form-control file-upload-info" readonly="" placeholder="Tidak ada foto dipilih" id="img2" name="img2" value="<?= $user['image'];?>">
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
          <button type="submit" class="btn btn-warning" onclick="return confirm('Simpan data pribadi anda?');">Update</button>
        </div>
      
      <?php echo form_close(); ?>
        
    </div>
  </div>
</div>