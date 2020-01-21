<?php

//admin
Route::name('admin.')->namespace('Admin')->middleware('isAdmin')->prefix('admin/') ->group(function () {
    Route::get('/', 'DashboardController')->name('dashboard'); ;
    Route::get('/dashboard', 'DashboardController');
    Route::resource('pages', 'PageController');
//    Route::resource('review', 'ReviewController');
    Route::resource('static-solution', 'LeaseOfferController');
    Route::resource('solution', 'SolutionController');
    Route::resource('category', 'CategoryController');
    Route::resource('faq', 'FaqController');
    Route::patch('editor/{id}/update', 'TextController@update')->name('text-editor.update');
    Route::resource('editor', 'TextController', ['only' => ['index', 'edit']]);
    Route::resource('seo-manager', 'SeoController');
    Route::get('file-manager', 'FileManagerController@index')->name('file-manager.index');
    Route::get('notificaties', 'NotificationController@index')->name('notification.index');
    Route::get('notificaties/{id}', 'NotificationController@show')->name('notification.show');
//    Route::get('pdf/streamInvoice/{id}', 'PdfController@streamInvoice')->name('pdf.streamInvoice');
//    Route::get('pdf/downloadInvoice{id}', 'PdfController@downloadInvoice')->name('pdf.downloadInvoice');
});

Route::group(['prefix' => 'admin/laravel-filemanager', 'middleware' => ['web', 'isAdmin']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});



//Route::get('/symlink', function (){
//    return symlink(
//        '/home/mediaver/domains/mediaverse-dev.nl/laravel-leaseofferte/storage/app/public',
//        '/home/mediaver/domains/mediaverse-dev.nl/private_html/storage'
//        );
//})->name('page.show');

//Auth::routes();
//Route::get('/logout', 'Auth\LoginController@logout');
//Route::get('/site-map', 'Site\SiteMapController');
Auth::routes();

//Route::get('/test', 'TestController');

Route::get('/home', 'HomeController@index')->name('home');

//site
Route::name('site.')->namespace('Site')->group(function () {

    Route::get('/test', function (){
//        return view('test2');
        return include(base_path() .'/cartel-module/responsive-caw.php');
//        return include(base_path() .'/v/cartel-module/responsive-caw.php');
    });
    Route::get('/home', 'WelcomeController');
    Route::get('/', 'WelcomeController')->name('home');

//    Route::post('/review', 'ReviewController@store')->name('review.store');
    Route::get('/contact', 'ContactController@index')->name('contact.index');
    Route::post('/contact', 'ContactController@store')->name('contact.store');
    Route::get('/auto-voorraad', 'StockController@index')->name('stock.index');
    Route::get('/{title}-{id}-voorraad', 'StockController@show')->name('stock.show');
    Route::post('/calculator', 'CalculatorController@store')->name('calculator.store');
    Route::post('/formStep', 'CalculatorController@formStep')->name('calculator.formStep');
    Route::get('/over-ons', 'SiteController@about')->name('about');
    Route::get('/faq', 'SiteController@faq')->name('faq');
    Route::get('/algemene-voorwaarden', 'SiteController@terms')->name('terms');
    Route::get('/privacy-en-cookiebeleid', 'SiteController@policy')->name('privacy');
    Route::get('/lease-oplossingen', 'LeaseSolutionController@index')->name('solution.index');
    Route::get('/lease-oplossingen-{title}/{id}', 'LeaseSolutionController@show')->name('solution.show');

    Route::get('/operational-lease', 'LeaseOfferController@index')->name('offer.index');
    Route::get('/operational-lease-{title}/{id}', 'LeaseOfferController@show')->name('offer.show');

    Route::get('/{slug}', 'PageController@show')->name('page.show'); //This replaces all the individual routes

});

Route::post('/text-editor-{id}', 'Api\TextEditorController@edit');
Route::get('/lease-calculator', 'Api\LeaseCalculatorController@show');
