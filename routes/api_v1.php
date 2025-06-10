<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\IpAddressController;

Route::apiResource('ip-addresses', IpAddressController::class);
