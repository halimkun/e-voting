<?= $this->extend('layouts'); ?>
<?= $this->section('content'); ?>
<style>
  #artikel a,
  #artikel {
    color: #6c757d !important;
    transition: color .3s ease-in-out;
  }

  #artikel a:hover,
  #artikel {
    color: #0d6efde6 !important;
    transition: color .3s ease-in-out;
  }
</style>

<header class="masthead-75" style='background: linear-gradient(to bottom, rgba(4, 33, 76, 0.38) 0%, rgba(4, 33, 76, 0.75) 100%), url("https://smankesesi.sch.id/wp-content/uploads/2022/05/IMG_20220512_092459-scaled.jpg"); background-position: top; background-repeat: no-repeat; background-attachment: scroll; background-size: cover;'>
  <div class="container px-4 px-lg-5 h-100">
    <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
      <div class="col-lg-10 align-self-end">
        <h1 class="text-white font-weight-bold">ARTIKEL <br><?= setting('App.nama_sekolah') ?></h1>
      </div>
      <div class="col-lg-8 align-self-baseline"></div>
    </div>
  </div>
</header>

<section class="page-section">
  <div class="container">
    <h2 class="mt-0 mb-4 text-center">ARTIKEL TERBARU</h2>
    <div class="" id="artikel">
      <?php foreach ($informasi as $artikel) : ?>
        <a href="/informasi/<?= $artikel['id'] ?>" class="text-decoration-none">
          <div class="d-flex align-items-center w-100 mb-2">
            <div class="text-center p-3">
              <h6 class="m-0 p-0" style="letter-spacing: 3px; margin-bottom:-5px !important;"><?= getMonthFromDate($artikel['created_at']) ?></h6>
              <h2 class="m-0 p-0" style="margin-bottom:-5px !important;"><?= getDayFromDate($artikel['created_at']) ?></h4>
                <h6 class="m-0 p-0" style="margin-bottom:-5px !important;"><?= getYearFromDate($artikel['created_at']) ?></h6>
            </div>
            <div class="px-3 w-100 border-4 border-start">
              <h1 class="m-0 p-0" style="text-transform: capitalize !important;"><?= strtolower($artikel['judul']) ?></h1>
              <h6 class="m-0 p-0" style="opacity: .9;"><?= getFullTimeFromDate($artikel['created_at']) ?></h6>
            </div>
          </div>
        </a>
      <?php endforeach ?>
    </div>
  </div>
</section>
<?= $this->endSection(); ?>