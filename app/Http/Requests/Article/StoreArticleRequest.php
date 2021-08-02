<?php

namespace App\Http\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
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
        return [
            'img' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required','max:100',
            'price' => 'required',
            'description' =>'required','min:20','max:255',
            'detail' =>'required','min:50'
        ];
    }
}
