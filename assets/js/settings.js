$(document).ready(function() {
  
  //load data-page
  $(document).on('click', '#loadSidePage', function(event) {
    var link  = $(this).attr('data-link');
    var title = $(this).attr('data-title');
    var id    = $(this).attr('data-id');
    var fn    = $(this).attr('data-fn');
    // $(this).tooltip('hide');
    $.post(link, { 'id' : id, 'fn': fn  }, function(data, textStatus, xhr) {
      $('.cont-add-body').html(data);
      $('.title-cont-form').html(title);
      animateSingleIn('.cont-card-add', 'fadeInRight');

      $('select[name="departments_id"]').select2({
        placeholder: 'Select Department',
        allowClear: true
      });

      $('select[name="employee_id"]').select2({
        placeholder: "Selec Member's ID",
        allowClear: true
      });

    });    
  });

  $(document).on('change', '.is-invalid', function(e) {
    e.preventDefault();
    $(this).removeClass('is-invalid');
  });

  $(document).on('click', '#updateContributionRate', function(e) {
    e.preventDefault();
    $.ajax({
      url: 'get-frm-contribution-rate',
      type: 'POST',
      success: function(res){
        $('.cont-add-body').html(res);
        $('.title-cont-form').html('UPDATE CONTRIBUTION RATE');
        animateSingleIn('.cont-card-add', 'fadeInRight');

      }
    });
    
  });

 $(document).on('submit', '#frm-users-settings', function(e) {
    e.preventDefault();
    var frm = $(this).serialize();
    customSwal(
        'btn btn-success', 
        'btn btn-danger mr-2', 
        'Yes', 
        'Wait', 
        ['', 'Are you sure you want to save ?', 'question'], 
        function(){
            $.ajax({
              url       : 'save-users-data',
              type      : 'POST',
              dataType  : 'JSON',
              data      : frm,
              context   : this,
              success   : function(res){
                if (res.msg == 'fail') {
                  $('input').removeClass('is-valid is-invalid');
                  $('select').removeClass('is-valid is-invalid');
                  $('.err-msg').html('');
                  $.each(res, function(index, el) {
                    console.log(index, el);
                    $('input[name="'+index+'"]').addClass('is-invalid');
                    $('select[name="'+index+'"]').addClass('is-invalid');
                    $('.'+index).addClass('invalid-feedback').html(el);
                  });
                } else {
                  Swal.fire(
                    'Success!',
                    'Users Successfully Registered!',
                    'success'
                  );
                  animateSingleOut('.cont-card-add', 'fadeOutRight')
                  tbl_users.ajax.reload();
                }
              }
            });
          }, function(){
            console.log('Fail');
      });
  
  });

  $(document).on('submit', '#frm-companies-settings', function(e) {
    e.preventDefault();
    // var frm = $(this).serializeArray();
    var frm = new FormData(this);
    frm.append('tbl', 'tbl_companies');
    frm.append('pk_key', 'id');
    frm.append('unique', 'name');
    customSwal(
        'btn btn-success', 
        'btn btn-danger mr-2', 
        'Yes', 
        'Wait', 
        ['', 'Are you sure you want to save ?', 'question'], 
        function(){
          $.ajax({
            url: 'add-data',
            type: 'POST',
            dataType: 'JSON',
            data: frm,
            processData:false,
            contentType:false,
            cache:false,
            async:false,
            success: function(res){
              if (res.param3 == 'success') {
                tbl_companies.ajax.reload();
              }
              Swal.fire(
                res.param1,
                res.param2,
                res.param3
              );
              animateSingleOut('.cont-card-add', 'fadeOutRight');
            }
          });
          
          }, function(){
            console.log('Fail');
      });
  });
  
  $(document).on('submit', '#frm-models-settings', function(e) {
    e.preventDefault();
    // var frm = $(this).serializeArray();
    var frm = new FormData(this);
    frm.append('tbl', 'tbl_models');
    frm.append('pk_key', 'id');
    frm.append('unique', 'name');
    customSwal(
        'btn btn-success', 
        'btn btn-danger mr-2', 
        'Yes', 
        'Wait', 
        ['', 'Are you sure you want to save ?', 'question'], 
        function(){
          $.ajax({
            url: 'add-data',
            type: 'POST',
            dataType: 'JSON',
            data: frm,
            processData:false,
            contentType:false,
            cache:false,
            async:false,
            success: function(res){
              if (res.param3 == 'success') {
                tbl_models.ajax.reload();
              }
              Swal.fire(
                res.param1,
                res.param2,
                res.param3
              );
              animateSingleOut('.cont-card-add', 'fadeOutRight');
            }
          });
          
          }, function(){
            console.log('Fail');
      });
  });
  
  $(document).on('submit', '#frm-supplier-settings', function(e) {
    e.preventDefault();
    // var frm = $(this).serializeArray();
    var frm = new FormData(this);
    frm.append('tbl', 'tbl_suppliers');
    frm.append('pk_key', 'id');
    frm.append('unique', 'name');
    customSwal(
        'btn btn-success', 
        'btn btn-danger mr-2', 
        'Yes', 
        'Wait', 
        ['', 'Are you sure you want to save ?', 'question'], 
        function(){
          $.ajax({
            url: 'add-data',
            type: 'POST',
            dataType: 'JSON',
            data: frm,
            processData:false,
            contentType:false,
            cache:false,
            async:false,
            success: function(res){
              if (res.param3 == 'success') {
                tbl_suppliers.ajax.reload();
              }
              Swal.fire(
                res.param1,
                res.param2,
                res.param3
              );
              animateSingleOut('.cont-card-add', 'fadeOutRight');
            }
          });
          
          }, function(){
            console.log('Fail');
      });
  });

  $(document).on('submit', '#frm-office-settings', function(e) {
    e.preventDefault();
    var frm = $(this).serializeArray();
    frm.push({name: 'tbl', value: 'office_management'});
    frm.push({name: 'pk_key', value: 'office_management_id'});
    frm.push({name: 'unique', value: 'office_code'});
    customSwal(
        'btn btn-success', 
        'btn btn-danger mr-2', 
        'Yes', 
        'Wait', 
        ['', 'Are you sure you want to save ?', 'question'], 
        function(){
          $.ajax({
            url: 'add-data',
            type: 'POST',
            dataType: 'JSON',
            data: frm,
            success: function(res){
              if (res.param3 == 'success') {
                tbl_office.ajax.reload();
              }
              Swal.fire(
                res.param1,
                res.param2,
                res.param3
              );
              animateSingleOut('.cont-card-add', 'fadeOutRight');
            }
          });
          
          }, function(){
            console.log('Fail');
      });
  });
  
  $(document).on('change', '.input-address-lat-lng', function(e) {
    var geocoder = new google.maps.Geocoder();
    var address = $(this).val();
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        var latitude = results[0].geometry.location.lat();
        var longitude = results[0].geometry.location.lng();
        $('input[name="lat"]').val(latitude);
        $('input[name="lng"]').val(longitude);
      } else {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Invalid Address!',
        })
      }
    });
  });
  $(document).on('submit', '#frm-locations-settings', function(e) {
    e.preventDefault();
    // var frm = $(this).serializeArray();
    var frm = new FormData(this);
    frm.append('tbl', 'tbl_locations');
    frm.append('pk_key', 'id');
    frm.append('unique', 'name');
    customSwal(
        'btn btn-success', 
        'btn btn-danger mr-2', 
        'Yes', 
        'Wait', 
        ['', 'Are you sure you want to save ?', 'question'], 
        function(){
          $.ajax({
            url: 'add-data',
            type: 'POST',
            dataType: 'JSON',
            data: frm,
            processData:false,
            contentType:false,
            cache:false,
            async:false,
            success: function(res){
              if (res.param3 == 'success') {
                tbl_locations.ajax.reload();
              }
              Swal.fire(
                res.param1,
                res.param2,
                res.param3
              );
              animateSingleOut('.cont-card-add', 'fadeOutRight');
            }
          });
          
          }, function(){
            console.log('Fail');
      });
  });

  $(document).on('submit', '#frm-departments-settings', function(e) {
    e.preventDefault();
    var frm = $(this).serializeArray();
    frm.push({name: 'tbl', value: 'departments'});
    frm.push({name: 'pk_key', value: 'departments_id'});
    frm.push({name: 'unique', value: 'region'});
    customSwal(
        'btn btn-success', 
        'btn btn-danger mr-2', 
        'Yes', 
        'Wait', 
        ['', 'Are you sure you want to save ?', 'question'], 
        function(){
          $.ajax({
            url: 'add-data',
            type: 'POST',
            dataType: 'JSON',
            data: frm,
            success: function(res){
              if (res.param3 == 'success') {
                tbl_departments.ajax.reload();
              }
              Swal.fire(
                res.param1,
                res.param2,
                res.param3
              );
              animateSingleOut('.cont-card-add', 'fadeOutRight');
            }
          });
          
          }, function(){
            console.log('Fail');
      });
  });
  
  $(document).on('submit', '#frm-asset-category-settings', function(e) {
    e.preventDefault();
    var frm = $(this).serializeArray();
    frm.push({name: 'tbl', value: 'asset_category'});
    frm.push({name: 'pk_key', value: 'asset_category_id'});
    frm.push({name: 'unique', value: 'code'});
    customSwal(
        'btn btn-success', 
        'btn btn-danger mr-2', 
        'Yes', 
        'Wait', 
        ['', 'Are you sure you want to save ?', 'question'], 
        function(){
          $.ajax({
            url: 'add-data',
            type: 'POST',
            dataType: 'JSON',
            data: frm,
            success: function(res){
              if (res.param3 == 'success') {
                tbl_asset_category.ajax.reload();
              }
              Swal.fire(
                res.param1,
                res.param2,
                res.param3
              );
              animateSingleOut('.cont-card-add', 'fadeOutRight');
            }
          });
          
          }, function(){
            console.log('Fail');
      });
  });



});


