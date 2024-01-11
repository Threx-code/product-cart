<?php

namespace App\Repositories;

use App\Contracts\CartsInterface;
use App\Helpers\Http\Requests\Cart\CreateCartRequest;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class CartsRepository implements CartsInterface
{
    /**
     * @param array $where
     * @return Collection|array
     */
    private function queryCart(array $where = []): Collection|array
    {
        return Cart::with(['user', 'product'])
            ->where($where)
            ->orderByDesc('id')->get();
    }

    /**
     * @param int $userId
     * @param array $where
     * @return array|Collection
     */
    public function getUserCarts(int $userId, array $where = []): array|Collection
    {
        return User::with([
            'carts' => function ($query) use ($where) {
                return $query->where($where)->with('product');
            }
        ])->where('id', $userId)->get();
    }

    /**
     * @return Collection|array
     */
    public function getAllCarts(): Collection|array
    {
        return $this->queryCart();
    }

    /**
     * @return Collection|array
     */
    public function getProductsRemovedFromCarts(): Collection|array
    {
        return $this->queryCart(['is_removed' => true]);
    }

    /**
     * @param int $userId
     * @return Collection|array
     */
    public function getAUserCarts(int $userId): Collection|array
    {
        return $this->getUserCarts($userId);
    }

    /**
     * @param int $userId
     * @return array|Collection
     */
    public function getAUserActiveCart(int $userId): Collection|array
    {
        return $this->getUserCarts($userId, ['is_removed' => false]);
    }

    /**
     * @param int $userId
     * @return array|Collection
     */
    public function getAUserProductsRemovedFromCarts(int $userId): Collection|array
    {
        return $this->getUserCarts($userId, ['is_removed' => true]);
    }

    public function addToCart(int $userId, int $productId, int $quantity)
    {
        $cartExist = Cart::where([
            'user_id' => $userId,
            'product_id' => $productId
        ])->first();


        return !empty($cartExist) ? [] : Cart::create([
            'user_id' => $userId,
            'product_id' => $productId,
            'quantity' => $quantity
        ]);
    }

    /**
     * @param int $userId
     * @param int $cartId
     * @return mixed
     */
    public function removedFromCarts(int $userId, int $cartId): mixed
    {
        return Cart::where([
            'id' => $cartId,
            'user_id' => $userId
        ])->update([
            'is_removed' => true
        ]);
    }


}
