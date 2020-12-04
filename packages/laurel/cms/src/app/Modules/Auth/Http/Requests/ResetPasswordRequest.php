<?php

namespace Laurel\CMS\Modules\Auth\Http\Requests;

use Laurel\CMS\Core\FormRequest\CmsFormRequest;

class ResetPasswordRequest extends CmsFormRequest
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
            'login' => 'required|string|email',
            'newPassword' => 'required|string|min:8|alpha_dash',
            'newPasswordConfirm' => 'required|same:newPassword',
            'token' => 'required|string|size:64',
        ];
    }
}
