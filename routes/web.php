<?php

// use App\Http\Controllers\AdminController

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
Route::get('/', 'PagesController@index');
Route::get('/get-orders/{number}',  'PagesController@getOrderByTrackNumber');

Route::group(['prefix' => 'administrator'], function () {

    // login
    Route::get('/', 'Administrator\AuthenticationController@loginForm');
    Route::get('/logout', 'Administrator\AuthenticationController@logout');
    Route::post('/authenticate', 'Administrator\AuthenticationController@authenticate');

    //dashboard
    Route::resource('/dashboard', 'Administrator\DashboardController');

    // products
    Route::get('/get-product-list',  'Administrator\ProductController@getProductList');
    Route::resource('/products', 'Administrator\ProductController');

    // categories
    Route::get('/get-category-list',  'Administrator\CategoryController@getCategoryList');
    Route::resource('/categories', 'Administrator\CategoryController');

    // users
    Route::get('/get-user-list',  'Administrator\UserController@getUserList');
    Route::get('/delete-user-process/{id}',  'Administrator\UserController@deleteUserProcess');
    Route::get('/user-update/{id}',  'Administrator\UserController@usetUpdate');
    Route::resource('/users', 'Administrator\UserController');

    // orders
    Route::get('/get-order-list',  'Administrator\OrderController@getOrderList');
    Route::get('/track-orders',  'Administrator\OrderController@trackOrderPage');
    Route::get('/track-orders/{id}',  'Administrator\OrderController@showTrackOrder');
    Route::post('/orders/update-status',  'Administrator\OrderController@updateOrderStatus');
    Route::resource('/orders', 'Administrator\OrderController');

    // track status
    Route::get('/get-track-status/{id}',  'Administrator\TrackStatusController@getTrackStatus');
    Route::resource('/track-status', 'Administrator\TrackStatusController');

    // roles
    Route::get('/role/add-new', 'Administrator\RoleController@addnewroles');
    Route::get('/role/update/{id}', 'Administrator\RoleController@updateRoles');
    Route::resource('/role', 'Administrator\RoleController');

    // customer
    Route::get('/delete-customer/{id}', 'Administrator\CustomerController@archiveCustomer');
    Route::get('/update-customer/{id}', 'Administrator\CustomerController@updateCustomer');
    Route::get('/add-customer', 'Administrator\CustomerController@addCustomer');
    Route::get('/customer-get-data', 'Administrator\CustomerController@getCustomerData');
    Route::resource('/customer', 'Administrator\CustomerController');


});
