<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\BatchProduct;
use App\Models\OrderDetail;
use App\Models\Payment;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class POSController extends Controller
{
    public function index()
    {
        $products = Product::where('status', 1)->get();
        $order = Order::where('order_status', 0)->orderBy('id', 'DESC')->first();

        if (!empty($order)) {
            $grand_total = OrderDetail::where('order_id', $order->id)->sum('total');
        } else {
            $grand_total = 0;
        }
        return view('pages.POS', compact('products', 'order', 'grand_total'));
    }

    public function addOrder($id, $state, $stocks)
    {
        $product = Product::findOrFail($id);
        $order = Order::where('order_status', 0)->orderBy('id', 'DESC')->first();
        if (empty($order)) {
            Alert::warning('Warning', 'There is no order yet.');
            return redirect()->back();
        }
        if ($stocks == 0) {
            Alert::warning('Warning', 'This ' . $state . ' product has no stocks.');
            return redirect()->back();
        }
        return view('pages.product-add-order', compact('product', 'state', 'order'));
    }

    public function orderCheckout($id)
    {
        $payment = Payment::findOrFail($id);
        $details = OrderDetail::where('order_id', $payment->order_id)->get();
        return view('pages.order-checkout', compact('payment', 'details'));
    }
}
