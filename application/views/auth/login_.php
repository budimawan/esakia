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

  <style>body {
      background:  url(assets/dist/img/bg.jpeg) no-repeat center center fixed; 
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;    
  }
  </style>

</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="<?=base_url('auth');?>" class="h1"><b>e-</b>SAKIA</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg"><small>Silahkan masukkan <b>email</b> dan <b>password</b> anda</small></p>
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
    <div class="card-header text-center">
      <p class="mb-1">
        <a href="<?=base_url('auth');?>"><b>DINAS PERDAGANGAN DAN PERINDUSTRIAN DAERAH KABUPATEN MOROWALI</b></a>
      </p>
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
</body>
</html>
