<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>SILAHKAN MEMILIH</title>
  <link rel="stylesheet" href="<?= base_url(); ?>/fontawesome/css/all.min.css" type="text/css" media="all" />
  <link rel="stylesheet" href="<?= base_url(); ?>/css/bootstrap.min.css" type="text/css" media="all" />
  <link rel="stylesheet" href="<?= base_url(); ?>/sweetalert/sweetalert2.min.css" type="text/css" media="all" />
  <link rel="stylesheet" href="<?= base_url(); ?>/css/pilih.css" type="text/css" media="all" />
</head>
<body>

  <!-- flasher -->
  <?php if(session()->getFlashdata('error-pilih')) : ?>
   <div id="flash-crud" data-title="Oupss.." data-text="Mohon-untuk-memilih-terlebih-dahulu!!!" data-icon="error" data-flash="true"></div>
  <?php endif; ?>
  
  <?php if(session()->getFlashdata('info-pilih')) : ?>
   <?php 
    session()->remove('login'); 
    unset($_SESSION['login']);
   ?>
   <div id="flash-logout" data-title="Terimakasih.." data-text="pilihan-anda-sudah-tersimpan" data-icon="success" data-flash="true"></div>
  <?php endif; ?>
  
  <nav class="navbar fixed-top pb-0 bg-light">
    <h2 class="nav-brand">
      <?= $general['nama_sekolah']; ?>
    </h2>
    
    <div class="nav-info" id="info-nama-peserta">
      <h5 class="mb-0">
        <?= getDataPeserta('nama'); ?>
      </h5>
      <p class="" >
        <?= getDataPeserta('kelas'); ?> <?= getDataPeserta('jurusan'); ?> / <?= getDataPeserta('username');?>
      </p>
    </div>
   
  </nav>
  
  <div class="wadah">
    <div class="row text-center info">
      <div class="col">
        <h6 class="mb-0" >
          Selamat Datang Di Pilketos
        </h6>
        <p>
          SMA NEGERI 1 KESESI
        </p>
      </div>
    </div>
    
    <div class="row kotak-pilih">
      <div class="col-12 d-flex justify-content-center">
        <?php foreach($dt_kandidat as $dt) : ?>
        <div class="kotak-pilih-satuan mx-2  shadow border">
          <div class="card w-100 border-0">
            <div class="card-header text-center bg-white">
              <h2>
                <?= $dt->no_urut; ?>
              </h2>
            </div>
            <img src="img/candidate/<?= $dt->foto; ?>" class="card-img-top" alt="foto kandidat">
            <div class="card-body">
              <h5 class="card-title text-center mb-0">
                <?= $dt->ketua; ?>
              </h5>
              <h5 class="card-title text-center mb-0">
                &
              </h5>
              <h5 class="card-title text-center">
                <?= $dt->wakil; ?>
              </h5>
              <p class="text-center">
                <i>
                  "<?= $dt->slogan; ?>"
                </i>
              </p>
              <div class="">
                <button type="button" class="btn btn-success btnView" data-toggle="modal" data-target="#exampleModal" data-href="<?= base_url(); ?>/pilih/getOneData/<?= $dt->id_candidate; ?>" data-id="1">
                  <i class="fas fa-eye"></i>
                </button>
                <button type="button" class="btn btn-pilih float-right w-50 btnPilih " data-pilih="1">
                  Pilih
                </button>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
    
    <div class="row mt-3 mb-5">
      <div class="col-12">
        <form action="<?= base_url(); ?>/pilih/cek" method="post" accept-charset="utf-8" class="">
          <?= csrf_field(); ?>
          <div class="row d-flex justify-content-center ">
            <div class="col d-none">
              <?php foreach($dt_kandidat as $dtc) : ?>
              <input type="radio" name="pilihan" id="pilihan"  class="pilihan" value="<?= $dtc->id_candidate; ?>" name="pilihan"/>
              <?php endforeach; ?>
            </div>
            <button class="btn btn-kirim py-2 px-5 shadow" type="submit">
              <h4 class="mb-0">
                KIRIM 
              </h4>
            </button>
          </div>
        </form>
      </div>
    </div>

  </div>
  

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">
            No Urut : <span id="no_urut">1</span>
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row mb-2">
            <div class="col-12">
              <img src="img/candidate1.jpg" alt="" class="img-thumbnail" id="foto_kandidat" data-srcImage="<?= base_url(); ?>/img/candidate/">
            </div>
          </div>
          <div class="row mb-1">
            <div class="col-12">
              <h5>
                Nama Ketua : <span id="ketua">BUDI BUDIMAN</span>
              </h5>
            </div>
            <div class="col-12">
              <h5>
                Nama Wakil : <span id="wakil">AGUS SANTOSO WIJAYA</span>
              </h5>
            </div>
            <div class="col-12">
              <h5>
                Slogan : <span id="slogan">"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod consequuntur facere deleniti ut natus ipsa."</span>
              </h5>
            </div>
            <div class="col-12 visi-misi">
              <h5>Visi :</h5>
              <span id="visi">
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit, hic!</p>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit, hic!</p>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit, hic!</p>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit, hic!</p>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit, hic!</p>
              </span>
            </div>
            <div class="col-12 visi-misi mt-1">
              <h5>Misi :</h5>
              <span id="misi">
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit, hic!</p>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit, hic!</p>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit, hic!</p>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit, hic!</p>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit, hic!</p>
              </span>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  
  <script src="<?= base_url(); ?>/js/jquery.min.js"></script>
  <script src="<?= base_url(); ?>/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url(); ?>/sweetalert/sweetalert2.all.min.js"></script>
  <script src="<?= base_url(); ?>/js/flasher.js"></script>
  <script src="<?= base_url(); ?>/js/pilih.js"></script>
  <script>
    const FlashLogout = document.getElementById('flash-logout');
    if(FlashLogout != null){
      Swal.fire({
        title: 'Terimakasih...',
        text: "Terimakasih telah melakukan pemilihan",
        icon: 'success',
        showConfirmButton: false,
        timer: 2000
      }).then((result) => {
        window.location.href = "";
      });
    }
  </script>
</body>
</html>