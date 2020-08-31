<style type="text/css">
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
<table cellpadding="0">
<?php foreach ($data as $row): ?>
	<tr>
		<td style="border:0.2px solid #000; font-size: 8px;width: 302.4px;height: 170px;"><img width="302.4px" src="<?php echo json_decode($row->qr_code)->result->qr; ?>"></td>
	</tr>
	<tr>
		<td style="font-size: 8px;text-align:center;height: 10px;"><?php echo $row->asset_tag; ?></td>
	</tr>
	<tr>
		<td style="font-size: 6px;text-align:center;height: 9px;font-weight:600;">DO NOT DETACH OR MUTILATE</td>
	</tr>
	<tr>
		<td></td>
	</tr>
<?php endforeach; ?>
</table>