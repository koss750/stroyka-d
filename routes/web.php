<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DesignController;
use App\Http\Controllers\ExchangeRateController;
use App\Http\Controllers\DailyAverageRateController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\UIController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\InvoiceModuleController;
use App\Http\Controllers\SectionItemController;
use App\Http\Controllers\ExternalSimulationController;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\OrderController;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;


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

Route::get('/', function () {
    return redirect('/site');
});

//under construction - переделать
Route::prefix('projects')->middleware('check.redirection')->group(function () {
    Route::view('/{slug}', 'under-construction')->middleware('counter');
});
Route::prefix('fundament')->middleware('check.redirection')->group(function () {
    Route::view('/{slug}', 'under-construction')->middleware('counter');
});

Route::get('/forex', [ExchangeRateController::class, 'index']);
Route::get('/export', [DesignController::class, 'exportAll']);
Route::get('/forex-day', [DailyAverageRateController::class, 'index']);
Route::get('/browse/{category?}', [DesignController::class, 'getDemoDesigns']);
Route::get('/project/{id}', [DesignController::class, 'getDemoDetail'])->middleware('counter');
Route::get('/order', [DesignController::class, 'getDemoOrder']);
Route::get('/checkout', [DesignController::class, 'getDemoCheckout']);
Route::get('/email-inbox', [UIController::class, 'email_inbox']);
Route::get('/messages', [UIController::class, 'email_inbox']);
Route::get('/email-compose', [UIController::class, 'email_compose']);
Route::get('/email-read', [UIController::class, 'email_read']);
Route::get('/page-login', [UIController::class, 'page_login']);
Route::get('/app-profile', [UIController::class, 'app_profile']);
Route::get('/contacts', [UIController::class, 'contacts']);
Route::get('/dashboard', [UIController::class, 'dashboard_1']);
Route::get('/register', [UIController::class, 'page_register']);
Route::get('/str', [UIController::class, 'str']);
Route::post('/smeta', [InvoiceController::class, 'invoiceViewReferences']);
Route::get('/trigger-invoice-view', [InvoiceController::class, 'triggerInvoiceView']);
Route::get('/smeta/{id}', [InvoiceController::class, 'invoiceViewFull']);
Route::get('/register-supplier', [UIController::class, 'page_register_supplier']);
Route::get('/register-contractor', [UIController::class, 'page_register_contractor']);
Route::get('/chats/{conversation}', [ChatController::class, 'show'])->name('chats.show');
Route::get('/skachatushki', function () {
    return InvoiceModuleController::downloadInvoiceItemsCsv();
});
Route::prefix('invoices')->group(function () {
    Route::post('/process-multiple', [InvoiceModuleController::class, 'processMultiple']);
    Route::get('/{invoice}/sections', [InvoiceModuleController::class, 'gatherSection']);
    Route::post('/sections/{section}', [InvoiceModuleController::class, 'fillSections']);
    Route::get('/{invoice}/variables', [InvoiceModuleController::class, 'getVariables']);
    Route::post('/final-calculation', [InvoiceModuleController::class, 'finalCalculation']);
});
/*
Route::middleware(['check.redirection'])->group(function () {
    Route::get('/projects/{slug}', [UIController::class, 'showProjects'])->middleware('counter');
});
*/
//Route::get('/metal', [SectionItemController::class, 'addMetal']);
//Route::get('/external', [ExternalSimulationController::class, 'process']);
Route::get('/simulate', [App\Http\Controllers\BetSimulationController::class, 'simulate']);
Route::prefix('site')->group(function () {
    Route::get('/', function () {
        return view('index');
    //    $foundations = DynamicPageCard::where('type', 'foundation')->get()->toArray();
    //    $cards = DynamicPageCard::where('type', 'home')->get()->toArray();

//        return view('index', compact('cards', 'foundations'));
    });
});


Route::get('/keys/{designId}', function ($designId) {
    $keys = Redis::connection('external')->keys("*");
    return $keys;
});

