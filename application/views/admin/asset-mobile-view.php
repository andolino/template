<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CBAM-ERS | LOGIN</title>
  <link rel="shortcut icon" href="<?= base_url('assets/image/misc/ico.ico') ?>" type="image/x-icon">
  <link href="<?php echo base_url('assets/css/login.css'); ?>" rel="stylesheet" id="bootstrap-css">
  <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet" id="bootstrap-css">
  <script src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/swal.js'); ?>"></script>
</head>
<style type="text/css">
  table tbody tr td:nth-child(1){
    width: 15%;
  }
</style>
<body>
  <div class="p-1">
    <div class="row">
      <div class="border col-12"><img src="<?php echo base_url() . 'assets/image/uploads/' . $uploads->image_name; ?>"></div>
      <div class="border col-4">Asset Tag</div>
      <div class="border col-8"><?php echo $data[0]->asset_tag; ?></div>
      <div class="border col-4">Asset Name</div>
      <div class="border col-8"><?php echo $data[0]->asset_name; ?></div>      
      <div class="border col-4">Serial #</div>
      <div class="border col-8"><?php echo $data[0]->serial; ?></div>
      <div class="border col-4">Custodian</div>
      <div class="border col-8"><?php echo $data[0]->screen_name; ?></div>
      <div class="border col-4">Target</div>
      <div class="border col-8"><?php echo $data[0]->default_location; ?></div>      
      
      
      
      
      
    </div>
  </div>
</body>
</html>