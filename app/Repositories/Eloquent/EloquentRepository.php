<?php

namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class EloquentRepository implements IEloquentRepository
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function query(): Builder
    {
        return $this->model->query();
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function find($id): ?Model
    {
        return $this->model->find($id);
    }

    public function findOrFail($id): ?Model
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data): ?Model
    {
        return $this->model->create($data);
    }
}
