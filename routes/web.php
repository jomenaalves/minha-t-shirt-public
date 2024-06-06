<?php

//Web
use App\Http\Controllers\{
    Auth\LoginController,
    DashboardController, User\UserController,
    Products\ProductsController,
    Nfe\NfeController,
    Warehouses\WarehousesController 
};

//App
use App\Http\Controllers\App\{
    User\AppUserController, AppDashboardController, Auth\AppLoginController, Products\AppProductsController
};
use App\Http\Controllers\App\Order\AppOrderController;
use App\Http\Controllers\Asaas\AsaasController;
use App\Http\Controllers\Asaas\AssasWebhookController;
use App\Http\Controllers\Cashier\CashierController;
use App\Http\Controllers\Stocks\StocksController;
use Illuminate\Support\Facades\Auth;
use App\Order\OrderController;
use Illuminate\Support\Facades\Route;

// PUBLIC ROUTES

Route::domain(config('app.url'))->group(function () {

    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    
    Route::post('/auth/login', [LoginController::class, 'auth'])->name('auth.login');
    
    Route::middleware('auth')->group(function () {
        Route::get('/', [DashboardController::class, 'dashboard']);
    
        //USERS
        Route::get('/usuarios', [UserController::class, 'index'])->name('user.index');
        Route::get('/usuarios/listar', [UserController::class, 'loadUsersFromDatatable'])->name('user.loadUsersFromDatatable');    
        Route::post('/users/create', [UserController::class, 'createUser'])->name('user.createUser')->middleware('admin');
        Route::get('/usuarios/editar/{id}', [UserController::class, 'editUser'])->name('user.editUser');
        Route::get('/usuarios/datalhes', [UserController::class, 'getDataUser'])->name('user.getDataUser');
        Route::post('/users/update', [UserController::class, 'updateDetailsUser'])->name('user.updateDetailsUser');
        Route::post('/users/permissions', [UserController::class, 'updatePermissionsUser'])->name('user.updatePermissionsUser');
        Route::post('/users/password', [UserController::class, 'updatePasswordUser'])->name('user.updatePasswordUser');
        Route::post('/users/photo', [UserController::class, 'updatePhotoUser'])->name('user.updatePhotoUser');
        
        //PRODUCTS
        Route::get('/produtos/listar', [ProductsController::class, 'loadProductsFromDatatable'])->name('products.loadProductsFromDatatable');
        Route::get('/produtos', [ProductsController::class, 'index'])->name('products.index');
        Route::post('/products/store', [ProductsController::class, 'store'])->name('products.store');
        Route::get('/produtos/{id}', [ProductsController::class, 'show'])->name('products.show');
        Route::post('/products/update', [ProductsController::class, 'update'])->name('products.update');
        Route::delete('/products/{id}', [ProductsController::class, 'destroy'])->name('products.destroy');
        
        //WAREHOUSES
        Route::get('/warehouses', [WarehousesController::class, 'index'])->name('warehouses.index');
        Route::get('/warehouses/all', [WarehousesController::class, 'loadWarehousesFromDatatable'])->name('warehouses.loadWarehousesFromDatatable');
        Route::post('/warehouses/store', [WarehousesController::class, 'store'])->name('warehouses.store');
        Route::get('/warehouses/{id}', [WarehousesController::class, 'show'])->name('warehouses.show');
        Route::post('/warehouses/update', [WarehousesController::class, 'update'])->name('warehouses.update');
        Route::post('/warehouses/delete', [WarehousesController::class, 'delete'])->name('warehouses.delete');
        Route::get('/warehouses/get-cep/{zipcode}', [WarehousesController::class, 'getAddressByCep'])->name('warehouses.getAddressByCep');

        //STOCKS
        Route::post('/stocks/update', [StocksController::class, 'update'])->name('stocks.update');
        Route::get('/stocks/get-products/{id}', [StocksController::class, 'getProductsStock'])->name('stocks.getProductsStock');
        Route::get('/stocks/get-warehouses', [StocksController::class, 'getWarehouses'])->name('stocks.getWarehouses');

           
        //NF-e
        Route::get('/nfe', [NfeController::class, 'index'])->name('nfe.index');
        Route::get('/nfe/listar', [NfeController::class, 'loadNfesFromDatatable'])->name('nfe.loadNfesFromDatatable');
        Route::get('/nfe/detalhes', [NfeController::class, 'viewNfe'])->name('nfe.viewNfe');
        Route::get('/nfe/configuracoes', [NfeController::class, 'nfeSettingsIndex'])->name('nfe.nfeSettingsIndex');
        Route::get('/nfe/configuracoes/editar', [NfeController::class, 'nfeSettingsGetData'])->name('nfe.nfeSettingsGetData');

        //CASHIER
        Route::get('/caixa', [CashierController::class, 'index'])->name('cashier.index');
        Route::get('/caixa/listar', [CashierController::class, 'loadCashiersFromDatatable'])->name('cashier.loadCashiersFromDatatable');
        Route::get('/caixa/editar/{id}', [CashierController::class, 'edit'])->name('cashier.edit');
        Route::get('/caixa/detalhes', [CashierController::class, 'details'])->name('cashier.details');
        Route::post('/cashier/create', [CashierController::class, 'create'])->name('cashier.create');
        Route::post('/cashier/add-products', [CashierController::class, 'addProducts'])->name('cashier.addProducts');
        Route::post('/cashier/update-note', [CashierController::class, 'updateNote'])->name('cashier.updateNote');
        Route::post('/cashier/close', [CashierController::class, 'close'])->name('cashier.close');
        Route::post('/cashier/withdrawal', [CashierController::class, 'withdrawal'])->name('cashier.withdrawal');
        Route::post('/cashier/load-product', [CashierController::class, 'loadCashierProduct'])->name('cashier.loadCashierProduct');
        Route::post('/cashier/remove-item', [CashierController::class, 'removeItem'])->name('cashier.removeItem');
        Route::post('/cashier/update-item', [CashierController::class, 'updateItem'])->name('cashier.updateItem');
        Route::post('/cashier/load-payment', [CashierController::class, 'loadCashierPayment'])->name('cashier.loadCashierPayment');
        Route::post('/cashier/update-payment', [CashierController::class, 'updatePayments'])->name('cashier.updatePayments');
        Route::post('/cashier/open', [CashierController::class, 'openCashier'])->name('cashier.openCashier');
    });
});


