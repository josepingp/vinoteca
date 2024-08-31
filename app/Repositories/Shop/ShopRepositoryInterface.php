<?php

namespace App\Repositories\Shop;

use App\Models\Wine;
use Illuminate\Pagination\LengthAwarePaginator;

interface ShopRepositoryInterface
{
    public function paginate(int $perPage = 15): LengthAwarePaginator;

    public function find(int $id): Wine;
}