function initUsersDataTables(){
  var myObjKeyLguConst = {};
  tbl_users  = $("#tbl-user-settings").DataTable({
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
        targets              : [0,1,2,3,4] 
      },
      { 
        className            : 'text-center', 
        targets              : [4] 
      }
      // { 
      //   className            : 'text-center', 
      //   targets              : [6] 
      // }
    ],
    "serverSide"               : true,
    "processing"               : true,
    "ajax"                     : {
        "url"                  : 'server-users',
        "type"                 : 'POST',
        // "data"                 : { 
        //                         "id" : $("#tbl-loans-by-member").attr('data-id')
        //                       }
    },
    'createdRow'            : function(row, data, dataIndex) {
      var dataRowAttrIndex = ['data-loan-settings'];
      var dataRowAttrValue = [0];
        for (var i = 0; i < dataRowAttrIndex.length; i++) {
          myObjKeyLguConst[dataRowAttrIndex[i]] = data[dataRowAttrValue[i]];
        }
        $(row).attr(myObjKeyLguConst);
    }
  });
}

function initCompaniesDataTables(){
  var myObjKeyLguConst = {};
  tbl_companies  = $("#tbl-companies-settings").DataTable({
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
        targets              : [0,1,2] 
      },
      { 
        className            : 'text-center', 
        targets              : [2] 
      }
      // { 
      //   className            : 'text-center', 
      //   targets              : [6] 
      // }
    ],
    "serverSide"               : true,
    "processing"               : true,
    "ajax"                     : {
        "url"                  : 'server-companies',
        "type"                 : 'POST',
        // "data"                 : { 
        //                         "id" : $("#tbl-loans-by-member").attr('data-id')
        //                       }
    },
    'createdRow'            : function(row, data, dataIndex) {
      var dataRowAttrIndex = ['data-loan-settings'];
      var dataRowAttrValue = [0];
        for (var i = 0; i < dataRowAttrIndex.length; i++) {
          myObjKeyLguConst[dataRowAttrIndex[i]] = data[dataRowAttrValue[i]];
        }
        $(row).attr(myObjKeyLguConst);
    }
  });
}

