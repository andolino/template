<div class="row w-100">
  <div class="col-5 mb-3">
    <!-- <button type="button" class="btn btn-default btn-md rounded-0 font-12" id="loadPage" data-badge-head="CREATE ASSET" data-link="add-asset" data-ind="" data-cls="cont-add-member"><i class="fas fa-list"></i> Create Asset</button> -->
    <!-- <button type="button" class="btn btn-default btn-md rounded-0 font-12" id="add-contribution-by-type"><i class="fas fa-user-plus"></i> Add Contribution</button>
    <button type="button" class="btn btn-default btn-md rounded-0 font-12" id="add-payments-by-type"><i class="fas fa-user-plus"></i> Add Loan Payments</button>
    <!-- <button type="button" class="btn btn-purple btn-md rounded-0 font-12" id="printMemberDocs"><i class="fas fa-print"></i> Print Docx</button> -->
    <button type="button" class="btn btn-success btn-md rounded-0 font-12" id="add-portal-request"><i class="fas fa-plus"></i> Add Request</button>
  </div>
</div>
<div class="row w-100">
<div class="col-sm-12 pr-0">

<nav class="pb-3 pt-3 tbl-req-cont-8">
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-link active font-12" id="nav-home-tab" onclick="setTimeout(function(){ tbl_portal_asset_pending.draw(); },300)" data-toggle="tab" href="#portal-pending" role="tab" aria-controls="portal-pending" aria-selected="true">Pending</a>
    <a class="nav-link font-12" id="nav-profile-tab" onclick="setTimeout(function(){ tbl_portal_asset_approved.draw(); },300)" data-toggle="tab" href="#portal-approved" role="tab" aria-controls="portal-approved" aria-selected="false">Approved</a>
    <a class="nav-link font-12" id="nav-contact-tab" onclick="setTimeout(function(){ tbl_portal_asset_disapproved.draw(); },300)" data-toggle="tab" href="#portal-disapproved" role="tab" aria-controls="portal-disapproved" aria-selected="false">Disapproved</a>
    <a class="nav-link font-12" id="nav-contact-tab" onclick="setTimeout(function(){ tbl_portal_asset_cancelled.draw(); },300)" data-toggle="tab" href="#portal-cancelled" role="tab" aria-controls="portal-cancelled" aria-selected="false">Cancelled</a>
    <a class="nav-link font-12" id="nav-contact-tab" onclick="setTimeout(function(){ tbl_portal_asset_closed.draw(); },300)" data-toggle="tab" href="#portal-closed" role="tab" aria-controls="portal-closed" aria-selected="false">Closed</a>
  </div>
</nav>

<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active pt-3" id="portal-pending" role="tabpanel" aria-labelledby="repair-pending-tab">
    <div class="row">
      <div class="col-sm-12">
        <table class="table font-12 w-100 nowrap condensed" id="tbl-portal-pending" data-status="0">
          <thead>
            <tr>
              <th scope="col">REQUEST # </th>
              <th scope="col">ASSET CATEGORY </th>
              <th scope="col">QTY</th>
              <th scope="col">STATUS</th>
              <th scope="col">REQUEST DATE</th>
              <th scope="col">ACTION</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="tab-pane fade pt-3" id="portal-approved" role="tabpanel" aria-labelledby="repair-approved-tab">
    <table class="table font-12 w-100 nowrap condensed" id="tbl-portal-approved" data-status="1">
      <thead>
        <tr>
          <th scope="col">REQUEST #</th>
          <th scope="col">ASSET CATEGORY </th>
          <th scope="col">QTY</th>
          <th scope="col">STATUS</th>
          <th scope="col">APPROVED BY</th>
          <th scope="col">APPROVED DATE</th>
          <th scope="col">ACTION</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
  <div class="tab-pane fade pt-3" id="portal-disapproved" role="tabpanel" aria-labelledby="repair-disapproved-tab">
    <table class="table font-12 w-100 nowrap condensed" id="tbl-portal-disapproved" data-status="2">
      <thead>
        <tr>
          <th scope="col">REQUEST #</th>
          <th scope="col">ASSET CATEGORY </th>
          <th scope="col">QTY</th>
          <th scope="col">STATUS</th>
          <th scope="col">APPROVED BY</th>
          <th scope="col">APPROVED DATE</th>
          <th scope="col">ACTION</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
  <div class="tab-pane fade pt-3" id="portal-cancelled" role="tabpanel" aria-labelledby="repair-cancelled-tab">
    <table class="table font-12 w-100 nowrap condensed" id="tbl-portal-cancelled" data-status="3">
      <thead>
        <tr>
          <th scope="col">REQUEST #</th>
          <th scope="col">ASSET CATEGORY </th>
          <th scope="col">QTY</th>
          <th scope="col">STATUS</th>
          <th scope="col">CANCELLED BY</th>
          <th scope="col">CANCELLED DATE</th>
          <th scope="col">REMARKS</th>
          <th scope="col">ACTION</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
  <div class="tab-pane fade pt-3" id="portal-closed" role="tabpanel" aria-labelledby="repair-closed-tab">
    <table class="table font-12 w-100 nowrap condensed" id="tbl-portal-closed" data-status="4">
      <thead>
        <tr>
          <th scope="col">REQUEST #</th>
          <th scope="col">ASSET CATEGORY </th>
          <th scope="col">QTY</th>
          <th scope="col">STATUS</th>
          <th scope="col">DISAPPROVED BY</th>
          <th scope="col">DISAPPROVED DATE</th>
          <th scope="col">REMARKS</th>
          <th scope="col">ACTION</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
