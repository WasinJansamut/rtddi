<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PolicestationController;
use App\Http\Controllers\PopulationController;
use App\Http\Controllers\DeathcertController;
use App\Http\Controllers\PoliceController;
use App\Http\Controllers\EclaimController;
use App\Http\Controllers\ProcessController;





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

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/', [HomeController::class, 'welcome'])->name('welcome');


Route::middleware(['auth:sanctum', 'verified'])->get('home', [HomeController::class, 'index']);
Route::middleware(['auth:sanctum', 'verified'])->get('dashboard', [HomeController::class, 'index']);
Route::middleware(['auth:sanctum', 'verified'])->get('cleartemp', [HomeController::class, 'cleartemp']);
Route::middleware(['auth:sanctum', 'verified'])->get('logs', [HomeController::class, 'logs']);

 

Route::middleware(['auth:sanctum', 'verified'])->resource('users', UsersController::class);
Route::middleware(['auth:sanctum', 'verified'])->get('userscreate',[UsersController::class, 'create']);
Route::middleware(['auth:sanctum', 'verified'])->post('usersregister',[UsersController::class, 'store']);
Route::middleware(['auth:sanctum', 'verified'])->get('/userban/{id}', [UsersController::class, 'ban']);
Route::middleware(['auth:sanctum', 'verified'])->get('/userunban/{id}', [UsersController::class, 'unban']);
Route::middleware(['auth:sanctum', 'verified'])->get('/resetpw/{id}', [UsersController::class, 'resetpw']);



Route::middleware(['auth:sanctum', 'verified'])->resource('policestation', PolicestationController::class);
Route::middleware(['auth:sanctum', 'verified'])->resource('population', PopulationController::class);


Route::get('autocomplete', [PolicestationControllers::class, 'autocomplete'])->name('autocomplete');

Route::get('/clear-cache-all', function() {
    Artisan::call('cache:clear');
    dd("Cache Clear All");

});

Route::get('signout', [UsersController::class, 'logout']);
//Route::get('userinformation', [UsersController::class, 'userinformation']);

Route::middleware(['auth:sanctum', 'verified'])->get('importExportView', [PopulationController::class, 'importExportView']);
Route::middleware(['auth:sanctum', 'verified'])->get('export', [PopulationController::class, 'export'])->name('export');
Route::middleware(['auth:sanctum', 'verified'])->post('import', [PopulationController::class, 'import'])->name('import');
Route::middleware(['auth:sanctum', 'verified'])->post('import3', [PopulationController::class, 'import3'])->name('import3');

//Route::post('population.import2', [PopulationController::class, 'import'])->name('import2');

// Step 1 Importing
Route::middleware(['auth:sanctum', 'verified'])->get('/importdeathcert', [DeathcertController::class, 'import1']);
Route::middleware(['auth:sanctum', 'verified'])->post('importdeathcert2', [DeathcertController::class, 'import2'])->name('importdeathcert2');
Route::middleware(['auth:sanctum', 'verified'])->post('importdeathcert3', [DeathcertController::class, 'import3'])->name('importdeathcert3');

Route::middleware(['auth:sanctum', 'verified'])->get('/importpolice', [PoliceController::class, 'import1']);
Route::middleware(['auth:sanctum', 'verified'])->post('importpolice2', [PoliceController::class, 'import2'])->name('importpolice2');
Route::middleware(['auth:sanctum', 'verified'])->post('importpolice3', [PoliceController::class, 'import3'])->name('importpolice3');

Route::middleware(['auth:sanctum', 'verified'])->get('/importeclaim', [EclaimController::class, 'import1']);
Route::middleware(['auth:sanctum', 'verified'])->post('importeclaim2', [EclaimController::class, 'import2'])->name('importeclaim2');
Route::middleware(['auth:sanctum', 'verified'])->post('importeclaim3', [EclaimController::class, 'import3'])->name('importeclaim3');

// Step 2 Preparing 
// Deathcert
Route::middleware(['auth:sanctum', 'verified'])->get('datadeathcert', [DeathcertController::class, 'datadeathcert'])->name('datadeathcert');
Route::middleware(['auth:sanctum', 'verified'])->get('/datadeathcert/{id}', [DeathcertController::class, 'showdata'] );
Route::middleware(['auth:sanctum', 'verified'])->get('/datadeathcert/exportprepare/{id}', [DeathcertController::class, 'exportprepare']);
Route::middleware(['auth:sanctum', 'verified'])->get('/datadeathcert/cancel/{id}', [DeathcertController::class, 'cancel']);
Route::middleware(['auth:sanctum', 'verified'])->get('/datadeathcert/uncancel/{id}', [DeathcertController::class, 'uncancel']);
Route::middleware(['auth:sanctum', 'verified'])->get('/datadeathcert/delete/{id}', [DeathcertController::class, 'destroy']);

