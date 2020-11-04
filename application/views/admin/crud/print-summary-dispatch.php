
<?php 
date_default_timezone_set('Asia/Manila');
echo "Total Count as of " . date('F d, Y H:i:s');
echo "<br><br>";
?>


<table border=1 width="100%">
  	<tr>
     <th><strong>Location</strong></th>
     <th align="center"><strong>Count</strong></th>
    </tr>
    <tr><td>&nbsp;</td></tr>

    <?php $sum = 0; ?>

<?php foreach ($data as $row): ?>
 
    <?php $sum = $sum + $row->cnt; ?>
    <tr>
    	<td><?php echo $row->location; ?></td>
    	<td align="center"><?php echo $row->cnt; ?></td>
    </tr>

    <?php endforeach; ?>

    <tr>
    	<td><strong>TOTAL</strong></td>
        <td align="center" style="text-decoration: overline;"><strong><?php echo $sum; ?></strong></td>
    </tr>

  </table>

<div align="left" class="text-block" style=" margin-left:140px; line-height:-2px;">
   <br>
 
</div> 



