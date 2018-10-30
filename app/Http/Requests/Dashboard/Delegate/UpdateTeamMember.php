<?php

namespace App\Http\Requests\Dashboard\Delegate;

class UpdateTeamMember extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'role' => ['required', 'string'],
            'body' => ['required', 'string'],
        ];
    }
}
