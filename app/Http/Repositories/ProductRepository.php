<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\ProductInterface;
use App\Models\Product;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;


class ProductRepository implements ProductInterface
{
    private $productModel;

    public function __construct(Product $product)
    {
        $this->productModel = $product;
    }

    public function allProduct($request)
    {
        $products = Product::when($request->search, function ($q) use ($request) {
            $q->whereTranslationLike('name', '%' . $request->search . '%');
        })->latest()->get();
        return view('dashboard.products.index', compact('products'));
    }

    public function addProduct()
    {
        return view('dashboard.products.create');
    }

    public function storeProduct($request)
    {

        $request_data = $request->all();

        if ($request->image) {
            Image::make($request->image)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/product_images/' . $request->image->hashName()));
            $request_data['image'] = $request->image->hashName();
        } //end of if

        $this->productModel::create($request_data);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('products.index');
    }

    public function editProduct($id)
    {
        $product = $this->productModel->findOrFail($id);
        return view('dashboard.products.edit', compact('product'));
    }

    public function updateProduct($request)
    {
        $request_data = $request->all();
        $product = $this->productModel->findOrFail($request->id);

        if ($request->image) {
            if ($product->image != 'default.png')
                Storage::disk('public_uploads')->delete('/product_images/' . $product->image);
            Image::make($request->image)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/product_images/' . $request->image->hashName()));
            $request_data['image'] = $request->image->hashName();
        } //end of if

        $product->update($request_data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('products.index');
    }

    public function deleteProduct($id)
    {
        $product = $this->productModel->findOrFail($id);
        if ($product->image != 'default.png')
            Storage::disk('public_uploads')->delete('/product_images/' . $product->image);

        $product->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('products.index');
    }
}
