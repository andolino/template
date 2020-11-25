<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-4" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Transmittal Slip</title>
</head>
<body>
<?php ini_set("pcre.backtrack_limit", "5000000"); ?>
<img style="margin-top: -25px;" width="400" src="<?php echo $logoFileName1; ?>">
<br>
<h4 style="text-align: center;">Transmittal Received Summary</h4>
<table style="font-size: 11px;width:100%">
  <tr>
    <th>Location</th>
    <th>Address</th>
    <th>Asset</th>
    <th>QTY</th>
    <th>Received By</th>
    <th>Date/Time Received</th>
  </tr>
  <?php foreach($dataTransmittal as $row): ?>
  <tr>
    <td><?php echo $row->province; ?></td>
    <td><?php echo $row->address; ?></td>
    <td><?php echo $row->asset; ?></td>
    <td><?php echo $row->qty; ?></td>
    <td><?php echo $row->screen_name; ?></td>
    <td style="text-align:right"><?php echo date('Y-m-d h:i:s', strtotime($row->date_received)); ?></td>
  </tr>
  <?php endforeach; ?>
</table>


</body>
</html>