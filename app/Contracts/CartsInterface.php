<?php

namespace App\Contracts;

use App\Http\Requests\Cart\CreateCartRequest;
interface CartsInterface
{
    public function create(CreateCartRequest $request);
}
