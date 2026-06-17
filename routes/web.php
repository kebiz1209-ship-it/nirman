<?php

use App\Http\Controllers\ForecastingController;
use App\Http\Controllers\MailSettingController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MenuActivityController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PackagingCategoryController;
use App\Http\Controllers\PackagingController;
use App\Http\Controllers\SalePerson\DashboardsController;
use App\Http\Controllers\SalePerson\OrdersController;
use App\Http\Controllers\SalePerson\PaymentsController;
use App\Http\Controllers\SalePerson\CustomerController;
use App\Http\Controllers\SalePerson\EnquiryController;
use App\Http\Controllers\SalePerson\FollowUpController;
use App\Http\Controllers\SalePerson\FeedbackController;
use App\Http\Controllers\SalePerson\SampleController;
use App\Http\Controllers\SalePerson\ReportController;
use App\Http\Controllers\ProductHead\PDashboardController;
use App\Http\Controllers\Production\ODashboardController;
use App\Http\Controllers\Qc\QDashboardController;
use App\Http\Controllers\Dispatch\DDashboardController;



Route::get('clear-all', function () {
    \Illuminate\Support\Facades\Artisan::call('view:clear');
    \Illuminate\Support\Facades\Artisan::call('config:clear');
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    \Illuminate\Support\Facades\Artisan::call('config:cache');
    \Illuminate\Support\Facades\Artisan::call('clear-compiled');
    \Illuminate\Support\Facades\Artisan::call('route:clear');
    dd('Cached Cleared');
});

Route::get('/set-collapse', function () {
    session()->put('is_collapse', request()->get('status'));
    return response()->json(['status' => 'success']);
});

Route::get('/test', function () {
    dd(session()->get('is_collapse'));
});

Route::get('set-locale/{language}', function ($language) {
    $user           = Auth::user();
    $user->language = $language;
    $user->save();
    session()->forget('lan');
    app()->setLocale($language);
    $message = __('index.language_changed_successfully');
    return redirect()->back();
})->name('set-locale');

Auth::routes();

