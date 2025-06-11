<?php

use App\Http\Middleware\EnsureTokenIsValid;
use App\Http\Controllers\V1\IpAddressController;
use Illuminate\Support\Facades\Route;

// IP address routes
Route::middleware([EnsureTokenIsValid::class])->group(function () {
    Route::apiResource('ip-addresses', IpAddressController::class);
});
