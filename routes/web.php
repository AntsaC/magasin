<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LapTopController;
use App\Http\Controllers\MagasinReceptionController;
use App\Http\Controllers\PalierController;
use App\Http\Controllers\ReturnController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SalePointController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\StockPvController;
use App\Http\Controllers\TransferController;
use App\Models\Brand;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::prefix('/magasin')->middleware(['role:magasin'])->group(function (){

        Route::get('dashboard', [DashboardController::class, 'magasin'])->name('magasin.dashboard');

        Route::get('dashboard/sale-point-stat', [DashboardController::class, 'pv_sale'])->name('sale.point.stat');

        Route::get('dashboard/benefice', [DashboardController::class, 'benefice'])->name('benefice');

        Route::get('dashboard/commision', [DashboardController::class, 'montant_commision'])->name('commission');



        Route::resource('laptops', LapTopController::class);

        Route::resource('sale-points', SalePointController::class);

        Route::resource('brands', BrandController::class);

        Route::resource('processors', \App\Http\Controllers\ProcessorController::class);

        Route::resource('users', \App\Http\Controllers\UserController::class);

        Route::resource('stocks', StockController::class);

        Route::get('/stocks-group', [StockController::class,'group'])->name('stocks.group');

        Route::resource('transfers', TransferController::class)->only(['index','store','create']);

        Route::get('/transfers-multiple', [TransferController::class, 'create_multiple'])->name('transfers.multiple');
        Route::post('/transfers-multiple', [TransferController::class, 'store_multiple'])->name('transfers.multiple-save');

        Route::get('/reception', [MagasinReceptionController::class,'reception'])->name('receptions.magasin');
        Route::get('/reception/create/{transfer}', [MagasinReceptionController::class,'reception_validation'])->name('receptions.magasin.form');
        Route::post('/reception/validation/{transfer}', [MagasinReceptionController::class,'validate_reception'])->name('receptions.magasin.validation');

        Route::resource('paliers', PalierController::class);

        Route::get('sales-detail/{month}/{year}', [SaleController::class, 'show_detail'])->name('sale-detail');


    });

    Route::middleware(['role:point de vente'])->prefix('/pv')->group(function (){
        Route::get('dashboard', [DashboardController::class, 'pv'])->name('pv.dashboard');

        Route::get('/receptions', [TransferController::class, 'reception'])->name('reception');
        Route::get('/receptions/validation/{transfer}', [TransferController::class, 'reception_validation'])->name('reception.validation');
        Route::post('receptions/{transfer}', [TransferController::class, 'validate_reception'])->name('reception.validate');

        Route::get('/stock',[StockPvController::class, 'index'])->name('stocks.pv');

        Route::prefix('/returns')->group(function () {

            Route::get('',[ReturnController::class, 'index'])->name('returns.index');
            Route::get('/create', [ReturnController::class, 'create'])->name('returns.create');
            Route::post('/store', [ReturnController::class, 'store'])->name('returns.store');

        });

        Route::resource('sales', SaleController::class);

        Route::get('sales-delete/{sale}',[SaleController::class, 'destroy_soft'])->name('sales.destroy-soft');

        Route::get('/laptops/{laptop}', [LapTopController::class, 'show'])->name('laptops.pv');

    });
});

