<form id="frm-locations-settings">
	<div class="row">
		<div class="col-12">
			<div class="form-group">
				<label for="address" class="font-12">ADDRESS</label>
				<input type="text" class="form-control form-control-sm font-12 input-address-lat-lng" id="address" name="address" value="<?php echo !empty($data) ? $data->address : ''; ?>" required>
				<div class="address err-msg"></div>
			</div>
			<div class="form-group">
		    <label for="name" class="font-12">NAME</label>
		    <input type="text" class="form-control form-control-sm font-12" id="name" name="name" value="<?php echo !empty($data) ? $data->name : ''; ?>" required>
		    <div class="name err-msg"></div>
		  </div>
			<div class="form-group">
		    <label for="contact_person" class="font-12">CONTACT PERSON</label>
		    <input type="text" class="form-control form-control-sm font-12" id="contact_person" name="contact_person" value="<?php echo !empty($data) ? $data->contact_person : ''; ?>" required>
		    <div class="contact_person err-msg"></div>
		  </div>
			<div class="form-group">
		    <label for="contact_number" class="font-12">CONTACT NUMBER</label>
		    <input type="text" class="form-control form-control-sm font-12" id="contact_number" name="contact_number" value="<?php echo !empty($data) ? $data->contact_number : ''; ?>" required>
		    <div class="contact_number err-msg"></div>
		  </div>
			<div class="form-group">
		    <label for="email" class="font-12">EMAIL</label>
		    <input type="text" class="form-control form-control-sm font-12" id="email" name="email" value="<?php echo !empty($data) ? $data->email : ''; ?>" required>
		    <div class="email err-msg"></div>
		  </div>
			<div class="form-group">
		    <label for="lat" class="font-12">LATITUDE</label>
		    <input type="text" class="form-control form-control-sm font-12" id="lat" name="lat" value="<?php echo !empty($data) ? $data->lat : ''; ?>" required>
		    <div class="name err-msg"></div>
		  </div>
			<div class="form-group">
		    <label for="lng" class="font-12">LONGITUDE</label>
		    <input type="text" class="form-control form-control-sm font-12" id="lng" name="lng" value="<?php echo !empty($data) ? $data->lng : ''; ?>" required>
		    <div class="name err-msg"></div>
		  </div>
			<p class="help-block font-12 text-center" id="upload-file-status">Dont know your exact address? click <a href="https://developers.google.com/maps/documentation/geocoding/overview" target="_blank" class="text-info">here</a> to find your address.</p>
		</div>
		<div class="col-12">
			<input type="hidden" name="has_update" value="<?php echo $has_update ?? ''; ?>">
			<button type="submit" class="btn btn-sm btn-default float-right font-12"><i class="fas fa-save"></i> Save</button>
		</div>
		
	</div>
	<input type="hidden" class="" name="original_val" value="<?php echo !empty($data) ? $data->name : ''; ?>">
</form>	