Route::post('/register-order', function (Request $request) {
    $project = Project::create([
        'user_id' => Auth::id(),
        'ip_address' => $request->ip(),
        'payment_reference' => 'test',
        'payment_amount' => 200.00,
        'design_id' => $request->input('designId'),
        'selected_configuration' => json_decode($request->input('selectedOptions')),
    ]);

    // Send request to external API
    $response = Http::post("http://tmp.mirsmet.com/process-order/{$project->id}");
    $fileLink = $response->json('file_link');

    // Update project with file link
    $project->update(['filepath' => $fileLink]);

    return response()->json([
        'message' => 'Скачать смету',
        'orderId' => $project->id,
        'fileLink' => $fileLink
    ]);
});





Route::prefix('vora')->group(function () {
    Route::controller(UIController::class)->group(function() {
        Route::get('/','dashboard_1');
        Route::get('/index','dashboard_1');
        Route::get('/index-2','dashboard_2');
        //Route::get('/projects','projects');
        Route::get('/contacts','contacts');
        Route::get('/kanban','kanban');
        Route::get('/calendar','calendar');
        Route::get('/messages','messages');
        Route::get('/app-calender','app_calender');
        Route::get('/app-profile','app_profile');
        Route::get('/edit-profile','edit_profile');
        Route::match(['get','post'], '/post-details','post_details');
        Route::get('/chart-chartist','chart_chartist');
        Route::get('/chart-chartjs','chart_chartjs');
        Route::get('/chart-flot','chart_flot');
        Route::get('/chart-morris','chart_morris');
        Route::get('/chart-peity','chart_peity');
        Route::get('/chart-sparkline','chart_sparkline');
        Route::get('/ecom-checkout','ecom_checkout');
        Route::get('/ecom-customers','ecom_customers');
        Route::get('/ecom-invoice','ecom_invoice');
        Route::get('/ecom-product-detail','ecom_product_detail');
        Route::get('/ecom-product-grid','ecom_product_grid');
        Route::get('/ecom-product-list','ecom_product_list');
        Route::get('/ecom-product-order','ecom_product_order');
        Route::match(['get','post'], '/email-compose','email_compose');
        Route::get('/email-inbox','email_inbox');
        Route::get('/email-read','email_read');
        Route::get('/form-editor-ckeditor','form_ckeditor');
        Route::get('/form-element','form_element');
        Route::get('/form-pickers','form_pickers');
        Route::get('/form-validation-jquery','form_validation_jquery');
        Route::get('/form-wizard','form_wizard');
        Route::get('/map-jqvmap','map_jqvmap');
        Route::get('/page-error-400','page_error_400');
        Route::get('/page-error-403','page_error_403');
        Route::get('/page-error-404','page_error_404');
        Route::get('/page-error-500','page_error_500');
        Route::get('/page-error-503','page_error_503');
        Route::get('/page-forgot-password','page_forgot_password');
        Route::get('/page-lock-screen','page_lock_screen');
        Route::get('/page-login','page_login');
        Route::get('/page-register','page_register');
        Route::get('/table-bootstrap-basic','table_bootstrap_basic');
        Route::get('/table-datatable-basic','table_datatable_basic');
        Route::get('/uc-lightgallery','uc_lightgallery');
        Route::get('/uc-nestable','uc_nestable');
        Route::get('/uc-noui-slider','uc_noui_slider');
        Route::get('/uc-select2','uc_select2');
        Route::get('/uc-sweetalert','uc_sweetalert');
        Route::get('/uc-toastr','uc_toastr');
        Route::get('/ui-accordion','ui_accordion');
        Route::get('/ui-alert','ui_alert');
        Route::get('/ui-badge','ui_badge');
        Route::get('/ui-button','ui_button');
        Route::get('/ui-button-group','ui_button_group');
        Route::get('/ui-card','ui_card');
        Route::get('/ui-carousel','ui_carousel');
        Route::get('/ui-dropdown','ui_dropdown');
        Route::get('/ui-grid','ui_grid');
        Route::get('/ui-list-group','ui_list_group');
        Route::get('/ui-media-object','ui_media_object');
        Route::get('/ui-modal','ui_modal');
        Route::get('/ui-pagination','ui_pagination');
        Route::get('/ui-popover','ui_popover');
        Route::get('/ui-progressbar','ui_progressbar');
        Route::get('/ui-tab','ui_tab');
        Route::get('/ui-typography','ui_typography');
        Route::get('/widget-basic','widget_basic');
        Route::post('/ajax/recent-activities','recent_activities_ajax');
        Route::post('/ajax/contacts','contacts_ajax');
    });
});



