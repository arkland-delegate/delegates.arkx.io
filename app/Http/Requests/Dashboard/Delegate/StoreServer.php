<?php

namespace App\Http\Requests\Dashboard\Delegate;

class StoreServer extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'country_id' => ['required', 'exists:countries,id'],
            'network'    => ['required', 'string', 'in:production,development'],
            'type'       => ['required', 'string', 'in:relay,forger'],
            'cpu'        => ['required', 'string'],
            'ram'        => ['required', 'string'],
            'disk'       => ['required', 'string'],
            'connection' => ['required', 'string'],
        ];
    }
}
