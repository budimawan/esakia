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

        <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-edit"></i>
              SKP <?= $pegawai['nama']?>
            </h3>
          </div>
          <div class="card-body">
            <h4>Format SKP </h4>
            <div class="row">
              <div class="col-3 col-sm-3">
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
              <div class="col-2 col-sm-2">
                <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                  <a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill" href="#vert-tabs-home" role="tab" aria-controls="vert-tabs-home" aria-selected="true"><b>Data SKP</b></a>
                  <a class="nav-link" id="vert-tabs-profile-tab" data-toggle="pill" href="#vert-tabs-profile" role="tab" aria-controls="vert-tabs-profile" aria-selected="false"><b>Sasaran Kerja</b></a>
                  <a class="nav-link" id="vert-tabs-messages-tab" data-toggle="pill" href="#vert-tabs-messages" role="tab" aria-controls="vert-tabs-messages" aria-selected="false"><b>Capaian Kerja</b></a>
                  <a class="nav-link" id="vert-tabs-settings-tab" data-toggle="pill" href="#vert-tabs-settings" role="tab" aria-controls="vert-tabs-settings" aria-selected="false"><b>Penilaian SKP</b></a>
                </div>
              </div>
              <div class="col-7 col-sm-7">
                <div class="tab-content" id="vert-tabs-tabContent">
                  <div class="tab-pane text-left fade show active" id="vert-tabs-home" role="tabpanel" aria-labelledby="vert-tabs-home-tab">
                    <table class="table table-sm">
                      <thead>
                        <tr>
                          <th scope="col" colspan="3" class="text-center"><img class="img img-fluid" src="<?= base_url('assets/');?>dist/img/logo-garuda.png" alt="User profile picture"><br>PENILAIAN PRESTASI KERJA<br>PEGAWAI NEGERI SIPIL</th>
                        </tr>
                        <tr>
                          <th scope="col" width="20" colspan="2">PEMERINTAH KABUPATEN MOROWALI</th>
                          <th scope="col" class="text-right">JANGKA WAKTU PENILAIAN<br>Januari s/d Desember 2020</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><b>1</b></td>
                          <td colspan="2"><b>YANG DINILAI</b></td>
                        </tr>
                        <tr>
                          <td></td>
                          <td>N A M A </td>
                          <td><?= $pegawai['nama']?></td>
                        </tr>
                        <tr>
                          <td></td>
                          <td>N I P</td>
                          <td><?= $pegawai['nip']?></td>
                        </tr>
                        <tr>
                          <td></td>
                          <td>Pangkat, golongan ruang</td>
                          <td><?= $pegawai['pangkat_golongan']?></td>
                        </tr>
                        <tr>
                          <td></td>
                          <td>Jabatan/Pekerjaan</td>
                          <td><?= $pegawai['jabatan']?></td>
                        </tr>
                        <tr>
                          <td></td>
                          <td>Unit Organisasi</td>
                          <td><?= $pegawai['unit_kerja']?></td>
                        </tr>
                        <tr>
                          <td><b>2</b></td>
                          <td colspan="2"><b>PEJABAT PENILAI</b></td>
                        </tr>
                        <tr>
                          <td></td>
                          <td>N A M A </td>
                          <td><?= $penilai['nama']?></td>
                        </tr>
                        <tr>
                          <td></td>
                          <td>N I P</td>
                          <td><?= $penilai['nip']?></td>
                        </tr>
                        <tr>
                          <td></td>
                          <td>Pangkat, golongan ruang</td>
                          <td><?= $penilai['pangkat_golongan']?></td>
                        </tr>
                        <tr>
                          <td></td>
                          <td>Jabatan/Pekerjaan</td>
                          <td><?= $penilai['jabatan']?></td>
                        </tr>
                        <tr>
                          <td></td>
                          <td>Unit Organisasi</td>
                          <td><?= $penilai['unit_kerja']?></td>
                        </tr>
                        <tr>
                          <td><b>3</b></td>
                          <td colspan="2"><b>ATASAN PEJABAT PENILAI</b></td>
                        </tr>
                        <tr>
                          <td></td>
                          <td>N A M A </td>
                          <td><?= $atasan['nama']?></td>
                        </tr>
                        <tr>
                          <td></td>
                          <td>N I P</td>
                          <td><?= $atasan['nip']?></td>
                        </tr>
                        <tr>
                          <td></td>
                          <td>Pangkat, golongan ruang</td>
                          <td><?= $atasan['pangkat_golongan']?></td>
                        </tr>
                        <tr>
                          <td></td>
                          <td>Jabatan/Pekerjaan</td>
                          <td><?= $atasan['jabatan']?></td>
                        </tr>
                        <tr>
                          <td></td>
                          <td>Unit Organisasi</td>
                          <td><?= $atasan['unit_kerja']?></td>
                        </tr>
                      </tbody>
                    </table>
                    <?php if($skp['status_skp'] == 1){?>
                    <div class="col-12 text-right"><a class="btn btn-success" href="<?= base_url('User_riwayat/export_excel_1/'.$skp['id']) ?>"><i class="fas fa-file-excel"></i> Export</a></div>
                    <?php } ?>
                  </div>
                  <div class="tab-pane fade" id="vert-tabs-profile" role="tabpanel" aria-labelledby="vert-tabs-profile-tab">
                    <table class="table table-sm">
                      <thead>
                        <tr>
                          <th scope="col" class="text-center"></th>
                          <th scope="col" class="text-center"></th>
                          <th scope="col" class="text-center" colspan="5">TARGET</th>
                        </tr>
                        <tr>
                          <th scope="col" class="text-center">NO</th>
                          <th scope="col" class="text-justify">KEGIATAN TUGAS JABATAN</th>
                          <th scope="col" class="text-center">AK</th>
                          <th scope="col" class="text-center">KUANTITAS/OUTPOT</th>
                          <th scope="col" class="text-center">KUALITAS/MUTU</th>
                          <th scope="col" class="text-center" width="90">WAKTU</th>
                          <th scope="col" class="text-center">BIAYA</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $no = 1; foreach($rincian as $data) { ?>
                        <tr>
                          <th scope="row" class="text-center"><?=$no?></th>
                          <td><?= $data['rinci_kegiatan']?></td>
                          <td class="text-center">0</td>
                          <td class="text-center"><?= $data['rinci_target']?> <?= $data['rinci_satuan']?></td>
                          <td class="text-center">100</td>
                          <td class="text-center">12 Bulan</td>
                          <td class="text-center"> - </td> <?php $no++;?>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                    <?php if($skp['status_skp'] == 1){?>
                    <div class="col-12 text-right"><a class="btn btn-success" href="<?= base_url('User_riwayat/export_excel_2/'.$skp['id']) ?>"><i class="fas fa-file-excel"></i> Export</a></div>
                    <?php } ?>
                  </div>
                  <div class="tab-pane fade" id="vert-tabs-messages" role="tabpanel" aria-labelledby="vert-tabs-messages-tab">
                    <table class="table table-sm">
                      <thead>
                        <tr>
                          <th scope="col" class="text-center"></th>
                          <th scope="col" class="text-center"></th>
                          <th scope="col" class="text-center" colspan="5">REALISASI</th>
                        </tr>
                        <tr>
                          <th scope="col" class="text-center">NO</th>
                          <th scope="col" class="text-justify">KEGIATAN TUGAS JABATAN</th>
                          <th scope="col" class="text-center">AK</th>
                          <th scope="col" class="text-center">KUANTITAS/OUTPOT</th>
                          <th scope="col" class="text-center">KUALITAS/MUTU</th>
                          <th scope="col" class="text-center" width="90">WAKTU</th>
                          <th scope="col" class="text-center">BIAYA</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $no = 1; foreach($rincian as $data) { ?>
                        <tr>
                          <th scope="row" class="text-center"><?=$no?></th>
                          <td><?= $data['rinci_kegiatan']?></td>
                          <td class="text-center">0</td>
                          <td class="text-center"><?= $data['rinci_realisasi']?> <?= $data['rinci_satuan']?></td>
                          <td class="text-center"><?= $data['rinci_mutu']?></td>
                          <td class="text-center">12 Bulan</td>
                          <td class="text-center"> - </td> <?php $no++;?>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                    <?php if($skp['status_skp'] == 1){?>
                    <div class="col-12 text-right"><a class="btn btn-success" href="<?= base_url('User_riwayat/export_excel_3/'.$skp['id']) ?>"><i class="fas fa-file-excel"></i> Export</a></div>
                    <?php } ?>
                  </div>
                  <div class="tab-pane fade" id="vert-tabs-settings" role="tabpanel" aria-labelledby="vert-tabs-settings-tab">
                    <table class="table table-sm">
                      <thead>
                        <tr>
                          <th scope="col" class="text-center">#</th>
                          <th scope="col" class="text-left" colspan="4">UNSUR YANG DINILAI</th>
                          <th scope="col" class="text-center">JUMLAH</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row" class="text-center">a.</th>
                          <td class="text-left" colspan="2">Sasaran Kerja Pegawai (SKP)</td>
                          <td class="text-right" colspan="2"><?php $rinci_jumlah=0; $i=0; foreach($rincian as $data){?>
                            <?php 
                              $rinci_jumlah = $rinci_jumlah + $data['rinci_jumlah'];
                              $i++ ?>
                            <?php } echo round($rinci_jumlah/$i, 2);?> x 60%</td>
                          <td class="text-center"><?= $n2 = round($rinci_jumlah/$i*0.6, 2)?></td>
                        </tr>
                        <tr>
                          <th scope="row" class="text-center">b.</th>
                          <td class="text-left">Perilaku Kerja</td>
                          <td class="text-left">1. Orientasi Pelayanan</td>
                          <td class="text-center"><?= $skp['orientasi']?></td>
                          <td class="text-center">Baik</td>
                          <td class="text-left"></td>
                        </tr>
                        <tr>
                          <th scope="row" class="text-center"></th>
                          <td class="text-left"></td>
                          <td class="text-left">2. Integritas</td>
                          <td class="text-center"><?= $skp['integritas']?></td>
                          <td class="text-center">Baik</td>
                          <td class="text-left"></td>
                        </tr>
                        <tr>
                          <th scope="row" class="text-center"></th>
                          <td class="text-left"></td>
                          <td class="text-left">3. Komitmen</td>
                          <td class="text-center"><?= $skp['komitmen']?></td>
                          <td class="text-center">Baik</td>
                          <td class="text-left"></td>
                        </tr>
                        <tr>
                          <th scope="row" class="text-center"></th>
                          <td class="text-left"></td>
                          <td class="text-left">4. Disiplin</td>
                          <td class="text-center"><?= $skp['disiplin']?></td>
                          <td class="text-center">Baik</td>
                          <td class="text-left"></td>
                        </tr>
                        <tr>
                          <th scope="row" class="text-center"></th>
                          <td class="text-left"></td>
                          <td class="text-left">5. Kerjasama</td>
                          <td class="text-center"><?= $skp['kerjasama']?></td>
                          <td class="text-center">Baik</td>
                          <td class="text-left"></td>
                        </tr>
                        <tr>
                          <th scope="row" class="text-center"></th>
                          <td class="text-left"></td>
                          <td class="text-left">6. Kepemimpinan</td>
                          <td class="text-center"><?= $skp['kepemimpinan']?></td>
                          <td class="text-center">Baik</td>
                          <td class="text-left"></td>
                        </tr>
                        <tr>
                          <th scope="row" class="text-center"></th>
                          <td class="text-left"></td>
                          <td class="text-left">Jumlah</td>
                          <td class="text-center"><?= $jml = $skp['orientasi'] + $skp['integritas'] + $skp['komitmen'] + $skp['disiplin'] + $skp['kerjasama'] + $skp['kepemimpinan'];?></td>
                          <td class="text-center"></td>
                          <td class="text-left"></td>
                        </tr>
                        <tr>
                          <th scope="row" class="text-center"></th>
                          <td class="text-left"></td>
                          <td class="text-left">Nilai Prilaku Kerja</td>
                          <td class="text-right" colspan="2"><?= round($jml/6, 2);?> x 40%</td>
                          <td class="text-center"><?= $n1 = round($jml/6*0.4, 2);?></td>
                        </tr>
                        <tr>
                          <th scope="row" class="text-center" colspan="5">NILAI PRESTASI KERJA</th>
                          <td class="text-center"><?=round($n1 + $n2, 2);?></td>
                        </tr>
                        <tr>
                          <th scope="row" class="text-center" colspan="5"></th>
                          <td class="text-center">Baik</td>
                        </tr>
                      </tbody>
                    </table>
                </div>
              </div>
            </div>
          </div>
        </div>

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
