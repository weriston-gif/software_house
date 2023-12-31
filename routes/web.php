<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BudgetRegistrationController;
use App\Http\Controllers\BudgetRegistrationTypeController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('cadastro-orcamento-tipo', BudgetRegistrationTypeController::class);
Route::resource('cadastro-orcamento', BudgetRegistrationController::class);

Route::get('cadastro-orcamento-desktop', [BudgetRegistrationController::class, 'indexDesktop'])
    ->name('cadastro-orcamento-desktop');

Route::get('cadastro-orcamento-mobile', [BudgetRegistrationController::class, 'indexMobile'])
    ->name('cadastro-orcamento-mobile');

Route::get('cadastro-orcamento-web', [BudgetRegistrationController::class, 'indexWeb'])
    ->name('cadastro-orcamento-web');

Route::post('cadastro-orcamento-send/{id}', [BudgetRegistrationController::class, 'sendBudget'])
    ->name('enviar-orcamento');

Route::resource('admin', AdminController::class)
    ->middleware(AdminMiddleware::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
