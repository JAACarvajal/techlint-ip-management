<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\{StoreIpAddressRequest, UpdateIpAddressRequest};
use App\Services\IpAddressService;

class IpAddressController extends Controller
{
    public function store(StoreIpAddressRequest $request, IpAddressService $service)
    {
        return $service->create($request->validated());
    }

    public function destroy(IpAddressService $service, $ipId)
    {
        return $service->delete($ipId);
    }

    public function update(UpdateIpAddressRequest $request, IpAddressService $service, $ipId)
    {
        return $service->update($request->validated(), $ipId);
    }
}
