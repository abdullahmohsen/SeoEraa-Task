<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\AdminInterface;
use App\Http\Interfaces\StaffInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminRepository implements AdminInterface
{
    private $userModel;

    public function __construct(User $user)
    {
        $this->userModel = $user;
    }

    public function allAdmin($request)
    {
        $users = $this->userModel::whereRoleIs('admin')->where(function ($query) use ($request){
            $query->when($request->search, function ($q) use ($request){
                $q->where('name', 'like', '%'. $request->search . '%');
            });
        })->latest()->get();
        return view('dashboard.users.index', compact('users'));
    }

    public function addAdmin()
    {
        return view('dashboard.users.create');
    }

    public function storeAdmin($request)
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
        return redirect()->route('admins.index');
    }

    public function editAdmin($id)
    {
        $user = $this->userModel->findOrFail($id);
        return view('dashboard.users.edit', compact('user'));
    }

    public function updateAdmin($request)
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
        return redirect()->route('admins.index');
    }

    public function deleteAdmin($id)
    {
        $user = $this->userModel->findOrFail($id);
        $user->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('admins.index');
    }
}
