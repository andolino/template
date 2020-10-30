<style>
  table#tbl-regkits tr td {
    border:0.2px solid #000;
    padding: 4px;
  }
  #tbl-regkits tr td:nth-child(1){ width: 9.09%; }
  #tbl-regkits tr td:nth-child(2){ width: 9.09%; }
  #tbl-regkits tr td:nth-child(3){ width: 9.09%; }
  #tbl-regkits tr td:nth-child(4){ width: 9.09%; }
  #tbl-regkits tr td:nth-child(5){ width: 9.09%; }
  #tbl-regkits tr td:nth-child(6){ width: 9.09%; }
  #tbl-regkits tr td:nth-child(7){ width: 9.09%; }
  #tbl-regkits tr td:nth-child(8){ width: 9.09%; }
  #tbl-regkits tr td:nth-child(9){ width: 9.09%; }
  #tbl-regkits tr td:nth-child(10){ width: 9.09%; }
  #tbl-regkits tr td:nth-child(11){ width: 9.09%; }
</style>
<h4 style="text-align:center">Summary of Registration Kits <br> PSO <?php echo $tbl_locations->name; ?></h4>

<table id="tbl-regkits" style="font-size:11px;width:100%;">
  <tr>
    <td style="font-weight:900;"><strong>No.</strong></td>
    <td style="font-weight:900;"><strong>Luggage Kit</strong></td>
    <td style="font-weight:900;"><strong>Laptop</strong></td>
    <td style="font-weight:900;"><strong>Fingerprint Scanner</strong></td>
    <td style="font-weight:900;"><strong>Iris Scanner</strong></td>
    <td style="font-weight:900;"><strong>Web Camera</strong></td>
    <td style="font-weight:900;"><strong>Document Scanner</strong></td>
    <td style="font-weight:900;"><strong>Printer</strong></td>
    <td style="font-weight:900;"><strong>Extended Monitor</strong></td>
    <td style="font-weight:900;"><strong>Battery Pack</strong></td>
    <td style="font-weight:900;"><strong>Photo booth Kit</strong></td>
  </tr>
  <?php $ctrl=1; ?>
  <?php foreach($dataChkList as $row): ?>
    <tr>
      <td><?php echo $ctrl; ?></td>
      <td><?php echo $row->luggage_asset_tag; ?></td>
      <td><?php echo $row->laptop; ?></td>
      <td><?php echo $row->fingerprint_scanner; ?></td>
      <td><?php echo $row->iris_scanner; ?></td>
      <td><?php echo $row->webcamera; ?></td>
      <td><?php echo $row->document_scanner; ?></td>
      <td><?php echo $row->printer; ?></td>
      <td><?php echo $row->extended_monitor; ?></td>
      <td><?php echo $row->battery_pack; ?></td>
      <td><?php echo $row->photobooth_kit; ?></td>
    </tr>
    <?php $ctrl++; ?>
  <?php endforeach; ?>
</table>
<br>
<p style="font-size:11px;">
  Total No. of Luggage Kit: <?php echo count($dataChkList); ?> <br>
  Total No. of Photo booth Kit: <?php echo count($dataChkList); ?>
</p>
<br>  
<table style="font-size:11px;width:20%;">
  <tr>
    <td style="width:10%;">Received by:</td>
    <td style="width:50%;border-bottom: 0.2px solid #000;"></td>
  </tr>
  <tr>
    <td style="width:10%;">Date Received:</td>
    <td style="width:50%;border-bottom: 0.2px solid #000;"></td>
  </tr>
</table>