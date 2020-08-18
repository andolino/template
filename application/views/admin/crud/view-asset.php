<div class="cont-view-member row none">
	<div class="offset-6 col-1 pl-5">
		<a href="javascript:void(0);" class="pr-2 pb-2" id="loadPage" data-link="tbl-asset" data-badge-head="ASSET LIST"
   								data-cls="cont-tbl-constituent" data-placement="top" data-toggle="tooltip" title="Back to List"><i class="fas fa-times"></i></a>
	</div>
	<div class="col-10">
			<div class="row">
					<!-- heading -->
					<div class="col-8 mb-3">
						<div class="navbar mb-0">
							<h6 class="mb-0"><i class="fas fa-user-cog"></i> Asset Info</h6>
						</div>
					</div>

					<div class="col-8 mt-2">
						<div class="card">
					    <div class="card-body">
					      <div class="row">
					      	<div class="col-12">
						      	<label class="card-title font-12">SCAN HERE</label>
						      </div>
									<div class="col-12 m-0 p-0">
										<img src="<?php echo $qrcode; ?>" alt="">
						      </div>
					      	<div class="col-12 p-0 m-0"></div>
									<div class="col-6">
						      	<label class="card-title font-12">STATUS</label>
						      	<p class="card-text font-12"><?php echo $data[0]->status; ?> </p>
						      </div>
						      <div class="col-6">
						      	<label class="card-title font-12">COMPANY</label>
						      	<p class="card-text font-12"><?php echo $data[0]->company; ?></p>
						      </div>
									<div class="col-6">
						      	<label class="card-title font-12">ASSET NAME</label>
						      	<p class="card-text font-12"><?php echo $data[0]->asset_name; ?></p>
						      </div>
						      <div class="col-6">
						      	<label class="card-title font-12">ASSET TAG</label>
						      	<p class="card-text font-12"><?php echo $data[0]->asset_tag; ?></p>
						      </div>
						      <div class="col-6">
						      	<label class="card-title font-12">MODEL</label>
						      	<p class="card-text font-12"><?php echo $data[0]->model; ?></p>
						      </div>
						      <div class="col-6">
						      	<label class="card-title font-12">SERIAL</label>
						      	<p class="card-text font-12"><?php echo $data[0]->serial; ?></p>
						      </div>
						      <div class="col-6 mt-3">
						      	<label class="card-title font-12">PURCHASED DATE</label>
						      	<p class="card-text font-12"><?php echo date('F j, Y', strtotime($data[0]->purchase_date)); ?></p>
						      </div>
						      <div class="col-6 mt-3">
						      	<label class="card-title font-12">SUPPLIER</label>
						      	<p class="card-text font-12"><?php echo $data[0]->supplier; ?></p>
						      </div>
						      <div class="col-6 mt-3">
						      	<label class="card-title font-12">ORDER NUMBER</label>
						      	<p class="card-text font-12"><?php echo $data[0]->order_number; ?></p>
						      </div>
						      <div class="col-6 mt-3">
						      	<label class="card-title font-12">PURCHASE COST</label>
						      	<p class="card-text font-12"><?php echo $data[0]->purchase_cost; ?></p>
						      </div>
									<div class="col-6 mt-3">
						      	<label class="card-title font-12">WARRANTY MONTHS</label>
						      	<p class="card-text font-12"><?php echo $data[0]->warranty_months; ?></p>
						      </div>
									<div class="col-6 mt-3">
						      	<label class="card-title font-12">DEFAULT LOCATION</label>
						      	<p class="card-text font-12"><?php echo $data[0]->default_location; ?></p>
						      </div>
									<div class="col-6 mt-3">
						      	<label class="card-title font-12">NOTES</label>
						      	<p class="card-text font-12"><?php echo $data[0]->notes; ?></p>
						      </div>
									<div class="col-6 mt-3">
						      	<label class="card-title font-12">REQUESTED</label>
						      	<p class="card-text font-12"><?php echo $data[0]->requestable == 1 ? 'YES' : 'NO'; ?></p>
						      </div>
									<div class="col-8 mt-3">
						      	<label class="card-title font-12">IMAGE</label>
						      	<img class="custom-image" src="<?php echo !empty($uploads) ? base_url() . 'assets/image/uploads/' . $uploads->image_name : base_url() . 'assets/image/misc/not-found.png'; ?>" alt="">
						      </div>
					      </div>
								<div class="row">
									<div class="offset-9 col-3">
										<img src="" class="none display-qr" alt="">
									</div>
								</div>

					    </div>
					  </div>
					</div>
					<!-- end -->

			</div>	
			<div class="line mt-3 mb-3 pt-0 pb-0"></div>

	</div>
</div>