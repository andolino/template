<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] 			 		= 'Admin';
$route['asset-list'] 						 		= 'Admin/asset_list';
$route['asset-ready-to-deploy'] 					= 'Admin/asset_ready_to_deploy';
$route['asset-deployed'] 					= 'Admin/asset_deployed';
$route['asset-dispatch'] 					= 'Admin/asset_dispatch';
$route['dispatch-request'] 					= 'Admin/dispatch_request';
$route['print-logs-transmittal'] 					= 'Admin/print_logs_transmittal';
$route['print-logs-gatepass'] 					= 'Admin/print_logs_gatepass';
$route['print-logs-checklist'] 					= 'Admin/print_logs_checklist';
$route['print-logs-qrcodes'] 					= 'Admin/print_logs_qrcodes';
$route['repair-request'] 					= 'Admin/repair_request';
$route['reimbursement-request'] 	= 'Admin/reimbursement_request';
$route['portal-dispatch-request'] 	= 'Admin/portal_dispatch_request';
$route['get-asset-category-get-qty'] 	= 'Admin/getAssetCategoryGetQty';
$route['portal-repair-request'] 	= 'Admin/portal_repair_request';
$route['portal-reimburse-request'] 	= 'Admin/portal_reimburse_request';
$route['portal-repair-request-tech'] 	= 'Admin/portal_repair_request_tech';
$route['settings'] 								 		= 'Admin/show_settings';
$route['add-asset'] 							= 'Admin/add_asset';
$route['view-asset'] 						= 'Admin/view_asset';
$route['view-asset-child-details'] 						= 'Admin/view_asset_asset_details';
$route['view-child-asset'] 						= 'Admin/view_child_asset';
$route['view-history'] 						= 'Admin/view_history';
$route['mobile-view-asset'] 						= 'Admin/view_asset_mobile';
$route['mobile-view-checklist'] 						= 'Admin/view_checklist_mobile';
$route['mobile-view-checklist-catch'] 						= 'Admin/view_checklist_mobile_catch';
$route['edit-asset'] 						= 'Admin/edit_asset';
$route['edit-child-asset'] 						= 'Admin/edit_child_asset';
$route['server-tbl-asset'] 			= 'Admin/server_tbl_asset';
$route['server-tbl-asset-child'] 			= 'Admin/server_tbl_asset_child';
$route['server-tbl-asset-request'] 			= 'Admin/server_tbl_asset_request';
$route['server-tbl-admin-repair-pending-request'] = 'Admin/server_tbl_admin_pending_repair_request';
$route['view-repair-approval-pending'] = 'Admin/viewRepairApprovalPending';
$route['view-reimbursement-approval-pending'] = 'Admin/viewReimbursementApprovalPending';
$route['view-dispatch-request-pending'] = 'Admin/viewDispatchRequestPending';
$route['get-repair-parent-child-asset'] = 'Admin/getRepairParentChildAsset';
$route['submit-approval-repair-request'] = 'Admin/submitApprovalRepairRequest';
$route['submit-approval-reimbursement-request'] = 'Admin/submitApprovalReimbursementRequest';
$route['submit-approval-dispatch-request'] = 'Admin/submitApprovalDispatchRequest';
$route['edit-dispatch-request'] = 'Admin/editDispatchRequest';
$route['submit-close-repair-request'] = 'Admin/submitCloseRepairRequest';
$route['server-tbl-portal-request'] = 'Admin/server_tbl_portal_request';
$route['server-tbl-repair-request'] = 'Admin/server_tbl_repair_request';
$route['server-tbl-reimbursement-request'] = 'Admin/server_tbl_reimbursement_request';
$route['server-tbl-activity-logs'] 			= 'Settings/server_tbl_activity_logs';
$route['server-tbl-print-logs-transmittal'] 			= 'Settings/server_tbl_print_logs_transmittal';
$route['server-tbl-print-logs-gatepass'] 			= 'Settings/server_tbl_print_logs_gatepass';
$route['server-tbl-print-logs-checklist'] 			= 'Settings/server_tbl_print_logs_checklist';
$route['server-tbl-print-logs-qrcodes'] 			= 'Settings/server_tbl_print_logs_qrcodes';
$route['upload-dp'] 							= 'Admin/upload_const_dp';
$route['get-assets/(:any)'] 			= 'Admin/get_data_assets';
$route['get-assets-child/(:any)'] 			= 'Admin/get_data_assets_child';
$route['scanned-checklist/(:any)'] 			= 'Admin/get_data_checklist';
$route['get-enc-key'] 			= 'Admin/encryptKey';
$route['save-created-qr'] 			= 'Admin/saveCreatedQr';
$route['save-created-qr-checklist'] 			= 'Admin/saveCreatedQrChecklist';
$route['save-asset'] 						= 'Admin/save_asset';
$route['save-portal-request'] 						= 'Admin/save_portal_request';
$route['save-repair-request'] 						= 'Admin/saveRepairRequest';
$route['save-portal-dispatch-request'] 						= 'Admin/savePortalDispatchRequest';
$route['save-portal-reimbursement-request'] 						= 'Admin/savePortalReimbursementRequest';
$route['get-requesti-module'] 						= 'Admin/getRequestiModule';
$route['view-companies'] 				= 'Settings/view_companies';
$route['view-models'] 				= 'Settings/view_models';
$route['view-supplier'] 				= 'Settings/view_suppliers';
$route['view-locations'] 				= 'Settings/view_locations';
$route['view-departments'] 				= 'Settings/view_departments';
$route['view-approval'] 				= 'Settings/view_approval';
$route['view-asset-category'] 				= 'Settings/view_asset_category';
$route['server-companies'] 	= 'Settings/server_companies';
$route['server-models'] 	= 'Settings/server_models';
$route['server-suppliers'] 	= 'Settings/server_suppliers';
$route['server-locations'] 	= 'Settings/server_locations';
$route['server-departments'] 	= 'Settings/server_departments';
$route['server-approver'] 	= 'Settings/server_approver';
$route['server-asset-category'] 	= 'Settings/server_asset_category';
$route['get-departments-frm'] 	= 'Settings/getDepartmentsFrm';
$route['get-approver-frm'] 	= 'Settings/getApproverFrm';
$route['get-asset-category-frm'] 	= 'Settings/getAssetCategoryFrm';
$route['get-companies-frm'] 	= 'Settings/getCompaniesFrm';
$route['get-models-frm'] 	= 'Settings/getModelsFrm';
$route['get-supplier-frm'] 	= 'Settings/getSupplierFrm';
$route['get-locations-frm'] 	= 'Settings/getLocationsFrm';
$route['add-data'] 	= 'Settings/addData';
$route['tbl-asset'] 						= 'Admin/tbl_asset';
$route['delete-asset'] 					= 'Admin/deleteAsset';
$route['delete-child-asset'] 					= 'Admin/deleteChildAsset';
$route['get-users-frm'] 	= 'Settings/getUsersFrm';
$route['get-users-frm-fp'] 	= 'Settings/getUsersFrmFp';
$route['login'] 											= 'Admin/usr_login';
$route['forgot-password'] 					  = 'Admin/forgot_password';
$route['submit-login'] 								= 'Admin/proceed_login';
$route['submit-forgot-pw'] 						= 'Admin/proceed_fg_pw';
$route['print-asset-qr/(:any)'] 						= 'Admin/printAssetQr';
$route['print-child-asset-qr/(:any)'] 						= 'Admin/printChildAssetQr';
$route['view-office'] 						= 'Settings/view_office';
$route['server-office'] 	= 'Settings/server_office';
$route['server-history'] 	= 'Settings/server_history';
$route['server-dispatch-request'] 	= 'Settings/server_dispatch_request';
$route['server-tbl-asset-listdown'] 	= 'Settings/server_tbl_asset_listdown';
$route['server-tbl-asset-siblings-listdown'] 	= 'Settings/server_tbl_asset_siblings_listdown';
$route['server-tbl-asset-childs-listdown'] 	= 'Settings/server_tbl_asset_childs_listdown';
$route['get-office-frm'] 	= 'Settings/getOfficeFrm';
$route['show-map-scanned'] 	= 'Settings/showMapScanned';
$route['show-add-tech-notes'] 	= 'Settings/showAddTechNotes';
$route['show-scanned-user'] 	= 'Settings/showScannedUser';
$route['get-chkd-asset'] 	= 'Admin/getChkdAsset';
$route['get-chkd-child-asset'] 	= 'Admin/getChkdChildAsset';
$route['get-parent-custodian'] 	= 'Admin/getParentCustodian';
$route['change-admin-password'] 	= 'Admin/changeAdminPassword';
$route['submit-admin-new-password'] 	= 'Admin/submit_admin_new_password';
$route['get-asset-print-frm'] 	= 'Admin/getAssetPrintFrm';
$route['get-checklist-print-frm'] 	= 'Admin/getCheckListPrintFrm';
$route['get-transmittal-summary-print-frm'] 	= 'Admin/getTransmittalSummaryPrintFrm';
$route['get-print-asset-report'] 	= 'Admin/getPrintAssetReport';
$route['get-print-checklist-report'] 	= 'Admin/getPrintChecklistReport';
$route['get-print-transmital-summ-report'] 	= 'Admin/getPrintTransmitalSummReport';
$route['get-print-disp-transmital-summ-report'] 	= 'Admin/getPrintDispTransmitalSummReport';
$route['print-asset-report/(:any)'] 	= 'Admin/printAssetReport';
$route['print-transmital-slip/(:any)'] 	= 'Admin/printTransmitalSlip';
$route['print-transmital-slip/(:any)/(:any)'] 	= 'Admin/printTransmitalSlip';
$route['print-checklist-slip'] 	= 'Admin/printChecklist';
$route['print-checklist-slip/(:any)'] 	= 'Admin/printChecklist';
$route['print-checklist-slip/(:any)/(:any)'] 	= 'Admin/printChecklist';

