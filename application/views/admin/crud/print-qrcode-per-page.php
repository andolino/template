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