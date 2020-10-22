<form id="frm-asset-category-settings">
	<div class="row">
		<div class="col-12">
			<div class="form-group">
		    <label for="code" class="font-12">CODE</label>
		    <input type="text" class="form-control form-control-sm font-12" id="code" name="code" value="<?php echo !empty($data) ? $data->code : ''; ?>" required>
		    <div class="code err-msg"></div>
		    <label for="name" class="font-12">NAME</label>
		    <input type="text" class="form-control form-control-sm font-12" id="name" name="name" value="<?php echo !empty($data) ? $data->name : ''; ?>" required>
		    <div class="name err-msg"></div>
		    <!-- <label for="office_name" class="font-12">OFFICE NAME</label>
		    <input type="text" class="form-control form-control-sm font-12" id="office_name" name="office_name" value="<?php //echo !empty($data) ? $data->office_name : ''; ?>" required> -->
		    <div class="office_name err-msg"></div>
		    <input type="hidden" class="" name="entry_date" value="<?php echo date('Y-m-d'); ?>">
		    <input type="hidden" class="" name="original_val" value="<?php echo !empty($data) ? $data->code : ''; ?>">
		    <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
		  </div>
		</div>
		<div class="col-12">
			<input type="hidden" name="has_update" value="<?php echo $has_update ?? ''; ?>">
			<button type="submit" class="btn btn-sm btn-default float-right font-12"><i class="fas fa-save"></i> Save</button>
		</div>
		
	</div>
</form>	