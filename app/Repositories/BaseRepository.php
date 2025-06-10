<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    protected Model $model;

    abstract protected function model(): string;

    public function __construct()
    {
        $this->model = $this->getModelInstance();
    }

    protected function getModelInstance(): Model
    {
        return app($this->model());
    }

    public function all()
    {
        return $this->model->all();
    }

    public function paginate(array $data, int $perPage = 10)
    {
        return $this->model
                    ->where($data)
                    ->latest()
                    ->paginate($perPage);
    }

    public function exists(array $attributes)
    {
        return $this->model->where($attributes)->exists();
    }

    public function find(int $id)
    {
        return $this->model->find($id);
    }

    public function findBy(array $attributes)
    {
        $query = $this->model->where($attributes);

        if ($query->exists() === true) {
            return $query->first();
        }

        return null;
    }

    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    public function update(int $id, array $attributes)
    {
        $record = $this->find($id);
        return $record ? $record->update($attributes) : false;
    }

    public function delete(int $id)
    {
        $record = $this->find($id);
        return $record ? $record->delete() : false;
    }

    public function updateOrCreate(array $where, array $data)
    {
        return $this->model->updateOrCreate($where, $data);
    }

    public function firstOrCreate(array $attributes)
    {
        return $this->model->firstOrCreate($attributes);
    }
}
