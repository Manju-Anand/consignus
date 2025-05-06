<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');
$routes->get('/home', 'Home::index');
$routes->get('/logout', 'Home::logout');
$routes->get('/login', 'LoginController::index');
$routes->post('login-form', 'LoginController::processForm'); 
$routes->get('/registration', 'LoginController::registration');
$routes->post('registration-form', 'LoginController::registrationProcess'); 

$routes->get('/staff', 'StaffController::index');
$routes->get('/add-staff', 'StaffController::addstaff');
$routes->post('staffadd-form', 'StaffController::savestaff'); 
$routes->post('staff/viewDetails', 'StaffController::viewDetails'); 
$routes->get('/edit-staff/(:num)', 'StaffController::editstaff/$1');
$routes->post('editstaff-form', 'StaffController::updatestaff'); 
$routes->get('/delete-staff/(:num)', 'StaffController::deletestaff/$1');

$routes->get('/customers', 'CustomersController::index');
$routes->get('/add-customer', 'CustomersController::addcustomer');
$routes->post('customeradd-form', 'CustomersController::savecustomer'); 
$routes->post('customers/viewDetails', 'CustomersController::viewDetails'); 
$routes->get('/edit-customer/(:num)', 'CustomersController::editcustomer/$1');
$routes->get('/delete-customer/(:num)', 'CustomersController::deletecustomer/$1');
$routes->post('customeredit-form', 'CustomersController::updatecustomer'); 

$routes->get('/followup-customer/(:num)', 'FollowupController::viewfollowup/$1');
$routes->post('followup-form', 'FollowupController::savefollowup'); 
$routes->get('/delete-followup/(:num)', 'FollowupController::deletefollowup/$1');


$routes->get('/property', 'PropertyController::index');
$routes->get('/add-property', 'PropertyController::addproperty');
$routes->post('propertyadd-form', 'PropertyController::saveproperty');
$routes->get('/edit-property/(:num)', 'PropertyController::editproperty/$1');
$routes->post('/property/delete-image/(:num)', 'PropertyController::deleteImage/$1');
$routes->post('propertyedit-form', 'PropertyController::updateproperty'); 
$routes->get('/delete-property/(:num)', 'PropertyController::deleteproperty/$1');
$routes->post('get-property-details', 'PropertyController::getPropertyDetails');


$routes->get('/services', 'ServiceController::index');
$routes->get('/add-service', 'ServiceController::addservice');
$routes->post('serviceadd-form', 'ServiceController::saveservice');
$routes->get('/edit-service/(:num)', 'ServiceController::editservice/$1');
$routes->post('/service/delete-image/(:num)', 'ServiceController::deleteserviceImage/$1');
$routes->post('serviceedit-form', 'ServiceController::updateservice');  
$routes->get('/delete-service/(:num)', 'ServiceController::deleteservice/$1');

$routes->get('/property-type', 'PropertytypeController::index');
$routes->get('/add-property-type', 'PropertytypeController::addpropertytype');
$routes->post('property-type-add-form', 'PropertytypeController::savepropertytype');
$routes->get('/edit-property-type/(:num)', 'PropertytypeController::editpropertytype/$1'); 
$routes->post('property-type-edit-form', 'PropertytypeController::updatepropertytype'); 
$routes->get('/delete-property-type/(:num)', 'PropertytypeController::deleteenquiry/$1');

$routes->get('/lbm', 'LbmController::index');
$routes->get('/add-lbm', 'LbmController::addlbm');
$routes->post('lbmadd-form', 'LbmController::savelbm'); 
$routes->post('lbm/viewDetails', 'LbmController::viewDetails'); 
$routes->get('/edit-lbm/(:num)', 'LbmController::editlbm/$1');
$routes->post('editlbm-form', 'LbmController::updatelbm'); 
$routes->get('/delete-lbm/(:num)', 'LbmController::deleteslbm/$1');
$routes->get('/team-assignment', 'LbmController::teamassign');

