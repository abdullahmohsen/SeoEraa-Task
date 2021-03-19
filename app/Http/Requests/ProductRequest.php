<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'price' => 'required',
        ];
        foreach (config('translatable.locales') as $locale) {
            $rules += [$locale . '.name' => 'required'];
            $rules += [$locale . '.description' => 'required'];
        } //end of  for each
        return $rules;
    }
}
