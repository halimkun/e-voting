<?= $this->extend('layouts'); ?>
<?= $this->section('content'); ?>
<header class="masthead-75" style='background: linear-gradient(to bottom, rgba(4, 33, 76, 0.70) 0%, rgba(4, 33, 76, 0.9) 100%), url("<?= $img_src ?>"); background-position: <?= $img_avaiable ? 'top' : 'center' ?>; background-repeat: no-repeat; background-attachment: scroll; background-size: cover;'>
  <div class="container px-4 px-lg-5 h-100">
    <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
      <div class="col-lg-10 align-self-end">
        <h1 class="text-white font-weight-bold m-0 p-0" style="text-transform: capitalize !important;"><?= strtolower($info['judul']) ?></h1>
      </div>
      <div class="col-lg-8 align-self-baseline text-white-75">
        dibuat pada : <?= date_format(date_create($info['created_at'] ), 'd F Y H:i') ?>
      </div>
    </div>
  </div>
</header>

<section class="page-section">
  <div class="container">
    <div class="mb-3">
      <h4 class="m-0 p-0"><?= $info['judul'] ?></h4>
      <small class="text-secondary"><?= getDataAdmin('nama', $info['user_id']) ?> <span class="mx-2">||</span> <?= date_format(date_create($info['created_at']), "d F Y H:i") ?></small>
    </div>
    <div class="isi">
      <?= $info['isi'] ?>
    </div>
  </div>
</section>
<?= $this->endSection(); ?>



<?= $this->section('script_js'); ?>
<script>
  $(document).ready(function() {
    $('img').addClass('img-fluid');
  });
</script>
<?= $this->endSection(); ?>