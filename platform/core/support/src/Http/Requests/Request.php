<?php

namespace Botble\Support\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @mixin \Illuminate\Http\Concerns\InteractsWithInput
 */
abstract class Request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     *
     */
    public function authorize()
    {
        return true;
    }
}
