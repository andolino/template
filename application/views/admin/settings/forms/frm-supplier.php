<form id="frm-supplier-settings">
	<div class="row">
		<div class="col-12">
			<div class="form-group">
		    <label for="name" class="font-12">NAME</label>
		    <input type="text" class="form-control form-control-sm font-12" id="name" name="name" value="<?php echo !empty($data) ? $data->name : ''; ?>" required>
		    <div class="name err-msg"></div>
		  </div>
      <div class="form-group">
		    <label for="address" class="font-12">ADDRESS</label>
		    <input type="text" class="form-control form-control-sm font-12" id="address" name="address" value="<?php echo !empty($data) ? $data->address : ''; ?>">
		    <div class="address err-msg"></div>
		  </div>
      <div class="form-group">
		    <label for="contact_name" class="font-12">CONTACT NAME</label>
		    <input type="text" class="form-control form-control-sm font-12" id="contact_name" name="contact_name" value="<?php echo !empty($data) ? $data->contact_name : ''; ?>">
		    <div class="contact_name err-msg"></div>
		  </div>
      <div class="form-group">
		    <label for="contact_no" class="font-12">CONTACT NUMBER</label>
		    <input type="text" class="form-control form-control-sm font-12" id="contact_no" name="contact_no" value="<?php echo !empty($data) ? $data->contact_no : ''; ?>">
		    <div class="contact_no err-msg"></div>
		  </div>
      <div class="form-group">
		    <label for="email" class="font-12">EMAIL</label>
		    <input type="email" class="form-control form-control-sm font-12" id="email" name="email" value="<?php echo !empty($data) ? $data->email : ''; ?>">
		    <div class="email err-msg"></div>
		  </div>
      <div class="form-group">
		    <label for="web" class="font-12">WEB</label>
		    <input type="text" class="form-control form-control-sm font-12" id="web" name="web" value="<?php echo !empty($data) ? $data->web : ''; ?>">
		    <div class="web err-msg"></div>
		  </div>
      <div class="form-group">
		    <label for="notes" class="font-12">NOTES</label>
        <textarea name="notes" class="form-control font-12" id="" cols="30" rows="5"><?php echo !empty($data) ? $data->notes : ''; ?></textarea>
		    <div class="notes err-msg"></div>
		  </div>
      <input type="hidden" class="" name="original_val" value="<?php echo !empty($data) ? $data->name : ''; ?>">
		</div>
		<div class="col-12">
			<input type="hidden" name="has_update" value="<?php echo $has_update ?? ''; ?>">
			<button type="submit" class="btn btn-sm btn-default float-right font-12"><i class="fas fa-save"></i> Save</button>
		</div>
		
	</div>
</form>	