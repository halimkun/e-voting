<?= $this->extend('template_admin/layout'); ?>

<?= $this->section('content'); ?>
<section class="section">
  <div class="section-header">
    <h1>Laporan Kandidat</h1>
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
            <form action="<?= base_url(); ?>/admin/cetakPdf/kandidat" method="post">
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