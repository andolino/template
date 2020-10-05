<style>
  .font-12{
    
  }
</style>
<br>
<table>
<tr>
  <td style="width:20%;font-size: 10px !important;"><?php echo !empty($data_procces) ? date('d F Y', strtotime($data_procces)) : ''; ?></td>
</tr>
</table>
<br>
<br>
<table>
<tr>
  <td style="width:45%;font-family: 'Arial';font-size: 10px;"><strong><?php echo ucfirst($data[0]->last_name) . ', ' . ucfirst($data[0]->first_name); ?></strong></td>
</tr>
<tr>
  <td style="font-size: 10px !important;font-family:'Arial';"><?php echo ucfirst($data[0]->designation); ?></td>
</tr>
<tr>
  <td style="font-size: 10px !important;font-family:'Arial';"><?php echo ucfirst($data[0]->office_name); ?></td>
</tr>
</table>
<br>
<br>
<table>
<tr>
  <td style="font-size: 10px !important;">Dear Sir,</td>
</tr>
<tr>
  <td style="line-height:0.6"></td>
</tr>
<tr>
  <td style="font-size: 10px !important;">We are transmitting herewith one hundred) registration kits with the other following asset inside it:</td>
</tr>
</table>
<br>
<br>
<table border="0.2">
<tr>
  <td style="width:10%;font-size: 10px !important;line-height:2.2"><strong>&nbsp;&nbsp;No</strong></td>
  <td style="width:30%;font-size: 10px !important;line-height:2.2"><strong>&nbsp;&nbsp;Product Name</strong></td>
  <td style="width:10%;font-size: 10px !important;line-height:2.2"><strong>&nbsp;&nbsp;Serial No.</strong></td>
  <td style="width:20%;font-size: 10px !important;line-height:2.2"><strong>&nbsp;&nbsp;Asset Tag No.</strong></td>
  <td style="width:10%;font-size: 10px !important;line-height:2.2"><strong>&nbsp;&nbsp;Division</strong></td>
  <td style="width:10%;font-size: 10px !important;line-height:2.2"><strong>&nbsp;&nbsp;End User</strong></td>
</tr>
<?php $c = 1; ?>
<?php foreach($data as $row): ?>
  <?php $c2 = 0; ?>
  <?php if($row->parent != ''): ?>
    <tr>
      <td style="font-size: 10px !important;font-weight: 900; line-height:2">&nbsp;&nbsp;<?php echo $c; ?></td>
      <td style="font-size: 10px !important;font-weight: 900; line-height:2">&nbsp;&nbsp;<strong><?php echo $row->name; ?></strong></td>
      <td style="font-size: 10px !important;font-weight: 900; line-height:2">&nbsp;&nbsp;</td>
      <td style="font-size: 10px !important;font-weight: 900; line-height:2">&nbsp;&nbsp;</td>
      <td style="font-size: 10px !important;font-weight: 900; line-height:2">&nbsp;&nbsp;</td>
      <td style="font-size: 10px !important;font-weight: 900; line-height:2">&nbsp;&nbsp;</td>
    </tr>
  <?php $c++; ?>
  <?php else: ?>
    <tr>
      <td style="font-size: 10px !important;font-weight: 900;line-height:2">&nbsp;&nbsp; <?php echo $c . '.' . $c2; ?></td>
      <td style="font-size: 10px !important;font-weight: 900;line-height:2">&nbsp;&nbsp;<?php echo '(' . ($row->counter == '' ? 1 : $row->counter) . ') ' . $row->name; ?></td>
      <td style="font-size: 10px !important;font-weight: 900;line-height:2">&nbsp;&nbsp;<?php echo $row->serial; ?></td>
      <td style="font-size: 10px !important;font-weight: 900;line-height:2">&nbsp;&nbsp;<?php echo $row->asset_tag; ?></td>
      <td style="font-size: 10px !important;font-weight: 900;line-height:2">&nbsp;&nbsp;<?php echo $row->short; ?></td>
      <td style="font-size: 10px !important;font-weight: 900;line-height:2">&nbsp;&nbsp;<?php echo $row->end_user; ?></td>
    </tr>
  <?php $c2++; ?>
  <?php endif; ?>
<?php endforeach; ?>
</table>
<br>
<br>
<table>
  <tr>
    <td style="font-size: 10px !important;font-weight: 900;line-height:2">Very truly yours,</td>
  </tr>
</table>
<br>
<br>
<br>
<table>
  <tr>
    <td style="font-size: 10px !important;font-weight: 900;"><strong>ROBERT JOSEPH T. CORONADO </strong></td>
  </tr>
  <tr>
    <td style="font-size: 10px !important;font-weight: 900;">Division Chief</td>
  </tr>
  <tr>
    <td style="font-size: 10px !important;font-weight: 900;">Infrastructure and Systems Management Division</td>
  </tr>
  <tr>
    <td style="font-size: 10px !important;font-weight: 900;">PhilSys Registry Office</td>
  </tr>
  <tr>
    <td style="font-size: 10px !important;font-weight: 900;">2/F TAM Building East Ave., Diliman, Quezon City 1101</td>
  </tr>
  <tr>
    <td style="font-size: 10px !important;font-weight: 900;">E-mail Add: r.coronado@psa.gov.ph</td>
  </tr>
