<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Models\BatchProduct;
use App\Models\Product;
use App\Models\ProductPrice;
use Exception;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    public function view($id)
    {
        $product = Product::findOrFail($id);
        $brandnew_quantity = BatchProduct::where('product_id', $id)->where('state', 'Brand New')->sum('quantity_left');
        $secondhand_quantity = BatchProduct::where('product_id', $id)->where('state', 'Secondhand')->sum('quantity_left');
        $current_price = ProductPrice::where('product_id', $product->id)
            ->whereNull('effective_date')
            ->first();
        $prices = ProductPrice::where('product_id', $product->id)->where('effective_date', '!=', NULL)->orderBy('id', 'DESC')->get();
        return view('pages.view-product', compact('product', 'current_price', 'prices', 'brandnew_quantity', 'secondhand_quantity'));
    }

    public function store(ProductStoreRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image_path')) {
            $data['image_path'] = $this->uploadImage($request->file('image_path'), $data['size'], $data['brand']);
        }
        if ($data) {
            Product::create($data);
            Alert::success('Success', 'You successfully added new product.');
        } else {
            Alert::error('Error', 'Failed to add new product.');
        }
        return redirect()->back();
    }

    public function update(Request $request)
    {
        try {
            $data = $request->validate([
                'id' => 'required|integer|exists:products,id',
                'type' => 'required|min:3|max:50',
                'brand' => 'required|min:3|max:50',
                'material' => 'required|min:3|max:50',
                'size' => 'required|min:3|max:20',
            ]);
            $product = Product::findOrFail($data['id']);
            if ($data) {
                $product->update($data);
                $product->save();
                Alert::success('Success', 'You successfully updated the product.');
            } else {
                Alert::error('Error', 'Failed to update product.');
            }
        } catch (Exception $e) {
            Alert::error('Error', $e->getMessage());
        }
        return redirect()->back();
    }

    public function archive(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|numeric|exists:products,id',
            ]);
            $product = Product::findOrFail($request->id);
            $new_status = $product->status ? 0 : 1;
            $message = $product->status ? "archive" : "restore";
            $product->update(['status' => $new_status]);
            $product->save();
            Alert::success("success", 'You successfully ' . $message . ' the product');
        } catch (Exception $e) {
            Alert::error('error', 'You failed to ' . ($message ?? 'process') . ' the product.');
        }
        return redirect()->back();
    }

    private function uploadImage($file, $size, $brand)
    {
        $fileExtension = $file->getClientOriginalExtension();
        $fileName = strtolower($brand . '_' . $size) . '.' . $fileExtension;
        return $file->storeAs('images/', $fileName, 'public');
    }

    public function changePrice(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|numeric|exists:products,id',
            'price' => 'required|numeric',
        ]);

        try {
            $product = Product::findOrFail($data['product_id']);

            if (empty($product->productPrices)) {
                ProductPrice::create($data);
            } else {
                // Create a new price record
                ProductPrice::create($data);

                // Get the most recent price (excluding the one just created)
                $previousPrice = ProductPrice::where('product_id', $product->id)
                    ->orderBy('id', 'DESC')
                    ->skip(1) // Skip the newly created price
                    ->first();

                if ($previousPrice) {
                    $previousPrice->effective_date = now(); // Update effective date
                    $previousPrice->save(); // Save the changes
                }
            }

            Alert::success("Success", 'You successfully updated the price');
        } catch (Exception $e) {
            Alert::error('Error', $e->getMessage());
        }

        return redirect()->back();
    }
}
