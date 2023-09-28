<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SimpleExcelController;
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


Route::get('/index',[SimpleExcelController::class,'index'])->name('index');

Route::post('simple-excel/import',[SimpleExcelController::class,'import'])->name('excel.import');
// Importer un fichier Excel

// Exporter un fichier Excel
Route::post("simple-excel/export", "SimpleExcelController@export")->name('excel.export');