function initModelsDataTables(){
  var myObjKeyLguConst = {};
  tbl_models  = $("#tbl-models-settings").DataTable({
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
        targets              : [0,1] 
      },
      { 
        className            : 'text-center', 
        targets              : [1] 
      }
      // { 
      //   className            : 'text-center', 
      //   targets              : [6] 
      // }
    ],
    "serverSide"               : true,
    "processing"               : true,
    "ajax"                     : {
        "url"                  : 'server-models',
        "type"                 : 'POST',
        // "data"                 : { 
        //                         "id" : $("#tbl-loans-by-member").attr('data-id')
        //                       }
    },
    'createdRow'            : function(row, data, dataIndex) {
      var dataRowAttrIndex = ['data-loan-settings'];
      var dataRowAttrValue = [0];
        for (var i = 0; i < dataRowAttrIndex.length; i++) {
          myObjKeyLguConst[dataRowAttrIndex[i]] = data[dataRowAttrValue[i]];
        }
        $(row).attr(myObjKeyLguConst);
    }
  });
}

function initSupplierDataTables(){
  var myObjKeyLguConst = {};
  tbl_suppliers  = $("#tbl-supplier-settings").DataTable({
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
        targets              : [0,1,2] 
      },
      { 
        className            : 'text-center', 
        targets              : [1] 
      }
      // { 
      //   className            : 'text-center', 
      //   targets              : [6] 
      // }
    ],
    "serverSide"               : true,
    "processing"               : true,
    "ajax"                     : {
        "url"                  : 'server-suppliers',
        "type"                 : 'POST',
        // "data"                 : { 
        //                         "id" : $("#tbl-loans-by-member").attr('data-id')
        //                       }
    },
    'createdRow'            : function(row, data, dataIndex) {
      var dataRowAttrIndex = ['data-loan-settings'];
      var dataRowAttrValue = [0];
        for (var i = 0; i < dataRowAttrIndex.length; i++) {
          myObjKeyLguConst[dataRowAttrIndex[i]] = data[dataRowAttrValue[i]];
        }
        $(row).attr(myObjKeyLguConst);
    }
  });
}

