<div class="row w-100">
  <div class="col-5 mb-3">
    <!-- <button type="button" class="btn btn-default btn-md rounded-0 font-12" id="loadPage" data-badge-head="CREATE ASSET" data-link="add-asset" data-ind="" data-cls="cont-add-member"><i class="fas fa-list"></i> Create Asset</button> -->
    <!-- <button type="button" class="btn btn-default btn-md rounded-0 font-12" id="add-contribution-by-type"><i class="fas fa-user-plus"></i> Add Contribution</button>
    <button type="button" class="btn btn-default btn-md rounded-0 font-12" id="add-payments-by-type"><i class="fas fa-user-plus"></i> Add Loan Payments</button>
    <button type="button" class="btn btn-purple btn-md rounded-0 font-12" id="printMemberDocs"><i class="fas fa-print"></i> Print Docx</button> -->
  </div>
</div>
<div class="row w-100">
<div class="col-sm-10">

<nav class="pb-3">
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-link active font-12" id="nav-home-tab" data-toggle="tab" href="#repair-pending" role="tab" aria-controls="repair-pending" aria-selected="true">Pending</a>
    <a class="nav-link font-12" id="nav-profile-tab" data-toggle="tab" href="#repair-approved" role="tab" aria-controls="repair-approved" aria-selected="false">Approved</a>
    <a class="nav-link font-12" id="nav-contact-tab" data-toggle="tab" href="#repair-disapproved" role="tab" aria-controls="repair-disapproved" aria-selected="false">Disapproved</a>
  </div>
</nav>

<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="repair-pending" role="tabpanel" aria-labelledby="repair-pending-tab">
    <div class="row">
      <div class="col-sm-12">
        <table class="table font-12 w-100 condensed" id="tbl-request-repair-admin-pending" data-status="0">
          <thead>
            <tr>
              <th scope="col">ASSET NAME</th>
              <th scope="col">ASSET TAG </th>
              <th scope="col">PROPERTY TAG</th>
              <th scope="col">SERIAL NO</th>
              <th scope="col">REQUEST BY</th>
              <th scope="col">REQUEST DATE TIME</th>
              <th scope="col">ACTION</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="tab-pane fade" id="repair-approved" role="tabpanel" aria-labelledby="repair-approved-tab">
    <table class="table font-12 w-100" id="tbl-request-repair-approved" data-status="1">
      <thead>
        <tr>
          <th scope="col">REQUEST #</th>
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
  <div class="tab-pane fade" id="repair-disapproved" role="tabpanel" aria-labelledby="repair-disapproved-tab">
    <table class="table font-12 w-100" id="tbl-request-repair-disapproved" data-status="<?php //echo $status ?>">
      <thead>
        <tr>
          <th scope="col">REQUEST #</th>
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
</div>