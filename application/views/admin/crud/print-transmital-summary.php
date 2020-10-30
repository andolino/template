

<img src="<?php echo base_url('assets/image/misc/psa-logo.png'); ?>" width="450" style="float:left;margin-bottom:20px;">
<br>
<table>
<tr>
  <td style="padding:0px;width:10%;font-size: 10x !important;line-height:1.9;text-align: right;"><strong>TRANSMITTAL SLIP</strong></td>
</tr>
</table>
<br>
<br>
<br>
<table style="font-size: 12px;">
  <tr>
    <td><strong><?php echo date('d F Y'); ?></strong></td>
  </tr>
  <tr>
    <td></td>
  </tr>
</table>
<br>
<table style="font-size: 12px;width:35%">
  <tr>
    <td><strong><?php echo strtoupper($tbl_locations->contact_person); ?></strong></td>
  </tr>
  <tr>
    <td>Chief Statistical Specialist – <strong><?php echo strtoupper($tbl_locations->name); ?></strong></td>
  </tr>
  <tr>
    <td><strong><?php echo ucfirst($tbl_locations->address); ?></strong></td>
  </tr>
</table>
<br>
<table style="font-size: 12px;">
  <tr>
    <td>Dear Sir / Ma’am:</td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td>We are transmitting herewith <?php echo $intToWords(count($dataChkList)); ?> (<?php echo count($dataChkList); ?>) units of Registration Kit (luggage kit and photo booth kit) to be used for the implementation of the Philippine Identification System (PhilSys). Please see the following attachments for the details.</td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td>	Summary of Registration Kits</td>
  </tr>
  <tr>
    <td>	Registration Kit Checklist Form</td>
  </tr>
</table>
<br>
<table style="font-size: 12px;">
  <tr>
    <td>The Property Acknowledgement Receipt (PAR) of the Registration Kits will be provided by the General Services Division (GSD).</td>
  </tr>
</table>
<br>
<table style="font-size: 12px;">
  <tr> 
    <td>In Addition, kindly scan the QRCODE provided below in acknowledging the Registration Kit online using the application provided by the Infrastructure and Systems Management Division (ISMD).</td>
  </tr>
</table>
<br>
<table style="font-size: 12px;">
  <tr>
    <td>Very truly yours,.</td>
  </tr>
</table>
<br>
<table style="font-size: 12px;width:100%;">
  <tr>
    <td style="padding:0px;width:30%;"><strong>EDGAR M. FAJUTAGANA </strong></td>
    <td style="padding:0px;width:10%;" rowspan="6"><img src="<?php echo $qrcode; ?>" width="80"></td>
  </tr>
  <tr>
    <td style="padding:0px;">Assistant National Statistician</td>
  </tr>
  <tr>
    <td style="padding:0px;">Registration and Systems Management Service</td>
  </tr>
  <tr>
    <td style="padding:0px;">PhilSys Registry Office</td>
  </tr>
  <tr>
    <td style="padding:0px;">2/F TAM Building East Ave., Diliman, Quezon City 1101</td>
  </tr>
  <tr>
    <td style="padding:0px;">E-mail Add: <span style="color:blue">e.fajutagana@philsys.gov.ph</span></td>
  </tr>
</table>
<br>
<hr>
<h5 style="text-align:center; padding:0px;margin-top:0px;">ACKNOWLEDGMENT RECEIPT</h5>
<table style="font-size: 12px;">
<tr>
    <td style="padding:0px;width:20%;"><strong>EDGAR M. FAJUTAGANA </strong></td>
  </tr>
  <tr>
    <td style="padding:0px;">Assistant National Statistician</td>
  </tr>
  <tr>
    <td style="padding:0px;">Registration and Systems Management Service</td>
  </tr>
  <tr>
    <td style="padding:0px;">PhilSys Registry Office</td>
  </tr>
  <tr>
    <td style="padding:0px;">2/F TAM Building East Ave., Diliman, Quezon City 1101</td>
  </tr>
  <tr>
    <td style="padding:0px;">E-mail Add: <span style="color:blue">e.fajutagana@philsys.gov.ph</span></td>
  </tr>
</table>
<br>
<table style="font-size: 12px;">
<tr>
  <td style="padding:0px;width:20%;font-size: 10x !important;line-height:1.9">Dear Sir,</td>
</tr>
<tr>
  <td style="padding:0px;line-height:0.6"></td>
</tr>
<tr>
  <td style="padding:0px; ">This is to acknowledge receipt of the <?php echo $intToWords(count($dataChkList)); ?> (<?php echo count($dataChkList); ?>) units of Registration Kit (luggage kit and photo booth kit).</td>
</tr>
</table>
<br>
<table style="font-size: 12px;">
<tr>
  <td style="padding:0px;">Received by: </td>
  <td style="padding:0px;border-bottom:0.2px solid #000;"> <?php //echo strtoupper($tbl_locations->contact_person); ?></td>
</tr>
</table>
<br>
<table style="font-size: 12px;">
<tr>
  <td style="padding:0px;width:14%;"><strong><?php //echo ucfirst($data[0]->last_name) . ', ' . ucfirst($data[0]->first_name); ?></strong></td>
</tr>
<tr>
  <td style="padding:0px;"><?php //echo ucfirst($data[0]->designation); ?></td>
</tr>
<tr>
  <td style="padding:0px;"><?php //echo ucfirst($data[0]->office_name); ?></td>
</tr>
<tr>
  <td style="padding:0px;">Date Received : <?php //echo !empty($data_procces) ? date('d F Y', strtotime($data_procces)) : ''; ?></td>
</tr>
<tr>
  <td style="padding:0px;">
    <?php 
      $words = explode(" ", $tbl_locations->contact_position);
      $acronym = "";
      
      foreach ($words as $w) {
        $acronym .= $w[0];
      }
    ?>
    Attachment of Transmittal Letter to <strong><?php echo strtoupper($acronym); ?></strong>
  </td>
</tr>
</table>