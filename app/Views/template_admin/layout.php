<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>
    <?= $title; ?>
  </title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?= base_url(); ?>/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url('/fontawesome/css/all.min.css'); ?>" type="text/css" media="all" />

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?= base_url(); ?>/css/stisla.css">
  <link rel="stylesheet" href="<?= base_url(); ?>/css/components.css">
  <link rel="stylesheet" href="<?= base_url(); ?>/css/style.css">
  
  <!-- custom css -->
  <?php if(isset($css)) : ?>
   <?php foreach($css as $c) : ?>
     <link rel="stylesheet" href="<?= base_url(); ?>/<?= $c; ?>.css">
   <?php endforeach; ?>
  <?php endif; ?>
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <!-- navbar -->
      <?= $this->include('template_admin/navbar'); ?>

      <!-- Main Content -->
      <div class="main-content">
         <?= $this->renderSection('content'); ?>
      </div>
      
      <!-- footer -->
      <?= $this->include('template_admin/footer'); ?>
      
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="<?= base_url(); ?>/js/jquery.min.js"></script>
  <script src="<?= base_url(); ?>/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="<?= base_url(); ?>/js/stisla.js"></script>

  <!-- Template JS File -->
  <script src="<?= base_url(); ?>/js/scripts_stisla.js"></script>
  <script src="<?= base_url(); ?>/js/custom.js"></script>

  
  <!-- custom javascript -->
  <?php if(isset($js)) : ?>
   <?php foreach($js as $j) : ?>
    <script src="<?= base_url(); ?>/<?= $j; ?>.js"></script>
   <?php endforeach; ?>
  <?php endif; ?>
  
  <?= $this->renderSection('script_js'); ?>
  
  
</body>
</html>