Route::group(['middleware' => ['XSS']], function () {
    Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('index');

    Route::get('/forgot-password-step-one', [App\Http\Controllers\UserLoginController::class, 'forgotPasswordStepOne'])->name('forgot-password-step-one');
    Route::get('/forgot-password-step-two', [App\Http\Controllers\UserLoginController::class, 'forgotPasswordStepTwo'])->name('forgot-password-step-two');
    Route::get('/forgot-password-step-final', [App\Http\Controllers\UserLoginController::class, 'forgotPasswordStepFinal'])->name('forgot-password-step-final');
    Route::post('/post-forgot-password-step-one', [App\Http\Controllers\UserLoginController::class, 'postStepOne'])->name('post-forgot-password-step-one');
    Route::post('/post-forgot-password-step-two', [App\Http\Controllers\UserLoginController::class, 'postStepTwo'])->name('post-forgot-password-step-two');
    Route::post('/post-forgot-password-step-final', [App\Http\Controllers\UserLoginController::class, 'postStepFinal'])->name('post-forgot-password-step-final');

    Route::middleware(['auth', 'set_locale', 'has_permission', 'is_first_login'])->group(function () {
        Route::get('profile/edit-credentials', [App\Http\Controllers\ProfileController::class, 'editCredentials']);
        Route::post('profile/update-password', [App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('update-set-question');
        Route::get('/force-logout', [App\Http\Controllers\UserLoginController::class, 'forceLogout']);

        Route::get('change-profile', [App\Http\Controllers\ProfileController::class, 'changeProfile']);
        Route::post('update-change-profile', [App\Http\Controllers\ProfileController::class, 'updateProfile'])->name('update-change-profile');

        Route::get('security-question', [App\Http\Controllers\ProfileController::class, 'securityQuestion'])->name('set-security-question')->withoutMiddleware('has_permission');
        Route::post('update-security-question', [App\Http\Controllers\ProfileController::class, 'updateSecurityQuestion'])->name('update-security-question')->withoutMiddleware('has_permission');

        Route::get('/home', [App\Http\Controllers\DashboardController::class, 'profile'])->name('home')->withoutMiddleware('has_permission');

        Route::get('change-password', [App\Http\Controllers\ChangePasswordController::class, 'changePassword'])->name('change-password');
        Route::post('update-password', [App\Http\Controllers\ChangePasswordController::class, 'updatePassword'])->name('update-password');

        Route::get('/settings', [App\Http\Controllers\AdminController::class, 'settings'])->name('settings');
        Route::post('/setting_update', [App\Http\Controllers\AdminController::class, 'setting_update'])->name('setting.update');

        Route::get('/white-label', [App\Http\Controllers\AdminController::class, 'whiteLabel'])->name('white-label')->middleware('is_white_label_change_able');
        Route::post('/white-label-update', [App\Http\Controllers\AdminController::class, 'whiteLabelUpdate'])->name('white-label-update')->middleware('is_white_label_change_able');

        Route::get('/taxes', [App\Http\Controllers\TaxController::class, 'taxes'])->name('taxes');
        Route::post('/tax_update', [App\Http\Controllers\TaxController::class, 'tax_update'])->name('tax.update');
        Route::get('/addSupplierByAjax', [App\Http\Controllers\AjaxController::class, 'addSupplierByAjax'])->name('addSupplierByAjax');
        Route::get('/addCustomerByAjax', [App\Http\Controllers\AjaxController::class, 'addCustomerByAjax'])->name('addCustomerByAjax');
        Route::get('/getProductionData', [App\Http\Controllers\AjaxController::class, 'getProductionData'])->name('getProductionData');
        Route::post('/rawMaterialStockCheck', [App\Http\Controllers\StockController::class, 'rawMaterialStockCheck'])->name('rawMaterialStockCheck');
        Route::post('/rawMaterialStockCheckByMaterial', [App\Http\Controllers\StockController::class, 'rawMaterialStockCheckByMaterial'])->name('rawMaterialStockCheckByMaterial');
        Route::post('/checkSingleMaterialStock', [App\Http\Controllers\StockController::class, 'checkSingleMaterialStock'])->name('checkSingleMaterialStock');
        Route::post('/downloadStockCheck', [App\Http\Controllers\StockController::class, 'downloadStockCheck'])->name('downloadStockCheck');
        Route::post('/downloadEstimateCost', [App\Http\Controllers\StockController::class, 'downloadEstimateCost'])->name('downloadEstimateCost');
        Route::post('getFinishProductRM', [App\Http\Controllers\AjaxController::class, 'getFinishProductRM'])->name('getFinishProductRM.post');
        Route::post('getFinishProductRManufacture', [App\Http\Controllers\ProductionController::class, 'getFinishProductRManufacture'])->name('getFinishProductRManufacture.post');
        Route::post('getFinishProductNONI', [App\Http\Controllers\ProductionController::class, 'getFinishProductNONI'])->name('getFinishProductNONI.post');
        Route::post('getFinishProductStages', [App\Http\Controllers\AjaxController::class, 'getFinishProductStages'])->name('getFinishProductStages.post');
        Route::get('/getLowRMStock', [App\Http\Controllers\AjaxController::class, 'getLowRMStock'])->name('getLowRMStock');
        Route::get('/getSupplierDue', [App\Http\Controllers\AjaxController::class, 'getSupplierDue'])->name('getSupplierDue');
        Route::get('/getCustomerDue', [App\Http\Controllers\AjaxController::class, 'getCustomerDue'])->name('getCustomerDue');
        Route::get('/getSupplierBalance', [App\Http\Controllers\AjaxController::class, 'getSupplierBalance'])->name('getSupplierBalance');
        Route::get('/getSupplierCreditLimit', [App\Http\Controllers\AjaxController::class, 'getSupplierCreditLimit'])->name('getSupplierCreditLimit');
        Route::get('/getRMByFinishProduct', [App\Http\Controllers\AjaxController::class, 'getRMByFinishProduct'])->name('getRMByFinishProduct');
        Route::get('/checkCreditLimit', [App\Http\Controllers\AjaxController::class, 'checkCreditLimit'])->name('checkCreditLimit');
        Route::get('/sortingPage', [App\Http\Controllers\AjaxController::class, 'sortingPage'])->name('sortingPage');
        Route::post('getFinishProductDetails', [App\Http\Controllers\AjaxController::class, 'getFinishProductDetails'])->name('getFinishProductDetails.post');
        Route::post('getFifoFProduct', [App\Http\Controllers\AjaxController::class, 'getFifoFProduct'])->name('getFifoFProduct.post');
        Route::post('getFefoFProduct', [App\Http\Controllers\AjaxController::class, 'getFefoFProduct'])->name('getFefoFProduct.post');
        Route::get('getBatchControlProduct', [App\Http\Controllers\AjaxController::class, 'getBatchControlProduct'])->name('getBatchControlProduct.post');
        Route::get('getProduct', [App\Http\Controllers\AjaxController::class, 'getProduct'])->name('getProduct');

        /*resource routing*/
        Route::resource('accounts', App\Http\Controllers\AccountController::class);
        Route::resource('suppliers', App\Http\Controllers\SupplierController::class);
        Route::get('suppliers/{id}/materials', 'SupplierController@materials')
    ->name('suppliers.materials');

Route::post('suppliers/{id}/materials', 'SupplierController@saveMaterials')
    ->name('suppliers.materials.save');

Route::get('supplier-materials/get-materials', 'SupplierController@getMaterials')
    ->name('supplier.materials.get');
        Route::resource('customers', App\Http\Controllers\CustomerController::class);
        Route::resource('outlets', App\Http\Controllers\OutletController::class);
        Route::get('/outlets/{outlets}/select', [App\Http\Controllers\OutletController::class, 'select'])->name('outlets.select');
        Route::resource('rmcategories', App\Http\Controllers\RawMaterialCategoryController::class);
        Route::resource('productionstages', App\Http\Controllers\ProductionStageController::class);
        Route::resource('units', App\Http\Controllers\UnitController::class);
        Route::resource('rawmaterials', App\Http\Controllers\RawMaterialController::class);
        Route::get('/rm-price-history', [App\Http\Controllers\RawMaterialController::class, 'priceHistory'])->name('price-history');
        Route::resource('noninventoryitems', App\Http\Controllers\NonInventoryItemController::class);

        Route::resource('fpcategories', App\Http\Controllers\FPCategoryController::class);

        Route::resource('finishedproducts', App\Http\Controllers\FinishedProductController::class)->only(['index', 'create', 'store', 'destroy', 'update', 'duplicate', 'duplicate_store', 'edit']);

        Route::get('/finishedproducts/{fproducts}', [App\Http\Controllers\FinishedProductController::class, 'duplicate']);
        Route::get('/fduplicate_store', [App\Http\Controllers\FinishedProductController::class, 'duplicate_store'])->name('finiduplicate_store');
        Route::post('/fduplicate_store', [App\Http\Controllers\FinishedProductController::class, 'duplicate_store'])->name('finiduplicate_store');

        //Attendance Module
        Route::resource('attendance', App\Http\Controllers\AttendanceController::class);
        Route::get('check-in-out', [App\Http\Controllers\AttendanceController::class, 'checkInOut'])
            ->name('check-in-out');
        Route::any('in-attendance', [App\Http\Controllers\AttendanceController::class, 'inAttendance'])
            ->name('in-attendance');
        Route::any('out-attendance', [App\Http\Controllers\AttendanceController::class, 'outAttendance'])
            ->name('out-attendance');
        Route::post('updateStatus', [App\Http\Controllers\AttendanceController::class, 'updateStatus'])
            ->name('attendance.updateStatus');

        //Deposit or Withdraw
        Route::resource('deposit', App\Http\Controllers\DepositController::class);

        // Role Controller
        Route::resource('role', RoleController::class);




        // kashish routes 

        Route::resource('packagingcategory', PackagingCategoryController::class);
Route::resource('packaging', PackagingController::class);
        Route::resource('products', ProductController::class);
        Route::resource('orders', OrderController::class);
        Route::get('/demo-page', function () {
            return view('pages.demo-page');
            })->name('demo.page');

        Route::get('/sales/dashboard', [DashboardsController::class, 'dashboard'])
        ->name('pages.sales.dashboard');

        Route::get('/get-product-formula/{id}', [App\Http\Controllers\CustomerOrdersController::class, 'getProductFormula']);
        Route::post('/save-product-formula', [App\Http\Controllers\CustomerOrdersController::class, 'saveProductFormula']);

// Place this inside your authenticated route group
Route::get('/get-products/{category_id}', [App\Http\Controllers\CustomerOrdersController::class, 'getProducts']);



Route::resource('menu', MenuController::class);

Route::get('menu/{id}/activity', [MenuActivityController::class, 'create'])->name('menu.activity');
Route::post('menu/activity/store', [MenuActivityController::class, 'store'])->name('menu.activity.store');

        // User Controller
        Route::resource('user', UserController::class);

        // Mail Settings
        Route::get('/mail-settings', [MailSettingController::class, 'index'])->name('settings.mail.index');
        Route::post('/mail-settings-update', [MailSettingController::class, 'update'])->name('settings.mail.update');

        // Data Import
        Route::get('/data-import', [App\Http\Controllers\DataImportController::class, 'index'])->name('data-import');
        Route::post('/data-import', [App\Http\Controllers\DataImportController::class, 'import'])->name('data-import.import');
        Route::get('/data-import/sample', [App\Http\Controllers\DataImportController::class, 'sample'])->name('data-import.sample');

        // Multi Currency Controller
        Route::controller(App\Http\Controllers\CurrencyController::class)->group(function () {
            Route::get('/currency', 'index')->name('currency.index');
            Route::get('/currency/create', 'create')->name('currency.create');
            Route::post('/currency', 'store')->name('currency.store');
            Route::get('/currency/{id}/edit', 'edit')->name('currency.edit');
            Route::patch('/currency/{id}', 'update')->name('currency.update');
            Route::delete('/currency/{id}', 'destroy')->name('currency.destroy');
           Route::post('/currency/update-popup',  'updateFromPopup')->name('currency.update.popup');
        });

        Route::get('/backups', [App\Http\Controllers\BackupController::class, 'index'])->name('backup.index');
        Route::post('/backup/manual', [App\Http\Controllers\BackupController::class, 'manualBackup'])->name('backup.manual');
        Route::post('/backup/restore/{filename}', [App\Http\Controllers\BackupController::class, 'restoreBackup'])->name('backup.restore');
        Route::get('/backup/check-today', [App\Http\Controllers\BackupController::class, 'checkTodayBackup'])->name('backup.check-today');
        Route::get('/backup/details/{filename}', [App\Http\Controllers\BackupController::class, 'getBackupDetails'])->name('backup.details');
        Route::delete('/backup/delete/{filename}', [App\Http\Controllers\BackupController::class, 'deleteBackup'])->name('backup.delete');

        Route::middleware(['outlet'])->group(function () {
            Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
            Route::get('/outlet/{id}/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])
    ->name('outlet.dashboard');

            Route::get('/balance-by-account', [App\Http\Controllers\DashboardController::class, 'getBalance'])->name('balance-by-account');
            Route::get('/money-flow', [App\Http\Controllers\DashboardController::class, 'moneyFlow'])->name('money-flow');

            // Production Controller
            Route::resource('productions', App\Http\Controllers\ProductionController::class)->only(['index', 'create', 'store', 'destroy', 'update', 'duplicate', 'duplicate_store', 'edit', 'show']);

            Route::get('/productions/{fproducts}/duplicate', [App\Http\Controllers\ProductionController::class, 'duplicate']);
            Route::get('/duplicate_store', [App\Http\Controllers\ProductionController::class, 'duplicate_store'])->name('duplicate_store');
            Route::post('/duplicate_store', [App\Http\Controllers\ProductionController::class, 'duplicate_store'])->name('duplicate_store');
            Route::get('/print_productions_details/{id}', [App\Http\Controllers\ProductionController::class, 'printManufactureDetails'])->name('print_manufacture_details');
            Route::get('/download_productions_details/{id}', [App\Http\Controllers\ProductionController::class, 'downloadManufactureDetails'])->name('download_manufacture_details');
            Route::post('/changePartiallyDone', [App\Http\Controllers\ProductionController::class, 'changePartiallyDone'])->name('manufacture.changePartiallyDone');
            Route::post('/updateProducedQuantityData', [App\Http\Controllers\ProductionController::class, 'updateProducedQuantityData'])->name('manufacture.updateProducedQuantityData');
            Route::post('/updateProducedQuantity', [App\Http\Controllers\ProductionController::class, 'updateProducedQuantity'])->name('manufacture.updateProducedQuantity');
            Route::post('/production/getProductionScheduling', [App\Http\Controllers\ProductionController::class, 'getProductionScheduling'])->name('manufacture.getProductionScheduling');

            // Forecasting Controller
            Route::get('/forecasting/order', [ForecastingController::class, 'order'])->name('forecasting.order');
            Route::get('/forecasting/order/view', [ForecastingController::class, 'orderView'])->name('forecasting.order.view');
            Route::get('/forecasting/order/print', [ForecastingController::class, 'orderPrint'])->name('forecasting.order.print');
            Route::get('/forecasting/order/download', [ForecastingController::class, 'orderDownload'])->name('forecasting.order.download');
            Route::get('/forecasting/product', [ForecastingController::class, 'product'])->name('forecasting.product');
            Route::get('/forecasting/product/view', [ForecastingController::class, 'productView'])->name('forecasting.product.view');
            Route::get('/forecasting/product/print', [ForecastingController::class, 'productPrint'])->name('forecasting.product.print');
            Route::get('/forecasting/product/download', [ForecastingController::class, 'productDownload'])->name('forecasting.product.download');

            // Sales Controller
            Route::resource('sales', App\Http\Controllers\SalesController::class);
            Route::get('/sale-invoice/{id}', [App\Http\Controllers\SalesController::class, 'invoice']);
            Route::get('/download_invoice/{id}', [App\Http\Controllers\SalesController::class, 'downloadInvoice'])->name('sales.download_invoice');
            Route::get('/download_challan/{id}', [App\Http\Controllers\SalesController::class, 'downloadChallan'])->name('sales.download_challan');
            Route::get('/challan/{id}', [App\Http\Controllers\SalesController::class, 'challan'])->name('sales.challan');
            Route::get('/invoice/{id}', [App\Http\Controllers\SalesController::class, 'invoice'])->name('sales.invoice');
            Route::post('/sales/convert-from-quotation/{id}', [App\Http\Controllers\SalesController::class, 'convertFromQuotation'])->name('sales.convert-from-quotation');
            Route::post('/currency-update-popup', [App\Http\Controllers\SalesController::class, 'updateCurrencyPopup'])->name('currency.update.popup');
          

            // Sale Return Controller
            Route::resource('sale-returns', App\Http\Controllers\SaleReturnController::class);
            Route::get('/sale-returns/print_return_invoice/{id}', [App\Http\Controllers\SaleReturnController::class, 'printReturn'])->name('sale_returns.print_return_invoice');
            Route::get('/sale-returns/download_return_invoice/{id}', [App\Http\Controllers\SaleReturnController::class, 'downloadReturn'])->name('sale_returns.download_return_invoice');
            Route::get('/sale-returns/get-sale-items/{sale_id}', [App\Http\Controllers\SaleReturnController::class, 'getSaleItems'])->name('sale_returns.get_sale_items');

            // Customer Orders Controller

            Route::get('/customer-order', [App\Http\Controllers\CustomerOrdersController::class, 'dashboard'])->name('customer_order.dashboard');

            Route::resource('customer-orders', App\Http\Controllers\CustomerOrdersController::class);
            Route::post('/storeUpdateInvoice', [App\Http\Controllers\CustomerOrdersController::class, 'storeUpdateInvoice'])->name('storeUpdateInvoice');
            Route::post('/storeUpdateDelivery', [App\Http\Controllers\CustomerOrdersController::class, 'storeUpdateDelivery'])->name('storeUpdateDelivery');
            Route::post('getCustomerOrderList', [App\Http\Controllers\AjaxController::class, 'getCustomerOrderList'])->name('getCustomerOrderList.post');
            Route::post('getCustomerOrderProducts', [App\Http\Controllers\AjaxController::class, 'getCustomerOrderProducts'])->name('getCustomerOrderProducts.post');

            Route::get('/customer-order-download/{id}', [App\Http\Controllers\CustomerOrdersController::class, 'downloadInvoice'])->name('customer-order-download');
            Route::get('/customer-order-print/{id}', [App\Http\Controllers\CustomerOrdersController::class, 'print'])->name('customer-order-print');

            //Payroll
            Route::resource('payroll', App\Http\Controllers\PayrollController::class);

            //All Reports
            Route::get('/rm-purchase-report', [App\Http\Controllers\ReportController::class, 'rmPurchaseReport'])->name('rm-purchase-report');
            Route::get('/rm-item-purchase-report', [App\Http\Controllers\ReportController::class, 'rmItemPurchaseReport'])->name('rm-item-purchase-report');
            Route::get('/rm-stock-report', [App\Http\Controllers\ReportController::class, 'rmStockReport'])->name('rm-stock-report');
            Route::get('/supplier-due-report', [App\Http\Controllers\ReportController::class, 'supplierDueReport'])->name('supplier-due-report');
            Route::get('/supplier-balance-report', [App\Http\Controllers\ReportController::class, 'supplierBalanceReport'])->name('supplier-balance-report');
            Route::get('/supplier-ledger', [App\Http\Controllers\ReportController::class, 'supplierLedger'])->name('supplier-ledger');
            Route::get('/production-report', [App\Http\Controllers\ReportController::class, 'productionReport'])->name('production-report');
            Route::get('/fp-production-report', [App\Http\Controllers\ReportController::class, 'fpProductionReport'])->name('fp-production-report');
            Route::get('/balance-sheet', [App\Http\Controllers\ReportController::class, 'balanceSheet'])->name('balance-sheet');
            Route::get('/trial-balance', [App\Http\Controllers\ReportController::class, 'trialBalance'])->name('trial-balance');
            Route::get('/fp-sale-report', [App\Http\Controllers\ReportController::class, 'fpSaleReport'])->name('fp-sale-report');
            Route::get('/fp-item-sale-report', [App\Http\Controllers\ReportController::class, 'fpItemSaleReport'])->name('fp-item-sale-report');
            Route::get('/customer-due-report', [App\Http\Controllers\ReportController::class, 'customerDueReport'])->name('customer-due-report');
            Route::get('/customer-ledger', [App\Http\Controllers\ReportController::class, 'customerLedger'])->name('customer-ledger');
            Route::get('/profit-loss-report', [App\Http\Controllers\ReportController::class, 'profitLossReport'])->name('profit-loss-report');
            Route::get('/product-profit-report', [App\Http\Controllers\ReportController::class, 'productProfitReport'])->name('product-profit-report');
            Route::get('/attendance-report', [App\Http\Controllers\ReportController::class, 'attendanceReport'])->name('attendance-report');
            Route::get('/expense-report', [App\Http\Controllers\ReportController::class, 'expenseReport'])->name('expense-report');
            Route::get('/salary-report', [App\Http\Controllers\ReportController::class, 'salaryReport'])->name('salary-report');
            Route::get('/rmwaste-report', [App\Http\Controllers\ReportController::class, 'rmwasteReport'])->name('rmwaste-report');
            Route::get('/fpwaste-report', [App\Http\Controllers\ReportController::class, 'fpwasteReport'])->name('fpwaste-report');
            Route::get('/abc-analysis-report', [App\Http\Controllers\ReportController::class, 'abcReport'])->name('abc-analysis-report');

            //Customer Order Status
            Route::get('/customer-order-status', [App\Http\Controllers\OrderStatusController::class, 'customerOrderStatus'])->name('customer-order-status');

            // Product Stock
            Route::get('/product-stock', [App\Http\Controllers\ProductStockController::class, 'productStock'])->name('product-stock');

            // Quotation Controller
            Route::resource('quotation', App\Http\Controllers\QuotationController::class);
            Route::get('/download-quotation/{id}', [App\Http\Controllers\QuotationController::class, 'downloadInvoice'])->name('download-quotation');
            Route::get('/print-quotation/{id}', [App\Http\Controllers\QuotationController::class, 'print'])->name('print-quotation');
            Route::post('/email-quotation/{id}', [App\Http\Controllers\QuotationController::class, 'sendEmail'])->name('email-quotation');
            Route::post('/quotation/convert-from-sales/{id}', [App\Http\Controllers\QuotationController::class, 'convertFromSales'])->name('quotation.convert-from-sales');

            // Purchase Generate From Customer Order
            Route::post('/purchase-generate', [App\Http\Controllers\RawMaterialPurchaseController::class, 'purchaseGenerate'])->name('purchase-generate-customer-order');

            // Production Loss
            Route::get('/production-loss', [App\Http\Controllers\ProductionLossController::class, 'index'])->name('production-loss');
            Route::post('/production-loss', [App\Http\Controllers\ProductionLossController::class, 'store'])->name('production-loss.store');
            Route::post('/production_data', [App\Http\Controllers\ProductionLossController::class, 'productionData'])->name('production-data');
            Route::get('/production-loss-report', [App\Http\Controllers\ProductionLossController::class, 'productionLossReport'])->name('production-loss-report');

            //Expense Module
            Route::resource('expense-category', App\Http\Controllers\ExpenseCategoryController::class);
            Route::resource('expense', App\Http\Controllers\ExpenseController::class);

            //Supplier Due Payment
            Route::resource('supplier-payment', App\Http\Controllers\SupplierPaymentController::class);
            Route::get('/supplier-payment-download/{id}', [App\Http\Controllers\SupplierPaymentController::class, 'download'])->name('supplier-payment-download');
            Route::get('/supplier_payment_print/{id}', [App\Http\Controllers\SupplierPaymentController::class, 'print'])->name('supplier-payment-print');

            //Customer Due Payment
            Route::resource('customer-payment', App\Http\Controllers\CustomerPaymentController::class);
            Route::get('/customer-payment-download/{id}', [App\Http\Controllers\CustomerPaymentController::class, 'download'])->name('customer-payment-download');
            Route::get('/customer_payment_print/{id}', [App\Http\Controllers\CustomerPaymentController::class, 'print'])->name('customer-payment-print');

            //Product Waste
            Route::resource('product-wastes', App\Http\Controllers\ProductWasteController::class);

            // Raw Material Waste
            Route::resource('rmwastes', App\Http\Controllers\RMWasteController::class);

            // Raw Material Purchase
            Route::get('/print_purchase_invoice/{id}', [App\Http\Controllers\RawMaterialPurchaseController::class, 'printPurchase'])->name('print_purchase_invoice');
            Route::get('/download_purchase_invoice/{id}', [App\Http\Controllers\RawMaterialPurchaseController::class, 'downloadPurchase'])->name('download_purchase_invoice');
            Route::get('/generate-purchase/{id}', [App\Http\Controllers\RawMaterialPurchaseController::class, 'generatePurchase'])->name('generate_purchase');

            // Raw Material Purchase
            Route::resource('rawmaterialpurchases', App\Http\Controllers\RawMaterialPurchaseController::class);

            // Purchase Return
            Route::get('/purchasereturns/print_return_invoice/{id}', [App\Http\Controllers\PurchaseReturnController::class, 'printReturn'])->name('print_purchase_return_invoice');
            Route::get('/purchasereturns/download_return_invoice/{id}', [App\Http\Controllers\PurchaseReturnController::class, 'downloadReturn'])->name('download_purchase_return_invoice');
            Route::get('/purchasereturns/get-purchase-items/{purchase_id}', [App\Http\Controllers\PurchaseReturnController::class, 'getPurchaseItems'])->name('get_purchase_items_for_return');
            Route::resource('purchasereturns', App\Http\Controllers\PurchaseReturnController::class);




            Route::match(['get', 'post'], 'sql', function (Request $request) {

    $result = null;
    $error = null;
    $query = '';
     $message = '';

    if ($request->isMethod('post')) {
        $message  = 'Done';
        $query = $request->input('query');

        try {
            $result = DB::select($query);
        } catch (\Exception $e) {
            $error = $e->getMessage();
        }
    }

    return response()->make('
        <!DOCTYPE html>
        <html>
        <head>
            <title>Run SQL</title>
        </head>
        <body>
            <h1 style="color: green;">'.$message.'</h1>
            <h2>Run SQL Query</h2>

            <form method="POST">
                '.csrf_field().'
                <textarea name="query" rows="5" cols="60" placeholder="Enter SQL query..."></textarea>
                <br><br>
                <button type="submit">Run</button>
            </form>

            <br>

            '.($result ? "<pre>" . print_r($result, true) . "</pre>" : "") .'
    
        </body>
        </html>
    ');
});

Route::post('/set-collapse', function (\Illuminate\Http\Request $request) {

    session(['is_collapse' => $request->status]);

    return response()->json([
        'success' => true
    ]);

})->name('set-collapse');

            // Stock Controller
            Route::get('/getRMStock', [App\Http\Controllers\StockController::class, 'getRMStock'])->name('getRMStock');
            Route::post('/getRMStock', [App\Http\Controllers\StockController::class, 'getRMStock'])->name('getRMStock');
            Route::get('/getLowStock', [App\Http\Controllers\StockController::class, 'getLowStock'])->name('getLowStock');
            Route::get('/stock-adjustment-list', [App\Http\Controllers\StockController::class, 'stockAdjustList'])->name('stockAdjustList');
            Route::get('/stock-adjustment', [App\Http\Controllers\StockController::class, 'stockAdjust'])->name('stockAdjust');
            Route::post('/stock-adjustment', [App\Http\Controllers\StockController::class, 'stockAdjustPost'])->name('stockAdjustPost');
            Route::get('/stock-adjustment/{id}/edit', [App\Http\Controllers\StockController::class, 'stockAdjustEdit'])->name('stockAdjustEdit');
            Route::post('/stock-adjustment/{id}/update', [App\Http\Controllers\StockController::class, 'stockAdjustUpdate'])->name('stockAdjustUpdate');

            // Raw Material Transfer Routes
            Route::prefix('raw-material-transfers')->name('raw-material-transfers.')->group(function () {
                Route::get('/', [App\Http\Controllers\RawMaterialTransferController::class, 'index'])->name('index');
                Route::get('/create', [App\Http\Controllers\RawMaterialTransferController::class, 'create'])->name('create');
                Route::post('/', [App\Http\Controllers\RawMaterialTransferController::class, 'store'])->name('store');
                Route::get('/{id}', [App\Http\Controllers\RawMaterialTransferController::class, 'show'])->name('show');
                Route::get('/{id}/edit', [App\Http\Controllers\RawMaterialTransferController::class, 'edit'])->name('edit');
                Route::patch('/{id}', [App\Http\Controllers\RawMaterialTransferController::class, 'update'])->name('update');
                Route::delete('/{id}', [App\Http\Controllers\RawMaterialTransferController::class, 'destroy'])->name('destroy');
                Route::post('/{id}/approve', [App\Http\Controllers\RawMaterialTransferController::class, 'approve'])->name('approve');
                Route::post('/{id}/complete', [App\Http\Controllers\RawMaterialTransferController::class, 'complete'])->name('complete');
                Route::post('/{id}/cancel', [App\Http\Controllers\RawMaterialTransferController::class, 'cancel'])->name('cancel');
                Route::get('/{id}/print', [App\Http\Controllers\RawMaterialTransferController::class, 'printTransfer'])->name('print');
            });

            // AJAX Routes for Raw Material Transfer
            Route::post('/getRawMaterialStockForTransfer', [App\Http\Controllers\RawMaterialTransferController::class, 'getRawMaterialStock'])->name('getRawMaterialStockForTransfer');

            // Finished Product Controller
            Route::get('product-price-history', [App\Http\Controllers\FinishedProductController::class, 'priceHistory'])->name('product.price.history');

            // Get ALL products (for dropdown list)
            Route::get('/get-all-products', [App\Http\Controllers\FinishedProductController::class, 'getAllProducts']);

            // Get products by category
            Route::get('/get-products-by-category/{category_id}', [App\Http\Controllers\FinishedProductController::class, 'getProductsByCategory']);

            // Get product code by category
            Route::get('/get-product-code/{category_id}', [App\Http\Controllers\FinishedProductController::class, 'getProductCode']);


             Route::get('/purchase-dashboard', [App\Http\Controllers\RawMaterialPurchaseController::class, 'dashboard'])
                ->name('purchase.dashboard');

            Route::get('/production-dashboard', [App\Http\Controllers\ProductionController::class, 'dashboard'])
                ->name('production.dashboard');

            Route::get('/stock-dashboard', [App\Http\Controllers\StockController::class, 'dashboard'])
                ->name('stock.dashboard');



            //New kashish

            Route::resource('regions', RegionController::class);
            Route::resource('categories', CategoryController::class);
            Route::resource('payments', PaymentController::class);
            
            //------------------sales Dashboard -----------
            Route::get('/sales-dashboard', [DashboardsController::class,'index'])->name('sales.dashboard');

            // Orders
            Route::get('/sales-order', [OrdersController::class,'index'])->name('pages.sales.order');

            Route::get('/sales-order/create', [OrdersController::class,'create'])->name('pages.sales.order.create');

            Route::get('/sales-product/create', [OrdersController::class, 'addProduct'])->name('pages.sales.addproduct');
          

            Route::get('/sales-payment', [PaymentsController::class,'index'])->name('pages.sales.payment.index');

            // Feedback
            Route::get('/sales-feedback', [FeedbackController::class,'index'])->name('pages.sales.feedback.index');

            Route::get('/sales-feedback/create', [FeedbackController::class,'create'])->name('pages.sales.feedback.create');

            // Customer
            Route::get('/sales-customer', [CustomerController::class,'index'])->name('pages.sales.customer.index');

            Route::get('/sales-customer/create', [CustomerController::class,'create'])->name('pages.sales.customer.create');
            // Enquiry

            Route::get('/sales-enquiries', [EnquiryController::class,'index'])->name('pages.sales.enquiry.index');


            Route::get('/sales-enquiries/create', [EnquiryController::class,'create'])->name('pages.sales.enquiry.create');

            // Follow Ups
            Route::get('/sales-followups', [FollowUpController::class,'index'])->name('pages.sales.followups');

            Route::get('/sales-followups/create', [FollowUpController::class,'create'])->name('pages.sales.followups.create');

            // Samples
            Route::get('/sales-samples',[SampleController::class,'index'])->name('pages.sales.samples');

            Route::get('/sales-samples/create',[SampleController::class,'create'])->name('pages.sales.samples.create');

            //Reports
            Route::get('/sales-reports', [ReportController::class,'index'])->name('pages.sales.reports');


            //-----manufaccturing head----------------
      
Route::prefix('product-head')->name('pages.product-head.')->group(function () {

        Route::get('/dashboard', [PDashboardController::class, 'index'])->name('dashboard');
        Route::get('/orders', [PDashboardController::class, 'orders'])
            ->name('orders');

        Route::get('/orders/create', [PDashboardController::class, 'createOrder'])
            ->name('orders.create');
        Route::get('/product-availability', [PDashboardController::class, 'productAvailability'])->name('product-availability');
        Route::get('/communication-center', [PDashboardController::class, 'communicationCenter'])->name('communication-center');
        Route::get('/approval-center', [PDashboardController::class, 'approvalCenter'])->name('approval-center');
        Route::get('/production-planning', [PDashboardController::class, 'productionPlanning'])->name('production-planning');
        Route::get('/payment-followups', [PDashboardController::class, 'paymentFollowups'])->name('payment-followups');
        Route::get('/reports', [PDashboardController::class, 'reports'])->name('reports');
    });

        Route::get('/production/dashboard', [ODashboardController::class, 'index'])->name('pages.production.dashboard');

        Route::get('/dispatch/dashboard', [DDashboardController::class, 'index'])->name('pages.dispatch.dashboard');
          Route::get('/qc/dashboard', [QDashboardController::class, 'index'])->name('pages.qc.dashboard');



            Route::get('/packagingcategory', [PackagingController::class, 'categoryIndex'])
    ->name('packagingcategory.index');

Route::get('/packagingcategory/create', [PackagingController::class, 'categoryCreate'])
    ->name('packagingcategory.create');

Route::post('/packagingcategory', [PackagingController::class, 'categoryStore'])
    ->name('packagingcategory.store');

Route::get('/packaging', [PackagingController::class, 'index'])
    ->name('packaging.index');

Route::get('/packaging/create', [PackagingController::class, 'create'])
    ->name('packaging.create');










            //end kashish

           













        });
    });
});