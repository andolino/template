<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers td {
  border: 0.5px solid #000;
  padding: 8px;
}

/* #customers tr:nth-child(even){background-color: #f2f2f2;} */

/* #customers tr:hover {background-color: #ddd;} */

#customers td {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  /* background-color: #4CAF50; */
  /* color: white; */
}
</style>



<?php $location_val = array(); ?>
<?php 

$loc = array();
$pso = array();


?>

      <?php foreach($dataChkList as $row): ?>

        

        <?php   

          $cnt = count($dataChkList);

          $loc[] = $row->address;
          $pso[] = $row->province;
          
          

     endforeach;

        ?>




<img style="margin-top: -25px;" src="<?php echo base_url('assets/image/misc/img-logo-gatepass.png'); ?>">

<br>

<div style="font-size: 14px;" align="center"><strong>GATE PASS</strong></div>
<br>
<br>
<div style="font-size: 12px;" align="right"><strong><?php echo date("d F Y"); ?></strong></div>
    <table>
    <tr>
      <td style="font-size: 12px;">TO THE GUARD:</td>
    </tr>
    <tr><td>&nbsp;</td></tr>
    <tr>
      <td style="line-height: 25px; font-size: 12px;">Please allow <strong><?php echo $data_procces[0]; ?></strong>,with vehicle plate No. <strong><?php echo $data_procces[1]; ?></strong> to take out the property listed below from the PRO Warehouse, 901 Great East Industrial Corporation, EDSA</td>
    </tr>

    </table>

    <br>
    <table border=1 width="100%" style="font-size: 12px;">
      <tr>
       <th align="center">DESCRIPTION</th>
       <th align="center">DESTINATION</th>
       <th align="center">Signature of the Recipient</th>

      </tr>

    <tr style="line-height: 50px;">


      <td width="60%" style="line-height: 40px;">&nbsp;<?php echo count($dataChkList); ?> SET OF LUGGAGE KIT (120 x 80 x 150 cm;26 kg)<br>
      &nbsp;<?php echo count($dataChkList); ?> SET OF PHOTO BOOTH (38x21x30cm;6.9 kg)</td>
      <td align="center" width="20%"><?php echo "<strong>".$pso[0] . "</strong><br>".  $loc[0]; ?></td>
      <td width="15%">&nbsp;</td>



     </tr>
    </table>
      <br>
      
      <table>
      <tr>
        <td style="padding:0px;width:14%;font-size: 10px !important;font-family: 'Arial';line-height:1.9; font-size: 12px;">Approved: </td>
      </tr>
      <tr>
        
      </tr>
      </table>
            <table style="width:100%;font-size:11px;">
        <tr><td>&nbsp;</td></tr>
        <tr>
          <td style="width:30%;text-align:center;"><div align="center" style="text-align: center; padding-left:15px; padding-top: 35px; vertical-align: middle; font-size:11px; z-index: -1; position: absolute;"><strong>ROBERT JOSEPH T. CORONADO</strong></div><img style="padding-top:-30px; padding-left:10px; position:absolute; z-index: -1;" src="<?php echo base_url('assets/image/misc/robert-sign.png'); ?>" width="70"/></td>
          <td style="width:40%;"></td>
          <td align="right" style="width:30%;text-align:center;">&nbsp;</td>
          <td></td>
        </tr>
        <tr>
          <td style="border-top:0.2px solid #000;text-align:center;">DIVISION CHIEF<br> ISMD  - PhilSys Registry Office</td>
          <td></td>
          <td align="center" style="border-top:0.2px solid #000;text-align:center;">Guard on Duty</td>
        </tr>
      </table>
    <br>
    </hr>
    -------------------------------------------------------------------------------------------------------------------------------------------

<div style="font-size: 14px;" align="center"><strong>GATE PASS</strong></div>
<br>

<div style="font-size: 12px;" align="right"><strong><?php echo date("d F Y"); ?></strong></div>
    <table>
    <tr>
      <td style="font-size: 12px;">TO THE GUARD:</td>
    </tr>
    <tr><td>&nbsp;</td></tr>
    <tr>
    
      <td style="line-height: 25px; font-size: 12px;">Please allow <strong><?php echo $data_procces[0]; ?></strong>,with vehicle plate No. <strong><?php echo $data_procces[1]; ?></strong> to take out the property listed below from the PRO Warehouse, 901 Great East Industrial Corporation, EDSA</td>
    
    </tr>

    </table>

    <br>
    <table border=1 width="100%" style="font-size: 12px;">
      <tr>
       <th align="center">DESCRIPTION</th>
       <th align="center">DESTINATION</th>
       <th align="center">Signature of the Recipient</th>

      </tr>

    <tr style="line-height: 50px;">

 <td width="60%" style="line-height: 40px;">&nbsp;<?php echo count($dataChkList); ?> SET OF LUGGAGE KIT (120 x 80 x 150 cm;26 kg)<br>
      &nbsp;<?php echo count($dataChkList); ?> SET OF PHOTO BOOTH (38x21x30cm;6.9 kg)</td>
     <td align="center" width="20%"><?php echo "<strong>".$pso[0] . "</strong><br>".  $loc[0]; ?></td>
      <td width="15%">&nbsp;</td>


     </tr>
    </table>
<br>
      <table>
      <tr>
        <td style="padding:0px;width:14%;font-size: 10px !important;font-family: 'Arial';line-height:1.9; font-size: 12px;">Approved: </td>
      </tr>
      <tr>
        
      </tr>
      </table>
            <table style="width:100%;font-size:11px;">
        <tr><td>&nbsp;</td></tr>
        <tr>
         <td style="width:30%;text-align:center;"><div align="center" style="text-align: center; padding-left:15px; padding-top: 35px; vertical-align: middle; font-size:11px; z-index: -1; position: absolute;"><strong>ROBERT JOSEPH T. CORONADO</strong></div><img style="padding-top:-30px; padding-left:10px; position:absolute; z-index: -1;" src="<?php echo base_url('assets/image/misc/robert-sign.png'); ?>" width="70"/></td>
          <td style="width:40%;"></td>
          <td align="right" style="width:30%;text-align:center;">&nbsp;</td>
          <td></td>
        </tr>
        <tr>
          <td style="border-top:0.2px solid #000;text-align:center;">DIVISION CHIEF<br> ISMD  - PhilSys Registry Office</td>
          <td></td>
          <td align="center" style="border-top:0.2px solid #000;text-align:center;">Guard on Duty</td>
        </tr>
      </table>
     
