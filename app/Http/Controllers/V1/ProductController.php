<?php

namespace App\Http\Controllers\V1;

use App\Contracts\ProductsInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateProductRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @param ProductsInterface $productRepository
     */
    public function __construct(private readonly ProductsInterface $productRepository,){}

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getAllProducts(Request $request): JsonResponse
    {
        return response()->json($this->productRepository->getAllProducts());
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getSingleProduct(Request $request): JsonResponse
    {
        $product = $this->productRepository->getSingleProduct($request->product_id);
        return response()->json($product,
            !empty($product) ? 200: 400
        );
    }

    /**
     * @param CreateProductRequest $request
     * @return JsonResponse
     */
    public function store(CreateProductRequest $request): JsonResponse
    {
        return response()->json($this->productRepository->create($request->name, $request->price), 201);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function deleteAProduct(Request $request): JsonResponse
    {
        $product = empty($this->productRepository->deleteAProduct($request->product_id)) ?
        [] : 'product deleted';
        return response()->json($product, empty($product)? 204 : 200);
    }

}
