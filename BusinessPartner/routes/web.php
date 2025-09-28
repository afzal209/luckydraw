<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WalletTransactionController;
use App\Http\Controllers\ManageCustomerController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AccountSettingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [AuthController::class, 'index'])->name('login');

Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 





// Route::get('business_area', function () {
//     return view('business_area');
// });


// Route::get('region', function () {
//     return view('region');
// });

// Route::get('country', function () {
//     return view('country');
// });

// Route::get('city', function () {
//     return view('city');
// });

// Route::get('state', function () {
//     return view('state');
// });

// Route::get('template_manager', function () {
//     return view('template_manager');
// });

// Route::get('price_manager', function () {
//     return view('price_manager');
// });

Route::middleware(['session.expired'])->group(function () {

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard'); 

Route::get('logout', [AuthController::class, 'logout'])->name('logout');


//Single Sale
Route::get('sales/new_sale', [SaleController::class, 'index'])->name('sales.new_sale');

Route::get('sales/compress', [SaleController::class, 'compress'])->name('sales.compress');
Route::get('sales/{id}/print', [SaleController::class, 'print'])->name('sales.print');


Route::post('sales/new_sale/add_customer_id', [SaleController::class, 'add_customer_id'])->name('sales.new_sale.add_customer_id');

Route::post('sales/new_sale/get_customer_id', [SaleController::class, 'get_customer_id'])->name('sales.new_sale.get_customer_id');

Route::post('sales/new_sale/get_luckydraw_id', [SaleController::class, 'get_luckydraw_id'])->name('sales.new_sale.get_luckydraw_id');

Route::post('sales/new_sale/get_customer_data', [SaleController::class, 'get_customer_data'])->name('sales.new_sale.get_customer_data');

Route::post('sales/new_sale/create', [SaleController::class, 'create'])->name('sales.new_sale.create'); 

//Group Sale
Route::get('sales/group_sale', [SaleController::class, 'index'])->name('sales.group_sale');

Route::post('sales/group_sale/add_customer_id', [SaleController::class, 'add_customer_id'])->name('sales.group_sale.add_customer_id');

Route::post('sales/group_sale/get_customer_id', [SaleController::class, 'get_customer_id'])->name('sales.group_sale.get_customer_id');

Route::post('sales/group_sale/get_luckydraw_id', [SaleController::class, 'get_luckydraw_id'])->name('sales.group_sale.get_luckydraw_id');

Route::post('sales/group_sale/get_customer_data', [SaleController::class, 'get_customer_data'])->name('sales.group_sale.get_customer_data');

Route::post('sales/group_sale/create', [SaleController::class, 'create'])->name('sales.group_sale.create'); 


//View Sales
Route::get('sales/view_sale', [SaleController::class, 'view'])->name('sales.view_sale');

Route::get('sales/view_sale/edit/{id}', [SaleController::class, 'edit'])->name('sales.view_sale.edit'); 

Route::post('sales/view_sale/update/{id}', [SaleController::class, 'update'])->name('sales.view_sale.update');  


Route::get('product', [ProductController::class, 'index'])->name('product');

Route::post('product/create', [ProductController::class, 'create'])->name('product.create'); 

Route::get('product/view', [ProductController::class, 'view'])->name('product.view');

Route::get('product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit'); 

Route::post('product/update/{id}', [ProductController::class, 'update'])->name('product.update');  


Route::get('wallet_transaction', [WalletTransactionController::class, 'index'])->name('wallet_transaction');


Route::get('wallet', [WalletTransactionController::class, 'wallet_create'])->name('wallet');

Route::post('wallet/add', [WalletTransactionController::class, 'wallet_add'])->name('wallet.add');

Route::post('wallet_transaction/create', [WalletTransactionController::class, 'create'])->name('wallet_transaction.create'); 

Route::get('wallet_transaction/view', [WalletTransactionController::class, 'view'])->name('wallet_transaction.view');

Route::get('wallet_transaction/edit/{id}', [WalletTransactionController::class, 'edit'])->name('wallet_transaction.edit'); 

Route::post('wallet_transaction/update/{id}', [WalletTransactionController::class, 'update'])->name('wallet_transaction.update');  

Route::get('wallet_transaction/success', [WalletTransactionController::class, 'success'])->name('wallet_transaction.success');
Route::get('wallet_transaction/cancel', [WalletTransactionController::class, 'cancel'])->name('wallet_transaction.cancel');
Route::get('wallet_transaction/status', [WalletTransactionController::class, 'status'])->name('wallet_transaction.status');





Route::get('manage_customer/add_new_customer', [ManageCustomerController::class, 'index'])->name('manage_customer.add_new_customer');

Route::post('manage_customer/add_new_customer/create', [ManageCustomerController::class, 'create'])->name('manage_customer.add_new_customer.create');



Route::get('manage_customer/bulk_customer', [ManageCustomerController::class, 'bulk'])->name('manage_customer.bulk_customer');

Route::post('manage_customer/bulk_customer/customer_bulk_upload', [ManageCustomerController::class, 'customer_bulk_upload'])->name('manage_customer.bulk_customer.customer_bulk_upload');

Route::get('manage_customer/manage_customer_group', [ManageCustomerController::class, 'group'])->name('manage_customer.manage_customer_group');
Route::post('manage_customer/manage_customer_group/create_group', [ManageCustomerController::class, 'create_group'])->name('manage_customer.manage_customer_group.create_group');

Route::get('manage_customer/manage_customer_group/edit_group/{id}', [ManageCustomerController::class, 'edit_group'])->name('manage_customer.manage_customer_group.edit_group');

Route::post('manage_customer/manage_customer_group/update_group/{id}', [ManageCustomerController::class, 'update_group'])->name('manage_customer.manage_customer_group.update_group');

Route::get('manage_customer/manage_customer_group/delete_group/{id}', [ManageCustomerController::class, 'delete_group'])->name('manage_customer.manage_customer_group.delete_group');

Route::get('manage_customer/view_customer', [ManageCustomerController::class, 'view'])->name('manage_customer.view_customer');

Route::get('manage_customer/add_new_customer/edit/{id}', [ManageCustomerController::class, 'edit'])->name('manage_customer.add_new_customer.edit');


Route::post('manage_customer/add_new_customer/update/{id}', [ManageCustomerController::class, 'update'])->name('manage_customer.add_new_customer.update');


Route::get('support', [SupportController::class, 'index'])->name('support');

Route::post('support/create', [SupportController::class, 'create'])->name('support.create'); 

Route::get('support/view', [SupportController::class, 'view'])->name('support.view');

Route::get('support/edit/{id}', [SupportController::class, 'edit'])->name('support.edit'); 

Route::post('support/update/{id}', [SupportController::class, 'update'])->name('support.update');  



Route::get('profile', [ProfileController::class, 'index'])->name('profile');

Route::post('profile/update', [ProfileController::class, 'update'])->name('profile.update'); 

Route::post('profile/update_passord', [ProfileController::class, 'update_passord'])->name('profile.update_passord'); 

Route::get('profile/get_country', [ProfileController::class, 'get_country'])->name('profile.get_country');

Route::get('profile/get_state', [ProfileController::class, 'get_state'])->name('profile.get_state');


Route::get('setting', [AccountSettingController::class, 'index'])->name('setting');

Route::post('setting/create', [AccountSettingController::class, 'create'])->name('setting.create');


});


