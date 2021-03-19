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
        $admins = $this->userModel::whereRoleIs('admin')->where(function ($query) use ($request){
            $query->when($request->search, function ($q) use ($request){
                $q->where('name', 'like', '%'. $request->search . '%');
            });
        })->latest()->get();
        return view('dashboard.admins.index', compact('admins'));
    }

    public function addAdmin()
    {
        return view('dashboard.admins.create');
    }

    public function storeAdmin($request)
    {
        $admin = $this->userModel::create([
            'name' => $request->name,
            'email' => $request->email,
            'is_activated' => $request->has("is_activated") ? 1 : 0,
            'password' => Hash::make($request->password),
        ]);
        $admin->attachRole('admin');
        $admin->syncPermissions($request->permissions);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admins.index');
    }

    public function editAdmin($id)
    {
        $admin = $this->userModel->findOrFail($id);
        return view('dashboard.admins.edit', compact('admin'));
    }

    public function updateAdmin($request)
    {
        $admin = $this->userModel->findOrFail($request->id);

        if (!$request->has('is_activated'))
            $request->request->add(['is_activated' => 0]);
        else
            $request->request->add(['is_activated' => 1]);

        $request_data = $request->except(['permissions']);
        $admin->update($request_data);
        $admin->syncPermissions($request->permissions);

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('admins.index');
    }

    public function deleteAdmin($id)
    {
        $admin = $this->userModel->findOrFail($id);
        $admin->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('admins.index');
    }
}
