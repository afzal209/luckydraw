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
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PrizeDistributionController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LuckydrawController;
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
Route::post('post-register', [AuthController::class, 'postRegistration'])->name('register.post');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::middleware(['session.expired'])->group(function () {


Route::get('/user', [HomeController::class, 'user'])->name('user.user');

Route::get('/luckydraw', [LuckydrawController::class, 'luckydraw'])->name('luckydraw.luckydraw');
Route::get('/luckydraw/export/{type}', [App\Http\Controllers\LuckydrawController::class, 'export'])->name('luckydraw.export'); //Customer Dashboard to download the Tickets in CSV and PDF
Route::get('/my-prizes', [PrizeDistributionController::class, 'index'])->name('my.prizes'); // Display Luckydraw Winner Data

Route::get('/profile', [HomeController::class, 'profile'])->name('user.profile');

Route::get('/user_lottery', [HomeController::class, 'user_lottery'])->name('user.user_lottery');

Route::get('/user_referral', [HomeController::class, 'user_referral'])->name('user.user_referral');

Route::get('/user_transaction', [HomeController::class, 'user_transaction'])->name('user.user_transaction');

Route::get('/customer-profile', [CustomerController::class, 'profile'])->name('customers.profile');

Route::post('/avatar', [ProfileController::class, 'updateAvatar'])->name('avatar');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/update_personal', [ProfileController::class, 'update_personal'])->name('update_personal');
Route::post('/update_email', [ProfileController::class, 'update_email'])->name('update_email');
Route::post('/update_number', [ProfileController::class, 'update_number'])->name('update_number');
Route::post('/update_password', [ProfileController::class, 'update_password'])->name('update_password');

Route::get('/user_info', [HomeController::class, 'user_info'])->name('user_info');
Route::get('/user_transaction', [HomeController::class, 'user_transaction'])->name('user_transaction');
Route::get('/user_referral', [HomeController::class, 'user_referral'])->name('user_referral');
Route::get('/user_support', [HomeController::class, 'user_support'])->name('user_support');
Route::post('/insert_support', [HomeController::class, 'insert_support'])->name('insert_support');
Route::get('/faq', [HomeController::class, 'faq'])->name('faq');


Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::get('/profile/get_country', [ProfileController::class, 'get_country'])->name('profile/get_country');
Route::get('/profile/get_state', [ProfileController::class, 'get_state'])->name('profile/get_state');
});

Route::get('/contact', [HomeController::class, 'contact'])->name('contact');



Route::get('myticket/{id}', [HomeController::class, 'download_ticket_id'])->name('myticket');