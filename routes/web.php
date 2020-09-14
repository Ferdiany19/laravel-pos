<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

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
    return redirect('/login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => 'admin'],function(){  
        Route::prefix('/admin')->group(function(){
            // --------------------------- DASHBOARD --------------------------------
            Route::get('/',function(){
                return view('admin.dashboard');
            })->name('admin.dashboard');

            // --------------------------- SUPPLIER -----------------------------------
            Route::get('/supplier/pdf','admin\SupplierController@cetak_pdf')->name('admin.supplier.pdf');
            Route::get('/supplier/excel','admin\SupplierController@cetak_excel')->name('admin.supplier.excel');
            Route::get('/supplier','admin\SupplierController@index')->name('admin.supplier.index'); // INDEX TAMPILAN DATA SUPPLIER
            Route::get('/supplier/create','admin\SupplierController@create')->name('admin.supplier.create'); // TAMPILAN FORM CREATE SUPPLIER
            Route::post('/supplier','admin\SupplierController@store')->name('admin.supplier.store');
            Route::get('/supplier/edit/{id}','admin\SupplierController@show_edit')->name('admin.supplier.show_edit'); // TAMPILAN FORM EDIT/UPDATE SUPPLIER
            Route::match(['put','patch'],'/supplier/edit/{id}','admin\SupplierController@edit')->name('admin.supplier.edit');
            Route::delete('/supplier/{id}','admin\SupplierController@destroy')->name('admin.supplier.destroy');

            // --------------------------- CUSTOMER ------------------------------------
            Route::get('/customer/pdf','admin\CustomerController@export_pdf')->name('admin.customer.pdf');
            Route::get('/customer/excel','admin\CustomerController@export_excel')->name('admin.customer.excel');
            Route::get('/customer','admin\CustomerController@index')->name('admin.customer.index'); //TAMPILAN DATA CUSTOMER
            Route::get('/customer/create','admin\CustomerController@create')->name('admin.customer.create'); // TAMPILAN FORM CREATE CUSTOMER
            Route::post('/customer','admin\CustomerController@store')->name('admin.customer.store');
            Route::get('/customer/edit/{id}','admin\CustomerController@show_edit')->name('admin.customer.show_edit'); //TAMPILAN FORM EDIT/UPDATE CUSTOMER
            Route::match(['put','patch'],'/cutomer/edit/{id}','admin\CustomerController@edit')->name('admin.customer.edit');
            Route::delete('/customer/{id}','admin\CustomerController@destroy')->name('admin.customer.destroy');

            // ----------------------------- PRODUCT-------------------------------------------
            Route::get('/product/pdf','admin\ProductController@export_pdf')->name('admin.product.pdf');
            Route::get('/product/all-barcode/pdf','admin\ProductController@export_all_barcode_pdf')->name('admin.product.allBarcode.pdf');
            Route::get('/product/excel','admin\ProductController@export_excel')->name('admin.product.excel');
            Route::get('/product','admin\ProductController@index')->name('admin.product.index'); //tampilan category , unit dan item

            Route::post('/product/category','admin\ProductController@category_store')->name('admin.category.store'); //proses insert data category
            Route::delete('/product/category/{id}','admin\ProductController@category_destroy')->name('admin.category.destroy'); //proses delete data category

            Route::post('/product/unit','admin\ProductController@unit_store')->name('admin.unit.store'); //proses insert data unit
            Route::delete('/product/unit/{id}','admin\ProductController@unit_destroy')->name('admin.unit.destroy'); //proses delete data unit

            Route::get('/product/item/create','admin\ProductController@item_create')->name('admin.item.create'); //form insert item
            Route::post('/product/item','admin\ProductController@item_store')->name('admin.item.store'); //proses insert item
            Route::get('/product/item/edit/{id}','admin\ProductController@item_show')->name('admin.item.show'); //form edit item
            Route::match(['put','patch'],'/product/item/edit/{id}','admin\ProductController@item_edit')->name('admin.item.edit'); // proses edit item
            Route::delete('/product/item/{id}','admin\ProductController@item_destroy')->name('admin.item.destroy'); //proses delete item

            // --------------------------- TRANSACTION --------------------------------------------
            Route::get('/transaction/stock-in/pdf','admin\TransactionController@stockIn_export_pdf')->name('admin.transaction.stockIn.pdf');
            Route::get('/transaction/stock-in/excel','admin\TransactionController@stockIn_export_excel')->name('admin.transaction.stockIn.excel');
            Route::get('/transaction/stock-in','admin\TransactionController@stock_in')->name('admin.transaction.stockIn.index');
            Route::get('/transaction/stock-in/create','admin\TransactionController@stock_in_create')->name('admin.transaction.stockIn.create');
            Route::post('/transaction/stock-in','admin\TransactionController@stock_in_store')->name('admin.transaction.stockIn.store');
            Route::get('/transaction/stock-in/edit/{id}','admin\TransactionController@stock_in_show')->name('admin.transaction.stockIn.show');
            Route::match(['put','patch'],'/transaction/stock-in/edit/{id}','admin\TransactionController@stock_in_edit')->name('admin.transaction.stockIn.update');
            Route::delete('/transaction/stock-in/{id}','admin\TransactionController@stock_in_destroy')->name('admin.transaction.stockIn.destory');

            Route::get('/transaction/order/create','admin\TransactionController@order_create')->name('admin.transaction.order.create');
            Route::post('/transaction/order','admin\TransactionController@order_store')->name('admin.transaction.order.store');
            Route::post('/source/id','admin\TransactionController@source_id')->name('admin.source.id');

            Route::get('/transaction/stock-out/pdf','admin\TransactionController@stockOut_export_pdf')->name('admin.transaction.stockOut.pdf');
            Route::get('/transaction/stock-out/excel','admin\TransactionController@stockOut_export_excel')->name('admin.transaction.stockOut.excel');
            Route::get('/transaction/stock-out','admin\TransactionController@stock_out_index')->name('admin.transaction.stockOut.index');
            Route::delete('/transaction/stock-out/{id}','admin\TransactionController@stock_out_destroy')->name('admin.transaction.stockOut.destroy');

            Route::get('/transaction/stock-retur/pdf','admin\TransactionController@stockRetur_export_pdf')->name('admin.transaction.stockRetur.pdf');
            Route::get('/transaction/stock-retur/excel','admin\TransactionController@stockRetur_export_excel')->name('admin.transaction.stockRetur.excel');
            Route::get('/transaction/stock-retur','admin\TransactionController@stock_retur_index')->name('admin.transaction.stockRetur.index');
            Route::post('/transaction/stock-retur-stock-in/{id}','admin\TransactionController@stock_retur_store_stock_in')->name('admin.transaction.stockRetur.store.stock.in');
            Route::post('/transaction/stock-retur-stock-out/{id}','admin\TransactionController@stock_retur_store_stock_out')->name('admin.transaction.stockRetur.store.stock.out');
            Route::match(['put','patch'],'/transaction/stock-retur-update-proses/{id}','admin\TransactionController@update_proses')->name('admin.transaction.stockRetur.proses.update');
            Route::delete('/transaction/stock-retur-delete/{id}','admin\TransactionController@stock_retur_destroy')->name('admin.transaction.stockRetur.destroy');

            // -------------------------------------- Finance --------------------------------------------------------
            Route::get('/finance/pengeluaran/pdf','admin\FinanceController@pengeluaran_export_pdf')->name('admin.finance.pengeluaran.pdf');
            Route::get('/finance/pengeluaran/excel','admin\FinanceController@pengeluaran_export_excel')->name('admin.finance.pengeluaran.excel');
            Route::get('/finance/pemasukan/pdf','admin\FinanceController@pemasukan_export_pdf')->name('admin.finance.pemasukan.pdf');
            Route::get('/finance/pemasukan/excel','admin\FinanceController@pemasukan_export_excel')->name('admin.finance.pemasukan.excel');
            Route::get('/finance/laba/pdf','admin\FinanceController@laba_export_pdf')->name('admin.finance.laba.pdf');
            Route::get('/finance/laba/excel','admin\FinanceController@laba_export_excel')->name('admin.finance.laba.excel');
            Route::get('/finance/belum-terjual/pdf','admin\FinanceController@belum_terjual_export_pdf')->name('admin.finance.belum-terjual.pdf');
            Route::get('/finance/belum-terjual/excel','admin\FinanceController@belum_terjual_export_excel')->name('admin.finance.belum-terjual.excel');
            Route::get('/finance/retur-pemasukan/pdf','admin\FinanceController@retur_pemasukan_export_pdf')->name('admin.finance.retur-pemasukan.pdf');
            Route::get('/finance/retur-pemasukan/excel','admin\FinanceController@retur_pemasukan_export_excel')->name('admin.finance.retur-pemasukan.excel');
            Route::get('/finance/retur-pengeluaran/pdf','admin\FinanceController@retur_pengeluaran_export_pdf')->name('admin.finance.retur-pengeluaran.pdf');
            Route::get('/finance/retur-pengeluaran/excel','admin\FinanceController@retur_pengeluaran_export_excel')->name('admin.finance.retur-pengeluaran.excel');
            Route::get('/finance/pengeluaran','admin\FinanceController@pengeluaran_index')->name('admin.finance.pengeluaran.index');

            Route::get('/finance/akumulasi/pdf','admin\FinanceController@export_pdf')->name('admin.finance.akumulasi.pdf');
            Route::get('/finance/akumulasi/excel','admin\FinanceController@export_excel')->name('admin.finance.akumulasi.excel');
            Route::get('/finance/akumulasi','admin\FinanceController@akumulasi_index')->name('admin.finance.akumulasi.index');

            // ------------------------------------ Report -----------------------------------------------------------
            Route::get('/report/day/pdf/{day}','admin\ReportController@day_export_pdf')->name('admin.report.day.pdf');
            Route::get('/report/day/excel/{day}','admin\ReportController@day_export_excel')->name('admin.report.day.excel');
            Route::get('/report/day','admin\ReportController@day_index')->name('admin.report.day.index');
            Route::post('/report/day/search','admin\ReportController@day_search')->name('admin.report.day.search');

            Route::get('/report/month/pdf/{month}','admin\ReportController@month_export_pdf')->name('admin.report.month.pdf');
            Route::get('/report/month/excel/{month}','admin\ReportController@month_export_excel')->name('admin.report.month.excel');
            Route::get('/report/month','admin\ReportController@month_index')->name('admin.report.month.index');
            Route::post('/report/month/search','admin\ReportController@month_search')->name('admin.report.month.search');

            Route::get('/report/year/pdf/{year}','admin\ReportController@year_export_pdf')->name('admin.report.year.pdf');
            Route::get('/report/year/excel/{year}','admin\ReportController@year_export_excel')->name('admin.report.year.excel');
            Route::get('/report/year','admin\ReportController@year_index')->name('admin.report.year.index');
            Route::post('/report/year/search','admin\ReportController@year_search')->name('admin.report.year.search');

            // ----------------------------------- User ---------------------------------------------------------------
            Route::get('/user/pdf','admin\UserController@export_pdf')->name('admin.user.pdf');
            Route::get('/user/excel','admin\UserController@export_excel')->name('admin.user.excel');
            Route::get('/user','admin\UserController@index')->name('admin.user.index');
            Route::get('/user/create','admin\UserController@create')->name('admin.user.create');
            Route::post('/user','admin\UserController@store')->name('admin.user.store');
            Route::get('/user/edit/{id}','admin\UserController@show')->name('admin.user.show');
            Route::match(['put','patch'],'/user/edit/{id}','admin\UserController@edit')->name('admin.user.edit');
            Route::delete('/user/delete/{id}','admin\UserController@destroy')->name('admin.user.delete');
        });
    });

    // -------------------------------- KASIR ----------------------------------------
    Route::group(['middleware' => 'kasir'],function(){
        Route::prefix('/kasir')->group(function(){
            // --------------------- dashboard ---------------------------
            Route::get('/',function(){
                return view('kasir.dashboard');
            })->name('kasir.dashboard');
            // --------------------------- CUSTOMER ------------------------------------
            Route::get('/customer/pdf','kasir\CustomerController@export_pdf')->name('kasir.customer.pdf');
            Route::get('/customer/excel','kasir\CustomerController@export_excel')->name('kasir.customer.excel');
            Route::get('/customer','kasir\CustomerController@index')->name('kasir.customer.index'); //TAMPILAN DATA CUSTOMER
            Route::get('/customer/create','kasir\CustomerController@create')->name('kasir.customer.create'); // TAMPILAN FORM CREATE CUSTOMER
            Route::post('/customer','kasir\CustomerController@store')->name('kasir.customer.store');
            Route::get('/customer/edit/{id}','kasir\CustomerController@show_edit')->name('kasir.customer.show_edit'); //TAMPILAN FORM EDIT/UPDATE CUSTOMER
            Route::match(['put','patch'],'/cutomer/edit/{id}','kasir\CustomerController@edit')->name('kasir.customer.edit');
            Route::delete('/customer/{id}','kasir\CustomerController@destroy')->name('kasir.customer.destroy');

            // --------------------------- TRANSACTION --------------------------------------------
            Route::get('/transaction/order/create','kasir\TransactionController@order_create')->name('kasir.transaction.order.create');
            Route::get('/transaction/view/{id}', 'kasir\TransactionController@view');
            Route::post('/transaction/order','kasir\TransactionController@order_store')->name('kasir.transaction.order.store');
            Route::post('/source/id','kasir\TransactionController@source_id')->name('kasir.source.id');

            Route::get('/transaction/stock-out/pdf','kasir\TransactionController@stockOut_export_pdf')->name('kasir.transaction.stockOut.pdf');
            Route::get('/transaction/stock-out/excel','kasir\TransactionController@stockOut_export_excel')->name('kasir.transaction.stockOut.excel');
            Route::get('/transaction/stock-out','kasir\TransactionController@stock_out_index')->name('kasir.transaction.stockOut.index');
            Route::delete('/transaction/stock-out/{id}','kasir\TransactionController@stock_out_destroy')->name('kasir.transaction.stockOut.destroy');
            Route::post('/transaction/stock-retur-stock-out/{id}','kasir\TransactionController@stock_retur_store_stock_out')->name('kasir.transaction.stockRetur.store.stock.out');
        });
    });

    Route::group(['middleware' => 'management'],function(){
        Route::prefix('/management')->group(function(){
            Route::get('/',function(){
                return view('management.dashboard');
            })->name('management.dashboard');
            // --------------------------- SUPPLIER -----------------------------------
            Route::get('/supplier/pdf','management\SupplierController@cetak_pdf')->name('management.supplier.pdf');
            Route::get('/supplier/excel','management\SupplierController@cetak_excel')->name('management.supplier.excel');
            Route::get('/supplier','management\SupplierController@index')->name('management.supplier.index'); // INDEX TAMPILAN DATA SUPPLIER
            Route::get('/supplier/create','management\SupplierController@create')->name('management.supplier.create'); // TAMPILAN FORM CREATE SUPPLIER
            Route::post('/supplier','management\SupplierController@store')->name('management.supplier.store');
            Route::get('/supplier/edit/{id}','management\SupplierController@show_edit')->name('management.supplier.show_edit'); // TAMPILAN FORM EDIT/UPDATE SUPPLIER
            Route::match(['put','patch'],'/supplier/edit/{id}','management\SupplierController@edit')->name('management.supplier.edit');
            Route::delete('/supplier/{id}','management\SupplierController@destroy')->name('management.supplier.destroy');
        
            // ----------------------------- PRODUCT-------------------------------------------
            Route::get('/product/pdf','management\ProductController@export_pdf')->name('management.product.pdf');
            Route::get('/product/all-barcode/pdf','management\ProductController@export_all_barcode_pdf')->name('management.product.allBarcode.pdf');
            Route::get('/product/excel','management\ProductController@export_excel')->name('management.product.excel');
            Route::get('/product','management\ProductController@index')->name('management.product.index'); //tampilan category , unit dan item

            Route::post('/product/category','management\ProductController@category_store')->name('management.category.store'); //proses insert data category
            Route::delete('/product/category/{id}','management\ProductController@category_destroy')->name('management.category.destroy'); //proses delete data category

            Route::post('/product/unit','management\ProductController@unit_store')->name('management.unit.store'); //proses insert data unit
            Route::delete('/product/unit/{id}','management\ProductController@unit_destroy')->name('management.unit.destroy'); //proses delete data unit

            Route::get('/product/item/create','management\ProductController@item_create')->name('management.item.create'); //form insert item
            Route::post('/product/item','management\ProductController@item_store')->name('management.item.store'); //proses insert item
            Route::get('/product/item/edit/{id}','management\ProductController@item_show')->name('management.item.show'); //form edit item
            Route::match(['put','patch'],'/product/item/edit/{id}','management\ProductController@item_edit')->name('management.item.edit'); // proses edit item
            Route::delete('/product/item/{id}','management\ProductController@item_destroy')->name('management.item.destroy'); //proses delete item

            // --------------------------- TRANSACTION --------------------------------------------
            Route::get('/transaction/stock-in/pdf','management\TransactionController@stockIn_export_pdf')->name('management.transaction.stockIn.pdf');
            Route::get('/transaction/stock-in/excel','management\TransactionController@stockIn_export_excel')->name('management.transaction.stockIn.excel');
            Route::get('/transaction/stock-in','management\TransactionController@stock_in')->name('management.transaction.stockIn.index');
            Route::get('/transaction/stock-in/create','management\TransactionController@stock_in_create')->name('management.transaction.stockIn.create');
            Route::post('/transaction/stock-in','management\TransactionController@stock_in_store')->name('management.transaction.stockIn.store');
            Route::get('/transaction/stock-in/edit/{id}','management\TransactionController@stock_in_show')->name('management.transaction.stockIn.show');
            Route::match(['put','patch'],'/transaction/stock-in/edit/{id}','management\TransactionController@stock_in_edit')->name('management.transaction.stockIn.update');
            Route::delete('/transaction/stock-in/{id}','management\TransactionController@stock_in_destroy')->name('management.transaction.stockIn.destory');


            Route::get('/transaction/stock-retur/pdf','management\TransactionController@stockRetur_export_pdf')->name('management.transaction.stockRetur.pdf');
            Route::get('/transaction/stock-retur/excel','management\TransactionController@stockRetur_export_excel')->name('management.transaction.stockRetur.excel');
            Route::get('/transaction/stock-retur','management\TransactionController@stock_retur_index')->name('management.transaction.stockRetur.index');
            Route::post('/transaction/stock-retur-stock-in/{id}','management\TransactionController@stock_retur_store_stock_in')->name('management.transaction.stockRetur.store.stock.in');
            Route::post('/transaction/stock-retur-stock-out/{id}','management\TransactionController@stock_retur_store_stock_out')->name('management.transaction.stockRetur.store.stock.out');
            Route::match(['put','patch'],'/transaction/stock-retur-update-proses/{id}','management\TransactionController@update_proses')->name('management.transaction.stockRetur.proses.update');
            Route::delete('/transaction/stock-retur-delete/{id}','management\TransactionController@stock_retur_destroy')->name('management.transaction.stockRetur.destroy');

            // -------------------------------------- Finance --------------------------------------------------------
            Route::get('/finance/pengeluaran/pdf','management\FinanceController@pengeluaran_export_pdf')->name('management.finance.pengeluaran.pdf');
            Route::get('/finance/pengeluaran/excel','management\FinanceController@pengeluaran_export_excel')->name('management.finance.pengeluaran.excel');
            Route::get('/finance/pemasukan/pdf','management\FinanceController@pemasukan_export_pdf')->name('management.finance.pemasukan.pdf');
            Route::get('/finance/pemasukan/excel','management\FinanceController@pemasukan_export_excel')->name('management.finance.pemasukan.excel');
            Route::get('/finance/laba/pdf','management\FinanceController@laba_export_pdf')->name('management.finance.laba.pdf');
            Route::get('/finance/laba/excel','management\FinanceController@laba_export_excel')->name('management.finance.laba.excel');
            Route::get('/finance/belum-terjual/pdf','management\FinanceController@belum_terjual_export_pdf')->name('management.finance.belum-terjual.pdf');
            Route::get('/finance/belum-terjual/excel','management\FinanceController@belum_terjual_export_excel')->name('management.finance.belum-terjual.excel');
            Route::get('/finance/retur-pemasukan/pdf','management\FinanceController@retur_pemasukan_export_pdf')->name('management.finance.retur-pemasukan.pdf');
            Route::get('/finance/retur-pemasukan/excel','management\FinanceController@retur_pemasukan_export_excel')->name('management.finance.retur-pemasukan.excel');
            Route::get('/finance/retur-pengeluaran/pdf','management\FinanceController@retur_pengeluaran_export_pdf')->name('management.finance.retur-pengeluaran.pdf');
            Route::get('/finance/retur-pengeluaran/excel','management\FinanceController@retur_pengeluaran_export_excel')->name('management.finance.retur-pengeluaran.excel');
            Route::get('/finance/pengeluaran','management\FinanceController@pengeluaran_index')->name('management.finance.pengeluaran.index');


            Route::get('/finance/akumulasi/pdf','management\FinanceController@export_pdf')->name('management.finance.akumulasi.pdf');
            Route::get('/finance/akumulasi/excel','management\FinanceController@export_excel')->name('management.finance.akumulasi.excel');
            Route::get('/finance/akumulasi','management\FinanceController@akumulasi_index')->name('management.finance.akumulasi.index');

            // ------------------------------------ Report -----------------------------------------------------------
            Route::get('/report/day/pdf/{day}','management\ReportController@day_export_pdf')->name('management.report.day.pdf');
            Route::get('/report/day/excel/{day}','management\ReportController@day_export_excel')->name('management.report.day.excel');
            Route::get('/report/day','management\ReportController@day_index')->name('management.report.day.index');
            Route::post('/report/day/search','management\ReportController@day_search')->name('management.report.day.search');

            Route::get('/report/month/pdf/{month}','management\ReportController@month_export_pdf')->name('management.report.month.pdf');
            Route::get('/report/month/excel/{month}','management\ReportController@month_export_excel')->name('management.report.month.excel');
            Route::get('/report/month','management\ReportController@month_index')->name('management.report.month.index');
            Route::post('/report/month/search','management\ReportController@month_search')->name('management.report.month.search');

            Route::get('/report/year/pdf/{year}','management\ReportController@year_export_pdf')->name('management.report.year.pdf');
            Route::get('/report/year/excel/{year}','management\ReportController@year_export_excel')->name('management.report.year.excel');
            Route::get('/report/year','management\ReportController@year_index')->name('management.report.year.index');
            Route::post('/report/year/search','management\ReportController@year_search')->name('management.report.year.search');        
        });
    });
});


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
