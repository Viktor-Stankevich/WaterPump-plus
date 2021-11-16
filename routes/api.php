<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\PumpMeteRecordsController;
use App\Http\Controllers\TariffController;
use App\Http\Controllers\BillController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

Route::get('/userExisits', function () {
    $user = DB::table('users')->count();
    if($user < 1) {
        return true;
    }
});

Route::middleware('auth:sanctum')->get('/authenticated', function () {
    return true;
});


Route::post('/registration', [AuthController::class, 'registration']);
Route::post('/login',  [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/delete', [AuthController::class, 'delete']);

Route::resource('/resident', ResidentController::class);

Route::post('/payment', [PumpMeteRecordsController::class, 'createPumpMeterRecords']);
Route::get('/payment', [PumpMeteRecordsController::class, 'currentPrice']);
Route::get('/showCalculateForm', [PumpMeteRecordsController::class, 'showCalculateForm']);

Route::resource('/tariff', TariffController::class);

Route::post('/bill', [BillController::class, 'showBill']);
