<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Document</title>

  <link rel="stylesheet" href="/css/bootstrap.min.css">

  <style type="text/css" media="all">
    *{
      margin: 0;
      padding: 0;
    }
    body{
      padding: 10px 15px;
    }
    .text-center{
      text-align: center;
    }
    table tr td{
      padding: 3px;
    }
    table tr th{
      padding: 3px;
    }
  </style>
</head>

<body onload="print()">
  <div class="text-center mt-4">
    <h1><b>DAFTAR KANDIDAT</b></h1>
  </div>

  <!-- horizontal line -->
  <hr style="width:100%; margin-top: 10px; margin-bottom: 4px; border-top: 2px solid black;">
  <hr style="width:100%; margin-top: 1px; margin-bottom: 10px; border-top: 3px solid black;">
  
  <table class="table table-compact table-bordered table-striped mt-3">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Nama Ketua</th>
        <th scope="col">Nama Wakil</th>
        <th scope="col">Slogan</th>
        <th scope="col">Visi</th>
        <th scope="col">Misi</th>
      </tr>
    </thead>
    
    <tbody>
      <?php foreach($data_kandidat as $dt) : ?>
        <tr>
          <td><?= $dt->no_urut; ?></td>
          <td><?= $dt->ketua; ?></td>
          <td><?= $dt->wakil; ?></td>
          <td><i><?= $dt->slogan; ?></i></td>
          <td><?= $dt->visi; ?></td>
          <td><?= $dt->misi; ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  
</body>
</html>