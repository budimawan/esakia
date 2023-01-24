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

                <ul class="list-group list-group-unbordered mb-3">
                    <select id="inputStatus" class="form-control custom-select">
                      <option selected disabled>Tahun SKP</option>
                      <option>2021</option>
                      <option>2022</option>
                      <option>2023</option>
                    </select>
                    <a href="#" class="btn btn-primary"><b>Lihat</b></a>
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
              <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
                <div class="card">
                      <div class="card-body">
                          <form action="action.php" method="POST">
                          <div class="input-group control-group after-add-more">
                            <input type="text" name="addmore[]" class="form-control" placeholder="Enter Name Here">
                            <div class="input-group-btn"> 
                              <button class="btn btn-success add-more" type="button"><i class="glyphicon glyphicon-plus"></i> Add</button>
                            </div>
                          </div>
                          <div class="control-group text-left">
                              <br>
                              <button class="btn btn-success" type="submit">Selanjutnya</button>
                          </div>
                          </form>
                          <!-- Copy Fields -->
                          <div class="copy hide">
                            <div class="control-group input-group" style="margin-top:10px">
                              <input type="text" name="addmore[]" class="form-control" placeholder="Enter Name Here">
                              <div class="input-group-btn"> 
                                <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                              </div>
                            </div>
                          </div>
                      </div>
                    </div>
                    <script type="text/javascript">
                        $(document).ready(function() {
                          $(".add-more").click(function(){ 
                              var html = $(".copy").html();
                              $(".after-add-more").after(html);
                          });
                          $("body").on("click",".remove",function(){ 
                              $(this).parents(".control-group").remove();
                          });
                        });
                    </script>
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