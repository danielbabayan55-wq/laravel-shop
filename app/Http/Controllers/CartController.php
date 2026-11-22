<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        $products = Product::whereIn('id', array_keys($cart))->get();
        

        $items = [];
        $totalCount = 0;
        $totalPrice = 0;

        foreach ($products as $product) {
            $qty = $cart[$product->id] ?? 0;
            if ($qty <= 0) continue;

            $price = $product->discount > 0
            ? round($product->price * (1 - $product->discount / 100))
            : $product->price;

            $subtotal = $price * $qty;
            $totalCount += $qty;
            $totalPrice += $subtotal;

            $items[] = [
                'product' => $product,
                'price'  => $price,
                'qty'  => $qty,
                'subtotal'=> $subtotal,
            ];
        }
        return view('cart', compact('items', 'totalCount', 'totalPrice'));
    }

    public function add(Request $request)
    {
        $id = $request->input('id');
        $cart = session('cart', []);
        $cart[$id] = ($cart[$id] ?? 0) + 1;
        session(['cart' => $cart]);

        return back();
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $action = $request->input('action');
        $cart = session('cart', []);

        if (isset($cart[$id])) {
            if ($action === 'inc') {
                $cart[$id]++;
            }elseif ($action === 'dec') {
                 $cart[$id]--;
                 if ($cart[$id] <= 0) {
                    unset($cart[$id]);
                 }
            }
            session(['cart'=> $cart]);
        }
        return back();
    }

    public function remove(Request $request)
    {
        $id = $request->input('id');
        $cart = session('cart', []);
        $unset($cart[$id]);
        session(['cart' => $cart]);

        return back();
    }

    public function clear()
    {
        session()->forget('cart');
        return back();
    }

    public function wishlist(Request $request)
    {
        $ids = session('wishlist', []);
        $products = Product::whereIn('id', $ids)->get();
        return view('wishlist', compact('products'));
    }

    public function toggleWishlist(Request $request)
    {
        $id = (int) $request->input('product_id');
        $wishlist = session('wishlist', []);

        if (in_array($id, $wishlist)) {
            $wishlist = array_values(array_diff($wishlist, [$id]));
        }else{
            $wishlist[] = $id;
        }

        session(['wishlist'=> $wishlist]);
        return back();
    }

    public function clearWishlist()
    {
        session()->forget('wishlist');
        return back();
    }

}
