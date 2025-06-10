<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IpAddressController extends Controller
{
    public function store(Request $request)
    {
        // Logic to store an IP address
        return response()->json(['message' => 'IP address stored successfully'], 201);
    }
}
