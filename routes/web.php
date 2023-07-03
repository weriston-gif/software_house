<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BudgetRegistrationController;
use App\Http\Controllers\BudgetRegistrationMobileController;


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




Route::resource('cadastro-orcamento', BudgetRegistrationController::class);
Route::resource('cadastro-orcamento-mobile', BudgetRegistrationMobileController::class);

//Route::post('/cadastro-orcamento', [BudgetController::class, 'store'])->name('budget.index');


//Route::match(['GET', 'POST'],'/mobile', [BudgetController::class, 'indexMobile'])->name('budget.budget-mobile');
//Route::post('/mobile', [BudgetController::class, 'storeMobile'])->name('budget.budget-mobile');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
