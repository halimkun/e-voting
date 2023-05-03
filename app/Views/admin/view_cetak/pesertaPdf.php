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
      padding: 20px 15px;
    }
    .text-center{
      text-align: center;
    }
    table tr td{
      padding: 3px;
      vertical-align: top;
    }
  </style>
</head>
<body>
  <h2 class="text-center" style="margin-bottom:5px">
    Daftar Peserta
  </h2>
  <h4 class="text-center" style="margin-bottom:15px">
    <?= $kelas; ?> <?= $jurusan; ?>
  </h4>
  <hr style="width:100%; margin-bottom:10px">
  <div class="container" style="width:100%; display:block">
   <?php for($i = 1; $i <= count($data_peserta); $i++) : ?>
   <?php $in = $i - 1; ?>
    <div class="ctr" style="width:30%; margin:0 5px 5px 10px; border:1px solid #000; padding: 3px; float:left">
      <table border="0" cellpadding="0" cellspacing="0" style="width:100%">
        <tr>
          <td style="width:40%">
            Username :
          </td>
          <td style="width:60%">
            <?= $data_peserta[$in]->username; ?>
          </td>
        </tr>
        <tr>
          <td style="width:40%">
            Password :
          </td>
          <td style="width:60%">
            <?= $data_peserta[$in]->password; ?>
          </td>
        </tr>
        <tr>
          <td style="width:40%">
            Nama :
          </td>
          <td style="width:60%;">
            <?= $data_peserta[$in]->nama; ?>
          </td>
        </tr>
        <tr>
          <td style="width:40%">
            Kelas :
          </td>
          <td style="width:60%">
            <?= $data_peserta[$in]->kelas; ?>
          </td>
        </tr>
        <tr>
          <td style="width:40%">
            Jurusan :
          </td>
          <td style="width:60%">
            <?= $data_peserta[$in]->jurusan; ?>
          </td>
        </tr>
      </table>
    </div>
    <?php if($i % 3 == 0) : ?>
     <div class="clear" style="clear:left"></div>
    <?php endif; ?>
   <?php endfor; ?>




  </div>
  

  
  
</body>
</html>