Route::get('myticket/{id}', [SaleController::class, 'download_ticket_id'])->name('myticket');
// Route::get('donor', [DonorController::class, 'index']); 

// Route::get('applicant', [ApplicantController::class, 'index']); 

// Route::get('add_expert', [ExpertController::class, 'index']); 

// Route::get('view_expert', [ExpertController::class, 'view'])->name('view_expert'); 
// Route::post('add_expert/district_list', [ExpertController::class, 'district_list'])->name('add_expert.district_list'); 


// Route::post('add_expert/city_list', [ExpertController::class, 'city_list'])->name('add_expert.city_list'); 

// Route::post('add_expert/create', [ExpertController::class, 'create'])->name('add_expert.create'); 

// Route::get('add_expert/edit/{id}', [ExpertController::class, 'edit'])->name('add_expert.edit'); 



// Route::post('add_expert/update/{id}', [ExpertController::class, 'update'])->name('add_expert.update'); 


// Route::post('faq/create', [FaqController::class, 'create'])->name('faq.create'); 
// Route::get('faq', [FaqController::class, 'index']); 
// Route::get('faq/edit/{id}', [FaqController::class, 'edit'])->name('faq.edit'); 
// Route::get('faq/view', [FaqController::class, 'view'])->name('faq.view'); 