<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>LOGIN</title>
  <link rel="stylesheet" href="<?= base_url(); ?>/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>/css/login_peserta.css">
</head>

<body>

  <div class="container-fluid">
    <div class="wadah">
      <div class="row text-white mb-4 tulisan-atas">
        <div class="col-12 text-center">
          <h4 class="mb-3">
            Selamat Datang di <br/>Sistem Informasi Dan Pemilihan Ketua OSIS
          </h4>
          <h1>
            <?= setting('App.nama_sekolah') ?>
          </h1>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12 col-md-4 p-0 d-flex justify-content-center align-items-center">
          <img src="<?= base_url(); ?>/img/<?= setting('App.logo_sekolah') ?>" alt="" class="img-fluid">
        </div>
        <div class="col-sm-12 col-md-8">
          <?php if (session()->getFlashdata('info-login')) : ?>
            <div class="alert <?= session()->getFlashdata('info-login')[0]; ?>" role="alert">
              <?= session()->getFlashdata('info-login')[1]; ?>
            </div>
          <?php endif; ?>
          <form action="<?= base_url(); ?>/cekLogin" class="text-white" method="post">
            <?= csrf_field(); ?>
            <div class="form-group">
              <label for="username">
                Username :
              </label>
              <input type="text" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" id="username" name="username" autocomplete="off" value="<?= (old('username')) ? old('username') : ''; ?>">
              <div class="invalid-feedback text-white">
                <i>
                  <?= $validation->getError('username'); ?>
                </i>
              </div>
            </div>
            <div class="form-group">
              <label for="password">
                Password :
              </label>
              <input type="password" class="form-control  <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" id="password" name="password" value="<?= (old('password')) ? old('password') : ''; ?>">
              <div class="invalid-feedback text-white">
                <i>
                  <?= $validation->getError('password'); ?>
                </i>
              </div>
            </div>
            <button type="submit" class="btn btn-danger float-right">
              Login
            </button>
          </form>
        </div>
      </div>

    </div>
  </div>


  <script src="<?= base_url(); ?>/js/jquery.min.js"></script>
  <script src="<?= base_url(); ?>/js/bootstrap.bundle.min.js"></script>
</body>

</html>