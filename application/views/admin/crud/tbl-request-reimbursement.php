<div class="row w-100">
  <div class="col-5 mb-3">
    <!-- <button type="button" class="btn btn-default btn-md rounded-0 font-12" id="loadPage" data-badge-head="CREATE ASSET" data-link="add-asset" data-ind="" data-cls="cont-add-member"><i class="fas fa-list"></i> Create Asset</button> -->
    <!-- <button type="button" class="btn btn-default btn-md rounded-0 font-12" id="add-contribution-by-type"><i class="fas fa-user-plus"></i> Add Contribution</button>
    <button type="button" class="btn btn-default btn-md rounded-0 font-12" id="add-payments-by-type"><i class="fas fa-user-plus"></i> Add Loan Payments</button>
    <button type="button" class="btn btn-purple btn-md rounded-0 font-12" id="printMemberDocs"><i class="fas fa-print"></i> Print Docx</button> -->
  </div>
</div>
<div class="row w-100">
<div class="col-sm-12">

<nav class="pb-3">
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-link active font-12" id="nav-home-tab" onclick="setTimeout(function(){ tbl_reimbursement_asset_pending.draw(); },300)" data-toggle="tab" href="#reimbursement-pending" role="tab" aria-controls="reimbursement-pending" aria-selected="true">Pending</a>
    <a class="nav-link font-12" id="nav-profile-tab" onclick="setTimeout(function(){ tbl_reimbursement_asset_approved.draw(); },300)" data-toggle="tab" href="#reimbursement-approved" role="tab" aria-controls="reimbursement-approved" aria-selected="false">Approved</a>
    <a class="nav-link font-12" id="nav-contact-tab" onclick="setTimeout(function(){ tbl_reimbursement_asset_disapproved.draw(); },300)" data-toggle="tab" href="#reimbursement-disapproved" role="tab" aria-controls="reimbursement-disapproved" aria-selected="false">Disapproved</a>
    <a class="nav-link font-12" id="nav-contact-tab" data-toggle="tab" href="#reimbursement-disapproved" role="tab" aria-controls="reimbursement-disapproved" aria-selected="false">Cancelled</a>
  </div>
</nav>

<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="reimbursement-pending" role="tabpanel" aria-labelledby="repair-pending-tab">
    <div class="row">
      <div class="col-sm-12">
        <table class="table font-12 w-100" id="tbl-portal-reimbursement-pending" data-status="0" data-is-tech="no">
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
  <div class="tab-pane fade" id="reimbursement-approved" role="tabpanel" aria-labelledby="repair-approved-tab">
    <table class="table font-12 w-100" id="tbl-portal-reimbursement-approved" data-status="1" data-is-tech="no">
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
          <th scope="col">ACTION</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
  <div class="tab-pane fade" id="reimbursement-disapproved" role="tabpanel" aria-labelledby="repair-disapproved-tab">
    <table class="table font-12 w-100" id="tbl-portal-reimbursement-disapproved" data-status="2" data-is-tech="no">
      <thead>
      <tr>
          <th scope="col">REQUEST # </th>
          <th scope="col">PR No. </th>
          <th scope="col">File Date</th>
          <th scope="col">Type</th>
          <th scope="col">Description</th>
          <th scope="col">Amount</th>
          <th scope="col">Disapproved By</th>
          <th scope="col">Dispproved Date Time</th>
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