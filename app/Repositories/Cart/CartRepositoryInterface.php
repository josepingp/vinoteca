<?php

namespace App\Repositories\Cart;
use App\Models\Wine;
use Illuminate\Support\Collection;

interface CartRepositoryInterface
{
    public function add(Wine $wine, int $quantity): void;

    public function increment(Wine $wine): void;

    public function decrement(int $wineId): void;

    public function remove(int $wineId): void;

    public function getTotalCuantityForWine(Wine $wine): int;

    public function getTotalCostForWine(Wine $wine, bool $formated): string|float;

    public function getTotalCuantity(): int;

    public function getTotalCost(bool $formated): string|float;

    public function hasProduct(Wine $wine): bool;

    public function getCart(): Collection;

    public function isEmpty(): bool;

    public function clear(): void;
}
