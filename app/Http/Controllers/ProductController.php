<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
	/*
	 * Fetch all products from the database
	 *
	 * @return \Illuminate\View\View The view displaying the list of products.
	 *
	*/
    public function index()
    {
        $products = Product::all();
        return view('frontend.products.index', compact('products'));
    }

    /*
	 * Show the product detail page with the Stripe form
	 *
	 * @param $product - The product being purchased.
	 * @return \Illuminate\View\View The view displaying the product details and Stripe form.
	 *
	*/
    public function buy(Product $product)
    {
        return view('frontend.products.product', compact('product'));
    }

    /**
	 * Process the payment for the selected product.
	 *
	 *
	 * @param \Illuminate\Http\Request $request The incoming request, which includes the payment method.
	 * @param $product The product being purchased.
	 * @return \Illuminate\Http\RedirectResponse A redirect to the product listing page with a success message.
	*/
    public function charge(Request $request, Product $product)
    {
        $request->user()->charge($product->price * 100, $request->payment_method);

        return redirect()->route('products.index')->with('success', 'Payment successful for ' . $product->name);
    }
}
