<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">
            <?= $title;?>
          </h1>
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
        <!-- /.col -->
        <div class="col-md-12">

          <div class="card card-primary card-tabs">
            <div class="card-header p-0 pt-1">
              <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="custom-tabs-one-home-tab" role="tab" aria-selected="false"
                    aria-controls="custom-tabs-one-home" href="#custom-tabs-one-home" data-toggle="pill">Koreksi Uraian Tugas</a>
                </li>
                <li class="nav-item">
                      <a class="nav-link" id="custom-tabs-one-profile-tab" role="tab" aria-selected="false" aria-controls="custom-tabs-one-profile" href="#custom-tabs-one-profile" data-toggle="pill">Masukkan Nilai Prilaku Kerja</a>
                </li>
                <!-- <li class="nav-item">
                  <a class="nav-link " id="custom-tabs-one-messages-tab" role="tab" aria-selected="true" aria-controls="custom-tabs-one-messages" href="#custom-tabs-one-messages" data-toggle="pill">Realisasi Tugas</a>
                </li> -->
              </ul>
            </div>
            <div class="card-body">
              <div class="tab-content" id="custom-tabs-one-tabContent">
                <!-- langkah 1 koreksi -->
                <div class="tab-pane active show fade" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                  <form action="<?= base_url('User_periksa/simpan_koreksi_skp') ?>" method="POST">
                  <div class="row">
                    <div class="col-md-6">
                      <span class="pull-left" style="font-size: 15pt">Nama Dinilai :
                        <?= $pegawai['nama'] ?>
                      </span>
                    </div>
                    <div class="col-md-6 text-right">
                      <span class="pull-right" style="font-size: 15pt">Nama Penilai :
                      <?= $penilai['nama'] ?>
                      </span>
                    </div>
                    <div class="col-md-12 text-right mt-2 mb-2">
                      <!-- <button type="button" class="btn btn-primary btn-sm" onclick="addKeg()"><i class="fa fa-plus"></i> Tambah
                        Data</button> -->
                    </div>
                   
                      <div class="col-md-12">
                        <input type="hidden" name="skp_id" value="<?= $skp['id'] ?>">
                        <input type="hidden" name="nilai_total" value="<?= $skp['nilai_total'] ?>">
                        <input type="hidden" name="pegawai_id" value="<?= $skp['pegawai_id'] ?>">
                        <table class="table table-hover table-sm" style="font-size: 10pt;">
                          <thead>
                            <tr>
                              <th width="400" class="text-center">Kegiatan</th>
                              <th width="115" class="text-center">Satuan</th>
                              <th width="115" class="text-center">Target Realisasi</th>
                              <th width="115" class="text-center">Capaian Realisasi</th>
                              <th width="115" class="text-center">Mutu Realisasi</th>
                              <th class="text-center">Koreksi Kegiatan</th>
                            </tr>
                          </thead>
                          <tbody id="table_keg1">
                            <!-- <input type="hidden" class="text-justify" name="skp_id" value="<?= $data['rinci_skp_id']?>"></input> -->
                            <?php $no = 1; foreach($rincian as $data) { ?>
                              <input type="hidden" class="text-justify" name="rinci_id[]" value="<?= $data['rinci_id']?>"></input>
                              <input type="hidden" class="text-justify" name="rinci_skp_id[]" value="<?= $data['rinci_skp_id']?>"></input>
                              <tr id="keg-<?= $no; ?>">
                                <td>
                                  <p class="text-justify" name="rinci_kegiatan[]"><?= $data['rinci_kegiatan'] ?></p>
                                </td>
                                <td>
                                  <p type="text" class="text-center" value="" name="rinci_satuan[]" id=""><?= $data['rinci_satuan'] ?></p>
                                </td>
                                <td>
                                  <p type="number" step="any" class="text-center" value="" name="rinci_target[]" id=""><?= $data['rinci_target'] ?></p>
                                </td>
                                <td>
                                  <p type="number" step="any" class="text-center" value="" name="rinci_realisasi[]" id=""><?= $data['rinci_realisasi'] ?></p>
                                </td>
                                <td>
                                  <p type="number" step="any" class="text-center" value="" name="rinci_mutu[]" id=""><?= $data['rinci_mutu'] ?></p>
                                </td>
                                <td>
                                  <textarea class="form-control" name="rinci_koreksi[]" placeholder="masukkan koreksi anda !" required></textarea>
                                </td>
                              </tr>
                            <?php } ?>
                          </tbody>
                        </table>
                        <p class="text-right fst-italic"><small>Note: Jika tidak ada koreksi kegiatan, masukkan text <b>"tidak ada koreksi"</b> pada kolom <b>Koreksi Kegiatan</b></small></p>
                      </div>
                      <!-- <div class="col-md-12 text-right">
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                      </div> -->
                  </div>
                </div>

                <!-- langkah 2 koreksi -->
                <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                  <div class="row">
                      <div class="col-md-6">
                        <span class="pull-left" style="font-size: 15pt">Nama Dinilai :
                          <?= $pegawai['nama'] ?>
                        </span>
                      </div>
                      <div class="col-md-6 text-right">
                        <span class="pull-right" style="font-size: 15pt">Nama Penilai :
                        <?= $penilai['nama'] ?>
                        </span>
                      </div>
                      <div class="col-md-12 text-right mt-2 mb-2">
                        <!-- <button type="button" class="btn btn-primary btn-sm" onclick="addKeg()"><i class="fa fa-plus"></i> Tambah
                          Data</button> -->
                      </div>
                      <div class="row">
                        <div class="col-md-3">
                          <!-- Profile Image -->
                          <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                              <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="<?= base_url('assets/');?>dist/img/<?= $pegawai['image'];?>" alt="User profile picture">
                              </div>

                              <h3 class="profile-username text-center"><?= $pegawai['nama'];?></h3>

                              <p class="text-muted text-center"><?= $pegawai['jabatan'];?></p>

                              <a class="btn btn-primary btn-block"><b>NILAI SKP TERAKHIR</b></a>
                              <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                  <b>N. Kinerja</b> <a class="float-right"><?= $pegawai['nilai_kinerja']?></a>
                                </li>
                                <li class="list-group-item">
                                  <b>N. Prilaku</b> <a class="float-right"><?= $pegawai['nilai_prilaku']?></a>
                                </li>
                                <li class="list-group-item">
                                  <b>N. Prestasi</b> <a class="float-right"><?= $pegawai['nilai_prestasi']?></a>
                                </li>
                              </ul>
                            </div>
                            <!-- /.card-body -->
                          </div>
                        </div>
                          <!-- /.card -->
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
                                <?= $pegawai['pendidikan']?>
                              </p>

                              <hr>

                              <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                              <p class="text-muted"><?= $pegawai['alamat']?></p>

                              <hr>

                              <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                              <p class="text-muted">
                                <span class="tag tag-danger"><?= $pegawai['skill']?></span>
                              </p>

                              <hr>

                              <strong><i class="far fa-file-alt mr-1"></i> Moto</strong>

                              <p class="text-muted"><?= $pegawai['moto']?></p>
                            </div>
                            <!-- /.card-body -->
                          </div>
                          <!-- /.card -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-6">
                          <div class="card">
                          <table class="table table-hover table-sm" style="font-size: 10pt;">
                            <thead>
                              <tr>
                                <th width="" class="text-center">Prilaku Kerja</th>
                                <th width="" class="text-center">Nilai</th>
                                <th width="" class="text-center">Kategori</th>
                              </tr>
                            </thead>
                            <tbody id="prilaku_kerja">
                              <tr>
                                <td>
                                  <label class="text-justify" name="rinci_kegiatan">Orientasi Pelayanan</label>
                                </td>
                                <td>
                                  <input type="text" class="form-control text-center" placeholder="berikan penilaian !" value="<?= $skp['orientasi'] ?>" name="orientasi" id="" onChange="setNilai(this)" required>
                                </td>
                                <td>
                                  <input type="text" class="form-control text-center" value="" id="orientasi">
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <label class="text-justify" name="rinci_kegiatan">Integritas</label>
                                </td>
                                <td>
                                  <input type="text" class="form-control text-center" placeholder="berikan penilaian !" value="<?= $skp['integritas'] ?>" name="integritas" id="" onChange="setNilai(this)" required>
                                </td>
                                <td>
                                  <input type="text" class="form-control text-center" value="" id="integritas">
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <label class="text-justify" name="rinci_kegiatan">Komitmen</label>
                                </td>
                                <td>
                                  <input type="text" class="form-control text-center" placeholder="berikan penilaian !" value="<?= $skp['komitmen'] ?>" name="komitmen" id="" onChange="setNilai(this)" required>
                                </td>
                                <td>
                                  <input type="text" class="form-control text-center" value="" id="komitmen">
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <label class="text-justify" name="rinci_kegiatan">Disiplin</label>
                                </td>
                                <td>
                                  <input type="text" class="form-control text-center" placeholder="berikan penilaian !"value="<?= $skp['disiplin'] ?>" name="disiplin" id="" onChange="setNilai(this)" required>
                                </td>
                                <td>
                                  <input type="text" class="form-control text-center" value="" id="disiplin">
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <label class="text-justify" name="rinci_kegiatan">Kerjasama</label>
                                </td>
                                <td>
                                  <input type="text" class="form-control text-center" placeholder="berikan penilaian !" value="<?= $skp['kerjasama'] ?>" name="kerjasama" id="" onChange="setNilai(this)" required>
                                </td>
                                <td>
                                  <input type="text" class="form-control text-center" value="" id="kerjasama">
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <label class="text-justify" name="rinci_kegiatan">Kepemimpinan</label>
                                </td>
                                <td>
                                  <input type="text" class="form-control text-center" placeholder="berikan penilaian !" value="<?= $skp['kepemimpinan'] ?>" name="kepemimpinan" id="" onChange="setNilai(this)" required>
                                </td>
                                <td>
                                  <input type="text" class="form-control text-center" value="" id="kepemimpinan">
                                </td>
                              </tr>
                              <!-- <tr>
                                <td>
                                  <label class="text-justify" name="rinci_kegiatan">TOTAL</label>
                                </td>
                                <td colspan="2">
                                  <input type="text" colspan="2" class="form-control text-center" value="" name="total" id="" onChange="setNilai(this)">
                                </td>
                              </tr> -->
                            </tbody>
                          </table>
                          </div>

                          <label class="form-check-label">Saya sebagai pejabat penilai, telah menelaah data saudar/i pemohon dan menyatakan data yang bersangkutan serstatus :</label>
                          
                          <div class="form-group">
                            <div class="form-check">
                              <input name="radio1" class="form-check-input" type="radio" required value="valid">
                              <label class="form-check-label">SKP Valid</label>
                            </div>
                            <div class="form-check">
                              <input name="radio1" class="form-check-input" type="radio" required value="tidak_valid">
                              <label class="form-check-label">SKP Tidak Valid</label>
                            </div>
                          </div>

                          <div class="col-md-12 text-right">
                            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                          </div>
                          <!-- /.card -->
                        </div>
                        <!-- /.col -->
                      </div>
                        
                  </div>
                  </form>
                </div>
                <!-- <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                  zzzz
                </div> -->
              </div>
            </div>

            <!-- /.card -->
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

