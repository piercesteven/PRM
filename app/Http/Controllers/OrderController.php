<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
    public function store()
    {
        try {
            $user_id = 1;
            Order::create();
            Alert::success('Success', 'You successfully created a new order');
        } catch (Exception $e) {
            Alert::error('Error', $e->getMessage());
        }
        return redirect()->back();
    }
}
