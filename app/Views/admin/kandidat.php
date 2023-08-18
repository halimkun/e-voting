<?= $this->extend('template_admin/layout'); ?>
<?= $this->section('content'); ?>
<section class="section">
  <div class="section-header">
    <h1>Data Kandidat</h1>
    <?= showFlasher(); ?>
  </div>

  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Data Kandidat</h4>
          </div>
          <div class="card-body ">
            <div class="table-responsive">
              <table class="table table-striped">
                <tr>
                  <th>No Urut</th>
                  <th>Gambar</th>
                  <th>Periode</th>
                  <th>Ketua</th>
                  <th>wakil</th>
                  <th>Action</th>
                </tr>
                <?php foreach ($data_candidate as $dt) : ?>
                  <tr>
                    <td class="p-0 text-center">
                      <?= $dt->no_urut; ?>
                    </td>
                    <td class="align-middle">
                      <img src="<?= base_url(); ?>/img/candidate/<?= $dt->foto; ?>" alt="foto kandidat" class="img-thumbnail mt-2" width="100">
                    </td>
                    <td class="p-0 text-center">
                      <?= $dt->periode; ?>
                    </td>
                    <td class="align-middle">
                      <?= $dt->ketua; ?>
                    </td>
                    <td class="align-middle">
                      <?= $dt->wakil; ?>
                    </td>
                    <td>
                      <a href="<?= base_url(); ?>/admin/kandidat/view/<?= $dt->id_candidate; ?>" class="btn btn-icon btn-primary mr-1"><i class="far fa-eye"></i></a>
                      <a href="<?= base_url(); ?>/admin/kandidat/edit/<?= $dt->id_candidate; ?>" class="btn btn-icon btn-info mr-1"><i class="far fa-edit"></i></a>
                      <form class="d-inline" action="<?= base_url(); ?>/admin/kandidat/hapus/<?= $dt->id_candidate; ?>" method="post">
                        <input type="hidden" name="_method" value="DELETE" />
                        <?= csrf_field(); ?>
                        <?php if (setting('App.status_acara') == 0) : ?>
                          <input type="hidden" name="foto" value="<?= $dt->foto; ?>">
                          <button type="submit" class="btn btn-icon btn-danger" onclick="return confirm('Yakin ingin menghapus data?');"><i class="far fa-trash-alt"></i></button>
                        <?php endif ?>
                      </form>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php if (setting('App.status_acara') == 0) : ?>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Tambah Data</h4>
            </div>
            <div class="card-body">
              <?php if (session()->getFlashdata('CRUD-Tambah')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <?= session()->getFlashdata('CRUD-Tambah'); ?>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              <?php endif; ?>
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


              <form action="<?= base_url(); ?>/admin/kandidat/add" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                    No Urut
                  </label>
                  <div class="col-sm-12 col-md-7">
                    <input type="text" class="form-control <?= ($validation->hasError('no_urut')) ?  'is-invalid' : ''; ?>" name="no_urut" readonly value="<?= $no_urut_terakhir + 1; ?>">
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
                    <input type="text" class="form-control <?= ($validation->hasError('ketua')) ?  'is-invalid' : ''; ?>" name="ketua" value="<?= (old('ketua')) ?  old('ketua') : ''; ?>">
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
                    <input type="text" class="form-control <?= ($validation->hasError('wakil')) ?  'is-invalid' : ''; ?>" name="wakil" value="<?= (old('wakil')) ?  old('wakil') : ''; ?>">
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
                    <input type="number" min="2010" readonly value="<?= setting('App.tahun_ajaran') ?>" class="form-control <?= ($validation->hasError('periode')) ?  'is-invalid' : ''; ?>" name="periode" value="<?= (old('periode')) ?  old('periode') : ''; ?>">
                    <div><small>Periode tidak bisa diinputkan manual, jika anda ingin merubahnya silahkan ubah di setting</small></div>
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
                    <input type="text" class="form-control <?= ($validation->hasError('slogan')) ?  'is-invalid' : ''; ?>" name="slogan" value="<?= (old('slogan')) ?  old('slogan') : ''; ?>">
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
                    <textarea class="editor" name="visi"><?= (old('visi')) ?  old('visi') : ''; ?></textarea>
                  </div>
                </div>
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                    Misi
                  </label>
                  <div class="col-sm-12 col-md-7">
                    <textarea class="editor" name="misi"><?= (old('misi')) ?  old('misi') : ''; ?></textarea>
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
                  <img src="" alt="foto" class="img-thumbnail col-form-label text-md-right col-sm-6 col-md-2 col-lg-2 img-add-user" id="img_preview">
                  <small class="text-muted form-text col-sm-12 col-md-7 pb-0 mb-0" id="fotoInfo">
                    ekstensi file hanya jpg,jpeg, dan png, serta max ukuran file adlh 10MB.
                  </small>
                </div>
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                  <div class="col-sm-12 col-md-7">
                    <button type="submit" class="btn btn-success btn-icon icon-left float-right"><i class="fas fa-plus"></i> Tambah</button>
                  </div>
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
    <?php endif ?>

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