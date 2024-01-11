<?php

namespace Tests\Feature;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CartTest extends TestCase
{

    const ALL_CART_STRUCTURE = [
        "id",
        "user_id",
        "product_id",
        "quantity",
        "is_removed",
        "created_at",
        "updated_at",
        "user" => [
            "id",
            "first_name",
            "last_name",
            "email",
            "phone_number",
            "date_deleted",
            "created_at",
            "updated_at"
        ],
        "product" => [
            "id",
            "name",
            "price",
            "created_at",
            "updated_at"
        ]
    ];

    public function testGetCartsWithUsersAndProducts()
    {
        $carts = Cart::with('user', 'product')->where([])->get();

        foreach ($carts as $cart) {
            $this->assertNotNull($cart->user);
            $this->assertNotNull($cart->product);
        }
    }

    public function testGetAllCarts()
    {
        $response = $this->get(route('all-carts'));

        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => self::ALL_CART_STRUCTURE
        ]);
    }

    public function testGetProductsRemovedFromCarts()
    {
        $carts = Cart::with('user', 'product')
            ->whereHas('product', function ($query) {
                $query->where('is_removed', true);
            })
            ->get();

        $response = $this->get(route('get-products-removed-from-cart'));

        $response->assertStatus(200);
        $response->assertJsonCount($carts->count(), '*');
        $response->assertJsonStructure([
            '*' => self::ALL_CART_STRUCTURE
        ]);
    }

    public function testGetAUserCarts()
    {
        $user = User::take(1)->first();
        $carts = $this->getUserData(['user_id' => $user->id]);

        $response = $this->get(route('get-a-user-cart', ['user_id' => $user->id]));

        $response->assertStatus(200);
        $response->assertJson([$this->userCartData($user, $carts)]);
    }

    public function testGetAUserActiveCart()
    {
        $user = User::take(1)->first();
        $carts = $this->getUserData(['user_id' => $user->id, 'is_removed' => false]);

        $response = $this->get(route('get-a-user-active-cart', ['user_id' => $user->id]));

        $response->assertStatus(200);
        $response->assertJson([$this->userCartData($user, $carts)]);
    }

    public function testGetAUserProductsRemovedFromCarts()
    {
        $user = User::take(1)->first();
        $carts = $this->getUserData(['user_id' => $user->id, 'is_removed' => true]);

        $response = $this->get(route('get-a-user-product-removed-from-cart', ['user_id' => $user->id]));

        $response->assertStatus(200);
        $response->assertJson([$this->userCartData($user, $carts)]);
    }

    public function testRemovedFromCartsWhenNoDataIsPassed()
    {
        $data = [
            'user_id' => '',
            'cart_id' => '',
        ];
        $response = $this->put(route('remove-from-cart'), $data);
        $response->assertStatus(422);
        $response->assertJson([
                "message" => "The user id field is required. (and 1 more error)",
                "errors" => [
                    "user_id" => [
                        "The user id field is required."
                    ],
                    "cart_id" => [
                        "The cart id field is required."
                    ]
                ]
        ]);
    }

    public function testRemovedFromCartsInvalidUserId()
    {
        $cart = Cart::where('is_removed', false)->take(1)->first();
        $data = [
            'user_id' => 9000000,
            'cart_id' => $cart->id,
        ];
        $response = $this->put(route('remove-from-cart'), $data);
        $response->assertStatus(422);
        $response->assertJson([
            "message" => "The selected user id is invalid.",
            "errors" => [
                "user_id" => [
                    "The selected user id is invalid."
                ],
            ]
        ]);
    }

    public function testRemovedFromCartsInvalidCartId()
    {
        $cart = Cart::take(1)->first();
        $data = [
            'user_id' => $cart->user_id,
            'cart_id' => 9999999999,
        ];
        $response = $this->put(route('remove-from-cart'), $data);
        $response->assertStatus(422);
        $response->assertJson([
            "message" => "The selected cart id is invalid.",
            "errors" => [
                "cart_id" => [
                    "The selected cart id is invalid."
                ]
            ]
        ]);
    }

    public function testAddToCart()
    {
        $cart = Cart::take(1)->first();
        $productIds = Cart::where('user_id', $cart->user_id)->get()->toArray();
        $productIds = array_column($productIds, 'product_id');

        $product = Product::whereNotIn('id', $productIds)->take(1)->first();

        $data = [
            'user_id' => $cart->user_id,
            'product_id' => $product->id,
            'quantity' => 3
        ];

        $response = $this->post(route('add-to-cart'), $data);
        $response->assertStatus(201);
        $this->assertDatabaseHas('carts', $data);
        $response->assertJsonStructure([
            "user_id",
            "product_id",
            "quantity",
            "updated_at",
            "created_at",
            "id"
        ]);
    }

    public function testRemovedFromCarts()
    {
        $cart = Cart::where('is_removed', false)->take(1)->first();

        $data = [
            'user_id' => $cart->user_id,
            'cart_id' => $cart->id,
        ];
        $response = $this->put(route('remove-from-cart'), $data);
        $response->assertStatus(200);
        $response->assertJson(["status" => "Product removed from cart"]);
    }

    /**
     * @param $user
     * @param Collection|array $carts
     * @return array
     */
    public function userCartData($user, Collection|array $carts): array
    {
        return [
            'id' => $user->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'phone_number' => $user->phone_number,
            'date_deleted' => $user->date_deleted,
            'created_at' => $user->created_at->toISOString(),
            'updated_at' => $user->updated_at->toISOString(),
            'carts' => $carts->map(function ($cart) {
                return [
                    'id' => $cart->id,
                    'user_id' => $cart->user_id,
                    'product_id' => $cart->product_id,
                    'quantity' => $cart->quantity,
                    'is_removed' => $cart->is_removed,
                    'created_at' => $cart->created_at->toISOString(),
                    'updated_at' => $cart->updated_at->toISOString(),
                    'product' => [
                        'id' => $cart->product->id,
                        'name' => $cart->product->name,
                        'price' => $cart->product->price,
                        'created_at' => $cart->product->created_at->toISOString(),
                        'updated_at' => $cart->product->updated_at->toISOString(),
                    ],
                ];
            })->toArray(),
        ];
    }

    /**
     * @param array $where
     * @return array|Collection
     */
    public function getUserData(array $where): array|Collection
    {
        return Cart::with('product')
            ->where($where)
            ->get();
    }


}
