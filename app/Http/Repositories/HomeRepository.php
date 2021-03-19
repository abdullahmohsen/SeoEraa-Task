<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\HomeInterface;
use App\Models\Product;
use App\Models\User;

class HomeRepository implements HomeInterface
{
    private $userModel;
    private $productModel;

    public function __construct(User $user, Product $product)
    {
        $this->userModel = $user;
        $this->productModel = $product;
    }

    public function index()
    {
        $admins_count = $this->userModel::whereRoleIs('admin')->count();
        $users_count = $this->userModel::whereRoleIs('user')->count();
        $products_count = $this->productModel::count();
        return view('dashboard.welcome', compact('admins_count', 'users_count', 'products_count'));
    }
}
