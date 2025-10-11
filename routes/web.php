<?php

use Illuminate\Support\Facades\Route;

// أي مسار غير موجود (يعني مش API) بيرجع index.html تبع Flutter
Route::get('/{any}', function () {
    return file_get_contents(public_path('index.html'));
})->where('any', '^(?!api).*$');
