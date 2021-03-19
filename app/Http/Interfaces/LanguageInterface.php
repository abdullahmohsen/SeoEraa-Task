<?php
namespace App\Http\Interfaces;

interface ProductInterface{
    public function allProduct($request);
    public function addProduct();
    public function storeProduct($request);
    public function editProduct($id);
    public function updateProduct($request);
    public function deleteProduct($id);
}
