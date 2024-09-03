<?php

namespace App\Traits;
use Exception;

trait CartActions
{
    public function addProductToCart(): void
    {
        $wine = $this->repository->find(request('wine_id'));
        $quantity = request()->input('quantity', 1);

        $this->cart->add($wine, $quantity);

        session()->flash('success', 'Producto agregado');
    }

    public function incrementProductQuantity(): void
    {
        $wine = $this->repository->find(request('wine_id'));
        try {
            $this->cart->increment($wine);

            session()->flash('success', 'Cantidad incrementada');
        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function decrementProductQuantity(): void
    {
        $this->cart->decrement(request('wine_id'));

        session()->flash('success', 'Cantidad decrementada');
    }

    public function removeProduct(): void
    {
        $this->cart->remove(request('wine_id'));

        session()->flash('success', 'Producto eliminado');
    }

    public function clearCart(): void
    {
        $this->cart->clear();

        session()->flash('success', 'Carrito vaciado');
    }
}
