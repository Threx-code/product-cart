<?php

namespace App\Contracts;

interface ProductsInterface
{
    public function create(string $productName, float $productPrice);
    public function getAllProducts();
    public function getSingleProduct(int $productId);
    public function deleteAProduct(int $productId);

}
