<form id="frm-locations-settings">
	<div class="row">
		<div class="col-12">
			<div class="form-group">
		    <label for="name" class="font-12">ADDRESS</label>
		    <input type="text" class="form-control form-control-sm font-12 input-address-lat-lng" id="name" name="name" value="<?php echo !empty($data) ? $data->name : ''; ?>" required>
		    <div class="name err-msg"></div>
		  </div>
			<div class="form-group">
		    <label for="lat" class="font-12">LATITUDE</label>
		    <input type="text" class="form-control form-control-sm font-12 input-address-lat-lng" id="lat" name="lat" value="<?php echo !empty($data) ? $data->lat : ''; ?>" required>
		    <div class="name err-msg"></div>
		  </div>
			<div class="form-group">
		    <label for="lng" class="font-12">LONGITUDE</label>
		    <input type="text" class="form-control form-control-sm font-12 input-address-lat-lng" id="lng" name="lng" value="<?php echo !empty($data) ? $data->lng : ''; ?>" required>
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