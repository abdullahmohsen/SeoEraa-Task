<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\ProductInterface;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productInterface;

    public function __construct(ProductInterface $productInterface)
    {
        $this->productInterface = $productInterface;
        $this->middleware(['permission:products-read'])->only('index');
        $this->middleware(['permission:products-create'])->only('create');
        $this->middleware(['permission:products-update'])->only('edit');
        $this->middleware(['permission:products-delete'])->only('destroy');
    }

    public function index(Request $request)
    {
        return $this->productInterface->allProduct($request);
    }

    public function create()
    {
        return $this->productInterface->addProduct();
    }

    public function store(ProductRequest $request)
    {
        return $this->productInterface->storeProduct($request);
    }

    public function edit($id)
    {
        return $this->productInterface->editProduct($id);
    }

    public function update(ProductRequest $request)
    {
        return $this->productInterface->updateProduct($request);
    }

    public function destroy($id)
    {
        return $this->productInterface->deleteProduct($id);
    }
}
