<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\StaffInterface;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userInterface;

    public function __construct(StaffInterface $userInterface)
    {
        $this->userInterface = $userInterface;
        $this->middleware(['permission:users-read'])->only('index');
        $this->middleware(['permission:users-create'])->only('create');
        $this->middleware(['permission:users-update'])->only('edit');
        $this->middleware(['permission:users-delete'])->only('destroy');
    }

    public function index(Request $request)
    {
        return $this->userInterface->allUser($request);
    }

    public function create()
    {
        return $this->userInterface->addUser();
    }

    public function store(UserRequest $request)
    {
        return $this->userInterface->storeUser($request);
    }

    public function edit($id)
    {
        return $this->userInterface->editUser($id);
    }

    public function update(UserRequest $request)
    {
        return $this->userInterface->updateUser($request);
    }

    public function destroy($id)
    {
        return $this->userInterface->deleteUser($id);
    }
}