$route['print-transmital-summ-slip'] 	= 'Admin/printTransmitalSummary';
$route['print-transmital-summ-slip/(:any)'] 	= 'Admin/printTransmitalSummary';
$route['print-transmital-summ-slip/(:any)/(:any)'] 	= 'Admin/printTransmitalSummary';

$route['print-disp-transmital-summ-slip'] 	= 'Admin/printDispatchTransmitalSummary';
$route['print-disp-transmital-summ-slip/(:any)'] 	= 'Admin/printDispatchTransmitalSummary';
$route['print-disp-transmital-summ-slip/(:any)/(:any)'] 	= 'Admin/printDispatchTransmitalSummary';


$route['cancel-portal-request'] 	= 'Admin/cancelPortalRequest';
$route['get-select-asset-rep'] 	= 'Settings/getSelectAssetRepair';
$route['get-tbl-asset-row'] 	= 'Settings/getTblAssetRow';
$route['save-tech-notes'] 	= 'Settings/saveTechNotes';
$route['get-asset-category-select'] 	= 'Settings/getAssetCategorySelect';
$route['get-edit-repair-request'] 	= 'Settings/getEditRepairRequest';
$route['get-edit-reimbursement-request'] 	= 'Settings/getEditReimbursementRequest';


$route['print-disbursement-request/(:any)'] 	= 'Reports/printDisbursementRequest';