function initLocationsDataTables(){
  var myObjKeyLguConst = {};
  tbl_locations  = $("#tbl-locations-settings").DataTable({
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
        targets              : [0,1,2] 
      },
      // { 
      //   className            : 'text-center', 
      //   targets              : [1] 
      // }
      // { 
      //   className            : 'text-center', 
      //   targets              : [6] 
      // }
    ],
    "serverSide"               : true,
    "processing"               : true,
    "ajax"                     : {
        "url"                  : 'server-locations',
        "type"                 : 'POST',
        // "data"                 : { 
        //                         "id" : $("#tbl-loans-by-member").attr('data-id')
        //                       }
    },
    'createdRow'            : function(row, data, dataIndex) {
      var dataRowAttrIndex = ['data-loan-settings'];
      var dataRowAttrValue = [0];
        for (var i = 0; i < dataRowAttrIndex.length; i++) {
          myObjKeyLguConst[dataRowAttrIndex[i]] = data[dataRowAttrValue[i]];
        }
        $(row).attr(myObjKeyLguConst);
    }
  });
}

function initDepartmentsDataTables(){
  var myObjKeyLguConst = {};
  tbl_departments  = $("#tbl-departments-settings").DataTable({
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
        targets              : [0,1,2] 
      },
      { 
        className            : 'text-center', 
        targets              : [2] 
      }
      // { 
      //   className            : 'text-center', 
      //   targets              : [6] 
      // }
    ],
    "serverSide"               : true,
    "processing"               : true,
    "ajax"                     : {
        "url"                  : 'server-departments',
        "type"                 : 'POST',
        // "data"                 : { 
        //                         "id" : $("#tbl-loans-by-member").attr('data-id')
        //                       }
    },
    'createdRow'            : function(row, data, dataIndex) {
      var dataRowAttrIndex = ['data-loan-settings'];
      var dataRowAttrValue = [0];
        for (var i = 0; i < dataRowAttrIndex.length; i++) {
          myObjKeyLguConst[dataRowAttrIndex[i]] = data[dataRowAttrValue[i]];
        }
        $(row).attr(myObjKeyLguConst);
    }
  });
}

