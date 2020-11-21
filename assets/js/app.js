$(window).on('load', function(){
  //remove loading
  animateSingleIn('.custom-container', 'fadeInUp');
  animateSingleOut('.spinner-cont', 'fadeOut'); 
});

//datatable var array
var tbl_asset = [];
var tbl_asset_r = [];
var tbl_settings = [];
var tbl_users = [];
var tbl_companies = [];
var tbl_models = [];
var tbl_suppliers = [];
var tbl_locations = [];
var tbl_activity_logs = [];
var tbl_departments = [];
var tbl_asset_category = [];
var tbl_office = [];
var tbl_history_logs = [];
var tbl_request_repair_admin_pending = [];
var tbl_request_repair_admin_approved = [];
var tbl_request_repair_admin_disapproved = [];
var tbl_request_repair_admin_cancelled = [];
var tbl_request_repair_admin_closed = [];
var tbl_portal_asset_pending = [];
var tbl_portal_asset_approved = [];
var tbl_portal_asset_disapproved = [];
var tbl_portal_asset_cancelled = [];
var tbl_portal_asset_closed = [];
var tbl_repair_asset_pending = [];
var tbl_repair_asset_approved = [];
var tbl_repair_asset_disapproved = [];
var tbl_repair_asset_cancelled = [];
var tbl_repair_asset_closed = [];
var tbl_print_logs_transmittal = [];
var tbl_print_logs_gatepass = [];
var tbl_print_logs_checklist = [];
var tbl_print_logs_qrcodes = [];
var tbl_dispatch_request = [];
var tbl_asset_dtables = [];
var tbl_asset_siblings_dtables = [];

