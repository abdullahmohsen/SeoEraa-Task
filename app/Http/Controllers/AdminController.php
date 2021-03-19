<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\AdminInterface;
use App\Http\Requests\AdminRequest;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private $adminInterface;

    public function __construct(AdminInterface $adminInterface)
    {
        $this->adminInterface = $adminInterface;
        $this->middleware(['permission:users-read'])->only('index');
        $this->middleware(['permission:users-create'])->only('create');
        $this->middleware(['permission:users-update'])->only('edit');
        $this->middleware(['permission:users-delete'])->only('destroy');
    }

    public function index(Request $request)
    {
        return $this->adminInterface->allAdmin($request);
    }

    public function create()
    {
        return $this->adminInterface->addAdmin();
    }

    public function store(AdminRequest $request)
    {
        return $this->adminInterface->storeAdmin($request);
    }

    public function edit($id)
    {
        return $this->adminInterface->editAdmin($id);
    }

    public function update(AdminRequest $request)
    {
        return $this->adminInterface->updateAdmin($request);
    }

    public function destroy($id)
    {
        return $this->adminInterface->deleteAdmin($id);
    }
}
