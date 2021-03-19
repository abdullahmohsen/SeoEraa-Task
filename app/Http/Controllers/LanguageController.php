<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\LanguageInterface;
use App\Http\Requests\LanguageRequest;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    private $languageInterface;

    public function __construct(LanguageInterface $languageInterface)
    {
        $this->languageInterface = $languageInterface;
        $this->middleware(['role:super_admin']);
    }

    public function index(Request $request)
    {
        return $this->languageInterface->allLanguage($request);
    }

    public function create()
    {
        return $this->languageInterface->addLanguage();
    }

    public function store(LanguageRequest $request)
    {
        return $this->languageInterface->storeLanguage($request);
    }

    public function edit($id)
    {
        return $this->languageInterface->editLanguage($id);
    }

    public function update(LanguageRequest $request)
    {
        return $this->languageInterface->updateLanguage($request);
    }

    public function destroy($id)
    {
        return $this->languageInterface->deleteLanguage($id);
    }
}
