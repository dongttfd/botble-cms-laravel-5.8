<?php

namespace Botble\Blog\Http\Requests;

use Botble\Blog\Http\Requests\PostRequest;

class MemberPostRequest extends PostRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     *
     */
    public function rules()
    {
        return parent::rules() + ['image_input' => 'mimes:jpg,jpeg,png'];
    }
}
