<?= $this->extend('template_admin/layout'); ?>
<?= $this->section('content'); ?>
<section class="section">
  <div class="section-header">
    <h1><?= isset($agenda_edit) ? 'Edit' : '' ?> Agenda</h1>
    <?= showFlasher(); ?>
  </div>
  <div class="row">
    <div class="col-12 <?= !isset($agenda_edit) ? 'col-md-5' : 'col-md-12' ?>">
      <div class="card">
        <div class="card-header">
          <h4>Tambah Agenda</h4>
        </div>
        <div class="card-body">
          <form action="/admin/agenda/save" enctype="multipart/form-data" method="post">
            <?php if (isset($agenda_edit)) : ?>
              <input type="hidden" name="id" id="id" value="<?= $agenda_edit['id'] ?>">
            <?php endif ?>
            <div class="form-group mb-3">
              <label for="acara">Judul Agenda</label>
              <input type="text" class="form-control <?= ($validation->hasError('acara')) ?  'is-invalid' : ''; ?>" id="acara" name="acara" placeholder="Masukkan Judul Agenda" value="<?= old('acara') ?  old('acara') : (isset($agenda_edit) ? $agenda_edit['acara'] : '') ?>">
              <div class="invalid-feedback">
                <?= $validation->getError('acara'); ?>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="form-group mb-3">
                  <label for="mulai">Waktu Mulai</label>
                  <input type="datetime-local" name="mulai" id="mulai" value="<?= old('mulai') ?  old('mulai') : (isset($agenda_edit) ? $agenda_edit['mulai'] : '') ?>" class="form-control <?= ($validation->hasError('mulai')) ?  'is-invalid' : ''; ?>">
                  <div class="invalid-feedback">
                    <?= $validation->getError('mulai'); ?>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group mb-3">
                  <label for="selesai">Waktu Selesai</label>
                  <input type="datetime-local" name="selesai" id="selesai" value="<?= old('selesai') ?  old('selesai') : (isset($agenda_edit) ? $agenda_edit['selesai'] : '') ?>" class="form-control <?= ($validation->hasError('selesai')) ?  'is-invalid' : ''; ?>">
                </div>
              </div>
            </div>
            <div class="form-group mb-3">
              <label for="keterangan" class="form-label">Keterangan</label>
              <textarea type="text" name="keterangan" id="keterangan" class="form-control mb-0 <?= ($validation->hasError('keterangan')) ?  'is-invalid' : ''; ?>"><?= old('keterangan') ?  old('keterangan') : (isset($agenda_edit) ? $agenda_edit['keterangan'] : '') ?></textarea>
              <div class="invalid-feedback">
                <?= $validation->getError('keterangan'); ?>
              </div>
            </div>
            <div class="form-group mb-3">
              <label for="foto" class="form-label">Foto Agenda</label>
              <input type="file" name="foto" id="foto" class="form-control <?= ($validation->hasError('foto')) ?  'is-invalid' : ''; ?>" style="padding: 6.7px 9px;" accept="image/*" value="<?= old('foto') ?  old('foto') : (isset($agenda_edit) ? $agenda_edit['foto'] : '') ?>">
              <div class="invalid-feedback">
                <?= $validation->getError('foto'); ?>
              </div>
            </div>
            <button type="submit" class="btn btn-primary float-right">SIMPAN</button>
          </form>
        </div>
      </div>
    </div>
    <?php if (!isset($agenda_edit)) : ?>
      <div class="col-12 col-md-7">
        <div class="card">
          <div class="card-header">
            <h4>Daftar Agenda</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table" id="tbl-agenda">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Acara</th>
                    <th>Waktu</th>
                    <th>Selesai</th>
                    <th>#</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1 ?>
                  <?php foreach ($agenda as $a) : ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><strong><?= $a['acara'] ?></strong></td>
                      <td>
                        <div style="font-size: 11px;"><?= date_format(date_create($a['mulai']), 'd F Y') ?></div>
                      </td>
                      <td>
                        <div style="font-size: 11px;"><?= date_format(date_create($a['selesai']), 'd F Y') ?></div>
                      </td>
                      <td>
                        <div class="d-flex ">
                          <a href="/admin/agenda/<?= $a['id'] ?>" class="btn btn-sm btn-primary btn-icon mx-1"><i class="fa fa-pen"></i></a>
                          <a href="/admin/agenda/delete/<?= $a['id'] ?>" onclick="return confirm('apakah anda yakin akan menghapus agena <?= $a['acara'] ?>')" class="btn btn-sm btn-danger btn-icon mx-1"><i class="fa fa-trash-alt"></i></a>
                        </div>
                      </td>
                    </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    <?php endif ?>
  </div>
</section>
<?= $this->endSection(); ?>


<?= $this->section('script_css'); ?>
<link href="/summernote/summernote-bs4.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
<?= $this->endSection(); ?>


<?= $this->section('script_js'); ?>
<script src="/summernote/summernote-bs4.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>

<script>
  // ready
  $(document).ready(function() {
    $('#tbl-agenda').DataTable({
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