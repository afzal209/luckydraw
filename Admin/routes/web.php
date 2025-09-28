<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BusinessAreaController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\TemplateManagerController;
use App\Http\Controllers\PriceManagerController;
use App\Http\Controllers\BusinessPartnerController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LuckyDrawController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\WalletTransactionController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\SalesReportController;
use App\Http\Controllers\LuckydrawReportController;
use App\Http\Controllers\WalletReportController;
use App\Http\Controllers\OverallSalesReportController;

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


Route::prefix('reports')->name('reports.')->group(function () {
    Route::get('/', [ReportController::class, 'index'])->name('index');
    
    // Customers report page
    Route::get('/customers', [ReportController::class, 'customers'])->name('customers');
    
    // Export routes
    Route::get('/customers/export/csv', [ReportController::class, 'exportCustomersCsv'])->name('customers.export.csv');
    Route::get('/customers/export/pdf', [ReportController::class, 'exportCustomersPdf'])->name('customers.export.pdf');
    Route::get('/customers/export', [ReportController::class, 'exportCustomers'])->name('customers.export');
    // AJAX dependent dropdowns
    Route::get('/get-states/{country_id}', [ReportController::class, 'getStates'])->name('getStates');
    Route::get('/get-cities/{state_id}', [ReportController::class, 'getCities'])->name('getCities');
   
    // Business Partner report 
    Route::get('/business-partners', [ReportController::class, 'businessPartnersReport'])->name('business_partners');
    Route::get('/business-partners/export/csv', [ReportController::class, 'exportBusinessPartnersCsv'])->name('business_partners.export.csv');
    Route::get('/business-partners/export/pdf', [ReportController::class, 'exportBusinessPartnersPdf'])->name('business_partners.export.pdf');

    // Sales report
    Route::get('/sales', [ReportController::class, 'salesReport'])->name('sales');

    // Luckydraw report
    Route::get('/luckydraws', [ReportController::class, 'luckydrawReport'])->name('luckydraws');
});

//Sales Report This is NOT the overall Sales Controller. Its Luckydraw Sales ControllerS
Route::get('/sales-report', [SalesReportController::class, 'index'])->name('sales.report');
Route::get('/sales-report/export/{type}', [SalesReportController::class, 'export'])->name('sales.report.export');

//Luckydraw Reports
Route::get('/luckydraw-report', [LuckydrawReportController::class, 'index'])->name('luckydraw.report');
Route::post('/luckydraw-report/filter', [LuckydrawReportController::class, 'filter'])->name('luckydraw.report.filter');
// For downloads
Route::get('/luckydraw-report/export/csv', [LuckydrawReportController::class, 'exportCsv'])->name('luckydraw.report.export.csv');
Route::get('/luckydraw-report/export/pdf', [LuckydrawReportController::class, 'exportPdf'])->name('luckydraw.report.export.pdf');

//Wallet Report
Route::get('/wallet-report', [WalletReportController::class, 'index'])->name('wallet.report');
Route::post('/wallet-report/filter', [WalletReportController::class, 'filter'])->name('wallet.report.filter');
Route::get('/wallet-report/export/csv', [WalletReportController::class, 'exportCsv'])->name('wallet.report.export.csv');
Route::get('/wallet-report/export/pdf', [WalletReportController::class, 'exportPdf'])->name('wallet.report.export.pdf');

//Overall Sales report
Route::get('/overall-sales-report', [OverallSalesReportController::class, 'index'])->name('overallSales.report');
Route::post('/overall-sales-report', [OverallSalesReportController::class, 'generateReport'])->name('overallSales.generateReport');

// Route::middleware('guest')->group(function () {
Route::get('/', [AuthController::class, 'index'])->name('login');

Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');

// });

