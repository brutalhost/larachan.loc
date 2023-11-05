<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        view()->share('title', 'Cart');
    }

    public function index(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect(route('products.index'));
        }
        $preparedCart = [];
        foreach ($cart as $productId => $quantity) {
            $product        = Product::find($productId);
            $preparedCart[] = [
                'product'  => $product,
                'quantity' => $quantity
            ];
        }
        return view('cart')->with('cart', $preparedCart);
    }

    public function update(Request $request, int $productId)
    {
        $validated = $request->validate([
            'quantity' => 'numeric|nullable'
        ]);
        $cart      = session()->get('cart', []);

        if ($validated === []) {    // create or +1
            $cart[$productId] = isset($cart[$productId]) ? $cart[$productId] + 1 : 1;
            session()->flash('success', 'Product added to cart');
        } elseif ($validated['quantity'] <= 0) {    // remove
            unset($cart[$productId]);
            session()->flash('success', 'Product removed from cart');
        } else {    // update quantity
            $cart[$productId] = $validated['quantity'];
            session()->flash('success', 'Quantity updatead');
        }

        session()->put('cart', $cart);
        return back();
    }

    public function clear()
    {
        session()->forget('cart');
        session()->flash('success', 'Cart cleared');
        return redirect(route('products.index'));
    }
}
