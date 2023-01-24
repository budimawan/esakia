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
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="<?= base_url('assets/')?>dist/img/<?= $user['image'];?>"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?= $user['nama'];?></h3>

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
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2 text-center">
                <b>IDENTITAS PEJABAT PENILAI & ATASAN PEJABAT PENILAI</b>
              </div><!-- /.card-header -->

            <?php echo form_open('User_pengajuan/ajukan_skp');?>
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <!-- Post -->
                    <div class="post">
                      <div class="user-block"> 
                        <ul class="list-group list-group-unbordered mb-3">
                          <li class="list-group-item p-3 mb-2 bg-warning text-dark">
                            <b>PILIH PEJABAT PENILAI</b>
                          </li>
                        </ul>
                        <div class="">
                          <div class="form-group">
                            <label for="inputStatus">Nama</label>
                            <select name="penilai_id" id="penilai_id" class="form-control custom-select" required>
                              <option value="">Select one</option>
                              <?php foreach($user2 as $r) : ?>
                                <?php if($r['nip'] != $this->session->userdata('nip')) { ?>
                                  <?php if($r['role_id'] == 1){?>
                                    <option value="<?= $r['id']; ?>"> <?= $r['nama']; ?> -- (<?= $r['jabatan']; ?>) </option>
                                    <?php } ?>
                                <?php } ?>
                              <?php endforeach ; ?>
                            </select>
                          </div>
                          
                          <!-- <div class="form-group">
                            <label for="inputName">Nomor Induk Pegawai</label>
                            <input type="text" name="nip" id="nip" class="form-control">
                          </div>
                          <div class="form-group">
                            <label for="inputClientCompany">Pangkat, Golongan Ruang</label>
                            <input type="text" name="pangkat" id="pangkat" class="form-control">
                          </div>
                          <div class="form-group">
                            <label for="inputProjectLeader">Jabatan/Pekerjaan</label>
                            <input type="text" name="jabatan" id="jabatan" class="form-control">
                          </div>
                          <div class="form-group">
                            <label for="inputProjectLeader">Unit Organisasi</label>
                            <input type="text" name="unit" id="unit" class="form-control">
                          </div> -->

                        </div>                        
                      </div>
                      <div class="user-block"> 
                        <ul class="list-group list-group-unbordered mb-3">
                          <li class="list-group-item p-3 mb-2 bg-warning text-dark">
                            <b>PILIH ATASAN PEJABAT PENILAI</b>
                          </li>
                        </ul>
                        <div class="">
                          <div class="form-group">
                            <label for="inputStatus">Nama</label>
                            <select name="atasan_id" id="atasan_id" class="form-control custom-select" required>
                              <option value="">Select one</option>
                              <?php foreach($user2 as $r) : ?>
                                <?php if($r['nip'] != $this->session->userdata('nip')) { ?>
                                  <?php if($r['role_id'] == 1 || $r['role_id'] == 3){?>
                                    <option value="<?= $r['id']; ?>"> <?= $r['nama']; ?> -- (<?= $r['jabatan']; ?>)</option>
                                    <?php } ?>
                                <?php } ?>
                              <?php endforeach ; ?>
                            </select>
                          </div>

                          <!-- <div class="form-group">
                            <label for="inputName">Nomor Induk Pegawai</label>
                            <input type="text" name="nip2" id="nip2" class="form-control">
                          </div>
                          <div class="form-group">
                            <label for="inputClientCompany">Pangkat, Golongan Ruang</label>
                            <input type="text" name="pangkat2" id="pangkat2" class="form-control">
                          </div>
                          <div class="form-group">
                            <label for="inputProjectLeader">Jabatan/Pekerjaan</label>
                            <input type="text" name="jabatan2" id="jabatan2" class="form-control">
                          </div>
                          <div class="form-group">
                            <label for="inputProjectLeader">Unit Organisasi</label>
                            <input type="text" name="unit2" id="unit2" class="form-control">
                          </div> -->

                        </div>                        
                      </div>

                      <div class="form-group row">
                      <!-- <label class="col-sm-12"for="inputClientCompany">PILIH TAHUN PERIODE SKP</label> -->
                          <button type="submit" class="btn btn-warning"> Mulai Buat SKP </button>
                      </div>
                      <!-- <a href="#" class="btn btn-warning"><b>Mulai Buat SKP</b></a> -->

                      <!-- /.user-block -->
                    </div>
                    <!-- /.post -->

                  </div>

                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            <?php echo form_close(); ?>

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

  <?php $this->load->view('template/footer_'); ?>
  
  <script type="text/javascript" >
 $('#nama').change(function(){ 
     var id=$(this).val();
     $.ajax({
         url : "<?php echo base_url('User_pengajuan/get_skp');?>",
         method : "POST",
         data : {id: id},
         async : true,
         dataType : 'json',
         success: function(data){

          $("#nip").val(data['nip']);
          $("#pangkat").val(data['pangkat_golongan']);
          $("#jabatan").val(data['jabatan']);
          $("#unit").val(data['unit_kerja']);
         }
     });
     return false;
 }); 

 $('#nama2').change(function(){ 
     var id=$(this).val();
     $.ajax({
         url : "<?php echo base_url('User_pengajuan/get_skp');?>",
         method : "POST",
         data : {id: id},
         async : true,
         dataType : 'json',
         success: function(data){

          $("#nip2").val(data['nip']);
          $("#pangkat2").val(data['pangkat_golongan']);
          $("#jabatan2").val(data['jabatan']);
          $("#unit2").val(data['unit_kerja']);
         }
     });
     return false;
 }); 
  
  </script>