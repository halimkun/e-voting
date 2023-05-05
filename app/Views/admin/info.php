<?= $this->extend('template_admin/layout'); ?>

<?= $this->section('content'); ?>
<section class="section">
  <div class="section-header">
    <h1>Informasi Publik</h1>
    <?= showFlasher(); ?>
  </div>

  <div class="section-body">
    <div class="row">
      <?php if (!isset($id)) : ?>
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Daftar Berita</h4>
            </div>
            <div class="card-body pt-2">
              <div class="table-responsive">
                <table class="table table-informasi">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Judul</th>
                      <th>Terakhir Diubah</th>
                      <th>#</th>
                    </tr>
                  </thead>
                  <?php $no = 1; ?>
                  <?php foreach ($info as $i) : ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $i['judul'] ?></td>
                      <td><?= $i['updated_at'] ?></td>
                      <td>
                        <a href="/admin/info/<?= $i['id'] ?>" class="btn btn-sm btn-icon btn-primary"><i class="fa fa-pen"></i></a>
                        <a href="/admin/info/delete/<?= $i['id'] ?>" class="btn btn-sm btn-icon btn-danger" onClick="return confirm('Anda yakin akan menghapus berita - <?= $i['judul'] ?>')"><i class="fa fa-trash-alt"></i></a>
                      </td>
                    </tr>
                  <?php endforeach ?>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      <?php endif ?>

      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Tambah Informasi</h4>
          </div>
          <div class="card-body pt-2">
            <form action="/admin/info/save" method="post" enctype="multipart/form-data"><?= csrf_field() ?>
              <?php if (isset($id)) : ?>
                <input type="hidden" name="id" value="<?= $info['id'] ?>">
              <?php endif; ?>
              <div class="form-group mb-3">
                <label for="judul" class="form-label">Judul Berita</label>
                <input type="text" name="judul" id="judul" placeholder="Judul Publikasi Dokumen" class="form-control <?= ($validation->hasError('judul')) ?  'is-invalid' : ''; ?>" value="<?= (old('judul')) ?  old('judul') : (isset($id) ? $info['judul'] : '') ?>">
                <div class="invalid-feedback">
                  <?= $validation->getError('judul'); ?>
                </div>
              </div>
              <!-- <div class="form-group mb-3">
                <label for="dokumen" class="form-label">Dokumen Publikasi</label>
                <input type="file" name="dokumen" id="dokumen" class="form-control <?= ($validation->hasError('dokumen')) ?  'is-invalid' : ''; ?>" style="padding: 6.7px 9px;" accept="image/*,.pdf" value="<?= (old('dokumen')) ?  old('dokumen') : '' ?>">
                <div class="invalid-feedback">
                  <?= $validation->getError('dokumen'); ?>
                </div>
                <small class="text-muted">
                  File yang diizinkan: .jpg, .jpeg, .png, .pdf
                </small>
              </div> -->
              <div class="form-group mb-3">
                <label for="isi" class="form-label">isi</label>
                <textarea type="text" name="isi" id="isi" class="form-control isi-area <?= ($validation->hasError('isi')) ?  'is-invalid' : ''; ?>"><?= (old('isi')) ?  old('isi') : (isset($id) ? $info['isi'] : '') ?></textarea>
                <div class="invalid-feedback">
                  <?= $validation->getError('isi'); ?>
                </div>
              </div>
              <button type="submit" class="btn btn-primary float-right">SIMPAN</button>
            </form>
          </div>
        </div>
      </div>
    </div>
</section>
<?= $this->endSection(); ?>

<?= $this->section('script_js'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>

<script>
  $(document).ready(function() {
    $(".table-informasi").dataTable({
      perPage: 5,
      lengthMenu: [5, 10, 15, 20],
    });

    $('#isi').summernote({
      placeholder: 'Isi Informasi',
      dialogsInBody: true,
      tabsize: 2,
      height: 200,
      maximumImageFileSize: 1024 * 5120 * 1,
      callbacks: {
        onImageUpload: function(files) {
          uploadFile(files)
        },
        onMediaDelete: function(target) {
          deleteFile(target);
        }
      },
      toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'clear']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['insert', ['link', 'picture', 'video']]
      ]
    });

    function uploadFile(files) {
      if (files.length > 1) {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Hanya bisa mengupload gambar satu-persatu',
        })
        return;
      }

      var data = new FormData();
      data.append("<?= csrf_token() ?>", "<?= csrf_hash() ?>");
      data.append("file", files[0]);
      $.ajax({
        data: data,
        type: "POST",
        enctype: 'multipart/form-data',
        url: "/admin/informasi/summernote/upload",
        cache: false,
        contentType: false,
        processData: false,
        success: function(response) {
          var json = JSON.parse(response);
          if (json.success) {
            const img = $('<img>').attr('src', json.url).attr('class', 'img-fluid').attr('alt', json.name);
            $('#isi').summernote(
              'insertNode',
              img[0]
            );
          } else {
            alert(json.msg);
          }
        }
      });
    }

    function deleteFile(target) {
      // if target length more than 1 swal error
      if (target.length > 1) {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Hanya bisa gambar satu-persatu',
        })
        return;
      }

      // get file name from src attribute 
      const filename = target[0].src.split('/').pop();
      $.ajax({
        type: "GET",
        url: "/admin/informasi/summernote/delete",
        data: {
          src: filename,
        },
        success: function(response) {
          var json = JSON.parse(response);
          console.log(json);
          if (json.success) {
            target.remove();
          } else {
            alert(json.msg);
          }
        }
      })
    }
  });
</script>
<?= $this->endSection(); ?>