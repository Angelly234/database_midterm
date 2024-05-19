<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\BlocksController;
use App\Http\Controllers\WalletsController;
use App\Http\Controllers\BlockChainController;
use App\Http\Controllers\TransactionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [BlocksController::class, 'index']);
Route::get('/wallet', [WalletsController::class, 'index'])->name('wallets.index');
Route::get('create-wallet', [WalletsController::class, 'formIndex'])->name('wallet.create');
Route::get('/wallets/{id}', [WalletsController::class, 'view'])->name('wallet.view');
Route::post('/create-wallet', [WalletsController::class, 'store'])->name('wallet.create');
Route::get('/send-currency/{id}', [WalletsController::class, 'sendForm'])->name('wallet.send-form');
Route::post('/send-currency/{id}', [WalletsController::class, 'storeTransaction'])->name('wallet.send-form');
Route::get('/wallet/{id}', [WalletsController::class, 'show'])->name('wallet.show');

Route::get('/mine/{id}', [TransactionController::class, 'mineForm'])->name('transaction.mine-form');
Route::post('/mine/{id}', [TransactionController::class, 'mine'])->name('transaction.mine');
