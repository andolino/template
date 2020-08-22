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
var tbl_office = [];

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
    var link          = $(this).attr('data-link');
    var d             = $(this).attr('data-ind');
    var dataBadgeHead = $(this).attr('data-badge-head');
    var acls          = $(this).attr('data-cls');
    // $(this).tooltip('hide');
    $('.custom-container').html('');
    $.get(baseURL + link, { 'data' : d }, function(data, textStatus, xhr) {
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
      
      //datatables for single page
      //datatables for page reload
      initMembersDataTables();
      initActivityLogsDataTables();
      initAssetRequestDataTables();
      initUsersDataTables();
      initCompaniesDataTables();
      initModelsDataTables();
      initSupplierDataTables();
      initLocationsDataTables();
      initDepartmentsDataTables();
      initOfficeDataTables();

    });    
  });

  //init datatable list
  initMembersDataTables();
  initUsersDataTables();
  initAssetRequestDataTables();
  initActivityLogsDataTables();
  initDepartmentsDataTables();
  initOfficeDataTables();

  //============================> BEGIN
  $(document).on('submit', '#frm-create-asset', function(e) {
    e.preventDefault();
    e.stopImmediatePropagation();
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
        tbl_asset.ajax.reload();
      });
      
    }, function(){
      console.log('Fail');
    });
  });

  $(document).on('change', '#upload-file-dp', function() {
    $('.spinner-cont').removeClass('none');
    $('#frm-upload-dp').trigger('submit');
  });

  $(document).on('click', '#printAssetQr', function() {
    window.open('print-asset-qr');
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


  $(document).on("change", "#img-asset", function(){
    readUrlImg(this);
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
    columnDefs                 : [
      { 
        orderable            : false, 
        targets              : [0,1,2,3,4,5,6,7,8,9,10,11,12,13] 
      }
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


