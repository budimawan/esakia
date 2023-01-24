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
                    aria-controls="custom-tabs-one-home" href="#custom-tabs-one-home" data-toggle="pill">Kegiatan
                    Tugas</a>
                </li>
                <!-- <li class="nav-item">
                      <a class="nav-link" id="custom-tabs-one-profile-tab" role="tab" aria-selected="false" aria-controls="custom-tabs-one-profile" href="#custom-tabs-one-profile" data-toggle="pill">Target Tugas</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link " id="custom-tabs-one-messages-tab" role="tab" aria-selected="true" aria-controls="custom-tabs-one-messages" href="#custom-tabs-one-messages" data-toggle="pill">Realisasi Tugas</a>
                    </li> -->
              </ul>
            </div>
            <div class="card-body">
              <div class="tab-content" id="custom-tabs-one-tabContent">
                <div class="tab-pane active show fade" id="custom-tabs-one-home" role="tabpanel"
                  aria-labelledby="custom-tabs-one-home-tab">
                  <form action="<?= base_url('User_pengajuan/update_skp') ?>" method="POST">
                  <div class="row">
                    <div class="col-md-6">
                      <span class="pull-left" style="font-size: 15pt">Nama Penilai :
                        <?= $penilai['nama'] ?>
                      </span>
                    </div>
                    <div class="col-md-6">
                      <span class="pull-right" style="font-size: 15pt">Nama Dinilai :
                        <?= $pegawai['nama'] ?>
                      </span>
                    </div>
                    <div class="col-md-12 text-right mt-2 mb-2">
                      <button type="button" class="btn btn-primary btn-sm" onclick="addKeg()"><i class="fa fa-plus"></i> Tambah
                        Data</button>
                    </div>
                   
                      <div class="col-md-12">
                        <input type="hidden" name="rinci_skp_id" value="<?= $skp['id'] ?>">
                        <table class="table table-hover" style="font-size: 10pt;">
                          <thead>
                            <tr>
                              <th width="250" class="text-center">Koreksi</th>
                              <th >Kegiatan</th>
                              <th width="130" class="text-center">Satuan</th>
                              <th width="150" class="text-center">Target Realisasi</th>
                              <th width="150" class="text-center">Capaian Realisasi</th>
                              <th width="135" class="text-center">Mutu Realisasi</th>
                              <th width="50">

                              </th>
                            </tr>
                          </thead>
                          <tbody id="table_keg1">
                            <?php $no = 1; foreach($rincian as $data) { ?>
                              <tr id="keg-<?= $no; ?>">
                                <td>
                                  <p class="text-justify text-center" name="rinci_koreksi[]"><?= $data['rinci_koreksi'] ?></p>
                                </td>
                                <td>
                                  <textarea class="form-control" name="rinci_kegiatan[]"><?= $data['rinci_kegiatan'] ?></textarea>
                                </td>
                                <td>
                                  <input type="text" class="form-control" value="<?= $data['rinci_satuan'] ?>" name="rinci_satuan[]" id="">
                                </td>
                                <td>
                                  <input type="number" step="any" class="form-control" value="<?= $data['rinci_target'] ?>" name="rinci_target[]" id="">
                                </td>
                                <td>
                                  <input type="number" step="any" class="form-control" value="<?= $data['rinci_realisasi'] ?>" name="rinci_realisasi[]" id="">
                                </td>
                                <td>
                                  <input type="number" step="any" class="form-control" value="<?= $data['rinci_mutu'] ?>" name="rinci_mutu[]" id="">
                                </td>
                                <td>
                                  <button type="button" class="btn btn-danger" onclick="removeKeg('keg-<?= $no++; ?>')"><i class="fa fa-trash"></i></button>
                                </td>
                              </tr>
                            <?php } ?>
                          </tbody>
                        </table>
                      </div>
                      <div class="col-md-12 text-right">
                        <button type="submit" class="btn btn-success" onclick="return confirm('Data perubahan SKP telah benar?');"><i class="fa fa-save"></i> Simpan</button>
                      </div>
                    
                  </div>
                </form>
                </div>
                <!-- <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                      yyyy
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
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
            <p class="text-justify text-center" name="rinci_koreksi[]" id=""></p>
          </td>
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


</script>