<label for="serial" class="font-12">Select child you want to repair</label>
<select id="multiple-child-select" name="tbl_child_asset_id[]" class="" multiple required>
  <option value=""></option>
  <?php foreach($childAsset as $row): ?>
    <option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
  <?php endforeach; ?>
</select>