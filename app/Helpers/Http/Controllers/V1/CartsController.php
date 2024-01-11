<?php

namespace App\Helpers\Http\Controllers\V1;

use App\Contracts\CartsInterface;
use App\Helpers\Http\Controllers\Controller;
use App\Helpers\Http\Requests\Cart\CreateCartRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CartsController extends Controller
{
    public function __construct(private readonly CartsInterface $cartRepository){}

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getAllCarts(Request $request): JsonResponse
    {
        return response()->json($this->cartRepository->getAllCarts());
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getProductsRemovedFromCarts(Request $request): JsonResponse
    {
        return response()->json($this->cartRepository->getProductsRemovedFromCarts());
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getAUserCarts(Request $request): JsonResponse
    {
        return response()->json($this->cartRepository->getAUserCarts($request->user_id));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getAUserActiveCart(Request $request): JsonResponse
    {
        return response()->json($this->cartRepository->getAUserActiveCart($request->user_id));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getAUserProductsRemovedFromCarts(Request $request): JsonResponse
    {
        return response()->json($this->cartRepository->getAUserProductsRemovedFromCarts($request->user_id));
    }

    /**
     * @param CreateCartRequest $request
     * @return JsonResponse
     */
    public function addToCart(CreateCartRequest $request): JsonResponse
    {
        $response = $this->cartRepository->addToCart($request->user_id, $request->product_id, $request->quantity);
        return response()->json(
            empty($response) ? ["status" => "Product already added to cart for this user"] : $response, empty($response) ? 200: 201
        );
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function removedFromCarts(Request $request): JsonResponse
    {
        return response()->json(!empty($this->cartRepository->removedFromCarts($request->user_id, $request->cart_id)) ?
        ["status" => "Product removed from cart"] : ["Status" => "Unable to remove from cart"], 200);
    }

}
