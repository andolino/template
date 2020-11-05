

<style>



#customers {
  /* font-family: Century Gothic !important; */
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

input[type="checkbox"]{
  transform: scale(1.5);
}
</style>
<?php 
ini_set("pcre.backtrack_limit", "5000000");
$ctrl = 1;


 ?>
<?php foreach($dataChkList as $row): ?>
    <table style="width:100%;border:0.2px solid #000;">
      <tr>
        <td style="width:15%;border-right:0.5px solid #000;"><center><img src="<?php echo base_url('assets/image/misc/logo3.png'); ?>" width="70"/></center></td>
        <td>
          <table style="width:100%;">
            <tr>
              <td style="text-align:center;font-size:11px;">Philippine Statistics Authority</td>
            </tr>
            <tr>
              <td style="text-align:center;font-size:11px;"><strong>Quality Management System</strong></td>
            </tr>
            <tr>
              <td style="text-align:center;font-size:11px;">REGISTRATION KIT CHECKLIST FORM</td>
            </tr>
          </table>
        </td>
        <td style="border-left: 0.2px solid #000;">
          <table style="width:100%;">
            <tr>
              <td style="font-size:11px;text-align:left;border-bottom:0.2px solid #000;">Doc Ref No.</td>
            </tr>
            <tr>
              <td style="font-size:11px;text-align:left;border-bottom:0.2px solid #000;">Effective Date</td>
            </tr>
            <tr>
              <td style="font-size:11px;text-align:left;border-bottom:0.2px solid #000;">Revision No.</td>
            </tr>
            <tr>
              <td style="font-size:11px;text-align:left;">Page No.</td>
            </tr>
          </table>
        </td>
        <td style="width:25%;border-left: 0.2px solid #000;">
          <table style="width:100%;">
            <tr>
              <td style="font-size:11px;text-align:center;border-bottom:0.2px solid #000;">20RSMS02-10-186</td>
            </tr>
            <tr>
              <td style="font-size:11px;text-align:center;border-bottom:0.2px solid #000;"><?php echo "26 October 2020"; ?></td>
            </tr>
            <tr>
              <td style="font-size:11px;text-align:center;border-bottom:0.2px solid #000;">0</td>
            </tr>
            <tr>
              <td style="font-size:11px;text-align:center;">Page <?php echo '1 of 2';//$ctrl . ' of ' . count($dataChkList);//$page_no; ?></td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
    
    <p style="text-align:center;font-size:10px;"> <strong style="font-style: normal;">INFRASTRUCTURE AND SYSTEMS MANAGEMENT DIVISION (ISMD)</strong> <br>
    <span style="font-weight:500;">Registration and Systems Management Service – PHILSYS REGISTRY OFFICE</span> </p>
      <p style="text-align:center;font-size:11px;">
        REGISTRATION KIT CHEKLIST FORM
      </p>
      <ul style="list-style-type: none;padding:0;font-size:11px;">
        <li style="padding:0;margin:0">Provincial Statistics Office: <span> <strong><?php echo strtoupper($row->province); ?></strong></span></li>
        <li style="padding:0;margin:0">Registration Kit Count: <span><strong><?php echo $ctrl . ' of ' . count($dataChkList); ?></strong></span></li>
        <li style="padding:0;margin:0">Asset Tag: 
        <span>
          <?php if($row->luggage_asset_tag_manual=='' || $row->luggage_asset_tag < 1): ?>
          <strong><?php echo $row->luggage_asset_tag; ?></strong>
           <?php else: ?>
             <strong><?php echo $row->luggage_asset_tag_manual; ?></strong>
          <?php endif; ?>
        </span></li>
      </ul>
      <br>
      <table style="width:100%;font-size:10px;" id="customers">
        <tr>
          <td style="width:30%;padding:3px;font-size:11px;background-color:#eef;border: 1px solid #000;"><strong>Registration Kit Luggage No.</strong></td>
          <td style="padding:3px;font-size:11px;background-color:#eef;border: 1px solid #000;" colspan="3">&nbsp;&nbsp; <span>
          <?php if(str_replace(' ', '', $row->luggage_kit_manual)==''): ?>
            <strong><?php echo $row->luggage_kit; ?></strong>
            <?php else: ?>
           <strong><?php echo $row->luggage_kit_manual; ?></strong>
          <?php endif; ?>
          </span></td>
        </tr>
        <tr>
          <td style="padding:3px;font-size:10px;text-align: center;"><strong>DEVICES</strong></td>
          <td style="padding:3px;font-size:10px;text-align: center;"><strong>QUANTITY</strong></td>
          <td style="padding:3px;font-size:10px;text-align: center;">FOR ISMD USE ONLY</td>
          <td style="padding:3px;font-size:10px;text-align: center;">FOR PSO USE ONLY</td>
        </tr>
        <tr>
          <td style="padding:3px;font-size:10px;">HEWLETT PACKARD LAPTOP</td>
          <td style="padding:3px;font-size:10px;text-align: center;">1</td>
          <td style="padding:0;font-size:10px;">
            <?php if($row->chk_laptop == 1 ): ?>
              <center><p style='font-family:helvetica;font-weight:900;font-size:20px;'>&#x2611;</p></center>
            <?php else: ?>
              <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center>   
            <?php endif; ?>
          </td>
          <td style="padding:3px;font-size:10px;">
            <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center>  
          </td>
        </tr>
        <tr>
          <td style="padding:3px;font-size:10px;">GREENBIT FINGERPRINT SCANNER</td>
          <td style="padding:3px;font-size:10px;text-align: center;">1</td>
          <td style="padding:0;font-size:10px;">
            <?php if($row->chk_fingerprint == 1 ): ?>
              <center><p style='font-family:helvetica;font-weight:900;font-size:20px;'>&#x2611;</p></center>
            <?php else: ?>
              <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center> 
            <?php endif; ?>
          </td>
          <td style="padding:0px;font-size:10px;">
            <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center>  
          </td>
        </tr>
        <tr>
          <td style="padding:3px;font-size:10px;">IRITECH IRIS SCANNER</td>
          <td style="padding:3px;font-size:10px;text-align: center;">1</td>
          <td style="padding:0;font-size:10px;">
            <?php if($row->chk_document_scanner == 1 ): ?>
              <center><p style='font-family:helvetica;font-weight:900;font-size:20px;'>&#x2611;</p></center>
            <?php else: ?>
              <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center> 
            <?php endif; ?>
          </td>
          <td style="padding:3px;font-size:10px;">
            <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center>  
          </td>
        </tr>
        <tr>
          <td style="padding:3px;font-size:10px;">LOGITECH WEB CAM</td>
          <td style="padding:3px;font-size:10px;text-align: center;">1</td>
          <td style="padding:0;font-size:10px;">
            <?php if($row->chk_webcamera == 1 ): ?>
              <center><p style='font-family:helvetica;font-weight:900;font-size:20px;'>&#x2611;</p></center>
            <?php else: ?>
              <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center> 
            <?php endif; ?>
          </td>
          <td style="padding:3px;font-size:10px;">
            <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center>  
          </td>
        </tr>
        <tr>
          <td style="padding:3px;font-size:10px;text-align:right;"><strong>TOTAL</strong></td>
          <td style="padding:3px;font-size:10px;text-align: center;">4</td>
          <td style="padding:0;font-size:10px;">
          </td>
          <td style="padding:3px;font-size:10px;">
          </td>
        </tr>
      </table>
      <br>
      <table style="width:100%;font-size:10px;" id="customers">
        <tr>
          <td style="padding:3px;width:30%;font-size:10px;text-align: center;"><strong>OTHER PERIPHERALS</strong></td>
          <td style="padding:3px;font-size:10px;text-align: center;"><strong>QUANTITY</strong></td>
          <td style="padding:3px;font-size:10px;text-align: center;">FOR ISMD USE ONLY</td>
          <td style="padding:3px;font-size:10px;text-align: center;">FOR PSO USE ONLY</td>
        </tr>
        <tr>
          <td style="padding:3px;font-size:10px;">ELOAM HD DOCUMENT SCANNER</td>
          <td style="padding:3px;font-size:10px;text-align: center;">1</td>
          <td style="padding:0;font-size:10px;">
            <?php if($row->chk_webcamera == 1 ): ?>
              <center><p style='font-family:helvetica;font-weight:900;font-size:20px;'>&#x2611;</p></center>
            <?php else: ?>
              <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center> 
            <?php endif; ?>
          </td>
          <td style="padding:3px;font-size:10px;">
            <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center>  
          </td>
        </tr>
        <tr>
          <td style="padding:3px;font-size:10px;">EYOYO PORTABLE MONITOR</td>
          <td style="padding:3px;font-size:10px;text-align: center;">1</td>
          <td style="padding:0;font-size:10px;">
            <?php if($row->chk_portable_monitor == 1 ): ?>
              <center><p style='font-family:helvetica;font-weight:900;font-size:20px;'>&#x2611;</p></center>
            <?php else: ?>
              <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center> 
            <?php endif; ?>
          </td>
          <td style="padding:3px;font-size:10px;">
            <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center>  
          </td>
        </tr>
        <tr>
          <td style="padding:3px;font-size:10px;">EPSON MONOCHROME PRINTER</td>
          <td style="padding:3px;font-size:10px;text-align: center;">1</td>
          <td style="padding:0;font-size:10px;">
            <?php if($row->chk_monochrome_printer == 1 ): ?>
              <center><p style='font-family:helvetica;font-weight:900;font-size:20px;'>&#x2611;</p></center>
            <?php else: ?>
              <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center> 
            <?php endif; ?>
          </td>
          <td style="padding:3px;font-size:10px;">
            <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center>  
          </td>
        </tr>
        <tr>
          <td style="padding:3px;font-size:10px;">SUNGZU BATTERY PACK</td>
          <td style="padding:3px;font-size:10px;text-align: center;">1</td>
          <td style="padding:0;font-size:10px;">
            <?php if($row->chk_batterypack == 1 ): ?>
              <center><p style='font-family:helvetica;font-weight:900;font-size:20px;'>&#x2611;</p></center>
            <?php else: ?>
              <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center> 
            <?php endif; ?>
          </td>
          <td style="padding:3px;font-size:10px;">
            <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center>  
          </td>
        </tr>
        <tr>
          <td style="padding:3px;font-size:10px;">MOUSE</td>
          <td style="padding:3px;font-size:10px;text-align: center;">1</td>
          <td style="padding:0;font-size:10px;">
            <?php if($row->chk_mouse == 1 ): ?>
              <center><p style='font-family:helvetica;font-weight:900;font-size:20px;'>&#x2611;</p></center>
            <?php else: ?>
              <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center> 
            <?php endif; ?>
          </td>
          <td style="padding:3px;font-size:10px;">
            <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center>  
          </td>
        </tr>
        <tr>
          <td style="padding:3px;font-size:10px;">UGREEN 4-PORT USB POWER HUB</td>
          <td style="padding:3px;font-size:10px;text-align: center;">1</td>
          <td style="padding:0;font-size:10px;">
            <?php if($row->chk_usbpowerhub == 1 ): ?>
              <center><p style='font-family:helvetica;font-weight:900;font-size:20px;'>&#x2611;</p></center>
            <?php else: ?>
              <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center> 
            <?php endif; ?>
          </td>
          <td style="padding:3px;font-size:10px;">
            <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center>  
          </td>
        </tr>
        <tr>
          <td style="padding:3px;font-size:10px;">LUGGAGE WITH FOAM</td>
          <td style="padding:3px;font-size:10px;text-align: center;">1</td>
          <td style="padding:0;font-size:10px;">
            <?php if($row->chk_luggage_foam == 1 ): ?>
              <center><p style='font-family:helvetica;font-weight:900;font-size:20px;'>&#x2611;</p></center>
            <?php else: ?>
              <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center> 
            <?php endif; ?>
          </td>
          <td style="padding:3px;font-size:10px;">
            <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center>  
          </td>
        </tr>
        <tr>
          <td style="padding:3px;font-size:10px;">THIN FOAM</td>
          <td style="padding:3px;font-size:10px;text-align: center;">1</td>
          <td style="padding:0;font-size:10px;">
            <?php if($row->chk_thin_foam == 1 ): ?>
              <center><p style='font-family:helvetica;font-weight:900;font-size:20px;'>&#x2611;</p></center>
            <?php else: ?>
              <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center> 
            <?php endif; ?>
          </td>
          <td style="padding:3px;font-size:10px;">
            <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center>  
          </td>
        </tr>
        <tr>
          <td style="padding:3px;font-size:10px;">WRIST PROTECT FOAM</td>
          <td style="padding:3px;font-size:10px;text-align: center;">1</td>
          <td style="padding:0;font-size:10px;">
            <?php if($row->chk_wrist_foam == 1 ): ?>
              <center><p style='font-family:helvetica;font-weight:900;font-size:20px;'>&#x2611;</p></center>
            <?php else: ?>
              <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center> 
            <?php endif; ?>
          </td>
          <td style="padding:3px;font-size:10px;">
            <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center>  
          </td>
        </tr>
        <tr>
          <td style="padding:3px;font-size:10px;">SCANNER PAD</td>
          <td style="padding:3px;font-size:10px;text-align: center;">1</td>
          <td style="padding:0;font-size:10px;">
            <?php if($row->chk_scannerpad == 1 ): ?>
              <center><p style='font-family:helvetica;font-weight:900;font-size:20px;'>&#x2611;</p></center>
            <?php else: ?>
              <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center> 
            <?php endif; ?>
          </td>
          <td style="padding:3px;font-size:10px;">
            <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center>  
          </td>
        </tr>
        <tr>
          <td style="padding:3px;font-size:10px;">PADLOCK</td>
          <td style="padding:3px;font-size:10px;text-align: center;">1</td>
          <td style="padding:0;font-size:10px;">
            <?php if($row->chk_padlock == 1 ): ?>
              <center><p style='font-family:helvetica;font-weight:900;font-size:20px;'>&#x2611;</p></center>
            <?php else: ?>
              <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center> 
            <?php endif; ?>
          </td>
          <td style="padding:3px;font-size:10px;">
            <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center>  
          </td>
        </tr>
        <tr>
          <td style="padding:3px;font-size:10px;">PHOTO BOOTH CARRYING BAG</td>
          <td style="padding:3px;font-size:10px;text-align: center;">1</td>
          <td style="padding:0;font-size:10px;">
            <?php if($row->chk_photobooth_bag == 1 ): ?>
              <center><p style='font-family:helvetica;font-weight:900;font-size:20px;'>&#x2611;</p></center>
            <?php else: ?>
              <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center> 
            <?php endif; ?>
          </td>
          <td style="padding:3px;font-size:10px;">
            <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center>  
          </td>
        </tr>
        <tr>
          <td style="padding:3px;font-size:10px;">CAR CHARGER</td>
          <td style="padding:3px;font-size:10px;text-align: center;">1</td>
          <td style="padding:0;font-size:10px;">
            <?php if($row->chk_car_charger == 1 ): ?>
              <center><p style='font-family:helvetica;font-weight:900;font-size:20px;'>&#x2611;</p></center>
            <?php else: ?>
              <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center> 
            <?php endif; ?>
          </td>
          <td style="padding:3px;font-size:10px;">
            <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center>  
          </td>
        </tr>
        <tr>
          <td style="padding:3px;font-size:10px;">HDMI CABLE</td>
          <td style="padding:3px;font-size:10px;text-align: center;">1</td>
          <td style="padding:0;font-size:10px;">
            <?php if($row->chk_hdmi_cable == 1 ): ?>
              <center><p style='font-family:helvetica;font-weight:900;font-size:20px;'>&#x2611;</p></center>
            <?php else: ?>
              <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center> 
            <?php endif; ?>
          </td>
          <td style="padding:3px;font-size:10px;">
            <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center>  
          </td>
        </tr>
        <tr>
          <td style="padding:3px;font-size:10px;">POWER ADAPTER</td>
          <td style="padding:3px;font-size:10px;text-align: center;">1</td>
          <td style="padding:0;font-size:10px;">
            <?php if($row->chk_power_adapter == 1 ): ?>
              <center><p style='font-family:helvetica;font-weight:900;font-size:20px;'>&#x2611;</p></center>
            <?php else: ?>
              <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center> 
            <?php endif; ?>
          </td>
          <td style="padding:3px;font-size:10px;">
            <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center>  
          </td>
        </tr>
        <tr>
          <td style="padding:3px;font-size:10px;">POWER CABLE</td>
          <td style="padding:3px;font-size:10px;text-align: center;">1</td>
          <td style="padding:0;font-size:10px;">
            <?php if($row->chk_power_cable == 1 ): ?>
              <center><p style='font-family:helvetica;font-weight:900;font-size:20px;'>&#x2611;</p></center>
            <?php else: ?>
              <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center> 
            <?php endif; ?>
          </td>
          <td style="padding:3px;font-size:10px;">
            <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center>  
          </td>
        </tr>
        <tr>
          <td style="padding:3px;font-size:10px;">USB CABLE</td>
          <td style="padding:3px;font-size:10px;text-align: center;">1</td>
          <td style="padding:0;font-size:10px;">
            <?php if($row->chk_usb_cable == 1 ): ?>
              <center><p style='font-family:helvetica;font-weight:900;font-size:20px;'>&#x2611;</p></center>
            <?php else: ?>
              <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center> 
            <?php endif; ?>
          </td>
          <td style="padding:3px;font-size:10px;">
            <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center>  
          </td>
        </tr>
        <tr>
          <td style="padding:3px;font-size:10px;">USB CONVERTER</td>
          <td style="padding:3px;font-size:10px;text-align: center;">1</td>
          <td style="padding:0;font-size:10px;">
            <?php if($row->chk_usb_converter == 1 ): ?>
              <center><p style='font-family:helvetica;font-weight:900;font-size:20px;'>&#x2611;</p></center>
            <?php else: ?>
              <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center> 
            <?php endif; ?>
          </td>
          <td style="padding:3px;font-size:10px;">
            <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center>  
          </td>
        </tr>
        <tr>
          <td style="padding:3px;font-size:10px;">LCD STAND</td>
          <td style="padding:3px;font-size:10px;text-align: center;">1</td>
          <td style="padding:0;font-size:10px;">
            <?php if($row->chk_lcd_stand == 1 ): ?>
              <center><p style='font-family:helvetica;font-weight:900;font-size:20px;'>&#x2611;</p></center>
            <?php else: ?>
              <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center> 
            <?php endif; ?>
          </td>
          <td style="padding:3px;font-size:10px;">
            <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center>  
          </td>
        </tr>
        <tr>
          <td style="padding:3px;font-size:10px;">LCD BASE</td>
          <td style="padding:3px;font-size:10px;text-align: center;">1</td>
          <td style="padding:0;font-size:10px;">
            <?php if($row->chk_lcd_base == 1 ): ?>
              <center><p style='font-family:helvetica;font-weight:900;font-size:20px;'>&#x2611;</p></center>
            <?php else: ?>
              <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center> 
            <?php endif; ?>
          </td>
          <td style="padding:3px;font-size:10px;">
            <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center>  
          </td>
        </tr>
        <tr>
          <td style="padding:3px;font-size:10px;">CABLE LOCK</td>
          <td style="padding:3px;font-size:10px;text-align: center;">1</td>
          <td style="padding:0;font-size:10px;">
            <?php if($row->chk_cablelock == 1 ): ?>
              <center><p style='font-family:helvetica;font-weight:900;font-size:20px;'>&#x2611;</p></center>
            <?php else: ?>
              <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center> 
            <?php endif; ?>
          </td>
          <td style="padding:3px;font-size:10px;">
            <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center>  
          </td>
        </tr>
        <tr>
          <td style="padding:3px;font-size:10px;">CABLE LOCK KEY</td>
          <td style="padding:3px;font-size:10px;text-align: center;">1</td>
          <td style="padding:0;font-size:10px;">
            <?php if($row->chk_cablelock_key == 1 ): ?>
              <center><p style='font-family:helvetica;font-weight:900;font-size:20px;'>&#x2611;</p></center>
            <?php else: ?>
              <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center> 
            <?php endif; ?>
          </td>
          <td style="padding:3px;font-size:10px;">
            <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center>  
          </td>
        </tr>
        <tr>
          <td style="padding:3px;font-size:10px;">LENS COVER</td>
          <td style="padding:3px;font-size:10px;text-align: center;">1</td>
          <td style="padding:0;font-size:10px;">
            <?php if($row->chk_lenscover == 1 ): ?>
              <center><p style='font-family:helvetica;font-weight:900;font-size:20px;'>&#x2611;</p></center>
            <?php else: ?>
              <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center> 
            <?php endif; ?>
          </td>
          <td style="padding:3px;font-size:10px;">
            <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center>  
          </td>
        </tr>
        <tr>
          <td style="padding:3px;font-size:10px;text-align:right;"><strong>TOTAL</strong></td>
          <td style="padding:3px;font-size:10px;text-align: center;">31</td>
          <td style="padding:0;font-size:10px;">
          </td>
          <td style="padding:3px;font-size:10px;">
          </td>
        </tr>
      </table>
      <br>
        <table style="width:100%;border:0.2px solid #000;">
          <tr>
            <td style="width:15%;border-right:0.5px solid #000;"><center><img src="<?php echo base_url('assets/image/misc/logo3.png'); ?>" width="70"/></center></td>
            <td>
              <table style="width:100%;">
                <tr>
                  <td style="text-align:center;font-size:11px;">Philippine Statistics Authority</td>
                </tr>
                <tr>
                  <td style="text-align:center;font-size:11px;"><strong>Quality Management System</strong></td>
                </tr>
                <tr>
                  <td style="text-align:center;font-size:11px;">REGISTRATION KIT CHECKLIST FORM</td>
                </tr>
              </table>
            </td>
            <td style="border-left: 0.2px solid #000;">
              <table style="width:100%;">
                <tr>
                  <td style="font-size:11px;text-align:left;border-bottom:0.2px solid #000;">Doc Ref No.</td>
                </tr>
                <tr>
                  <td style="font-size:11px;text-align:left;border-bottom:0.2px solid #000;">Effective Date</td>
                </tr>
                <tr>
                  <td style="font-size:11px;text-align:left;border-bottom:0.2px solid #000;">Revision No.</td>
                </tr>
                <tr>
                  <td style="font-size:11px;text-align:left;">Page No.</td>
                </tr>
              </table>
            </td>
            <td style="width:25%;border-left: 0.2px solid #000;">
              <table style="width:100%;">
                <tr>
                  <td style="font-size:11px;text-align:center;border-bottom:0.2px solid #000;">20RSMS02-10-186</td>
                </tr>
                <tr>
                  <td style="font-size:11px;text-align:center;border-bottom:0.2px solid #000;"><?php echo "26 October 2020"; ?></td>
                </tr>
                <tr>
                  <td style="font-size:11px;text-align:center;border-bottom:0.2px solid #000;">0</td>
                </tr>
                <tr>
                  <td style="font-size:10px;text-align:center;">Page <?php echo '2' . ' of ' . '2';//count($dataChkList);//$page_no; ?></td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
        <p style="text-align:center;font-size:10px;"> <strong style="font-style: normal;">INFRASTRUCTURE AND SYSTEMS MANAGEMENT DIVISION (ISMD)</strong> <br>
        <span style="font-weight:500;">Registration and Systems Management Service – PHILSYS REGISTRY OFFICE</span> </p>
        <br>
      <table style="width:100%;font-size:10px;" id="customers">
        <tr>
          <td style="width:30%;padding:3px;font-size:11px;background-color:#eef;border: 1px solid #000;"><strong>Photobooth Kit Asset Tag No.</strong></td>
          <td style="padding:3px;font-size:11px;background-color:#eef;border: 1px solid #000;" colspan="3">&nbsp;&nbsp; <span>
            <?php if(str_replace(' ', '', $row->photobooth_kit_manual)==''): ?>
              <strong><?php echo $row->photobooth_kit; ?></strong>
            <?php else: ?>
              <strong><?php echo $row->photobooth_kit_manual; ?></strong>
            <?php endif; ?>
          </span></td>
        </tr>
        <tr>
          <td style="padding:3px;font-size:10px;text-align: center;"><strong>EQUIPMENT</strong></td>
          <td style="padding:3px;font-size:10px;text-align: center;"><strong>QUANTITY</strong></td>
          <td style="padding:3px;font-size:10px;text-align: center;">FOR ISMD USE ONLY</td>
          <td style="padding:3px;font-size:10px;text-align: center;">FOR PSO USE ONLY</td>
        </tr>
        <tr>
          <td style="padding:3px;font-size:10px;">30W LED LAMP LIGHTS</td>
          <td style="padding:3px;font-size:10px;text-align: center;">2</td>
          <td style="padding:0;font-size:10px;">
            <?php if($row->chk_lamplights == 1 ): ?>
              <center><p style='font-family:helvetica;font-weight:900;font-size:20px;'>&#x2611;</p></center>
            <?php else: ?>
              <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center> 
            <?php endif; ?>
          </td>
          <td style="padding:3px;font-size:10px;">
            <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center>  
          </td>
        </tr>
        <tr>
          <td style="padding:3px;font-size:10px;">ADJUSTABLE TRIPODS</td>
          <td style="padding:3px;font-size:10px;text-align: center;">2</td>
          <td style="padding:0;font-size:10px;">
            <?php if($row->chk_tripods == 1 ): ?>
              <center><p style='font-family:helvetica;font-weight:900;font-size:20px;'>&#x2611;</p></center>
            <?php else: ?>
              <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center> 
            <?php endif; ?>
          </td>
          <td style="padding:3px;font-size:10px;">
            <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center>  
          </td>
        </tr>
        <tr>
          <td style="padding:3px;font-size:10px;">AC/DC ADAPTERS WITH DIMMER SWITCH</td>
          <td style="padding:3px;font-size:10px;text-align: center;">2</td>
          <td style="padding:0;font-size:10px;">
            <?php if($row->chk_dimmer_switch == 1 ): ?>
              <center><p style='font-family:helvetica;font-weight:900;font-size:20px;'>&#x2611;</p></center>
            <?php else: ?>
              <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center> 
            <?php endif; ?>
          </td>
          <td style="padding:3px;font-size:10px;">
            <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center>  
          </td>
        </tr>
        <tr>
          <td style="padding:3px;font-size:10px;">4-SOCKET POWER EXTENSION WITH POWER SURGE PROTECTOR</td>
          <td style="padding:3px;font-size:10px;text-align: center;">1</td>
          <td style="padding:0;font-size:10px;">
            <?php if($row->chk_socket_power == 1 ): ?>
              <center><p style='font-family:helvetica;font-weight:900;font-size:20px;'>&#x2611;</p></center>
            <?php else: ?>
              <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center> 
            <?php endif; ?>
          </td>
          <td style="padding:3px;font-size:10px;">
            <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center>  
          </td>
        </tr>
        <tr>
          <td style="padding:3px;font-size:10px;">WHITE BACKDROP CLOTH</td>
          <td style="padding:3px;font-size:10px;text-align: center;">1</td>
          <td style="padding:0;font-size:10px;">
            <?php if($row->chk_backdrop_cloth == 1 ): ?>
              <center><p style='font-family:helvetica;font-weight:900;font-size:20px;'>&#x2611;</p></center>
            <?php else: ?>
              <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center> 
            <?php endif; ?>
          </td>
          <td style="padding:3px;font-size:10px;">
            <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center>  
          </td>
        </tr>
        <tr>
          <td style="padding:3px;font-size:10px;">CLOTH’S RODS</td>
          <td style="padding:3px;font-size:10px;text-align: center;">2</td>
          <td style="padding:0;font-size:10px;">
            <?php if($row->chk_cloth_rod == 1 ): ?>
              <center><p style='font-family:helvetica;font-weight:900;font-size:20px;'>&#x2611;</p></center>
            <?php else: ?>
              <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center> 
            <?php endif; ?>
          </td>
          <td style="padding:3px;font-size:10px;">
            <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center>  
          </td>
        </tr>
        <tr>
          <td style="padding:3px;font-size:10px;">ADJUSTABLE BACKDROP STAND</td>
          <td style="padding:3px;font-size:10px;text-align: center;">1</td>
          <td style="padding:0;font-size:10px;">
            <?php if($row->chk_backdrop_stand == 1 ): ?>
              <center><p style='font-family:helvetica;font-weight:900;font-size:20px;'>&#x2611;</p></center>
            <?php else: ?>
              <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center> 
            <?php endif; ?>
          </td>
          <td style="padding:3px;font-size:10px;">
            <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center>  
          </td>
        </tr>
        <tr>
          <td style="padding:3px;font-size:10px;">CLAMPS </td>
          <td style="padding:3px;font-size:10px;text-align: center;">2</td>
          <td style="padding:0;font-size:10px;">
            <?php if($row->chk_clamps == 1 ): ?>
              <center><p style='font-family:helvetica;font-weight:900;font-size:20px;'>&#x2611;</p></center>
            <?php else: ?>
              <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center> 
            <?php endif; ?>
          </td>
          <td style="padding:3px;font-size:10px;">
            <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center>  
          </td>
        </tr>
        <tr>
          <td style="padding:3px;font-size:10px;">INK TANK REFILLS </td>
          <td style="padding:3px;font-size:10px;text-align: center;">2</td>
          <td style="padding:0;font-size:10px;">
            <?php if($row->chk_inktank == 1 ): ?>
              <center><p style='font-family:helvetica;font-weight:900;font-size:20px;'>&#x2611;</p></center>
            <?php else: ?>
              <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center> 
            <?php endif; ?>
          </td>
          <td style="padding:3px;font-size:10px;">
            <center><div style="border:1.5px solid #000;padding:0;margin:0;font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;</div></center>  
          </td>
        </tr>
        <tr>
          <td style="padding:3px;font-size:10px;text-align:right;"><strong>TOTAL</strong></td>
          <td style="padding:3px;font-size:10px;text-align: center;">15</td>
          <td style="padding:0;font-size:10px;">
          </td>
          <td style="padding:3px;font-size:10px;">
          </td>
        </tr>
      </table>
      <br>
      
      <table style="width:100%;font-size:10px;" id="customers">
        <!-- <tr>
          <td style="width:30%;padding:3px;font-size:10px;background-color:#eef;border: 1px solid #000;"><strong>Photo booth Kit</strong></td>
          <td style="padding:3px;font-size:10px;background-color:#eef;border: 1px solid #000;">&nbsp;&nbsp; <span>XXX3265987455</span></td>
        </tr> -->
        <tr>
          <td style="padding:3px;font-size:10px;text-align: center;"><strong>OTHERS</strong></td>
          <td style="padding:3px;font-size:10px;text-align: center;"><strong>Installed/Created</strong></td>
        </tr>
        <tr>
          <td style="padding:3px;font-size:10px;">REGISTRATION CLIENT</td>
          <td style="padding:3px;font-size:10px;color:#000;text-align:center;"><?php echo $row->reg_client == 1 ? 'Yes' : 'No'; ?></td>
        </tr>
        <tr>
          <td style="padding:3px;font-size:10px;">ANTI-VIRUS (Bit Defender)</td>
          <td style="padding:3px;font-size:10px;color:#000;text-align:center;"><?php echo $row->anti_virus == 1 ? 'Yes' : 'No'; ?></td>
        </tr>
        <tr>
          <td style="padding:3px;font-size:10px;">BITLOCKER</td>
          <td style="padding:3px;font-size:10px;color:#000;text-align:center;"><?php echo $row->bit_locker == 1 ? 'Yes' : 'No'; ?></td>
        </tr>
        <tr>
          <td style="padding:3px;font-size:10px;">PhilSys ACCOUNT</td>
          <td style="padding:3px;font-size:10px;color:#000;text-align:center;"><?php echo $row->philsys_account == 1 ? 'Yes' : 'No'; ?></td>
        </tr>
        <tr>
          <td style="padding:3px;font-size:10px;">PSA ACCOUNT</td>
          <td style="padding:3px;font-size:10px;color:#000;text-align:center;"><?php echo $row->psa_account == 1 ? 'Yes' : 'No'; ?></td>
        </tr>
      </table>
      <br>
      <table>
        <tr>
          <td style="font-size: 12px;">Remarks: </td>
        </tr>
        <tr>
          <td style="font-size: 12px;"> <?php echo strtoupper($row->remarks == '' ? '' : $row->remarks); ?></td>
        </tr>
      </table>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <p style="font-size: 12px;">Checked and Audited by: </p>
      <br>
      <br>
      <table style="width:100%;font-size:11px;">
        <tr>
          <td style="width:30%;text-align:center;"><strong><?php echo strtoupper($row->audited_by); ?></strong></td>
          <td style="width:20%;"></td>
          <td style="width:30%;text-align:center;"><?php echo date('F j, Y  h:i:s A', strtotime($row->audited_datetime)); ?></td>
        </tr>
        <tr>
          <td style="border-top:0.2px solid #000;text-align:center;">ISMD Personnel <br> (Printed name and signature)</td>
          <td></td>
          <td style="border-top:0.2px solid #000;text-align:center;">Date/Time Audited </td>
          <td></td>
        </tr>
      </table>
      <br>
      <br>
      <table style="width:100%;font-size:11px;">
        <tr><td>&nbsp;</td></tr>
        <tr>
          <td style="width:30%;text-align:center;"><div align="center" style="text-align: center; padding-left:30px; padding-top: 30px; vertical-align: middle; font-size:11px; z-index: -1; position: absolute;"><strong>RODERICK R. MALLANNAO</strong></div><img style="padding-top:-30px; padding-left:10px; position:absolute; z-index: -1;" src="<?php echo base_url('assets/image/misc/signature.png'); ?>" width="70"/></td>
          <td style="width:20%;"></td>
          <td style="width:30%;text-align:center;"><?php echo date('F j, Y'); ?> </td>
          <td></td>
        </tr>
        <tr>
          <td style="border-top:0.2px solid #000;text-align:center;">Information Systems Analyst II <br> ISMD, RSMS - PRO</td>
          <td></td>
          <td style="border-top:0.2px solid #000;text-align:center;">Date</td>
        </tr>
      </table>
      
      <!-- <table style="width:100%;">
        <tr>
          <td style="border-top:0.2px solid #000;">RODERICK R. MALLANNAO</td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td>Information Systems Analyst II <br> ISMD, RSMS - PRO</td>
          <td></td>
          <td style="border-top:0.2px solid #000;">Date/Time</td>
        </tr>
      </table> -->
    <!-- <div style="flex: 1;">
      <div style="width:30%;font-size:10px;text-align:center;line-height:3;">
        DYNAMIC NAME
      </div>
      <div style="width:30%;border-top:1px solid #000;font-size:10px;text-align:center;line-height:3;">
        ISMD Personnel <br>
        (Printed name and signature)
      </div>
      <div style="width:40%;"></div>
      <div style="width:30%;border-top:1px solid #000;font-size:10px;text-align:center;line-height:3;">
        10/27/2020 11:00:00 AM <br>
        (Date/Time Audited)
      </div>
      <br>
      <p style="font-size: 12px;">Noted by:</p>
      <br>
      <br>
      <div style="width:30%;font-size:10px;text-align:center;line-height:3;">
        
      </div>
      <div style="width:40%;"></div>
      <div style="width:30%;border-top:1px solid #000;font-size:10px;text-align:center;line-height:3;">
        RODERICK R. MALLANNAO <br>
        Information Systems Analyst II <br>
        ISMD, RSMS - PRO
      </div>
      <div style="width:30%;border-top:1px solid #000;font-size:10px;text-align:center;line-height:3;">
        Date/Time
      </div>
    </div> -->

      <?php $ctrl+=1; ?>
      </pagebreak>
<?php endforeach; ?>

</body>
</html>