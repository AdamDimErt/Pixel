<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request): JsonResponse
    {
        $productId = $request->input('product_id');

        // Get existing cart data from cookies
        $cartData = json_decode($request->cookie('cart', '{}'), true);

        // Add the new product to the cart
        $cartData[] = $productId;

        // Store the updated cart data in cookies
        return response()
            ->json(['success' => true])
            ->cookie('cart', json_encode($cartData), 60 * 24 * 30); // Cookie expires in 30 days
    }

    public function getCartCount(Request $request): JsonResponse
    {
        $cartData = json_decode($request->cookie('cart', '{}'), true);
        $cartCount = count($cartData);

        return response()->json(['cartCount' => $cartCount]);
    }
}
