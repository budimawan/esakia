<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>login_esakia</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('assets'); ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url('assets'); ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets'); ?>/dist/css/adminlte.min.css">
  <link rel="shortcut icon" href="<?= base_url('assets/');?>dist/img/logo_esakia2.png">
  <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
  <style>body, html {
      background:  url(assets/dist/img/bg_blur.jpg) no-repeat center center fixed; 
      /* filter: blur(8px);
      -webkit-filter: blur(8px);   */
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;  
  }
  </style>

</head>
<body class="hold-transition login-page">
<!-- <div id="particles-js"></div> -->
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary" >
      <div class="card-header text-center">
        <div class="text-center">
        <img class="img-fluid" src="<?= base_url('assets/')?>dist/img/logo_esakia.png"
          alt="User profile picture">
        </div>
        <p class=""><b>platform pengajuan SKP</b></p>
      </div>
      <div class="card-body">
        <p class="login-box-msg"><small>Silahkan masukkan <b>nip</b> dan <b>password</b> anda</small></p>
        <small><?= $this->session->flashdata('message');?></small>
        <form class="action=" method="post" action="<?=base_url('auth');?>">
          <?= form_error('nip', '<small class="text-danger pl-3">', '</small>');?>
          <div class="input-group mb-3">
            <input type="text" name="nip" class="form-control" placeholder="Nomor induk pegawai">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div> 
          </div>
          <?= form_error('password', '<small class="text-danger pl-3">', '</small>');?>
          <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Kata kunci">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" id="submit" class="btn btn-primary btn-block">Masuk</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
      </div>
      <!-- /.card-body -->
      <div class="row card-header row-center">
        <div class="text-center col-md-3">
          <img class="img-fluid" src="<?= base_url('assets/')?>dist/img/logo_morwal.png"
            alt="User profile picture">
        </div>
        <div class="col-md-9">
          <p class="">
            <h5><b><a href="<?=base_url('auth');?>">DISPERINDAG DAERAH KABUPATEN MOROWALI</a></b></h5>
          </p>
        </div>
      </div>
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->

<!-- jQuery -->
<script src="<?= base_url('assets'); ?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets'); ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets'); ?>/dist/js/adminlte.min.js"></script>

<script src="https://res.cloudinary.com/dxfq3iotg/raw/upload/v1561436720/particles.js"></script>
<script src="https://res.cloudinary.com/dxfq3iotg/raw/upload/v1561436735/app.js"></script>
<script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js'></script>
<script type='text/javascript'>$(document).ready(function(){
    var count_particles, stats, update;
    stats = new Stats;
    stats.setMode(0);
    stats.domElement.style.position = 'absolute';
    stats.domElement.style.left = '0px';
    stats.domElement.style.top = '0px';
    document.body.appendChild(stats.domElement);
    count_particles = document.querySelector('.js-count-particles');
    update = function() {
        stats.begin();
        stats.end();
        if (window.pJSDom[0].pJS.particles && window.pJSDom[0].pJS.particles.array) {
            count_particles.innerText = window.pJSDom[0].pJS.particles.array.length;
        }
        requestAnimationFrame(update);
    };
    requestAnimationFrame(update);
    });
</script>
</body>
</html>