$(document).ready(function() {
  //init plugin
  $("body").tooltip({ selector: '[data-toggle=tooltip]' });
  initDateDefault();

  // setInterval(function(){
  //   if (!$('#tbl-asset-request').find('input[type="checkbox"]').is(':checked')) {
  //     tbl_asset_r.ajax.reload();
  //   } 
  //   tbl_activity_logs.ajax.reload();
  // }, 4000)

  //for numeric values input
  $(document).on("focusout", '.isNum', function(e){
    $(this).val(isNaN(parseFloat($(this).val().replace(',',''))) ? '0' : number_format($(this).val().replace(',', '')));
  });
  $(document).on("change, keyup", '.isNum', function(e){
    var currentInput = $(this).val();
    var fixedInput = currentInput.replace(/[A-Za-z!@#$%^&*()]/g, '');
    $(this).val(fixedInput);
  });
  

  /**
    *
    * DATE INIT
    * 
    */
  // var dd = new Date();
  // var sd = new Date(dd.getFullYear(), dd.getMonth(), 1);
  // var ed = new Date(dd.getFullYear(), dd.getMonth() + 1, 0);

  //load data-page
  $(document).on('click', '#loadPage', function(event) {
    var link                 = $(this).attr('data-link');
    var d                    = $(this).attr('data-ind');
    var dataBadgeHead        = $(this).attr('data-badge-head');
    var acls                 = $(this).attr('data-cls');
    var asset_or_child_asset = $(this).attr('data-type');
    var curr_badge = $('#badge-heading').html();
    // $(this).tooltip('hide');
    $('.custom-container').html('');
    $.get(baseURL + link, { 'data' : d, 'is_child_asset' : asset_or_child_asset, 'curr_badge': curr_badge }, function(data, textStatus, xhr) {
      $('.custom-container').html(data);
      $(".pickerDate").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true
      });
      
      $( "div.picture-cont" )
      .mouseenter(function() {
        $('.upload-ctrl').removeClass('none');
      })
      .mouseleave(function() {
        $('.upload-ctrl').addClass('none');
      });
      $('#badge-heading').html(dataBadgeHead);
      $('#payee_select').trigger('change');

      animateSingleIn('.'+acls, 'fadeInUp');
      
      animateSingleIn('.cont-tbl-constituent', 'fadeIn');
      $('#siblings_of').select2({
        width: '100%',
      });
      //datatables for single page
      //datatables for page reload
      initMembersDataTables();
      initMembersChildDataTables();
      initActivityLogsDataTables();
      initAssetRequestDataTables();
      initUsersDataTables();
      initCompaniesDataTables();
      initModelsDataTables();
      initSupplierDataTables();
      initLocationsDataTables();
      initDepartmentsDataTables();
      initAssetCategoryDataTables();
      initOfficeDataTables();
      initPortalRequestDataTables();
      initRepairRequestDataTables();
      initAdminRepairRequestDataTables();
      initPrintLogsDataTables();
      initDispatchRequestDataTables();
      initTblAssetDataTables();

    });    
  });

  //init datatable list
  initMembersDataTables();
  initMembersChildDataTables();
  initUsersDataTables();
  initAssetRequestDataTables();
  initActivityLogsDataTables();
  initDepartmentsDataTables();
  initAssetCategoryDataTables();
  initOfficeDataTables();
  initHistoryLogsDataTables();
  initPortalRequestDataTables();
  initRepairRequestDataTables();
  initAdminRepairRequestDataTables();
  initPrintLogsDataTables();
  initDispatchRequestDataTables();
  initTblAssetDataTables();

  //============================> BEGIN
  $(document).on('submit', '#frm-create-asset', function(e) {
    e.preventDefault();
    e.stopImmediatePropagation();
    $('#checkout_user_id').prop('disabled', false);
    $('#office_management_id').prop('disabled', false);
    $('#departments_id').prop('disabled', false);
    $('#location_id').prop('disabled', false);
    var frm = new FormData(this);
    $.ajax({
      url      : 'save-asset',
      type     : 'POST',
      data     : frm,
      processData:false,
      contentType:false,
      cache:false,
      async:false,
      dataType: 'json',
      success  : function(res) {
        // console.log(typeof res.length);
        console.log(res);
        // typeof res.length === 'undefined'
        if (!res.hasOwnProperty('id')) {
          $.each(res, function(index, el) {
            if ($('#'+index).parent('div').find('div.invalid-feedback').length == 0) {
              $('#'+index).parent('div').append('<div class="invalid-feedback">'+el+'</div>').show();
              $('#'+index).parent('div').find('div.invalid-feedback').show();
            } else {
              $('#'+index).parent('div').find('div.invalid-feedback').html(el).show();
            }
            $(document).on('change input', '#'+index, function(){
              $('#'+index).parent('div').find('div.invalid-feedback').hide();
            });
          });
          $('#checkout_user_id').prop('disabled', true);
          $('#office_management_id').prop('disabled', true);
          $('#departments_id').prop('disabled', true);
          $('#location_id').prop('disabled', true);
        } else {
          Swal.fire(  
            'Success!',
            'You successfully saved!',
            'success'
          );
          $('<input>').attr({
              type: 'hidden',
              id: 'has_update',
              name: ' ',
              value: res.id
          }).appendTo('#frm-create-asset');
          console.log($('#has_update').val());
          // if ($('#has_update').val() == '') {
          //   var id = res.id;
          //   var encRes = getEncKey(id);
          //   var encId = $.parseJSON(encRes);
          //   $.ajax({
          //     type: "GET",
          //     url: "https://mbyongson.qrd.by/api/short?key=273d88623b2ea85055e3515c0f63af1b&url="+baseURL+"get-assets/"+encId.key,
          //     data: {},
          //     dataType: "JSON",
          //     success: function (res) {
          //       console.log(res);
          //       $('.display-qr').attr('src', res.result.qr);
          //       animateSingleIn('.display-qr', 'fadeIn');
          //     }
          //   });
          // }
          // $('#frm-create-asset').trigger('reset');
          $('a[data-link="tbl-asset"]').trigger('click');
        }
      }
    });
  });

  $(document).on('click', '#remove-lgu-const-list', function(e) {
    e.preventDefault();
    var id = $(this).attr('data-id');
    customSwal(
      'btn btn-success', 
      'btn btn-danger mr-2', 
      'Yes', 
      'Wait', 
      ['', 'Are you sure you want to delete this assets?', 'warning'], 
      function(){
      $.post('delete-asset', {'id': id}, function(data, textStatus, xhr) {
        Swal.fire(
          'Alright!',
          'Successfully Deleted!',
          'success'
        );
        initMembersDataTables();
      });
      
    }, function(){
      console.log('Fail');
    });
  });
  
  $(document).on('click', '#remove-child-asset', function(e) {
    e.preventDefault();
    var id = $(this).attr('data-id');
    customSwal(
      'btn btn-success', 
      'btn btn-danger mr-2', 
      'Yes', 
      'Wait', 
      ['', 'Are you sure you want to delete this child assets?', 'warning'], 
      function(){
      $.post('delete-child-asset', {'id': id}, function(data, textStatus, xhr) {
        Swal.fire(
          'Alright!',
          'Successfully Deleted!',
          'success'
        );
        tbl_asset.ajax.reload();
      });
      
    }, function(){
      console.log('Fail');
    });
  });

  $(document).on("change", "#upload-file-dp", function() {
    if (typeof FileReader == "undefined") {
      Swal.fire(
        'Oopps!',
        "Your browser doesn't support HTML5, Please upgrade your browser",
        'info'
      );
    } else {
        var container = $(".file_prev");
        //remove all previous selected files
        container.empty();

        //create instance of FileReader
        var reader = new FileReader();
        reader.onload = function(e) {
            $("<img />", {
                src: e.target.result
            }).appendTo(container);
        };
        reader.readAsDataURL($(this)[0].files[0]);
    }
});

  $(document).on('click', '#apply_par_custodian', function (e) {
    if ($(this).is(':checked')) {
      $.ajax({
        type: "POST",
        url: "get-parent-custodian",
        data: { "asset_id" : $(this).val() },
        dataType: "JSON",
        success: function (res) {
          $('#checkout_user_id').val(res.checkout_user_id).trigger('change').prop('disabled', true);
          $('#office_management_id').val(res.office_management_id).trigger('change').prop('disabled', true);
          $('#departments_id').val(res.departments_id).trigger('change').prop('disabled', true);
          $('#location_id').val(res.location_id).trigger('change').prop('disabled', true);
        }
      });
    } else {
      $('#checkout_user_id').val('').trigger('change').prop('disabled', false);
      $('#office_management_id').val('').trigger('change').prop('disabled', false);
      $('#departments_id').val('').trigger('change').prop('disabled', false);
      $('#location_id').val('').trigger('change').prop('disabled', false);
    }
  });

  // $(document).on('change', '#upload-file-dp', function() {
  //   $('.spinner-cont').removeClass('none');
  //   $('#frm-upload-dp').trigger('submit');
  // });

  $(document).on('click', '#printAssetAssetReport', function() {
    // var d = [];
    // $.each($('.chk-const-list-tbl'), function (i, el) { 
    //   if ($(this).is(':checked')) { d[i] = $(el).val(); }
    // });
    // var myNewD = d.filter(function (el) { return el != null && el != ""; });
    $('#custom-modal').modal('show');
    $.get("get-asset-print-frm", {}, function (data, textStatus, jqXHR) {
      $('#custom-modal .modal-content').html(data);
    });
    // console.log(myNewD);
    
  });
  
  $(document).on('click', '#printCheckListReport', function() {
    // var d = [];
    // $.each($('.chk-const-list-tbl'), function (i, el) { 
    //   if ($(this).is(':checked')) { d[i] = $(el).val(); }
    // });
    // var myNewD = d.filter(function (el) { return el != null && el != ""; });
    $('#custom-modal').modal('show');
    $.get("get-checklist-print-frm", {}, function (data, textStatus, jqXHR) {
      $('#custom-modal .modal-content').html(data);
    });
    // console.log(myNewD);
    
  });
  
  $(document).on('click', '#printTransmitalSummaryReport', function() {
    // var d = [];
    // $.each($('.chk-const-list-tbl'), function (i, el) { 
    //   if ($(this).is(':checked')) { d[i] = $(el).val(); }
    // });
    // var myNewD = d.filter(function (el) { return el != null && el != ""; });
    $('#custom-modal').modal('show');
    $.get("get-transmittal-summary-print-frm", {}, function (data, textStatus, jqXHR) {
      $('#custom-modal .modal-content').html(data);
    });
    // console.log(myNewD);
    
  });

  $(document).on('submit', '#frm-print-asset-report', function (e) {
    e.preventDefault();
    var frm = $(this).serialize();
    $.ajax({
      type: "POST",
      url: "get-print-asset-report",
      data: frm,
      dataType: "JSON",
      success: function (res) {
        window.open('print-asset-report/'+res.data);
      }
    });
  });
  
  $(document).on('click', '#printTransmitalSlip', function (e) {
    if ($('#custodian').val() == '') {
      Swal.fire(
        'Oopps!',
        'Please select custodian',
        'info'
      );
    } else {
      $.ajax({
        type: "POST",
        url: "get-print-asset-report",
        data: {},
        dataType: "JSON",
        success: function (res) {
          window.open('print-transmital-slip/'+res.data+'/'+$('#date_generated').val());
        }
      });
    }
  });
  
  $(document).on('click', '#printCheckList', function (e) {
    // if ($('#custodian').val() == '') {
      // Swal.fire(
      //   'Oopps!',
      //   'Please select custodian',
      //   'info'
      // );
    // } else {
      var locationId = $('#location_id').val();
      var status = ($('#ready-to-deploy').is(':checked') ? 1 : 0);
      $.ajax({
        type: "POST",
        url: "get-print-checklist-report",
        data: { 'location_id' : locationId, 'status': status },
        dataType: "JSON",
        success: function (res) {
          window.open('print-checklist-slip/'+res.data);//+res.data+'/'+$('#date_generated').val());
        }
      });
    // }
  });
  
  $(document).on('click', '#printTransmitalSumm', function (e) {
    // if ($('#custodian').val() == '') {
      // Swal.fire(
      //   'Oopps!',
      //   'Please select custodian',
      //   'info'
      // );
    // } else {
      var locationId = $('#location_id').val();
      var status = ($('#ready-to-deploy').is(':checked') ? 1 : 0);
      $.ajax({
        type: "POST",
        url: "get-print-transmital-summ-report",
        data: { 'location_id' : locationId, 'status': status },
        dataType: "JSON",
        success: function (res) {
          window.open('print-transmital-summ-slip/'+res.data);//+res.data+'/'+$('#date_generated').val());
        }
      });
    // }
  });

  $(document).on('change', '#select-tech-support', function () {
    animateSingleIn('.warranty_cont', 'fadeIn');
  });

  $(document).on('click', '#btnApproveRepairRequest', function (e) {
    e.preventDefault();
    var frm = $('#frm-request-repair-approval').serializeArray();
    customSwal(
      'btn btn-success', 
      'btn btn-danger mr-2', 
      'Yes', 
      'Wait', 
      ['', 'Approve Request?', 'question'], 
      function(){
        frm.push({name: 'is_approved', value: 'ap'});
        $.ajax({
          type: "POST",
          url: "submit-approval-repair-request",
          data: frm,
          dataType: "json",
          success: function (res) {
            Swal.fire(
              res.msg.param1,
              res.msg.param2,
              res.msg.param3
            );
            $.get("get-repair-parent-child-asset", { 'id': res.repair_request_id }, function (data, textStatus, jqXHR) {
              $('.cont-parent-child-repair').html(data);
            });
            // window.location.reload();
          }
        });
      }, function(){
        // console.log('Fail');
    });
  });
  
  $(document).on('click', '#btnApproveDispatchRequest', function (e) {
    e.preventDefault();
    var frm = $('#frm-request-dispatch-approval').serializeArray();
    customSwal(
      'btn btn-success', 
      'btn btn-danger mr-2', 
      'Yes', 
      'Wait', 
      ['', 'Approve Request?', 'question'], 
      function(){
        frm.push({name: 'is_approved', value: 'ap'});
        $.ajax({
          type: "POST",
          url: "submit-approval-repair-request",
          data: frm,
          dataType: "json",
          success: function (res) {
            Swal.fire(
              res.msg.param1,
              res.msg.param2,
              res.msg.param3
            );
            $.get("get-repair-parent-child-asset", { 'id': res.repair_request_id }, function (data, textStatus, jqXHR) {
              $('.cont-parent-child-repair').html(data);
            });
            // window.location.reload();
          }
        });
      }, function(){
        // console.log('Fail');
    });
  });
  
  $(document).on('click', '#btnDisapproveRepairRequest', function (e) {
    e.preventDefault();
    var remarks = $('#remarks').val();
    if (remarks == '') {
      Swal.fire(
        'Oopps!',
        'Please input remarks!',
        'warning'
      );
    } else {
      var frm = $('#frm-request-repair-approval').serializeArray();
      customSwal(
        'btn btn-success', 
        'btn btn-danger mr-2', 
        'Yes', 
        'Wait', 
        ['', 'Approve Request?', 'question'], 
        function(){
          frm.push({name: 'is_approved', value: 'dp'});
          $.ajax({
            type: "POST",
            url: "submit-approval-repair-request",
            data: frm,
            dataType: "json",
            success: function (res) {
              // console.log(res);
              Swal.fire(
                res.msg.param1,
                res.msg.param2,
                res.msg.param3
              );
              $.get("get-repair-parent-child-asset", { 'id': res.repair_request_id }, function (data, textStatus, jqXHR) {
                $('.cont-parent-child-repair').html(data);
              });
              // window.location.reload();
            }
          });
        }, function(){
          // console.log('Fail');
      });
      
    }
  });
  
  $(document).on('click', '#btnCloseRepairRequest', function (e) {
    e.preventDefault();
    var remarks = $('#remarks').val();
    var frm = $('#frm-request-repair-approval').serializeArray();
      customSwal(
        'btn btn-success', 
        'btn btn-danger mr-2', 
        'Yes', 
        'Wait', 
        ['', 'Close this Request?', 'question'], 
        function(){
          // frm.push({name: 'is_approved', value: 'dp'});
          $.ajax({
            type: "POST",
            url: "submit-close-repair-request",
            data: frm,
            dataType: "json",
            success: function (res) {
              // console.log(res);
              Swal.fire(
                res.param1,
                res.param2,
                res.param3
              );
              $.get("get-repair-parent-child-asset", { 'id': res.repair_request_id }, function (data, textStatus, jqXHR) {
                $('.cont-parent-child-repair').html(data);
              });
              // window.location.reload();
            }
          });
        }, function(){
          // console.log('Fail');
      });
  });
  
  $(document).on('click', '#addNotesTechSupport', function () {
    var id = $(this).attr('data-id');
    $('#custom-modal').modal('show'); 
    $.ajax({
      type: "POST",
      url: "show-add-tech-notes",
      data: { 'id' : id },
      success: function (res) {
        $('#custom-modal .modal-content').html(res);
      }
    });
  });

  $(document).on('submit', '#frm-add-notes-tech', function (e) {
    e.preventDefault();
    var frm = $(this).serialize();
    $.post("save-tech-notes", frm,
      function (data, textStatus, jqXHR) {
        Swal.fire(
          data.param1,
          data.param2,
          data.param3
        );
        setTimeout(function(){
          window.location.reload();
        }, 1000)
      },
      "JSON"
    );
  });
  
  $(document).on('click', '#printAssetQr', function() {
    var d = [];
    $.each($('.chk-const-list-tbl'), function (i, el) { 
      if ($(this).is(':checked')) { d[i] = $(el).val(); }
    });
    var myNewD = d.filter(function (el) { return el != null && el != ""; });
    // console.log(myNewD);
    $.ajax({
      type: "POST",
      url: "get-chkd-asset",
      data: {'data': myNewD},
      dataType: "JSON",
      success: function (res) {
        window.open('print-asset-qr/'+res.data);
      }
    });
  });
  
  $(document).on('click', '#printChildAssetQr', function() {
    var d = [];
    $.each($('.chk-const-list-tbl'), function (i, el) { 
      if ($(this).is(':checked')) { d[i] = $(el).val(); }
    });
    var myNewD = d.filter(function (el) { return el != null && el != ""; });
    // console.log(myNewD);
    $.ajax({
      type: "POST",
      url: "get-chkd-child-asset",
      data: {'data': myNewD},
      dataType: "JSON",
      success: function (res) {
        window.open('print-child-asset-qr/'+res.data);
      }
    });
  });

  // $(document).one('click', '.child-asset-appendbadge', function (e) {
  //   // var id = $(this).attr('data-ind');
  //   // $('a[data-ind="'+id+'"]').attr('data-badge-head', $("#badge-heading").html());
  //   // console.log($("#badge-heading").html());
  //   // setTimeout(function(){
  //     $('a#loadPage').attr('data-badge-head', $("#badge-heading").html());
  //   // }, 500);
  // });
  
  $(document).on('click', '#showMapGeo', function() {
    $('#custom-modal').modal('show');
    var lat = $(this).attr('data-lat');
    var lng = $(this).attr('data-long');
    $.ajax({
      type: "POST",
      url: "show-map-scanned",
      data: {
        'lat' : lat,
        'lng' : lng
      },
      success: function (res) {
        $('#custom-modal .modal-content').html(res);
      }
    });
  });
  
  $(document).on('click', '#chk-const-list-tbl-all', function(e) {
    // var rows = tbl_asset.rows({ 'search': 'applied' }).nodes();
    var table = $(e.target).closest('table');
    $('td input:checkbox',table).prop('checked',this.checked);
    if ($(this).is(':checked')) {
      $('#printAssetQr').removeAttr('disabled');
    } else {
      $('#printAssetQr').prop('disabled', true);
    }
  });
  
  var dTlChkl = []; 
  $(document).on('click', '#chk-const-list-tbl', function(e) {
    $.each($('.chk-const-list-tbl'), function(i, el) {
      dTlChkl[i]=$(el).is(':checked').toString();
    });
    if ($.inArray('true', dTlChkl) !== -1) {
      $('#printAssetQr').removeAttr('disabled');
    } else {
      $('#printAssetQr').prop('disabled', true);
    }
    console.log(dTlChkl);
  });

  $(document).on('click', '#showScannedUser', function() {
    $('#custom-modal').modal('show');
    var code = $(this).attr('data-code');
    var lat = $(this).attr('data-lat');
    var lng = $(this).attr('data-long');
    $.ajax({
      type: "POST",
      url: "show-scanned-user",
      data: {
        'code' : code,
        'lat' : lat,
        'lng' : lng
      },
      success: function (res) {
        $('#custom-modal .modal-content').html(res);
      }
    });
  });

  $(document).on('submit', '#frm-upload-dp', function(e) {
    e.preventDefault();
    var frm = new FormData(this);
    frm.append('lgu-cons-id', $(this).find('input[type="hidden"]').val());
    
    $.ajax({
      url:'upload-dp',
      type:"post",
      data: frm,
      processData:false,
      contentType:false,
      cache:false,
      async:false,
      dataType: 'json',
      success: function(data){
        if (data.success) {
          Swal.fire(
            'Success!',
            'Picture Successfully Updated!',
            'success'
          );
        } else {
          Swal.fire(
            'Oopps!',
            'Looks like there was an error encountered!',
            'warning'
          );
        }
        // alert("Upload Image Successful.");
        $('#lgu-captured-image').attr('src', baseURL + 'assets/image/uploads/' + data.file_name);
        animateSingleOut('.spinner-cont', 'fadeOut');
      }
    });
  });

  $(document).on('submit', '#frm-change-password', function(e) {
    e.preventDefault();
    var frm = $(this).serialize();
    $.ajax({
      url:'submit-admin-new-password',
      type:"post",
      data: frm,
      dataType: 'json',
      success: function(data){
        if (data.msg == 'failed') {
          if (data.hasOwnProperty('password')) {
            $('.msg-password').html('<div class="alert alert-danger font-12" role="alert">'+data.password+'</div>');
            animateSingleIn('.msg-password', 'fadeIn');
          }
          if (data.hasOwnProperty('new_password')) {
            $('.msg_new_password').html('<div class="alert alert-danger font-12" role="alert">'+data.new_password+'</div>');
            animateSingleIn('.msg_new_password', 'fadeIn');
          }
          setTimeout(() => {
            animateSingleOut('.msg-password', 'fadeOut');
            animateSingleOut('.msg_new_password', 'fadeOut');
          }, 5000);
        }
        
        if (data.msg == 'success') {
          Swal.fire(
            'Success!',
            'Password Successfully Updated!',
            'success'
          );
        } 
        $('#frm-change-password').trigger('change');
      }
    });
  });

  $(document).on("change", "#img-asset", function(){
    readUrlImg(this);
  });
  
  $(document).on('click', '#add-portal-request', function(){
    $('#modal-portal-add-request').modal('show');
    $('#office_management_id').select2({
      width: '100%',
      dropdownParent: $("#modal-portal-add-request")
    });
    $('#asset_category_id').select2({
      width: '100%',
      dropdownParent: $("#modal-portal-add-request")
    });
    $('#serial').select2({
      width: '100%',
      dropdownParent: $("#modal-portal-add-request")
    });
    $('#location_id').select2({
      width: '100%',
      dropdownParent: $("#modal-portal-add-request")
    });
  });

  $(document).on('change', '.asset_category_id', function () {
    var asset_category_id = $(this).val();
    $.ajax({
      type: "POST",
      url: "get-select-asset-rep",
      data: { "asset_category_id": asset_category_id },
      success: function (res) {
        $('.asset-details-container').html(res);
        $('#serial').select2({
          width: '100%',
        });
      }
    });
  });
  
  $(document).on('change', '.select-repair-asset-tag', function () {
    var serial_no = $(this).val();
    $.ajax({
      type: "POST",
      url: "get-tbl-asset-row",
      data: { "serial_no": serial_no },
      dataType: 'json',
      success: function (res) {
        if (res.hasOwnProperty('html')) {
          $('.multiple-child-asset').html(res.html);
          $('#multiple-child-select').select2({
            width: '100%',
            dropdownParent: $("#modal-portal-add-request")
          });
        } else {
          $('.multiple-child-asset').html('<div class="alert alert-warning font-12" role="alert">No Child Asset</div>');
        }
        $('#asset_tag').val(res.asset_tag);
        $('#property_tag').val(res.property_tag);
        $('#custodian').val(res.checkout_user_id);

      }
    });
  });

  $(document).on('submit', '#frm-repair-request', function (e) {
    e.preventDefault();
    var frm = new FormData(this);
    customSwal(
      'btn btn-success', 
      'btn btn-danger mr-2', 
      'Yes', 
      'Wait', 
      ['', 'Finalize Request?', 'question'], 
      function(){
        $.ajax({
          url      : 'save-repair-request',
          type     : 'POST',
          context  : this,
          data     : frm,
          processData:false,
          contentType:false,
          cache:false,
          async:false,
          dataType: 'json',
          success:function(res){
            Swal.fire(
              res.param1,
              res.param2,
              res.param3
            );
            tbl_repair_asset_pending.ajax.reload();
            tbl_repair_asset_approved.ajax.reload();
            tbl_repair_asset_disapproved.ajax.reload();
            tbl_repair_asset_cancelled.ajax.reload();
            tbl_repair_asset_closed.ajax.reload();
            $('#modal-portal-add-request').modal('hide');
          }
        });
      }, function(){
        console.log('Fail');
    });
  });

  $(document).on('submit', '#frm-portal-request', function (e) {
    var frm = $(this).serialize();
    e.preventDefault();
      customSwal(
          'btn btn-success', 
          'btn btn-danger mr-2', 
          'Yes', 
          'Wait', 
          ['', 'Finalize Request?', 'question'], 
          function(){
            $.ajax({
              url      : 'save-portal-request',
              type     : 'POST',
              dataType : 'JSON',
              context  : this,
              data     : frm,
              success:function(res){
                Swal.fire(
                  res.param1,
                  res.param2,
                  res.param3
                );
                tbl_portal_asset_pending.ajax.reload();
                tbl_portal_asset_approved.ajax.reload();
                tbl_portal_asset_disapproved.ajax.reload();
                tbl_portal_asset_cancelled.ajax.reload();
                tbl_portal_asset_closed.ajax.reload();
                $('#modal-portal-add-request').modal('hide');
              }
            });
          }, function(){
            console.log('Fail');
      });
  });

  $(document).on('click', '#cancel-portal-request', function () {
      var id = $(this).attr('data-id');
      customSwal(
        'btn btn-success', 
        'btn btn-danger mr-2', 
        'Yes', 
        'Wait', 
        ['', 'Cancel Request?', 'question'], 
        function(){
          $.ajax({
            url      : 'cancel-portal-request',
            type     : 'POST',
            context  : this,
            data     : {
              'tbl'   : 'tbl_asset_repair_request',
              'field' : 'id', 
              'id'    : id
            },
            success:function(res){
              tbl_portal_asset_pending.ajax.reload();
              tbl_repair_asset_pending.ajax.reload();
            }
          });
        }, function(){
          console.log('Fail');
    });
  });

  $(document).on('click', '#printDispatchSummary', function() {
    var myNewD = 1;
    $.ajax({
      type: "POST",
      url: "get-chkd-summary-dispatch",
      data: {'data': myNewD},
      dataType: "JSON",
      success: function (res) {
        window.open('print-summary-dispatch/'+res.data);
      }
    });
  });

  $(document).on('click', '#viewSib', function () {
    var id = $(this).attr('data-id');
    initTblAssetSiblingsDataTables(id);
    animateSingleIn('#sibling-cont-table', 'fadeIn');
  });

  $(document).on('click', '#viewChild', function () {
    var id = $(this).attr('data-id');
    initTblAssetChildsDataTables(id);
    animateSingleIn('#child-cont-table', 'fadeIn');
  });

  
  //dyon
  $(document).on('click', '#printGatePassForm', function (e) {
    var locationId = $('#location_id').val();
    var personnel_id = $('#person_id').val();
    var plate_no     = $('#plate_no').val();
    var gatepass_date     = $('#gatepass_date').val();
    var qty_dispatch     = $('#qty_dispatch').val();
    var status = ($('#ready-to-deploy').is(':checked') ? 1 : 0);

    $.ajax({
      type: "POST",
      url: "get-print-gatepass-report",
      data: { 
          'location_id' : locationId, 
          'personnel_id' : personnel_id, 
          'plate_no' : plate_no, 
          'status' : status,
          'qty_dispatch' : qty_dispatch,
          'gatepass_date' : gatepass_date
         },
      dataType: "JSON",
      success: function (res) {
        window.open('print-gatepass-slip/'+res.data+'/'+res.params);//+res.data+'/'+$('#date_generated').val());
      }
    });
    // }
  });

  $(document).on('click', '#printGatePass', function() {
    $('#custom-modal').modal('show');
    $.get("get-gatepass-print-frm", {}, function (data, textStatus, jqXHR) {
      $('#custom-modal .modal-content').html(data);
    });
  });

});//ready


