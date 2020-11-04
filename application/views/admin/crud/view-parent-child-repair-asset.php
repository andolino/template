<?php 
  $status = [0 => 'Pending', 1 => 'For Repair', 2 => 'Disapproved', 3 =>'Cancelled', 4 => 'Closed'];
?>
<h4>PARENT ASSET</h4>
<table class="table font-12 w-100"  id="" data-status="1">
  <thead>
    <tr>
      <th scope="col">ASSET NAME</th>
      <th scope="col">ASSET TAG </th>
      <th scope="col">PROPERTY TAG</th>
      <th scope="col">SERIAL NO</th>
      <th scope="col">OFFICE</th>
      <th scope="col">REMARKS</th>
      <th scope="col">STATUS</th>
      <th scope="col">ACTION</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><?php echo $dataRequest->asset_name; ?></td>
      <td><?php echo $dataRequest->asset_tag; ?></td>
      <td><?php echo $dataRequest->property_tag; ?></td>
      <td><?php echo $dataRequest->serial; ?></td>
      <td><?php echo $dataRequest->office_name; ?></td>
      <td><?php echo $dataRequest->remarks; ?></td>
      <td><?php echo $status[$dataRequest->status]; ?></td>
      <td></td>
    </tr>
  </tbody>
</table>
<h4>CHILD ASSET</h4>
<!-- <pre>
    <?php //print_r($childAsset); ?>
</pre> -->
<table class="table font-12 w-100"  id="" data-status="1">
  <thead>
    <tr>
      <th scope="col">ASSET NAME</th>
      <th scope="col">ASSET TAG </th>
      <th scope="col">PROPERTY TAG</th>
      <th scope="col">SERIAL NO</th>
      <th scope="col">OFFICE</th>
      <th scope="col">REMARKS</th>
      <th scope="col">STATUS</th>
      <th scope="col">ACTION</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($childAsset as $row): ?>
    <tr>
      <td><?php echo $row->name; ?></td>
      <td><?php echo $row->asset_tag; ?></td>
      <td><?php echo $row->property_tag; ?></td>
      <td><?php echo $row->serial; ?></td>
      <td><?php echo $row->office_name; ?></td>
      <td><?php $dataRequest->remarks; ?></td>
      <td><?php echo $status[$dataRequest->status]; ?></td>
      <td><?php //echo $row-> ?></td>
      <td></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>

  <ul style="list-style-type:none;">
    <?php if($dataRequest->status == 1): ?>
      <li class="font-12">Remarks: <?php echo 'The item is on warranty. To be Repair by the supplier.'; ?></li>
    <?php endif; ?>
  </ul>
