<?php

namespace App\Http\Controllers;

use App\Contracts\ProductsInterface;

class ProductController extends Controller
{
    /**
     * @param ProductsInterface $productRepository
     */
    public function __construct(private readonly ProductsInterface $productRepository,){}

}
