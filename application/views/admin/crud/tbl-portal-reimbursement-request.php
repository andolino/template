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
    <a class="nav-link active font-12" id="nav-home-tab" onclick="setTimeout(function(){ tbl_reimbursement_asset_pending.draw(); },300)" data-toggle="tab" href="#portal-pending" role="tab" aria-controls="portal-pending" aria-selected="true">Pending</a>
    <a class="nav-link font-12" id="nav-profile-tab" onclick="setTimeout(function(){ tbl_repair_asset_approved.draw(); },300)" data-toggle="tab" href="#portal-approved" role="tab" aria-controls="portal-approved" aria-selected="false">Approved</a>
    <a class="nav-link font-12" id="nav-contact-tab" onclick="setTimeout(function(){ tbl_repair_asset_disapproved.draw(); },300)" data-toggle="tab" href="#portal-disapproved" role="tab" aria-controls="portal-disapproved" aria-selected="false">Disapproved</a>
    <a class="nav-link font-12" id="nav-contact-tab" onclick="setTimeout(function(){ tbl_reimbursement_asset_cancelled.draw(); },300)" data-toggle="tab" href="#portal-cancelled" role="tab" aria-controls="portal-cancelled" aria-selected="false">Cancelled</a>
    <a class="nav-link font-12" id="nav-contact-tab" onclick="setTimeout(function(){ tbl_repair_asset_closed.draw(); },300)" data-toggle="tab" href="#portal-closed" role="tab" aria-controls="portal-closed" aria-selected="false">Closed</a>
  </div>
</nav>

