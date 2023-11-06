<?php

use App\Support\Actions\ChangeLocalizationAction;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::any('clear', function () {

    //Artisan::call('storage:link');
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');

    session()->flash('success', t_('All Command successfully'));

    return redirect()->back();
})->name('clear.cache');

Route::get('setlocale', 'IndexController@changeLanguage')->name('language.change');


Route::group(['prefix' =>config('custom.dashboard.prefix', 'dashboard'),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], static function () {
    include __DIR__ . '/auth.routes.php';
});

Route::group(['prefix' =>config('custom.dashboard.prefix', 'dashboard'),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth:employee']], static function () {
    Route::get('/','IndexController@index' )->name('home');
    require __DIR__ . '/core.routes.php';

});


