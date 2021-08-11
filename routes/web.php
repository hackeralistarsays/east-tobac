<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\LoadingController;

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

Auth::routes(['register' => false]);

Route::middleware(['auth'])->group(function () {

    Route::get('/', 'HomeController@index')->name('home');

    Route::post('farmer-import', 'ImportExportController@farmerImport')->name('farmer-import');
    Route::post('grade-import', 'ImportExportController@gradeImport')->name('grade-import');
    Route::post('farm-inputs-import', 'ImportExportController@farmInput')->name('farm-inputs-import');
    Route::post('profile/update', 'UserController@update')->name('profile.update');
    Route::post('password/update', 'UserController@updatePassword')->name('password.update');

    Route::resource('users','UserController');
    Route::resource('farmers','FarmerController');
    Route::resource('products','ProductController');
    Route::resource('grades','GradeController');
    Route::resource('tobaccotypes','TobaccotypeController');
    Route::resource('customers','CustomerController');
    Route::resource('units','UnitController');
    Route::resource('counties','CountyController');
    Route::resource('counties.regions','RegionController');
    Route::resource('orders','OrderController');
    Route::resource('products.grades','ProductgradeController');
    Route::resource('cropyears','CropyearController');
    Route::resource('cropyears.recruitments','RecruitmentController');
    Route::resource('stations','StationController');
    Route::resource('stores','StoreController');
    Route::resource('lorries','LorryController');
    Route::resource('balereceptions','BalereceptionController');
    Route::resource('balereceptions.bales','BaleController');
    Route::post('balereception/track/{id}', 'BalesreceptionController@edit');
    
    Route::get('allbales','AllBalesController@index')->name('allbales');
    Route::get('inventory','OrderController@inventory')->name('allbales.inventory');
    Route::get('grades/{id}','BalesController@destroyer')->name('bales.destroyer');
    Route::get('stocks/details','StocksController@show')->name('stocks.info');
    
    Route::get('stock/{id}/store','StocksController@store')->name('stocks.store');
    Route::get('stocks/available','StocksController@available')->name('stocks.available');
    Route::get('stocks/in','StocksController@stockin')->name('stocks.in');
    Route::get('stocks/out','ProductgradeController@show')->name('stocks.out');
    
    Route::get('bales/all','AllBalesController@allreception')->name('bales.all');
    Route::get('bales/export','ReportsController@export')->name('bales.export');
    Route::get('users/{id}/show', 'UserController@show')->name('user.show');
    Route::get('users/{id}/update', 'UserController@update')->name('user.profile');
    Route::get('admin/{id}/edit', 'UserController@admin')->name('admin.edit');
    Route::post('admin/update', 'UserController@adminUpdate')->name('admin.users');

    Route::resource('farminputs','FarminputController');
    Route::resource('farmerinputs','FarmerinputController');
    Route::resource('loadings','LoadingController');
    Route::resource('offloadings','OffLoadingController');
    Route::resource('production-line-components','PLComponentController');
    Route::resource('orders.order-plcomponents','OrderPLComponentController');
    Route::resource('orders.packaging','PackagingController');

    Route::post('farmers/{id}/add-farmer-to-crop-year','FarmersInCropYearController@addFarmerToCropYear')->name('add-farmer-to-crop-year');
    Route::post('farmers/{id}/remove-farmer-from-crop-year','FarmersInCropYearController@removeFarmerFromCropYear')->name('remove-farmer-from-crop-year');

    Route::get('all-farmers/pdf','ReportGeneratorController@allfarmerspdf')->name('all-farmers-pdf');
    Route::get('all-farmers/excel','ReportGeneratorController@allfarmersexcel')->name('all-farmers-excel');
    Route::get('all-loading/excel','ReportsController@allfarmers')->name('all-farmers-excel');
    Route::get('all-loading/excel','ReportGeneratorController@loadingsexcel')->name('all-loadings-excel');
    Route::get('all-loading/pdf','ReportGeneratorController@loadingspdf')->name('all-loadings-pdf');

    Route::get('bale-state/excel','ReportGeneratorController@filterBalesExcel')->name('bale-state-excel'); 
    Route::get('bale-state/pdf','ReportGeneratorController@filterBalesPDF')->name('bale-state-pdf'); 
   // Route::get('all-bales/pdf',[ReportsController::class,'allbalesreport'])->name('all-bales-pdf');
    Route::delete('reception/{id}','BalereceptionController@destroy')->name('reception.destroy');

    Route::get('market/{id}/allbalespdf','ReportGeneratorController@balesinmarketpdf')->name('all-bales-in-market-pdf');

    Route::get('farmer/{farmer}/activity','ReportGeneratorController@farmeractivitypdf')->name('farmer-activity');

    Route::get('cropyear/{croyear}/farmers/pdf','ReportGeneratorController@cropyearfarmerspdf')->name('cropyear-farmers-pdf');
    Route::get('cropyear/{croyear}/farmers/excel','ReportGeneratorController@cropyearfarmersexcel')->name('cropyear-farmers-excel');

    Route::get('farm-input-allocations/pdf','ReportGeneratorController@farminputallocationspdf')->name('farm-input-allocations-pdf');
    Route::get('farm-input-allocations/excel','ReportGeneratorController@farminputallocationsexcel')->name('farm-input-allocations-excel');

    Route::get('grade/{id}/report', 'ReportGeneratorController@gradeStatus')->name('grade.report');
    Route::get('complete/{id}', 'OrderController@complete')->name('complete.order');
});