<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active pt-3" id="portal-pending" role="tabpanel" aria-labelledby="repair-pending-tab">
    <div class="row">
      <div class="col-sm-12">
        <table class="table font-12 w-100 nowrap condensed" id="tbl-portal-reimbursement-pending" data-status="0" data-is-tech="no">
          <thead>
            <tr>
              <th scope="col">REQUEST # </th>
              <th scope="col">PR No. </th>
              <th scope="col">File Date</th>
              <th scope="col">Type</th>
              <th scope="col">Description</th>
              <th scope="col">Amount</th>
              <th scope="col">Request By</th>
              <th scope="col">Request Date Time</th>
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
    <table class="table font-12 w-100 nowrap condensed" id="tbl-portal-reimbursement-approved" data-status="1" data-is-tech="no">
      <thead>
        <tr>
          <th scope="col">REQUEST # </th>
          <th scope="col">PR No. </th>
          <th scope="col">File Date</th>
          <th scope="col">Type</th>
          <th scope="col">Description</th>
          <th scope="col">Amount</th>
          <th scope="col">Approved By</th>
          <th scope="col">Approved Date Time</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
  <div class="tab-pane fade pt-3" id="portal-disapproved" role="tabpanel" aria-labelledby="repair-disapproved-tab">
    <table class="table font-12 w-100 nowrap condensed" id="tbl-portal-reimbursement-disapproved" data-status="2" data-is-tech="no">
      <thead>
        <tr>
          <th scope="col">REQUEST # </th>
          <th scope="col">PR No. </th>
          <th scope="col">File Date</th>
          <th scope="col">Type</th>
          <th scope="col">Description</th>
          <th scope="col">Amount</th>
          <th scope="col">Approved By</th>
          <th scope="col">Approved Date Time</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
  <div class="tab-pane fade pt-3" id="portal-cancelled" role="tabpanel" aria-labelledby="repair-cancelled-tab">
    <table class="table font-12 w-100 nowrap condensed" id="tbl-portal-reimbursement-cancelled" data-status="3" data-is-tech="no">
      <thead>
        <tr>
          <th scope="col">REQUEST # </th>
          <th scope="col">PR No. </th>
          <th scope="col">File Date</th>
          <th scope="col">Type</th>
          <th scope="col">Description</th>
          <th scope="col">Amount</th>
          <th scope="col">Cancelled By</th>
          <th scope="col">Cancelled Date Time</th>
          <th scope="col">Remarks</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
  <div class="tab-pane fade pt-3" id="portal-closed" role="tabpanel" aria-labelledby="repair-closed-tab">
    <table class="table font-12 w-100 nowrap condensed" id="tbl-portal-reimbursement-closed" data-status="4" data-is-tech="no">
      <thead>
        <tr>
          <th scope="col">REQUEST #</th>
          <th scope="col">ASSET NAME </th>
          <th scope="col">ASSET TAG</th>
          <th scope="col">PROPERTY TAG</th>
          <th scope="col">SERIAL NO</th>
          <th scope="col">CLOSED BY</th>
          <th scope="col">CLOSED DATE</th>
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
        <form id="frm-reimbursement-request" enctype="multipart/form-data">
          <div class="form-group">
            <label for="office_management_id" class="font-12">Select Office</label>
            <!-- <pre>
              <?php //print_r($offices); ?>
            </pre> -->
            <select id="office_management_id" class="office_management_id" name="office_management_id" required>
              <option value=""></option>
              <?php foreach($offices as $row): ?>
                <option value="<?php echo $row->office_management_id; ?>"><?php echo $row->office_name; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="pn_no" class="font-12">PN No.</label>
            <input type="text" class="form-control form-control-sm font-12 pn_no" id="pn_no" name="pn_no">
          </div>
          <div class="form-group">
            <label for="date_filed" class="font-12">Date Filed</label>
            <input type="date" class="form-control form-control-sm font-12 date_filed" id="date_filed" name="date_filed" required>
          </div>
          <div class="form-group">
            <label for="reimbursement_type" class="font-12">Reimbursement Type</label>
            <select id="reimbursement_type" class="reimbursement_type custom-select custom-select-sm" name="reimbursement_type" required>
              <option value="" selected hidden></option>
              <option value="MEAL_EXPENSE">Meal Expense</option>
              <option value="TRAVEL_EXPENSE">Travel Expense</option>
              <option value="GAS_EXPENSE">Gas Expense</option>
            </select>
          </div>
          <div class="form-group">
            <label for="select_unit" class="font-12">Select Unit</label>
            <select id="select_unit" class="select_unit custom-select custom-select-sm font-12" name="select_unit" required>
              <option value="" selected hidden></option>
              <option value="PAX">Pax</option>
              <option value="PCS">Pcs</option>
            </select>
          </div>
          <div class="form-group">
            <label for="item_description" class="font-12">Item Description</label>
            <input type="text" class="form-control form-control-sm font-12 item_description" id="item_description" name="item_description">
          </div>
          <div class="form-group">
            <label for="qty" class="font-12">Qty</label>
            <input type="text" class="form-control form-control-sm font-12 qty" id="qty" onchange="$('#unit_cost').trigger('change');" value="0" name="qty">
          </div>
          <div class="form-group">
            <label for="unit_cost" class="font-12">Unit Cost</label>
            <input type="text" class="form-control form-control-sm font-12 isNum unit_cost" onchange="computeTotalCost(this);" id="unit_cost" name="unit_cost">
          </div>
          <div class="form-group">
            <label for="total_cost" class="font-12">Total Cost</label>
            <input type="text" class="form-control form-control-sm font-12 total_cost" id="total_cost" name="total_cost" readonly>
          </div>
          <div class="form-group">
            <label for="purpose" class="font-12">Purpose</label>
            <input type="text" class="form-control form-control-sm font-12 purpose" id="purpose" name="purpose">
          </div>
          <div class="form-group">
            <label for="link_ticket" class="font-12">Link Ticket</label>
            <select id="link_ticket" class="link_ticket custom-select custom-select-sm font-12" onchange="getRequestMods(this);" name="link_ticket" required>
              <option value="NONE" selected>None</option>
              <option value="DISPATCH_REQUEST">Dispatch Request</option>
              <option value="REPAIR_REQUEST">Repair Request</option>
            </select>
          </div>
          <div class="form-group cont-request-id none">
            
          </div>
          <div class="form-group">
            <label for="image_upload" class="font-12">Upload Attachment</label>
            <input type="file" class="form-control form-control-sm font-12" id="image_upload" value="" name="image_upload[]" multiple>
            <input type="hidden" id="has_update">
            <!-- <div class="alert alert-primary repair-upload-img none font-12 mt-2" role="alert"></div> -->
            <div class="alert alert-warning alert-dismissible repair-upload-img none fade show mt-2" role="alert">
              <span class="repair-upload-img-cont font-12 mt-1 image_upload"></span>
              <!-- <button type="button" class="close font-12 download-repair-request" aria-label="Close">
                <i class="fas fa-download"></i>
              </button> -->
            </div>
          </div>
          <div class="form-group">
            <label for="file_upload" class="font-12">Upload Receipt</label>
            <input type="file" class="form-control form-control-sm font-12" multiple="" id="file_upload" value="" name="file_upload[]">
            <div class="alert alert-primary repair-upload-docx file_upload none font-12 mt-2" role="alert"></div>
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
