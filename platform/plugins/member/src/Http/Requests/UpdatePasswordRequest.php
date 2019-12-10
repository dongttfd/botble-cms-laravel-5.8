<?php

namespace Botble\Member\Http\Requests;

use Botble\Support\Http\Requests\Request;

class UpdatePasswordRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     *
     */
    public function rules()
    {
        return [
            'current_password' => 'required|min:6|max:60',
            'password'         => 'required|min:6|max:60|confirmed',
        ];
    }
}
