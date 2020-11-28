<label for="asset_tag" class="font-12">Select Asset Tag</label>
<select id="asset_tag" name="asset_tag" class="select-repair-asset-tag" required>
  <option value=""></option>
  <?php foreach($data as $row): ?>
    <option value="<?php echo $row->asset_tag; ?>"><?php echo $row->asset_tag; ?></option>
  <?php endforeach; ?>
</select>
<label for="serial" class="font-12 mt-3">Enter Serial</label>
<input type="text" class="form-control form-control-sm font-12 " id="serial" name="serial" readonly="" required>
<label for="property_tag" class="font-12 mt-3">Property Tag</label>
<input type="text" class="form-control form-control-sm font-12" id="property_tag" name="property_tag" readonly="">