</div>

</div>
</div>


<div class="modal fade" id="modal-portal-add-request" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add Request</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frm-portal-request">
          <div class="form-group">
            <label for="location_id" class="font-12">Location</label>
            <select id="location_id" name="location_id" required>
              <option value=""></option>
              <?php foreach($location as $row): ?>
                <option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="asset_category_id" class="font-12">Asset Category</label>
            <select id="asset_category_id" class="asset_category_get_qty" name="asset_category_id" required>
              <option value=""></option>
              <?php foreach($asset_category as $row): ?>
                <option value="<?php echo $row->asset_category_id; ?>"><?php echo $row->name; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="qty" class="font-12">Quantity | Available : <span class="asset_available_lbl"></span> </label>
            <input type="text" class="form-control form-control-sm font-12" onchange="setDdispatchQuantity(this)" id="qty" name="qty" required>
          </div>
          <div class="form-group">
            <label for="dispatch_to" class="font-12">Dispatch To</label>
            <select id="dispatch_to" name="dispatch_to" required>
              <option value=""></option>
              <?php foreach($location as $row): ?>
                <option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <!-- <div class="form-group">
            <label for="other_location" class="font-12">Other Location</label>
            <input type="text" class="form-control form-control-sm font-12" id="other_location" name="other_location">
          </div> -->
          <div class="form-group">
            <label for="" class="font-12">Borrower</label>
            <input type="text" class="form-control form-control-sm font-12" id="" value="<?php echo $this->session->username; ?>" name="" readonly="" required>
            <input type="hidden" class="form-control form-control-sm" id="users_id" value="<?php echo $this->session->users_id; ?>" name="users_id">
          </div>
          <div class="form-group">
            <label for="date_need" class="font-12">Date Need</label>
            <input type="text" class="form-control form-control-sm font-12 pickerDate" id="date_need" value="" name="date_need">
          </div>
          <div class="form-group">
            <label for="date_return" class="font-12">Date Return</label>
            <input type="text" class="form-control form-control-sm font-12 pickerDate" id="date_return" value="" name="date_return">
          </div>
          <div class="form-group">
            <label for="purpose" class="font-12">Purpose</label>
            <textarea class="form-control form-control-sm font-12" id="purpose" name="purpose"></textarea>
          </div>
          <div class="form-group">
            <label for="remarks" class="font-12">Remarks</label>
            <textarea class="form-control form-control-sm font-12" id="remarks" name="remarks"></textarea>
            <input type="hidden" id="has_update">
          </div>
          <button type="submit" class="none" id="submit-frm"></button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" onclick="$('#submit-frm').trigger('click');" class="btn btn-primary btn-sm">Submit</button>
      </div>
    </div>
  </div>
</div>
