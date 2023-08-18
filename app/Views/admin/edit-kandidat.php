<?= $this->extend('template_admin/layout'); ?>

<?= $this->section('content'); ?>
<section class="section">
  <div class="section-header">
    <h1>Edit Kandidat</h1>
  </div>

  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Edit Data</h4>
            <div class="card-header-form d-inline">
              <a href="<?= base_url(); ?>/admin/kandidat" class="btn btn-icon btn-warning icon-left float-right "><i class="fas fa-long-arrow-alt-left"></i> Kembali</a>
            </div>
          </div>
          <div class="card-body">
            <?php if ($validation->hasError('foto')) : ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= $validation->getError('foto'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <?php endif; ?>
            <?php if ($validation->hasError('visi')) : ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= $validation->getError('visi'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <?php endif; ?>
            <?php if ($validation->hasError('misi')) : ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= $validation->getError('misi'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <?php endif; ?>


            <form action="<?= base_url(); ?>/admin/kandidat/update/<?= $data_candidate->id_candidate; ?>" method="post" enctype="multipart/form-data">
              <?= csrf_field(); ?>
              <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                  No Urut
                </label>
                <div class="col-sm-12 col-md-7">
                  <input type="number" class="form-control" value="<?= $data_candidate->no_urut; ?>" name="no_urut" readonly>
                  <div class="invalid-feedback">
                    <?= $validation->getError('no_urut'); ?>
                  </div>
                </div>
              </div>
              <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                  Nama ketua
                </label>
                <div class="col-sm-12 col-md-7">
                  <input type="text" class="form-control <?= ($validation->hasError('ketua')) ?  'is-invalid' : ''; ?>" name="ketua" value="<?= (old('ketua')) ?  old('ketua') : $data_candidate->ketua; ?>">
                  <div class="invalid-feedback">
                    <?= $validation->getError('ketua'); ?>
                  </div>
                </div>
              </div>
              <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                  Nama Wakil
                </label>
                <div class="col-sm-12 col-md-7">
                  <input type="text" class="form-control <?= ($validation->hasError('wakil')) ?  'is-invalid' : ''; ?>" name="wakil" value="<?= (old('wakil')) ?  old('wakil') : $data_candidate->wakil; ?>">
                  <div class="invalid-feedback">
                    <?= $validation->getError('wakil'); ?>
                  </div>
                </div>
              </div>
              <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                  Periode
                </label>
                <div class="col-sm-12 col-md-7">
                  <input type="number" min="2010" readonly class="form-control <?= ($validation->hasError('periode')) ?  'is-invalid' : ''; ?>" name="periode" value="<?= (old('periode')) ?  old('periode') : $data_candidate->periode; ?>">
                  <div class="invalid-feedback">
                    <?= $validation->getError('periode'); ?>
                  </div>
                </div>
              </div>
              <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                  Slogan
                </label>
                <div class="col-sm-12 col-md-7">
                  <input type="text" class="form-control <?= ($validation->hasError('slogan')) ?  'is-invalid' : ''; ?>" name="slogan" value="<?= (old('slogan')) ?  old('slogan') : $data_candidate->slogan; ?>">
                  <div class="invalid-feedback">
                    <?= $validation->getError('slogan'); ?>
                  </div>
                </div>
              </div>
              <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                  Visi
                </label>
                <div class="col-sm-12 col-md-7">
                  <textarea class="editor" name="visi"><?= (old('visi')) ?  old('visi') : $data_candidate->visi; ?></textarea>
                </div>
              </div>
              <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                  Misi
                </label>
                <div class="col-sm-12 col-md-7">
                  <textarea class="editor" name="misi"><?= (old('misi')) ?  old('misi') : $data_candidate->misi; ?></textarea>
                </div>
              </div>
              <div class="form-group row mb-0">
                <label for="foto_profile" class="mb-0 col-form-label text-md-right col-12 col-md-3 col-lg-3">
                  Foto Profile
                </label>
                <input type="file" class="form-control-file col-sm-12 col-md-7" id="foto_profile" name="foto" aria-descrabedby="fotoInfo" onchange="preview()">
              </div>
              <div class="form-group row mb-4">
                <div class="col-md-1 col-lg-1"></div>
                <img src="<?= base_url(); ?>/img/candidate/<?= $data_candidate->foto; ?>" alt="foto" class="img-thumbnail col-form-label text-md-right col-sm-6 col-md-2 col-lg-2 img-add-user" id="img_preview">
                <small class="text-muted form-text col-sm-12 col-md-7 pb-0 mb-0" id="fotoInfo">
                  ekstensi file hanya jpg,jpeg, dan png, serta max ukuran file adlh 10MB.
                </small>
              </div>
              <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                <div class="col-sm-12 col-md-7">
                  <button type="submit" class="btn btn-info btn-icon icon-left float-right"><i class="fas fa-save"></i> Simpan Perubahan</button>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>
<?= $this->endSection(); ?>

<?= $this->section('script_js'); ?>
<script>
  $(document).ready(function() {
    $('.editor').summernote({
      height: 250
    });
  });
</script>
<?= $this->endSection(); ?>