$route['view-setting-page'] 			 		= 'Admin/view_settings_page';
$route['view-coa'] 								 		= 'Admin/view_chart_of_accounts';
$route['loan-by-member'] 					 		= 'Admin/loanByMember';
$route['loan-list'] 							 		= 'Admin/loanList';
$route['claim-benefit'] 					 		= 'Admin/viewClaimBenefit';
$route['show-claim-benefit'] 			 		= 'Admin/showBenefitClaim';
$route['add-contribution'] 				 		= 'Admin/frmAddContribution';
$route['add-contribution-by-type'] 		= 'Admin/frmAddContributionByType';
$route['add-loan-payments-by-type'] 		= 'Admin/frmAddLoanPaymentsByType';
$route['save-contribution'] 			 		= 'Admin/saveContribution';
$route['save-contribution-by-type'] 			 		= 'Admin/saveContributionByType';
$route['save-payments-by-type'] 			 		= 'Admin/saveLoanPaymentsByType';
$route['save-benefit-claim'] 			 		= 'Admin/saveBenefitClaim';
$route['cdj-transaction'] 				 		= 'Admin/viewCheckDisbursement';
$route['crj-transaction'] 				 		= 'Admin/viewCashReceiptJournal';
$route['general-journal'] 				 		= 'Admin/viewGeneralJournal';
$route['general-ledger'] 					 		= 'Admin/viewGeneralLedger';
$route['trial-balance'] 					 		= 'Admin/viewTrialBalance';
$route['balance-sheet'] 					 		= 'Admin/viewBalanceSheet';
$route['income-statement'] 				 		= 'Admin/viewIncomeStatement';
$route['pacs-transaction'] 				 		= 'Admin/viewPacsTransaction';
$route['cdj-posted'] 							 		= 'Admin/viewPostedCheckDisbursement';
$route['crj-posted'] 							 		= 'Admin/viewPostedCashReceiptJournal';
$route['gj-posted'] 							 		= 'Admin/viewPostedGeneralJournal';
$route['pacs-posted'] 					   		= 'Admin/viewPostedPacs';
$route['get-coa'] 								 		= 'Admin/getChartOfAccounts';
$route['get-subsidiary'] 					 		= 'Admin/getSubsidiaryAccounts';
$route['print-members-docx'] 			 		= 'Admin/printMembersDocx';
$route['print-cash-gift-docx'] 			 		= 'Admin/printCashGiftDocx';
$route['get-members-print-to-excel'] 	= 'Admin/getMembersPrintToExcel';
$route['get-members-print-to-pdf/(:any)/(:any)/(:any)/(:any)/(:any)'] 	= 'Admin/getMembersPrintToPDF';
$route['get-cash-gift-to-excel'] 	= 'Admin/getCashiGiftPrintToExcel';
$route['search-trial-balance'] 				= 'Admin/searchTrialBalance';
$route['get-last-date-applied-cont'] 	= 'Admin/getLastdateApCont';
$route['get-last-date-applied-cg'] 	= 'Admin/getLastdateApCashGift';
$route['cash-gift'] 									= 'Admin/getCashGift';
$route['official-receipt'] 	= 'Admin/officialReceipt';
$route['get-total-contribution-per-region'] 	= 'Admin/getTotalContributionPerRegion';

