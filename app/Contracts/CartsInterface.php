<?php

namespace App\Contracts;

use App\Helpers\Http\Requests\Cart\CreateCartRequest;

interface CartsInterface
{
    public function addToCart(int $userId, int $productId, int$quantity);
    public function getAllCarts();
    public function getProductsRemovedFromCarts();
    public function getAUserCarts(int $userId);
    public function getAUserActiveCart(int $userId);
    public function getAUserProductsRemovedFromCarts(int $userId);
    public function removedFromCarts(int $userId, int $cartId);
}
