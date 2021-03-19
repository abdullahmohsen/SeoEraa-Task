<?php
namespace App\Http\Interfaces;

interface StaffInterface{
    public function allUser($request);
    public function addUser();
    public function storeUser($request);
    public function editUser($id);
    public function updateUser($request);
    public function deleteUser($id);
}
