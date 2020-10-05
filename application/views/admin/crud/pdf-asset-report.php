<style>
  .font-12{
    
  }
</style>
<table border="0.2px">
<tr>
    <td style="width:10%;"></td>
    <td style="width:40%;font-size: 8px !important;line-height:2.2"><strong>&nbsp;&nbsp;Description</strong></td>
    <td style="width:20%;font-size: 8px !important;line-height:2.2"><strong>&nbsp;&nbsp;Serial Number</strong></td>
    <td style="width:30%;font-size: 8px !important;line-height:2.2"><strong>&nbsp;&nbsp;PTag/DTag Number</strong></td>
  </tr>
<?php foreach($data as $row): ?>
  <?php if($row->parent != ''): ?>
    <tr>
      <td style="font-size: 8px !important;font-weight: 900; line-height:2" colspan="4">&nbsp;&nbsp;<strong><?php echo $row->name; ?></strong></td>
    </tr>
  <?php else: ?>
    <tr>
      <td style="font-size: 8px !important;font-weight: 900;width:10%; line-height:2">&nbsp;&nbsp;<?php echo $row->counter; ?></td>
      <td style="font-size: 8px !important;font-weight: 900;width:40%; line-height:2">&nbsp;&nbsp;<?php echo $row->name; ?></td>
      <td style="font-size: 8px !important;font-weight: 900;width:20%; line-height:2">&nbsp;&nbsp;<?php echo $row->serial; ?></td>
      <td style="font-size: 8px !important;font-weight: 900;width:30%; line-height:2">&nbsp;&nbsp;<?php echo $row->asset_tag; ?></td>
    </tr>
<?php endif; ?>
<?php endforeach; ?>

</table>