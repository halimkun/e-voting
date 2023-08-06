<?= $this->extend('template_admin/layout'); ?>

<?= $this->section('content'); ?>
<section class="section">
  <div class="section-header">
    <h1>Data Siswa</h1>
    <?= showFlasher(); ?>
  </div>
  
  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Data Siswa</h4>
            <div class="card-header-form">
              <form action="<?= base_url(); ?>/admin/peserta" method="post">
                <?= csrf_field(); ?>
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search" name="keyword">
                  <div class="input-group-btn">
                    <button class="btn btn-primary" type="submit" name="cari"><i class="fas fa-search"></i></button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="card-body pt-0">
            <div>
              <button type="button"  class="btn btn-info btn-icon icon-left mr-1" data-toggle="modal" data-target="#tambah">
                <i class="fas fa-plus"></i>
                Tambah
              </button>
              <button type="button" class="btn btn-primary btn-icon icon-left mr-1" data-toggle="modal" data-target="#uploadExcel">
                <i class="fas fa-upload"></i>
                Upload Excel
              </button>
              <a href="<?= base_url(); ?>/sampel_excel/sampel-excel.xls" target="_blank" class="btn btn-warning btn-icon icon-left download-sampel-peserta">
                <i class="fas fa-download"></i>
                Download Sampel
              </a>
            </div>
            <div class="table-responsive mt-4">
              <table class="table table-striped">
                <tr>
                  <th>#</th>
                  <th>Username</th>
                  <th>Password</th>
                  <th>Nama</th>
                  <th>Kelas</th>
                  <th>Jurusan</th>
                  <th>Status</th>
                  <th>Waktu Pilih</th>
                  <th>Aksi</th>
                </tr>
                <?php $no = 1 + ($jmlh_data_pagination * ($hal - 1)); ?>
                <?php foreach($data_peserta as $dt) : ?>
                <tr>
                  <td>
                    <?= $no++; ?>
                  </td>
                  <td>
                    <?= $dt->username; ?>
                  </td>
                  <td>
                    <?= $dt->password; ?>
                  </td>
                  <td>
                    <?= $dt->nama; ?>
                  </td>
                  <td>
                    <?= $dt->kelas; ?>
                  </td>
                  <td>
                    <?= $dt->jurusan; ?>
                  </td>
                  <td>
                    <?php if($dt->status_pilihan == 1) : ?>
                      <div class="badge badge-sm badge-success">
                        Sudah Memilih
                      </div>
                    <?php else : ?>
                      <div class="badge badge-sm badge-danger">
                        Belum Memilih
                      </div>
                    <?php endif; ?>
                  </td>
                  <td>
                    <?php if($dt->waktu_pilih != null) : ?>
                      <?= $dt->waktu_pilih; ?>
                    <?php else : ?>
                      -
                    <?php endif; ?>
                  </td>
                  <td>
                    <div class="d-flex">
                      <button type="button" data-toggle="modal" data-target="#edit" class="btn btn-sm btn-icon btn-info mr-1 btn-edit" data-href="<?= base_url(); ?>/admin/peserta/getOneData/<?= $dt->id_peserta; ?>">
                        <i class="far fa-edit "></i>
                      </button>
                      <form action="<?= base_url(); ?>/admin/peserta/hapus/<?= $dt->id_peserta; ?>" method="post" >
                        <input type="hidden" name="_method" value="DELETE">
                        <?= csrf_field(); ?>
                        <button class="btn btn-sm btn-icon btn-danger" type="submit" onclick="return confirm('yakin ingin menghapus data?')">
                          <i class="fas fa-trash"></i>
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
                <?php endforeach; ?>
              </table>
            </div>
            <div class="float-left mt-2 info-peserta-pagination">
              Showing <?= $hal; ?> to <?= ceil($jmlh_all_data / $jmlh_data_pagination) ?> of <?= $jmlh_all_data; ?> entries
            </div>
            <div class="float-right mt-1">
              <?= $pager->links('peserta', 'my_pager'); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
