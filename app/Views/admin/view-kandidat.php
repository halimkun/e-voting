<?= $this->extend('template_admin/layout'); ?>

<?= $this->section('content'); ?>
<section class="section">
  <div class="section-header">
    <h1>Detail Kandidat</h1>
  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Detail</h4>
            <div class="card-header-form d-inline">
              <a href="<?= base_url(); ?>/admin/kandidat" class="btn btn-icon btn-warning icon-left float-right "><i class="fas fa-long-arrow-alt-left"></i> Kembali</a>
            </div>
          
          </div>
          <div class="card-body pt-0">
            <div class="row">
              <div class="col-md-4 col-sm-12">
                <img src="<?= base_url(); ?>/img/candidate/<?= $data_candidate->foto; ?>" alt="" class="img-thumbnail">
              </div>
              <div class="col-md-8 col-sm-12">
                <div class="row">
                  <div class="col-12 text-center my-2">
                    <h5>
                      <?= $data_candidate->no_urut; ?>
                    </h5>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 col-sm-12">
                     <b>Nama Ketua : </b> <?= $data_candidate->ketua; ?>
                  </div>
                  <div class="col-md-6 col-sm-12">
                     <b>Nama Wakil : </b> <?= $data_candidate->wakil; ?>
                  </div>
                  <div class="col-sm-12 col-md-6 col-view-visi-misi">
                    <b>Visi : </b>
                     <?= $data_candidate->visi; ?>
                  </div>
                  <div class="col-sm-12 col-md-6 col-view-visi-misi">
                    <b>Misi : </b>
                     <?= $data_candidate->misi; ?>
                  </div>
                  <div class="col-12 text-center mt-2">
                    <i><b>"<?= $data_candidate->slogan; ?>"</b></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?= $this->endSection(); ?>