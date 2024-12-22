<?php

use App\Models\BusinessSetting;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\hierarchy\RegionController;
use App\Http\Controllers\hierarchy\CountryController;
use App\Http\Controllers\property_master\UnitController;
use App\Http\Controllers\property_master\ViewController;
use App\Http\Controllers\property_master\BlockController;
use App\Http\Controllers\property_master\FloorController;
use App\Http\Controllers\property_master\LiveWithController;
use App\Http\Controllers\property_master\UnitTypeController;
use App\Http\Controllers\settings\CompanySettingsController;
use App\Http\Controllers\property_master\OwnershipController;
use App\Http\Controllers\settings\BusinessSettingsController;
use App\Http\Controllers\property_master\UnitParkingController;
use App\Http\Controllers\property_master\PropertyTypeController;
use App\Http\Controllers\property_master\EnquiryStatusController;
use App\Http\Controllers\property_master\UnitConditionController;
use App\Http\Controllers\RolesAndCompanyManagement\RoleController;
use App\Http\Controllers\property_master\UnitDescriptionController;
use App\Http\Controllers\property_master\BusinessActivityController;
use App\Http\Controllers\property_management\BlockManagementController;
use App\Http\Controllers\property_management\FloorManagementController;
use App\Http\Controllers\property_master\EnquiryRequestStatusController;
use App\Http\Controllers\property_management\PropertyManagementController;
use App\Http\Controllers\RolesAndCompanyManagement\CompanyManagementController;

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


// Login Routes
Route::get('/', function () {
    if (auth()->check()) {    
        return redirect()->route('dashboard');
    }
    return view('auth.login');
})->name('login-page');

Route::group(["prefix" => "auth"], function () {
    Route::post("login", [AuthController::class, "login"])->name("login");
    Route::get("logout", [AuthController::class, "logout"])->name("logout")->middleware('auth');
});

// // Translation

Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'ar'])) {
    session()->put('locale', $locale);
    }
    return redirect()->back();
})->name('lang');

// Dashboard 
Route::group(["prefix"=> "dashboard"], function () {
    Route::get("/" , [DashboardController::class,"index"])->name("dashboard")->middleware('auth');
 });


 // User Managment
Route::group(['prefix' => 'companies'], function () {

    Route::get('/', [CompanyManagementController::class, 'index'])->name('companies');
    Route::get('/create', [CompanyManagementController::class , 'create'])->name('companies.create');
    Route::post('/create', [CompanyManagementController::class , 'store'])->name('companies.store');
    Route::get('/edit/{id}' , [CompanyManagementController::class , 'edit'])->name('companies.edit');
    Route::patch('/update/{id}' , [CompanyManagementController::class , 'update'])->name('companies.update');
    Route::delete('/delete', [CompanyManagementController::class ,'destroy'])->name('companies.delete');

});

