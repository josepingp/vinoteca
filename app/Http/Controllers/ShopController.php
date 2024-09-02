<?php

namespace App\Http\Controllers;

use App\Repositories\Shop\ShopRepositoryInterface;
use App\Services\Cart;
use App\Traits\CartActions;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShopController extends Controller
{
    use CartActions;

    public function __construct(
        private readonly ShopRepositoryInterface $repository,
        private readonly Cart $cart
    ) {
    }

    public function index(): View
    {
        ray()->showQueries();

        $wines = $this->repository->paginate();

        ray($wines);

        return view('shop.index', compact('wines'));
    }




}
