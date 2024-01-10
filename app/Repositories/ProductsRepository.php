<?php

namespace App\Repositories;

use App\Contracts\ProductsInterface;
use App\Helpers\Helper;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductsRepository implements ProductsInterface
{
    /**
     * @return Collection
     */
    public function getAllProducts(): Collection
    {
        return Product::all();
    }

    /**
     * @param int $productId
     * @return mixed
     */
    public function getSingleProduct(int $productId): mixed
    {
        return Product::where('id', $productId)->first();
    }

    /**
     * @param int $productId
     * @return bool
     */
    public function deleteAProduct(int $productId): bool
    {
        return (bool)Product::where('id', $productId)->delete();
    }

    /**
     * @param string $productName
     * @param float $productPrice
     * @return mixed
     */
    public function create(string $productName, float $productPrice): mixed
    {
        return Product::create([
            'name' => Helper::productNameFormatter($productName),
            'price' => $productPrice
        ]);
    }
}
