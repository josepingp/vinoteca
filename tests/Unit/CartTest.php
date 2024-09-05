<?php
use App\Models\Category;
use App\Models\Wine;
use App\Services\Cart;

test('a product can be added to the cart', function () {

    $cart = app(Cart::class);

    $category = Category::create([
        'name' => 'Category 1',
        'description' => 'Description 1',
        'image' => 'image-1.jpg',
    ]);

    $wine = Wine::create([
        'name' => 'Wine 1',
        'category_id' => $category->id,
        'price' => 10.80,
        'year' => 2020,
        'stock' => 10,
        'description' => 'Description 1',
        'image' => 'image-1.jpg',
    ]);

    expect($cart->isEmpty())->toBe(true);

    $cart->add($wine);

    expect($cart->isEmpty())->toBe(false)
        ->and($cart->getCart()->count())->toBe(1);

    $cart->clear();

    expect($cart->isEmpty())->toBe(true)
        ->and($cart->getCart()->count())->toBe(0);

    $cart->add($wine, 2);

    expect($cart->getTotalQuantity())->toBe(2)
        ->and($cart->getTotalCost())->toBe(21.60);

    $cart->increment($wine);

    expect($cart->getTotalQuantity())->toBe(3)
        ->and(round($cart->getTotalCost(), 2))->toBe(32.40);

    $cart->decrement($wine->id);

    expect($cart->getTotalQuantity())->toBe(2)
        ->and($cart->getTotalCost())->toBe(21.60);

    $cart->remove($wine->id);

    expect($cart->isEmpty())->toBe(true)
        ->and($cart->getTotalQuantity())->toBe(0)
        ->and($cart->getTotalCost())->toBe(0.00);

    $cart->add($wine, 10);

    expect($cart->getTotalQuantity())->toBe(10)
        ->and($cart->getTotalCost())->toBe(108.00);


})->group('unit-cart');
