<form id="frm-companies-settings">
	<div class="row">
		<div class="col-12">
			<div class="form-group">
		    <label for="name" class="font-12">NAME</label>
		    <input type="text" class="form-control form-control-sm font-12" id="name" name="name" value="<?php echo !empty($data) ? $data->name : ''; ?>" required>
		    <div class="name err-msg"></div>
				<input type="hidden" class="" name="original_val" value="<?php echo !empty($data) ? $data->name : ''; ?>">
		  </div>
			<div class="form-group">
		    <label for="name" class="font-12 pr-2">IMAGE</label>
				<button type="button" class="btn btn-info btn-sm" onclick="$('#img-asset').trigger('click');">Select File..</button>
				<input type='file' id="img-asset" class="none" name="image" />
				<img id="src-img-asset" class="<?php echo !empty($data) ? ($data->image == '' ? 'none' : '') : 'none'; ?> custom-image" src="<?php echo !empty($data) ? base_url() . 'assets/image/uploads/' . $data->image : ''; ?>" />
				<p class="help-block font-12 pl-5" id="upload-file-status">Accepted filetypes are jpg, png, gif, and svg. Max upload size allowed is 40M.</p>
		  </div>
		</div>
		<div class="col-12">
			<input type="hidden" name="has_update" value="<?php echo $has_update ?? ''; ?>">
			<button type="submit" class="btn btn-sm btn-default float-right font-12"><i class="fas fa-save"></i> Save</button>
		</div>
		
	</div>
</form>	