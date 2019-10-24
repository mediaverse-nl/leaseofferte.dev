<?php

//admin
Route::name('admin.')->namespace('Admin')->middleware('isAdmin')->prefix('admin/') ->group(function () {
    Route::get('/', 'DashboardController')->name('dashboard'); ;
    Route::get('/dashboard', 'DashboardController');
    Route::resource('pages', 'PageController');
//    Route::resource('review', 'ReviewController');
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

Route::get('/home', 'HomeController@index')->name('home');

//site
Route::name('site.')->namespace('Site')->group(function () {

    Route::get('/home', 'WelcomeController');
    Route::get('/', 'WelcomeController')->name('home');

//    Route::post('/review', 'ReviewController@store')->name('review.store');
    Route::get('/contact', 'ContactController@index')->name('contact.index');
    Route::post('/contact', 'ContactController@store')->name('contact.store');
    Route::get('/over-ons', 'SiteController@about')->name('about');
    Route::get('/faq', 'SiteController@faq')->name('faq');
    Route::get('/algemene-voorwaarden', 'SiteController@terms')->name('terms');
    Route::get('/privacy-en-cookiebeleid', 'SiteController@policy')->name('privacy');
    Route::get('/lease-oplossingen', 'LeaseSolutionController@index')->name('solution.index');
    Route::get('/lease-oplossingen-{title}/{id}', 'LeaseSolutionController@show')->name('solution.show');
    Route::get('/{slug}', 'PageController@show'); //This replaces all the individual routes
});
