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
        $wines = $this->repository->paginate();

        return view('shop.index', compact('wines'));
    }




}