/* FUNCTIONS */
// animate single element in
function animateSingleIn(element, animation, focus = null) {
  $(element).addClass('animated ' + animation).removeClass('none');
  setTimeout(function() {
      $(element).removeClass('animated ' + animation);
      focus != null ? $(focus).focus() : null;
  }, 1000);
}

// animate single element out
function animateSingleOut(element, animation) {
  $(element).addClass('animated ' + animation);
  setTimeout(function() {
      $(element).removeClass('animated ' + animation).addClass('none');
  }, 1000);
}

function doUploadDb(){
  $('input[name=upload-file-dp]').trigger('click');
}

function customSwal(confrmBtn, canclBtn, confrmTxt, canclTxt, headingArr=array(), funCalback, failCalback){
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: confrmBtn,
      cancelButton: canclBtn
    },
    buttonsStyling: false
  });

  swalWithBootstrapButtons.fire({
    title             : headingArr[0],
    text              : headingArr[1],
    icon              : headingArr[2],
    showCancelButton  : true,
    confirmButtonText : confrmTxt,
    cancelButtonText  : canclTxt,
    reverseButtons    : true
  }).then((result) => {
    if (result.value) {
      funCalback();
    } else if (
      /* Read more about handling dismissals below */
      result.dismiss === Swal.DismissReason.cancel
    ) {
      failCalback();
    }
  });
}

