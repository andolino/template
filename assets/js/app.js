$(window).on('load', function(){
  //remove loading
  animateSingleIn('.custom-container', 'fadeInUp');
  animateSingleOut('.spinner-cont', 'fadeOut'); 
});

//datatable var array
var tbl_member = [];
var tbl_settings = [];
var tbl_users = [];

$(document).ready(function() {
  //init plugin
  $("body").tooltip({ selector: '[data-toggle=tooltip]' });
  initDateDefault();

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
      initUsersDataTables();

    });    
  });

  //init datatable list
  initMembersDataTables();
  initUsersDataTables();



  //============================> BEGIN
  $(document).on('submit', '#frm-add-member', function(e) {
    e.preventDefault();
    e.stopImmediatePropagation();
    var frm = $(this).serialize(); 
    $.ajax({
      url      : 'save-member',
      type     : 'POST',
      data     : frm,
      dataType : 'JSON',
      success  : function(res) {
        // console.log(typeof res.length);
        console.log(res);
        // typeof res.length === 'undefined'
        if (!res.hasOwnProperty('members_id')) {
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
              name: 'has_update',
              value: res.members_id
          }).appendTo('#frm-add-member');
          // $('#frm-add-member').trigger('reset');
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
      ['', 'Are you sure you want to delete this member?', 'warning'], 
      function(){
      $.post('delete-member', {'id': id}, function(data, textStatus, xhr) {
        Swal.fire(
          'Alright!',
          'Successfully Deleted!',
          'success'
        );
        tbl_member.ajax.reload();
      });
      
    }, function(){
      console.log('Fail');
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
  $('#tbl-member-list').DataTable().clear().destroy();
  tbl_member  = $("#tbl-member-list").DataTable({
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
        targets              : [0,1,2,3,4,5,6,7,8] 
      }
    ],
    "serverSide"               : true,
    "processing"               : true,
    "ajax"                     : {
        "url"                  : 'server-tbl-members',
        "type"                 : 'POST',
        "data"                 : { 
                                "page" : $("#tbl-member-list").attr('data-page')
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