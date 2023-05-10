<?= $this->extend('layouts'); ?>
<?= $this->section('content'); ?>
<header class="masthead" style='background: linear-gradient(to bottom, rgba(4, 33, 76, 0.38) 0%, rgba(4, 33, 76, 0.75) 100%), url("https://smankesesi.sch.id/wp-content/uploads/2022/05/IMG_20220512_092459-scaled.jpg"); background-position: center; background-repeat: no-repeat; background-attachment: scroll; background-size: cover;'>
  <div class="container px-4 px-lg-5 h-100">
    <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
      <div class="col-lg-10 align-self-end">
        <h1 class="text-white font-weight-bold">OSIS <?= setting('App.nama_sekolah') ?></h1>
      </div>
      <div class="col-lg-8 align-self-baseline">
        <p class="text-white mb-5">Selamat datang di website resmi Organisasi Siswa Intra Sekolah & Majelis Perwakilan Kelas SMA Negri 1 Kesesi</p>
      </div>
    </div>
  </div>
</header>

<!-- About-->
<section class="page-section bg-primary" id="about">
  <div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
      <div class="col-lg-10 text-center">
        <h2 class="text-white mt-0 mb-3"><?= setting('App.about_title') ?> </h2>
        <p class="text-white-75 mb-4"><?= htmlspecialchars_decode(setting('App.about_sekolah')) ?></p>
      </div>
    </div>
  </div>
</section>

<div class="w-full embed-responsive embed-responsive-16by9">
  <iframe class="embed-responsive-item w-100" style="height: 450px;" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1979.9849083246831!2d109.51097041368486!3d-7.012832680962811!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6fde2bef3b1bb5%3A0xa430a48d1d26291d!2sSMA%20NEGERI%201%20KESESI%20KAB.PEKALONGAN!5e0!3m2!1sid!2sid!4v1683122470357!5m2!1sid!2sid" title="SMA NEGERI 1 KESESI" aria-label="SMA NEGERI 1 KESESI"></iframe>
</div>

<!-- TODO : Berita Terbaru -->

<!-- Portfolio-->
<section class="bg-light" id="agenda">
  <div class="container px-4 py-5 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
      <div class="col-lg-10 text-center">
        <h2 class="mt-3">AGENDA KEGIATAN <?= htmlspecialchars_decode(setting('App.nama_sekolah')) ?></h2>
        <p>
          berikut ini adalah agenda kegiatan yang akan dilaksanakan oleh OSIS <?= setting('App.nama_sekolah') ?>. 
        </p>
      </div>
    </div>
  </div>
  <div id="portfolio" class="mb-1">
    <div class="container-fluid p-0">
      <div class="row g-0">
        <?php foreach ($agenda as $a) : ?>
          <div class="col-lg-4 col-sm-6">
            <a class="portfolio-box" href="/agenda/<?= $a['id'] ?>" title="Project Name">
              <img class="img-fluid" style="width: 100%; height: 300px; object-fit: cover; object-position: center;" src="/files/agenda/<?= $a['foto'] ?>" alt="..." />
              <div class="portfolio-box-caption">
                <div class="project-category text-white-50">Agenda</div>
                <div class="project-name"><?= $a['acara'] ?></div>
              </div>
            </a>
          </div>
        <?php endforeach ?>
      </div>
    </div>
  </div>
</section>
<?= $this->endSection(); ?>