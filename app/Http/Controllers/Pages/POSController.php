<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class POSController extends Controller
{
    public function index()
    {
        $products = Product::where('status', 1)->get();
        return view('pages.POS', compact('products'));
    }

    public function addOrder($id)
    {
        $product = Product::findOrFail($id);
        return view('pages.product-add-order', compact('product'));
    }
}
