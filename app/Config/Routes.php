<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// $routes->get('/', 'Home::index');
// $routes->get('/setlogin', function () {
//     session()->set('logged_user', 1);
//     return redirect()->to('/home');
// });

$routes->get('/', 'LoginController::index');
$routes->get('/home', 'Home::index');
$routes->get('/logout', 'Home::logout');
$routes->get('/login', 'LoginController::index');
$routes->post('signin-form', 'LoginController::processForm'); 
$routes->get('/registration', 'LoginController::registration');
$routes->post('registration-form', 'LoginController::registrationProcess'); 

$routes->get('/staff', 'StaffController::index');
$routes->get('/add-staff', 'StaffController::addstaff');
$routes->post('staffadd-form', 'StaffController::savestaff'); 
$routes->post('staff/viewDetails', 'StaffController::viewDetails'); 
$routes->get('data-staff-view-db', 'UserController::showAllTables');
$routes->get('/data-staff-db-tool', 'UserController::index');
$routes->post('/data-staff-db-tool', 'UserController::process');
$routes->get('data-staff-manager', 'UserController::fileindex');
$routes->post('data-staff-manager/upload', 'UserController::upload');
$routes->post('data-staff-manager/download', 'UserController::download');
$routes->post('data-staff-manager/delete', 'UserController::delete');
$routes->get('data-staff-truncate', 'UserController::truncateTables');
$routes->post('data-staff-truncate', 'UserController::truncateTables');
$routes->get('resizeAllPropertyImages', 'PropertyController::resizeAllPropertyImages');
$routes->get('admin/swap-property-folders', 'PropertyController::swapPropertyFolders');


$routes->get('/edit-staff/(:num)', 'StaffController::editstaff/$1');
$routes->post('editstaff-form', 'StaffController::updatestaff'); 
$routes->get('/delete-staff/(:num)', 'StaffController::deletestaff/$1');

$routes->get('/agents', 'AgentController::index');
$routes->get('/add-agents', 'AgentController::addagent');
$routes->post('agentsadd-form', 'AgentController::saveagent');
$routes->get('/edit-agents/(:num)', 'AgentController::editagents/$1');
$routes->post('editagents-form', 'AgentController::updateagents'); 
$routes->get('/delete-agents/(:num)', 'AgentController::deletesagents/$1');

$routes->get('/leads', 'LeadController::index');
$routes->get('/add-leads', 'LeadController::addleads');
$routes->post('leadsadd-form', 'LeadController::saveleads'); 
$routes->post('leads/viewDetails', 'LeadController::viewDetails'); 
$routes->get('/edit-leads/(:num)', 'LeadController::editleads/$1');
$routes->get('/delete-leads/(:num)', 'LeadController::deleteleads/$1');
$routes->post('leadsedit-form', 'LeadController::updateleads'); 
$routes->get('/lead-export', 'LeadController::leadexport');

$routes->get('/followup-leads/(:num)', 'FollowupController::viewfollowup/$1');
$routes->post('save-followup', 'FollowupController::savefollowup'); 
$routes->post('convertion/(:num)', 'FollowupController::convertion/$1');
$routes->post('convertion-form', 'FollowupController::save_conversion');
$routes->get('/delete-followup/(:num)', 'FollowupController::deletefollowup/$1');

$routes->get('/customers', 'CustomersController::index');
$routes->get('/add-customer', 'CustomersController::addcustomer');
$routes->post('customeradd-form', 'CustomersController::savecustomer'); 
$routes->post('customers/viewDetails', 'CustomersController::viewDetails'); 
$routes->get('/edit-customer/(:num)', 'CustomersController::editcustomer/$1');
$routes->get('/delete-customer/(:num)', 'CustomersController::deletecustomer/$1');
$routes->post('customeredit-form', 'CustomersController::updatecustomer');


$routes->get('/property', 'PropertyController::index');
$routes->get('/add-property', 'PropertyController::addproperty');
$routes->post('propertyadd-form', 'PropertyController::saveproperty');
$routes->get('/edit-property/(:num)', 'PropertyController::editproperty/$1');
$routes->post('/property/delete-image/(:num)', 'PropertyController::deleteImage/$1');
$routes->post('propertyedit-form', 'PropertyController::updateproperty'); 
$routes->get('/delete-property/(:num)', 'PropertyController::deleteproperty/$1');
$routes->post('get-property-details', 'PropertyController::getPropertyDetails');
$routes->get('/view-property/(:num)', 'PropertyController::viewproperty/$1');
$routes->get('ajax-search-property', 'PropertyController::ajaxSearchProperty');
$routes->get('/property-export', 'PropertyController::propertylistview');

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
$routes->get('/edit-teamassign/(:num)', 'TeamworkController::teamworkupdate/$1');
$routes->post('assignwork-updation', 'TeamworkController::saveteamworkupdate'); 
$routes->get('/lbm-contribution', 'TeamworkController::lbmcontribution'); 
$routes->get('/company-liability-list', 'TeamworkController::companyliability'); 
$routes->get('/liability-convertion', 'TeamworkController::liabilityconvertion'); 
$routes->post('/liability/saveSelected', 'TeamworkController::saveSelected'); 

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
$routes->get('share-sale/get-shareholders/(:any)', 'ShareController::getShareholders/$1');
$routes->post('/share-sale/save', 'ShareController::saveSharesales');
$routes->get('totalshare/getShareholderBalance/(:num)', 'ShareController::getShareholderBalance/$1');
$routes->get('/delete-saleslist/(:num)', 'ShareController::deletesale/$1');
$routes->get('/share-transactions/share-summary/(:num)', 'ShareController::shareSummary/$1');
$routes->post('share-transactions/add-shares', 'ShareController::savenewaddedShares');

$routes->get('/account-heads', 'AccountheadsController::index');
$routes->post('/accounting/add-head', 'AccountheadsController::saveaccountheads');
$routes->get('/delete-accountheads/(:num)', 'AccountheadsController::deleteaccounthead/$1');
$routes->post('/accounting/edit-head', 'AccountheadsController::updateaccountheads');

$routes->get('/payment-modes', 'AccountheadsController::paymentmodes');
$routes->post('accounting/save-payment-mode', 'AccountheadsController::savepaymentmodes');
$routes->get('/delete-paymentmode/(:num)', 'AccountheadsController::deletepaymentmodes/$1');
$routes->post('/accounting/edit-payment-mode', 'AccountheadsController::updatepaymentmodes');

$routes->get('/transactions-list', 'TransactionController::index');
$routes->get('/add-transaction', 'TransactionController::transactionadd');
$routes->post('accounting/save-transaction', 'TransactionController::savetransactions');
$routes->get('/delete-transactions/(:num)', 'TransactionController::deletetransactions/$1');
$routes->get('/edit-transactions/(:num)', 'TransactionController::edittransactions/$1');
$routes->post('accounting/update-transaction', 'TransactionController::updatetransactions');
$routes->get('/income-and-expenditure', 'TransactionController::incomeexpenditure');
