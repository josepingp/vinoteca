<?php
use App\Models\Category;
use App\Models\User;
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
        'price' => 15.25,
        'year' => 2020,
        'stock' => 10,
        'description' => 'Description 1',
        'image' => 'image-1.jpg',
    ]);

    $wine2 = Wine::create([
        'name' => 'Wine 2',
        'category_id' => $category->id,
        'price' => 10,
        'year' => 2020,
        'stock' => 10,
        'description' => 'Description 1',
        'image' => 'image-2.jpg',
    ]);

    $user = User::factory()->create();

    $this->actingAs($user);

    $this->post(route('shop.addToCart'), [
        'wine_id' => $wine->id,
        'quantity' => 2
    ]);

    expect($cart->isEmpty())->toBe(false)
        ->and($cart->getCart()->count())->toBe(1)
        ->and($cart->getTotalQuantity())->toBe(2)
        ->and($cart->getTotalCost())->toBe(30.5)
        ->and($cart->getTotalCostForWine($wine))->toBe('30.5')
        ->and($cart->getTotalQuantityForWine($wine))->toBe(2);

    $this->post(route('shop.addToCart'), [
        'wine_id' => $wine2->id,
        'quantity' => 3
    ]);

    expect($cart->isEmpty())->toBe(false)
        ->and($cart->getCart()->count())->toBe(2)
        ->and($cart->getTotalQuantity())->toBe(5)
        ->and($cart->getTotalCost())->toBe(60.5)
        ->and($cart->getTotalCostForWine($wine))->toBe('30.5')
        ->and($cart->getTotalQuantityForWine($wine))->toBe(2)
        ->and($cart->getTotalCostForWine($wine2))->toBe('30')
        ->and($cart->getTotalQuantityForWine($wine2))->toBe(3);

    $this->post(route('shop.increment'), [
        'wine_id' => $wine->id
    ]);

    $this->post(route('shop.increment'), [
        'wine_id' => $wine->id
    ]);

    expect($cart->isEmpty())->toBe(false)
        ->and($cart->getCart()->count())->toBe(2)
        ->and($cart->getTotalQuantity())->toBe(7)
        ->and($cart->getTotalCost())->toBe(91.0)
        ->and($cart->getTotalCostForWine($wine))->toBe('61')
        ->and($cart->getTotalQuantityForWine($wine))->toBe(4)
        ->and($cart->getTotalCostForWine($wine2))->toBe('30')
        ->and($cart->getTotalQuantityForWine($wine2))->toBe(3);

    $this->post(route('shop.decrement'), [
        'wine_id' => $wine2->id
    ]);

    expect($cart->isEmpty())->toBe(false)
        ->and($cart->getCart()->count())->toBe(2)
        ->and($cart->getTotalQuantity())->toBe(6)
        ->and($cart->getTotalCost())->toBe(81.0)
        ->and($cart->getTotalCostForWine($wine))->toBe('61')
        ->and($cart->getTotalQuantityForWine($wine))->toBe(4)
        ->and($cart->getTotalCostForWine($wine2))->toBe('20')
        ->and($cart->getTotalQuantityForWine($wine2))->toBe(2);

    $this->post(route('shop.remove'), [
        'wine_id' => $wine->id
    ]);

    expect($cart->isEmpty())->toBe(false)
        ->and($cart->getCart()->count())->toBe(1)
        ->and($cart->getTotalQuantity())->toBe(2)
        ->and($cart->getTotalCost())->toBe(20.0)
        ->and($cart->getTotalCostForWine($wine2))->toBe('20')
        ->and($cart->getTotalQuantityForWine($wine2))->toBe(2);

    $this->post(route('cart.clear'));

    expect($cart->isEmpty())->toBe(true);


})->group('feature-cart');
