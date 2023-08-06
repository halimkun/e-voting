<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <link rel="stylesheet" href="/css/bootstrap.min.css">

  <style>
    body {
      font-family: "";
    },
    body p {
      font-size: 13pt;
    }
  </style>
</head>

<body>

  <div class="container">
    <!-- KOP -->
    <div class="row mt-4 mb-3" >
      <div class="col-2">
        <img src="/img/logo.png" class="img-fluid" style="width:75%;">
      </div>
      <div class="col-10 text-center">
        <div style="margin-right: 140px; margin-top:7px;">
          <h4 class="m-0 p-0"><b>PANITIA PEMILIHAN KETUA DAN WAKIL OSIS</b></h4>
          <h2><b>SMA NEGERI 1 KESESI</b></h2>
          <div>
            <p class="m-0 p-0" style="font-size: 10pt;">Jl. Raya Kaibahan, Klairan, Kaibahan, Kec. Kesesi, Kabupaten Pekalongan, Jawa Tengah 51162</p>
            <p class="m-0 p-0" style="font-size: 10pt; margin-top:-5px !important;">website: <span class="text-info">https://smankesesi.sch.id/</span> | email : smakesesipekalongan@gmail.com</p>
          </div>
        </div>
      </div>
    </div>

    <!-- horizontal line -->
    <hr style="width:100%; margin-top: 10px; margin-bottom: 4px; border-top: 2px solid black;">
    <hr style="width:100%; margin-top: 1px; margin-bottom: 10px; border-top: 3px solid black;">

    <!-- Heading -->
    <div class="text-center mt-4">
      <h3><b><u>LAPORAN HASIL PEMILIHAN KETUA OSIS</u></b></h3>
    </div>

    <div class="mt-5">
      <p style="font-size: 13pt;">
        Berdasarkan hasil pemilihan ketua dan wakil ketua OSIS SMA Negeri 1 Kesesi yang dilaksanakan pada tahun <span class="year"></span> yang dilakukan oleh seluruh peserta didik SMA Negeri 1 Kesesi, dengan hasil sebagai berikut :
      </p>
    </div>

    <!-- Table -->
    <div>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Pasangan</th>
            <th>Jumlah Suara</th>
            <th>Presentase</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($data_hasil as $dt) : ?>
            <?php
            if ($suara_masuk != 0) {
              $persen = number_format($dt['jmlh'] / $jmlh_peserta * 100, 2);
            } else {
              $persen = 0;
            }
            ?>
            <tr>
              <td style="width:10%"><?= $dt["no_urut"]; ?></td>
              <td style="width:60%"><?= $dt['ketua']; ?> & <?= $dt['wakil']; ?></td>
              <td style="width:15%"><?= $dt['jmlh']; ?></td>
              <td class="text-center" style="width:15%"><?= $persen; ?>%</td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <div class="mt-2">
      <table class="table">
        <tr>
          <td>Jumlah Peserta :</td>
          <td><?= $jmlh_peserta; ?></td>
        </tr>
        <tr>
          <td>Jumlah Peserta Memilih :</td>
          <td><?= $peserta_memilih; ?></td>
        </tr>
        <tr>
          <td>Jumlah Peserta Yg tidak Memilih :</td>
          <td><?= $peserta_tidak_memilih; ?></td>
        </tr>
      </table>
    </div>

    <div class="mt-5">
      <p style="font-size: 13pt;">
        Demikian laporan hasil pemilihan ketua dan wakil ketua OSIS SMA Negeri 1 Kesesi yang dilaksanakan pada tahun <span class="year"></span> ini, semoga dapat digunakan sebagaimana mestinya.
      </p>
    </div>


    <!-- TTD -->
    <div style="margin-top: 100px;">
      <div class="text-center mb-4"><p><b>Mengetahui</b></p></div>
      <!-- left for ketua penitia and right for kepala sekolah -->
      <div class="row">
        <div class="col-6 text-center">
          <p class="p-0 mb-0"><b class="p-0 mb-0">Ketua Panitia</b></p>
          <p class="p-0 mb-0">Pemilihan Ketua Osis SMA Negeri 1 Kesesi</p>
          <br>
          <br>
          <br>
          <p><u>..........................................</u></p>
        </div>
        <div class="col-6 text-center">
          <p class="p-0 mb-0"><b class="p-0 mb-0">Kepala Sekolah</b></p>
          <p class="p-0 mb-0">SMA Negeri 1 Kesesi</p>
          <br>
          <br>
          <br>
          <p class="m-0 p-0"><u>Drs. EKo Suprianto, M.Pd</u></p>
          <p class="m-0 p-0">NIP : <span class="text-white">.................................</span></p>
        </div>
    </div>
    
  </div>

  <script>
    const year = document.querySelector('.year');
    const date = new Date();
    year.innerHTML = date.getFullYear();


    window.print();
  </script>
</body>

</html>