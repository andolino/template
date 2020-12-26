<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-4" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title></title>
</head>
<body>
<?php ini_set("pcre.backtrack_limit", "5000000"); ?>
<!-- <img style="margin-top: -25px;" src="<?php //echo base_url('assets/image/misc/img-logo-header.png'); ?>"> -->
<table align="left" style="font-size: 12px;width:100%">
  <tr>
    <td style="text-align:center;width:100%;font-size: 18px;"><strong>Purchased Request</strong></td>
  </tr>
</table>
<br>
<table style="font-size: 12px;width:100%;">
  <tr>
    <td style="width:14%;border: 0.5px solid #000;">Entity Name:</td>
    <td style="width:36%;border: 0.5px solid #000;"><u><strong>Philippine Statistic Authority</strong></u></td>
    <td style="width:14%;border: 0.5px solid #000;">Fund Cluster:</td>
    <td style="width:36%;border: 0.5px solid #000;"><u><strong>General Fund</strong></u></td>
  </tr>
</table>
<table style="font-size: 12px;width:100%;">
  <tr>
    <td style="width: 30%;border: 0.5px solid #000;">
      <table style="width: 100%;">
        <tr>
          <td>Office/Section/Division</td>
        </tr>
        <tr>
          <td style="border-bottom: 0.2px solid #000;"><strong>PhilSys-RSMS-ISMD</strong></td>
        </tr>
      </table>
    </td>
    <td style="width: 40%;border: 0.5px solid #000;">
      <table style="width:100%;">
        <tr>
          <td style="width:60%;">PR No. </td>
          <td style="border-bottom: 0.2px solid #000;width:40%;">123</td>
        </tr>
        <tr>
          <td>Responsibility Center Code: </td>
          <td style="border-bottom: 0.2px solid #000;"></td>
        </tr>
      </table>
    </td>
    <td style="width: 30%;border: 0.5px solid #000;">
      <table style="width:100%;">
        <tr>
          <td style="width:50%;">Date:</td>
          <td style="border-bottom: 0.2px solid #000;width:50%;"><?php echo date('Y-m-d', strtotime($dataReimbursement[0]->date_filed)); ?></td>
        </tr>
      </table>
    </td>
  </tr>
</table>



<table class="table" style="font-size: 12px;width:100%">
  <tr>
    <td style="width: 15%;text-align:center;"><strong>Stock/Property</strong></td>
    <td style="width: 15%;text-align:center;"><strong>Unit</strong></td>
    <td style="width: 30%;text-align:center;"><strong>Item Description</strong></td>
    <td style="text-align:center;"><strong>Quantity</strong></td>
    <td style="text-align:center;"><strong>Unit Cost</strong></td>
    <td style="text-align:center;"><strong>Total Cost</strong></td>
  </tr>
  <?php foreach($dataReimbursement as $row): ?>
    <tr>
      <td style="text-align:center;"></td>
      <td style="text-align:center;"><?php echo $row->select_unit; ?></td>
      <td style="text-align:center;"><?php echo $row->item_description; ?></td>
      <td style="text-align:center;"><?php echo $row->qty; ?></td>  
      <td style="text-align:center;"><?php echo number_format($row->unit_cost, 2); ?></td>
      <td style="text-align:center;"><?php echo number_format($row->total_cost, 2); ?></td>
    </tr>
  <?php endforeach; ?>
  <tr>
    <td style="text-align:center;">&nbsp;</td>
    <td style="text-align:center;">&nbsp;</td>
    <td style="text-align:center;">&nbsp;</td>
    <td style="text-align:center;">&nbsp;</td>  
    <td style="text-align:center;">&nbsp;</td>
    <td style="text-align:center;">&nbsp;</td>
  </tr>
  <tr>
    <td style="text-align:center;">&nbsp;</td>
    <td style="text-align:center;">&nbsp;</td>
    <td style="text-align:center;">*********nothing follows*********</td>
    <td style="text-align:center;">&nbsp;</td>  
    <td style="text-align:center;">&nbsp;</td>
    <td style="text-align:center;">&nbsp;</td>
  </tr>
  <tr>
    <td style="text-align:center;">&nbsp;</td>
    <td style="text-align:center;">&nbsp;</td>
    <td style="text-align:center;">&nbsp;</td>
    <td style="text-align:center;">&nbsp;</td>  
    <td style="text-align:center;">&nbsp;</td>
    <td style="text-align:center;">&nbsp;</td>
  </tr>
</table>

<table style="font-size: 12px;width:100%;">
  <tr>
    <td style="width: 15%;border:0.2px solid #000;">Purpose:</td>
    <td style="width: 85%;border:0.2px solid #000;"><?php echo $dataReimbursement[0]->purpose; ?></td>
  </tr>
</table>
<table style="font-size: 12px;width:100%;">
  <tr>
    <td style="width: 15%;border:0.2px solid #000;"></td>
    <td style="width: 40%;border:0.2px solid #000;">Requested by:</td>
    <td style="width: 45%;border:0.2px solid #000;">Approved by:</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
  </tr>
</table>
<table style="font-size: 12px;width:100%;">
  <tr>
    <td style="width: 15%;">Signature:</td>
    <td style="width: 40%;"></td>
    <td style="width: 45%;"></td>
  </tr>
  <tr>
    <td style="width: 15%;">Printed Name:</td>
    <td style="width: 40%;"><strong><?php echo $dataReimbursement[0]->request_by; ?></strong></td>
    <td style="width: 45%;text-align:center;"><strong>ATTY. LOURDINES C. DELA CRUZ</strong> </td>
  </tr>
  <tr>
    <td style="width: 15%;">Designation:</td>
    <td style="width: 40%;"><strong><?php echo $dataReimbursement[0]->requested_designation; ?></strong></td>
    <td style="width: 45%;text-align:center;">Deputy National Statistician <br> PhilSys Registry Office</td>
  </tr>
</table>


</body>
</html>

<style>
  .table td{
    border: 0.5px solid #000;
  }
</style>