Route::get('registration', [AuthController::class, 'registration'])->name('register');

Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post'); 
Route::middleware(['session.expired'])->group(function () {
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard'); 

Route::get('logout', [AuthController::class, 'logout'])->name('logout');



Route::get('business_area', [BusinessAreaController::class, 'index'])->name('business_area'); 

Route::post('business_area/create', [BusinessAreaController::class, 'create'])->name('business_area.create'); 

Route::get('business_area/edit/{id}', [BusinessAreaController::class, 'edit'])->name('business_area.edit'); 

Route::post('business_area/update/{id}', [BusinessAreaController::class, 'update'])->name('business_area.update'); 

Route::get('business_area/status/{id}/{actions}', [BusinessAreaController::class, 'status'])->name('business_area.status');
Route::get('business_area/delete/{id}', [BusinessAreaController::class, 'delete'])->name('business_area.delete');
Route::get('business_area/validation', [BusinessAreaController::class, 'validation'])->name('business_area.validation'); 
Route::post('business_area/clear', [BusinessAreaController::class, 'clear'])->name('business_area.clear');

Route::get('region', [RegionController::class, 'index'])->name('region'); 

Route::post('region/create', [RegionController::class, 'create'])->name('region.create'); 

Route::get('region/edit/{id}', [RegionController::class, 'edit'])->name('region.edit'); 

Route::post('region/update/{id}', [RegionController::class, 'update'])->name('region.update'); 

Route::get('region/status/{id}/{actions}', [RegionController::class, 'status'])->name('region.status');
Route::get('region/delete/{id}', [RegionController::class, 'delete'])->name('region.delete');
Route::get('region/validation', [RegionController::class, 'validation'])->name('region.validation'); 
Route::post('region/clear', [CountryController::class, 'clear'])->name('region.clear');

Route::get('country', [CountryController::class, 'index'])->name('country'); 

Route::post('country/create', [CountryController::class, 'create'])->name('country.create'); 

Route::get('country/edit/{id}', [CountryController::class, 'edit'])->name('country.edit'); 

Route::post('country/update/{id}', [CountryController::class, 'update'])->name('country.update'); 

Route::get('country/status/{id}/{actions}', [CountryController::class, 'status'])->name('country.status');
Route::get('country/delete/{id}', [CountryController::class, 'delete'])->name('country.delete');
Route::get('country/validation', [CountryController::class, 'validation'])->name('country.validation');
Route::post('country/clear', [CountryController::class, 'clear'])->name('country.clear');

Route::get('state', [StateController::class, 'index'])->name('state'); 

Route::post('state/create', [StateController::class, 'create'])->name('state.create'); 

Route::get('state/edit/{id}', [StateController::class, 'edit'])->name('state.edit'); 

Route::post('state/update/{id}', [StateController::class, 'update'])->name('state.update'); 

Route::get('state/status/{id}/{actions}', [StateController::class, 'status'])->name('state.status');
Route::get('state/delete/{id}', [StateController::class, 'delete'])->name('state.delete');
Route::get('state/validation', [StateController::class, 'validation'])->name('state.validation');
Route::post('state/clear', [StateController::class, 'clear'])->name('state.clear');

Route::get('city', [CityController::class, 'index'])->name('city'); 

Route::get('city/get_country', [CityController::class, 'get_country'])->name('city.get_country'); 

Route::post('city/create', [CityController::class, 'create'])->name('city.create'); 

Route::get('city/edit/{id}', [CityController::class, 'edit'])->name('city.edit'); 

Route::post('city/update/{id}', [CityController::class, 'update'])->name('city.update'); 

Route::get('city/status/{id}/{actions}', [CityController::class, 'status'])->name('city.status');
Route::get('city/delete/{id}', [CityController::class, 'delete'])->name('city.delete');
Route::get('city/validation', [CityController::class, 'validation'])->name('city.validation');
Route::post('city/clear', [CountryController::class, 'clear'])->name('city.clear');

Route::get('template_manager', [TemplateManagerController::class, 'index'])->name('template_manager'); 
Route::post('template_manager/create', [TemplateManagerController::class, 'create'])->name('template_manager.create'); 
Route::get('template_manager/edit/{id}', [TemplateManagerController::class, 'edit'])->name('template_manager.edit'); 
Route::post('template_manager/update/{id}', [TemplateManagerController::class, 'update'])->name('template_manager.update'); 
Route::get('template_manager/status/{id}/{actions}', [TemplateManagerController::class, 'status'])->name('template_manager.status');
Route::get('template_manager/delete/{id}', [TemplateManagerController::class, 'delete'])->name('template_manager.delete');
Route::get('template_manager/validation', [TemplateManagerController::class, 'validation'])->name('template_manager.validation');
Route::post('template_manager/clear', [CountryController::class, 'clear'])->name('template_manager.clear');

Route::get('template_manager_group/group', [TemplateManagerController::class, 'group'])->name('template_manager_group.group');
Route::post('template_manager_group/create_group', [TemplateManagerController::class, 'create_group'])->name('template_manager_group.create_group');
Route::get('template_manager_group/edit_group/{id}', [TemplateManagerController::class, 'edit_group'])->name('template_manager_group.edit_group');
Route::post('template_manager_group/update_group/{id}', [TemplateManagerController::class, 'update_group'])->name('template_manager_group.update_group');
Route::get('template_manager_group/status_group/{id}/{actions}', [TemplateManagerController::class, 'status_group'])->name('template_manager_group.status_group');
Route::get('template_manager_group/delete_group/{id}', [TemplateManagerController::class, 'delete_group'])->name('template_manager_group.delete_group');


Route::get('price_manager', [PriceManagerController::class, 'index'])->name('price_manager'); 

Route::post('price_manager/create', [PriceManagerController::class, 'create'])->name('price_manager.create'); 

Route::get('price_manager/edit/{id}', [PriceManagerController::class, 'edit'])->name('price_manager.edit'); 

Route::post('price_manager/update/{id}', [PriceManagerController::class, 'update'])->name('price_manager.update'); 

Route::get('price_manager/status/{id}/{actions}', [PriceManagerController::class, 'status'])->name('price_manager.status');
Route::get('price_manager/delete/{id}', [PriceManagerController::class, 'delete'])->name('price_manager.delete');
Route::get('price_manager/validation', [PriceManagerController::class, 'validation'])->name('price_manager.validation');
Route::post('price_manager/clear', [CountryController::class, 'clear'])->name('price_manager.clear');
//Support Routes
Route::get('support', [SupportController::class, 'index'])->name('support');

Route::post('support/create', [SupportController::class, 'create'])->name('support.create'); 

Route::get('support/view', [SupportController::class, 'view'])->name('support.view');

Route::get('support/edit/{id}', [SupportController::class, 'edit'])->name('support.edit'); 

Route::post('support/update/{id}', [SupportController::class, 'update'])->name('support.update');  

Route::post('support/update_support/{id}', [SupportController::class, 'update_support'])->name('support.update_support');  
Route::get('support/delete/{id}', [SupportController::class, 'delete'])->name('support.delete');


//Wallet Routes
Route::get('wallet_transaction', [WalletTransactionController::class, 'index'])->name('wallet_transaction');

Route::get('wallet', [WalletTransactionController::class, 'wallet_create'])->name('wallet');

Route::post('wallet/add', [WalletTransactionController::class, 'wallet_add'])->name('wallet.add');

Route::post('wallet_transaction/create', [WalletTransactionController::class, 'create'])->name('wallet_transaction.create'); 

Route::get('wallet_transaction/view', [WalletTransactionController::class, 'view'])->name('wallet_transaction.view');

Route::get('wallet_transaction/edit/{id}', [WalletTransactionController::class, 'edit'])->name('wallet_transaction.edit'); 

Route::post('wallet_transaction/update/{id}', [WalletTransactionController::class, 'update'])->name('wallet_transaction.update');  

Route::get('wallet_transaction/approve_wallet/{id}', [WalletTransactionController::class, 'approve_wallet'])
    ->name('wallet_transaction.approve_wallet');
    
Route::post('wallet_transaction/reject_wallet/{id}', [WalletTransactionController::class, 'reject_wallet'])
    ->name('wallet_transaction.reject_wallet');    
    
Route::get('business_partners/partner', [BusinessPartnerController::class, 'index'])->name('business_partners.partner');

Route::get('business_partners/partner/get_region', [BusinessPartnerController::class, 'get_region'])->name('business_partners.partner.get_region');


Route::get('business_partners/partner/get_region_luckydraw', [BusinessPartnerController::class, 'get_region_luckydraw'])->name('business_partners.partner.get_region_luckydraw');



Route::get('business_partners/partner/get_country', [BusinessPartnerController::class, 'get_country'])->name('business_partners.partner.get_country');

Route::get('business_partners/partner/get_state', [BusinessPartnerController::class, 'get_state'])->name('business_partners.partner.get_state');

Route::get('business_partners/partner/get_luckydraw_data', [BusinessPartnerController::class, 'get_luckydraw_data'])->name('business_partners.partner.get_luckydraw_data');

Route::get('business_partners/partner/get_bp_luckydraw_data', [BusinessPartnerController::class, 'get_bp_luckydraw_data'])->name('business_partners.partner.get_bp_luckydraw_data');
Route::get('business_partners/partner/get_bp_business_data', [BusinessPartnerController::class, 'get_bp_business_data'])->name('business_partners.partner.get_bp_business_data');


Route::post('business_partners/partner/create', [BusinessPartnerController::class, 'create'])->name('business_partners.partner.create'); 

Route::get('business_partners/partners', [BusinessPartnerController::class, 'view'])->name('business_partners.partners');

Route::get('business_partners/partners/status/{id}/{actions}', [BusinessPartnerController::class, 'status'])->name('business_partners.partner.status');

Route::get('business_partners/partner/edit/{id}', [BusinessPartnerController::class, 'edit'])->name('business_partners.partner.edit'); 

Route::get('business_partners/assign_luckydraws/edit/{id}', [BusinessPartnerController::class, 'assign_luckydraws'])->name('business_partners.assign_luckydraws.edit'); 

Route::get('business_partners/partners/view_luckydraw/{id}', [BusinessPartnerController::class, 'view_luckydraw'])->name('business_partners.partner.view_luckydraw'); 

Route::post('business_partners/partner/update/{id}', [BusinessPartnerController::class, 'update'])->name('business_partners.partner.update'); 

Route::post('business_partners/assign_luckydraws/update/{id}', [BusinessPartnerController::class, 'assign_luckydraws_update'])->name('business_partners.assign_luckydraws.update');

Route::get('business_partners/validation', [BusinessPartnerController::class, 'validation'])->name('business_partners.validation'); 

Route::post('business_partners/assign_luckydraws/bulk/update', [BusinessPartnerController::class, 'assign_luckydraws_bulk_update'])->name('business_partners.assign_luckydraws.bulk.update');

//Bulk Assign Luckydraws to Multiple Business Partners
Route::get('business_partners/assign_luckydraws/bulk', [BusinessPartnerController::class, 'assign_bulk_luckydraws'])->name('business_partners.assign_luckydraws.bulk');
Route::get('business_partners/delete/{id}', [BusinessPartnerController::class, 'delete'])->name('business_partners.delete');
Route::get('luckydraw/validation', [LuckyDrawController::class, 'validation'])->name('luckydraw.validation'); 


Route::get('customer', [CustomerController::class, 'index'])->name('customer'); 
Route::get('customer/edit/{id}', [CustomerController::class, 'edit'])->name('customer.edit'); 
Route::post('customer/update/{id}', [CustomerController::class, 'update'])->name('customer.update'); 
Route::get('customer/status/{id}/{actions}', [CustomerController::class, 'status'])->name('customer.status'); 

Route::get('luckydraws/add', [LuckyDrawController::class, 'add'])->name('luckydraws.add'); 
Route::get('luckydraws', [LuckyDrawController::class, 'index'])->name('luckydraws'); 
Route::get('luckydraw/get_template_option', [LuckyDrawController::class, 'get_template_option'])->name('luckydraw.get_template_option');
Route::get('luckydraw/get_country', [LuckyDrawController::class, 'get_country'])->name('luckydraw.get_country'); 

Route::get('luckydraw/get_state', [LuckyDrawController::class, 'get_state'])->name('luckydraw.get_state');


Route::get('luckydraw/get_luckydraw_country', [LuckyDrawController::class, 'get_luckydraw_country'])->name('luckydraw.get_luckydraw_country');
Route::get('luckydraw/get_luckydraw_state', [LuckyDrawController::class, 'get_luckydraw_state'])->name('luckydraw.get_luckydraw_state');

Route::get('luckydraw/get_declare_winner', [LuckyDrawController::class, 'get_declare_winner'])->name('luckydraw.get_declare_winner');
Route::get("luckydraw/get_view_winner", [LuckyDrawController::class, 'get_view_winner'])->name('luckydraw.get_view_winner');

Route::post('luckydraw/create', [LuckyDrawController::class, 'create'])->name('luckydraw.create'); 

Route::get('luckydraw/edit/{id}', [LuckyDrawController::class, 'edit'])->name('luckydraw.edit'); 


Route::get('luckydraw/view_sale/{id}', [LuckyDrawController::class, 'view_sale'])->name('luckydraw.view_sale'); 

Route::post('luckydraw/update/{id}', [LuckyDrawController::class, 'update'])->name('luckydraw.update'); 

Route::get('luckydraw/status/{id}/{actions}', [LuckyDrawController::class, 'status'])->name('luckydraw.status');
Route::get('luckydraw/delete/{id}', [LuckyDrawController::class, 'delete'])->name('luckydraw.delete');
Route::get('luckydraw/get_luckydraw_sale', [LuckyDrawController::class, 'get_luckydraw_sale'])->name('luckydraw.get_luckydraw_sale');
Route::post('luckydraw/save_winner_data', [LuckyDrawController::class, 'saveWinnerData'])->name('luckydraw.save_winner_data');
Route::get('luckydraw/view_winner/{id}', [LuckyDrawController::class, 'view_winner'])->name('luckydraw.view_winner');
Route::post('luckydraw/update_prize_tx', [LuckyDrawController::class, 'update_prize_tx'])->name('luckydraw.update_prize_tx');

Route::get('sales', [SalesController::class, 'index'])->name('sales'); 

Route::get('settings/general_setting', [SettingController::class, 'index'])->name('settings.general_setting');
Route::post('settings/general_setting/update', [SettingController::class, 'update'])->name('settings.general_setting.update'); 
Route::get('settings/payment_gateway', [SettingController::class, 'payment_gateway'])->name('settings.payment_gateway');
Route::post('settings/payment_gateway/create_general_payment_gateway', [SettingController::class, 'create_general_payment_gateway'])->name('settings.payment_gateway.create_general_payment_gateway');
Route::post('settings/payment_gateway/create_international_payment_gateway', [SettingController::class, 'create_international_payment_gateway'])->name('settings.payment_gateway.create_international_payment_gateway');
Route::get('settings/manage_smtp_mail', [SettingController::class, 'manage_smtp_mail'])->name('settings.manage_smtp_mail');
Route::post('settings/manage_smtp_mail/save_smtp', [SettingController::class, 'save_smtp'])->name('settings.manage_smtp_mail.save_smtp');
Route::post('settings/manage_smtp_mail/sendSmtpTest', [SettingController::class, 'sendSmtpTest'])->name('settings.manage_smtp_mail.sendSmtpTest');

Route::get('report', [ReportController::class, 'report'])->name('report');


});

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