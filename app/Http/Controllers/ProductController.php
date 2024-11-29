<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    public function view($id)
    {
        $product = Product::findOrFail($id);
        return view('pages.view-product', compact('product'));
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
        $data = $request->validate([
            'id' => 'required|integer|exists:products,id',
            'type' => 'required|min:3|max:50',
            'state' => 'required|min:3|max:20',
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
        return redirect()->back();
    }

    private function uploadImage($file, $size, $brand)
    {
        $fileExtension = $file->getClientOriginalExtension();
        $fileName = strtolower($brand . '_' . $size) . '.' . $fileExtension;
        return $file->storeAs('images/', $fileName, 'public');
    }

    public function getProductPrices() {}

    public function getCurrentProductPrice() {}

    public function createNewPrice(Request $request) {}
}
