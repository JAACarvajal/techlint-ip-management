<?php

namespace App\Services;

use App\Constants\HttpCodes;
use App\Http\Resources\V1\IpAddressResource;
use App\Repositories\IpAddressRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class IpAddressService extends BaseService
{
    protected $repository;

    public function __construct(IpAddressRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(array $data)
    {
        try {
            $ipAddress = DB::transaction(function () use ($data) {
                return $this->repository->create($data);
            });

            return self::responseSuccess(new IpAddressResource($ipAddress), code: HttpCodes::CREATED);
        } catch (\Exception $exception) {
            return self::handleException($exception);
        }
    }

    public function update(array $data, int $ipId)
    {
        try {
            $address = $this->repository->findOrFail($ipId);
            dd($address);

            $updatedAddress = DB::transaction(function () use ($address, $data) {
                return $this->repository->update($address->id, $data);
            });

            return self::responseSuccess(new IpAddressResource($updatedAddress), code: HttpCodes::OK);
        } catch (ModelNotFoundException $exception) {
            return self::responseError('IP address not found', code: HttpCodes::NOT_FOUND);
        } catch (\Exception $exception) {
            return self::handleException($exception);
        }
    }

    public function delete(int $ipId)
    {
        try {
            $address = $this->repository->find($ipId);

            if ($address === null) {
                return self::responseError('IP address not found', HttpCodes::NOT_FOUND);
            }

            DB::transaction(function () use ($address) {
                $this->repository->delete($address->id);
            });

            return self::responseSuccess(null, code: HttpCodes::NO_CONTENT);
        } catch (\Exception $exception) {
            return self::handleException($exception);
        }
    }
}