// format numbers to currency format
function number_format(amount) {
  var formatted_amount = parseFloat(amount)
          .toFixed(2)
          .toString()
          .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  return formatted_amount;
}

//init datatables =====================================================>
function initMembersDataTables(){
  var myObjKeyLguConst = {};
  $('#tbl-asset-list').DataTable().clear().destroy();
  tbl_asset  = $("#tbl-asset-list").DataTable({
    searchHighlight : true,
    lengthMenu      : [[5, 10, 20, 30, 50, -1], [5, 10, 20, 30, 50, 'All']],
    language: {
        search                 : '_INPUT_',
        searchPlaceholder      : 'Search...',
        lengthMenu             : '_MENU_'       
    },
    "order": [[1, 'asc']],
    columnDefs                 : [
      { 
        orderable            : false, 
        targets              : [ 0, 13 ]
      },
      { 
        visible              : false, 
        targets              : [ 9, 10, 11, 12 ]
      },
    ],
    "serverSide"               : true,
    // "processing"               : true,
    "ajax"                     : {
        "url"                  : 'server-tbl-asset',
        "type"                 : 'POST',
        "data"                 : { 
                                "page" : $("#tbl-asset-list").attr('data-page')
                              }
    },
    'createdRow'            : function(row, data, dataIndex) {
      var dataRowAttrIndex = ['data-lgu-const-id'];
      var dataRowAttrValue = [0];
        for (var i = 0; i < dataRowAttrIndex.length; i++) {
          myObjKeyLguConst[dataRowAttrIndex[i]] = data[dataRowAttrValue[i]];
        }
        $(row).attr(myObjKeyLguConst);
    }
  });
}

