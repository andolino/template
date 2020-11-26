<form id="frm-approver-settings">
	<div class="row">
		<div class="col-12">
			<div class="form-group">
		    <label for="location_id" class="font-12">LOCATION</label>
		    <!-- <input type="text" class="form-control form-control-sm font-12" id="region" name="region" value="<?php //echo !empty($data) ? $data->region : ''; ?>" required> -->
        <select class="custom-select custom-select-sm mb-2 font-12" id="location_id" name="location_id" required>
				  <option value="" hidden>--</option>
					<?php foreach($locations as $row): ?>
          <option value="<?php echo $row->id; ?>" <?php echo !empty($data) ? ($data->location_id == $row->id ? 'selected' : '') : ''; ?>><?php echo $row->name; ?></option>
          <?php endforeach; ?>
				</select>
		    <div class="region err-msg"></div>
		    <label for="first_approver" class="font-12">PRIMARY APPROVER</label>
		    <select class="custom-select custom-select-sm mb-2 font-12" id="first_approver" name="first_approver" required>
				  <option value="">--</option>
					<?php foreach($users as $row): ?>
          <option value="<?php echo $row->users_id; ?>" <?php echo !empty($data) ? ($data->first_approver == $row->users_id ? 'selected' : '') : ''; ?>><?php echo strtoupper($row->last_name . ', ' . $row->first_name); ?></option>
          <?php endforeach; ?>
				</select>
		    <div class="short err-msg"></div>
		    <label for="second_approver" class="font-12">SECONDARY APPROVER</label>
		    <select class="custom-select custom-select-sm mb-2 font-12" id="second_approver" name="second_approver">
				  <option value="">--</option>
					<?php foreach($users as $row): ?>
          <option value="<?php echo $row->users_id; ?>" <?php echo !empty($data) ? ($data->second_approver == $row->users_id ? 'selected' : '') : ''; ?>><?php echo strtoupper($row->last_name . ', ' . $row->first_name); ?></option>
          <?php endforeach; ?>
				</select>
		    <!-- <label for="office_name" class="font-12">OFFICE NAME</label>
		    <input type="text" class="form-control form-control-sm font-12" id="office_name" name="office_name" value="<?php //echo !empty($data) ? $data->office_name : ''; ?>" required> -->
		    <div class="office_name err-msg"></div>
		    <input type="hidden" class="" name="entry_date" value="<?php echo date('Y-m-d'); ?>">
		    <input type="hidden" class="" name="original_val" value="<?php echo !empty($data) ? $data->location_id : ''; ?>">
		    <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
		  </div>
		</div>
		<div class="col-12">
			<input type="hidden" name="has_update" value="<?php echo $has_update ?? ''; ?>">
			<button type="submit" class="btn btn-sm btn-default float-right font-12"><i class="fas fa-save"></i> Save</button>
		</div>
		
	</div>
</form>	