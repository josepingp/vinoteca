<?php

namespace App\Repositories\Category;

use App\Models\Category;
use App\Traits\CRUDOperations;

class EloquentCategoryRepository implements CategoryRepositoryInteface
{
    use CRUDOperations;

    protected string $model = Category::class;

}
