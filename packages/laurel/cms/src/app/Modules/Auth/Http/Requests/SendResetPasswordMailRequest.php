<?php

namespace Laurel\CMS\Modules\Auth\Http\Requests;

use Laurel\CMS\Core\FormRequest\CmsFormRequest;

class SendResetPasswordMailRequest extends CmsFormRequest
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
            'login' => 'required|string|email'
        ];
    }
}
