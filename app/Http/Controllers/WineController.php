<?php

namespace App\Http\Controllers;

use App\Repositories\Wine\WineRepositoryInterface;
use Illuminate\Http\Request;

class WineController extends Controller
{
    public function __construct(private readonly WineRepositoryInterface $repository)
    {
    }

    public function index()
    {
        return view('wines.index', [
            'wines' => $this->repository->paginate(
                relationships: ['category'],
            )
        ]);
    }




}
