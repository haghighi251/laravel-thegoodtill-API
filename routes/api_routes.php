<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ThirdPartyLoyaltyController;
use Illuminate\Support\Facades\Session;

/*
  |--------------------------------------------------------------------------
  | API Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register API routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | is assigned the "api" middleware group. Enjoy building your API!
  |
 */

// Before submitting the login form.
Route::get('/login', function () {
    return view('login', ['body_class_name' => 'text-center']);
});

// After submitting the login form.
Route::post('/login', [ThirdPartyLoyaltyController::class, 'Login']);

Route::middleware(['thegoodtill_auth'])->group(function () {

    // Before submitting the search form.
    Route::get('/customers/search', function () {
        return view('customers/search', ['body_class_name' => 'text-center']);
    });

    // After submitting the search form.
    Route::post('/customers/search', [ThirdPartyLoyaltyController::class, 'Search']);

    // Showing searched users.
    Route::get('/customers/show', function () {
        if (Session::get('data') == '') {
            return redirect('/customers/search');
        }
        return view('customers/show',
        [
            'body_class_name' => 'text-center',
            'users' => Session::get('data')['data'],
        ]);
    })->name('customers_show');
    
    // Showing a specific user by id.
    Route::get('/customer/{id}',[ThirdPartyLoyaltyController::class, 'Customer']);
    
    // Create a new user. Before subbmiting the new user form.
    Route::get('/customer/add/new', function () {
        return view('customers/create', ['body_class_name' => 'text-center']);
    });
    
    // Create a new user. After subbmiting the new user form.
    Route::post('/customer/add/new', [ThirdPartyLoyaltyController::class, 'NewCustomer']);
    
    // Add new sale. Before subbmiting the new user form.
    Route::get('/sale/add', function () {
        return view('sale/add', ['body_class_name' => 'text-center']);
    });
    
    // Add new sale. After subbmiting the new user form.
    Route::post('/sale/add', [ThirdPartyLoyaltyController::class, 'CompleteSale']);
    
});
