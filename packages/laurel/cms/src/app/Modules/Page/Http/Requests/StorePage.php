<?php

namespace Laurel\CMS\Modules\Page\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePage extends FormRequest
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
            'title' => 'required|string|max:255',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string|max:1000',
            'seo_keywords' => 'nullable|string|max:1000',
            'seo_robots_txt' => 'nullable|string|max:1000',
            'text' => 'required|string|max:1000000',
            'attributes' => 'nullable|array',
            'views' => 'nullable|integer|max:255|min:0',
        ];
    }
}
