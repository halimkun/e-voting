<?= $this->extend('layouts'); ?>
<?= $this->section('content'); ?>
<header class="masthead-75" style='background: linear-gradient(to bottom, rgba(4, 33, 76, 0.38) 0%, rgba(4, 33, 76, 0.75) 100%), url("https://smankesesi.sch.id/wp-content/uploads/2022/05/IMG_20220512_092459-scaled.jpg"); background-position: top; background-repeat: no-repeat; background-attachment: scroll; background-size: cover;'>
  <div class="container px-4 px-lg-5 h-100">
    <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
      <div class="col-lg-10 align-self-end">
        <h1 class="text-white font-weight-bold">PUBLIKASI OSIS<br><?= setting('App.nama_sekolah') ?></h1>
      </div>
      <div class="col-lg-8 align-self-baseline">
        <p class="text-white mb-5">
          file yang terdafar pada halaman ini merupakan publikasi OSIS <?= setting('App.nama_sekolah') ?> yang berisi informasi, pengumuman, dan kegiatan atau hal lain yang berkaitan dengan OSIS <?= setting('App.nama_sekolah') ?>.
        </p>
      </div>
    </div>
  </div>
</header>

<section class="page-section">
  <div class="container">
    <h2 class="mt-0 mb-4 text-center">PUBLIKASI</h2>
    <div class="table-responsive">
      <table class="table table-hover table-striped" id="tblfile">
        <thead>
          <tr>
            <th class="text-center">No</th>
            <th>Judul File</th>
            <th>Di Upload</th>
            <th class="text-center">Download</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1 ?>
          <?php foreach ($webFile as $file) : ?>
            <tr>
              <td class="text-center"><?= $no++ ?></td>
              <td>
                <strong><?= $file['judul'] ?></strong>
                <small class="m-0 p-0" style="opacity: .7;"><?= $file['keterangan'] ?></small>
              </td>
              <td>
                <?= date_format(date_create($file['updated_at']), 'd F Y') ?> <br>
                <small>
                  <?php
                  $date = new DateTime($file['updated_at']);
                  $now = new DateTime();
                  $diff = $date->diff($now);
                  if ($diff->d !== 0) {
                    echo '<p style="opacity:.7;">' . $diff->d . 'hari yang lalu</p>';
                  }
                  ?>
                </small>
              </td>
              <td class="text-center"><a href="/files/publication/<?= $file['file'] ?>" class="btn btn-sm btn-primary" target="_blank"><i class="fa fa-download"></i></a></td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
</section>
<?= $this->endSection(); ?>



<?= $this->section('script_css'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
<?= $this->endSection(); ?>



<?= $this->section('script_js'); ?>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<script>
  $(document).ready(function() {
    $('#tblfile').DataTable();
  });
</script>
<?= $this->endSection(); ?>