function initMembersChildDataTables(){
  var myObjKeyLguConst = {};
  $('#tbl-child-asset-list').DataTable().clear().destroy();
  tbl_asset  = $("#tbl-child-asset-list").DataTable({
    searchHighlight : true,
    lengthMenu      : [[5, 10, 20, 30, 50, -1], [5, 10, 20, 30, 50, 'All']],
    language: {
        search                 : '_INPUT_',
        searchPlaceholder      : 'Search...',
        lengthMenu             : '_MENU_'       
    },
    "order": [[1, 'asc']],
    columnDefs                 : [
      { 
        orderable            : false, 
        targets              : [0,13]
      },
      { 
        visible              : false, 
        targets              : [3,9]
      },
    ],
    "serverSide"               : true,
    // "processing"               : true,
    "ajax"                     : {
        "url"                  : 'server-tbl-asset-child',
        "type"                 : 'POST',
        "data"                 : { 
                                "page" : $("#tbl-child-asset-list").attr('data-page'),
                                "tbl_asset_id" : $("#tbl-child-asset-list").attr('data-assetid')
                              }
    },
    'createdRow'            : function(row, data, dataIndex) {
      var dataRowAttrIndex = ['data-lgu-const-id'];
      var dataRowAttrValue = [0];
        for (var i = 0; i < dataRowAttrIndex.length; i++) {
          myObjKeyLguConst[dataRowAttrIndex[i]] = data[dataRowAttrValue[i]];
        }
        $(row).attr(myObjKeyLguConst);
    }
  });
}

function initAssetRequestDataTables(){
  var myObjKeyLguConst = {};
  $('#tbl-asset-request').DataTable().clear().destroy();
  tbl_asset_r  = $("#tbl-asset-request").DataTable({
    searchHighlight : true,
    lengthMenu      : [[5, 10, 20, 30, 50, -1], [5, 10, 20, 30, 50, 'All']],
    language: {
        search                 : '_INPUT_',
        searchPlaceholder      : 'Search...',
        lengthMenu             : '_MENU_'       
    },
    columnDefs                 : [
      { 
        orderable            : false, 
        targets              : [0,1,2,3,4,5,6,7,8,9,10,11] 
      }
    ],
    "serverSide"               : true,
    // "processing"               : true,
    "ajax"                     : {
        "url"                  : 'server-tbl-asset-request',
        "type"                 : 'POST',
        "data"                 : { 
                                "status" : $("#tbl-asset-request").attr('data-status')
                              }
    },
    'createdRow'            : function(row, data, dataIndex) {
      var dataRowAttrIndex = ['data-lgu-const-id'];
      var dataRowAttrValue = [0];
        for (var i = 0; i < dataRowAttrIndex.length; i++) {
          myObjKeyLguConst[dataRowAttrIndex[i]] = data[dataRowAttrValue[i]];
        }
        $(row).attr(myObjKeyLguConst);
    }
  });
}

//ADMIN REPAIR
function initAdminRepairRequestDataTables(){
  var myObjKeyLguConst = {};
  $('#tbl-request-repair-admin-pending').DataTable().clear().destroy();
  tbl_request_repair_admin_pending  = $("#tbl-request-repair-admin-pending").DataTable({
    searchHighlight : true,
    lengthMenu      : [[5, 10, 20, 30, 50, -1], [5, 10, 20, 30, 50, 'All']],
    language: {
        search                 : '_INPUT_',
        searchPlaceholder      : 'Search...',
        lengthMenu             : '_MENU_'       
    },
    "order": [[0, 'desc']],
    columnDefs                 : [
      { 
        orderable            : false, 
        targets              : [1,2,3,4,5,6] 
      }
    ],
    "scrollX": true,
    "bInfo": false,
    "serverSide"               : true,
    // "processing"               : true,
    "ajax"                     : {
        "url"                  : 'server-tbl-admin-repair-pending-request',
        "type"                 : 'POST',
        "data"                 : { 
                                "status" : $("#tbl-request-repair-admin-pending").attr('data-status')
                              }
    },
    'createdRow'            : function(row, data, dataIndex) {
      // var dataRowAttrIndex = ['data-lgu-const-id'];
      // var dataRowAttrValue = [0];
      //   for (var i = 0; i < dataRowAttrIndex.length; i++) {
      //     myObjKeyLguConst[dataRowAttrIndex[i]] = data[dataRowAttrValue[i]];
      //   }
      //   $(row).attr(myObjKeyLguConst);
    }
  });

  $('#tbl-request-repair-approved').DataTable().clear().destroy();
  tbl_request_repair_admin_approved  = $("#tbl-request-repair-approved").DataTable({
    searchHighlight : true,
    lengthMenu      : [[5, 10, 20, 30, 50, -1], [5, 10, 20, 30, 50, 'All']],
    language: {
        search                 : '_INPUT_',
        searchPlaceholder      : 'Search...',
        lengthMenu             : '_MENU_'       
    },
    "order": [[0, 'desc']],
    columnDefs                 : [
      { 
        orderable            : false, 
        targets              : [1,2,3,4,5,6] 
      }
    ],
    "scrollX": true,
    "bInfo": false,
    "serverSide"               : true,
    // "processing"               : true,
    "ajax"                     : {
        "url"                  : 'server-tbl-admin-repair-pending-request',
        "type"                 : 'POST',
        "data"                 : { 
                                "status" : $("#tbl-request-repair-approved").attr('data-status')
                              }
    },
    'createdRow'            : function(row, data, dataIndex) {
      // var dataRowAttrIndex = ['data-lgu-const-id'];
      // var dataRowAttrValue = [0];
      //   for (var i = 0; i < dataRowAttrIndex.length; i++) {
      //     myObjKeyLguConst[dataRowAttrIndex[i]] = data[dataRowAttrValue[i]];
      //   }
      //   $(row).attr(myObjKeyLguConst);
    }
  });

  $('#tbl-request-repair-disapproved').DataTable().clear().destroy();
  tbl_request_repair_admin_disapproved  = $("#tbl-request-repair-disapproved").DataTable({
    searchHighlight : true,
    lengthMenu      : [[5, 10, 20, 30, 50, -1], [5, 10, 20, 30, 50, 'All']],
    language: {
        search                 : '_INPUT_',
        searchPlaceholder      : 'Search...',
        lengthMenu             : '_MENU_'       
    },
    "order": [[0, 'desc']],
    columnDefs                 : [
      { 
        orderable            : false, 
        targets              : [1,2,3,4,5,6] 
      }
    ],
    "scrollX": true,
    "bInfo": false,
    "serverSide"               : true,
    // "processing"               : true,
    "ajax"                     : {
        "url"                  : 'server-tbl-admin-repair-pending-request',
        "type"                 : 'POST',
        "data"                 : { 
                                "status" : $("#tbl-request-repair-disapproved").attr('data-status')
                              }
    },
    'createdRow'            : function(row, data, dataIndex) {
      // var dataRowAttrIndex = ['data-lgu-const-id'];
      // var dataRowAttrValue = [0];
      //   for (var i = 0; i < dataRowAttrIndex.length; i++) {
      //     myObjKeyLguConst[dataRowAttrIndex[i]] = data[dataRowAttrValue[i]];
      //   }
      //   $(row).attr(myObjKeyLguConst);
    }
  });
  setInterval(function() {
    tbl_request_repair_admin_pending.rows().invalidate().draw(); 
    tbl_request_repair_admin_approved.rows().invalidate().draw(); 
    tbl_request_repair_admin_disapproved.rows().invalidate().draw(); 
  }, 1000 );
  
}

