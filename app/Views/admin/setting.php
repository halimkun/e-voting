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
      <div class="col-12 col-md-6">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>Edit Tahun ajaran</h4>
              </div>
              <div class="card-body pt-0">
                <form action="/admin/setting/tahun-ajaran" method="post">
                  <div class="form-group row mb-4">
                    <label class="col-form-label col-12 col-md-4">
                      Tahun Ajaran Saat ini
                    </label>
                    <div class="col-sm-12 col-md-8">
                      <input type="number" min="2010" class="form-control <?= ($validation->hasError('tahun_ajaran')) ?  'is-invalid' : ''; ?>" name="tahun_ajaran" value="<?= (old('tahun_ajaran')) ?  old('tahun_ajaran') : setting('App.tahun_ajaran'); ?>">
                      <div class="invalid-feedback">
                        <?= $validation->getError('tahun_ajaran'); ?>
                      </div>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary float-right">
                    Simpan
                  </button>
                </form>
              </div>
            </div>
          </div>
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>
                  Edit Data Sekolah
                </h4>
              </div>
              <div class="card-body pt-0">
                <div class="row">
                  <div class="col-12">
                    <?php if ($validation->hasError('logo')) : ?>
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= $validation->getError('logo'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    <?php endif; ?>
                    <form action="<?= base_url(); ?>/admin/setting/edit" method="post" enctype="multipart/form-data">
                      <?= csrf_field(); ?>
                      <input type="hidden" name="logo_lama" value="<?= setting('App.logo_sekolah'); ?>">
                      <div class="form-group row mb-4">
                        <label class="col-form-label col-12 col-md-4">
                          Nama Sekolah
                        </label>
                        <div class="col-sm-12 col-md-8">
                          <input type="text" class="form-control <?= ($validation->hasError('nama_sekolah')) ?  'is-invalid' : ''; ?>" name="nama_sekolah" value="<?= (old('nama_sekolah')) ?  old('nama_sekolah') : setting('App.nama_sekolah'); ?>">
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
                          <input type="text" class="form-control <?= ($validation->hasError('alamat_sekolah')) ?  'is-invalid' : ''; ?>" name="alamat_sekolah" value="<?= (old('alamat_sekolah')) ?  old('alamat_sekolah') : setting('App.alamat_sekolah'); ?>">
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
                          <input type="text" class="form-control <?= ($validation->hasError('email_sekolah')) ?  'is-invalid' : ''; ?>" name="email_sekolah" value="<?= (old('email_sekolah')) ?  old('email_sekolah') : setting('App.email_sekolah'); ?>">
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
                        <img src="<?= base_url(); ?>/img/<?= setting('App.logo_sekolah'); ?>" alt="foto" class="img-thumbnail col-form-label col-sm-6 col-md-4 img-add-user" id="img_preview" style="object-fit: contain;">
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

      <div class="col-12 col-md-6">
        <div class="card">
          <div class="card-header">
            <h4>Edit About</h4>
          </div>
          <div class="card-body">
            <form action="/admin/setting/about/update" method="post"><?= csrf_field() ?>
              <div class="mb-3">
                <input type="text" name="about_title" id="about_title" class="form-control <?= ($validation->hasError('about_title')) ?  'is-invalid' : ''; ?>" value="<?= (old('about_title')) ?  old('about_title') : setting('App.about_title'); ?>">
                <div class="invalid-feedback">
                  <?= $validation->getError('about_title'); ?>
                </div>
              </div>
              <div class="mb-3">
                <textarea name="about_sekolah" id="about_sekolah" class="form-control <?= ($validation->hasError('about_sekolah')) ?  'is-invalid' : ''; ?>"><?= (old('about_sekolah')) ?  old('about_sekolah') : setting('App.about_sekolah'); ?></textarea>
                <div class="invalid-feedback">
                  <?= $validation->getError('about_sekolah'); ?>
                </div>
              </div>
              <button type="submit" class="btn btn-primary float-right">simpan</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?= $this->endSection(); ?>

<?= $this->section('script_css'); ?>
<link href="/summernote/summernote-bs4.min.css" rel="stylesheet">
<?= $this->endSection(); ?>

<?= $this->section('script_js'); ?>
<script src="/summernote/summernote-bs4.min.js"></script>

<script>
  $(document).ready(function() {
    $('#about_sekolah').summernote({
      dialogsInBody: true,
      toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'clear']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['insert', ['link']],
      ]
    });
  });
</script>
<?= $this->endSection(); ?>