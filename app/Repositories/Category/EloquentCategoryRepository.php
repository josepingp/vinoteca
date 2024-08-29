<?php

namespace App\Repositories\Category;

use App\Models\Category;
use App\Traits\CRUDOperations;
use Exception;

class EloquentCategoryRepository implements CategoryRepositoryInteface
{
    use CRUDOperations;

    protected string $model = Category::class;

    protected function deleteChecks(Category $category): void
    {
        if ($category->wines()->exists()) {
            throw new Exception('No se puede eliminar una categoría que tenga vinos');
        }
    }

}
