<?php

namespace App\Helpers\Http\Controllers\V1;

use App\Contracts\ProductsInterface;
use App\Helpers\Http\Controllers\Controller;
use App\Helpers\Http\Requests\Product\CreateProductRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductsController extends Controller
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
        return response()->json(!empty($product) ? $product : ['message' => 'Product not found.'],
            !empty($product) ? 200: 404
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
        return response()->json( $this->productRepository->deleteAProduct($request->product_id), 204 );
    }

}
