<?= $this->extend('template_admin/layout'); ?>

<?= $this->section('content'); ?>

<section class="section">
  <div class="section-header">
    <h1>Dashboard</h1>
    <?= showFlasher(); ?>
  </div>
  <div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-primary">
          <i class="fas fa-users"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Jumlah Peserta</h4>
          </div>
          <div class="card-body">
            <?= $jmlh_peserta ?>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-success">
          <i class="fas fa-user-check"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Sudah Memilih</h4>
          </div>
          <div class="card-body">
            <?= $sudah_memilih ?>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-danger">
          <i class="fas fa-user-times"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Belum Memilih</h4>
          </div>
          <div class="card-body">
            <?= $belum_memilih ?>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-info">
          <i class="fas fa-user-friends"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Jumlah Kandidat</h4>
          </div>
          <div class="card-body">
            <?= $jmlh_candidate ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="row">
    <div class="col-lg-4 col-md-4 col-12 col-sm-12">
      <div class="card">
        <div class="card-header">
          <h4>Info Acara</h4>
        </div>
        <div class="card-body pt-0">
          <div class="row mb-2 ">
            <div class="col-md-4 col-sm-12">
              <b>Status</b>
            </div>
            <div class="col-md-8">
              <?php if($status_acara == 0) : ?>
               Belum Dimulai
              <?php elseif($status_acara == 1) : ?>
               Sedang Berlangsung
              <?php else : ?>
               Sudah Selesai
              <?php endif; ?>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-4 col-sm-12">
              <b>Jumlah Peserta</b>
            </div>
            <div class="col-md-8">
              <?= $jmlh_peserta; ?>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-4 col-sm-12">
              <b>Jumlah Kandidat</b>
            </div>
            <div class="col-md-8">
              <?= $jmlh_candidate; ?>
            </div>
          </div>
          <div class="row  pt-2">
            <div class="col-6 text-center">
             <h6 class="text-primary mb-0">
               <?= $sudah_memilih_persen; ?>
             </h6>
             <p>sudah memilih</p>
            </div>
            <div class="col-6 text-center">
             <h6 class="text-danger mb-0">
               <?= $belum_memilih_persen; ?>
             </h6>
             <p>belum memilih</p>
            </div>

          </div>

          <div class="text-center pt-1 pb-1">
            <?php if($status_acara == 0) : ?>
              <a href="<?= base_url(); ?>/admin/dashboard/editAcara/1" class="btn btn-success btn-lg btn-round" onclick="return confirm('Yakin ingin memulai acara??');">
                Mulai Acara
              </a>
            <?php elseif($status_acara == 1) : ?>
              <a href="<?= base_url(); ?>/admin/dashboard/editAcara/2" class="btn btn-warning btn-lg btn-round" onclick="return confirm('Yakin ingin menghentikan acara??');">
                Berhentikan Acara
              </a>
            <?php else : ?>
              <a href="<?= base_url(); ?>/admin/dashboard/editAcara/0" class="btn btn-danger btn-lg btn-round" onclick="return confirm('Yakin ingin kembali ke persiapan?. Data hasil akan di reset ke awal lagi!!');">
                Kembali Ke Persiapan
              </a>
            <?php endif; ?>
      </div>
        </div>
      </div>
    </div>
    <div class="col-lg-8 col-md-8 col-12 col-sm-12">
      <div class="card">
        <div class="card-header">
          <h4>Statistik</h4>
        </div>
        <?php if($status_acara != 0) : ?>
          <?php foreach($data_chart as $dt) : ?>
            <?php 
              if($total_suara_masuk == 0){
                $jmlh_progress = 0;
              } else{
                $jmlh_progress = $dt['jmlh'] / $total_suara_masuk * 100;
              }
            ?>
            <div class="card-body pt-0 ">
              <div class="mb-3 row p-1 pl-0 border rounded ">
                <div class="col-md-2 p-0 col-sm-0">
                  <img class="img-thumbnail border-0" src="<?= base_url(); ?>/img/candidate/<?= $dt['foto']; ?>" alt="gambar candidate" />
                </div>
                <div class="col-md-10 col-sm-12 pt-3">
                  <div class="text-small float-right font-weight-bold text-muted">
                    <?= number_format($jmlh_progress, 2); ?>%
                  </div>
                  <div class="font-weight-bold mb-1">
                    <?= $dt['ketua']; ?> & <?= $dt['wakil']; ?>
                  </div>
                  <div class="progress progress-bar-statistik-dashbord" data-height="4">
                    <div class="progress-bar" role="progressbar" data-width="<?= number_format($jmlh_progress, 2); ?>%" aria-valuenow="<?= number_format($jmlh_progress, 2); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else : ?>
          <div class="card-body text-center pt-0">
            <h5>
              Oupss.. Acara Belum Dimulai
            </h5>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection(); ?>








