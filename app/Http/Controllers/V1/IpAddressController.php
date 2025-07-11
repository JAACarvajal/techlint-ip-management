<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\{DeleteIpAddressRequest, ListIpAddressRequest, StoreIpAddressRequest, UpdateIpAddressRequest, ViewIpAddressRequest};
use App\Services\IpAddressService;
use Illuminate\Http\JsonResponse;

class IpAddressController extends Controller
{
    /**
     * Service instance
     * @var
     */
    protected $service;

    /**
     * Create ip address controller instance
     *
     * @param IpAddressService $service IP address service instance
     */
    public function __construct(IpAddressService $service)
    {
        $this->service = $service;
    }

    /**
     * Delete an IP address
     *
     * @param int $ipId IP address ID
     */
    public function destroy(DeleteIpAddressRequest $request, int $ipId): JsonResponse
    {
        return $this->service->delete($ipId);
    }

    /**
     * List IP addresses
     *
     * @param ListIpAddressRequest $request Request object
     */
    public function index(ListIpAddressRequest $request): JsonResponse
    {
        return $this->service->list($request->mappedQueryParameters());
    }

    /**
     * Create a new IP address
     *
     * @param StoreIpAddressRequest $request Request object
     */
    public function store(StoreIpAddressRequest $request): JsonResponse
    {
        return $this->service->create($request->mappedAttributes());
    }

    /**
     * Update an IP address
     *
     * @param UpdateIpAddressRequest $request Request object
     */
    public function update(UpdateIpAddressRequest $request, $ipId): JsonResponse
    {
        return $this->service->update($ipId, $request->mappedAttributes());
    }
}