<script type="text/javascript">
  $(document).ready(function () {
    $('#btn_sidebar').trigger('click');
  });

  let globalPosKeg = <?= count($rincian) + 1; ?>;

  function addKeg() {
    let idKeg = "keg-" + globalPosKeg;
    let isiHtml = `
        <tr id="${idKeg}">
          <td>
            <textarea class="form-control" name="rinci_kegiatan[]"></textarea>
          </td>
          <td>
            <input type="text" class="form-control" name="rinci_satuan[]" id="">
          </td>
          <td>
            <input type="number" step="any" class="form-control" name="rinci_target[]" id="">
          </td>
          <td>
            <input type="number" step="any" class="form-control" name="rinci_realisasi[]" id="">
          </td>
          <td>
            <input type="number" step="any" class="form-control" name="rinci_mutu[]" id="">
          </td>
          <td>
            <button type="button" class="btn btn-danger" onclick="removeKeg('${idKeg}')"><i class="fa fa-trash"></i></button>
          </td>
        </tr>
    `;

    globalPosKeg++;

    $('#table_keg1').append(isiHtml);
  }

  function removeKeg(idKeg) {
    $('#' + idKeg).remove();
  }

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



  function setNilai(obj){
    let nilai = $(obj).val();

    let hasil = '';
    if(nilai <= 50){
      hasil = 'buruk';
    }else if(nilai <= 60 && nilai >= 50 ){
      hasil = 'sedang';
    }else if(nilai <= 75 && nilai >= 60){
      hasil = 'cukup';
    }else if(nilai <= 90.99 && nilai >= 75){
      hasil = 'baik';
    }else if(nilai <= 100 && nilai >= 90.99){
      hasil = 'sangat baik'
    }

    $('#'+$(obj).attr('name')).val(hasil);

  }

</script>
