<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Artisan;

Route::get('generate', function (){
return \Illuminate\Support\Facades\Artisan::call('storage:link');
})->name('generate');

// Link Storage for File Manager:
  Route::get('/linkstorage', function (){
    \Illuminate\Support\Facades\Artisan::call('storage:link');
    echo 'Storage linked!';
});

// Clear application cache:
Route::get('/clearcache', function() {
    Artisan::call('optimize:clear');
    echo 'Application cache has been cleared!';
});

Route::get('/schedule-run', function () {
return Illuminate\Support\Facades\Artisan::call('schedule:run');
})->name('schedule-run');


Route::get('/clear-cache',function(){
  dd('adsf');
 return Artisan::call('optimize');
})->name("cache.clear");
?>