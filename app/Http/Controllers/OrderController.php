<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
    public function store()
    {
        try {
            $user_id = 1;
            Order::create(['transact_by' => $user_id]);
            Alert::success('Success', 'You successfully created a new order');
        } catch (Exception $e) {
            Alert::error('Error', $e->getMessage());
        }
        return redirect()->back();
    }

    public function addOrderDetail(Request $request)
    {
        try {
            DB::beginTransaction(); // Start a database transaction

            // Validate the request data
            $data = $request->validate([
                'order_id' => 'required|exists:orders,id',
                'product_id' => 'required|exists:products,id',
                'state' => 'required|min:3',
                'price' => 'required|numeric|min:0',
                'quantity' => 'required|integer|min:1',
                'total' => 'required|numeric|min:0',
            ]);

            $product_id = $data['product_id'];
            $quantity = $data['quantity'];

            // Adjust batch quantities (subtract)
            if (!$this->adjustBatchQuantities($product_id, $quantity, $data['state'], 'subtract')) {
                DB::rollBack();
                Alert::warning('Warning', 'Not enough stock to fulfill the request.');
                return redirect()->back();
            }

            // Update the product's total stock count
            $product = Product::findOrFail($product_id);
            $product->stocks -= $quantity;
            $product->save();

            // Insert into `order_details` table
            OrderDetail::create($data);

            DB::commit(); // Commit the transaction
            Alert::success('Success', 'You successfully added an item to your order.');
            return redirect()->route('pos')->with('success', 'Stock updated and order details recorded successfully.');
        } catch (Exception $e) {
            DB::rollBack(); // Rollback the transaction on error
            Alert::error('Error', $e->getMessage());
            return redirect()->back();
        }
    }

    public function removeOrderDetail($id, $state)
    {
        try {
            DB::beginTransaction();

            $orderDetail = OrderDetail::findOrFail($id);
            // Adjust batch quantities back
            if (!$this->adjustBatchQuantities($orderDetail->product_id, $orderDetail->quantity, $state, 'add')) {
                DB::rollBack();
                Alert::error('Error', 'Failed to restore stock quantities.');
                return redirect()->back();
            }

            // Update product's total stock count
            $product = Product::find($orderDetail->product_id);
            $product->stocks += $orderDetail->quantity;
            $product->save();

            // Delete the order detail
            $orderDetail->delete();

            DB::commit();
            Alert::success('Success', 'Order detail removed and stock quantities restored.');
            return redirect()->route('pos');
        } catch (Exception $e) {
            DB::rollBack();
            Alert::error('Error', $e->getMessage());
            return redirect()->back();
        }
    }


    private function adjustBatchQuantities($product_id, $quantity, $state, $operation = 'subtract')
    {
        $batchProducts = DB::table('batch_products')
            ->where('product_id', $product_id)
            ->where('state', $state)
            ->orderBy('id')
            ->get();

        foreach ($batchProducts as $batch) {
            if ($quantity <= 0) {
                break;
            }

            $adjustable_quantity = min($quantity, $batch->quantity_left);

            $quantity -= $adjustable_quantity;

            // Update `quantity_left` based on the operation
            DB::table('batch_products')
                ->where('id', $batch->id)
                ->update([
                    'quantity_left' => ($operation === 'subtract')
                        ? $batch->quantity_left - $adjustable_quantity
                        : $batch->quantity_left + $adjustable_quantity,
                ]);
        }

        // Return true if the quantity was fully adjusted, otherwise false
        return $quantity === 0;
    }

    public function checkOutCash(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->validate([
                'amount' => 'required|numeric',
                'change' => 'nullable|numeric',
                'method' => 'required'
            ]);
            $data['change'] = $data['change'] ?? 0;

            $order = Order::where('order_status', 0)->orderBy('id', 'DESC')->first();
            $grand_total = OrderDetail::where('order_id', $order->id)->sum('total');

            if ($grand_total > $data['amount']) {
                Alert::warning('Warning', 'The amount entered must be greater than or equal to the grand total.');
                return redirect()->back();
            }

            $order->grand_total = $grand_total;
            $order->order_status = 1;
            $order->save();

            $payment = Payment::create([
                'order_id' => $order->id,
                'amount' => $data['amount'],
                'change' => $data['change'],
                'payment_method' => $data['method'],
                'status' => 'Completed',
            ]);

            DB::commit();
            Alert::success('Success', 'You successfully checked out the order.');
            return redirect()->route('order-checkout', ['id' => $payment->id]);
        } catch (Exception $e) {
            DB::rollBack();
            Alert::error('Error', $e->getMessage());
        }
        return redirect()->back();
    }

    public function checkOutGcash(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->validate([
                'amount' => 'required|numeric',
                'change' => 'nullable|numeric',
                'method' => 'required',
                'reference_number' => 'required|min:5'
            ]);
            $data['change'] = $data['change'] ?? 0;

            $order = Order::where('order_status', 0)->orderBy('id', 'DESC')->first();
            $grand_total = OrderDetail::where('order_id', $order->id)->sum('total');

            $order->grand_total = $grand_total;
            $order->order_status = 1;
            $order->save();

            $payment = Payment::create([
                'order_id' => $order->id,
                'amount' => $data['amount'],
                'change' => $data['change'],
                'payment_method' => $data['method'],
                'reference_number' => $data['reference_number'],
                'status' => 'Completed',
            ]);

            DB::commit();
            Alert::success('Success', 'You successfully checked out the order.');
            return redirect()->route('order-checkout', ['id' => $payment->id]);
        } catch (Exception $e) {
            DB::rollBack();
            Alert::error('Error', $e->getMessage());
        }
        return redirect()->back();
    }
}
