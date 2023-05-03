<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <style>
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
    table tr th{
      text-align: center;
    }
    table tr td{
      padding: 3px;
    }
  </style>
</head>
<body>
  
  <h1 class="text-center" style="margin-bottom:15px">
    Laporan Hasil Pemilihan Ketua OSIS
  </h1>
  
  <hr style="width:100%; margin-bottom:15px">
  
  <table border="1" cellpadding="0" cellspacing="0" style="width:100%; margin-bottom:15px">
    <thead>
      <tr>
        <th>
          No
        </th>
        <th>
          Nama Pasangan
        </th>
        <th>
          Jumlah Suara
        </th>
        <th>
          Presentase
        </th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($data_hasil as $dt) : ?>
      <?php
        if($suara_masuk != 0){
          $persen = number_format($dt['jmlh'] / $suara_masuk * 100, 2);
        }else{
          $persen = 0;
        }
      ?>
       <tr>
         <td style="width:10%">
           <?= $dt["no_urut"]; ?>
         </td>
         <td style="width:60%">
           <?= $dt['ketua']; ?> & <?= $dt['wakil']; ?>
         </td>
         <td style="width:15%">
           <?= $dt['jmlh']; ?>
         </td>
         <td class="text-center" style="width:15%">
           <?= $persen; ?>%
         </td>
       </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <table border="0" style="">
    <tr>
      <td>
        Jumlah Peserta :
      </td>
      <td>
        <?= $jmlh_peserta; ?>
      </td>
    </tr>
    <tr>
      <td>
        Jumlah Peserta Memilih :
      </td>
      <td>
        <?= $peserta_memilih; ?>
      </td>
    </tr>
    <tr>
      <td>
        Jumlah Peserta Yg tidak Memilih :
      </td>
      <td>
        <?= $peserta_tidak_memilih; ?>
      </td>
    </tr>
  </table>
</body>
</html>