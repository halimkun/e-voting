<?= $this->extend('template_admin/layout'); ?>

<?= $this->section('content'); ?>
<section class="section">
  <div class="section-header">
    <h1>
      Laporan Hasil Voting
    </h1>
  </div>
  
  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>
              Cetak Pdf
            </h4>
          </div>
          <div class="card-body pt-0">
            <?php if(session()->getFlashdata('info-cetak-hasil')) : ?>
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('info-cetak-hasil'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <?php endif; ?>
            <form action="<?= base_url(); ?>/admin/cetakPdf/hasil" method="post">
              <?= csrf_field(); ?>
              <button type="submit"  class="btn btn-danger btn-icon icon-left">
                <i class="fas fa-download"></i>
                Download PDF
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?= $this->endSection(); ?>