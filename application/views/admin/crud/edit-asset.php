<div class="cont-edit-member row none">
	<div class="offset-7 col-1 pl-5">
		<a href="javascript:void(0);" class="pr-2 pb-2" id="loadPage" data-link="tbl-asset" data-badge-head="ASSET LIST"
   								data-cls="cont-tbl-constituent" data-placement="top" data-toggle="tooltip" title="Back to List"><i class="fas fa-times"></i></a>
	</div>
	<!-- <div class="col-2">
		<div class="picture-cont text-center">
			<?php //if ($uploads && @file_exists('assets/image/uploads/' . $uploads->image_name)): ?>
				<img id="lgu-captured-image" src="<?php //echo base_url('assets/image/uploads/') . $uploads->image_name; ?>" class="img-thumbnail">
			<?php //else: ?>
				<img id="lgu-captured-image" src="<?php //echo base_url('assets/image/misc/default-user-member-image.png'); ?>" class="img-thumbnail">
			<?php //endif; ?>
			<div class="upload-ctrl none">
				<a href="#" onclick="doUploadDb();"><i class="fas fa-camera-retro"></i></a>
			</div>
			<form id="frm-upload-dp">
				<input type="hidden" class="lgu-cons-id" value="<?php //echo $dataAsset->id; ?>" name="id">
				<input type="file" class="d-none" id="upload-file-dp" name="upload-file-dp">
			</form>
		</div>
	</div> -->
	<div class="col-10">
		<form id="frm-create-asset">
			<div class="row">
					<!-- heading -->
					<div class="col-9 mb-3">
						<div class="navbar mb-0">
							<h6 class="mb-0"><i class="fas fa-list"></i> Details</h6>
						</div>
					</div>
					<div class="col-12 p-0 m-0"></div>
					<!-- end -->
					<div class="col-3">
						<label for="company_id" class="font-12">Company</label>
						<select class="custom-select custom-select-sm font-12" id="company_id" name="company_id">
						  <option selected hidden value="">-SELECT-</option>
						  <?php foreach ($companies as $row): ?>
						  	<option value="<?php echo $row->id; ?>" <?php echo $dataAsset->company_id == $row->id ? 'selected' : ''; ?>><?php echo $row->name; ?></option>
						  <?php endforeach; ?>
						</select>
					</div>
					<div class="col-3 pl-0">
						<label for="asset_tag" class="font-12">Asset Tag</label>
						<input type="text" class="form-control form-control-sm font-12" id="asset_tag" name="asset_tag" value="<?php echo $dataAsset->asset_tag; ?>">
					</div>
					<div class="col-3 pl-0">
						<label for="model_id" class="font-12">Model ID</label>
						<select class="custom-select custom-select-sm font-12" id="model_id" name="model_id">
						  <option selected hidden value="">-SELECT-</option>
						  <?php foreach ($models as $row): ?>
						  	<option value="<?php echo $row->id; ?>" <?php echo $dataAsset->model_id == $row->id ? 'selected' : ''; ?>><?php echo $row->name; ?></option>
						  <?php endforeach; ?>
						</select>
					</div>
					<div class="col-12 p-0 m-0"></div>
					<div class="col-3 mt-2">
						<label for="status_id" class="font-12">Status</label>
						<select class="custom-select custom-select-sm font-12" id="status_id" name="status_id">
						  <option selected hidden value="">-SELECT-</option>
						  <?php foreach ($status as $row): ?>
						  	<option value="<?php echo $row->id; ?>" <?php echo $dataAsset->status_id == $row->id ? 'selected' : ''; ?>><?php echo $row->name; ?></option>
						  <?php endforeach; ?>
						</select>
					</div>
					<div class="col-3 pl-0 mt-2">
						<label for="serial" class="font-12">Serial</label>
						<input type="text" class="form-control form-control-sm font-12" id="serial" name="serial" value="<?php echo $dataAsset->serial; ?>">
					</div>
					<div class="col-3 mt-2 pl-0">
						<label for="name" class="font-12">Asset Name</label>
						<input type="text" class="form-control form-control-sm" id="name" name="name" value="<?php echo $dataAsset->name; ?>">
					</div>
					<div class="col-12 p-0 m-0"></div>
					<div class="col-3 mt-2">
						<label for="purchase_date" class="font-12">Purchase Date</label>
						<input type="date" class="form-control form-control-sm font-12" id="purchase_date" name="purchase_date" value="<?php echo $dataAsset->purchase_date; ?>">
					</div>
					<div class="col-3 mt-2 pl-0 rel-cont">
						<label for="supplier_id" class="font-12">Supplier</label>
						<select class="custom-select custom-select-sm font-12" id="supplier_id" name="supplier_id">
						  <option selected hidden value="">-SELECT-</option>
						  <?php foreach ($suppliers as $row): ?>
							<option value="<?php echo $row->id; ?>" <?php echo $dataAsset->supplier_id == $row->id ? 'selected' : ''; ?>><?php echo $row->name; ?></option>
						  <?php endforeach; ?>
						</select>
					</div>
					<div class="col-3 pl-0 mt-2">
						<label for="order_number" class="font-12">Order Number</label>
						<input type="text" class="form-control form-control-sm font-12" id="order_number" name="order_number" value="<?php echo $dataAsset->order_number; ?>">
					</div>
					<div class="col-12 p-0 m-0"></div>
					<div class="col-3 mt-2">
						<label for="purchase_cost" class="font-12">Purchase Cost</label>
						<input type="text" class="form-control form-control-sm font-12 isNum" id="purchase_cost" name="purchase_cost" value="<?php echo $dataAsset->purchase_cost; ?>">
					</div>
					<div class="col-3 mt-2 pl-0">
						<label for="warranty_months" class="font-12">Warranty</label>
						<input type="text" class="form-control form-control-sm font-12" id="warranty_months" name="warranty_months" placeholder="Months" value="<?php echo $dataAsset->warranty_months; ?>">
					</div>
					
					<div class="col-3 mt-2 pl-0 rel-cont">
						<label for="location_id" class="font-12">Default Location</label>
						<select class="custom-select custom-select-sm font-12" id="location_id" name="location_id">
						  <option selected hidden value="">-SELECT-</option>
						  <?php foreach ($locations as $row): ?>
						  	<option value="<?php echo $row->id; ?>" <?php echo $dataAsset->location_id == $row->id ? 'selected' : ''; ?>><?php echo $row->name; ?></option>
						  <?php endforeach; ?>
						</select> 
					</div>
					<div class="col-12 p-0 m-0"></div>
					<div class="col-3 mt-2 rel-cont">
						<label for="office_management_id" class="font-12">Office</label>
						<select class="custom-select custom-select-sm font-12" id="office_management_id" name="office_management_id">
						  <option selected hidden value="">-SELECT-</option>
						  <?php foreach ($office as $row): ?>
						  	<option value="<?php echo $row->office_management_id; ?>" <?php echo $dataAsset->office_management_id == $row->office_management_id ? 'selected' : ''; ?>><?php echo $row->office_name; ?></option>
						  <?php endforeach; ?>
						</select> 
					</div>
					<div class="col-3 mt-2 pl-0 rel-cont">
						<label for="departments_id" class="font-12">Departments</label>
						<select class="custom-select custom-select-sm font-12" id="departments_id" name="departments_id">
						  <option selected hidden value="">-SELECT-</option>
						  <?php foreach ($departments as $row): ?>
						  	<option value="<?php echo $row->departments_id; ?>" <?php echo $dataAsset->departments_id == $row->departments_id ? 'selected' : ''; ?>><?php echo $row->region; ?></option>
						  <?php endforeach; ?>
						</select> 
					</div>
					<div class="col-3 mt-2 pl-0 rel-cont">
						<label for="checkout_user_id" class="font-12">Checkout To:</label>
						<select class="custom-select custom-select-sm font-12" id="checkout_user_id" name="checkout_user_id">
						  <option selected hidden value="">-SELECT-</option>
						  <?php foreach ($users as $row): ?>
							<option value="<?php echo $row->users_id; ?>" <?php echo $dataAsset->checkout_user_id == $row->users_id ? 'selected' : ''; ?>><?php echo $row->screen_name; ?></option>
						  <?php endforeach; ?>
						</select>
					</div>
					<div class="col-6 mt-2">
						<label for="notes" class="font-12">Notes</label>
						<textarea class="form-control form-control-sm font-12" id="notes" name="notes"><?php echo $dataAsset->notes; ?></textarea>
					</div>
					<div class="col-12 p-0 m-0"></div>
					<div class="col-1 mt-4">
						<div class="form-check pt-2">
							<input class="form-check-input font-12" type="checkbox" value="1" id="requestable" name="requestable" <?php echo $dataAsset->requestable == 1 ? 'checked' : ''; ?>>
							<label class="form-check-label font-12" for="requestable">
								Requestable 
							</label>
						</div>
					</div>
					<div class="col-5 mt-4 pl-2 pt-2">
						<button type="button" class="btn btn-info btn-sm" onclick="$('#img-asset').trigger('click');">Select File..</button>
						<input type='file' id="img-asset" class="none" name="upload-file-dp" />
						<img id="src-img-asset" class="<?php echo !empty($uploads) ? '' : 'none'; ?>" src="<?php echo !empty($uploads) ? base_url() . 'assets/image/uploads/' . $uploads->image_name : base_url() . 'assets/image/misc/not-found.png'; ?>" />
						<p class="help-block font-12" id="upload-file-status">Accepted filetypes are jpg, png, gif, and svg. Max upload size allowed is 40M.</p>
					</div>
			
			</div>	
			<div class="line mt-3 mb-3 pt-0 pb-0"></div>
			<button type="submit" class="btn btn-default btn-sm rounded-0 border float-right"><i class="fas fa-save"></i> Save</button>
			<input type="hidden" id="has_update" name="has_update" value="<?php echo $dataAsset->id; ?>">
		</form>

	</div>
</div>