<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Luckydraw;
use App\Models\LuckydrawTemplate;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/templates-by-luckydraw/{id}', function($id) {
    if($id == 'all') return LuckydrawTemplate::all();
    $luckydraw = Luckydraw::find($id);
    $ids = collect(explode(',', $luckydraw->template_id))->unique()->filter();
    return LuckydrawTemplate::whereIn('id', $ids)->get();
});