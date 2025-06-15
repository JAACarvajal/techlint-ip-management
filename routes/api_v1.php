<?php

use App\Http\Controllers\V1\IpAddressController;
use Illuminate\Support\Facades\Route;

// IP address routes
Route::apiResource('ip-addresses', IpAddressController::class)->middleware('ensure.token');