//DISPATCH
function initPortalRequestDataTables(){
  var myObjKeyLguConst = {};
  $('#tbl-portal-pending').DataTable().clear().destroy();
  tbl_portal_asset_pending  = $("#tbl-portal-pending").DataTable({
    searchHighlight : true,
    lengthMenu      : [[5, 10, 20, 30, 50, -1], [5, 10, 20, 30, 50, 'All']],
    language: {
        search                 : '_INPUT_',
        searchPlaceholder      : 'Search...',
        lengthMenu             : '_MENU_'       
    },
    "order": [[0, 'desc']],
    columnDefs                 : [
      { 
        orderable            : false, 
        targets              : [1,2,3,4,5] 
      }
    ],
    "scrollX": true,
    "bInfo": false,
    "serverSide"               : true,
    "processing"               : true,
    "ajax"                     : {
        "url"                  : 'server-tbl-portal-request',
        "type"                 : 'POST',
        "data"                 : { 
                                "status" : $("#tbl-portal-pending").attr('data-status')
                              }
    },
    'createdRow'            : function(row, data, dataIndex) {
      // var dataRowAttrIndex = ['data-lgu-const-id'];
      // var dataRowAttrValue = [0];
      //   for (var i = 0; i < dataRowAttrIndex.length; i++) {
      //     myObjKeyLguConst[dataRowAttrIndex[i]] = data[dataRowAttrValue[i]];
      //   }
      //   $(row).attr(myObjKeyLguConst);
    }
  });
  
  $('#tbl-portal-approved').DataTable().clear().destroy();
  tbl_portal_asset_approved  = $("#tbl-portal-approved").DataTable({
    searchHighlight : true,
    lengthMenu      : [[5, 10, 20, 30, 50, -1], [5, 10, 20, 30, 50, 'All']],
    language: {
        search                 : '_INPUT_',
        searchPlaceholder      : 'Search...',
        lengthMenu             : '_MENU_'       
    },
    "order": [[0, 'desc']],
    columnDefs                 : [
      { 
        orderable            : false, 
        targets              : [1,2,3,4,5,6] 
      }
    ],
    "scrollX": true,
    "bInfo": false,
    "serverSide"               : true,
    "processing"               : true,
    "ajax"                     : {
        "url"                  : 'server-tbl-portal-request',
        "type"                 : 'POST',
        "data"                 : { 
                                "status" : $("#tbl-portal-approved").attr('data-status')
                              }
    },
    'createdRow'            : function(row, data, dataIndex) {
      // var dataRowAttrIndex = ['data-lgu-const-id'];
      // var dataRowAttrValue = [0];
      //   for (var i = 0; i < dataRowAttrIndex.length; i++) {
      //     myObjKeyLguConst[dataRowAttrIndex[i]] = data[dataRowAttrValue[i]];
      //   }
      //   $(row).attr(myObjKeyLguConst);
    }
  });
  
  $('#tbl-portal-disapproved').DataTable().clear().destroy();
  tbl_portal_asset_disapproved  = $("#tbl-portal-disapproved").DataTable({
    searchHighlight : true,
    lengthMenu      : [[5, 10, 20, 30, 50, -1], [5, 10, 20, 30, 50, 'All']],
    language: {
        search                 : '_INPUT_',
        searchPlaceholder      : 'Search...',
        lengthMenu             : '_MENU_'       
    },
    "order": [[0, 'desc']],
    columnDefs                 : [
      { 
        orderable            : false, 
        targets              : [1,2,3,4,5,6] 
      }
    ],
    "scrollX": true,
    "bInfo": false,
    "serverSide"               : true,
    "processing"               : true,
    "ajax"                     : {
        "url"                  : 'server-tbl-portal-request',
        "type"                 : 'POST',
        "data"                 : { 
                                "status" : $("#tbl-portal-disapproved").attr('data-status')
                              }
    },
    'createdRow'            : function(row, data, dataIndex) {
      // var dataRowAttrIndex = ['data-lgu-const-id'];
      // var dataRowAttrValue = [0];
      //   for (var i = 0; i < dataRowAttrIndex.length; i++) {
      //     myObjKeyLguConst[dataRowAttrIndex[i]] = data[dataRowAttrValue[i]];
      //   }
      //   $(row).attr(myObjKeyLguConst);
    }
  });
  
  $('#tbl-portal-cancelled').DataTable().clear().destroy();
  tbl_portal_asset_cancelled  = $("#tbl-portal-cancelled").DataTable({
    searchHighlight : true,
    lengthMenu      : [[5, 10, 20, 30, 50, -1], [5, 10, 20, 30, 50, 'All']],
    language: {
        search                 : '_INPUT_',
        searchPlaceholder      : 'Search...',
        lengthMenu             : '_MENU_'       
    },
    "order": [[0, 'desc']],
    columnDefs                 : [
      { 
        orderable            : false, 
        targets              : [1,2,3,4,5,6,7] 
      }
    ],
    "scrollX": true,
    "bInfo": false,
    "serverSide"               : true,
    "processing"               : true,
    "ajax"                     : {
        "url"                  : 'server-tbl-portal-request',
        "type"                 : 'POST',
        "data"                 : { 
                                "status" : $("#tbl-portal-cancelled").attr('data-status')
                              }
    },
    'createdRow'            : function(row, data, dataIndex) {
      // var dataRowAttrIndex = ['data-lgu-const-id'];
      // var dataRowAttrValue = [0];
      //   for (var i = 0; i < dataRowAttrIndex.length; i++) {
      //     myObjKeyLguConst[dataRowAttrIndex[i]] = data[dataRowAttrValue[i]];
      //   }
      //   $(row).attr(myObjKeyLguConst);
    }
  });

  $('#tbl-portal-closed').DataTable().clear().destroy();
  tbl_portal_asset_closed  = $("#tbl-portal-closed").DataTable({
    searchHighlight : true,
    lengthMenu      : [[5, 10, 20, 30, 50, -1], [5, 10, 20, 30, 50, 'All']],
    language: {
        search                 : '_INPUT_',
        searchPlaceholder      : 'Search...',
        lengthMenu             : '_MENU_'       
    },
    "order": [[0, 'desc']],
    columnDefs                 : [
      { 
        orderable            : false, 
        targets              : [1,2,3,4,5,6,7] 
      }
    ],
    "scrollX": true,
    "bInfo": false,
    "serverSide"               : true,
    "processing"               : true,
    "ajax"                     : {
        "url"                  : 'server-tbl-portal-request',
        "type"                 : 'POST',
        "data"                 : { 
                                "status" : $("#tbl-portal-closed").attr('data-status')
                              }
    },
    'createdRow'            : function(row, data, dataIndex) {
      // var dataRowAttrIndex = ['data-lgu-const-id'];
      // var dataRowAttrValue = [0];
      //   for (var i = 0; i < dataRowAttrIndex.length; i++) {
      //     myObjKeyLguConst[dataRowAttrIndex[i]] = data[dataRowAttrValue[i]];
      //   }
      //   $(row).attr(myObjKeyLguConst);
    }
  });
}

