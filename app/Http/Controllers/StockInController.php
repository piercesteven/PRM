<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StockInController extends Controller
{
    public function index()
    {
        return view('pages.stock_in');
    }
}