// Roles
Route::group(['prefix' => 'roles'], function () {
    Route::get('/', [RoleController::class, 'index'])->name('roles');
    Route::get('/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/store', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('roles.edit');
    Route::post('/{id}/update', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/delete', [RoleController::class, 'destroy'])->name('roles.delete');
});

Route::group(['prefix'=> 'settings'], function () {
    Route::get('/company', [CompanySettingsController::class,'index'])->name('company_settings');
    Route::patch('/company/update', [CompanySettingsController::class,'update'])->name('company_settings.store');
});
Route::group(['prefix'=> 'region'], function () {
    Route::get('/', [RegionController::class,'index'])->name('region');
    Route::post('/create', [RegionController::class,'store'])->name('region.store');
    Route::get('/edit/{id}', [RegionController::class,'edit'])->name('region.edit');
    Route::patch('/update/{id}', [RegionController::class,'update'])->name('region.update');
    Route::get('/delete', [RegionController::class,'delete'])->name('region.delete');
});

Route::group(['prefix'=> 'countries'], function () {
    Route::get('/', [CountryController::class,'index'])->name('country');
    Route::post('/create', [CountryController::class,'store'])->name('country.store');
    Route::get('/edit/{id}', [CountryController::class,'edit'])->name('country.edit');
    Route::patch('/update/{id}', [CountryController::class,'update'])->name('country.update');
    Route::get('/delete', [CountryController::class,'delete'])->name('country.delete');


});

################################################## Start Propert_master ############################################# 

// ownership
Route::group(['prefix'=> 'ownership'], function () {
    Route::get('/', [OwnershipController::class,'index'])->name('ownership.index');
    Route::post('store', [OwnershipController::class,'store'])->name('ownership.store');
    Route::get('/edit/{id}', [OwnershipController::class,'edit'])->name('ownership.edit');
    Route::patch('/update/{id}', [OwnershipController::class,'update'])->name('ownership.update');
    Route::get('delete', [OwnershipController::class, 'delete'])->name('ownership.delete');
});

// property type
Route::group(['prefix'=> 'property_type'], function () {
    Route::get('/', [PropertyTypeController::class,'index'])->name('property_type.index');
    Route::post('store', [PropertyTypeController::class,'store'])->name('property_type.store');
    Route::get('/edit/{id}', [PropertyTypeController::class,'edit'])->name('property_type.edit');
    Route::patch('/update/{id}', [PropertyTypeController::class,'update'])->name('property_type.update');
    Route::get('delete', [PropertyTypeController::class, 'delete'])->name('property_type.delete');
});

// Blocks
Route::group(['prefix'=> 'block'], function () {
    Route::get('/', [BlockController::class,'index'])->name('block.index');
    Route::post('store', [BlockController::class,'store'])->name('block.store');
    Route::get('/edit/{id}', [BlockController::class,'edit'])->name('block.edit');
    Route::patch('/update/{id}', [BlockController::class,'update'])->name('block.update');
    Route::get('delete', [BlockController::class, 'delete'])->name('block.delete');
});

// Unit Description
Route::group(['prefix'=> 'unit_description'], function () {
    Route::get('/', [UnitDescriptionController::class,'index'])->name('unit_description.index');
    Route::post('store', [UnitDescriptionController::class,'store'])->name('unit_description.store');
    Route::get('/edit/{id}', [UnitDescriptionController::class,'edit'])->name('unit_description.edit');
    Route::patch('/update/{id}', [UnitDescriptionController::class,'update'])->name('unit_description.update');
    Route::get('delete', [UnitDescriptionController::class, 'delete'])->name('unit_description.delete');
});

// Unit Type
Route::group(['prefix'=> 'unit_type'], function () {
    Route::get('/', [UnitTypeController::class,'index'])->name('unit_type.index');
    Route::post('store', [UnitTypeController::class,'store'])->name('unit_type.store');
    Route::get('/edit/{id}', [UnitTypeController::class,'edit'])->name('unit_type.edit');
    Route::patch('/update/{id}', [UnitTypeController::class,'update'])->name('unit_type.update');
    Route::get('delete', [UnitTypeController::class, 'delete'])->name('unit_type.delete');
});

// Unit Condition
Route::group(['prefix'=> 'unit_condition'], function () {
    Route::get('/', [UnitConditionController::class,'index'])->name('unit_condition.index');
    Route::post('store', [UnitConditionController::class,'store'])->name('unit_condition.store');
    Route::get('/edit/{id}', [UnitConditionController::class,'edit'])->name('unit_condition.edit');
    Route::patch('/update/{id}', [UnitConditionController::class,'update'])->name('unit_condition.update');
    Route::get('delete', [UnitConditionController::class, 'delete'])->name('unit_condition.delete');
});

// Unit Parking
Route::group(['prefix'=> 'unit_parking'], function () {
    Route::get('/', [UnitParkingController::class,'index'])->name('unit_parking.index');
    Route::post('store', [UnitParkingController::class,'store'])->name('unit_parking.store');
    Route::get('/edit/{id}', [UnitParkingController::class,'edit'])->name('unit_parking.edit');
    Route::patch('/update/{id}', [UnitParkingController::class,'update'])->name('unit_parking.update');
    Route::get('delete', [UnitParkingController::class, 'delete'])->name('unit_parking.delete');
});

// View
Route::group(['prefix'=> 'view'], function () {
    Route::get('/', [ViewController::class,'index'])->name('view.index');
    Route::post('store', [ViewController::class,'store'])->name('view.store');
    Route::get('/edit/{id}', [ViewController::class,'edit'])->name('view.edit');
    Route::patch('/update/{id}', [ViewController::class,'update'])->name('view.update');
    Route::get('delete', [ViewController::class, 'delete'])->name('view.delete');
});

// Business Activity
Route::group(['prefix'=> 'business_activity'], function () {
    Route::get('/', [BusinessActivityController::class,'index'])->name('business_activity.index');
    Route::post('store', [BusinessActivityController::class,'store'])->name('business_activity.store');
    Route::get('/edit/{id}', [BusinessActivityController::class,'edit'])->name('business_activity.edit');
    Route::patch('/update/{id}', [BusinessActivityController::class,'update'])->name('business_activity.update');
    Route::get('delete', [BusinessActivityController::class, 'delete'])->name('business_activity.delete');
});

// Live With
Route::group(['prefix'=> 'live_with'], function () {
    Route::get('/', [LiveWithController::class,'index'])->name('live_with.index');
    Route::post('store', [LiveWithController::class,'store'])->name('live_with.store');
    Route::get('/edit/{id}', [LiveWithController::class,'edit'])->name('live_with.edit');
    Route::patch('/update/{id}', [LiveWithController::class,'update'])->name('live_with.update');
    Route::get('delete', [LiveWithController::class, 'delete'])->name('live_with.delete');
});

// Enquiry Status
Route::group(['prefix'=> 'enquiry_status'], function () {
    Route::get('/', [EnquiryStatusController::class,'index'])->name('enquiry_status.index');
    Route::post('store', [EnquiryStatusController::class,'store'])->name('enquiry_status.store');
    Route::get('/edit/{id}', [EnquiryStatusController::class,'edit'])->name('enquiry_status.edit');
    Route::patch('/update/{id}', [EnquiryStatusController::class,'update'])->name('enquiry_status.update');
    Route::get('delete', [EnquiryStatusController::class, 'delete'])->name('enquiry_status.delete');
});

// Enquiry Request Status
Route::group(['prefix'=> 'enquiry_request_status'], function () {
    Route::get('/', [EnquiryRequestStatusController::class,'index'])->name('enquiry_request_status.index');
    Route::post('store', [EnquiryRequestStatusController::class,'store'])->name('enquiry_request_status.store');
    Route::get('/edit/{id}', [EnquiryRequestStatusController::class,'edit'])->name('enquiry_request_status.edit');
    Route::patch('/update/{id}', [EnquiryRequestStatusController::class,'update'])->name('enquiry_request_status.update');
    Route::get('delete', [EnquiryRequestStatusController::class, 'delete'])->name('enquiry_request_status.delete');
});

// Floors
Route::group(['prefix'=> 'floors'], function () {
    Route::get('/', [FloorController::class,'index'])->name('floor.index');
    Route::get('/create', [FloorController::class,'create'])->name('floor.create');
    Route::post('/floor_single', [FloorController::class,'floor_single'])->name('floor.floor_single');
    Route::patch('/floor_single_edit/{id}', [FloorController::class,'floor_single_edit'])->name('floor.floor_single_edit');
    Route::get('/floor_multiple', [FloorController::class,'floor_multiple'])->name('floor.floor_multiple');
    Route::patch('/floor_multiple_edit/{id}', [FloorController::class,'floor_multiple_edit'])->name('floor.floor_multiple_edit');
    Route::post('/floor_multiple_store', [FloorController::class,'floor_multiple_store'])->name('floor.floor_multiple_store');
    Route::get('/edit/{id}', [FloorController::class,'edit'])->name('floor.edit');
    Route::get('delete', [FloorController::class, 'delete'])->name('floor.delete');
});

// Units
Route::group(['prefix'=> 'units'], function () {
    Route::get('/', [UnitController::class,'index'])->name('unit.index');
    Route::get('/create', [UnitController::class,'create'])->name('unit.create');
    Route::post('/unit_single', [UnitController::class,'unit_single'])->name('unit.unit_single');
    Route::patch('/unit_single_edit/{id}', [UnitController::class,'unit_single_edit'])->name('unit.unit_single_edit');
    Route::get('/unit_multiple', [UnitController::class,'unit_multiple'])->name('unit.unit_multiple');
    Route::patch('/unit_multiple_edit/{id}', [UnitController::class,'unit_multiple_edit'])->name('unit.unit_multiple_edit');
    Route::post('/unit_multiple_store', [UnitController::class,'unit_multiple_store'])->name('unit.unit_multiple_store');
    Route::get('/edit/{id}', [UnitController::class,'edit'])->name('unit.edit');
    Route::get('delete', [UnitController::class, 'delete'])->name('unit.delete');
});

################################################## End Propert_master #############################################


################################################## Start Propert Management ###########################################

// Property Management
Route::group(['prefix'=> 'property_management'], function () {
    Route::get('/', [PropertyManagementController::class,'index'])->name('property_management.index');
    Route::get('/create', [PropertyManagementController::class,'create'])->name('property_management.create');
    Route::post('store', [PropertyManagementController::class,'store'])->name('property_management.store');
    Route::get('/edit/{id}', [PropertyManagementController::class,'edit'])->name('property_management.edit');
    Route::get('/show/{id}', [PropertyManagementController::class,'show'])->name('property_management.show');
    Route::get('/view_image/{id}', [PropertyManagementController::class,'view_image'])->name('property_management.show');
    Route::patch('/update/{id}', [PropertyManagementController::class,'update'])->name('property_management.update');
    Route::get('delete', [PropertyManagementController::class, 'delete'])->name('property_management.delete');
});

// Block Management
Route::group(['prefix'=> 'block_management'], function () {
    Route::get('/', [BlockManagementController::class,'index'])->name('block_management.index');
    Route::get('/create', [BlockManagementController::class,'create'])->name('block_management.create');
    Route::post('store', [BlockManagementController::class,'store'])->name('block_management.store');
    Route::get('/edit/{id}', [BlockManagementController::class,'edit'])->name('block_management.edit');
    Route::get('/show/{id}', [BlockManagementController::class,'show'])->name('block_management.show');
    Route::get('/view_image/{id}', [BlockManagementController::class,'view_image'])->name('block_management.show');
    Route::patch('/update/{id}', [BlockManagementController::class,'update'])->name('block_management.update');
    Route::get('delete', [BlockManagementController::class, 'delete'])->name('block_management.delete');
});

// Floors Management
Route::group(['prefix'=> 'floor_management'], function () {
    Route::get('/', [FloorManagementController::class,'index'])->name('floor_management.index');
    Route::get('/create', [FloorManagementController::class,'create'])->name('floor_management.create');
    Route::post('store', [FloorManagementController::class,'store'])->name('floor_management.store');
    Route::get('/edit/{id}', [FloorManagementController::class,'edit'])->name('floor_management.edit');
    Route::get('/show/{id}', [FloorManagementController::class,'show'])->name('floor_management.show');
    Route::get('/view_image/{id}', [FloorManagementController::class,'view_image'])->name('floor_management.show');
    Route::patch('/update/{id}', [FloorManagementController::class,'update'])->name('floor_management.update');
    Route::get('delete', [FloorManagementController::class, 'delete'])->name('floor_management.delete');
});
################################################## End Propert Management ############################################# 


// another routes

Route::get('get_country/{id}', [CountryController::class, 'get_country'])->name('get_country');
Route::get('get_blocks_by_property', [BlockManagementController::class, 'get_blocks_by_property'])->name('get_blocks_by_property');