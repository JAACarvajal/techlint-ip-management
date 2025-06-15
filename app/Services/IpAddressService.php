<?php

namespace App\Services;

use App\Constants\HttpCodes;
use App\Filters\V1\IpAddressFilter;
use App\Http\Resources\V1\IpAddressResource;
use App\Repositories\IpAddressRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class IpAddressService extends BaseService
{
    /**
     * Repository instance
     * @var
     */
    protected $repository;

    /**
     * Create ip address service instance
     *
     * @param IpAddressRepository $repository IP address repository instance
     */
    public function __construct(IpAddressRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Create a new IP address
     *
     * @param array $data Data to create a new IP address
     */
    public function create(array $data): JsonResponse
    {
        $ipAddress = DB::transaction(function () use ($data) {
            return $this->repository->create($data);
        });

        return self::responseSuccess(new IpAddressResource($ipAddress), code: HttpCodes::CREATED);
    }

    /**
     * Delete an IP address by its ID
     *
     * @param int $ipId ID of the IP address to delete
     */
    public function delete(int $ipId): JsonResponse
    {
        $address = $this->repository->findOrFail($ipId);

        $deletedId = DB::transaction(function () use ($address) {
            return $this->repository->delete($address->id);
        });

        return self::responseSuccess(
            JsonResource::make(['id' => $deletedId])->additional([
                'meta' => $this->withAuthMetadata(request())
            ]),
            HttpCodes::OK
        );
    }

    /**
     * List IP addresses with optional filters
     *
     * @param array $filters Filters to apply on the IP addresses
     */
    public function list(array $filters): JsonResponse
    {
        $ipAddresses = $this->repository->paginate(new IpAddressFilter($filters));

        return self::responseSuccess(
            IpAddressResource::collection($ipAddresses),
            code: HttpCodes::OK
        );
    }

    /**
     * Update an existing IP address
     *
     * @param int $ipId ID of the IP address to update
     * @param array $data Data to update the IP address
     */
    public function update(int $ipId, array $data): JsonResponse
    {
        $updatedAddress = DB::transaction(function () use ($ipId, $data) {
            return $this->repository->update($ipId, $data);
        });

        return self::responseSuccess(new IpAddressResource($updatedAddress), code: HttpCodes::OK);
    }
}