//accounting
$route['save-acctg-entry'] 		= 'Accounting/saveAcctgEntry';
$route['delete-journal'] 		= 'Accounting/deleteJournal';

//CRUD
$route['delete-data'] 	= 'Settings/deleteData';


$route['view-users'] 						 	= 'Settings/view_users';
$route['server-users'] 	= 'Settings/server_users';
$route['server-signatory'] 	= 'Settings/server_signatory';
$route['server-subsidiary'] 	= 'Settings/server_subsidiary';
$route['server-loan-type'] 	= 'Settings/server_loan_type';
$route['server-benefit-type'] 	= 'Settings/server_benefit_type';

$route['server-member-type'] 	= 'Settings/server_member_type';
$route['server-civil-status'] 	= 'Settings/server_civil_status';
$route['server-relationship-type'] 	= 'Settings/server_relationship_type';
$route['server-beneficiaries'] 	= 'Settings/server_beneficiaries';
$route['server-members-beneficiaries'] 	= 'Settings/server_members_beneficiaries';
$route['server-members-immediate-family'] 	= 'Settings/server_members_immediate_family';
$route['server-immediate-family'] 	= 'Settings/server_immediate_family';
$route['server-contribution-rate'] 	= 'Settings/server_contribution_rate';

$route['get-beneficiaries-members'] 	= 'Settings/getBeneficiariesMembers';
$route['get-immediate-family'] 	= 'Settings/getImmediateFamilyMembers';


$route['save-users-data'] 	= 'Settings/saveUsersData';
$route['save-contribution-rate'] 			= 'Settings/saveContributionRate';

$route['get-signatory-frm'] 	= 'Settings/getSignatoryFrm';
$route['get-subsidiary-frm'] 	= 'Settings/getSubsidiaryFrm';
$route['get-loan-types-frm'] 	= 'Settings/getLoanTypesFrm';
$route['get-benefit-type-frm'] 	= 'Settings/getBenefiTypesFrm';

$route['get-member-type-frm'] 	= 'Settings/getMemberTypeFrm';
$route['get-civil-status-frm'] 	= 'Settings/getCivilStatusFrm';
$route['get-relationship-type-frm'] 	= 'Settings/getRelationshipTypeFrm';
$route['get-beneficiaries-frm'] 	= 'Settings/getBeneficiariesFrm';
$route['get-immediate-family-frm'] 	= 'Settings/getImmediateFamilyFrm';
$route['get-frm-contribution-rate'] 	= 'Settings/getContributionRate';

