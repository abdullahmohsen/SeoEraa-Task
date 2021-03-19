<?php
namespace App\Http\Interfaces;

interface LanguageInterface{
    public function allLanguage($request);
    public function addLanguage();
    public function storeLanguage($request);
    public function editLanguage($id);
    public function updateLanguage($request);
    public function deleteLanguage($id);
}