$routes->post('get-customer-details', 'LbmController::getcustomerDetails');
$routes->post('get-property-full-details', 'LbmController::getPropertyDetails');
$routes->post('teamassign-form', 'LbmController::saveteamassign'); 
$routes->get('/delete-teamassign/(:num)', 'LbmController::deleteteamassign/$1');

$routes->get('/team-work-update', 'TeamworkController::index');

$routes->get('/company-valuation', 'ShareController::index');
$routes->post('/valuation/saveAll', 'ShareController::saveAll');

$routes->get('/shareholder-master', 'ShareController::shareholdermaster');
$routes->post('/shareholder-master/save', 'ShareController::saveshareholder');

$routes->get('/share-purchase-list', 'ShareController::sharepurchaselist');
$routes->get('/share-purchase', 'ShareController::sharepurchase');
$routes->get('/share-transactions/available-shares/(:segment)', 'ShareController::availableShares/$1');
$routes->post('/share-transactions/save', 'ShareController::saveShareTransaction');
$routes->get('/edit-purchaselist/(:num)', 'ShareController::editpurchase/$1');
$routes->post('share-transactions/edit', 'ShareController::updatepurchase'); 
$routes->get('/delete-purchaselist/(:num)', 'ShareController::deletepurchase/$1');

$routes->get('/share-sale-list', 'ShareController::sharesaleslist');
$routes->get('/share-sale', 'ShareController::sharesale');
$routes->get('/share-sale/face-value/(:segment)', 'ShareController::faceValue/$1');





// $routes->get('/site-visit', 'SitevisitController::index');

// $routes->post('sitevisit/save', 'SitevisitController::saveTask');
// $routes->post('update-sitevisit', 'SitevisitController::updateSiteVisit');
// $routes->get('/delete-sitevisit/(:num)', 'SitevisitController::deleteSiteVisit');

// $routes->get('/download-bill', 'BillController::downloadBill');
// $routes->get('generate-pdf', 'BillController::generatePDF');

// $routes->get('/decisions', 'DecisionController::index');
// $routes->get('/add-decision', 'DecisionController::decisionAdd');
// $routes->post('decision-form', 'DecisionController::saveDecision');
// $routes->get('/edit-decision/(:num)', 'DecisionController::editdecision/$1');
// $routes->post('decision/updatedecision/(:num)', 'DecisionController::updateDecision/$1');
// $routes->get('/delete-decision/(:num)', 'DecisionController::deletedecision/$1');
// $routes->post('decisions/getEnquiryDetails', 'DecisionController::getEnquiryDetails');

// $routes->get('/quotations', 'QuotationController::index');
// $routes->get('/add-quotation', 'QuotationController::quotationAdd');
// $routes->post('save-content', 'QuotationController::saveContent');
// $routes->get('/edit-quotation/(:num)', 'QuotationController::editquotation/$1'); 
// $routes->post('update-content', 'QuotationController::updatequotation');
// $routes->get('/delete-quotation/(:num)', 'QuotationController::deletequotation/$1');
// $routes->get('/preview-quotation/(:num)', 'QuotationController::previewQuotation/$1');
// // $routes->get('downloadPDF/(:num)', 'QuotationController::generatePDF/$1');
// $routes->get('downloadPDF/(:num)', 'QuotationController::generatePDF/$1');
// // $routes->post('quotations/generate_pdf', 'QuotationController::downloadPDF');
// $routes->post('quotations/generate_pdf', 'QuotationController::downloadPDF');

// $routes->get('/stages', 'StageController::index');
// $routes->post('stages/save', 'StageController::saveTask');
// $routes->post('update-stages', 'StageController::updateStage');
// $routes->get('/delete-stages/(:num)', 'StageController::deleteStage/$1');

// $routes->get('/fees', 'FeeController::index');
// $routes->post('fees-save', 'FeeController::saveTask');
// $routes->post('update-fees', 'FeeController::updateFees');
// $routes->get('/delete-fees/(:num)', 'FeeController::deleteFees/$1');


// $routes->get('/packages', 'PackageController::index');
// $routes->post('packages-save', 'PackageController::saveTask');
