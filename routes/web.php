<?php
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RoiAccountabilityReportsController;
use App\Http\Controllers\DoctorBusinessMonitoringsController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\GrantApprovalsController;
use App\Http\Controllers\ActivitiesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\TerritoriesController;
use App\Http\Controllers\QualificationsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DoctorsController;
use App\Http\Controllers\ChemistsController;
use App\Http\Controllers\StockistsController;
use App\Http\Controllers\FreeSchemesController;
use App\Http\Controllers\CustomerTrackingsController;
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

Route::group(['namespace' => 'App\Http\Controllers'], function()
{      
    // Route::get('/', function () {
    //     return view('welcome');
    // });

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');
  

    Route::group(['middleware' => ['guest']], function() {
        Route::get('/', [AuthenticatedSessionController::class, 'create'])
                ->name('login');
    });
    Route::resource('roles', RolesController::class);
    Route::resource('permissions', PermissionsController::class);

    Route::group(['middleware' => ['auth', 'permission']], function() {       
        /**
         * User Routes
         */
        Route::group(['prefix' => 'users'], function() {
            Route::get('/', 'UsersController@index')->name('users.index');
            Route::get('/create', 'UsersController@create')->name('users.create');
            Route::post('/users/store', 'UsersController@store')->name('users.store');
            Route::get('/{user}/show', 'UsersController@show')->name('users.show');
            Route::get('/{user}/edit', 'UsersController@edit')->name('users.edit');
            Route::patch('/{user}/update', 'UsersController@update')->name('users.update');
            Route::delete('/{user}/destroy', 'UsersController@destroy')->name('users.destroy');
        });

        Route::get('profile', 'ProfileController@index')->name('profile.change');        
        Route::get('grant_approvals/rejected/{grant_approval}', 'GrantApprovalsController@rejected')->name('grant_approvals.rejected');
        Route::get('grant_approvals/cancel/{grant_approval}', 'GrantApprovalsController@cancel')->name('grant_approvals.cancel');

        Route::get('doctor_business_monitorings/approval/{doctor_business_monitoring}', 'DoctorBusinessMonitoringsController@approval')->name('doctor_business_monitorings.approval');
        Route::get('doctor_business_monitorings/rejected/{doctor_business_monitoring}', 'DoctorBusinessMonitoringsController@rejected')->name('doctor_business_monitorings.rejected');
        Route::get('doctor_business_monitorings/cancel/{doctor_business_monitoring}', 'DoctorBusinessMonitoringsController@cancel')->name('doctor_business_monitorings.cancel');

        Route::get('doctors/getDoctors/{id}', 'DoctorsController@getDoctors')->name('doctors.getDoctors');
        // Route::get('grant_approvals/getGrantApprovalData/{id}', 'GrantApprovalsController@getGrantApprovalData')->name('grant_approvals.getGrantApprovalData');
        Route::get('grant_approvals/approval_form/{grant_approval}', 'GrantApprovalsController@approval_form')->name('grant_approvals.approval_form');
        Route::post('grant_approvals/approval', 'GrantApprovalsController@approval')->name('grant_approvals.approval');
        /**
         * Import Excel
         */
        Route::get('/import/activities/', 'ActivitiesController@import')->name('activities.import');
        Route::post('importExcel','ActivitiesController@importExcel')->name('importExcel');
        Route::get('/import/products/','ProductsController@import')->name('products.import');
        Route::post('importProductExcel','ProductsController@importProductExcel')->name('importProductExcel');
        Route::get('/import/territories/','TerritoriesController@import')->name('territories.import');
        Route::post('importTerritoryExcel','TerritoriesController@importTerritoryExcel')->name('importTerritoryExcel');
        Route::get('/import/qualifications/', 'QualificationsController@import')->name('qualifications.import');
        Route::post('importQualificationExcel','QualificationsController@importQualificationExcel')->name('importQualificationExcel');
        Route::get('/import/categories/', 'CategoriesController@import')->name('categories.import');
        Route::post('importCategoriesExcel','CategoriesController@importCategoriesExcel')->name('importCategoriesExcel');
        Route::get('/import/doctors/', 'DoctorsController@import')->name('doctors.import');
        Route::post('importDoctorsExcel','DoctorsController@importDoctorsExcel')->name('importDoctorsExcel');
        Route::get('/import/chemists/', 'ChemistsController@import')->name('chemists.import');
        Route::post('importChemistsExcel','ChemistsController@importChemistsExcel')->name('importChemistsExcel');
        Route::get('/import/stockists/', 'StockistsController@import')->name('stockists.import');
        Route::post('importStockistsExcel','StockistsController@importStockistsExcel')->name('importStockistsExcel');
        Route::get('/import/employees/', 'EmployeesController@import')->name('employees.import');
        Route::post('importEmployeesExcel','EmployeesController@importEmployeesExcel')->name('importEmployeesExcel');
        Route::get('/import/users/', 'UsersController@import')->name('users.import');
        Route::post('importUsersExcel','UsersController@importUsersExcel')->name('importUsersExcel');

        /**
         * PDF Report
         */
        Route::get('/grant_approvals/report/', 'GrantApprovalsController@report')->name('grant_approvals.report');
        Route::post('reportPDF','GrantApprovalsController@reportPDF')->name('reportPDF');
        Route::get('/doctor_business_monitorings/report/', 'DoctorBusinessMonitoringsController@report')->name('doctor_business_monitorings.report');
        Route::post('reportCDBM','DoctorBusinessMonitoringsController@reportCDBM')->name('reportCDBM');
        Route::get('/roi_accountability_reports/report/', 'RoiAccountabilityReportsController@report')->name('roi_accountability_reports.report');
        Route::post('reportRAR','RoiAccountabilityReportsController@reportRAR')->name('reportRAR');
        /**
         * Masters Route
         */
        Route::resource('products', ProductsController::class);
        Route::resource('territories', TerritoriesController::class);
        Route::resource('qualifications', QualificationsController::class);
        Route::resource('categories', CategoriesController::class);
        Route::resource('activities', ActivitiesController::class);
        Route::resource('employees', EmployeesController::class);
        Route::resource('stockists', StockistsController::class);
        Route::resource('chemists', ChemistsController::class);
        Route::get('/employees/getReportingOfficer3/{employee}', 'EmployeesController@getReportingOfficer3')->name('employees.getReportingOfficer3');
        Route::get('/employees/getEmployees/{employee}', 'EmployeesController@getEmployees')->name('employees.getEmployees');
        Route::resource('doctors', DoctorsController::class);
        Route::resource('grant_approvals', GrantApprovalsController::class);
        
        // Route::get('/grant_approvals/report/{grant_approval}', [App\Http\Controllers\GrantApprovalsController::class, 'report'])->name('grant_approvals.report');        
        Route::resource('doctor_business_monitorings', DoctorBusinessMonitoringsController::class);
        Route::resource('roi_accountability_reports', RoiAccountabilityReportsController::class);
        Route::resource('free_schemes', FreeSchemesController::class);
        Route::resource('customer_trackings', CustomerTrackingsController::class);
    });

    Route::group(['middleware' => ['auth']], function() {  

        Route::get('profile', 'ProfileController@index')->name('profile.change');       
        Route::post('profile', 'ProfileController@changePassword')->name('profile.change');       
        Route::get('profile/edit/{user}', 'ProfileController@edit')->name('profile.edit');       
        Route::post('profile/{user}/update', 'ProfileController@update')->name('profile.update');       
      
    });
});


require __DIR__.'/auth.php';
