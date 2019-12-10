<?php

namespace Botble\ACL\Http\Requests;

use Botble\Support\Http\Requests\Request;

class UpdateProfileRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username'          => 'required|max:30|min:4',
            'first_name'        => 'required|max:60|min:2',
            'last_name'         => 'required|max:60|min:2',
            'email'             => 'required|max:60|min:6|email',
            'dob'               => 'date|nullable',
            'address'           => 'max:255',
            'secondary_address' => 'max:255',
            'job_position'      => 'max:255',
            'phone'             => 'max:15',
            'secondary_phone'   => 'max:15',
            'secondary_email'   => 'max:60|email|nullable',
            'gender'            => 'max:255',
            'website'           => 'max:255',
            'skype'             => 'max:255',
            'facebook'          => 'max:255',
            'twitter'           => 'max:255',
            'google_plus'       => 'max:255',
            'youtube'           => 'max:255',
            'github'            => 'max:255',
            'interest'          => 'max:255',
            'about'             => 'max:400',
        ];
    }
}