function initAssetCategoryDataTables(){
  var myObjKeyLguConst = {};
  tbl_asset_category  = $("#tbl-asset-category-settings").DataTable({
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
        targets              : [0,1,2] 
      },
      { 
        className            : 'text-center', 
        targets              : [2] 
      }
      // { 
      //   className            : 'text-center', 
      //   targets              : [6] 
      // }
    ],
    "serverSide"               : true,
    "processing"               : true,
    "ajax"                     : {
        "url"                  : 'server-asset-category',
        "type"                 : 'POST',
        // "data"                 : { 
        //                         "id" : $("#tbl-loans-by-member").attr('data-id')
        //                       }
    },
    'createdRow'            : function(row, data, dataIndex) {
      var dataRowAttrIndex = ['data-loan-settings'];
      var dataRowAttrValue = [0];
        for (var i = 0; i < dataRowAttrIndex.length; i++) {
          myObjKeyLguConst[dataRowAttrIndex[i]] = data[dataRowAttrValue[i]];
        }
        $(row).attr(myObjKeyLguConst);
    }
  });
}

function initOfficeDataTables(){
  var myObjKeyLguConst = {};
  tbl_office  = $("#tbl-office-settings").DataTable({
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
        targets              : [0,1,2] 
      },
      { 
        className            : 'text-center', 
        targets              : [2] 
      }
      // { 
      //   className            : 'text-center', 
      //   targets              : [6] 
      // }
    ],
    "serverSide"               : true,
    "processing"               : true,
    "ajax"                     : {
        "url"                  : 'server-office',
        "type"                 : 'POST',
        // "data"                 : { 
        //                         "id" : $("#tbl-loans-by-member").attr('data-id')
        //                       }
    },
    'createdRow'            : function(row, data, dataIndex) {
      var dataRowAttrIndex = ['data-loan-settings'];
      var dataRowAttrValue = [0];
        for (var i = 0; i < dataRowAttrIndex.length; i++) {
          myObjKeyLguConst[dataRowAttrIndex[i]] = data[dataRowAttrValue[i]];
        }
        $(row).attr(myObjKeyLguConst);
    }
  });
}

function initHistoryLogsDataTables(){
  var myObjKeyLguConst = {};
  tbl_history_logs  = $("#tbl-history-logs").DataTable({
    searchHighlight : true,
    lengthMenu      : [[5, 10, 20, 30, 50, -1], [5, 10, 20, 30, 50, 'All']],
    language: {
        search                 : '_INPUT_',
        searchPlaceholder      : 'Search...',
        lengthMenu             : '_MENU_'       
    },
    order: [[ 0, "desc" ]],
    columnDefs                 : [
      { 
        orderable            : false, 
        targets              : [1,2,3,4,5,6,7,8] 
      }
      // { 
      //   className            : 'text-center', 
      //   targets              : [2] 
      // }
      // { 
      //   className            : 'text-center', 
      //   targets              : [6] 
      // }
    ],
    "serverSide"               : true,
    "processing"               : true,
    "ajax"                     : {
        "url"                  : 'server-history',
        "type"                 : 'POST',
        // "data"                 : { 
        //                         "id" : $("#tbl-history-logs").attr('data-id')
        //                       }
    },
    'createdRow'            : function(row, data, dataIndex) {
      var dataRowAttrIndex = ['data-loan-settings'];
      var dataRowAttrValue = [0];
        for (var i = 0; i < dataRowAttrIndex.length; i++) {
          myObjKeyLguConst[dataRowAttrIndex[i]] = data[dataRowAttrValue[i]];
        }
        $(row).attr(myObjKeyLguConst);
    }
  });
}