$route['view-signatory'] 					= 'Settings/view_signatory';	
$route['view-subidiary'] 					= 'Settings/view_subidiary';	
$route['view-member-type'] 				= 'Settings/view_member_type';
$route['view-civil-status'] 			= 'Settings/view_civil_status';
$route['view-relationship-type'] 	= 'Settings/view_relationship_type';
$route['view-beneficiaries'] 			= 'Settings/view_beneficiaries';
$route['view-immediate-family'] 	= 'Settings/view_immediate_family';
$route['view-contribution-rate'] 	= 'Settings/view_contribution_rate';
$route['view-loan-ltype'] 				= 'Settings/view_loan_type';
$route['view-benefit-type'] 			= 'Settings/view_benefit_type';

$route['view-loan-type'] 					= 'Admin/view_loan_code';
$route['view-loan-settings'] 			= 'Admin/view_loan_settings';
$route['add-loans'] 							= 'Admin/add_loans';
$route['show-sub-frm'] 						= 'Admin/show_sub_frm';
$route['show-loans-settings-frm'] = 'Admin/show_add_loans';
$route['show-cash-gift-frm'] 			= 'Admin/show_add_cash_gift';
$route['show-cash-gift-frm-per-region'] 			= 'Admin/show_add_cash_gift_per_region';
$route['show-or-frm-per-region'] 			= 'Admin/show_official_receipt';
$route['show-frm-add-payments'] 	= 'Admin/show_add_payments';
$route['show-schedule-list'] 			= 'Admin/show_schedule_list';
$route['show-edit-payment-list'] 			= 'Admin/show_edit_payment_list';
$route['save-update-payments'] 			= 'Admin/save_update_payments';
$route['save-post-payment'] 			= 'Admin/savePostPayment';
$route['get-loan-settings-code'] 	= 'Admin/getSettingsCode';
$route['get-other-benefit-form'] 	= 'Admin/getOtherBenefitForm';

$route['show-main-frm'] 					= 'Admin/show_main_frm';
$route['save-sub-account'] 				= 'Admin/save_sub_account';
$route['save-loans-settings'] 		= 'Admin/save_loans_settings';
$route['save-cash-gift'] 					= 'Admin/save_cash_gift';
$route['get-cg-rate-per-member'] 	= 'Admin/getCgAmntPerMember';
$route['get-cg-rate-per-region'] 	= 'Admin/getCgAmntPerRegion';
$route['process-claim-benefit'] 				  = 'Admin/process_benefit_claim';
$route['server-tbl-claim-benefit-members'] 	= 'Admin/server_tbl_claim_benefit_members';
$route['view-contribution'] 			= 'Admin/view_contribution';
$route['delete-loan-settings'] 		= 'Admin/deleteLoanSettings';
$route['loans-application'] 			= 'Admin/loanApplication';
$route['view-loan-app-page'] 			= 'Admin/view_loan_app_page';
$route['process-a-loan'] 					= 'Admin/process_a_loan';
$route['edit-process-a-loan'] 		= 'Admin/edit_process_a_loan';
$route['server-contribution'] 		= 'Admin/server_tbl_contribution';
$route['server-cdj-entry'] 		= 'Admin/server_cdj_entry';
$route['server-crj-entry'] 		= 'Admin/server_crj_entry';
$route['server-gj-entry'] 		= 'Admin/server_gj_entry';
$route['server-pacs-entry'] 		= 'Admin/server_pacs_entry';
$route['server-co-maker'] 				= 'Admin/server_co_maker';
$route['server-tbl-settings'] 		= 'Admin/server_tbl_settings';
$route['server-tbl-loans-list'] 		= 'Admin/server_tbl_loans_list';
$route['server-general-ledger'] 	= 'Admin/serverGeneralLedger';
$route['server-cash-gift'] 	= 'Admin/serverCashGift';
$route['server-official-receipt'] 	= 'Admin/serverOfficialReceipt';
$route['server-get-repayment-list'] = 'Admin/server_tbl_repayments';






