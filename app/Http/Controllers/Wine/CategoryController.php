<?php

namespace App\Http\Controllers\Wine;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Repositories\Category\CategoryRepositoryInteface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function __construct(
        private readonly CategoryRepositoryInteface $repository
    ) {
    }

    public function index(): View
    {
        return view('wine.category.index', [
            'categories' => $this->repository->paginate(
                counts: ['wines'],
            )
        ]);
    }

    public function create(): View
    {
        return view('wine.category.create', [
            'category' => $this->repository->model(),
            'action' => route('categories.store'),
            'method' => 'POST',
            'submit' => 'Crear'
        ]);
    }

    public function store(CategoryRequest $request): RedirectResponse
    {
        $this->repository->create($request->validated());
        return redirect()->route('categories.index');
    }
}