</section>

<!-- Modal tambah data -->
<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
          Tambah Data
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url(); ?>/admin/peserta/add" method="post">
        <div class="modal-body">
            <?= csrf_field(); ?>
            <div class="form-group row mb-4">
              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 ">
                Username
              </label>
              <div class="col-sm-12 col-md-7">
                <input type="number" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : '' ;?>" value="<?= (old('username')) ? old('username') : '' ;?>" name="username" autocomplete="off">
                <div class="invalid-feedback">
                  <?= $validation->getError('username'); ?>
                </div>
              </div>
            </div>
            <div class="form-group row mb-4">
              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 ">
                Nama
              </label>
              <div class="col-sm-12 col-md-7">
                <input type="text" class="form-control  <?= ($validation->hasError('nama')) ? 'is-invalid' : '' ;?>" value="<?= (old('nama')) ? old('nama') : '' ;?>" name="nama" autocomplete="off">
                <div class="invalid-feedback">
                  <?= $validation->getError('nama'); ?>
                </div>
              </div>
            </div>
            <div class="form-group row mb-4">
              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 ">
                Kelas
              </label>
              <div class="col-sm-12 col-md-7">
                <input type="text" class="form-control  <?= ($validation->hasError('kelas')) ? 'is-invalid' : '' ;?>" value="<?= (old('kelas')) ? old('kelas') : '' ;?>" name="kelas" autocomplete="off">
                <div class="invalid-feedback">
                  <?= $validation->getError('kelas'); ?>
                </div>
              </div>
            </div>
            <div class="form-group row mb-4">
              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 ">
                Jurusan
              </label>
              <div class="col-sm-12 col-md-7">
                <input type="text" class="form-control  <?= ($validation->hasError('jurusan')) ? 'is-invalid' : '' ;?>" value="<?= (old('jurusan')) ? old('jurusan') : '' ;?>" name="jurusan" autocomplete="off">
                <div class="invalid-feedback">
                  <?= $validation->getError('jurusan'); ?>
                </div>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal edit Data -->
<div class="modal fade" id="edit" tabindex="-1" aria-labelledby="ModalEdit" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalEdit">
          Edit Data
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url(); ?>/admin/peserta/edit" method="post">
        <div class="modal-body">
            <?= csrf_field(); ?>
            <input type="hidden" name="id_peserta" id="id_peserta">
            <input type="hidden" name="cek_status_pilihan" id="cek_status_pilihan">
            <div class="form-group row mb-4">
              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 ">
                Username
              </label>
              <div class="col-sm-12 col-md-7">
                <input type="number" class="form-control" name="username" autocomplete="off" id="username"  >
              </div>
            </div>
            <div class="form-group row mb-4">
              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 ">
                Password
              </label>
              <div class="col-sm-12 col-md-7">
                <input type="text" class="form-control " name="password" autocomplete="off" id="password" required>
              </div>
            </div>
            <div class="form-group row mb-4">
              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 ">
                Nama
              </label>
              <div class="col-sm-12 col-md-7">
                <input type="text" class="form-control" name="nama" autocomplete="off" id="nama" required>
              </div>
            </div>
            <div class="form-group row mb-4">
              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 ">
                Kelas
              </label>
              <div class="col-sm-12 col-md-7">
                <input type="text" class="form-control" name="kelas" autocomplete="off" id="kelas" required>
              </div>
            </div>
            <div class="form-group row mb-4">
              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 ">
                Jurusan
              </label>
              <div class="col-sm-12 col-md-7">
                <input type="text" class="form-control" name="jurusan" autocomplete="off" id="jurusan" required>
              </div>
            </div>
            <!-- <div class="form-group row mb-4" id="wadah_status_pilihan">
              <div class="control-label col-form-label text-md-right col-12 col-md-3 col-lg-3 ">
                Status Pilihan
              </div>
              <div class="custom-switches-stacked col-sm-12 col-md-7">
                <label class="custom-switch pl-1">
                  <input type="radio" name="status_pilihan" value="0" class="custom-switch-input status_pilihan">
                  <span class="custom-switch-indicator"></span>
                  <span class="custom-switch-description">Belum Memilih</span>
                </label>
                <label class="custom-switch pl-1">
                  <input type="radio" name="status_pilihan" value="1" class="custom-switch-input status_pilihan">
                  <span class="custom-switch-indicator"></span>
                  <span class="custom-switch-description"> Sudah Memilih</span>
                </label>
              </div>
            </div> -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- upload excel -->
