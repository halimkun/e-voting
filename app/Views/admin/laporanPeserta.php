<?= $this->extend('template_admin/layout'); ?>

<?= $this->section('content'); ?>
<section class="section">
  <div class="section-header">
    <h1>Laporan Data Siswa</h1>
  </div>
  
  <div class="section-body">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="card">
          <div class="card-header">
            <h4>
              Cetak Pdf
            </h4>
          </div>
          <div class="card-body pt-0">
            <?php if(session()->getFlashdata('info-peserta')) : ?>
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('info-peserta'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <?php endif; ?>
            <form action="<?= base_url(); ?>/admin/cetakPdf/peserta" method="post" accept-charset="utf-8">
                <?= csrf_field(); ?>
                <div class="section-title mt-0">
                  Kelas
                </div>
                <div class="form-group">
                  <select class="form-control" name="kelas" id="kelas">
                    <option value="">All Kelas</option>
                    <?php foreach($list_kelas as $k) : ?>
                    <option value="<?= $k->kelas; ?>">
                      <?= $k->kelas; ?>
                    </option>
                    <?php endforeach; ?>
                  </select>
                </div>
                
                <div class="section-title mt-0">
                  Jurusan
                </div>
                <div class="form-group">
                  <select class="form-control" name="jurusan" id="jurusan">
                    <option value="">All Jurusan</option>
                    <?php foreach($list_jurusan as $j) : ?>
                    <option value="<?= $j->jurusan; ?>">
                      <?= $j->jurusan; ?>
                    </option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <button type="submit"  class="btn btn-danger btn-icon icon-left float-right">
                  <i class="fas fa-download"></i>
                  Download PDF
                </button>
            </form>
          </div>
        </div>
      </div>
      
      <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="card">
          <div class="card-header">
            <h4>
              Cetak Excel
            </h4>
          </div>
          <div class="card-body pt-0">
            <?php if(session()->getFlashdata('info-peserta-excel')) : ?>
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('info-peserta-excel'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <?php endif; ?>
            <form action="<?= base_url(); ?>/admin/cetakExcel/peserta" method="post" accept-charset="utf-8">
                <?= csrf_field(); ?>
                <div class="section-title mt-0">
                  Kelas
                </div>
                <div class="form-group">
                  <select class="form-control" name="kelas" id="kelas">
                    <option value="">All Kelas</option>
                    <?php foreach($list_kelas as $k) : ?>
                    <option value="<?= $k->kelas; ?>">
                      <?= $k->kelas; ?>
                    </option>
                    <?php endforeach; ?>
                  </select>
                </div>
                
                <div class="section-title mt-0">
                  Jurusan
                </div>
                <div class="form-group">
                  <select class="form-control" name="jurusan" id="jurusan">
                    <option value="">All Jurusan</option>
                    <?php foreach($list_jurusan as $j) : ?>
                    <option value="<?= $j->jurusan; ?>">
                      <?= $j->jurusan; ?>
                    </option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <button type="submit"  class="btn btn-success btn-icon icon-left float-right">
                  <i class="fas fa-file"></i>
                  Download Excel
                </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?= $this->endSection(); ?>