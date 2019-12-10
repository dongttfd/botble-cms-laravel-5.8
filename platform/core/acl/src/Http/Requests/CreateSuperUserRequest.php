<?php

namespace Botble\ACL\Http\Requests;

use Botble\Support\Http\Requests\Request;

class CreateSuperUserRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|max:60|min:6|email',
        ];
    }
}