// Police
Route::middleware(['auth:sanctum', 'verified'])->get('datapolice', [PoliceController::class, 'datapolice'])->name('datapolice');
Route::middleware(['auth:sanctum', 'verified'])->get('/datapolice/{id}', [PoliceController::class, 'showdata'] );
Route::middleware(['auth:sanctum', 'verified'])->get('/datapolice/exportprepare/{id}', [PoliceController::class, 'exportprepare']);
Route::middleware(['auth:sanctum', 'verified'])->get('/datapolice/cancel/{id}', [PoliceController::class, 'cancel']);
Route::middleware(['auth:sanctum', 'verified'])->get('/datapolice/uncancel/{id}', [PoliceController::class, 'uncancel']);
Route::middleware(['auth:sanctum', 'verified'])->get('/datapolice/delete/{id}', [PoliceController::class, 'destroy']);

// E-claim
Route::middleware(['auth:sanctum', 'verified'])->get('dataeclaim', [EclaimController::class, 'dataeclaim'])->name('dataeclaim');
Route::middleware(['auth:sanctum', 'verified'])->get('/dataeclaim/{id}', [EclaimController::class, 'showdata'] );
Route::middleware(['auth:sanctum', 'verified'])->get('/dataeclaim/exportprepare/{id}', [EclaimController::class, 'exportprepare']);
Route::middleware(['auth:sanctum', 'verified'])->get('/dataeclaim/cancel/{id}', [EclaimController::class, 'cancel']);
Route::middleware(['auth:sanctum', 'verified'])->get('/dataeclaim/uncancel/{id}', [EclaimController::class, 'uncancel']);
Route::middleware(['auth:sanctum', 'verified'])->get('/dataeclaim/delete/{id}', [EclaimController::class, 'destroy']);


//Step 3 Processing
Route::middleware(['auth:sanctum', 'verified'])->get('/process/{y}', [ProcessController::class, 'process1'])->name('process1');
Route::middleware(['auth:sanctum', 'verified'])->post('process2', [ProcessController::class, 'process2'])->name('process2');
Route::middleware(['auth:sanctum', 'verified'])->get('process3/{id}', [ProcessController::class, 'process3'])->name('process3');
Route::middleware(['auth:sanctum', 'verified'])->get('process4/{id}', [ProcessController::class, 'process4'])->name('process4');
Route::middleware(['auth:sanctum', 'verified'])->get('process5/{id}', [ProcessController::class, 'process5'])->name('process5');
Route::middleware(['auth:sanctum', 'verified'])->get('process6/{id}', [ProcessController::class, 'process6'])->name('process6');

Route::middleware(['auth:sanctum', 'verified'])->get('/process/exportprefinal/{id}', [ProcessController::class, 'exportprocessprefinal']);
Route::middleware(['auth:sanctum', 'verified'])->get('/process/exportfinal/{dead_year}', [ProcessController::class, 'exportprocessfinal']);
Route::middleware(['auth:sanctum', 'verified'])->get('/processexportfinal', [ProcessController::class, 'exportprocessfinal']);

Route::middleware(['auth:sanctum', 'verified'])->get('/exportprotocolprefinal/{id}/{protocol}', [ProcessController::class, 'exportprotocolprefinal']);
Route::middleware(['auth:sanctum', 'verified'])->get('/exportprotocolfinal/{dead_year}/{protocol}', [ProcessController::class, 'exportprotocolfinal']);

Route::middleware(['auth:sanctum', 'verified'])->get('process-raw', [ProcessController::class, 'processRaw'])->name('processRaw');


//Report

Route::middleware(['auth:sanctum', 'verified'])->get('process-master', [ProcessController::class, 'showdata']);
Route::middleware(['auth:sanctum', 'verified'])->get('/process/delete/{id}', [ProcessController::class, 'destroy']);


Route::middleware(['auth:sanctum', 'verified'])->get('process-test', [ProcessController::class, 'runFinalResult']);
Route::middleware(['auth:sanctum', 'verified'])->get('process-show', [ProcessController::class, 'showFinalSeven']);



Route::view('/report/std01', 'report', ['page' => 'std01']);
Route::view('/report/adv01', 'report', ['page' => 'adv01']);


//Manual
Route::view('/manual', 'manual');

