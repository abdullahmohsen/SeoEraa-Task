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
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed',
            'permissions' => 'required|min:1'
        ]);

        $user = $this->userModel::create([
            'name' => $request->name,
            'email' => $request->email,
            'is_activated' => $request->has("is_activated") ? 1 : 0,
            'password' => Hash::make($request->password),
        ]);
        $user->attachRole('admin');
        $user->syncPermissions($request->permissions);

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
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$request->id,
            'permissions' => 'required|min:1'
        ]);
        $user = $this->userModel->findOrFail($request->id);

        if (!$request->has('is_activated'))
            $request->request->add(['is_activated' => 0]);
        $request->request->add(['is_activated' => 1]);

        $request_data = $request->except(['permissions']);
        $user->update($request_data);
        $user->syncPermissions($request->permissions);

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
