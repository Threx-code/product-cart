<?php

namespace App\Contracts;

use App\Http\Requests\Product\CreateProductRequest;

interface ProductsInterface
{
    public function create(CreateProductRequest $request);
}