function initDispatchRequestDataTables(){
  var myObjKeyLguConst = {};
  tbl_dispatch_request  = $("#tbl-request-dispatch-pending").DataTable({
    searchHighlight : true,
    lengthMenu      : [[5, 10, 20, 30, 50, -1], [5, 10, 20, 30, 50, 'All']],
    language: {
        search                 : '_INPUT_',
        searchPlaceholder      : 'Search...',
        lengthMenu             : '_MENU_'       
    },
    order: [[ 0, "desc" ]],
    columnDefs                 : [
      { 
        orderable            : false, 
        targets              : [1,2,3,4,5] 
      }
      // { 
      //   className            : 'text-center', 
      //   targets              : [2] 
      // }
      // { 
      //   className            : 'text-center', 
      //   targets              : [6] 
      // }
    ],
    "serverSide"               : true,
    "processing"               : true,
    "ajax"                     : {
        "url"                  : 'server-dispatch-request',
        "type"                 : 'POST',
        "data"                 : { 
                                "request_status" : $("#tbl-request-dispatch-pending").attr('data-status')
                              }
    },
    'createdRow'            : function(row, data, dataIndex) {
      var dataRowAttrIndex = ['data-loan-settings'];
      var dataRowAttrValue = [0];
        for (var i = 0; i < dataRowAttrIndex.length; i++) {
          myObjKeyLguConst[dataRowAttrIndex[i]] = data[dataRowAttrValue[i]];
        }
        $(row).attr(myObjKeyLguConst);
    }
  });
}

function initTblAssetDataTables(){
  var myObjKeyLguConst = {};
  tbl_asset_dtables  = $("#tbl-asset-listdown").DataTable({
    searchHighlight : true,
    lengthMenu      : [[5, 10, 20, 30, 50, -1], [5, 10, 20, 30, 50, 'All']],
    language: {
        search                 : '_INPUT_',
        searchPlaceholder      : 'Search...',
        lengthMenu             : '_MENU_'       
    },
    order: [[ 0, "desc" ]],
    columnDefs                 : [
      { 
        orderable            : false, 
        targets              : [1,2,3,4,5] 
      }
      // { 
      //   className            : 'text-center', 
      //   targets              : [2] 
      // }
      // { 
      //   className            : 'text-center', 
      //   targets              : [6] 
      // }
    ],
    "serverSide"               : true,
    "processing"               : true,
    "ajax"                     : {
        "url"                  : 'server-tbl-asset-listdown',
        "type"                 : 'POST',
        "data"                 : { 
                                "tbl_asset_id_dispatch" : $("#tbl-asset-listdown").attr('data-id'),
                                "data_asset_category_id" : $("#tbl-asset-listdown").attr('data-cat'),
                                "data_office_management_id" : $("#tbl-asset-listdown").attr('data-man'),
                                "data_qty" : $("#tbl-asset-listdown").attr('data-qty')
                              }
    },
    'createdRow'            : function(row, data, dataIndex) {
      var dataRowAttrIndex = ['data-loan-settings'];
      var dataRowAttrValue = [0];
        for (var i = 0; i < dataRowAttrIndex.length; i++) {
          myObjKeyLguConst[dataRowAttrIndex[i]] = data[dataRowAttrValue[i]];
        }
        $(row).attr(myObjKeyLguConst);
    }
  });
}

function initTblAssetSiblingsDataTables(id){
  var myObjKeyLguConst = {};
  $('#tbl_sibling_listdown').DataTable().clear().destroy();
  tbl_asset_siblings_dtables  = $("#tbl_sibling_listdown").DataTable({
    searchHighlight : true,
    lengthMenu      : [[5, 10, 20, 30, 50, -1], [5, 10, 20, 30, 50, 'All']],
    language: {
        search                 : '_INPUT_',
        searchPlaceholder      : 'Search...',
        lengthMenu             : '_MENU_'       
    },
    order: [[ 0, "desc" ]],
    columnDefs                 : [
      { 
        orderable            : false, 
        targets              : [1,2,3,4,5] 
      }
      // { 
      //   className            : 'text-center', 
      //   targets              : [2] 
      // }
      // { 
      //   className            : 'text-center', 
      //   targets              : [6] 
      // }
    ],
    "serverSide"               : true,
    "processing"               : true,
    "ajax"                     : {
        "url"                  : 'server-tbl-asset-siblings-listdown',
        "type"                 : 'POST',
        "data"                 : { 
                                  'siblings_asset_listdown': id               
        }
    },
    'createdRow'            : function(row, data, dataIndex) {
      var dataRowAttrIndex = ['data-loan-settings'];
      var dataRowAttrValue = [0];
        for (var i = 0; i < dataRowAttrIndex.length; i++) {
          myObjKeyLguConst[dataRowAttrIndex[i]] = data[dataRowAttrValue[i]];
        }
        $(row).attr(myObjKeyLguConst);
    }
  });
}

