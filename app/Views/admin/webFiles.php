<?= $this->extend('template_admin/layout'); ?>

<?= $this->section('content'); ?>
<section class="section">
  <div class="section-header">
    <h1>
      Publikasi Dokumen
      <?= showFlasher(); ?>
    </h1>
  </div>

  <div class="section-body">
    <div class="row">
      <div class="col-12  col-md-5">
        <div class="card position-sticky" style="top: 30px;">
          <div class="card-header">
            <h4>
              Tambah Publikasi
            </h4>
          </div>
          <div class="card-body pt-0">
            <form action="/admin/dokumen/save" method="post" enctype="multipart/form-data"><?= csrf_field() ?>
              <div class="form-group mb-3">
                <label for="judul" class="form-label">Judul Dokumen</label>
                <input type="text" name="judul" id="judul" placeholder="Judul Publikasi Dokumen" class="form-control <?= ($validation->hasError('judul')) ?  'is-invalid' : ''; ?>" value="<?= (old('judul')) ?  old('judul') : '' ?>">
                <div class="invalid-feedback">
                  <?= $validation->getError('judul'); ?>
                </div>
              </div>
              <div class="form-group mb-3">
                <label for="dokumen" class="form-label">Dokumen Publikasi</label>
                <input type="file" name="dokumen" id="dokumen" class="form-control <?= ($validation->hasError('dokumen')) ?  'is-invalid' : ''; ?>" style="padding: 6.7px 9px;" accept="image/*,.pdf" value="<?= (old('dokumen')) ?  old('dokumen') : '' ?>">
                <div class="invalid-feedback">
                  <?= $validation->getError('dokumen'); ?>
                </div>
                <small class="text-muted">
                  File yang diizinkan: .jpg, .jpeg, .png, .pdf
                </small>
              </div>
              <div class="form-group mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea type="text" name="keterangan" id="keterangan" class="form-control <?= ($validation->hasError('keterangan')) ?  'is-invalid' : ''; ?>"><?= (old('keterangan')) ?  old('keterangan') : '' ?></textarea>
                <div class="invalid-feedback">
                  <?= $validation->getError('keterangan'); ?>
                </div>
              </div>
              <button type="submit" class="btn btn-primary float-right">SIMPAN</button>
            </form>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-7">
        <div class="alert alert-warning mb-3">
          <strong><i class="fa fa-info-circle mr-2"></i>Peringatan !</strong> <br>
          File yang sudah diunggah tidak dapat diedit, silahkan hapus terlebih dahulu jika ingin mengganti file atau terjadi kesalahan pada judul, keterangan, atau file.
        </div>
        <div class="card">
          <div class="card-header">
            <h4>Dokumen Terbit</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-hover" id="table-files">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Files</th>
                    <th>Diunggah</th>
                    <th>#</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1; ?>
                  <?php foreach ($publikasi as $p) : ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td>
                        <?= $p['judul'] ?>
                        <?php if (!empty($p['keterangan'])) : ?>
                          <span class="ml-2"><i class="fa fa-info-circle text-primart" data-toggle="popover" data-placement="top" data-html="true" title="Keterangan" data-content="<?= $p['keterangan'] ?>" data-trigger="hover"></i></span>
                        <?php endif ?>
                      </td>
                      <td><a href="/files/publication/<?= $p['file'] ?>" target="_blank"><i class="fa fa-download"></i></a></td>
                      <td><small><?= $p['updated_at'] ?></small></td>
                      <td>
                        <a class="text-danger" onClick="return confirm('Apakah anda yakin akan menghapus publikasi - <?= $p['judul'] ?>')" href="/admin/dokumen/delete/<?= $p['id'] ?>"><i class="fa fa-trash text-danger"></i></a>
                      </td>
                    </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?= $this->endSection(); ?>

<?= $this->section('script_js'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
<?= $this->endSection(); ?>

<?= $this->section('script_js'); ?>
<script src="/summernote/summernote-bs4.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>

<script>
  $(document).ready(function() {
    $('#table-files').DataTable({
      responsive: true,
      perPage: 5,
      lengthMenu: [5, 10, 25, 50, 100],
    });
    $('#keterangan').summernote({
      dialogsInBody: true,
      toolbar: [
        ['font', ['bold', 'underline', 'clear']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['insert', ['link']],
      ]
    });
  });
</script>
<?= $this->endSection(); ?>