<div class="cont-add-member row none">
	<div class="offset-8 col-1">
		<a href="javascript:void(0);" class="float-right pr-2 pb-2" id="loadPage" data-link="<?php echo !empty($asset_id) ? 'view-child-asset' : 'tbl-asset'; ?>" data-badge-head="ASSET LIST"
   								data-cls="cont-tbl-constituent" data-placement="top" data-toggle="tooltip" title="Back to List"><i class="fas fa-times"></i></a>
	</div>
	<div class="col-12">
		<form id="frm-create-asset">
			<input type="hidden" name="tbl_asset_id" value="<?php echo !empty($asset_id) ? $asset_id : ''; ?>">
			<div class="row">
				<!-- heading -->
				<div class="col-9 mb-3">
					<div class="navbar mb-0">
						<h6 class="mb-0"><i class="fas fa-list"></i> Details</h6>
					</div>
				</div>
				<div class="col-12 p-0 m-0"></div>
				<!-- end -->
				<div class="col-1">
					<div class="form-check pt-2 pb-2">
						<input class="form-check-input font-12" type="checkbox" value="1" id="requestable" name="requestable">
						<label class="form-check-label font-12" for="requestable">
							Requestable 
						</label>
					</div>
				</div>
				<div class="col-11">
					<?php if(!empty($asset_id)): ?>
						<div class="row">
							<div class="col-sm-5 col-md-1">
								<div class="form-check pt-2 pb-2">
									<input class="form-check-input font-12" type="checkbox" value="1" id="gen_qr_code" name="gen_qr_code">
									<label class="form-check-label font-12" for="gen_qr_code">
										Generate QR Code 
									</label>
								</div>
							</div>
							<div class="col-sm-5 col-md-2">
								<div class="form-check pt-2 pb-2">
									<input class="form-check-input font-12" type="checkbox" value="<?php echo $asset_id; ?>" id="apply_par_custodian">
									<label class="form-check-label font-12" for="apply_par_custodian">
										Apply Same Custodian On Parent Asset 
									</label>
								</div>
							</div>
						</div>
					<?php else: ?>
						<div class="row">
							<!-- <div class="col-sm-5 col-md-1">
								<div class="form-check pt-2 pb-2">
									<input class="form-check-input font-12" type="checkbox" value="1" id="siblings_ofchk">
									<label class="form-check-label font-12" for="siblings_ofchk">
										Siblings Of :
									</label>
								</div>
							</div> -->
							<div class="col-sm-12 col-md-12"></div>
							<div class="col-sm-12 col-md-2 mt-1">
								<label class="font-12" for="siblings">
									Siblings Of :
								</label>
								<select class="custom-select custom-select-sm font-12" id="siblings" name="siblings">
									<option selected hidden value="">-SELECT-</option>
									<?php foreach ($dataParentAsset as $row): ?>
										<option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
					<?php endif; ?>
				</div>
				<div class="col-3">
					<label for="company_id" class="font-12">Company</label>
					<select class="custom-select custom-select-sm font-12" id="company_id" name="company_id">
						<option selected hidden value="">-SELECT-</option>
						<?php foreach ($companies as $row): ?>
							<option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="col-3 pl-0">
					<label for="asset_tag" class="font-12">Asset Tag</label>
					<input type="text" class="form-control form-control-sm font-12" id="asset_tag" name="asset_tag" >
				</div>
				<?php //echo !empty($asset_id) ? $asset_id : ''; ?>
				<?php if(!empty($asset_id)): ?>
					<div class="col-3 pl-0">
						<label for="model_id" class="font-12">Model ID</label>
						<select class="custom-select custom-select-sm font-12" id="model_id" name="model_id">
							<option selected hidden value="">-SELECT-</option>
							<?php foreach ($models as $row): ?>
								<option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				<?php endif; ?>
				<div class="col-12 p-0 m-0"></div>
				<div class="col-3 mt-2">
					<label for="status_id" class="font-12">Status</label>
					<select class="custom-select custom-select-sm font-12" id="status_id" name="status_id">
						<option selected hidden value="">-SELECT-</option>
						<?php foreach ($status as $row): ?>
							<option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="col-3 pl-0 mt-2">
					<label for="serial" class="font-12">Serial</label>
					<input type="text" class="form-control form-control-sm font-12" id="serial" name="serial" >
				</div>
				<div class="col-3 mt-2 pl-0">
					<label for="name" class="font-12">Asset Name</label>
					<input type="text" class="form-control form-control-sm font-12" id="name" name="name" >
				</div>
				<div class="col-12 p-0 m-0"></div>
				<div class="col-3 mt-2">
					<label for="purchase_date" class="font-12">Purchase Date</label>
					<input type="date" class="form-control form-control-sm font-12" id="purchase_date" name="purchase_date" >
				</div>
				<div class="col-3 mt-2 pl-0 rel-cont">
					<label for="supplier_id" class="font-12">Supplier</label>
					<select class="custom-select custom-select-sm font-12" id="supplier_id" name="supplier_id">
						<option selected hidden value="">-SELECT-</option>
						<?php foreach ($suppliers as $row): ?>
						<option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="col-3 pl-0 mt-2">
					<label for="order_number" class="font-12">Order Number</label>
					<input type="text" class="form-control form-control-sm font-12" id="order_number" name="order_number" >
				</div>
				<div class="col-12 p-0 m-0"></div>
				<div class="col-3 mt-2">
					<label for="purchase_cost" class="font-12">Purchase Cost</label>
					<input type="text" class="form-control form-control-sm font-12 isNum" id="purchase_cost" name="purchase_cost" >
				</div>
				<div class="col-3 mt-2 pl-0">
					<label for="warranty_months" class="font-12">Warranty</label>
					<input type="text" class="form-control form-control-sm font-12" id="warranty_months" name="warranty_months" placeholder="Months">
				</div>
				<div class="col-3 mt-2 pl-0 rel-cont">
					<label for="location_id" class="font-12">Default Location</label>
					<select class="custom-select custom-select-sm font-12" id="location_id" name="location_id">
						<option selected hidden value="">-SELECT-</option>
						<?php foreach ($locations as $row): ?>
							<option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
						<?php endforeach; ?>
					</select> 
				</div>
				<div class="col-12 p-0 m-0"></div>
				<div class="col-3 mt-2 rel-cont">
					<label for="office_management_id" class="font-12">Office</label>
					<select class="custom-select custom-select-sm font-12" id="office_management_id" name="office_management_id">
						<option selected hidden value="">-SELECT-</option>
						<?php foreach ($office as $row): ?>
							<option value="<?php echo $row->office_management_id; ?>"><?php echo $row->office_name; ?></option>
						<?php endforeach; ?>
					</select> 
				</div>
				<div class="col-3 mt-2 pl-0 rel-cont">
					<label for="departments_id" class="font-12">Departments</label>
					<select class="custom-select custom-select-sm font-12" id="departments_id" name="departments_id">
						<option selected hidden value="">-SELECT-</option>
						<?php foreach ($departments as $row): ?>
							<option value="<?php echo $row->departments_id; ?>"><?php echo $row->region; ?></option>
						<?php endforeach; ?>
					</select> 
				</div>
				<div class="col-3 mt-2 pl-0 rel-cont">
					<label for="checkout_user_id" class="font-12">Custodian:</label>
					<select class="custom-select custom-select-sm font-12" id="checkout_user_id" name="checkout_user_id">
						<option selected hidden value="">-SELECT-</option>
						<?php foreach ($users as $row): ?>
						<option value="<?php echo $row->users_id; ?>"><?php echo $row->screen_name; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="col-12 p-0 m-0"></div>
				<div class="col-6 mt-2">
					<label for="notes" class="font-12">Notes</label>
					<textarea class="form-control form-control-sm font-12" id="notes" name="notes"></textarea>
				</div>
				<div class="col-12 p-0 m-0"></div>
				
				<div class="col-5 mt-4 pl-2 pt-2">
					<button type="button" class="btn btn-info btn-sm" onclick="$('#img-asset').trigger('click');">Select File..</button>
					<input type='file' id="img-asset" class="none" name="upload-file-dp" />
					<img id="src-img-asset" class="none" src="#" />
					<p class="help-block font-12" id="upload-file-status">Accepted filetypes are jpg, png, gif, and svg. Max upload size allowed is 40M.</p>
				</div>
			</div>	

			
			<div class="line mt-3 mb-3 pt-0 pb-0"></div>
			<div class="row">
				<div class="col-1 offset-8">
					<button type="submit" class="btn btn-default btn-sm rounded-0 border float-right font-12"><i class="fas fa-save"></i> Save</button>
				</div>
			</div>
		</form>

	</div>
</div>



<!-- add input multiple -->
<!-- <div class="col-12"></div>
<div class="col-3 mt-2 govt-name-cont">
	<label for="govt_name" class="font-12">Govertment ID's/Docs</label>
	<select class="custom-select custom-select-sm" id="govt_name" name="govt_name[]">
	  <option selected value="">-NONE-</option>
	</select>
</div>
<div class="col-3 mt-2 pl-0">
	<label for="govt_id" class="font-12">Gov't ID #</label>
	<input type="text" class="form-control form-control-sm" id="govt_id" name="govt_id[]" >
</div>
<div class="col-1 mt-4 pt-3 pl-0" id="addgovt-sect">
	<button type="button" class="btn btn-success btn-sm" id="add-govt-field"><i class="fas fa-plus"></i></button>
</div> -->