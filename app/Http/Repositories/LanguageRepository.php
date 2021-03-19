<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\LanguageInterface;
use App\Models\Language;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;


class LanguageRepository implements LanguageInterface
{
    private $languageModel;

    public function __construct(Language $language)
    {
        $this->languageModel = $language;
    }

    public function allLanguage($request)
    {
        $languages = $this->languageModel::when($request->search, function ($q) use ($request) {
            $q->where('title', '%' . $request->search . '%');
        })->latest()->get();
        return view('dashboard.languages.index', compact('languages'));
    }

    public function addLanguage()
    {
        return view('dashboard.languages.create');
    }

    public function storeLanguage($request)
    {
        if (!$request->has('active'))
            $request->request->add(['active' => 0]);
        else
            $request->request->add(['active' => 1]);

        $request_data = $request->all();

        if ($request->image) {
            Image::make($request->image)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/language_images/' . $request->image->hashName()));
            $request_data['image'] = $request->image->hashName();
        } //end of if

        $this->languageModel::create($request_data);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('languages.index');
    }

    public function editLanguage($id)
    {
        $language = $this->languageModel->findOrFail($id);
        return view('dashboard.languages.edit', compact('language'));
    }

    public function updateLanguage($request)
    {
        if (!$request->has('active'))
            $request->request->add(['active' => 0]);
        else
            $request->request->add(['active' => 1]);
        $request_data = $request->all();
        $language = $this->languageModel->findOrFail($request->id);

        if ($request->image) {
            Storage::disk('public_uploads')->delete('/language_images/' . $language->image);
            Image::make($request->image)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/language_images/' . $request->image->hashName()));
            $request_data['image'] = $request->image->hashName();
        } //end of if

        $language->update($request_data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('languages.index');
    }

    public function deleteLanguage($id)
    {
        $language = $this->languageModel->findOrFail($id);
        if ($language->image)
            Storage::disk('public_uploads')->delete('/language_images/' . $language->image);

        $language->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('languages.index');
    }
}
