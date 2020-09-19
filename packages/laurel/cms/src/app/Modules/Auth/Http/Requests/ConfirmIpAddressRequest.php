<?php

namespace Laurel\CMS\Modules\Auth\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfirmIpAddressRequest extends FormRequest
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
            'login' => 'required|string',
            'ip_address' => 'required|ip',
            'code' => 'required|string|size:64'
        ];
    }
}