//REPAIR
function initRepairRequestDataTables(){
  var myObjKeyLguConst = {};
  $('#tbl-portal-repair-pending').DataTable().clear().destroy();
  tbl_repair_asset_pending  = $("#tbl-portal-repair-pending").DataTable({
    searchHighlight : true,
    lengthMenu      : [[5, 10, 20, 30, 50, -1], [5, 10, 20, 30, 50, 'All']],
    language: {
        search                 : '_INPUT_',
        searchPlaceholder      : 'Search...',
        lengthMenu             : '_MENU_'       
    },
    "order": [[0, 'desc']],
    columnDefs                 : [
      { 
        orderable            : false, 
        targets              : [1,2,3,4,5] 
      }
    ],
    "scrollX": true,
    "bInfo": false,
    "serverSide"               : true,
    "processing"               : true,
    "ajax"                     : {
        "url"                  : 'server-tbl-repair-request',
        "type"                 : 'POST',
        "data"                 : { 
                                "status" : $("#tbl-portal-repair-pending").attr('data-status'),
                                "is_tech" : $("#tbl-portal-repair-pending").attr('data-is-tech')
                              }
    },
    'createdRow'            : function(row, data, dataIndex) {
      // var dataRowAttrIndex = ['data-lgu-const-id'];
      // var dataRowAttrValue = [0];
      //   for (var i = 0; i < dataRowAttrIndex.length; i++) {
      //     myObjKeyLguConst[dataRowAttrIndex[i]] = data[dataRowAttrValue[i]];
      //   }
      //   $(row).attr(myObjKeyLguConst);
    }
  });
  
  $('#tbl-portal-repair-approved').DataTable().clear().destroy();
  tbl_repair_asset_approved  = $("#tbl-portal-repair-approved").DataTable({
    searchHighlight : true,
    lengthMenu      : [[5, 10, 20, 30, 50, -1], [5, 10, 20, 30, 50, 'All']],
    language: {
        search                 : '_INPUT_',
        searchPlaceholder      : 'Search...',
        lengthMenu             : '_MENU_'       
    },
    "order": [[0, 'desc']],
    columnDefs                 : [
      { 
        orderable            : false, 
        targets              : [1,2,3,4,5,6] 
      }
    ],
    "scrollX": true,
    "bInfo": false,
    "serverSide"               : true,
    "processing"               : true,
    "ajax"                     : {
        "url"                  : 'server-tbl-repair-request',
        "type"                 : 'POST',
        "data"                 : { 
                                "status" : $("#tbl-portal-repair-approved").attr('data-status'),
                                "is_tech" : $("#tbl-portal-repair-pending").attr('data-is-tech')
                              }
    },
    'createdRow'            : function(row, data, dataIndex) {
      // var dataRowAttrIndex = ['data-lgu-const-id'];
      // var dataRowAttrValue = [0];
      //   for (var i = 0; i < dataRowAttrIndex.length; i++) {
      //     myObjKeyLguConst[dataRowAttrIndex[i]] = data[dataRowAttrValue[i]];
      //   }
      //   $(row).attr(myObjKeyLguConst);
    }
  });
  
  $('#tbl-portal-repair-disapproved').DataTable().clear().destroy();
  tbl_repair_asset_disapproved  = $("#tbl-portal-repair-disapproved").DataTable({
    searchHighlight : true,
    lengthMenu      : [[5, 10, 20, 30, 50, -1], [5, 10, 20, 30, 50, 'All']],
    language: {
        search                 : '_INPUT_',
        searchPlaceholder      : 'Search...',
        lengthMenu             : '_MENU_'       
    },
    "order": [[0, 'desc']],
    columnDefs                 : [
      { 
        orderable            : false, 
        targets              : [1,2,3,4,5] 
      }
    ],
    "scrollX": true,
    "bInfo": false,
    "serverSide"               : true,
    "processing"               : true,
    "ajax"                     : {
        "url"                  : 'server-tbl-repair-request',
        "type"                 : 'POST',
        "data"                 : { 
                                "status" : $("#tbl-portal-repair-disapproved").attr('data-status'),
                                "is_tech" : $("#tbl-portal-repair-pending").attr('data-is-tech')
                              }
    },
    'createdRow'            : function(row, data, dataIndex) {
      // var dataRowAttrIndex = ['data-lgu-const-id'];
      // var dataRowAttrValue = [0];
      //   for (var i = 0; i < dataRowAttrIndex.length; i++) {
      //     myObjKeyLguConst[dataRowAttrIndex[i]] = data[dataRowAttrValue[i]];
      //   }
      //   $(row).attr(myObjKeyLguConst);
    }
  });

  $('#tbl-portal-repair-cancelled').DataTable().clear().destroy();
  tbl_repair_asset_cancelled  = $("#tbl-portal-repair-cancelled").DataTable({
    searchHighlight : true,
    lengthMenu      : [[5, 10, 20, 30, 50, -1], [5, 10, 20, 30, 50, 'All']],
    language: {
        search                 : '_INPUT_',
        searchPlaceholder      : 'Search...',
        lengthMenu             : '_MENU_'       
    },
    "order": [[0, 'desc']],
    columnDefs                 : [
      { 
        orderable            : false, 
        targets              : [1,2,3,4,5,6,7] 
      }
    ],
    "scrollX": true,
    "bInfo": false,
    "serverSide"               : true,
    "processing"               : true,
    "ajax"                     : {
        "url"                  : 'server-tbl-repair-request',
        "type"                 : 'POST',
        "data"                 : { 
                                "status" : $("#tbl-portal-repair-cancelled").attr('data-status'),
                                "is_tech" : $("#tbl-portal-repair-pending").attr('data-is-tech')
                              }
    },
    'createdRow'            : function(row, data, dataIndex) {
      // var dataRowAttrIndex = ['data-lgu-const-id'];
      // var dataRowAttrValue = [0];
      //   for (var i = 0; i < dataRowAttrIndex.length; i++) {
      //     myObjKeyLguConst[dataRowAttrIndex[i]] = data[dataRowAttrValue[i]];
      //   }
      //   $(row).attr(myObjKeyLguConst);
    }
  });

  $('#tbl-portal-repair-closed').DataTable().clear().destroy();
  tbl_repair_asset_closed  = $("#tbl-portal-repair-closed").DataTable({
    searchHighlight : true,
    lengthMenu      : [[5, 10, 20, 30, 50, -1], [5, 10, 20, 30, 50, 'All']],
    language: {
        search                 : '_INPUT_',
        searchPlaceholder      : 'Search...',
        lengthMenu             : '_MENU_'       
    },
    "order": [[0, 'desc']],
    columnDefs                 : [
      { 
        orderable            : false, 
        targets              : [1,2,3,4,5] 
      }
    ],
    "scrollX": true,
    "bInfo": false,
    "serverSide"               : true,
    "processing"               : true,
    "ajax"                     : {
        "url"                  : 'server-tbl-repair-request',
        "type"                 : 'POST',
        "data"                 : { 
                                "status" : $("#tbl-portal-repair-closed").attr('data-status'),
                                "is_tech" : $("#tbl-portal-repair-pending").attr('data-is-tech')
                              }
    },
    'createdRow'            : function(row, data, dataIndex) {
      // var dataRowAttrIndex = ['data-lgu-const-id'];
      // var dataRowAttrValue = [0];
      //   for (var i = 0; i < dataRowAttrIndex.length; i++) {
      //     myObjKeyLguConst[dataRowAttrIndex[i]] = data[dataRowAttrValue[i]];
      //   }
      //   $(row).attr(myObjKeyLguConst);
    }
  });
}



function initActivityLogsDataTables(){
  var myObjKeyLguConst = {};
  $('#tbl-activity-logs').DataTable().clear().destroy();
  tbl_activity_logs  = $("#tbl-activity-logs").DataTable({
    searchHighlight : true,
    lengthMenu      : [[30, 50, -1], [30, 50, 'All']],
    language: {
        search                 : '_INPUT_',
        searchPlaceholder      : 'Search...',
        lengthMenu             : '_MENU_'       
    },
    columnDefs                 : [
      { 
        orderable            : false, 
        targets              : [0,1,2,3,4,5,6] 
      }
    ],
    "serverSide"               : true,
    // "processing"               : true,
    "ajax"                     : {
        "url"                  : 'server-tbl-activity-logs',
        "type"                 : 'POST',
        "data"                 : { 
                                "status" : $("#tbl-activity-logs").attr('data-status')
                              }
    },
    'createdRow'            : function(row, data, dataIndex) {
      var dataRowAttrIndex = ['data-lgu-const-id'];
      var dataRowAttrValue = [0];
        for (var i = 0; i < dataRowAttrIndex.length; i++) {
          myObjKeyLguConst[dataRowAttrIndex[i]] = data[dataRowAttrValue[i]];
        }
        $(row).attr(myObjKeyLguConst);
    }
  });
}

