<?php

namespace Laurel\CMS\Modules\Post\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrowsePosts extends FormRequest
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
            'limit' => 'nullable|integer|min:1'
        ];
    }
}
