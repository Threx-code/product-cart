<?php

namespace App\Repositories;

use App\Contracts\ProductsInterface;
use App\Helpers\Helper;
use App\Http\Requests\Product\CreateProductRequest;

class ProductsRepository implements ProductsInterface
{

    public function create(CreateProductRequest $request){
    }


}
