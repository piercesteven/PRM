<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class POSController extends Controller
{
    public function index()
    {
        $products = Product::where('status', 1)->get();
        $order = Order::where('order_status', 0)->orderBy('id', 'DESC')->first();
        return view('pages.POS', compact('products', 'order'));
    }

    public function addOrder($id, $state, $stocks)
    {
        $product = Product::findOrFail($id);
        $order = Order::where('order_status', 0)->orderBy('id', 'DESC')->first();
        if ($stocks == 0) {
            Alert::warning('Warning', 'This ' . $state . ' product has no stocks.');
            return redirect()->back();
        }
        return view('pages.product-add-order', compact('product', 'state', 'order'));
    }
}
