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
    <h6 class="mt-3 mb-3">Asset Details</h6>
    <?php if(!empty($parentAsset)): ?>
    <div class="row mb-3">
      <div class="border col-4">Mother Asset</div>
      <div class="border col-8"><?php echo $parentAsset->asset_name; ?></div>
    </div>
    <?php endif; ?>
    
    <div class="row">
      <div class="border col-12">
        <?php $imageInFolder = base_url() . 'assets/image/uploads/' . $uploads->image_name; ?>
        <?php if(@file_exists($imageInFolder)): ?>
          <img src="<?php echo $imageInFolder; ?>">
        <?php endif; ?>
      </div>
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
      <?php if(!empty($child)): ?>
        <div class="row mb-1 mt-3">
          <div class="border col-12">No. of Child Asset (<?php echo count($child); ?>)</div>
        </div>
        <div class="row">
          <?php foreach($child as $row): ?>
            <div class="border col-4"><?php echo $row->serial; ?></div>
            <div class="border col-8"><?php echo $row->asset_name; ?></div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
  </div>
</body>
</html>