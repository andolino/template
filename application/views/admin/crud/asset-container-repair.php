<label for="serial" class="font-12">Enter Serial</label>
<select id="serial" name="serial" class="select-repair-asset-tag" required>
  <option value=""></option>
  <?php foreach($data as $row): ?>
    <option value="<?php echo $row->serial; ?>"><?php echo $row->serial; ?></option>
  <?php endforeach; ?>
</select>
<label for="asset_tag" class="font-12 mt-3">Asset Tag</label>
<input type="text" class="form-control form-control-sm font-12 " id="asset_tag" name="asset_tag" readonly="" required>
<label for="property_tag" class="font-12 mt-3">Property Tag</label>
<input type="text" class="form-control form-control-sm font-12" id="property_tag" name="property_tag" readonly="">