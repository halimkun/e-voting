<?= $this->extend('template_admin/layout'); ?>

<?= $this->section('content'); ?>
<section class="section">
  <div class="section-header">
    <h1>
      Edit Profile
      <?= showFlasher(); ?>
    </h1>
  </div>
  
  <div class="section-body">
    <div class="row">
      <div class="col-lg-7 col-md-7 col-sm-12">
        <div class="card">
          <div class="card-header">
            <h4>
              Edit Profile
            </h4>
          </div>
          <div class="card-body pt-0">
            <?php if($validation->getError('foto_profile')) : ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= $validation->getError('foto_profile'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <?php endif; ?>
            <form action="<?= base_url(); ?>/admin/editProfile/profile" method="post" enctype="multipart/form-data">
              <?= csrf_field(); ?>
              <input type="hidden" name="id_admin" value="<?= $data_admin->id_admin; ?>">
              <input type="hidden" name="foto_lama" value="<?= $data_admin->foto_profile; ?>">
              <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                  Username
                </label>
                <div class="col-sm-12 col-md-7">
                  <input type="text" class="form-control <?= ($validation->hasError('username')) ?  'is-invalid' : '' ; ?>" name="username" value="<?= (old('username')) ? old('username') : $data_admin->username; ?>"autocomplete="off">
                  <div class="invalid-feedback">
                    <?= $validation->getError('username'); ?>
                  </div>
                </div>
              </div>
              <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                  Nama
                </label>
                <div class="col-sm-12 col-md-7">
                  <input type="text" class="form-control <?= ($validation->hasError('nama')) ?  'is-invalid' : '' ; ?>" name="nama" value="<?= (old('nama')) ? old('nama') : $data_admin->nama; ?>" autocomplete="off">
                  <div class="invalid-feedback">
                    <?= $validation->getError('nama'); ?>
                  </div>
                </div>
              </div>
              <div class="form-group row mb-0">
                <label for="foto_profile" class="mb-0 col-form-label text-md-right col-12 col-md-3 col-lg-3">
                  Foto Profile
                </label>
                <input type="file" class="form-control-file col-sm-12 col-md-7" id="foto_profile" name="foto_profile" aria-descrabedby="fotoInfo" onchange="preview()">
              </div>
              <div class="form-group row mb-4">
                <div class="col-md-1 col-lg-1"></div>
                <img src="<?=base_url(); ?>/img/<?= $data_admin->foto_profile; ?>" alt="foto" class="img-thumbnail col-form-label text-md-right col-sm-6 col-md-2 col-lg-2 img-add-user" id="img_preview">
                <small class="text-muted form-text col-sm-12 col-md-7 pb-0 mb-0" id="fotoInfo">
                  ekstensi file hanya jpg,jpeg, dan png, serta max ukuran file adlh 10MB.
                </small>
              </div>
              <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                <div class="col-sm-12 col-md-7">
                  <button type="submit" class="btn btn-info float-right">
                    Update Data
                  </button>
                </div>
              </div>
              
            </form>
          </div>
        </div>
      </div>
      
      <div class="col-lg-5 col-md-5 col-sm-12">
        <div class="card">
          <div class="card-header">
            <h4>
              Ganti Password
            </h4>
          </div>
          <div class="card-body pt-0">
            <?php if(session()->get('info-ganti-password')) : ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session()->get('info-ganti-password'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <?php endif; ?>
            <form action="<?= base_url(); ?>/admin/editProfile/password" method="post">
              <?= csrf_field(); ?>
              <input type="hidden" name="id_admin" value="<?= $data_admin->id_admin; ?>">
              <div class="form-group">
                <label for="password_lama">
                  Masukkan Password Lama
                </label>
                <input type="password" class="form-control  <?= ($validation->hasError('password_lama')) ?  'is-invalid' : '' ; ?>" id="password_lama" name="password_lama" value="<?= (old('password_lama')) ? old('password_lama') : '' ?>">
                <div class="invalid-feedback">
                  <?= $validation->getError('password_lama'); ?>
                </div>
              </div>
              <div class="form-group">
                <label for="password_baru">
                  Masukkan Password Baru
                </label>
                <input type="password" class="form-control  <?= ($validation->hasError('password_baru')) ?  'is-invalid' : '' ; ?>" id="password_baru" name="password_baru" value="<?= (old('password_baru')) ? old('password_baru') : '' ?>">
                <div class="invalid-feedback">
                  <?= $validation->getError('password_baru'); ?>
                </div>
              </div>
              <div class="form-group">
                <label for="konfirmasi_password">
                  Konfirmasi Password
                </label>
                <input type="password" class="form-control  <?= ($validation->hasError('konfirmasi_password')) ?  'is-invalid' : '' ; ?>" id="konfirmasi_password" name="konfirmasi_password" value="<?= (old('konfirmasi_password')) ? old('konfirmasi_password') : '' ?>">
                <div class="invalid-feedback">
                  <?= $validation->getError('konfirmasi_password'); ?>
                </div>
              </div>
              <button type="submit" class="btn btn-primary float-right" onclick="return confirm('yakin ingin mengubah password??');">
                Ubah Password
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?= $this->endSection(); ?>