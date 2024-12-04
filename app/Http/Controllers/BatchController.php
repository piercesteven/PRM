<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\BatchProduct;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BatchController extends Controller
{
    public function store(Request $request)
    {
        Batch::create($request->toArray());
        Alert::success('Success', 'You successfully created a new batch');
        return redirect()->back();
    }

    public function stockInProduct($id)
    {
        $product = Product::findOrFail($id);
        $stock_in = Batch::where('is_closed', 0)->orderBy('id', 'DESC')->first();;
        if (empty($stock_in)) {
            Alert::warning('Warning', 'There is no batch yet');
            return redirect()->back();
        } else {
            $exists = BatchProduct::where('product_id', $product->id)->where('batch_id', $stock_in->id)->exists();
            if ($exists) {
                Alert::warning('Warning', 'This product is already on the batches.');
                return redirect()->back();
            } else {
                return view('pages.product-stock-in', compact('product', 'stock_in'));
            }
        }
    }

    public function addToBatch(Request $request)
    {
        try {
            $data = $request->validate([
                'product_id' => 'required|exists:products,id',
                'batch_id' => 'required|exists:batches,id',
                'dot' => 'required|min:2|max:10',
                'state' => 'required',
                'quantity' => 'required|integer',
                'price' => 'required|numeric',
                'sell_price' => 'nullable|numeric', // Make it optional
            ]);
            BatchProduct::create([
                'product_id' => $data['product_id'],
                'batch_id' => $data['batch_id'],
                'state' => $data['state'],
                'dot' => $data['dot'],
                'original_quantity' => $data['quantity'],
                'quantity_left' => $data['quantity'],
                'price' => $data['price'],
                'sub_total' => $data['quantity'] * $data['price'],
                'sell_price' => $data['sell_price'] ?? null, // Include sell_price if provided, otherwise set to null
            ]);

            Alert::success('Success', 'You successfully added new product to batch');
            return redirect()->route('stock_in');
        } catch (Exception $e) {
            Alert::error('Error', $e->getMessage());
            return redirect()->back();
        }
    }
    
    public function stockIn()
    {
        try {
            $stock_in = Batch::where('is_closed', 0)->orderBy('id', 'DESC')->first();;
            $stock_in->update(['is_closed' => 1]);
            $stock_in->save();
            $batch_products = BatchProduct::where('batch_id', $stock_in->id)->get();
            foreach ($batch_products as $stock) {
                $product = Product::find($stock->product_id);
                $product->update(['stocks' => $product->stocks + $stock->original_quantity]);
                $product->save();
            }
            Alert::success('Success', 'You successfully stocked in.');
            return redirect()->back();
        } catch (Exception $e) {
            Alert::error('error', $e);
            return redirect()->back();
        }
    }

    public function removeProduct($id)
    {
        try {
            $batch_product = BatchProduct::find($id);
            $batch_product->delete();
            Alert::success('Success', 'Product batch is removed.');
            return redirect()->back();
        } catch (Exception $e) {
            Alert::error('Error', $e->getMessage());
            return redirect()->back();
        }
    }

    public function updateSecondhandPrice(Request $request)
    {
        try {
            $data = $request->validate([
                'id' => 'required|exists:batch_products,id',
                'sell_price' => 'required|numeric'
            ]);
            $stock = BatchProduct::find($data['id']);
            $stock->update(['sell_price' => $data['sell_price']]);
            $stock->save();
            Alert::success('Success', 'You successfully updated seconhand price');
        } catch (Exception $e) {
            Alert::error('Error', $e->getMessage());
        }
        return redirect()->back();
    }
}
