<div class="cont-view-member">
	<div class="col-sm-10">
			<div class="row">
					<!-- heading -->
					<div class="col-sm-8 mb-3 none">
						<div class="navbar mb-0">
							<h6 class="mb-0"><i class="fas fa-user-cog"></i> REPAIR REQUEST</h6>
						</div>
					</div>
					<div class="col-sm-8 mt-2">
            <?php if(!empty($dataRequest)): ?>
            <div class="card">
							<div class="card-body">
								<form id="frm-request-repair-approval">
                <input type="hidden" name="id" value="<?php echo $dataRequest->id; ?>">
                <div class="row w-100">
                <h6 class="mb-0 pl-3">REPAIR REQUEST</h6>
									<div class="col-lg-12 font-12 mt-3">
                    <div class="row">
                      <div class="col-lg-6">
                        <ul style="list-style-type: none;padding-left:0">
                          <li>REQUEST NO. : <strong><?php echo str_pad($dataRequest->id, 8, '0', STR_PAD_LEFT); ?></strong></li>
                          <li>REQUESTER : <strong><?php echo $dataRequest->requestor_name; ?></strong></li>
                          <li>LOCATION: <strong><?php echo $dataRequest->location_name; ?></strong></li>
                          <li>ADDRESS: <strong><?php echo $dataRequest->address; ?></strong></li>
                          <li>REPAIR FILE: <?php echo $dataRequest->file_upload == '' ? '' : '[<a href="'.base_url().'assets/image/uploads/'.$dataRequest->file_upload.'" class="text-info" download> Download Attachment </a>]'; ?></li>
                        </ul>
                      </div>
                      <div class="col-lg-6">
                        <label for="">PICTURE</label>
                        <div class="row">
                        <?php echo $dataRequest->image_upload == '' ? '' : '<div class="col-xs-4 pl-3"><img src="'.base_url().'assets/image/uploads/'.$dataRequest->image_upload.'" width="250" class="img-thumbnail"></div>'; ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-12"></div>
                  <div class="col-lg-6">
                    <label for="" class="font-12">DESCRIPTION OF THE PROBLEM</label>
                    <p class="font-12"><strong><?php echo $dataRequest->problem_desc; ?></strong></p>
                  </div>
                  <div class="col-lg-6">
                    <label for="" class="font-12">REMARKS</label>
                    <p class="font-12"><strong><?php echo $dataRequest->remarks; ?></strong></p>
                  </div>
                  <div class="col-lg-6 font-12">
                    <ul style="list-style-type: none;padding-left:0">
                      <li>WARRANTY PERIOD: <strong><?php echo $dataRequest->warranty_months; ?> Months</strong></li>
                      <li>DATE EXPIRATION: <strong><?php echo date('F j, Y', strtotime($dataRequest->date_expire)); ?></strong> </li>
                      <li>UNDER WARRANTY: <?php echo strtotime($dataRequest->date_expire) >= strtotime(date('Y-m-d')) ? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-times text-danger"></i>'; ?> </li>
                    </ul>
                    
                  </div>
                  <div class="col-lg-12"></div>
                  <div class="col-lg-6">
                    <?php if($this->session->level == 2): ?>
                      <?php if($dataRequest->status == 1): ?>
                        <ul style="list-style-type: none;padding-left:0;" class="font-12">
                          <li>REPAIRED DATE. : <?php echo $dataRequest->repair_date == '' ? '--' : date('F j, Y', strtotime($dataRequest->repair_date));  ?></li>
                          <li>STATUS : <strong>FOR REPAIR</strong></li>
                          <li>NOTES: <br> <strong><?php echo $dataRequest->tech_notes; ?></strong> [ <strong><a href="#" id="addNotesTechSupport" data-id="<?php echo $dataRequest->id; ?>" class="text-info"><?php echo $dataRequest->tech_notes==''?'ADD NOTES':'UPDATE NOTES'; ?></a></strong> ]</li>
                        </ul>
                      <?php endif; ?>

                    <?php else: ?>
                    <!-- <select class="custom-select form-control-sm font-12" name="tech_support_id" id="select-tech-support" required>
                      <option selected value="" hidden>Select Technician / Tech support</option>
                      <option value="" disabled></option>
                      <?php //foreach($techSup as $row): ?>
                      <option value="<?php //echo $row->users_id; ?>"><?php //echo $row->screen_name; ?></option>
                      <?php //endforeach; ?>
                    </select> -->
                    <?php endif; ?>
                  </div>
                  <div class="col-lg-12"></div>
                  <div class="warranty_cont">
                    <?php if(strtotime($dataRequest->date_expire) >= strtotime(date('Y-m-d'))): ?>
                      <div class="col-lg-12">
                        <div class="alert alert-success font-12 mt-3">Coordinate with the Supplier: [<strong><?php echo ucfirst($dataRequest->supplier_name); ?></strong>] for the repair.</div>
                      </div>
                    <?php else: ?>
                      <div class="col-lg-12">
                        <select class="custom-select form-control-sm font-12" name="tech_support_id" id="select-tech-support" required>
                          <option selected value="" hidden>Select Technician / Tech support</option>
                          <option value="" disabled></option>
                          <?php foreach($techSup as $row): ?>
                          <option value="<?php echo $row->users_id; ?>"><?php echo $row->screen_name; ?></option>
                          <?php endforeach; ?>
                        </select>
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
                <h4>PARENT ASSET</h4>
                <div class="row">
                  <div class="col-12" style="overflow-x: scroll;">
                    <table class="table font-12 w-100" id="" data-status="1">
                    <thead>
                      <tr>
                        <th scope="col">ASSET NAME</th>
                        <th scope="col">ASSET CATEGORY </th>
                        <th scope="col">ASSET TAG </th>
                        <th scope="col">PROPERTY TAG</th>
                        <th scope="col">SERIAL NO</th>
                        <th scope="col">REMARKS</th>
                        <th scope="col">STATUS</th>
                        <th scope="col">ACTION</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><?php echo $dataRequest->asset_name; ?></td>
                        <td><?php echo $dataRequest->asset_category; ?></td>
                        <td><?php echo $dataRequest->asset_tag; ?></td>
                        <td><?php echo $dataRequest->property_tag; ?></td>
                        <td><?php echo $dataRequest->serial; ?></td>
                        <td><?php echo $dataRequest->remarks; ?></td>
                        <td><?php echo $status[$dataRequest->status]; ?></td>
                        <td></td>
                        <td></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                </div>
                <h4>CHILD ASSET</h4>
                <!-- <pre>
                    <?php //print_r($childAsset); ?>
                </pre> -->
                <div class="row">
                  <div class="col-12" style="overflow-x: scroll;">
                    <table class="table font-12 w-100"  id="" data-status="1">
                      <thead>
                        <tr>
                          <th scope="col">ASSET NAME</th>
                          <th scope="col">ASSET CATEGORY </th>
                          <th scope="col">ASSET TAG </th>
                          <th scope="col">PROPERTY TAG</th>
                          <th scope="col">SERIAL NO</th>
                          <th scope="col">REMARKS</th>
                          <th scope="col">STATUS</th>
                          <th scope="col">ACTION</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php foreach($childAsset as $row): ?>
                        <tr>
                          <td><?php echo $row->name; ?></td>
                          <td><?php echo $row->asset_category_name; ?></td>
                          <td><?php echo $row->asset_tag; ?></td>
                          <td><?php echo $row->property_tag; ?></td>
                          <td><?php echo $row->serial; ?></td>
                          <td><?php $dataRequest->remarks; ?></td>
                          <td><?php echo $status[$dataRequest->status]; ?></td>
                          <td><?php //echo $row-> ?></td>
                          <td></td>
                        </tr>
                      <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
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