<?php

namespace App\Repositories\Shop;

use App\Models\Wine;
use Illuminate\Pagination\LengthAwarePaginator;

class EloquentShopRepository implements ShopRepositoryInterface
{

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return Wine::with('category')->paginate($perPage);
    }

    public function find(int $id): Wine
    {
        return Wine::findOrFail($id);
    }

}
