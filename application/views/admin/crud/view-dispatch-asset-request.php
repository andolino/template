<div class="cont-view-member">
	<div class="col-sm-10">
			<div class="row">
					<!-- heading -->
					<div class="col-sm-12 mb-3 none">
						<div class="navbar mb-0">
							<h6 class="mb-0"><i class="fas fa-user-cog"></i> REPAIR REQUEST</h6>
						</div>
					</div>
					<div class="col-sm-12 mt-2">
            <?php if(!empty($dataRequest)): ?>
            <div class="card">
							<div class="card-body">
								<form id="frm-request-repair-approval">
                <input type="hidden" name="id" value="<?php echo $dataRequest->tbl_asset_request_id; ?>">
                <div class="row w-100">
                <h6 class="mb-0 pl-3">REQUEST DETAILS</h6>
									<div class="col-lg-12 font-12 mt-3">
                    <div class="row">
                      <div class="col-lg-6">
                        <ul style="list-style-type: none;padding-left:0">
                          <li>TICKET NO. : <strong><?php echo str_pad($dataRequest->tbl_asset_request_id, 8, '0', STR_PAD_LEFT); ?></strong></li>
                          <li>REQUESTER : <strong><?php echo $dataRequest->screen_name; ?></strong></li>
                          <li>OFFICE : <strong><?php echo $dataRequest->office_name; ?></strong></li>
                          <li>ASSET CATEGORY : <?php echo $dataRequest->category_name; ?></li>
                          <li>QTY : <?php echo $dataRequest->qty; ?></li>
                        </ul>
                      </div>
                      <div class="col-lg-6">
                        <ul style="list-style-type: none;padding-left:0">
                          <li>DATE NEEDED : <strong><?php echo date('Y-m-d h:i:s', strtotime($dataRequest->date_need)); ?> </strong></li>
                          <li>RETURN DATE : <strong><?php echo date('Y-m-d h:i:s', strtotime($dataRequest->date_return)); ?> </strong> </li>
                          <li>LOCATION : <strong><?php echo $dataRequest->location_name; ?> </strong></li>
                          <li>PURPOSE : <?php echo $dataRequest->purpose; ?> </li>
                          <li>REMARKS : <?php echo $dataRequest->remarks; ?></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-12"></div>
                  <div class="col-lg-6">
                    <select class="custom-select form-control-sm font-12" name="tech_support_id" id="" required>
                      <option selected value="" hidden>Select Technician / Tech support</option>
                      <option value="" disabled></option>
                      <?php foreach($techSup as $row): ?>
                      <option value="<?php echo $row->users_id; ?>"><?php echo $row->screen_name; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-lg-12"></div>
                  <div class="warranty_cont none">
                    <?php if(strtotime($dataRequest->date_expire) >= strtotime(date('Y-m-d'))): ?>
                      <div class="col-lg-12">
                        <div class="alert alert-success font-12 mt-3">Coordinate with the Supplier: [<strong><?php echo ucfirst($dataRequest->supplier_name); ?></strong>] for the repair.</div>
                      </div>
                    <?php else: ?>
                      <div class="col-lg-12">
                        <div class="alert alert-warning font-12 mt-3">This will be check and repair with the assigned technician</div>
                      </div>
                      <div class="col-lg-12"></div>
                      <div class="col-lg-8">
                        <input type="date" name="repair_date" id="repair_date" placeholder="Select Repair Date" class="form-control form-control-sm font-12" required>
                      </div>
                    <?php endif; ?>
                    <div class="col-lg-12">
                      <textarea name="remarks" id="remarks" cols="30" rows="10" class="form-control form-control-sm font-12" placeholder="Remarks "></textarea>
                    </div>
                  </div>
                  <div class="col-lg-4 offset-lg-8">
                    <?php if($this->session->level == 2): ?>
                      <button type="button" id="btnCloseRepairRequest" class="btn btn-sm btn-success font-12 float-right mr-1">Close This Request</button>
                      <?php else: ?>
                      <?php if($dataRequest->status == 0): ?>
                        <button type="button" id="btnDisapproveRepairRequest" class="btn btn-sm btn-danger font-12 float-right">Disapproved</button>
                        <button type="button" id="btnApproveRepairRequest" class="btn btn-sm btn-success font-12 float-right mr-1">Approved</button>
                      <?php elseif($dataRequest->status == 1): ?>
                        <div class="alert alert-success font-12 text-center">Approved For Repair</div>
                      <?php elseif($dataRequest->status == 2): ?>
                        <div class="alert alert-danger font-12 text-center">Disapproved</div>
                      <?php endif; ?>
                    <?php endif; ?>

                  </div>

                  <!-- <pre>
                    <?php //print_r($dataRequest); ?>
                  </pre> -->
								</div>
                </form>
							</div>
						</div>
            <div class="card mt-2">
              <div class="card-body cont-parent-child-repair">
                <?php 
                  $status = [0 => 'Pending', 1 => 'For Repair', 2 => 'Disapproved', 3 =>'Cancelled', 4 => 'Closed'];
                ?>
                <h6>ASSET</h6>
                <table class="table font-12 w-100" id="tbl-asset-listdown" 
                  data-cat="<?php echo $dataRequest->asset_category_id; ?>" 
                  data-man="<?php echo $dataRequest->office_management_id; ?>" 
                  data-id="<?php echo $this->input->get('id'); ?>"
                  data-qty="<?php echo $dataRequest->qty; ?>">
                  <thead>
                    <tr>
                      <th scope="col">ASSET NAME</th>
                      <th scope="col">ASSET TAG </th>
                      <th scope="col">PROPERTY TAG</th>
                      <th scope="col">SERIAL NO</th>
                      <th scope="col">CUSTODIAN</th>
                      <th class="text-left" scope="col">ACTION</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      
                    </tr>          
                  </tbody>
                </table>
                <hr>
                <div id="sibling-cont-table" class="none">
                  <h6>SIBLING ASSET</h6>
                  <table class="table font-12 w-100"  id="tbl_sibling_listdown" data-type="siblings">
                    <thead>
                      <tr>
                        <th scope="col">ASSET NAME</th>
                        <th scope="col">ASSET TAG </th>
                        <th scope="col">PROPERTY TAG</th>
                        <th scope="col">SERIAL NO</th>
                        <th scope="col">CUSTODIAN</th>
                        <th class="text-left" scope="col">ACTION</th>
                      </tr>
                    </thead>
                    <tbody>
                    
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <?php endif; ?>

					</div>
					<!-- end -->
			</div>	
			<div class="line mt-3 mb-3 pt-0 pb-0"></div>
	</div>
</div>