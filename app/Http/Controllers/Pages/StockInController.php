<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Batch;
use App\Models\BatchProduct;

class StockInController extends Controller
{
    public function index()
    {
        $products = Product::where('status', 1)->get();
        $stock_in = Batch::where('is_closed', 0)->orderBy('id', 'DESC')->first();
        if (empty($stock_in)) {
            $batch_products = [];
            $grand_total = 0;
        } else {
            $batch_products = BatchProduct::where('batch_id', $stock_in->id)->get();
            $grand_total = BatchProduct::where('batch_id', $stock_in->id)->sum('sub_total');
        }

        return view('pages.stock_in', compact('products', 'stock_in', 'batch_products', 'grand_total'));
    }
}
