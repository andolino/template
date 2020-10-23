<div class="cont-view-member row w-100 <?php echo !empty($is_admin) ? "" : "none"; ?>">
	<div class="offset-sm-11 col-sm-1 pl-5 text-right">
		<a href="javascript:void(0);" class="pr-2 pb-2" id="loadPage" data-link="tbl-asset" data-badge-head="ASSET LIST"
   								data-cls="cont-tbl-constituent" data-placement="top" data-toggle="tooltip" title="Back to List"><i class="fas fa-times"></i></a>
	</div>
	<div class="col-sm-12">
    <button type="button" 
            class="btn btn-default btn-md rounded-0 font-12 mb-3" 
            id="loadPage" 
            data-badge-head="CREATE CHILD ASSET FOR (<?php echo !empty($data) ? $data[0]->asset_name : ''; ?>)" 
            data-link="add-asset" 
            data-ind="<?php echo !empty($data) ? $data[0]->id : ''; ?>" 
            data-cls="cont-add-member"
            onclick="setTimeout(function(){$('a#loadPage').attr('data-badge-head', '<?php echo !empty($data) ? strtoupper($data[0]->asset_name) : ''; ?>')}, 1000)"><i class="fas fa-list"></i> Create Child Asset</button>
    <button type="button" 
            class="btn btn-c-success btn-md rounded-0 font-12 mb-3" 
            id="printChildAssetQr"><i class="fas fa-print"></i> Print QR</button>
    <button type="button" 
            class="btn btn-default btn-md rounded-0 font-12 mb-3" 
            id="loadPage" 
            data-link="tbl-asset" 
            data-badge-head="ASSET LIST"
   					data-cls="cont-tbl-constituent" 
             data-placement="top" 
             data-toggle="tooltip" 
             title="Back to List"><i class="fas fa-long-arrow-alt-left"></i> Back to Asset</button>
    
    
    <!-- <button type="button" class="btn btn-default btn-md rounded-0 font-12" id="add-contribution-by-type"><i class="fas fa-user-plus"></i> Add Contribution</button>
    <button type="button" class="btn btn-default btn-md rounded-0 font-12" id="add-payments-by-type"><i class="fas fa-user-plus"></i> Add Loan Payments</button> -->
    <table class="table font-12 w-100" id="tbl-child-asset-list" data-assetid="<?php echo !empty($data) ? $data[0]->id : ''; ?>" data-page="tbl-members">
      <thead>
        <tr>
          <th scope="col"><input type="checkbox" id="chk-const-list-tbl-all" name="chk-const-list-tbl-all"></th>
          <th scope="col">ASSET NAME</th>
          <th scope="col">ASSET TAG</th>
          <th scope="col">MODEL</th>
          <th scope="col">STATUS</th>
          <th scope="col">CUSTODIAN</th>
          <th scope="col">COMPANY</th>
          <th scope="col">PURCHASED DATE</th>
          <th scope="col">SUPPLIER</th>
          <th scope="col">ORDER NUMBER</th>
          <th scope="col">PURCHASED COST</th>
          <th scope="col">WARRANTY</th>
          <th scope="col">DEFAULT LOCATION</th>
          <th scope="col">ACTION</th>
        </tr>
      </thead>
      <tbody>
        
      </tbody>
    </table>
	</div>
</div>