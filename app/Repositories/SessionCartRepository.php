<?php

namespace App\Repositories;
use App\Models\Wine;
use App\Repositories\Cart\CartRepositoryInterface;
use App\Traits\WithCurrencyFormatted;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

class SessionCartRepository implements CartRepositoryInterface
{
    use WithCurrencyFormatted;

    const SESSION = 'cart';

    public function __construct()
    {
        if (!Session::has(self::SESSION)) {
            Session::put(self::SESSION, collect());
        }
    }

    public function add(Wine $wine, int $quantity): void
    {
        $cart = $this->getCart();

        if ($cart->has($wine->id)) {
            $cart->get($wine->id)['quantity'] += $quantity;
        } else {
            $cart->put($wine->id, [
                'product' => $wine,
                'quantity' => $quantity
            ]);
        }

        $this->updateCart($cart);
    }

    public function increment(Wine $wine): void
    {
        $cart = $this->getCart();

        if ($cart->has($wine->id)) {
            if ($cart->get($wine->id)['quantity'] >= $wine->stock) {
                throw new Exception("No hay suficiente stock de " . $wine->name);
            }

            $wineCart = $cart->get($wine->id);
            $wineCart['quantity']++;
            $cart->put($wine->id, $wineCart);
            $this->updateCart($cart);

        } else {
            throw new Exception("El vino no se encuentra en el carrito");
        }
    }

    public function decrement(int $wineId): void
    {
        $cart = $this->getCart();
        if ($cart->has($wineId)) {

            $wineCart = $cart->get($wineId);
            $wineCart['quantity']--;
            $cart->put($wineId, $wineCart);

            if (data_get($cart->get($wineId), 'quantity') <= 0) {
                $cart->forget($wineId);
            }

            $this->updateCart($cart);

        } else {
            throw new Exception("El vino no se encuentra en el carrito");
        }
    }

    public function remove(int $wineId): void
    {
        $cart = $this->getCart();

        if ($cart->has($wineId)) {

            $cart->forget($wineId);
            $this->updateCart($cart);

        } else {
            throw new Exception("El vino no se encuentra en el carrito");
        }
    }

    public function getTotalCuantityForWine(Wine $wine): int
    {
        $cart = $this->getCart();

        if ($cart->has($wine->id)) {
            return $cart->get($wine->id)['quantity'];
        } else {
            throw new Exception('El vino no se encuentra en el carrito');
        }
    }

    public function getTotalCostForWine(Wine $wine, bool $formated): string|float
    {
        $cart = $this->getCart();

        if ($cart->has($wine->id)) {

            $total = $cart->get($wine->id)['quantity'] * $wine->price;

            return $formated ? $this->formatCurrency($total) : $total;

        } else {
            throw new Exception('El vino no se encuentra en el carrito');
        }
    }

    public function getTotalCuantity(): int
    {
        $cart = $this->getCart();

        return $cart->sum('quantity');
    }

    public function getTotalCost(bool $formated): string|float
    {
        $cart = $this->getCart();

        $total = $cart->sum(function ($item) {
            return data_get($item, 'quantity') * data_get($item, 'product.price');
        });

        return $formated ? $this->formatCurrency($total) : $total;
    }

    public function hasProduct(Wine $wine): bool
    {
        $cart = $this->getCart();

        return $cart->has($wine->id);
    }

    public function getCart(): Collection
    {
        return Session::get(self::SESSION);
    }

    public function isEmpty(): bool
    {
        return $this->getTotalCuantity() === 0;
    }

    public function clear(): void
    {
        Session::forget(self::SESSION);
    }

    private function updateCart(Collection $cart): void
    {
        Session::put(self::SESSION, $cart);
    }
}
