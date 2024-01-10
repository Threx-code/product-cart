<?php

namespace App\Repositories;

use App\Contracts\CartsInterface;
use App\Helpers\Http\Requests\Cart\CreateCartRequest;

class CartsRepository implements CartsInterface
{

    public function create(CreateCartRequest $request)
    {
    }
}
