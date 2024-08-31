<?php

namespace App\Repositories\Wine;
use App\Models\Wine;
use App\Traits\CRUDOperations;

class EloquentWineRepository implements WineRepositoryInterface
{
    use CRUDOperations;

    protected string $model = Wine::class;
}
