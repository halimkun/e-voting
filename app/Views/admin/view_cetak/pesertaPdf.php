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
    }

    body p {
      font-size: 13pt;
    }

    #pass, #username {
      font-family: 'Courier New', Courier, monospace;
    }
  </style>
</head>

<body>
  <!-- Heading -->
  <div class="text-center mt-4">
    <h1><b>DAFTAR PESERTA</b></h1>
  </div>

  <!-- horizontal line -->
  <hr style="width:100%; margin-top: 10px; margin-bottom: 4px; border-top: 2px solid black;">
  <hr style="width:100%; margin-top: 1px; margin-bottom: 10px; border-top: 3px solid black;">

  <div class="row mt-5">
    <?php for ($i = 1; $i <= count($data_peserta); $i++) : ?>
      <?php $in = $i - 1; ?>
      <div class="col-4">
        <div class="card card-body mb-3" style="min-height: 150px; border: 3px solid #333;">
          <table class="table table-sm table-borderless table-striped m-0">
            <tr>
              <th style="width:21%">Username</th>
              <td style="width:3%">:</td>
              <td style="width:76%"><div id="username"><?= $data_peserta[$in]->username; ?></div></td>
            </tr>
            <tr>
              <th style="width:21%">Password</th>
              <td style="width:3%">:</td>
              <td style="width:76%"><div id="pass"><?= $data_peserta[$in]->password; ?></div></td>
            </tr>
            <tr>
              <th style="width:21%">Nama</th>
              <td style="width:3%">:</td>
              <td style="width:76%;"><?= $data_peserta[$in]->nama; ?></td>
            </tr>
            <tr>
              <th style="width:21%">Kelas</th>
              <td style="width:3%">:</td>
              <td style="width:76%"><?= $data_peserta[$in]->kelas; ?></td>
            </tr>
            <tr>
              <th style="width:21%">Jurusan</th>
              <td style="width:3%">:</td>
              <td style="width:76%"><?= $data_peserta[$in]->jurusan; ?></td>
            </tr>
          </table>
        </div>
      </div>
      <?php if ($i % 3 == 0) : ?>
        <div class="clear" style="clear:left"></div>
      <?php endif; ?>
    <?php endfor; ?>
  </div>

</body>

</html>