Route::domain('app.'.config('app.domain'))->name('app.')->group(function () {
        
    //Auth
    Route::get('/login', [AppLoginController::class, 'login'])->name('login');
    Route::post('/app/authenticate', [AppLoginController::class, 'authenticate'])->name('authenticate');
    Route::get('/logout_app', [AppLoginController::class, 'logoutApp'])->name('logoutApp');

    Route::middleware('app_auth')->group(function () {
        //Dashboard
        Route::get('/', [AppDashboardController::class, 'dashboard'])->name('dashboard');

        //Users
        Route::get('/user', [AppUserController::class, 'user'])->name('user');

        //Products
        Route::get('/produtos', [AppProductsController::class, 'products'])->name('products'); 
        
        //Orders
        Route::get('/pedidos', [AppOrderController::class, 'index'])->name('order.index');
        Route::get('/pedidos/list', [AppOrderController::class, 'listAllOrders'])->name('order.listAllOrders');
        Route::get('/pedidos/{order_number}', [AppOrderController::class, 'viewOrder'])->name('order.viewOrder');
        Route::post('/new-order', [AppOrderController::class, 'newOrder'])->name('order.newOrder');
        Route::post('/pedidos/details', [AppOrderController::class, 'detailsOrder'])->name('order.detailsOrder');
        Route::post('/pedidos/update-client', [AppOrderController::class, 'updateClient'])->name('order.updateClient');
        
        // Assas
        Route::post('/generatePaymentLink', [AsaasController::class, 'getPaymentLink'])->name('order.generatePaymentLink');
    });
});

//webhook 
Route::post('/webhook/assas', [AssasWebhookController::class, 'payment'])->name('webhook');