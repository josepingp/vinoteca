<?php

namespace App\Http\Controllers;

use App\Http\Requests\WineRequest;
use App\Repositories\Wine\WineRepositoryInterface;
use Illuminate\Http\Request;

class WineController extends Controller
{
    public function __construct(private readonly WineRepositoryInterface $repository)
    {
    }

    public function index()
    {
        return view('wine.index', [
            'wines' => $this->repository->paginate(
                relationships: ['category'],
            )
        ]);
    }

    public function create()
    {
        return view('wine.create', [
            'wine' => $this->repository->model(),
            'action' => route('wines.store'),
            'method' => 'POST',
            'submit' => 'Crear'
        ]);
    }

    public function store(WineRequest $request)
    {
        $this->repository->create($request->validated());

        session()->flash('success', 'Vino creado con éxito');

        return redirect()->route('wines.index');
    }






}
