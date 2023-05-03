<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
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
<body>
  <h2 class="text-center" style="margin-bottom: 10px;">Daftar Kandidat</h2>
  
  <hr style="width:100%; margin-bottom:15px;">
  
  <table border="1" cellspacing="0" cellpadding="0" style="width:100%">
    <thead>
      <tr>
        <th style="width:5%" class="text-center">
          No Urut
        </th>
        <th style="width:15%" class="text-center">
          Nama Ketua
        </th>
        <th style="width:15%" class="text-center">
          Nama Wakil
        </th>
        <th class="text-center" style="width15%">
          Slogan
        </th>
        <th style="width:25%" >
          Visi
        </th>
        <th style="width:25%" >
          Misi
        </th>
      </tr>
    </thead>
    
    <tbody>
      <?php foreach($data_kandidat as $dt) : ?>
        <tr>
          <td class="text-center">
            <?= $dt->no_urut; ?>
          </td>
          <td>
            <?= $dt->ketua; ?>
          </td>
          <td>
            <?= $dt->wakil; ?>
          </td>
          <td>
            <i><?= $dt->slogan; ?></i>
          </td>
          <td>
            <?= $dt->visi; ?>
          </td>
          <td>
            <?= $dt->misi; ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
    
  </table>
  
</body>
</html>