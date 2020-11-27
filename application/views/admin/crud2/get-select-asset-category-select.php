<label for="asset_category_id" class="font-12">Asset Category</label>
<select id="asset_category_id" class="asset_category_id" name="asset_category_id" required>
  <option value=""></option>
  <?php foreach($assetCategory as $row): ?>
    <option value="<?php echo $row->asset_category_id; ?>"><?php echo $row->name; ?></option>
  <?php endforeach; ?>
</select>