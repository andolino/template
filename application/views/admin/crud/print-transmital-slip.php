<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-4" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>QR List</title>
</head>
<body>


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
    <table>
    <tr>
      <td style="padding:0px;width:14%;font-size: 10x !important;font-family: 'Arial';"><?php echo !empty($data_procces) ? date('d F Y', strtotime($data_procces)) : ''; ?></td>
    </tr>
    <tr>
      <td></td>
    </tr>
    <tr>
      <td></td>
    </tr>
    <tr>
      <td></td>
    </tr>
    <tr>
      <td></td>
    </tr>
    <tr>
      <td></td>
    </tr>
    <tr>
      <td></td>
    </tr>
    <tr>
      <td></td>
    </tr>
    <tr>
      <td></td>
    </tr>
    <tr>
      <td></td>
    </tr>
    <tr>
      <td style="padding:0px;width:14%;font-size: 10x !important;font-family: 'Arial';"><strong><?php echo ucfirst($data[0]->last_name) . ', ' . ucfirst($data[0]->first_name); ?></strong></td>
    </tr>
    <tr>
      <td style="padding:0px;font-size: 10x !important;font-family:'Arial';"><?php echo ucfirst($data[0]->designation); ?></td>
    </tr>
    <tr>
      <td style="padding:0px;font-size: 10x !important;font-family:'Arial';"><?php echo ucfirst($data[0]->office_name); ?></td>
    </tr>
    </table>
      <br>
      <br>
      <table>
      <tr>
        <td style="padding:0px;width:14%;font-size: 10x !important;font-family: 'Arial';line-height:1.9">Dear Sir,</td>
      </tr>
      <tr>
        <td style="padding:0px;width:12%;font-size: 10x !important;font-family: 'Arial';">We are transmitting herewith <?php echo $motherCount; ?> registration kits with the other following asset inside it:</td>
      </tr>
      </table>
      <br>
      <br>
      <table style="width:100%;" id="customers">
        <tr>
          <td style="padding:3px;font-family: 'Arial';font-size:12px;background-color:#eef;border: 1px solid #000;">&nbsp;&nbsp;No</td>
          <td style="padding:3px;font-family: 'Arial';font-size:12px;background-color:#eef;border: 1px solid #000;">&nbsp;&nbsp;Product Name</td>
          <td style="padding:3px;font-family: 'Arial';font-size:12px;background-color:#eef;border: 1px solid #000;">&nbsp;&nbsp;Serial No.</td>
          <td style="padding:3px;font-family: 'Arial';font-size:12px;background-color:#eef;border: 1px solid #000;">&nbsp;&nbsp;Asset Tag No.</td>
          <td style="padding:3px;font-family: 'Arial';font-size:12px;background-color:#eef;border: 1px solid #000;">&nbsp;&nbsp;Division</td>
          <td style="padding:3px;font-family: 'Arial';font-size:12px;background-color:#eef;border: 1px solid #000;">&nbsp;&nbsp;End User</td>
        </tr>
        <?php $c = 1; ?>
        <?php foreach($data as $row): ?>
          <?php $c2 = 0; ?>
          <?php if($row->parent != ''): ?>
            <tr>
              <td style="padding:3px;font-family: 'Arial';font-size:12px;">&nbsp;&nbsp;<?php echo 1; ?></td>
              <td style="padding:3px;font-family: 'Arial';font-size:12px;">&nbsp;&nbsp;<strong><?php echo strtoupper($row->name); ?></strong></td>
              <td style="padding:3px;font-family: 'Arial';font-size:12px;">&nbsp;&nbsp;<?php echo $row->serial; ?></td>
              <td style="padding:3px;font-family: 'Arial';font-size:12px;">&nbsp;&nbsp;<?php echo $row->asset_tag; ?></td>
              <td style="padding:3px;font-family: 'Arial';font-size:12px;">&nbsp;&nbsp;<?php echo $row->short; ?></td>
              <td style="padding:3px;font-family: 'Arial';font-size:12px;">&nbsp;&nbsp;<?php echo $row->end_user; ?></td>
            </tr>
          <?php $c++; ?>
          <?php else: ?>
            <tr>
              <td style="padding:3px;font-family: 'Arial';font-size:12px;">&nbsp;&nbsp;<?php echo ($row->counter == '' ? 1 : $row->counter); ?></td>
              <td style="padding:3px;font-family: 'Arial';font-size:12px;">&nbsp;&nbsp;<?php echo $row->name; ?></td>
              <td style="padding:3px;font-family: 'Arial';font-size:12px;">&nbsp;&nbsp;<?php echo $row->serial; ?></td>
              <td style="padding:3px;font-family: 'Arial';font-size:12px;">&nbsp;&nbsp;<?php echo $row->asset_tag; ?></td>
              <td style="padding:3px;font-family: 'Arial';font-size:12px;">&nbsp;&nbsp;<?php echo $row->short; ?></td>
              <td style="padding:3px;font-family: 'Arial';font-size:12px;">&nbsp;&nbsp;<?php echo $row->end_user; ?></td>
            </tr>
          <?php $c2++; ?>
          <?php endif; ?>
        <?php endforeach; ?>
      </table>
      <br>
      <table>
        <tr>
          <td style="padding:0px;width:14%;font-size: 10px !important;font-family: 'Arial';">Very truly yours,</td>
        </tr>
      </table>
      <br>
      <br>
      <table>
        <tr>
          <td style="padding:0px;width:20%;font-size: 10px !important;font-family: 'Arial';"><strong>ROBERT JOSEPH T. CORONADO </strong></td>
        </tr>
        <tr>
          <td style="padding:0px;font-size: 10px !important;font-family: 'Arial';">Division Chief</td>
        </tr>
        <tr>
          <td style="padding:0px;font-size: 10px !important;font-family: 'Arial';">Infrastructure and Systems Management Division</td>
        </tr>
        <tr>
          <td style="padding:0px;font-size: 10px !important;font-family: 'Arial';">PhilSys Registry Office</td>
        </tr>
        <tr>
          <td style="padding:0px;font-size: 10px !important;font-family: 'Arial';">2/F TAM Building East Ave., Diliman, Quezon City 1101</td>
        </tr>
        <tr>
          <td style="padding:0px;font-size: 10px !important;font-family: 'Arial';">E-mail Add: <span style="color:blue">r.coronado@psa.gov.ph</span></td>
        </tr>
      </table>
      <br>
      <hr>
      <h5 style="text-align:center;font-family: 'Arial'; padding:0px;margin-top:0px;">ACKNOWLEDGMENT RECEIPT</h5>
      <table>
        <tr>
          <td style="padding:0px;width:20%;font-size: 10px !important;font-family: 'Arial';"><strong>ROBERT JOSEPH T. CORONADO </strong></td>
        </tr>
        <tr>
          <td style="padding:0px;font-size: 10px !important;font-family: 'Arial';">Division Chief</td>
        </tr>
        <tr>
          <td style="padding:0px;font-size: 10px !important;font-family: 'Arial';">Infrastructure and Systems Management Division</td>
        </tr>
        <tr>
          <td style="padding:0px;font-size: 10px !important;font-family: 'Arial';">PhilSys Registry Office</td>
        </tr>
        <tr>
          <td style="padding:0px;font-size: 10px !important;font-family: 'Arial';">2/F TAM Building East Ave., Diliman, Quezon City 1101</td>
        </tr>
        <tr>
          <td style="padding:0px;font-size: 10px !important;font-family: 'Arial';">E-mail Add: <span style="color:blue">r.coronado@psa.gov.ph</span></td>
        </tr>
      </table>
      <br>
      <table>
      <tr>
        <td style="padding:0px;width:20%;font-size: 10x !important;font-family: 'Arial';line-height:1.9">Dear Sir,</td>
      </tr>
      <tr>
        <td style="padding:0px;line-height:0.6"></td>
      </tr>
      <tr>
        <td style="padding:0px; font-size: 10px !important;">This is to acknowledge receipt of the ff:</td>
      </tr>
      </table>
      <br>
      <table style="width:100%;" id="customers">
        <tr>
          <td style="padding:3px;font-family: 'Arial';font-size:12px;background-color:#eef;border: 1px solid #000;">&nbsp;&nbsp;No</td>
          <td style="padding:3px;font-family: 'Arial';font-size:12px;background-color:#eef;border: 1px solid #000;">&nbsp;&nbsp;Product Name</td>
          <td style="padding:3px;font-family: 'Arial';font-size:12px;background-color:#eef;border: 1px solid #000;">&nbsp;&nbsp;Serial No.</td>
          <td style="padding:3px;font-family: 'Arial';font-size:12px;background-color:#eef;border: 1px solid #000;">&nbsp;&nbsp;Asset Tag No.</td>
          <td style="padding:3px;font-family: 'Arial';font-size:12px;background-color:#eef;border: 1px solid #000;">&nbsp;&nbsp;Division</td>
          <td style="padding:3px;font-family: 'Arial';font-size:12px;background-color:#eef;border: 1px solid #000;">&nbsp;&nbsp;End User</td>
        </tr>
        <?php $c = 1; ?>
        <?php foreach($data as $row): ?>
          <?php $c2 = 0; ?>
          <?php if($row->parent != ''): ?>
            <tr>
              <td style="padding:3px;font-family: 'Arial';font-size:12px;">&nbsp;&nbsp;<?php echo 1; ?></td>
              <td style="padding:3px;font-family: 'Arial';font-size:12px;">&nbsp;&nbsp;<strong><?php echo strtoupper($row->name); ?></strong></td>
              <td style="padding:3px;font-family: 'Arial';font-size:12px;">&nbsp;&nbsp;<?php echo $row->serial; ?></td>
              <td style="padding:3px;font-family: 'Arial';font-size:12px;">&nbsp;&nbsp;<?php echo $row->asset_tag; ?></td>
              <td style="padding:3px;font-family: 'Arial';font-size:12px;">&nbsp;&nbsp;<?php echo $row->short; ?></td>
              <td style="padding:3px;font-family: 'Arial';font-size:12px;">&nbsp;&nbsp;<?php echo $row->end_user; ?></td>
            </tr>
          <?php $c++; ?>
          <?php else: ?>
            <tr>
              <td style="padding:3px;font-family: 'Arial';font-size:12px;">&nbsp;&nbsp;<strong><?php echo ($row->counter == '' ? 1 : $row->counter); ?></strong></td>
              <td style="padding:3px;font-family: 'Arial';font-size:12px;">&nbsp;&nbsp;<?php echo $row->name; ?></td>
              <td style="padding:3px;font-family: 'Arial';font-size:12px;">&nbsp;&nbsp;<?php echo $row->serial; ?></td>
              <td style="padding:3px;font-family: 'Arial';font-size:12px;">&nbsp;&nbsp;<?php echo $row->asset_tag; ?></td>
              <td style="padding:3px;font-family: 'Arial';font-size:12px;">&nbsp;&nbsp;<?php echo $row->short; ?></td>
              <td style="padding:3px;font-family: 'Arial';font-size:12px;">&nbsp;&nbsp;<?php echo $row->end_user; ?></td>
            </tr>
          <?php $c2++; ?>
          <?php endif; ?>
        <?php endforeach; ?>
      </table>
      <br>
      <table>
      <tr>
        <td style="width:14%;padding:0px;font-size: 10px !important;font-family: 'Arial';">Received by:</td>
      </tr>
      </table>
      <br>
      <table>
      <tr>
        <td style="padding:0px;width:14%;font-size: 10px !important;font-family: 'Arial';"><strong><?php echo ucfirst($data[0]->last_name) . ', ' . ucfirst($data[0]->first_name); ?></strong></td>
      </tr>
      <tr>
        <td style="padding:0px;font-size: 10px !important;font-family: 'Arial';"><?php echo ucfirst($data[0]->designation); ?></td>
      </tr>
      <tr>
        <td style="padding:0px;font-size: 10px !important;font-family: 'Arial';"><?php echo ucfirst($data[0]->office_name); ?></td>
      </tr>
      <tr>
        <td style="padding:0px;font-size: 10px !important;font-family: 'Arial';">Date Received : <?php echo !empty($data_procces) ? date('d F Y', strtotime($data_procces)) : ''; ?></td>
      </tr>
      </table>
      <!-- <pre>
        <?php //print_r($data); ?>
      </pre> -->

</body>
</html>