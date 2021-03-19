<?php
namespace App\Http\Interfaces;

interface AdminInterface{
    public function allAdmin($request);
    public function addAdmin();
    public function storeAdmin($request);
    public function editAdmin($id);
    public function updateAdmin($request);
    public function deleteAdmin($id);
}