<div class="modal fade" id="uploadExcel" tabindex="-1" aria-labelledby="ModalExcel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalExcel">
          Upload File
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="info-file-upload text-center mb-3" id="info-file-upload">
        Belum ada file yg dipilih
      </div>
      <div class="d-flex justify-content-center mb-1">
        <button class="btn btn-primary" type="button" id="btn-upload-excel">
          Upload File
        </button>
      </div>
      <?php if($validation->hasError('file_excel')) : ?>
      <div class="text-center text-danger">
        <i><?= $validation->getError('file_excel'); ?></i>
      </div>
      <?php endif; ?>

      <form action="<?= base_url(); ?>/admin/peserta/uploadExcel" method="post" enctype="multipart/form-data" >
        <div class="modal-body">
            <?= csrf_field(); ?>
            <input type="file" name="file_excel" class="d-none" id="file_excel" onchange="previewFile()" value="<?= (old('file_excel')) ? old('file_excel') : '' ;?>">
        </div>
        <div class="modal-footer pt-0 pb-1 mt-0">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-info">
            Upload
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>


<?= $this->section('script_js'); ?>
<script>
  // ajax 
  const btnEdits = document.querySelectorAll(".btn-edit");
  const id_peserta = document.getElementById("id_peserta");
  const username = document.getElementById("username");
  const password = document.getElementById("password");
  const nama = document.getElementById("nama");
  const kelas = document.getElementById("kelas");
  const jurusan = document.getElementById("jurusan");
  const status_pilihan = document.querySelectorAll(".status_pilihan");
  // const wadah_status_pilihan = document.getElementById('wadah_status_pilihan');
  // const cek_status_pilihan = document.getElementById('cek_status_pilihan');
  
  btnEdits.forEach(function(e){
    e.addEventListener("click", function(el){
      const href = e.getAttribute("data-href");
     
      const xhr = new XMLHttpRequest();
      
      xhr.onload = function(){
        if (xhr.status == 200) {
          const data = JSON.parse(xhr.responseText);
          id_peserta.value = data.id_peserta;
          username.value = data.username;
          password.value = data.password;
          nama.value = data.nama;
          kelas.value = data.kelas;
          jurusan.value = data.jurusan;
          if(data.status_pilihan == 0){
            // wadah_status_pilihan.classList.add('d-none');
            cek_status_pilihan.value = false;
          }else{
            // wadah_status_pilihan.classList.remove('d-none');
            cek_status_pilihan.value = true;
            status_pilihan.forEach(function(e){
            if(e.value == data.status_pilihan){
              e.setAttribute('checked', '');
            }
          });
          }
        } else{
          alert("gagal");
        }
      }
      
      xhr.open("GET", href, true );
      xhr.send();
      
    });
  });
  
  // preview file excel
  
  const btnUpload = document.getElementById('btn-upload-excel');
  btnUpload.addEventListener('click', function(e){
    const fileExcel = document.getElementById("file_excel");
    fileExcel.click();
  });
  
  function previewFile(){
  const fileExcel = document.getElementById("file_excel");
  const textInfo = document.getElementById("info-file-upload");
  
  const fileExc = new FileReader();
  fileExc.readAsDataURL(fileExcel.files[0]);
  
  fileExc.onload = function(e){
    textInfo.textContent = fileExcel.files[0].name;
  };

}

  
  
</script>
<?= $this->endSection(); ?>
