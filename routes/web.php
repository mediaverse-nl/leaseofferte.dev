<?php

Route::get('/widget', 'WidgetController@widget')->middleware(['calculatorToken']);
//Route::get('/test-widget', 'WidgetController@test');

//Route::get('/linkstorage', function () {
//    Artisan::call('storage:link');
//});

//admin
Route::name('admin.')->namespace('Admin')->middleware(['isAdmin'])->prefix('admin/') ->group(function () {
    Route::get('/', 'DashboardController')->name('dashboard'); ;
    Route::get('/dashboard', 'DashboardController');
    Route::resource('pages', 'PageController');
    Route::resource('portfolio', 'PortfolioController');
    Route::resource('news', 'NewsController');
    Route::resource('static-solution', 'LeaseOfferController');
    Route::resource('solution', 'SolutionController');
    Route::resource('category', 'CategoryController');
    Route::resource('faq', 'FaqController');
    Route::resource('editor', 'TextController', ['only' => ['index', 'edit']]);
    Route::patch('editor/{id}/update', 'TextController@update')->name('text-editor.update');
    Route::resource('seo-manager', 'SeoController');
    Route::get('file-manager', 'FileManagerController@index')->name('file-manager.index');
    Route::get('notificaties', 'NotificationController@index')->name('notification.index');
    Route::get('notificaties/{id}', 'NotificationController@show')->name('notification.show');
    Route::get('/mail-preview-1', 'MailController@contact')->name('contact');
    Route::get('/mail-preview-2', 'MailController@offerte')->name('offerte');
    Route::get('/mail-preview-3', 'MailController@operational')->name('operational');
    Route::get('/mail-preview-4', 'MailController@adminOfferte')->name('admin.operational');
    Route::get('/pdf-operational', 'MailController@operationalPdf')->name('pdf.operational');
    Route::get('/pdf-order', 'MailController@offertePdf')->name('pdf.order');
});

Route::group(['prefix' => 'admin/laravel-filemanager', 'middleware' => ['web', 'isAdmin']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::get('/site-map', 'Site\SiteMapController');

Auth::routes(['verify' => false, 'register' => false]);

//site
Route::name('site.')->namespace('Site')
//    ->middleware('optimize')
    ->group(function () {
    Route::get('/autos/{a?}/{b?}/{c?}/{d?}/{e?}/{f?}/{g?}', 'CartelController@index')->name('cartel.index');
    Route::get('/home', 'WelcomeController');
    Route::get('/', 'WelcomeController')->name('home');
    Route::get('autolease', 'SiteController@autolease')->name('autolease');
    Route::post('refresh-csrf', 'TokenRefreshController');
    Route::get('info/nieuws', 'NewsController@index')->name('news.index');
    Route::get('info/nieuws/{title}/{id}', 'NewsController@show')->name('news.show');
    Route::get('/contact', 'ContactController@index')->name('contact.index');
    Route::post('/contact', 'ContactController@store')->name('contact.store');
    Route::post('/calculator', 'CalculatorController@store')->name('calculator.store');
    Route::post('/formStep', 'CalculatorController@formStep')->name('calculator.formStep');
    Route::post('/operational', 'CalculatorController@operational')->name('calculator.operational');
    Route::get('/info', 'SiteController@about')->name('about');
    Route::get('/faq', 'SiteController@faq')->name('faq');
    Route::get('/algemene-voorwaarden', 'SiteController@terms')->name('terms');
    Route::get('/privacy-en-cookiebeleid', 'SiteController@policy')->name('privacy');
    Route::get('/lease-oplossingen', 'LeaseSolutionController@index')->name('solution.index');
    Route::get('/lease-oplossingen-{title}/{id}', 'LeaseSolutionController@show')->name('solution.show');
    Route::get('/operational-lease', 'LeaseOfferController@index')->name('offer.index');
    Route::get('/operational-lease-{title}/{id}', 'LeaseOfferController@show')->name('offer.show');
    Route::get('/{slug}', 'PageController@show')->name('page.show');
});

Route::post('/text-editor-{id}', 'Api\TextEditorController@edit');
Route::get('/lease-calculator', 'Api\LeaseCalculatorController@show');

//Route::get('/symlink', function (){
//    return symlink(
//        '/home/mediaver/domains/mediaverse-dev.nl/laravel-leaseofferte/storage/app/public',
//        '/home/mediaver/domains/mediaverse-dev.nl/private_html/storage'
//        );
//})->name('page.show');