</table>
<br>
<br>
<hr>
<h5 style="text-align:center">ACKNOWLEDGMENT RECEIPT</h5>

<table>
<tr>
    <td style="font-size: 10px !important;font-weight: 900;"></td>
  </tr>
  <tr>
    <td style="font-size: 10px !important;font-weight: 900;"><strong>ROBERT JOSEPH T. CORONADO </strong></td>
  </tr>
  <tr>
    <td style="font-size: 10px !important;font-weight: 900;">Division Chief</td>
  </tr>
  <tr>
    <td style="font-size: 10px !important;font-weight: 900;">Infrastructure and Systems Management Division</td>
  </tr>
  <tr>
    <td style="font-size: 10px !important;font-weight: 900;">PhilSys Registry Office</td>
  </tr>
  <tr>
    <td style="font-size: 10px !important;font-weight: 900;">2/F TAM Building East Ave., Diliman, Quezon City 1101</td>
  </tr>
  <tr>
    <td style="font-size: 10px !important;font-weight: 900;">E-mail Add: r.coronado@psa.gov.ph</td>
  </tr>
</table>
<br>
<br>
<table>
<tr>
  <td style="font-size: 10px !important;">Dear Sir,</td>
</tr>
<tr>
  <td style="line-height:0.6"></td>
</tr>
<tr>
  <td style="font-size: 10px !important;">This is to acknowledge receipt of the ff:</td>
</tr>
</table>
<br>
<br>
<table border="0.2">
<tr>
  <td style="width:10%;font-size: 10px !important;line-height:2.2"><strong>&nbsp;&nbsp;No</strong></td>
  <td style="width:30%;font-size: 10px !important;line-height:2.2"><strong>&nbsp;&nbsp;Product Name</strong></td>
  <td style="width:10%;font-size: 10px !important;line-height:2.2"><strong>&nbsp;&nbsp;Serial No.</strong></td>
  <td style="width:20%;font-size: 10px !important;line-height:2.2"><strong>&nbsp;&nbsp;Asset Tag No.</strong></td>
  <td style="width:10%;font-size: 10px !important;line-height:2.2"><strong>&nbsp;&nbsp;Division</strong></td>
  <td style="width:10%;font-size: 10px !important;line-height:2.2"><strong>&nbsp;&nbsp;End User</strong></td>
</tr>
<?php $c = 1; ?>
<?php foreach($data as $row): ?>
  <?php $c2 = 0; ?>
  <?php if($row->parent != ''): ?>
    <tr>
      <td style="font-size: 10px !important;font-weight: 900; line-height:2">&nbsp;&nbsp;<?php echo $c; ?></td>
      <td style="font-size: 10px !important;font-weight: 900; line-height:2">&nbsp;&nbsp;<strong><?php echo $row->name; ?></strong></td>
      <td style="font-size: 10px !important;font-weight: 900; line-height:2">&nbsp;&nbsp;</td>
      <td style="font-size: 10px !important;font-weight: 900; line-height:2">&nbsp;&nbsp;</td>
      <td style="font-size: 10px !important;font-weight: 900; line-height:2">&nbsp;&nbsp;</td>
      <td style="font-size: 10px !important;font-weight: 900; line-height:2">&nbsp;&nbsp;</td>
    </tr>
  <?php $c++; ?>
  <?php else: ?>
    <tr>
      <td style="font-size: 10px !important;font-weight: 900;line-height:2">&nbsp;&nbsp; <?php echo $c . '.' . $c2; ?></td>
      <td style="font-size: 10px !important;font-weight: 900;line-height:2">&nbsp;&nbsp;<?php echo '(' . ($row->counter == '' ? 1 : $row->counter) . ') ' . $row->name; ?></td>
      <td style="font-size: 10px !important;font-weight: 900;line-height:2">&nbsp;&nbsp;<?php echo $row->serial; ?></td>
      <td style="font-size: 10px !important;font-weight: 900;line-height:2">&nbsp;&nbsp;<?php echo $row->asset_tag; ?></td>
      <td style="font-size: 10px !important;font-weight: 900;line-height:2">&nbsp;&nbsp;<?php echo $row->short; ?></td>
      <td style="font-size: 10px !important;font-weight: 900;line-height:2">&nbsp;&nbsp;<?php echo $row->end_user; ?></td>
    </tr>
  <?php $c2++; ?>
  <?php endif; ?>
<?php endforeach; ?>
</table>
<br>
<br>
<table>
<tr>
  <td style="font-size: 10px !important;">Received by:</td>
</tr>
</table>
<br>
<br>
<table>
<tr>
  <td style="width:45%;font-family: 'Arial';font-size: 10px;"><strong><?php echo ucfirst($data[0]->last_name) . ', ' . ucfirst($data[0]->first_name); ?></strong></td>
</tr>
<tr>
  <td style="font-size: 10px !important;font-family:'Arial';"><?php echo ucfirst($data[0]->designation); ?></td>
</tr>
<tr>
  <td style="font-size: 10px !important;font-family:'Arial';"><?php echo ucfirst($data[0]->office_name); ?></td>
</tr>
<tr>
  <td style="font-size: 10px !important;font-family:'Arial';">Date Received : <?php echo !empty($data_procces) ? date('d F Y', strtotime($data_procces)) : ''; ?></td>
</tr>
</table>
<!-- <pre>
  <?php //print_r($data); ?>
</pre> -->