<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Pos\SupplierController;
use App\Http\Controllers\Pos\CategoryController;
use App\Http\Controllers\Pos\ProductController;
use App\Http\Controllers\Pos\InvoiceController;
use App\Http\Controllers\Pos\DefaultController;
use App\Http\Controllers\Pos\UserController;

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
    return view('auth/login');
});

Route::controller(DefaultController::class)->group(function () {
    route::get('/get-product', 'GetProduct')->name('get-product');
    route::get('/check-product', 'GetStock')->name('check-product-stock');
    route::get('/check-price', 'GetProductPrice')->name('get-price');
});

//index page loaded +> admin master blade
Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');
require __DIR__.'/auth.php';

Route::controller(AdminController::class)->group(function(){
    Route::get('/admin/logout', 'destroy')->name('admin.logout');
    Route::get('/admin/profile', 'Profile')->name('admin.profile');
    Route::get('/edit/profile', 'EditProfile')->name('edit.profile');
    Route::get('/change/profile', 'ChangePassword')->name('change.password');

    Route::post('/update/password', 'UpdatePassword')->name('update.password');
    Route::post('/store/profile', 'StoreProfile')->name('store.profile');
});

Route::controller(SupplierController::class)->group(function(){
    Route::get('/suppliers/list','SuppliersList')->name('suppliers.list');
    Route::get('/suppliers/add','SupplierAdd')->name('supplier.add');
    Route::get('/suppliers/edit/{id}','SupplierEdit')->name('supplier.edit');
    Route::get('/suppliers/delete/{id}','SupplierDelete')->name('supplier.delete');

    Route::post('/suppliers/store','SupplierStore')->name('supplier.store');
    Route::post('/suppliers/update','SupplierUpdate')->name('supplier.update');

});

Route::controller(CategoryController::class)->group(function(){
    Route::get('/category/list','CategoryList')->name('category.list');
    Route::get('/category/add','CategoryAdd')->name('category.add');
    Route::get('/category/edit/{id}','CategoryEdit')->name('category.edit');
    Route::get('/category/delete/{id}','CategoryDelete')->name('category.delete');

    Route::post('/category/store','CategoryStore')->name('category.store');
    Route::post('/category/update','CategoryUpdate')->name('category.update');
});

Route::controller(ProductController::class)->group(function(){
    Route::get('/product/list','ProductAll')->name('product.list');
    Route::get('/product/add','ProductAdd')->name('product.add');
    Route::get('/product/edit/{id}','ProductEdit')->name('product.edit');
    Route::get('/product/delete/{id}','ProductDelete')->name('product.delete');
    Route::get('/product/withdrawList','ProductWithdrawList')->name('product.withdrawList');
    Route::get('/product/withdraw/{id}','ProductWithdraw')->name('product.withdraw');
    Route::get('/product/adminList','AdminList')->name('product.admin');

    Route::post('/product/withdrawId','ProductWithdrawId')->name('product.withdrawId');
    Route::post('/product/store','ProductStore')->name('product.store');
    Route::post('/product/update','ProductUpdate')->name('product.update');
});

Route::controller(InvoiceController::class)->group(function (){
  Route::get('/invoice/all', 'InvoiceAll')->name('invoice.all');
  Route::get('/invoice/add','invoiceAdd')->name('invoice.add');
  Route::get('/invoice/delete/{id}', 'InvoiceDelete')->name('invoice.delete');
  Route::get('/invoice/approve/{id}', 'InvoiceApprove')->name('invoice.approve');

  Route::post('/invoice/store', 'InvoiceStore')->name('invoice.store');
  Route::post('/approval/store/{id}', 'ApprovalStore')->name('approval.store');
});

Route::controller(UserController::class)->group(function(){
    route::get('/user/list','UserList')->name('user.list');
    route::get('/user/add','UserAdd')->name('user.add');
    route::get('/user/edit/{id}','UserEdit')->name('user.edit');
    route::get('/user/delete/{id}','UserDelete')->name('user.delete');

    route::post('/user/store','UserStore')->name('user.store');
    route::post('/user/update','UserUpdate')->name('user.update');
});
