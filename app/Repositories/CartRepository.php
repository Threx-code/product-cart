<?php

namespace App\Repositories;

use App\Contracts\CartsInterface;
use App\Http\Requests\Cart\CreateCartRequest;

class CartRepository implements CartsInterface
{

    public function create(CreateCartRequest $request)
    {
    }
}