function initTblAssetChildsDataTables(id){
  var myObjKeyLguConst = {};
  $('#tbl_child_listdown').DataTable().clear().destroy();
  tbl_asset_siblings_dtables  = $("#tbl_child_listdown").DataTable({
    searchHighlight : true,
    lengthMenu      : [[5, 10, 20, 30, 50, -1], [5, 10, 20, 30, 50, 'All']],
    language: {
        search                 : '_INPUT_',
        searchPlaceholder      : 'Search...',
        lengthMenu             : '_MENU_'       
    },
    order: [[ 0, "desc" ]],
    columnDefs                 : [
      { 
        orderable            : false, 
        targets              : [1,2,3,4,5] 
      }
      // { 
      //   className            : 'text-center', 
      //   targets              : [2] 
      // }
      // { 
      //   className            : 'text-center', 
      //   targets              : [6] 
      // }
    ],
    "serverSide"               : true,
    "processing"               : true,
    "ajax"                     : {
        "url"                  : 'server-tbl-asset-siblings-listdown',
        "type"                 : 'POST',
        "data"                 : { 
                                  'childs_asset_listdown': id               
        }
    },
    'createdRow'            : function(row, data, dataIndex) {
      var dataRowAttrIndex = ['data-loan-settings'];
      var dataRowAttrValue = [0];
        for (var i = 0; i < dataRowAttrIndex.length; i++) {
          myObjKeyLguConst[dataRowAttrIndex[i]] = data[dataRowAttrValue[i]];
        }
        $(row).attr(myObjKeyLguConst);
    }
  });
}

function removeData(d){
  var id  = d.getAttribute('data-id');
  var tbl = d.getAttribute('data-tbl');
  var fld = d.getAttribute('data-field');
  customSwal(
    'btn btn-success', 
    'btn btn-danger mr-2', 
    'Yes', 
    'Wait',   
    ['', 'Are you sure you want to delete ?', 'question'], 
    function(){
        $.post('delete-data', {'tbl' : tbl, 'w': fld, 'v': id}, function(data, textStatus, xhr) {
          tbl_users.ajax.reload();
          tbl_companies.ajax.reload();
          tbl_models.ajax.reload();
          tbl_suppliers.ajax.reload();
          tbl_locations.ajax.reload();
          tbl_departments.ajax.reload();
          tbl_asset_category.ajax.reload();
          tbl_office.ajax.reload();
          tbl_print_logs_transmittal.ajax.reload();
        });
      }, function(){
        console.log('Fail');
  });
}

function removeDataInd(d){
  var id  = d.getAttribute('data-id');
  var tbl = d.getAttribute('data-tbl');
  var fld = d.getAttribute('data-field');
  customSwal(
    'btn btn-success', 
    'btn btn-danger mr-2', 
    'Yes', 
    'Wait',   
    ['', 'Are you sure you want to delete ?', 'question'], 
    function(){
        $.post('delete-data', {'tbl' : tbl, 'w': fld, 'v': id}, function(data, textStatus, xhr) {
          tbl_print_logs_transmittal.ajax.reload();
          tbl_print_logs_gatepass.ajax.reload();
          tbl_print_logs_checklist.ajax.reload();
          tbl_print_logs_qrcodes.ajax.reload();
        });
      }, function(){
        console.log('Fail');
  });
}