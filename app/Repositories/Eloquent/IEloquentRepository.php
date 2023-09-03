<?php

namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface IEloquentRepository
{
    public function query(): Builder;

    public function find($id): ?Model;

    public function findOrFail($id): ?Model;

    public function all(): Collection;

    public function create(array $data): ?Model;
}
