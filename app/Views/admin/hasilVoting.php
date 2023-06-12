<?= $this->extend('template_admin/layout'); ?>

<?= $this->section('content'); ?>
<?php if(setting('App.status_acara') != 0) : ?>
<section class="section">
  <div class="section-header">
    <h1>
      Hasil Voting
    </h1>
  </div>
  
  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>
              Hasil Voting
            </h4>
          </div>
          <div class="card-body pt-0">
            <div class="row mb-1">
              <?php foreach($data_chart as $dt) : ?>
               <div class="col-12 col-md-4">
                 <div class="card border">
                    <div class="text-center p-1">
                      <span class="badge  border"><?= $dt['no_urut']; ?></span>
                    </div>
                    <div class="text-center">
                      <img src="<?= base_url(); ?>/img/candidate/<?= $dt['foto']; ?>" class="card-img-top img-thumbnail border-0" style="width:75%;" alt="foto kandidat">
                    </div>
                    <div class="card-body">
                      <div class="card-title text-center">
                        <h6><b><?= $dt['ketua']; ?></b> & <b><?= $dt['wakil']; ?></b></h6>
                      </div>
                      <div class="info-suara text-center">
                        <strong class="h5">
                          <?= $dt['jmlh']; ?>
                        </strong> suara
                      </div>
                    </div>
                 </div>
               </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
      
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>
              Statistik
            </h4>
          </div>
          <div class="card-body pt-0">
            <canvas id="myChart" height="182"></canvas>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</section>
<?php else : ?>
<section class="section">
  <div class="section-header">
    <h1>Hasil Voting</h1>
  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>
              Hasil Voting
            </h4>
          </div>
          <div class="card-body text-center">
            <strong><i>Oups... Sepertinya Acara Belum dimulai</i></strong>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>
<?= $this->endSection(); ?>

<?= $this->section('script_js'); ?>
<?php 
foreach($data_chart as $dt){
  $data_label[] = $dt['ketua'] . ' & ' . $dt['wakil']; 
  $data_jmlh[] = $dt['jmlh'];
} 
?>
<script>
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
       // labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        labels: <?= json_encode($data_label); ?>,
        datasets: [{
            label: '# of Votes',
            // data: [12, 19, 3, 5, 2, 3],
            data: <?= json_encode($data_jmlh); ?>,
            backgroundColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 0,
            
        }]
    },
    options: {
     
    }
});
</script>
<?= $this->endSection(); ?>

