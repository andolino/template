<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-4" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>QR List</title>
</head>
<body>
<?php foreach ($data as $row): ?>
<img width="82"  src="<?php echo json_decode($row->qr_code)->result->qr; ?>">
<div class="text-block" style="line-height:1.4;margin-top:0;font-size:8px;margin-left:7px;text-align:center;font-weight:900;border:1px solid #000;width:10%;">
  <strong><?php echo $row->asset_tag; ?></strong> <br> 
  DO NOT DETACH <br>
  OR MUTILATE
</div> 
<div class="text-block" style="line-height:4px;">
   <br>
  <!-- <label style="font-size:7px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>   -->
</div> 
<div class="text-block" style="line-height:2px;">
  <br>
  <!-- <label style="font-size:7px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label> -->
  <br><br><br><br><br><br>
</div>   
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br>
<!-- ======= -->
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br>
<?php endforeach; ?>
<!-- test -->


</body>
</html>