<?php

namespace App\Http\Requests\Dashboard\Delegate;

class StoreChannel extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'     => ['required', 'string'],
            'handle'   => ['required', 'string'],
            'location' => ['nullable', 'string'],
        ];
    }
}
