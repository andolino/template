<?php foreach ($data as $row): ?>
<div class="container">
   <img width="82"  src="<?php echo json_decode($row->qr_code)->result->qr; ?>">
</div>
<div align="left" class="text-block" style=" margin-left:140px; line-height:-2px;">
   <br>
  <label style="font-size:11px;">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row->asset_tag; ?></label>
</div> 
<div class="text-block" style=" margin-left:150px; line-height:4px;">
   <br>
  <label style="font-size:7px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DO NOT DETACH</label>  
</div> 
<div class="text-block" style=" margin-left:160px; line-height:2px;">
  <br>
  <label style="font-size:7px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;OR MUTILATE</label>
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