function initPrintLogsDataTables(){
  var myObjKeyLguConst = {};

  //transmittal
  $('#tbl-print-logs-transmittal').DataTable().clear().destroy();
  tbl_print_logs_transmittal  = $("#tbl-print-logs-transmittal").DataTable({
    searchHighlight : true,
    lengthMenu      : [[30, 50, -1], [30, 50, 'All']],
    language: {
        search                 : '_INPUT_',
        searchPlaceholder      : 'Search...',
        lengthMenu             : '_MENU_'       
    },
    columnDefs                 : [
      { 
        orderable            : false, 
        targets              : [0,1,2,3,4,5,6,7,8,9] 
      }
    ],
    "serverSide"               : true,
    // "processing"               : true,
    "ajax"                     : {
        "url"                  : 'server-tbl-print-logs-transmittal',
        "type"                 : 'POST',
        "data"                 : { 
                                "print_logs_tbl" : $("#tbl-print-logs-transmittal").attr('data-tbl')
                              }
    },
    'createdRow'            : function(row, data, dataIndex) {
      var dataRowAttrIndex = ['data-lgu-const-id'];
      var dataRowAttrValue = [0];
        for (var i = 0; i < dataRowAttrIndex.length; i++) {
          myObjKeyLguConst[dataRowAttrIndex[i]] = data[dataRowAttrValue[i]];
        }
        $(row).attr(myObjKeyLguConst);
    }
  });

  //gatepass
  $('#tbl-print-logs-gatepass').DataTable().clear().destroy();
  tbl_print_logs_gatepass  = $("#tbl-print-logs-gatepass").DataTable({
    searchHighlight : true,
    lengthMenu      : [[30, 50, -1], [30, 50, 'All']],
    language: {
        search                 : '_INPUT_',
        searchPlaceholder      : 'Search...',
        lengthMenu             : '_MENU_'       
    },
    columnDefs                 : [
      { 
        orderable            : false, 
        targets              : [0,1,2,3,4,5,6,7] 
      }
    ],
    "serverSide"               : true,
    // "processing"               : true,
    "ajax"                     : {
        "url"                  : 'server-tbl-print-logs-gatepass',
        "type"                 : 'POST',
        "data"                 : { 
                                "print_logs_tbl" : $("#tbl-print-logs-gatepass").attr('data-tbl')
                              }
    },
    'createdRow'            : function(row, data, dataIndex) {
      var dataRowAttrIndex = ['data-lgu-const-id'];
      var dataRowAttrValue = [0];
        for (var i = 0; i < dataRowAttrIndex.length; i++) {
          myObjKeyLguConst[dataRowAttrIndex[i]] = data[dataRowAttrValue[i]];
        }
        $(row).attr(myObjKeyLguConst);
    }
  });

  //checklist
  $('#tbl-print-logs-checklist').DataTable().clear().destroy();
  tbl_print_logs_checklist  = $("#tbl-print-logs-checklist").DataTable({
    searchHighlight : true,
    lengthMenu      : [[30, 50, -1], [30, 50, 'All']],
    language: {
        search                 : '_INPUT_',
        searchPlaceholder      : 'Search...',
        lengthMenu             : '_MENU_'       
    },
    columnDefs                 : [
      { 
        orderable            : false, 
        targets              : [0,1,2,3,4,5,6,7] 
      }
    ],
    "serverSide"               : true,
    // "processing"               : true,
    "ajax"                     : {
        "url"                  : 'server-tbl-print-logs-checklist',
        "type"                 : 'POST',
        "data"                 : { 
                                "print_logs_tbl" : $("#tbl-print-logs-checklist").attr('data-tbl')
                              }
    },
    'createdRow'            : function(row, data, dataIndex) {
      var dataRowAttrIndex = ['data-lgu-const-id'];
      var dataRowAttrValue = [0];
        for (var i = 0; i < dataRowAttrIndex.length; i++) {
          myObjKeyLguConst[dataRowAttrIndex[i]] = data[dataRowAttrValue[i]];
        }
        $(row).attr(myObjKeyLguConst);
    }
  });


  //qrcodes
  $('#tbl-print-logs-qrcodes').DataTable().clear().destroy();
  tbl_print_logs_qrcodes  = $("#tbl-print-logs-qrcodes").DataTable({
    searchHighlight : true,
    lengthMenu      : [[30, 50, -1], [30, 50, 'All']],
    language: {
        search                 : '_INPUT_',
        searchPlaceholder      : 'Search...',
        lengthMenu             : '_MENU_'       
    },
    columnDefs                 : [
      { 
        orderable            : false, 
        targets              : [0,1,2,3,4,5,6,7] 
      }
    ],
    "serverSide"               : true,
    // "processing"               : true,
    "ajax"                     : {
        "url"                  : 'server-tbl-print-logs-qrcodes',
        "type"                 : 'POST',
        "data"                 : { 
                                "print_logs_tbl" : $("#tbl-print-logs-qrcodes").attr('data-tbl')
                              }
    },
    'createdRow'            : function(row, data, dataIndex) {
      var dataRowAttrIndex = ['data-lgu-const-id'];
      var dataRowAttrValue = [0];
        for (var i = 0; i < dataRowAttrIndex.length; i++) {
          myObjKeyLguConst[dataRowAttrIndex[i]] = data[dataRowAttrValue[i]];
        }
        $(row).attr(myObjKeyLguConst);
    }
  });



}

//init datatables END =====================================================>

//init datepicker 'YYYY-MM'
function initDateDefault(){
  $(".dp-ym").datepicker({
    dateFormat: 'yy-mm',
    changeMonth: true,
    changeYear: true,
    showButtonPanel: true,

    onClose: function(dateText, inst) {
        var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
        var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
        $(this).val($.datepicker.formatDate('yy-mm', new Date(year, month, 1)));
    }
  });
  $(".dp-ym").focus(function () {
  $(".ui-datepicker-calendar").hide();
    $("#ui-datepicker-div").position({
      my: "center top",
      at: "center bottom",
      of: $(this)
    });
  });
}

function strToFloat(stringValue) {
  if (typeof stringValue !== 'undefined') {
    stringValue = stringValue.trim();
    var result = stringValue.replace(/[^0-9]/g, '');
    if (/[,\.]\d{2}$/.test(stringValue)) {
        result = result.replace(/(\d{2})$/, '.$1');
    }
    return parseFloat(result);  
  }
}

function deleteData(d){
  var acctCode = d.getAttribute('data-code');
  var tbl      = d.getAttribute('data-tbl');
  var field    = d.getAttribute('data-fld');
  customSwal(
        'btn btn-success', 
        'btn btn-danger mr-2', 
        'Yes', 
        'Wait', 
        ['', 'Are you sure you want to delete this account ? ' + (field == 'group_code' ? 'Note: if you click YES the sub accident  ount for this account will automatically deleted!' : ''), 'question'], 
        function(){
            $.ajax({
                url      : 'update-data',
                type     : 'POST',
                dataType : 'JSON',
                context  : this,
                data     : {'tbl': tbl,  
                            'update_data': {
                              'is_deleted' : 1,
                            },
                            'field_where': field, 
                            'where_val': acctCode 
                            },
                success:function(res){
                  Swal.fire(
                    res.param1,
                    res.param2,
                    res.param3
                  );
                  if (res.param3=='success') {
                    if (field == 'group_code') {
                      $('a[data-link=view-setting-page]').trigger('click');
                    } else {
                      $(d).parents('tr').remove();
                    }

                  }
                }
              });
          }, function(){
            console.log('Fail');
      });
}

function exportF(elem) {
  var table = document.getElementById('table-to-excel');
  var html = table.outerHTML;
  var url = 'data:application/vnd.ms-excel,' + escape(html); // Set your html table into url 
  elem.setAttribute("href", url);
  elem.setAttribute("download", "benefit-claimed.xls"); // Choose the file name
  return false;
}

function formatDate(date) {
  var d = new Date(date),
      month = '' + (d.getMonth() + 1),
      day = '' + d.getDate(),
      year = d.getFullYear();

  if (month.length < 2) 
      month = '0' + month;
  if (day.length < 2) 
      day = '0' + day;

  return [year, month, day].join('-');
}

function formatDateOthFormat(date) {
  var d = new Date(date),
      month = '' + (d.getMonth() + 1),
      day = '' + d.getDate(),
      year = d.getFullYear();

  if (month.length < 2) 
      month = '0' + month;
  if (day.length < 2) 
      day = '0' + day;

  return [month, day, year].join('/');
}

function getEncKey(key){
  var jqXHR = $.ajax({
    type: "POST",
    url: "get-enc-key",
    data: {'key' : key},
    dataType: "json",
    async: false,
    success: function (res) {
      return res.key;
    }
  });
  return jqXHR.responseText;
}

function readUrlImg(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
        $('#src-img-asset').attr('src', e.target.result);
        $('#src-img-asset').removeClass('none');
    }
    reader.readAsDataURL(input.files[0]);
  }
}




