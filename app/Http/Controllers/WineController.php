<?php

namespace App\Http\Controllers;

use App\Http\Requests\WineRequest;
use App\Models\Wine;
use App\Repositories\Wine\WineRepositoryInterface;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WineController extends Controller
{
    public function __construct(private readonly WineRepositoryInterface $repository)
    {
    }

    public function index(): View
    {
        return view('wine.index', [
            'wines' => $this->repository->paginate(
                relationships: ['category'],
            )
        ]);
    }

    public function create(): View
    {
        return view('wine.create', [
            'wine' => $this->repository->model(),
            'action' => route('wines.store'),
            'method' => 'POST',
            'submit' => 'Crear'
        ]);
    }

    public function store(WineRequest $request): RedirectResponse
    {
        $this->repository->create($request->validated());

        session()->flash('success', 'Vino creado con éxito');

        return redirect()->route('wines.index');
    }

    public function edit(Wine $wine): View
    {
        return view('wine.edit', [
            'wine' => $wine,
            'action' => route('wines.update', $wine),
            'method' => 'PUT',
            'submit' => 'Actualizar'
        ]);
    }

    public function update(WineRequest $request, Wine $wine): RedirectResponse
    {
        $this->repository->update($request->validated(), $wine);

        session()->flash('success', 'Vino actualizado con éxito');

        return redirect()->route('wines.index');
    }

    public function destroy(Wine $wine): RedirectResponse
    {
        try {
            $this->repository->delete($wine);
            session()->flash('success', 'Vino eliminado con éxito');
        } catch (Exception $exception) {
            session()->flash('error', $exception->getMessage());
        }

        return redirect()->route('wines.index');
    }


}
