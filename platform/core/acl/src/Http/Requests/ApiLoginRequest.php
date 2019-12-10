<?php

namespace Botble\ACL\Http\Requests;

use Botble\Support\Http\Requests\Request;

class ApiLoginRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required|string',
            'password' => 'required|string',
        ];
    }
}
