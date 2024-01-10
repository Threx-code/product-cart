<?php

namespace App\Contracts;

use App\Helpers\Http\Requests\Cart\CreateCartRequest;

interface CartsInterface
{
    public function create(CreateCartRequest $request);
}
