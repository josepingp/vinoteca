<?php

namespace App\Services;
use App\Models\Wine;
use App\Repositories\Cart\CartRepositoryInterface;
use Illuminate\Support\Collection;

final class Cart
{

    public function __construct(private readonly CartRepositoryInterface $repository)
    {
    }

    public function add(Wine $wine, int $quantity = 1): void
    {
        $this->repository->add($wine, $quantity);
    }

    public function increment(Wine $wine): void
    {
        $this->repository->increment($wine);
    }

    public function decrement(int $wineId): void
    {
        $this->repository->decrement($wineId);
    }

    public function remove(int $wineId): void
    {
        $this->repository->remove($wineId);
    }

    public function getTotalQuantityForWine(Wine $wine): int
    {
        return $this->repository->getTotalQuantityForWine($wine);
    }

    public function getTotalCostForWine(Wine $wine, bool $formated = false): string
    {
        return $this->repository->getTotalCostForWine($wine, $formated);
    }

    public function getTotalCost(bool $formated = false): string|float
    {
        return $this->repository->getTotalCost($formated);
    }

    public function getTotalQuantity(): int
    {
        return $this->repository->getTotalCuantity();
    }

    public function hasProduct(Wine $wine): bool
    {
        return $this->repository->hasProduct($wine);
    }

    public function getCart(): Collection
    {
        return $this->repository->getCart();
    }

    public function isEmpty(): bool
    {
        return $this->repository->isEmpty();
    }

    public function clear(): void
    {
        $this->repository->clear();
    }
}
