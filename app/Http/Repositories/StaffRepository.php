<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\StaffInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StaffRepository implements StaffInterface
{
    private $userModel;

    public function __construct(User $user)
    {
        $this->userModel = $user;
    }

    public function allUser($request)
    {
        $users = $this->userModel::whereRoleIs('user')->where(function ($query) use ($request){
            $query->when($request->search, function ($q) use ($request){
                $q->where('name', 'like', '%'. $request->search . '%');
            });
        })->latest()->get();
        return view('dashboard.users.index', compact('users'));
    }

    public function addUser()
    {
        return view('dashboard.users.create');
    }

    public function storeUser($request)
    {
        $user = $this->userModel::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'is_activated' => $request->has("is_activated") ? 1 : 0,
            'password' => Hash::make($request->password),
        ]);
        $user->attachRole('user');

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('users.index');
    }

    public function editUser($id)
    {
        $user = $this->userModel->findOrFail($id);
        return view('dashboard.users.edit', compact('user'));
    }

    public function updateUser($request)
    {
        $user = $this->userModel->findOrFail($request->id);

        if (!$request->has('is_activated'))
            $request->request->add(['is_activated' => 0]);
        else
            $request->request->add(['is_activated' => 1]);


        $user->update($request->all());

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('users.index');
    }

    public function deleteUser($id)
    {
        $user = $this->userModel->findOrFail($id);
        $user->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('users.index');
    }
}
