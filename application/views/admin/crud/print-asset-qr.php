<style type="text/css">

/*
	.
	.font-9{
		font-size: 9px !important;
	}
	.font-7{
		font-size: 7px !important;
	}
	.text-center{
		text-align: center;
	}
	.text-right{
		text-align: right;
	}
	.text-left{
		text-align: left;
	}
	div.u-div{
		font-size: 7px;
		border-bottom: 0.2px solid #000;
		display:inline-block;
	}
	.is_checked{
		background-color: #000;
	}
	
*/	
	
	

	
	
</style>
<!-- <table>
	<tr>
		<td style="width: 12%;"><img src="<?php //echo 'assets/image/misc/logo.png'; ?>" width="57"></td>
		<td style=""><span style="font-size: 14px;">CPFI</span><br>
			<span style="font-size: 6px;">5th Flr., TAM Bldg., PSA Complex, Brgy. Pinyahan, East Ave., Diliman, Quezon City 1101 <br>
			Tel No. (02)8666 2401 <br>
			Email: Provident.Fund@psa.gov.ph</span>
		</td>
	</tr>
</table> -->
<!-- <h4>OFFICIAL RECEIPT</h4> -->
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
  
  

<!--
<div style="background-color:blue; margin-top: 100px;  position:absolute; z-index: 2;">12345656</div>




<table cellpadding="0" style="z-index: 1; position: absolute;">
	<tr>
		<td style="font-size: 8px;width: 90.4px;height: 15px;">&nbsp;&nbsp;&nbsp;&nbsp;<img width="90"  src="<?php echo json_decode($row->qr_code)->result->qr; ?>"></td>
	</tr>
	<tr>
		<td style="line-heigh:-50;"><p style="font-size: 6px;font-weight:600;text-align:center;height: 10px;"><?php echo $row->asset_tag; ?></p></td>
	</tr>
	<tr>
		<td style="font-size: 4px;font-weight:600;text-align:center;height: 9px;font-weight:600;">DO NOT DETACH OR MUTILATE</td>
	</tr>
	<tr>
		<td></td>
	</tr>
</table>

-->
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br>
<?php endforeach; ?>