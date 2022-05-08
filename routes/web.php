<?php

use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
    Route::resource('/news', NewsController::class);
    Route::post('/news/{news}/assign', [NewsController::class, 'assign'])->name('news.assign');
});
