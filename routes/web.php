<?php
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
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
        Route::post('grant_approvals/approval', 'GrantApprovalsController@approval')->name('grant_approvals.approval');
        Route::get('grant_approvals/rejected/{grant_approval}', 'GrantApprovalsController@rejected')->name('grant_approvals.rejected');
        Route::get('grant_approvals/cancel/{grant_approval}', 'GrantApprovalsController@cancel')->name('grant_approvals.cancel');
       
        
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
        Route::resource('doctor_business_monitorings', DoctorBusinessMonitoringsController::class);
    });

    Route::group(['middleware' => ['auth']], function() {  

        Route::get('profile', 'ProfileController@index')->name('profile.change');       
        Route::post('profile', 'ProfileController@changePassword')->name('profile.change');       
        Route::get('profile/edit/{user}', 'ProfileController@edit')->name('profile.edit');       
        Route::post('profile/{user}/update', 'ProfileController@update')->name('profile.update');       
      
    });
});


require __DIR__.'/auth.php';