$route['add-cdj-entry'] 							= 'Admin/addCdjEntry';
$route['add-crj-entry'] 							= 'Admin/addCrjEntry';
$route['add-gj-entry'] 							= 'Admin/addGjEntry';
$route['add-pacs-entry'] 							= 'Admin/addPacsEntry';
$route['tbl-cdj-page'] 								= 'Admin/tblCdjPage';
$route['tbl-crj-page'] 								= 'Admin/tblCrjPage';
$route['tbl-gj-page'] 								= 'Admin/tblGjPage';
$route['tbl-pacs-page'] 								= 'Admin/tblPacsPage';
$route['save-loan-comp'] 					= 'Admin/saveLoanComp';
$route['compute-loans'] 					= 'Admin/computeLoans';	
$route['show-loans-list'] 				= 'Admin/showLoansList';
$route['show-loans-by-member'] 		= 'Admin/showLoansByMember';
$route['server-loans-by-member'] 	= 'Admin/server_loans_by_member';
$route['server-benefit-list-claimed-by-member'] 	= 'Admin/server_benefit_claim_by_member';
$route['post-loan-comp'] 					= 'Admin/postLoanComp';
$route['get-previous-loan'] 			= 'Admin/getPreviousLoan';
$route['get-print-loan-comp'] 	 	= 'Admin/getPrintLoanComp';
$route['show-co-maker'] 	 				= 'Admin/showComaker';
$route['show-co-maker-members-list'] = 'Admin/server_co_maker_members_list';
$route['insert-co-maker'] = 'Admin/insert_co_maker';
$route['remove-co-maker'] = 'Admin/remove_co_maker';
$route['save-co-maker'] = 'Admin/save_co_maker';
$route['update-data'] = 'Admin/updateData';
$route['get-frm-benefit-claim'] = 'Admin/getFrmBenefitClaim';
$route['compute-oth-benefit'] = 'Admin/computeOthBenefit';
$route['remove-benefit-claim'] = 'Admin/removeBenefitClaim';
$route['get-payee-type'] = 'Admin/getPayeeType';
$route['show-choose-date-post'] = 'Admin/showChooseDatePost';
$route['show-choose-region-type'] = 'Admin/showChooseRegionType';
$route['post-acct-entry'] = 'Admin/postAcctEntry';
$route['save-official-receipt'] = 'Admin/saveOfficialReceipt';

$route['pdf-vloan-comp/(:any)'] 	= 'Admin/pdfVloanComp';


$route['entry-new-password/(:any)']          = 'Admin/entry_new_password';
$route['submit-new-password']          = 'Admin/submit_new_password';
$route['logout'] 											= 'Admin/destroy_sess';
$route['lgu-id/(:any)'] 							= 'Admin/showID';
$route['lgu-c-details'] 							= 'Admin/fetch_indvl_details';
$route['show-multiple-ids'] 					= 'Admin/show_multiple_ids';
$route['show-mltple-const/(:any)'] 		= 'Admin/show_multiple_constituent';
$route['control-token'] 							= 'Admin/control_token';
$route['show-gen-token'] 							= 'Admin/show_gen_token';
$route['generate-token'] 							= 'Admin/generateToken';
$route['save-token'] 									= 'Admin/saveToken';

//reports
$route['crj-summary-report/(:any)/(:any)'] = 'Reports/crjSummaryReport';
$route['crj-contribution-and-payment/(:any)/(:any)/(:any)'] = 'Reports/contributionAndPayments';
$route['print-official-receipt/(:any)'] = 'Reports/printOR';
$route['print-pacs-report/(:any)/(:any)'] = 'Reports/pacsSummaryReport';
$route['print-cdj-report/(:any)/(:any)'] = 'Reports/cdjSummaryReport';
$route['print-gj-report/(:any)/(:any)'] = 'Reports/gjSummaryReport';
$route['print-transmittal-summary-report'] = 'Reports/printTransmittalSummaryReport';
$route['get-chkd-summary-dispatch']     = 'Admin/getChkSummaryDispatch';
$route['print-summary-dispatch/(:any)']  = 'Admin/printSummaryDispatch';

//dyon

$route['location-dashboard']             = 'Admin/locationDashboard';
$route['get-gatepass-print-frm'] 	= 'Admin/getGatePassPrintFrm';
$route['get-print-gatepass-report'] = 'Admin/getPrintGatePassReport';

$route['print-gatepass-slip'] 	                = 'Admin/printGatePass';
$route['print-gatepass-slip/(:any)'] 	        = 'Admin/printGatePass';
$route['print-gatepass-slip/(:any)/(:any)'] 	= 'Admin/printGatePass';
$route['get-jzon'] 	= 'Settings/getJson';


$route['404_override'] 					= '';
$route['translate_uri_dashes'] 	= FALSE;
