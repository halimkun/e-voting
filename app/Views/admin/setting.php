<?= $this->extend('template_admin/layout'); ?>

<?= $this->section('content'); ?>
<section class="section">
  <div class="section-header">
    <h1>
      Setting
      <?= showFlasher(); ?>
    </h1>
  </div>
  
  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>
              Edit Data Sekolah
            </h4>
          </div>
          <div class="card-body pt-0">
            <div class="row">
              <div class="col-md-6 col-sm-12">
               <?php if($validation->hasError('logo')) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <?= $validation->getError('logo'); ?>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
               <?php endif; ?>
                <form action="<?= base_url(); ?>/admin/setting/edit" method="post" enctype="multipart/form-data">
                  <?= csrf_field(); ?>
                  <input type="hidden" name="id_sekolah" value="<?= $data_sekolah['id_sekolah']; ?>">
                  <input type="hidden" name="logo_lama" value="<?= $data_sekolah['logo_sekolah']; ?>">
                  <div class="form-group row mb-4">
                    <label class="col-form-label col-12 col-md-4">
                      Nama Sekolah
                    </label>
                    <div class="col-sm-12 col-md-8">
                      <input type="text" class="form-control <?= ($validation->hasError('nama_sekolah')) ?  'is-invalid' : '' ; ?>" name="nama_sekolah" value="<?= (old('nama_sekolah')) ?  old('nama_sekolah') : $data_sekolah['nama_sekolah'] ; ?>">
                      <div class="invalid-feedback">
                        <?= $validation->getError('nama_sekolah'); ?>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row mb-4">
                    <label class="col-form-label col-12 col-md-4">
                      Alamat Sekolah
                    </label>
                    <div class="col-sm-12 col-md-8">
                      <input type="text" class="form-control <?= ($validation->hasError('alamat_sekolah')) ?  'is-invalid' : '' ; ?>" name="alamat_sekolah" value="<?= (old('alamat_sekolah')) ?  old('alamat_sekolah') : $data_sekolah['alamat_sekolah'] ; ?>">
                      <div class="invalid-feedback">
                        <?= $validation->getError('alamat_sekolah'); ?>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row mb-4">
                    <label class="col-form-label col-12 col-md-4">
                      Email Sekolah
                    </label>
                    <div class="col-sm-12 col-md-8">
                      <input type="text" class="form-control <?= ($validation->hasError('email_sekolah')) ?  'is-invalid' : '' ; ?>" name="email_sekolah" value="<?= (old('email_sekolah')) ?  old('email_sekolah') : $data_sekolah['email_sekolah'] ; ?>">
                      <div class="invalid-feedback">
                        <?= $validation->getError('email_sekolah'); ?>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row mb-2">
                    <label for="foto_profile" class="mb-0 col-form-label col-12 col-md-4">
                      Logo
                    </label>
                    <input type="file" class="form-control-file col-sm-12 col-md-8" id="foto_profile" name="logo" aria-descrabedby="fotoInfo" onchange="preview()">
                  </div>
                  <div class="form-group row mb-4">
                    <img src="<?= base_url(); ?>/img/<?= $data_sekolah['logo_sekolah']; ?>" alt="foto" class="img-thumbnail col-form-label col-sm-6 col-md-4 img-add-user" id="img_preview">
                    <small class="text-muted form-text col-sm-12 col-md-8 pb-0 mb-0" id="fotoInfo">
                      ekstensi file hanya jpg,jpeg, dan png, serta max ukuran file adlh 10MB.
                    </small>
                  </div>
                 
                 <button type="submit" class="btn btn-primary float-right">
                   Simpan
                 </button>
                  
                </form>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?= $this->endSection(); ?>


