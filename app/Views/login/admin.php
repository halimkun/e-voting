<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>
    LOGIN ADMIN
  </title>
    <link href="<?= base_url(); ?>/fontawesome/css/all.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="<?= base_url(); ?>/css/bootstrap.min.css" type="text/css" media="all" />
  <link rel="stylesheet" href="<?= base_url(); ?>/css/login_admin.css" type="text/css" media="all" />
</head>
<body>
  
  <div class="container-fluid ">
    <div class="row">
      <div class="col-md-6 col-sm-12 wadah">
        <div class="text-info text-center text-light ">
          <h2 class="mb-0">
            SISTEM INFORMASI OSIS & E-VOTING
          </h2>
          <h4>
            PEMILIHAN KETUA OSIS
          </h4>
        </div>
        <div class="card pb-3">
          <div class="card-header p-0 m-0">
            <div class="icon-user text-center d-flex align-items-center justify-content-center">
              <i class="fas fa-user icn-user"></i>
            </div>
            <h5 class="card-title text-center">
              Login Admin
            </h5>
          </div>
          <div class="card-body">
             <?php if($validation->getError('username') || $validation->getError('password')) : ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <strong>Maaf...</strong> Harap isi username dan password dulu!!
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
             <?php endif; ?>
             <?php if(session()->getFlashdata('info-login')) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <?= session()->getFlashdata('info-login'); ?>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
             <?php endif; ?>
            
             <form action="<?= base_url(); ?>/cekLoginAdmin" method="post" accept-charset="utf-8">
                <?= csrf_field(); ?>
                <div class="col-auto mb-3 ">
                  <label class="sr-only" for="username">Username</label>
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-user"></i>
                      </div>
                    </div>
                    <input type="text" class="form-control" id="username" placeholder="Username" name="username" autocomplete="off" value="<?= (old('username')) ? old('username') : '' ?>">
                  </div>
                </div>
                <div class="col-auto mb-4"> 
                  <label class="sr-only" for="password">Password</label>
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-key"></i>
                      </div>
                    </div>
                    <input type="password" class="form-control" id="password" placeholder="Password" name="password" value="<?= (old('password')) ? old('password') : '' ?>">
                  </div>
                </div>
                <div class="w-100 px-3">
                  <button type="submit" class="btn btn-primary w-100">
                    Login
                  </button>
                </div>
             </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  
  
  <script src="<?= base_url(); ?>/js/jquery.min.js" type="text/javascript" charset="utf-8"></script>
  <script src="<?= base_url(); ?>/js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>
</body>
</html>